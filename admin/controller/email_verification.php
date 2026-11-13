<?php
if (!defined('BASEPATH')) {
    die('Direct access to the script is not allowed');
}

/* -------------------------------------------------
   CONFIG
--------------------------------------------------*/
$otp_expiration_time = 5 * 60; // 5 minutes
$max_attempts = 3;

/* -------------------------------------------------
   FUNCTIONS
--------------------------------------------------*/
function generateOTP() {
    return random_int(100000, 999999);
}

/* -------------------------------------------------
   ADMIN SESSION CHECK (KEEP EXISTING FLOW)
--------------------------------------------------*/
if (!isset($_SESSION["msmbilisim_adminid"])) {
    die("Unauthorized access");
}

$admin_id = $_SESSION["msmbilisim_adminid"];

/* -------------------------------------------------
   FETCH ADMIN DATA
--------------------------------------------------*/
$stmt = $conn->prepare("
    SELECT admin_email, username, chat_id 
    FROM admins 
    WHERE admin_id = :admin_id 
    LIMIT 1
");
$stmt->execute(['admin_id' => $admin_id]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$admin) {
    die("Admin not found");
}

/* -------------------------------------------------
   OTP GENERATION (GET) — FIXED LOGIC
--------------------------------------------------*/
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    // ✅ Generate OTP ONLY if not exists or expired
    if (
        !isset($_SESSION['otp']) ||
        !isset($_SESSION['otp_expiry']) ||
        time() > $_SESSION['otp_expiry']
    ) {

        $otp = generateOTP();

        $_SESSION['otp'] = (string)$otp;
        $_SESSION['otp_expiry'] = time() + $otp_expiration_time;
        $_SESSION['otp_attempts'] = 0;
        $_SESSION['username'] = $admin['username'];

        /* --------------------------
           TELEGRAM OTP (UNCHANGED FEATURE)
        ---------------------------*/
        if (!empty($admin['chat_id']) && !empty($settings["adminbottoken"])) {

            $telegramMessage =
                "*Admin Verification*\n\n" .
                "Your OTP Code: `{$otp}`\n\n" .
                "Valid for 5 minutes.\n" .
                "Do NOT share this code.";

            $telegramURL = "https://api.telegram.org/bot{$settings["adminbottoken"]}/sendMessage";

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $telegramURL,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => [
                    'chat_id' => $admin['chat_id'],
                    'text' => $telegramMessage,
                    'parse_mode' => 'Markdown'
                ],
                CURLOPT_TIMEOUT => 10
            ]);
            curl_exec($ch);
            curl_close($ch);
        }

        /* --------------------------
           EMAIL OTP (UNCHANGED FEATURE)
        ---------------------------*/
        $to = $admin['admin_email'];
        $from = $settings["smtp_user"];
        $subject = "Admin OTP Verification";

        $emailMessage =
            "Admin Verification\n\n" .
            "Your OTP Code: {$otp}\n\n" .
            "This code is valid for 5 minutes.\n" .
            "Do not share this code with anyone.";

        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type:text/plain;charset=UTF-8\r\n";
        $headers .= "From: {$from}\r\n";

        if (mail($to, $subject, $emailMessage, $headers)) {
            $_SESSION['success'] = "A verification code has been sent to your email and Telegram.";
        }
    }
}

/* -------------------------------------------------
   OTP VERIFICATION (POST) — FIXED & SAFE
--------------------------------------------------*/
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_SESSION['otp'], $_SESSION['otp_expiry'])) {
        $error = 1;
        $errorText = "OTP not generated. Please refresh the page.";
    }
    elseif (time() > $_SESSION['otp_expiry']) {

        // ✅ Only clear OTP, NOT full session
        unset($_SESSION['otp'], $_SESSION['otp_expiry'], $_SESSION['otp_attempts']);

        $error = 1;
        $errorText = "OTP expired. Please refresh to get a new code.";
    }
    elseif ($_SESSION['otp_attempts'] >= $max_attempts) {

        unset($_SESSION['otp'], $_SESSION['otp_expiry'], $_SESSION['otp_attempts']);

        $error = 1;
        $errorText = "Too many failed attempts. OTP blocked.";
    }
    else {

        $entered_otp = trim($_POST['otp'] ?? '');

        // ✅ Strict compare to avoid mismatch
        if ((string)$entered_otp === (string)$_SESSION['otp']) {

            // ✅ KEEP EXISTING LOGIN FLOW
            $_SESSION['otp_verified'] = true;
            $_SESSION['msmbilisim_adminlogin'] = 1;

            unset($_SESSION['otp'], $_SESSION['otp_expiry'], $_SESSION['otp_attempts']);

            header("Location: " . site_url($rentaladmin));
            exit();

        } else {

            $_SESSION['otp_attempts']++;
            $error = 1;
            $errorText = "Invalid OTP. Attempts left: " . ($max_attempts - $_SESSION['otp_attempts']);
        }
    }
}

/* -------------------------------------------------
   LOAD VIEW
--------------------------------------------------*/
require admin_view('email_verification');
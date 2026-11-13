<?php
use Google\Client as Google_Client;

if (!defined('BASEPATH')) {
    die('Direct access to the script is not allowed');
}

require 'vendor/autoload.php'; 
session_start();

$google_credentials = getGoogleCredentials();
$google_client_id = $settings["googleclientid"];
$google_client_secret = $settings["googleclientsecret"];
$google_redirect_uri = site_url("$rentaladmin");

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
            $_SESSION["msmbilisim_adminslogin"] = 1;
            $_SESSION["msmbilisim_adminid"] = $admin["admin_id"];
            $_SESSION["msmbilisim_adminpass"] = $admin["password"];
            $_SESSION["recaptcha"] = false;
            setcookie("a_login", 'ok', time() + (60 * 60 * 24 * 7), '/', null, null, true);
            setcookie("a_id", $admin["admin_id"], time() + (60 * 60 * 24 * 7), '/', null, null, true);
            setcookie("a_password", $admin["password"], time() + (60 * 60 * 24 * 7), '/', null, null, true);
            setcookie("a_login", 'ok', time() + (60 * 60 * 24 * 7), '/', null, null, true);

            header('Location: ' . site_url("$rentaladmin"));
            exit();
        } else {
            $_SESSION["error"] = "Could not find administrator account registered with this email.";
            header('Location: ' . site_url("$rentaladmin"));
            exit();
        }
    } else {
        $_SESSION["error"] = "Invalid Google token.";
        header('Location: ' . site_url("$rentaladmin"));
        exit();
    }
}

function getCountryByIP($ip) {
    $json = file_get_contents("http://ipinfo.io/{$ip}/json");
    $details = json_decode($json);
    return $details->country ?? 'Unknown';
}
?>
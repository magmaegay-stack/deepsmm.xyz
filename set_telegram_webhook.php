<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define("BASEPATH", TRUE);
require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/init.php";

// Fetch bot tokens
$settingsQuery = $conn->prepare("SELECT telegramusertoken, adminbottoken FROM settings LIMIT 1");
$settingsQuery->execute();
$settings = $settingsQuery->fetch(PDO::FETCH_ASSOC);

$telegramusertoken = $settings["telegramusertoken"];
$adminbottoken = $settings["adminbottoken"];

// Ensure tokens are valid
if (!$telegramusertoken || !$adminbottoken) {
    die("Error: Bot tokens not found in the database.");
}

// Auto-detect domain with protocol
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$domain = $protocol . $_SERVER['HTTP_HOST'];

// Define separate webhook URLs
$userWebhookUrl = "$domain/user_telegram_webhook.php";
$adminWebhookUrl = "$domain/admin_telegram_webhook.php";

// Function to set webhook
function setWebhook($botToken, $webhookUrl) {
    $apiUrl = "https://api.telegram.org/bot$botToken/setWebhook";
    $data = json_encode(["url" => $webhookUrl]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [
        "status" => ($httpCode == 200) ? "success" : "failed",
        "http_code" => $httpCode,
        "response" => json_decode($response, true)
    ];
}

// Set webhooks separately
$userResponse = setWebhook($telegramusertoken, $userWebhookUrl);
$adminResponse = setWebhook($adminbottoken, $adminWebhookUrl);

// Display webhook setup results
echo "<h3>User Bot Webhook Response:</h3><pre>" . print_r($userResponse, true) . "</pre>";
echo "<h3>Admin Bot Webhook Response:</h3><pre>" . print_r($adminResponse, true) . "</pre>";
?>

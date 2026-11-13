<?php
define("BASEPATH", TRUE);
require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/init.php";

// Fetch settings from the database
$settingsQuery = $conn->prepare("SELECT adminbottoken, site_name FROM settings LIMIT 1");
$settingsQuery->execute();
$settings = $settingsQuery->fetch(PDO::FETCH_ASSOC);

$adminbottoken = $settings["adminbottoken"];
$site_name = $settings["site_name"];

$input = file_get_contents('php://input');
$update = json_decode($input, true);

if (isset($update['message'])) {
    $chat_id = $update['message']['chat']['id'];
    $text = $update['message']['text'];

    if (strpos($text, '/start') === 0) {
        $params = explode(' ', $text);
        $secure_token = $params[1] ?? null; // Secure Token Fetch

        if ($secure_token) {
            // Fetch admin details using secure token
            $adminQuery = $conn->prepare("SELECT admin_id FROM admins WHERE secure_token = :token");
            $adminQuery->execute(["token" => $secure_token]);
            $admin = $adminQuery->fetch(PDO::FETCH_ASSOC);

            if ($admin) {
                // Update Telegram Chat ID
                $stmt = $conn->prepare("UPDATE admins SET chat_id = :chat_id WHERE admin_id = :admin_id");
                if ($stmt->execute(["chat_id" => $chat_id, "admin_id" => $admin['admin_id']])) {
                    $message = "*Admin Notifications Activated*\n\n"
                        . "Dear Administrator,\n\n"
                        . "Your Telegram chat ID has been successfully linked to the system. You will now receive important alerts and system notifications here.\n\n"
                        . "If you did not initiate this action, please review your account security settings immediately.";

                    sendTelegramMessage($adminbottoken, $chat_id, $message);
                }
            }
        }
    }
}

// Function to send Telegram messages
function sendTelegramMessage($bottoken, $chat_id, $message) {
    file_get_contents("https://api.telegram.org/bot$bottoken/sendMessage?chat_id=$chat_id&text=" . urlencode($message) . "&parse_mode=Markdown");
}
?>

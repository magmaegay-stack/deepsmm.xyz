<?php
define("BASEPATH", TRUE);
require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/init.php";

// Fetch bot token and site name
$settingsQuery = $conn->prepare("SELECT telegramusertoken, site_name FROM settings LIMIT 1");
$settingsQuery->execute();
$settings = $settingsQuery->fetch(PDO::FETCH_ASSOC);

$telegramusertoken = $settings["telegramusertoken"];
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
            // Fetch user details using secure token
            $userQuery = $conn->prepare("SELECT client_id, username FROM clients WHERE secure_token = :token");
            $userQuery->execute(["token" => $secure_token]);
            $user = $userQuery->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Update Telegram Chat ID securely
                $stmt = $conn->prepare("UPDATE clients SET chat_id = :chat_id WHERE client_id = :user_id");
                if ($stmt->execute(["chat_id" => $chat_id, "user_id" => $user['client_id']])) {
                    
                    // Prepare confirmation message
                    $message = "*Telegram Notifications Activated*\n\n"
                        . "Dear {$user['username']},\n\n"
                        . "Your Telegram notifications have been successfully activated. You will now receive updates and alerts directly on Telegram.\n\n"
                        . "If you did not request this change, please contact our support team immediately.\n\n"
                        . "Best regards,\n"
                        . "$site_name Support Team";

                    // Send Telegram message
                    sendTelegramMessage($telegramusertoken, $chat_id, $message);
                } else {
                    // Log error if update fails
                    file_put_contents("error_log.txt", print_r($stmt->errorInfo(), true), FILE_APPEND);
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

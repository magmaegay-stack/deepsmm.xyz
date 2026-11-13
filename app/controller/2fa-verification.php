<?php
if (!defined('BASEPATH')) {
    die('Direct access to the script is not allowed');
}

$title .= "Two-Factor Authentication";

if ($_SESSION["msmbilisim_userlogin"] != 1 || $user["client_type"] == 1) {
    header("Location:" . site_url('logout'));
    exit();
}

// Check if 2FA is enabled for the user
if ($user["two_factor"] != 1) {
    header("Location:" . site_url(''));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_provided_code = htmlspecialchars($_POST["2FA_Code"]);
    $query = $conn->prepare("SELECT two_factor_code FROM clients WHERE client_id = ?");
    $query->execute([$_SESSION['msmbilisim_userid']]);
    $stored_code = $query->fetchColumn();

    if ($user_provided_code == $stored_code) {
        // Clear the 2FA code after successful verification
        $update = $conn->prepare("UPDATE clients SET two_factor_code = NULL WHERE client_id = :id");
        $update->execute(array(
            "id" => $_SESSION['msmbilisim_userid']
        ));
        $_SESSION['success'] = "Two-Factor Authentication verified successfully.";
        header("Location: " . site_url('neworder'));
        exit();
    } else {
        $error = 1;
        $errorText = "Invalid verification code.";
    }
} else {
    // Generate and send a new 2FA code if the page is accessed via GET
    $verification_code = rand(100000, 999999); // Generate a random 6-digit code
    $update = $conn->prepare("UPDATE clients SET two_factor_code = :code WHERE client_id = :id");
    $update->execute(array(
        "code" => $verification_code,
        "id" => $_SESSION['msmbilisim_userid']
    ));
    if ($update) {
        // Send verification code to user's email
$to = $user["email"];
$from = $settings["smtp_user"]; 
$fromName = $settings["site_seo"]; 
$replyTo = $settings["admin_mail"];
$subject = "Two-Factor Authentication Code - {$settings['site_name']}";

// HTML Email Content
$message = '
<!DOCTYPE html>
<html>
<head>
    <title>Two-Factor Authentication</title>
    <style>
        /* Importing Inter font from Google Fonts */
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap");

        body { font-family: "Inter", sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .email-container { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); padding: 20px; text-align: center; }
        .email-header { background: #007bff; color: #ffffff; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0; }
        .email-body { padding: 20px; font-size: 16px; color: #333; }
        .verification-code { font-size: 22px; font-weight: bold; color: #007bff; background: #f8f9fa; padding: 10px 20px; display: inline-block; border-radius: 5px; margin: 10px 0; }
        .footer { margin-top: 20px; font-size: 14px; color: #777; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">' . $settings["site_name"] . ' - Two-Factor Authentication</div>
        <div class="email-body">
            <p>Dear ' . $user["username"] . ',</p>
            <p>You have requested a two-factor authentication (2FA) code. Please use the following code to complete your login process:</p>
            <div class="verification-code">' . $verification_code . '</div>
            <p>If you did not request this, please ignore this email or contact support immediately.</p>
            <p>Thank you, <br><strong>' . $settings["site_name"] . ' Team</strong></p>
        </div>
        <div class="footer">
            &copy; ' . date("Y") . ' ' . $settings["site_name"] . '. All rights reserved.
        </div>
    </div>
</body>
</html>';

// Headers for HTML email
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers .= 'From: '.$fromName.' <'.$from.'>' . "\r\n"; 
$headers .= 'Reply-To: '.$replyTo . "\r\n"; 


$telegramusertoken = $settings["telegramusertoken"];
$telegram_message = "Hello {$user['username']},\n\n";
$telegram_message .= "We have received a request for two-factor authentication (2FA) for your account. Please use the following code to complete the login process:\n\n";
$telegram_message .= "{$verification_code}\n\n"; // Ensures the verification code is displayed in a copiable format
$telegram_message .= "If you did not initiate this request, we recommend that you immediately change your account password to secure your account.\n\n";
$telegram_message .= "Best regards,\n{$settings['site_name']} Team";


// Telegram API URL
$telegram_api_url = "https://api.telegram.org/bot$telegramusertoken/sendMessage";

// Send the message to the user’s Telegram chat
$data = [
    'chat_id' => $user["chat_id"],  // Ensure this is the correct chat ID from the user
    'text' => $telegram_message
];

// Use cURL to send the message via Telegram API
$ch = curl_init($telegram_api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_exec($ch);
curl_close($ch);

        if (mail($to, $subject, $message, $headers)) {
            $_SESSION['success'] = "A verification code has been sent to your email.";
        } else {
            $error = 1;
            $errorText = "Failed to send verification code. Please try again.";
        }
    } else {
        $error = 1;
        $errorText = "Failed to generate verification code. Please try again.";
    }
}
?>
<?php
if(!defined('BASEPATH')) {
   die('Direct access to the script is not allowed');
}

// Capture essential details for the Telegram notification
$username = $user["username"]; // Assuming `username` is stored in `$user`
$email = $user["email"];
$logout_date_time = date("Y-m-d H:i:s"); // Current date and time
$ip_address = $_SERVER['REMOTE_ADDR']; // IP address

// Prepare email message
$to = $user["email"]; // User's email address
$from = $settings["smtp_user"]; 
$fromName = $settings["site_seo"]; 
$replyTo = $settings["admin_mail"];
$subject = "Logout Notification - {$settings['site_name']}";
$email_message = "<html><body style='font-family: Inter, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>";
$email_message .= "<div style='max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); padding: 20px; text-align: center;'>";
$email_message .= "<div style='background: #007bff; color: #ffffff; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0;'>";
$email_message .= "{$settings['site_name']} - Logout Notification</div>";
$email_message .= "<div style='padding: 20px; font-size: 16px; color: #333; line-height: 1.6;'>";
$email_message .= "<p>Hello, <strong>{$user['username']}</strong>!</p>";
$email_message .= "<p>We would like to inform you that a logout was performed from your account.</p>";
$email_message .= "<p><strong>Details:</strong></p>";
$email_message .= "<ul style='text-align: left; margin-left: 20px;'>";
$email_message .= "<li><strong>Username:</strong> {$username}</li>";
$email_message .= "<li><strong>Email:</strong> {$email}</li>";
$email_message .= "<li><strong>Date and Time:</strong> {$logout_date_time}</li>";
$email_message .= "<li><strong>IP Address:</strong> {$ip_address}</li>";
$email_message .= "</ul>";
$email_message .= "<p>If this logout was not performed by you, please contact support immediately.</p><br>";
$email_message .= "<p>Best regards,<br><strong>{$settings['site_name']}</strong> Team</p>";
$email_message .= "</div>";
$email_message .= "<div style='margin-top: 20px; font-size: 14px; color: #777;'>";
$email_message .= "&copy; " . date("Y") . " {$settings['site_name']}. All rights reserved.";
$email_message .= "</div>";
$email_message .= "</div>";
$email_message .= "</body></html>";


// Email headers
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
$headers .= 'Reply-To: '.$replyTo . "\r\n";

// Send the email
mail($to, $subject, $email_message, $headers);

// Telegram Notification
$message = "Logout Notification\n\n";
$message .= "Username: $username\n";
$message .= "Email: $email\n";
$message .= "Date and Time: $logout_date_time\n";
$message .= "IP Address: $ip_address\n\n";
$message .= "If this logout was not performed by you, please contact support immediately.\n";
$message .= "\nBest regards,\n{$settings['site_name']} Team";

// Send Telegram Notification
$telegramusertoken = $settings["telegramusertoken"];
$telegram_api_url = "https://api.telegram.org/bot$telegramusertoken/sendMessage";

$data = [
    'chat_id' => $user['chat_id'],  // Ensure this is the correct chat ID
    'text' => $message,
    'parse_mode' => 'HTML' // Optional for better structure if needed
];

$ch = curl_init($telegram_api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_exec($ch);
curl_close($ch);

// Logout process
unset($_SESSION["msmbilisim_userid"]);
unset($_SESSION["msmbilisim_userpass"]);
unset($_SESSION["msmbilisim_userlogin"]);
setcookie("u_id", $user["client_id"], time()-(60*60*24*7), '/', null, null, true );
setcookie("u_password", $user["password"], time()-(60*60*24*7), '/', null, null, true );
setcookie("u_login", 'ok', time()-(60*60*24*7), '/', null, null, true );
setcookie("currency_hash", 'ok', time()-(60*60*24*7), '/', null, null, true );
session_destroy();

// Redirect to home
header("Location: ".site_url(''));
?>

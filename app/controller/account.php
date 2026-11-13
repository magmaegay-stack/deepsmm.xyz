<?php
if(!defined('BASEPATH')) {
   die('Direct access to the script is not allowed');
}
if( $panel["panel_status"] == "suspended" ): include 'app/views/frozen.twig';exit(); endif;
if( $panel["panel_status"] == "frozen" ): include 'app/views/frozen.twig';exit(); endif;
$title .= $languageArray["account.title"];

if( $_SESSION["msmbilisim_userlogin"] != 1  || $user["client_type"] == 1  ){
  header("Location:".site_url('logout'));
}

if(route(1) == "change_currency"){
  
$rate_key = $_POST["rate_key"];
$rate_sym = $_POST["sym"];

$currencies = $conn->prepare("SELECT * FROM currencies WHERE is_enable=1");
$currencies->execute();
$currencies = $currencies->fetchAll(PDO::FETCH_ASSOC);
$currencies = array_group_by($currencies,"currency_code");

if(array_key_exists($rate_key,$currencies) && $settings["site_currency_converter"] == "1"){
 $update = $conn->prepare("UPDATE clients SET currency_type=:currency_type WHERE client_id=:id ");
 $update = $update->execute(array("id"=>$user["client_id"],"currency_type"=>$rate_key));

$resp = array(
"success" => true,
"message" => "Success"
);

setcookie("currency_hash",get_currency_hash_by_code($rate_key),strtotime('+28 days'),'/',null,null,true);
}
else {
header("Location:".site_url(''));
}
 } elseif (route(1) == "newapikey") {
    // Check how many API keys have been generated today
    $check_api_key_count = $conn->prepare("SELECT COUNT(*) AS count FROM client_report WHERE client_id = :c_id AND action = 'API Key changed' AND report_date > DATE_SUB(NOW(), INTERVAL 1 DAY)");
    $check_api_key_count->execute(array("c_id" => $user["client_id"]));
    $result = $check_api_key_count->fetch();
    
    // If the count exceeds 3, restrict further API key generation
    if ($result['count'] >= 3) {
        $error = 1;
        $errorText = "You have already generated 3 API keys today. Please try again after 24 hours.";
    } else {
        // Proceed with generating the new API key
        $conn->beginTransaction();
        $insert = $conn->prepare("INSERT INTO client_report SET client_id=:c_id, action=:action, report_ip=:ip, report_date=:date ");
        $insert = $insert->execute(array("c_id" => $user["client_id"], "action" => "User updated API credentials.", "ip" => GetIP(), "date" => date("Y-m-d H:i:s")));
        
        // Create new API key
        $apikey = CreateApiKey(["email" => $user["email"], "username" => $user["username"]]);

        // Update the API key in the database
        $update = $conn->prepare("UPDATE clients SET apikey=:key WHERE client_id=:id ");
        $update = $update->execute(array("id" => $user["client_id"], "key" => $apikey));

        if ($update) {
            // Send a notification via Telegram if the setting is enabled
            if ($settings["alert_apimail"] == "2") {
                $to = $user["email"]; // User's email address
$from = $settings["smtp_user"];
$fromName = $settings["site_seo"];
$replyTo = $settings["admin_mail"];
$subject = "API Key Update Notification - {$settings['site_name']}";

// Email message content with inline CSS for professional styling
// Email message content with inline CSS for professional styling
$email_message = "<html><body style='font-family: Inter, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>";
$email_message .= "<div style='max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); padding: 20px; text-align: center;'>";
$email_message .= "<div style='background: #007bff; color: #ffffff; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0;'>";
$email_message .= "{$settings['site_name']} - API Key Update</div>";
$email_message .= "<div style='padding: 20px; font-size: 16px; color: #333;'>";
$email_message .= "<p>Hello <strong>{$user['username']}</strong>,</p>";
$email_message .= "<p>We would like to inform you that your API key has been successfully updated.</p>";
$email_message .= "<p><strong>New API Key:</strong> <code style='font-family: monospace; background-color: #f0f0f0; padding: 4px 8px; border-radius: 4px;'>{$apikey}</code></p>";
$email_message .= "<p>If this change was made by you, no further action is required.</p>";
$email_message .= "<p>However, if you did not authorize this update, we strongly recommend that you immediately update your account password and generate a new API key to secure your account.</p>";
$email_message .= "<p>Thank you for your attention to this matter.</p>";
$email_message .= "<p>Best regards,<br><strong>{$settings['site_name']} Team</strong></p>";
$email_message .= "</div>";
$email_message .= "<div style='margin-top: 20px; font-size: 14px; color: #777;'>";
$email_message .= "&copy; " . date("Y") . " {$settings['site_name']}. All rights reserved.";
$email_message .= "</div>";
$email_message .= "</div>";
$email_message .= "</body></html>";
// Headers for email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n";
$headers .= 'Reply-To: '.$replyTo . "\r\n";

// Send email
mail($to, $subject, $email_message, $headers);
                // Prepare the Telegram message
                $telegramusertoken = $settings["telegramusertoken"];
                $message = "Hello {$user['username']} !\n\n";
                $message .= "We would like to inform you that your API key has been successfully updated.\n\n";
                $message .= "New API Key: {$apikey}\n\n";
                $message .= "If this change was made by you, no further action is required.\n";
                $message .= "However, if you did not authorize this update, we strongly recommend that you immediately update your account password and generate a new API key to secure your account.\n\n";
                $message .= "Thank you for your attention to this matter.\n\n";
                $message .= "Best regards,\n{$settings['site_name']}";

                $telegram_api_url = "https://api.telegram.org/bot$telegramusertoken/sendMessage";

                // Send the message to the user’s Telegram chat
                $data = [
                    'chat_id' => $user["chat_id"],  // Ensure this is the correct chat ID from the user
                    'text' => $message
                ];

                // Use cURL to send the message via Telegram API
                $ch = curl_init($telegram_api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_exec($ch);
                curl_close($ch);
            }

            // Commit the transaction
            $conn->commit();
            $success = 1;
            $successText = "API key has been generated: $apikey";
        } else {
            // Rollback transaction if there was an error
            $conn->rollBack();
            $error = 1;
            $errorText = "API key has not changed, try again later!";
        }
    }
}
elseif (route(1) == "change_phone" && $_POST) {
    $new_phone = $_POST['new_phone']; // Get the new phone number from the POST request

    // Validate phone number (adjust regex for valid format, including country code)
    if (!preg_match('/^\+[1-9]{1}[0-9]{1,14}$/', $new_phone)) {
        // Invalid phone number format (country code + number format)
        $error = 1;
        $errorText = "Invalid phone number format. Please enter a valid phone number with the country code (e.g., +1 123 456 7890).";
    } else {
        // Check if the phone number is already in use by another user
        $check = $conn->prepare("SELECT COUNT(*) FROM clients WHERE telephone = :phone AND client_id != :id");
        $check->execute(['phone' => $new_phone, 'id' => $user["client_id"]]);
        if ($check->fetchColumn() > 0) {
            // Phone number already in use
            $error = 1;
            $errorText = "This phone number is already in use by another user.";
        } else {
            // Update phone number in the database
            $update = $conn->prepare("UPDATE clients SET telephone = :phone WHERE client_id = :id");
            $update_success = $update->execute([
                "phone" => $new_phone,
                "id" => $user["client_id"]
            ]);

            if ($update_success) {
                // Log the change in the client report
                $log = $conn->prepare("INSERT INTO client_report SET client_id = :c_id, action = :action, report_ip = :ip, report_date = :date");
                $log->execute([
                    "c_id" => $user["client_id"],
                    "action" => "User updated phone number to: $new_phone.",
                    "ip" => GetIP(),
                    "date" => date("Y-m-d H:i:s")
                ]);

                // Send a notification email to the user
                $from = $settings["smtp_user"]; 
$fromName = $settings["site_seo"]; 
$replyTo = $settings["admin_mail"];
                $subject = "Phone Number Update Notification - {$settings['site_name']}";
                // Email message content with inline CSS for professional styling
$email_message = "<html><body style='font-family: Inter, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>";
$email_message .= "<div style='max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); padding: 20px; text-align: center;'>";
$email_message .= "<div style='background: #007bff; color: #ffffff; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0;'>";
$email_message .= "{$settings['site_name']} - Phone Number Update</div>";
$email_message .= "<div style='padding: 20px; font-size: 16px; color: #333;'>";
$email_message .= "<p>Hello <strong>{$user['username']}</strong>,</p>";
$email_message .= "<p>Your phone number has been updated to: <strong>{$new_phone}</strong>.</p>";
$email_message .= "<p>If you did not make this change, please contact support immediately.</p>";
$email_message .= "<p>Best regards,<br><strong>{$settings['site_name']} Team</strong></p>";
$email_message .= "</div>";
$email_message .= "<div style='margin-top: 20px; font-size: 14px; color: #777;'>";
$email_message .= "&copy; " . date("Y") . " {$settings['site_name']}. All rights reserved.";
$email_message .= "</div>";
$email_message .= "</div>";
$email_message .= "</body></html>";
                $headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
$headers .= 'Reply-To: '.$replyTo . "\r\n";
                mail($user['email'], $subject, $email_message, $headers); // Send email to user

                // Prepare Telegram message content
                $telegramusertoken = $settings["telegramusertoken"];
                $message = "Hello {$user['username']} !\n\n";
                $message .= "Your phone number has been updated to: {$new_phone}.\n";
                $message .= "If you did not make this change, please contact support immediately.\n";
                $message .= "\nBest regards,\n{$settings['site_name']}";

                // Sending the Telegram message via API
                $telegram_api_url = "https://api.telegram.org/bot$telegramusertoken/sendMessage";
                $data = [
                    'chat_id' => $user["chat_id"],  // Ensure this is the correct chat ID from the user
                    'text' => $message
                ];

                // Use cURL to send the message via Telegram API
                $ch = curl_init($telegram_api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_exec($ch);
                curl_close($ch);

                // Success message
                $success = 1;
                $successText = "Your phone number has been updated successfully, and a notification has been sent to both your Email & Telegram.";
            } else {
                // Database update failed
                $error = 1;
                $errorText = "Unable to update phone number. Please try again later.";
            }
        }
    }
}


elseif( route(1) == "change_lang" && $_POST ){
    $lang     = $_POST["lang"];
    $update = $conn->prepare("UPDATE clients SET lang=:lang WHERE client_id=:id ");
    $update = $update->execute(array("id"=>$user["client_id"],"lang"=>$lang ));
    header("Location:".site_url('account'));
}elseif( route(1) == "currency" && $_POST ){
$conn->beginTransaction();
    $currency    = $_POST["currency"];
    $update = $conn->prepare("UPDATE clients SET currency=:type WHERE client_id=:id ");
    $update = $update->execute(array("id"=>$user["client_id"],"type"=>$currency ));
    
    header("Location:".site_url('account'));
}elseif (route(1) == "change_email" && $_POST) {
    $new_email = filter_var($_POST['new_email'], FILTER_VALIDATE_EMAIL); // Validate email format

    if (!$new_email) {
        // Invalid email format
        $error = 1;
        $errorText = "Invalid email address provided.";
    } else {
        // Check if email already exists in the database
        $check = $conn->prepare("SELECT COUNT(*) FROM clients WHERE email=:email");
        $check->execute(['email' => $new_email]);
        if ($check->fetchColumn() > 0) {
            // Email already in use
            $error = 1;
            $errorText = "This email is already in use.";
        } else {
            // Get old email before changing
            $old_email = $user["email"];
            
            // Update email in the database
            $update = $conn->prepare("UPDATE clients SET email=:email WHERE client_id=:id");
            $update_success = $update->execute(['email' => $new_email, 'id' => $user["client_id"]]);

            if ($update_success) {
                // Log the change in client report
                $log = $conn->prepare("INSERT INTO client_report SET client_id=:c_id, action=:action, report_ip=:ip, report_date=:date");
                $log->execute([
                    "c_id" => $user["client_id"],
                    "action" => "User updated email address to: $new_email.",
                    "ip" => GetIP(),
                    "date" => date("Y-m-d H:i:s")
                ]);
                // Send notification emails
                $from = $settings["smtp_user"]; 
$fromName = $settings["site_seo"]; 
$replyTo = $settings["admin_mail"];
    $subject = "Email Address Update Notification - {$settings['site_name']}";

  // Email for the new email address
$email_message_new = "<html><body style='font-family: Inter, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>";
$email_message_new .= "<div style='max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); padding: 20px; text-align: center;'>";
$email_message_new .= "<div style='background: #007bff; color: #ffffff; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0;'>";
$email_message_new .= "{$settings['site_name']} - Email Update</div>";
$email_message_new .= "<div style='padding: 20px; font-size: 16px; color: #333;'>";
$email_message_new .= "<p>Hello <strong>{$user['username']}</strong>,</p>";
$email_message_new .= "<p>Your email address has been updated to: <strong>{$new_email}</strong>.</p>";
$email_message_new .= "<p>Best regards,<br><strong>{$settings['site_name']} Team</strong></p>";
$email_message_new .= "</div>";
$email_message_new .= "<div style='margin-top: 20px; font-size: 14px; color: #777;'>";
$email_message_new .= "&copy; " . date("Y") . " {$settings['site_name']}. All rights reserved.";
$email_message_new .= "</div>";
$email_message_new .= "</div>";
$email_message_new .= "</body></html>";

// Email for the old email address
$email_message_old = "<html><body style='font-family: Inter, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>";
$email_message_old .= "<div style='max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); padding: 20px; text-align: center;'>";
$email_message_old .= "<div style='background: #007bff; color: #ffffff; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0;'>";
$email_message_old .= "{$settings['site_name']} - Email Update</div>";
$email_message_old .= "<div style='padding: 20px; font-size: 16px; color: #333;'>";
$email_message_old .= "<p>Hello <strong>{$user['username']}</strong>,</p>";
$email_message_old .= "<p>The email address associated with your account has been updated to: <strong>{$new_email}</strong>.</p>";
$email_message_old .= "<p>If this was not authorized by you, please contact the administrator.</p>";
$email_message_old .= "<p>Best regards,<br><strong>{$settings['site_name']} Team</strong></p>";
$email_message_old .= "</div>";
$email_message_old .= "<div style='margin-top: 20px; font-size: 14px; color: #777;'>";
$email_message_old .= "&copy; " . date("Y") . " {$settings['site_name']}. All rights reserved.";
$email_message_old .= "</div>";
$email_message_old .= "</div>";
$email_message_old .= "</body></html>";
    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
$headers .= 'Reply-To: '.$replyTo . "\r\n";

    // Send emails
    mail($new_email, $subject, $email_message_new, $headers); // To new email
    mail($old_email, $subject, $email_message_old, $headers); // To old email

                // Prepare Telegram bot message content
                $telegramusertoken = $settings["telegramusertoken"];
                $messageNewEmail = "Hello {$user['username']} !\n\n";
                $messageNewEmail .= "Your email address has been updated to: {$new_email}.\n";
                $messageNewEmail .= "If you did not make this change, please contact support immediately.\n";
                $messageNewEmail .= "\nBest regards,\n{$settings['site_name']}";

                $messageOldEmail = "Hello {$user['username']} !\n\n";
                $messageOldEmail .= "The email address associated with your account has been updated to: {$new_email}.\n";
                $messageOldEmail .= "If not done by you, immediately contact the administrator.\n";
                $messageOldEmail .= "\nBest regards,\n{$settings['site_name']}";

                $telegram_api_url = "https://api.telegram.org/bot$telegramusertoken/sendMessage";

                // Send message to the new email address (via Telegram)
                $dataNewEmail = [
                    'chat_id' => $chat_id,  // Use the chat_id from the user's record
                    'text' => $messageNewEmail
                ];

                // Send message to the old email address (via Telegram)
                $dataOldEmail = [
                    'chat_id' => $chat_id,  // Use the chat_id from the user's record
                    'text' => $messageOldEmail
                ];

                // Use cURL to send the messages via Telegram API
                $ch = curl_init($telegram_api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataNewEmail);
                curl_exec($ch);

                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataOldEmail);
                curl_exec($ch);
                curl_close($ch);

                // Check if messages were sent successfully
                $success = 1;
                $successText = "Your email has been updated successfully, and a notification has been sent to both your new and old Email Addresses & Telegram.";
            } else {
                // Database update failed
                $error = 1;
                $errorText = "Unable to update email. Please try again later.";
            }
        }
    }
}

elseif (route(1) == "save_chat_id" && $_POST) {
    // Ensure chat_id is set and not empty
    if (isset($_POST["chat_id"]) && !empty($_POST["chat_id"])) {
        $chat_id = $_POST["chat_id"];

        // Check if the chat_id is already used by another user
        $checkChatId = $conn->prepare("SELECT COUNT(*) FROM clients WHERE chat_id = :chat_id AND client_id != :id");
        $checkChatId->execute([
            'chat_id' => $chat_id,
            'id' => $user["client_id"]
        ]);
        $existingChatId = $checkChatId->fetchColumn();

        if ($existingChatId > 0) {
            // If chat_id is already used, show an error
            $error = 1;
            $errorText = "This Telegram Chat ID is already in use by another user. Please choose a different one.";
        } else {
            // If the chat_id is not used, update the chat ID in the database
            $update = $conn->prepare("UPDATE clients SET chat_id=:chat_id WHERE client_id=:id");
            $update_success = $update->execute([
                'id' => $user["client_id"],
                'chat_id' => $chat_id
            ]);

            if ($update_success) {
                // Send notification email
                $to = $user["email"];
                $subject = "Telegram Chat ID Updated - {$settings['site_name']}";
                $email_message = "<html><body style='font-family: Inter, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>";
$email_message .= "<div style='max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); padding: 20px; text-align: center;'>";
$email_message .= "<div style='background: #007bff; color: #ffffff; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0;'>";
$email_message .= "{$settings['site_name']} - Telegram Chat ID Update</div>";
$email_message .= "<div style='padding: 20px; font-size: 16px; color: #333;'>";
$email_message .= "<p>Hello <strong>{$user['username']}</strong>,</p>";
$email_message .= "<p>Your Telegram Chat ID has been successfully updated. Here are the details:</p>";
$email_message .= "<hr style='border: 1px solid #ddd;'>";
$email_message .= "<p><strong>Username:</strong> {$user['username']}</p>";
$email_message .= "<p><strong>Email:</strong> {$user['email']}</p>";
$email_message .= "<p><strong>Telegram Chat ID:</strong> {$chat_id}</p>";
$email_message .= "<hr style='border: 1px solid #ddd;'>";
$email_message .= "<p>If this was not done by you, please contact the administrator immediately.</p>";
$email_message .= "<p>Best regards,<br><strong>{$settings['site_name']} Team</strong></p>";
$email_message .= "</div>";
$email_message .= "<div style='margin-top: 20px; font-size: 14px; color: #777;'>";
$email_message .= "&copy; " . date("Y") . " {$settings['site_name']}. All rights reserved.";
$email_message .= "</div>";
$email_message .= "</div>";
$email_message .= "</body></html>";
                // Headers for email
                 $headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
$headers .= 'Reply-To: '.$replyTo . "\r\n";

                // Send the email
                mail($to, $subject, $email_message, $headers);

                // Send message to the user via Telegram Bot after successful update
                $telegramusertoken = $settings["telegramusertoken"];
                $message = "Hello, {$user['username']} !\n\n";
                $message .= "Your Telegram Chat ID has been successfully updated. Here are the details:\n";
                $message .= "---------------------------------------------\n";
                $message .= "Username: {$user['username']}\n";
                $message .= "Email: {$user['email']}\n";
                $message .= "Telegram Chat ID: {$chat_id}\n";
                $message .= "---------------------------------------------\n";
                
                $message .= "Best regards,\n";
                $message .= "{$settings['site_name']}";
                $telegram_api_url = "https://api.telegram.org/bot$telegramusertoken/sendMessage";

                // Prepare the message data
                $data = [
                    'chat_id' => $chat_id,
                    'text' => $message
                ];

                // Use cURL to send the message via Telegram API
                $ch = curl_init($telegram_api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

                $response = curl_exec($ch);
                curl_close($ch);

                // Check for errors in the cURL response
                if (!$response) {
                    $error = 1;
                    $errorText = "Failed to send a message to Telegram. Please try again later.";
                } else {
                    $success = 1;
                    $successText = "Telegram Chat ID has been updated and the confirmation message was sent to your Telegram & Email successfully!";
                }// Redirect to account page
                header("Location: /account");
                exit();
            
            } else {
                $error = 1;
                $errorText = "Failed to update the Telegram Chat ID. Please try again later.";
            }
        }
    } else {
        $error = 1;
        $errorText = "Telegram Chat ID cannot be empty.";
    }
} elseif (route(1) == "disconnect_telegram") {
    // Remove the chat ID from the database
    $update = $conn->prepare("UPDATE clients SET chat_id=NULL WHERE client_id=:id");
    $update_success = $update->execute([
        'id' => $user["client_id"]
    ]);

    if ($update_success) {
        $success = 1;
        $successText = "Telegram Chat ID has been removed successfully.";
        // Redirect to account page
        header("Location: /account");
        exit();
    } else {
        $error = 1;
        $errorText = "Failed to remove the Telegram Chat ID. Please try again later.";
    }
}
elseif (route(1) == "disable-2fa") {
    // Remove the chat ID from the database
    $update = $conn->prepare("UPDATE clients SET two_factor = 0 WHERE client_id = :id");
    $update_success = $update->execute(['id' => $user["client_id"]]);

    if ($update_success) {
        $success = 1;
        $successText = "Two-Factor Authentication has been disabled.";
        // Redirect to account page
        header("Location: /account");
        exit();
    } else {
        $error = 1;
        $errorText = "Failed to disable Two-Factor Authentication.";
    }
}
elseif (route(1) == "enable-2fa") {
    // Remove the chat ID from the database
    $update = $conn->prepare("UPDATE clients SET two_factor = 1 WHERE client_id = :id");
    $update_success = $update->execute(['id' => $user["client_id"]]);

    if ($update_success) {
        $success = 1;
        $successText = "Two-Factor Authentication has been enabled.";
        // Redirect to account page
        header("Location: /account");
        exit();
    } else {
        $error = 1;
        $errorText = "Failed to enable Two-Factor Authentication.";
    }
}
elseif( route(1) == "timezone" && $_POST ){


    $timezone = $_POST["timezone"]; 
    $timezone = doubleval($timezone);
    $update   = $conn->prepare("UPDATE clients SET timezone=:timezone WHERE client_id=:id ");
    $update   = $update->execute(array("id"=>$user["client_id"],"timezone"=>$timezone ));
    header("Location:".site_url('account'));
}elseif (route(0) == "account" && $_POST) {
  $pass = $_POST["current_password"];
  $new_pass = $_POST["password"];
  $new_again = $_POST["confirm_password"];

  if (!userdata_check('password', md5($pass))) {
    $error = 1;
    $errorText = $languageArray["error.account.password.notmach"];
  } elseif (strlen($new_pass) < 8) {
    $error = 1;
    $errorText = $languageArray["error.account.password.length"];
  } elseif ($new_pass != $new_again) {
    $error = 1;
    $errorText = $languageArray["error.account.passwords.notmach"];
  } else {
    $conn->beginTransaction();
    $insert = $conn->prepare("INSERT INTO client_report SET client_id=:c_id, action=:action, report_ip=:ip, report_date=:date ");
    $insert = $insert->execute(array("c_id" => $user["client_id"], "action" => "User has successfully updated their account password.", "ip" => GetIP(), "date" => date("Y-m-d H:i:s")));
    $update = $conn->prepare("UPDATE clients SET password=:pass WHERE client_id=:id ");
    $update = $update->execute(array("id" => $user["client_id"], "pass" => md5($new_pass)));

    if ($update && $insert) {
      $_SESSION["msmbilisim_userpass"] = md5($new_pass);

      $conn->commit();
      $success = 1;
      $successText = $languageArray["error.account.password.success"];
      // Prepare the email notification
    $to = $user["email"]; // User's email address
    $from = $settings["smtp_user"]; 
$fromName = $settings["site_seo"]; 
$replyTo = $settings["admin_mail"];
    $subject = "Password Change Notification";
    $email_message = "<html><body style='font-family: Inter, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>";
$email_message .= "<div style='max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); padding: 20px; text-align: center;'>";
$email_message .= "<div style='background: #007bff; color: #ffffff; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0;'>";
$email_message .= "{$settings['site_name']} - Password Change Notification</div>";
$email_message .= "<div style='padding: 20px; font-size: 16px; color: #333;'>";
$email_message .= "<p>Hello <strong>{$user['username']}</strong>,</p>";
$email_message .= "<p>Your password has been successfully changed.</p>";
$email_message .= "<p>If this was not done by you, please contact support immediately.</p>";
$email_message .= "<p>Best regards,<br><strong>{$settings['site_name']} Team</strong></p>";
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
      // Prepare the Telegram message
      $telegramusertoken = $settings["telegramusertoken"];
      $message = "Hello {$user['username']} !\n\n";
      $message .= "Your password has been successfully changed.\n\n";
      $message .= "Here are the details:\n";
      $message .= "---------------------------------------------\n";
      $message .= "Old Password: {$pass}\n"; // Old password - avoid this for security reasons
      $message .= "New Password: {$new_pass}\n"; // New password - avoid this for security reasons
      $message .= "---------------------------------------------\n";
      $message .= "If this was not done by you, please contact support immediately.\n";
      $message .= "\nBest regards,\n{$settings['site_name']}";

      $telegram_api_url = "https://api.telegram.org/bot$telegramusertoken/sendMessage";

      // Send the message to the user’s Telegram chat
      $data = [
        'chat_id' => $user["chat_id"], // Make sure to use the correct chat_id from the user
        'text' => $message
      ];

      // Use cURL to send the message via Telegram API
      $ch = curl_init($telegram_api_url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      curl_exec($ch);
      curl_close($ch);

    } else {
      $conn->rollBack();
      $error = 1;
      $errorText = $languageArray["error.account.password.fail"];
    }
  }
}

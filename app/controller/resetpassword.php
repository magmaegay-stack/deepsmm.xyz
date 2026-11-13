<?php

 
$title .= $languageArray["resetpassword.title"];

if( $_SESSION["msmbilisim_userlogin"] == 1  || $user["client_type"] == 1 || $settings["resetpass_page"] == 1  ){
  Header("Location:".site_url());
}

if( !route(1) ){

if( $_POST ):

  $captcha        = $_POST['g-recaptcha-response'];
  $googlesecret   = $settings["recaptcha_secret"];
  $captcha_control= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$googlesecret&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
  $captcha_control= json_decode($captcha_control);
  $user = $_POST["user"];
  $type = $_POST["type"];
$row= $conn->prepare("SELECT * FROM clients WHERE username=:email ");
    $row->execute(array("email"=>$user));
    $row= $conn->prepare("SELECT * FROM clients WHERE email=:email ");
    $row->execute(array("email"=>$user));
    if( empty($user) ):
      $error      = 1;
      $errorText  = $languageArray["error.resetpassword.user.empty"];
    elseif( !$row->rowCount() ):
      $error      = 1;
      $errorText  = $languageArray["error.resetpassword.user.notmatch"];
    elseif( $settings["recaptcha"] == 2 && $captcha_control->success == false ):
      $error      = 1;
      $errorText  = $languageArray["error.resetpassword.recaptcha"];

    else:
      $row    = $row->fetch(PDO::FETCH_ASSOC);
      $token   = md5($row["email"].$row["username"].rand(9999,2324332));
      $update = $conn->prepare("UPDATE clients SET passwordreset_token=:pass WHERE client_id=:id ");
      $update->execute(array("id"=>$row["client_id"],"pass"=> $token ));
      
      // Prepare email message
$to = $row["email"]; // User's email address
$from = $settings["smtp_user"]; 
$fromName = $settings["site_seo"]; 
$replyTo = $settings["admin_mail"];
$subject = "Password Reset Request - {$settings['site_name']}";
$email_message = "<html><body style='font-family: Inter, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>";
$email_message .= "<div style='max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); padding: 20px; text-align: center;'>";
$email_message .= "<div style='background: #007bff; color: #ffffff; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0;'>";
$email_message .= "{$settings['site_name']} - Password Reset Request</div>";
$email_message .= "<div style='padding: 20px; font-size: 16px; color: #333; line-height: 1.6;'>";
$email_message .= "<p>Hello, <strong>{$row['username']}</strong>!</p>";
$email_message .= "<p>We received a request to reset your password. To proceed, please click the link below:</p>";
$email_message .= "<p><strong>Reset Link:</strong> <a href='" . site_url() . "resetpassword/$token' style='color: #007bff; text-decoration: none;'>" . site_url() . "resetpassword/$token</a></p>";
$email_message .= "<p>If this was not done by you, please contact support immediately.</p><br>";
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
    // Telegram Notification using cURL
            $telegramusertoken = $settings["telegramusertoken"]; // Telegram bot token
            $message = "Hello {$row['username']} !\n\n";
            $message .= "We received a request to reset your password. To proceed, please click the link below:\n";
            $message .= "---------------------------------------------\n";
            $message .= "Reset Link: " . site_url() . "resetpassword/$token\n";
            $message .= "---------------------------------------------\n";
            $message .= "If this was not done by you, please contact support immediately.\n";
            $message .= "\nBest regards,\n{$settings['site_name']} Team";

            // Telegram API URL to send the message
            $telegram_api_url = "https://api.telegram.org/bot$telegramusertoken/sendMessage";

            // Send the message to the user’s Telegram chat
            $data = [
                'chat_id' => $row["chat_id"], // Ensure correct chat_id
                'text' => $message
            ];

            // Use cURL to send the message via Telegram API
            $ch = curl_init($telegram_api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_exec($ch);
            curl_close($ch);

  // Success handling
            $success = 1;
            $successText = "Check your telegram & email for a link to reset your password. If it doesn't appear, contact administrator.";
            echo '<script>setTimeout(function(){window.location="' . site_url() . '"},2000)</script>';
        


    endif;

endif;
} else {
$templateDir  = "setnewpassword";
$passwordreset_token = route(1);
$user = $conn->prepare("SELECT * FROM clients WHERE passwordreset_token=:id");
$user->execute(array("id"=> route(1) ));
$user = $user->fetch(PDO::FETCH_ASSOC);

$client= $conn->prepare("SELECT * FROM clients WHERE passwordreset_token=:email ");
    $client->execute(array("email"=>$passwordreset_token));
 
if( !$client->rowCount() ):
Header("Location:".site_url(resetpassword));
endif;
if( $_POST ):
$pass = $_POST["password"];

  $again = $_POST["password_again"];
$passwordreset_token = route(1);
if($pass != $again):
$error      = 1;
      $errorText  = "Passwords not matched";
else:
$update = $conn->prepare("UPDATE clients SET password=:pass, passwordreset_token=:token WHERE client_id=:id ");
      $update->execute(array("id"=> $user["client_id"],"token" => "" ,"pass"=> md5($pass) ));

if( $update ):
    // Email message content
    $to = $user["email"]; // User's email address
    $from = $settings["smtp_user"]; 
$fromName = $settings["site_seo"]; 
$replyTo = $settings["admin_mail"];
    $subject = "Password Change Notification - {$settings['site_name']}";
    $email_message = "Hello {$user['username']}!<br><br>";
    $email_message .= "Your password has been successfully changed. Here are the details:<br><br>";
    $email_message .= "<strong>New Password:</strong> {$pass}<br><br>"; // Only show new password
    $email_message .= "If this change was not done by you, please contact support immediately.<br><br>";
    $email_message .= "Best regards,<br>{$settings['site_name']}";

    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
$headers .= 'Reply-To: '.$replyTo . "\r\n";


    // Send the email
    mail($to, $subject, $email_message, $headers);
    $telegramusertoken = $settings["telegramusertoken"];
      $message = "Hello {$user['username']} !\n\n";
      $message .= "Your password has been successfully changed.\n\n";
      $message .= "Here are the details:\n";
      $message .= "---------------------------------------------\n";
      $message .= "New Password: {$pass}\n"; // Old password - avoid this for security reasons
      $message .= "---------------------------------------------\n";
      $message .= "If this was not done by you, please contact support immediately.\n";
      $message .= "\nBest regards,\n{$settings['site_name']} Team";

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

        $success    = 1;
        $successText= "Successfully Changed";
        echo '<script>setTimeout(function(){window.location="'.site_url().'"},2000)</script>';
      else:
        $error      = 1;
        $errorText  = $languageArray["error.resetpassword.fail"];
      endif;


    endif;
endif;
    
      




} 


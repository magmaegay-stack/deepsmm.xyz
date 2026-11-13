<?php
if(!defined('BASEPATH')) {
   die('Direct access to the script is not allowed');
}
$client = $conn->prepare("SELECT * FROM clients WHERE client_id=:id");
$client->execute(["id"=>$_SESSION['msmbilisim_userid']]);
$client = $client->fetchAll(PDO::FETCH_ASSOC);
$client = $client[0];

if( $_POST && $_POST["username"] ):
    foreach ($_POST as $key => $value):
        $_SESSION["data"][$key]  = $value;
    endforeach;


    $receiver_username = htmlspecialchars($_POST["username"]);
    $amount= htmlentities($_POST["amount"]);


    $fees = $conn->prepare("SELECT fundstransfer_fees FROM settings");
    $fees->execute([]);
    $fees = $fees->fetchAll(PDO::FETCH_ASSOC);
    $fees = $fees[0]['fundstransfer_fees'];

    if( !is_numeric($amount) OR !($amount > 0)){
        $error    = 1;
        $errorText= $languageArray["transferfunds.bank.amountNotNumeric"];
    }elseif( $client['balance'] < $amount ){
        $error    = 1;
        $errorText= $languageArray["transferfunds.bank.enoughBalance"];
    }else{
        $receiver = $conn->prepare("SELECT * FROM clients WHERE username=:username && client_id !=:id");
        $receiver->execute(["username"=>$receiver_username, "id"=>$_SESSION['msmbilisim_userid']]);
        $receiver = $receiver->fetchAll(PDO::FETCH_ASSOC);
        $receiver = $receiver[0];
        $receiver_id = $receiver['client_id'];
        
        if(count($receiver) == 0){
            $error    = 1;
            $errorText= $languageArray["transferfunds.bank.usernameNotFound"];
        }else{

            $afterFees = $amount - $amount * $fees / 100;
            
            $exec = $conn->prepare("UPDATE clients SET balance = balance - $amount WHERE client_id=:id");
            $exec->execute(["id"=>$client['client_id']]);
            $exec = $exec->fetchAll(PDO::FETCH_ASSOC);

    
            $exec = $conn->prepare("UPDATE clients SET balance = balance + $afterFees WHERE client_id=:id");
            $exec->execute(["id"=>$receiver_id]);
            $exec = $exec->fetchAll(PDO::FETCH_ASSOC);

            // sender
            
            
            $insert = $conn->prepare("INSERT INTO payments SET payment_status=:status, payment_mode=:mode, payment_amount=:amount, payment_bank=:bank, payment_method=:method, payment_delivery=:delivery, payment_note=:note, payment_update_date=:date, payment_create_date=:date2, client_id=:client_id, client_balance=:balance ");
            $insert = $insert->execute(array("status"=>3,"delivery"=>2,"bank"=>0,"mode"=>"Manuel","amount"=>$amount*-1,"method"=>103,"note"=>"Funds transferred to ".$receiver_username." successfully.","date"=>date("Y-m-d H:i:s"),"date2"=>date("Y-m-d H:i:s"),"balance"=>$client['balance'],"client_id"=>$client["client_id"] ));


            // receiver
            
            
            $insert2 = $conn->prepare("INSERT INTO payments SET payment_status=:status, payment_mode=:mode, payment_amount=:amount, payment_bank=:bank, payment_method=:method, payment_delivery=:delivery, payment_note=:note, payment_update_date=:date, payment_create_date=:date2, client_id=:client_id, client_balance=:balance ");
            $insert2 = $insert2->execute(array("status"=>3,"delivery"=>2,"bank"=>0,"mode"=>"Manuel","amount"=>$afterFees,"method"=>103,"note"=>"Funds transferred from ".$client['username']." successfully.","date"=>date("Y-m-d H:i:s"),"date2"=>date("Y-m-d H:i:s"),"balance"=>$receiver['balance'],"client_id"=>$receiver["client_id"] ));
              // Prepare the email content
$to = $receiver['email']; // Receiver's email address
$from = $settings["smtp_user"]; 
$fromName = $settings["site_seo"]; 
$replyTo = $settings["admin_mail"];
$subject = "Fund Transfer Successful! - {$settings['site_name']}";
$email_message = "<html><body style='font-family: Inter, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>";
$email_message .= "<div style='max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); padding: 20px; text-align: center;'>";
$email_message .= "<div style='background: #007bff; color: #ffffff; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0;'>";
$email_message .= "Wallet Transfer Notification</div>";
$email_message .= "<div style='padding: 20px; font-size: 16px; color: #333; line-height: 1.6;'>";
$email_message .= "<p>Hello, <strong>{$receiver_username}</strong>!</p>";
$email_message .= "<p>You have received a wallet transfer from <strong>{$client['username']}</strong>.</p>";
$email_message .= "<p><strong>Amount Received:</strong> {$afterFees}</p>";
$email_message .= "<p>You can log in to your account to check your updated balance:</p>";
$email_message .= "<p><a href='" . site_url() . "login' style='background: #007bff; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px; display: inline-block;'>Log in to Your Account</a></p>";
$email_message .= "<br><p>Thank you for using our services!</p>";
$email_message .= "<br><p>Best regards,<br><strong>{$settings['site_name']}</strong> Team</p>";
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
             // Telegram notification to receiver
            $telegramusertoken = $settings["telegramusertoken"];
            $usermessage = "Hello, $receiver_username !\n\n";
            $usermessage .= "{$client['username']} has successfully transferred {$afterFees} to your wallet.\n\n";
            $usermessage .= "Funds have been successfully received. You can log in to your account to view the updated balance.\n";
            $usermessage .= site_url() . "login\n\nThank you!\n";
            $usermessage .= "\nBest regards,\n{$settings['site_name']}Team";
            
            // Sending Telegram notification
            $data_user = [
                'chat_id' => $receiver['chat_id'],
                'text' => $usermessage
            ];
            
            $telegram_api_url = "https://api.telegram.org/bot$telegramusertoken/sendMessage";
            $ch = curl_init($telegram_api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_user);
            curl_exec($ch);
            curl_close($ch);
            
            $success = 1;
            $successText = str_replace("{name}",$receiver_username, $languageArray["transferfunds.bank.done"]);
        }

    }

endif;

if( $payment_url ):
    echo '<script>setTimeout(function(){window.location="'.$payment_url.'"},1000)</script>';
endif;
 
<?php
if(!defined('BASEPATH')) {
   die('Direct access to the script is not allowed');
}

$title .= "Coupon Code";

if( $_SESSION["msmbilisim_userlogin"] != 1  || $user["client_type"] == 1  ){
  header("Location:".site_url('logout'));
}
if( $settings["email_confirmation"] == 1  && $user["email_type"] == 1  ){
  header("Location:".site_url('confirm_email'));
}
if( !route(1) ){

  if( $_POST ){
    foreach ($_POST as $key => $value) {
      $_SESSION["data"][$key]  = $value;
    }
	
    $kuponadi  = $_POST["kuponadi"];
	
    if( empty($kuponadi) ){
        $error    = 1;
        $errorText= "Please fill in all fields.";
    } else {
		$varmi = $conn->prepare("SELECT count(*) as toplam FROM kuponlar WHERE kuponadi = ?");
		$varmi->execute([$kuponadi]);
		$count = $varmi->fetch(PDO::FETCH_ASSOC);
		
		if($count["toplam"] > 0){
			$kuponal = $conn->prepare("SELECT * FROM kuponlar WHERE kuponadi = ?");
			$kuponal->execute([$kuponadi]);
			$kuponal = $kuponal->fetch(PDO::FETCH_ASSOC);
			
			if($kuponal["adet"] > 0){
				$kullanmismi = $conn->prepare("SELECT * FROM kupon_kullananlar WHERE uye_id=:uye_id AND kuponadi=:kuponadi");
				$kullanmismi->execute(array("uye_id" => $user["client_id"], "kuponadi" => $kuponal["kuponadi"]));
				$kullanmismi = $kullanmismi->fetch(PDO::FETCH_ASSOC);
				
				if($kullanmismi > 0){
					$error    = 1;
					$errorText= "You have already used this coupon.";
				} else {
					$uyebakiye = $conn->prepare("SELECT * FROM clients WHERE client_id=:client_id");
					$uyebakiye->execute(array("client_id" => $user["client_id"]));
					$uyebakiye = $uyebakiye->fetch(PDO::FETCH_ASSOC);
					$uyebakiyesi = $uyebakiye["balance"];
					
					$yenibakiye = $kuponal["tutar"] + $uyebakiyesi;
					
					$conn->beginTransaction();
					$bakiyeguncelle = $conn->prepare("UPDATE clients SET balance=:balances WHERE client_id=:c_id");
					$bakiyeguncelle->execute(array("c_id" => $user["client_id"], "balances" => $yenibakiye));
					
					$adetdusur = $conn->prepare("UPDATE kuponlar SET adet=adet-1 WHERE id=:kupon_id");
					$adetdusur->execute(array("kupon_id" => $kuponal["id"]));
					
					$kullanildi = $conn->prepare("INSERT INTO kupon_kullananlar SET uye_id=:uye_id, kuponadi=:kuponadi, tutar=:tutar");
					$kullanildi->execute(array("uye_id" => $user["client_id"], "kuponadi" => $kuponal["kuponadi"], "tutar" => $kuponal["tutar"]));
					
					$conn->commit();
					
					$success    = 1;
					$successText= "The coupon equivalent has been added to your balance. Thanks.";
					// Prepare email message
$to = $user["email"]; // User's email address
$from = $settings["smtp_user"]; 
$fromName = $settings["site_seo"]; 
$replyTo = $settings["admin_mail"];
$subject = "Coupon Redeemed Successfully - {$settings['site_name']}";
$email_message = "<html><body style='font-family: Inter, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>";
$email_message .= "<div style='max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); padding: 20px; text-align: center;'>";
$email_message .= "<div style='background: #007bff; color: #ffffff; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0;'>";
$email_message .= "{$settings['site_name']} - Coupon Redeemed</div>";
$email_message .= "<div style='padding: 20px; font-size: 16px; color: #333; line-height: 1.6;'>";
$email_message .= "<p>Hello, <strong>{$user['name']}</strong>!</p>";
$email_message .= "<p>Your coupon code <strong>\"{$kuponal['kuponadi']}\"</strong> has been successfully redeemed.</p>";
$email_message .= "<p>Amount added: <strong>{$kuponal['tutar']}</strong></p>";
$email_message .= "<p>Your new balance is: <strong>{$yenibakiye}</strong></p><br>";
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
					$message = "Hello, " . $user["name"] . "!\n\n";
					$message .= "Your coupon code \"" . $kuponal["kuponadi"] . "\" has been successfully redeemed.\n";
					$message .= "Amount added: " . $kuponal["tutar"] . "\n";
					$message .= "Your new balance is: " . $yenibakiye . "\n\n";
					$message .= "\nBest regards,\n{$settings['site_name']}";
					
					$telegramusertoken = $settings["telegramusertoken"];
					$telegram_api_url = "https://api.telegram.org/bot$telegramusertoken/sendMessage";
					
					$data = [
						'chat_id' => $user['chat_id'],  // Ensure this is the correct chat ID
						'text' => $message
					];
					
					$ch = curl_init($telegram_api_url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
					curl_exec($ch);
					curl_close($ch);
				}
			} else {
				$error    = 1;
				$errorText= "This coupon has expired.";
			}
		} else {
		  $error    = 1;
          $errorText= "No coupon found.";
		}
    }
  }
} elseif( route(1) && preg_replace('/[^a-zA-Z]/', '', route(1))  ){
  header('Location:'.site_url('404'));
}
?>

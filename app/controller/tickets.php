<?php
if(!defined('BASEPATH')) {
   die('Direct access to the script is not allowed');
}
$title .= $languageArray["tickets.title"];

if( $_SESSION["msmbilisim_userlogin"] != 1  || $user["client_type"] == 1  ){
  Header("Location:".site_url('logout'));
}

if( $settings["email_confirmation"] == 1  && $user["email_type"] == 1  ){
  Header("Location:".site_url('confirm_email'));
}

if( !route(1) ){

  // Get available ticket subjects
  $orders = $conn->prepare("SELECT * FROM ticket_subjects ORDER BY subject_id ASC");
  $orders-> execute(array());
  $orders = $orders->fetchAll(PDO::FETCH_ASSOC);

  $ordersList = [];

  foreach ($orders as $order) {
    $o["subject"] = $order["subject"];
    array_push($ordersList, $o);
  }

  // Get user's tickets
  $tickets = $conn->prepare("SELECT * FROM tickets WHERE client_id=:c_id ORDER BY lastupdate_time DESC ");
  $tickets-> execute(array("c_id"=>$user["client_id"]));
  $tickets = $tickets->fetchAll(PDO::FETCH_ASSOC);
  $ticketList = [];
  foreach ($tickets as $ticket) {
    foreach ($ticket as $key => $value) {
      if( $key == "status" ){
        $t[$key] = $languageArray["tickets.status.".$value];
      }else{
        $t[$key] = $value;
      }
    }
    array_push($ticketList,$t);
  }

  // Handle ticket creation
  if( $_POST ){
    foreach ($_POST as $key => $value) {
      $_SESSION["data"][$key]  = $value;
    }
    $subject  = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
    $subject  = strip_tags(htmlspecialchars($subject));
    $message  = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    $message  = strip_tags(htmlspecialchars($message));
    
    // Validation
    if( empty($subject) ){
      $error    = 1;
      $errorText= $languageArray["error.tickets.new.subject"];
    } elseif( strlen(str_replace(' ','',$message)) < 1 ){
      $error    = 1;
      $errorText= str_replace("{length}","1",$languageArray["error.tickets.new.message.length"]);
    } elseif( open_ticket($user["client_id"]) >=  $settings["tickets_per_user"] ){
      $error    = 1;
      $errorText= str_replace("{limit}",$settings["tickets_per_user"],$languageArray["error.tickets.new.limit"]);
    } else {
      // Insert new ticket
      $conn->beginTransaction();
      $insert = $conn->prepare("INSERT INTO tickets SET client_id=:c_id, subject=:subject, time=:time, lastupdate_time=:last_time ");
      $insert-> execute(array("c_id"=>$user["client_id"],"subject"=>$subject,"time"=>date("Y.m.d H:i:s"),"last_time"=>date("Y.m.d H:i:s") ));
      if( $insert ){ 
        $ticket_id = $conn->lastInsertId(); 
      }

      // Insert ticket message
      $insert2 = $conn->prepare("INSERT INTO ticket_reply SET ticket_id=:t_id, client_id=:c_id, support_team=:st, message=:message, time=:time ");
      $insert2-> execute(array("t_id"=>$ticket_id,"c_id"=>$user["client_id"],"st"=>"","message"=>$message,"time"=>date("Y.m.d H:i:s")));
      
      // Handle automatic reply if defined
      $post = $conn->prepare("SELECT * FROM ticket_subjects WHERE subject=:subject and auto_reply=:auto_reply");
      $post->execute(array("subject"=>$subject,"auto_reply"=>1));
      $post = $post->fetch(PDO::FETCH_ASSOC); 
      $insert3 = $conn->prepare("INSERT INTO client_report SET client_id=:c_id, action=:action, report_ip=:ip, report_date=:date ");
      $insert3-> execute(array("c_id"=>$user["client_id"],"action"=>"New support ticket created#".$ticket_id,"ip"=>GetIP(),"date"=>date("Y-m-d H:i:s") ));
      
      if($post){
        $insert4 = $conn->prepare("INSERT INTO ticket_reply SET ticket_id=:t_id, client_id=:c_id, support_team=:st, support=:support, message=:message, time=:time ");
        $insert4-> execute(array("t_id"=>$ticket_id,"c_id"=>0,"st"=>"Support Bot","support"=>2,"message"=>$post["content"],"time"=>date("Y.m.d H:i:s")));
        
        $insert5 = $conn->prepare("INSERT INTO client_report SET client_id=:c_id, action=:action, report_ip=:ip, report_date=:date ");
        $insert5-> execute(array("c_id"=>$user["client_id"],"action"=>"Support request <strong>Automatic</strong> answered as. ID:".$ticket_id,"ip"=>GetIP(),"date"=>date("Y-m-d H:i:s") ));
      }
      // Email Notification for User
$to = $user['email']; // User's email address
$from = $settings["smtp_user"]; 
$fromName = $settings["site_seo"]; 
$replyTo = $settings["admin_mail"];
$subject_email = "New Support Ticket Created! - {$settings['site_name']}";
$email_message = "<html><body style='font-family: Inter, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>";
$email_message .= "<div style='max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); padding: 20px; text-align: center;'>";
$email_message .= "<div style='background: #007bff; color: #ffffff; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0;'>";
$email_message .= "Support Ticket Created</div>";
$email_message .= "<div style='padding: 20px; font-size: 16px; color: #333; line-height: 1.6;'>";
$email_message .= "<p>Hello, <strong>{$user['username']}</strong>!</p>";
$email_message .= "<p>A new support ticket has been created with the subject:</p>";
$email_message .= "<p><strong>$subject</strong></p>";
$email_message .= "<p>To view or respond to your ticket, please click the button below:</p>";
$email_message .= "<p><a href='" . site_url() . "tickets/read/$ticket_id' style='background: #007bff; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px; display: inline-block;'>View Ticket</a></p>";
$email_message .= "<p>Thank you for reaching out. Our support team will get back to you as soon as possible.</p>";
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
mail($to, $subject_email, $email_message, $headers);
      // Telegram Notification for User
      $telegramusertoken = $settings["telegramusertoken"];
      $usermessage = "Hello {$user['username']}!\n\n";
      $usermessage .= "A new support ticket has been created.\n\n";
      $usermessage .= "To view the ticket, click the link below:\n";
      $usermessage .= site_url() . "tickets/read/$ticket_id\n\n";
      $usermessage .= "Thank you!\n";
      $usermessage .= "\nBest regards,\n{$settings['site_name']}";
      
      $data_user = [
        'chat_id' => $user['chat_id'],
        'text' => $usermessage
      ];
      
      $telegram_api_url = "https://api.telegram.org/bot$telegramusertoken/sendMessage";
      $ch = curl_init($telegram_api_url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_user);
      curl_exec($ch);
      curl_close($ch);

      $adminbottoken = $settings["adminbottoken"];
      $stmt = $conn->prepare("SELECT chat_id FROM admins WHERE chat_id IS NOT NULL");
      $stmt->execute();
      $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Construct the Telegram message
$adminmessage = "Hello Admin,\n\n";
$adminmessage .= "A new ticket has been created by user: {$user['username']}.\n\n";
$adminmessage .= "Subject: $subject\n\n";
$adminmessage .= "Please review this ticket in your admin panel at your earliest convenience.\n";

// Send message to all admins
foreach ($admins as $admin) {
    $data_admin = [
        'chat_id' => $admin['chat_id'], // Admin's individual chat ID
        'text' => $adminmessage
    ];

    $telegramapiurl = "https://api.telegram.org/bot$adminbottoken/sendMessage";
    $ch = curl_init($telegramapiurl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_admin);
    curl_exec($ch);
    curl_close($ch);
}

      // Commit transaction if successful
      if( $insert && $insert2 && $insert3 ):
        unset($_SESSION["data"]);
        header('Location:'.site_url('tickets/').$ticket_id);
        $conn->commit();
      else:
        $error    = 1;
        $errorText= $languageArray["error.tickets.new.fail"];
        $conn->rollBack();
      endif;
    }
  }

} elseif( route(1) && preg_replace('/[^0-9]/', '', route(1)) && !preg_replace('/[^a-zA-Z]/', '', route(1)) ){

  if (!countRow(["table" => "tickets", "where" => ["ticket_id" => route(1) ,"client_id" => $user["client_id"] ]])):
    header("Location:" . site_url("tickets"));
    exit();
  else:

    // Mark ticket as read
    $templateDir  = "open_ticket";

    $ticketUpdate = $conn->prepare("UPDATE tickets SET support_new=:new  WHERE client_id=:c_id && ticket_id=:t_id ");
    $ticketUpdate-> execute(array("c_id"=>$user["client_id"], "new"=>1, "t_id"=>route(1) ));
    $ticketUpdate = $ticketUpdate->fetch(PDO::FETCH_ASSOC);
    $messageList  = $conn->prepare("SELECT * FROM ticket_reply WHERE ticket_id=:t_id ");
    $messageList  -> execute(array("t_id"=>route(1)));
    $messageList  = $messageList->fetchAll(PDO::FETCH_ASSOC);

    // Get ticket details
    $ticketList = $conn->prepare("SELECT * FROM tickets WHERE client_id=:c_id && ticket_id=:t_id ");
    $ticketList-> execute(array("c_id"=>$user["client_id"], "t_id"=>route(1) ));
    $ticketList = $ticketList->fetchAll(PDO::FETCH_ASSOC);
    $messageList["ticket"]  = $ticketList;

    $tickets = $conn->prepare("SELECT * FROM tickets WHERE client_id=:c_id && ticket_id=:t_id");
    $tickets-> execute(array("c_id"=>$user["client_id"], "t_id"=>route(1) ));
    $tickets = $tickets->fetchAll(PDO::FETCH_ASSOC);
    $ticketsList = [];

    foreach ($tickets as $ticket) {
      $t["message"] =  $ticket["message"];
      $t["time"] =  $ticket["time"];
      $t["refill_end_date"] =  $refill_end_date;
      $t["show_refill"]  = $ticket["show_refill"];
      $t["id"]    = $ticket["order_id"];

      array_push($ticketsList, $t);
    }

  endif;

}
?>

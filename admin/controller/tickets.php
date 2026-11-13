<?php
if(!defined('BASEPATH')) {
   die('Direct access to the script is not allowed');
}
if ($admin["access"]["tickets"] != 1):
    header("Location:" . site_url("$rentaladmin"));
    exit();
endif;
if ($_SESSION["client"]["data"]):
    $data = $_SESSION["client"]["data"];
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    unset($_SESSION["client"]);
endif;
if (!route(2)):
    $page = 1;
elseif (is_numeric(route(2))):
    $page = route(2);
elseif (!is_numeric(route(2))):
    $action = route(2);
endif;
if (empty($action)):
    if ($_GET["search"] == "unread" && $_GET["search"]):
        $search = " client_new='2' ";
        $count = $conn->prepare("SELECT * FROM tickets INNER JOIN clients ON clients.client_id = tickets.client_id WHERE {$search}");
        $count->execute(array());
        $count = $count->rowCount();
        $search = "WHERE {$search}";
        $search_link = "?search=unread";
    elseif ($_GET["search_type"] == "client" && $_GET["search_type"]):
        $search_where = $_GET["search_type"];
        $search_word = $_GET["search"];
        $clients = $conn->prepare("SELECT client_id FROM clients WHERE username LIKE '%" . $search_word . "%' ");
        $clients->execute(array());
        $clients = $clients->fetchAll(PDO::FETCH_ASSOC);
        $id = "(";
        foreach ($clients as $client) {
            $id.= $client["client_id"] . ",";
        }
        if (substr($id, -1) == ","):
            $id = substr($id, 0, -1);
        endif;
        $id.= ")";
        $search = " tickets.client_id IN " . $id;
        $count = $conn->prepare("SELECT * FROM tickets INNER JOIN clients ON clients.client_id = tickets.client_id WHERE {$search}");
        $count->execute(array());
        $count = $count->rowCount();
        $search = "WHERE {$search}";
        $search_link = "?search=" . $search_word . "&search_type=" . $search_where;
    elseif ($_GET["status"]):
        $search = " status='" . $_GET["status"] . "' ";
        $count = $conn->prepare("SELECT * FROM tickets INNER JOIN clients ON clients.client_id = tickets.client_id WHERE {$search}");
        $count->execute(array());
        $count = $count->rowCount();
        $search = "WHERE {$search}";
        $search_link = "?status=" . $_GET["status"];
    elseif ($_GET["search"]):
        $search_where = $_GET["search_type"];
        $search_word = $_GET["search"];
        $search = $search_where . " LIKE '%" . $search_word . "%'";
        $count = $conn->prepare("SELECT * FROM tickets INNER JOIN clients ON clients.client_id = tickets.client_id WHERE {$search}");
        $count->execute(array());
        $count = $count->rowCount();
        $search = "WHERE {$search}";
        $search_link = "?search=" . $search_word . "&search_type=" . $search_where;
    else:
        $count = $conn->prepare("SELECT * FROM tickets INNER JOIN clients ON clients.client_id = tickets.client_id");
        $count->execute(array());
        $count = $count->rowCount();
    endif;
    $to = 50;
    $pageCount = ceil($count / $to);
    if ($page > $pageCount):
        $page = 1;
    endif;
    $where = ($page * $to) - $to;
    $paginationArr = ["count" => $pageCount, "current" => $page, "next" => $page + 1, "previous" => $page - 1];
    $tickets = $conn->prepare("SELECT * FROM tickets INNER JOIN clients ON clients.client_id = tickets.client_id $search ORDER BY FIELD(status, 'pending', 'answered', 'closed'),lastupdate_time DESC LIMIT $where,$to ");
    $tickets->execute(array());
    $tickets = $tickets->fetchAll(PDO::FETCH_ASSOC);
    require admin_view('tickets');
elseif (route(2) == "read"):
    if (!countRow(["table" => "tickets", "where" => ["ticket_id" => route(3) ]])):
        header("Location:" . site_url("$rentaladmin/tickets"));
        exit();
    endif;
$id = route(3);
   $ticket = $conn->prepare("SELECT * FROM tickets  WHERE ticket_id=:id ");
    $ticket->execute(array("id"=>$id));
    $ticket = $ticket->fetchAll(PDO::FETCH_ASSOC);
if (route(4) == "delete"):
    $delete = $conn->prepare("DELETE FROM ticket_reply WHERE id=:t_id ");
    $delete->execute(array("t_id"=>route(3)));
endif;
    if ($_POST):
        
        $message = htmlspecialchars($_POST["message"]);
       
        if (strlen($message) < 3):
            $error = 1;
            $errorText = "Message should be at least 3 chracters.";
        else:
            $conn->beginTransaction();
            $update = $conn->prepare("UPDATE tickets SET canmessage=:canmessage, status=:status, lastupdate_time=:time, support_new=:new WHERE ticket_id=:t_id ");
            $update = $update->execute(array("t_id" => route(3), "time" => date("Y-m-d H:i:s"), "status" => "answered", "canmessage" => 2, "new" => 2));
             $tr_arr =array(
                "t_id" => route(3), 
                "time" => date("Y-m-d H:i:s"),
                "support" => '2',
                "message" => $message,
                "client_id"=>'0'
                );
           // print_r($tr_arr); die;
                   $insert = $conn->prepare("INSERT INTO ticket_reply SET ticket_id=:t_id, time=:time, support=:support, message=:message, client_id=:client_id");
            $insert = $insert->execute($tr_arr);
           // echo $update->debugDumpParams(); die;
            if ($insert && $update):
                if ($settings["alert_newmessage"] == 2) {
                    // Prepare email message
$to = $user["email"]; // User's email address
$from = $settings["smtp_user"]; 
$fromName = $settings["site_seo"]; 
$replyTo = $settings["admin_mail"];
$subject = "New Message on Your Support Ticket - {$settings['site_name']}";

// Create the HTML email content
$email_message = "<html><body style='font-family: Inter, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>";
$email_message .= "<div style='max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); padding: 20px; text-align: center;'>";
$email_message .= "<div style='background: #007bff; color: #ffffff; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0;'>";
$email_message .= "{$settings['site_name']} - New Message on Your Support Ticket</div>";
$email_message .= "<div style='padding: 20px; font-size: 16px; color: #333; line-height: 1.6;'>";
$email_message .= "<p>Hello <strong>{$row['username']}</strong>,</p>";
$email_message .= "<p>You have a new message on your support ticket. Please click the link below to view the message:</p>";
$email_message .= "<p><strong>View Ticket:</strong> <a href='" . site_url() . "tickets/" . route(3) . "' style='color: #007bff; text-decoration: none;'>Click here to view your ticket</a></p>";
$email_message .= "<p>If you did not request this, please contact support immediately.</p><br>";
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
$telegramusertoken = $settings["telegramusertoken"];
$message = "Dear {$user['username']},\n\n";
$message .= "We would like to inform you that you have a new update on your support ticket.\n\n";
$message .= "To review the message, please click on the following link:\n";
$message .= site_url() . "tickets/" . route(3) . "\n\n";
$message .= "Our support team is reviewing your request and will get back to you shortly.\n\n";
$message .= "Thank you for choosing {$settings['site_name']}.\n\n";
$message .= "Best regards,\n{$settings['site_name']} Support Team";

// Send Telegram notification
$data_user = [
    'chat_id' => $user['chat_id'],
    'text' => $message
];

$telegram_api_url = "https://api.telegram.org/bot$telegramusertoken/sendMessage";
$ch = curl_init($telegram_api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_user);
curl_exec($ch);
curl_close($ch);


}


               //  echo "updated"; die;
                $conn->commit();
                header("Location:" . site_url("$rentaladmin/tickets/read/" . route(3)));
                $_SESSION["client"]["data"]["success"] = 1;
                $_SESSION["client"]["data"]["successText"] = "Successful";
                
                
            else:
                //echo "not updated"; die;
                $conn->rollBack();
                header("Location:" . site_url("$rentaladmin/tickets/read/" . route(3)));
                $_SESSION["client"]["data"]["error"] = 1;
                $_SESSION["client"]["data"]["errorText"] = "Error";
            endif;
        endif;
    endif;
    $update = $conn->prepare("UPDATE tickets SET client_new=:new WHERE ticket_id=:t_id ");
    $update->execute(array("t_id" => route(3), "new" => 1));
    $ticketMessage = $conn->prepare("SELECT ticket_reply.*,tickets.subject,tickets.client_new,tickets.status,tickets.canmessage,tickets.client_id,clients.username  FROM ticket_reply INNER JOIN tickets ON ticket_reply.ticket_id = tickets.ticket_id INNER JOIN clients ON clients.client_id = tickets.client_id WHERE ticket_reply.ticket_id=:t_id ORDER BY ticket_reply.id DESC ");
    $ticketMessage->execute(array("t_id" => route(3)));
    $ticketMessage = $ticketMessage->fetchAll(PDO::FETCH_ASSOC);
    require admin_view('tickets_read');
elseif (route(2) == "unread"):
    if (!countRow(["table" => "tickets", "where" => ["ticket_id" => route(3) ]])):
        header("Location:" . site_url("$rentaladmin/tickets"));
        exit();
    endif;
    $update = $conn->prepare("UPDATE tickets SET client_new=:new WHERE ticket_id=:t_id ");
    $update->execute(array("t_id" => route(3), "new" => 2));
    if ($update):
        header("Location:" . site_url("$rentaladmin/tickets"));
        $_SESSION["client"]["data"]["success"] = 1;
        $_SESSION["client"]["data"]["successText"] = "Successful";
    else:
        header("Location:" . site_url("$rentaladmin/tickets"));
        $_SESSION["client"]["data"]["error"] = 1;
        $_SESSION["client"]["data"]["errorText"] = "Error";
    endif;
elseif (route(2) == "lock"):
    if (!countRow(["table" => "tickets", "where" => ["ticket_id" => route(3) ]])):
        header("Location:" . site_url("$rentaladmin/tickets"));
        exit();
    endif;
    $update = $conn->prepare("UPDATE tickets SET canmessage=:can WHERE ticket_id=:t_id ");
    $update->execute(array("t_id" => route(3), "can" => 1));
    if ($update):
        header("Location:" . site_url("$rentaladmin/tickets"));
        $_SESSION["client"]["data"]["success"] = 1;
        $_SESSION["client"]["data"]["successText"] = "Successful";
    else:
        header("Location:" . site_url("$rentaladmin/tickets"));
        $_SESSION["client"]["data"]["error"] = 1;
        $_SESSION["client"]["data"]["errorText"] = "Error";
    endif;
elseif (route(2) == "delete"):
if (!countRow(["table" => "tickets", "where" => ["ticket_id" => route(3) ]])):
        header("Location:" . site_url("$rentaladmin/tickets"));
        exit();
    endif;
    $delete = $conn->prepare("DELETE FROM tickets WHERE ticket_id=:t_id ");
    $delete->execute(array("t_id"=>route(3)));
    if ($delete):
        header("Location:" . site_url("$rentaladmin/tickets"));
        $_SESSION["client"]["data"]["success"] = 1;
        $_SESSION["client"]["data"]["successText"] = "Successful";
    else:
        header("Location:" . site_url("$rentaladmin/tickets"));
        $_SESSION["client"]["data"]["error"] = 1;
        $_SESSION["client"]["data"]["errorText"] = "Error";
    endif;
elseif (route(2) == "remove"):
    $ticket = $conn->prepare("SELECT * FROM ticket_reply WHERE id=:id");
$ticket->execute(array("id"=>route(3)));
$ticket = $ticket->fetch(PDO::FETCH_ASSOC);
    $delete = $conn->prepare("DELETE FROM ticket_reply WHERE id=:t_id ");
    $delete->execute(array("t_id"=>route(3)));
$ticketid = $ticket["ticket_id"];
    if ($delete):
        header("Location:" . site_url("$rentaladmin/tickets/read/$ticketid"));;
        $_SESSION["client"]["data"]["success"] = 1;
        $_SESSION["client"]["data"]["successText"] = "Successful";
    else:
header("Location:" . site_url("$rentaladmin/tickets/read/$ticketid"));
        $_SESSION["client"]["data"]["error"] = 1;
        $_SESSION["client"]["data"]["errorText"] = "Error";
    endif;
elseif (route(2) == "unlock"):
    if (!countRow(["table" => "tickets", "where" => ["ticket_id" => route(3) ]])):
        header("Location:" . site_url("$rentaladmin/tickets"));
        exit();
    endif;
    $update = $conn->prepare("UPDATE tickets SET canmessage=:can WHERE ticket_id=:t_id ");
    $update->execute(array("t_id" => route(3), "can" => 2));
    if ($update):
        header("Location:" . site_url("$rentaladmin/tickets"));
        $_SESSION["client"]["data"]["success"] = 1;
        $_SESSION["client"]["data"]["successText"] = "Successful";
    else:
    header("Location:" . site_url("$rentaladmin/tickets"));
        $_SESSION["client"]["data"]["error"] = 1;
        $_SESSION["client"]["data"]["errorText"] = "Error";
    endif;
elseif (route(2) == "close"):
    if (!countRow(["table" => "tickets", "where" => ["ticket_id" => route(3) ]])):
        header("Location:" . site_url("$rentaladmin/tickets"));
        exit();
    endif;
    $update = $conn->prepare("UPDATE tickets SET status=:status WHERE ticket_id=:t_id ");
    $update->execute(array("t_id" => route(3), "status" => "closed"));
    if ($update):
        header("Location:" . site_url("$rentaladmin/tickets"));
        $_SESSION["client"]["data"]["success"] = 1;
        $_SESSION["client"]["data"]["successText"] = "Successful";
    else:
        header("Location:" . site_url("$rentaladmin/tickets"));
        $_SESSION["client"]["data"]["error"] = 1;
        $_SESSION["client"]["data"]["errorText"] = "Error";
    endif;

elseif( route(2) == "multi-action" ):
          $tickets  = $_POST["ticket"];
          $action   = $_POST["bulkStatus"];
              if ($action == "unread"):
        foreach ($tickets as $id => $value):
            $update = $conn->prepare("UPDATE tickets SET client_new=:new WHERE ticket_id=:id ");
            $update->execute(array("new" => 2, "id" => $id));
        endforeach;
elseif ($action == "delete"):
        foreach ($tickets as $id => $value):
            $delete = $conn->prepare("DELETE FROM tickets WHERE ticket_id=:t_id ");
    $delete->execute(array("t_id"=>$id));
        endforeach;
    elseif ($action == "lock"):
        foreach ($tickets as $id => $value):
            $update = $conn->prepare("UPDATE tickets SET canmessage=:can WHERE ticket_id=:id ");
            $update->execute(array("can" => 1, "id" => $id));
        endforeach;
    elseif ($action == "unlock"):
        foreach ($tickets as $id => $value):
            $update = $conn->prepare("UPDATE tickets SET canmessage=:can WHERE ticket_id=:id ");
            $update->execute(array("can" => 2, "id" => $id));
        endforeach;
    elseif ($action == "close"):
        foreach ($tickets as $id => $value):
            $update = $conn->prepare("UPDATE tickets SET status=:status, canmessage=:can WHERE ticket_id=:id ");
            $update->execute(array("status" => "closed", "id" => $id, "can" => 2));
        endforeach;
    elseif ($action == "pending"):
        foreach ($tickets as $id => $value):
            $update = $conn->prepare("UPDATE tickets SET status=:status, canmessage=:can WHERE ticket_id=:id ");
            $update->execute(array("status" => "pending", "id" => $id, "can" => 2));
        endforeach;
    elseif ($action == "answered"):
        foreach ($tickets as $id => $value):
            $update = $conn->prepare("UPDATE tickets SET status=:status, canmessage=:can WHERE ticket_id=:id ");
            $update->execute(array("status" => "answered", "id" => $id, "can" => 2));
        endforeach;
    endif;
    header("Location:" . site_url("$rentaladmin/tickets"));

 elseif( $action == "edit" ):
    if( $_POST ):
      foreach ($_POST as $key => $value) {
        $$key = $value;
      }
      
      if( empty($description) ):
        $error    = 1;
        $errorText= "Message cannot be empty";
        $icon     = "error";
      else:
          $conn->beginTransaction();
          
    $update = $conn->prepare("UPDATE ticket_reply SET message=:message WHERE id=:id ");
    $update->execute(array("id"=>route(3),"message"=>$description));
   
          if( $update ):
            $conn->commit();
            $error    = 1;
            $errorText= "Transaction successful";
            $icon     = "success";
          else:
            $conn->rollBack();
            $error    = 1;
            $errorText= "Operation failed";
            $icon     = "error";
          endif;
      endif;
      echo json_encode(["t"=>"error","m"=>$errorText,"s"=>$icon,"r"=>$referrer]);
    endif;    
  
elseif ($action == "new"):
    if ($_POST):
        foreach ($_POST as $key => $value) {
            $$key = $value;
        }
       $userRow = $conn->prepare("SELECT * FROM clients WHERE username=:username AND email=:email");
$userRow->execute(array("username" => $username, "email" => $email));

        $userDetail = $userRow->fetch(PDO::FETCH_ASSOC);
        if (!$userRow->rowCount()):
            $error = 1;
            $errorText = "User not found";
            $icon = "error";
        elseif (empty($subject)):
            $error = 1;
            $errorText = "Subject cannot be empty";
            $icon = "error";
        elseif (empty($message)):
            $error = 1;
            $errorText = "Message cannot be empty";
            $icon = "error";
        else:
            $conn->beginTransaction();
            $insert = $conn->prepare("INSERT INTO tickets SET client_id=:c_id, subject=:subject, support_new=:support_new, client_new=:client_new, time=:time, lastupdate_time=:last_time ");
            $insert = $insert->execute(array("c_id" => $userDetail["client_id"], "subject" => htmlspecialchars($subject), "support_new" => 2, "client_new" => 1, "time" => date("Y.m.d H:i:s"), "last_time" => date("Y.m.d H:i:s")));



            if ($insert) {
                $ticket_id = $conn->lastInsertId();
                if ($settings["alert_newmessage"] == 2) {
                    // Prepare email message
$to = $userDetail["email"]; // User's email address
$from = $settings["smtp_user"]; 
$fromName = $settings["site_seo"]; 
$replyTo = $settings["admin_mail"];
$subject = "New Message on Your Support Ticket - {$settings['site_name']}";

// Create the HTML email content
$email_message = "<html><body style='font-family: Inter, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>";
$email_message .= "<div style='max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); padding: 20px; text-align: center;'>";
$email_message .= "<div style='background: #007bff; color: #ffffff; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0;'>";
$email_message .= "{$settings['site_name']} - New Message on Your Support Ticket</div>";
$email_message .= "<div style='padding: 20px; font-size: 16px; color: #333; line-height: 1.6;'>";
$email_message .= "<p>Hello <strong>{$row['username']}</strong>,</p>";
$email_message .= "<p>You have a new message on your support ticket. Please click the link below to view the message:</p>";
$email_message .= "<p><strong>View Ticket:</strong> <a href='" . site_url() . "tickets/" . route(3) . "' style='color: #007bff; text-decoration: none;'>Click here to view your ticket</a></p>";
$email_message .= "<p>If you did not request this, please contact support immediately.</p><br>";
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
$telegramusertoken = $settings["telegramusertoken"];
$message = "Dear {$user['username']},\n\n";
$message .= "We would like to inform you that you have a new update on your support ticket.\n\n";
$message .= "To review the message, please click on the following link:\n";
$message .= site_url() . "tickets/" . route(3) . "\n\n";
$message .= "Our support team is reviewing your request and will get back to you shortly.\n\n";
$message .= "Thank you for choosing {$settings['site_name']}.\n\n";
$message .= "Best regards,\n{$settings['site_name']} Support Team";

// Send Telegram notification
$data_user = [
    'chat_id' => $user['chat_id'],
    'text' => $message
];

$telegram_api_url = "https://api.telegram.org/bot$telegramusertoken/sendMessage";
$ch = curl_init($telegram_api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_user);
curl_exec($ch);
curl_close($ch);


}


}


            $insert2 = $conn->prepare("INSERT INTO ticket_reply SET ticket_id=:t_id, client_id=:c_id, support=:support, message=:message, time=:time ");
            $insert2 = $insert2->execute(array("t_id" => $ticket_id, "c_id" => $user["client_id"], "support" => 2, "message" => htmlspecialchars($message), "time" => date("Y.m.d H:i:s")));
            if ($insert && $insert2):
                $conn->commit();
                $referrer = site_url("$rentaladmin/tickets");
                $error = 1;
                $errorText = "Successful";
                $icon = "success";
            else:
                $conn->rollBack();
                $error = 1;
                $errorText = "Error";
                $icon = "error";
            endif;
        endif;
        echo json_encode(["t" => "error", "m" => $errorText, "s" => $icon, "r" => $referrer]);
    endif;
endif;

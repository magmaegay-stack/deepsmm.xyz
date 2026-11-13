<?php
ini_set('max_execution_time', '600');
define("BASEPATH",TRUE);
require $_SERVER["DOCUMENT_ROOT"]."/vendor/autoload.php";
require $_SERVER["DOCUMENT_ROOT"]."/app/init.php";
$smmapi   = new SMMApi();
// use PHPMailer\PHPMailer\PHPMailer;
$to = "10";


  $orders = $conn->prepare("SELECT * FROM tickets INNER JOIN clients ON clients.client_id = tickets.client_id  ");
 $orders->execute(array());
 $orders = $orders->fetchAll(PDO::FETCH_ASSOC);
 foreach($orders as $order):


$failCount      = $conn->prepare("SELECT * FROM ticket_reply WHERE ticket_id=:error ");
  $failCount     -> execute(array("error"=>$order["ticket_id"]));
  $failCount      = $failCount->rowCount();

if( "1" == $failCount ) :
$message = "Dear Customer,<br><br>

Your Query Has Been Forwarded To The Concerned Team & Will Be Addressed Shortly.
Contact Us On WhatsApp For More Details.
<br><br>

Thank You.";

$tr_arr =array(
                "t_id" => $order["ticket_id"], 
                "time" => date("Y-m-d H:i:s"),
                "support" => '2',
                "message" => $message,
                "client_id"=>'0'
                );
           // print_r($tr_arr); die;
                   $insert = $conn->prepare("INSERT INTO ticket_reply SET ticket_id=:t_id, time=:time, support=:support, message=:message, client_id=:client_id");
            $insert = $insert->execute($tr_arr);
$ticket_id = $conn->lastInsertId();
if($insert) :
$update = $conn->prepare("UPDATE tickets SET canmessage=:canmessage, status=:status, lastupdate_time=:time, support_new=:new WHERE ticket_id=:t_id ");
            $update = $update->execute(array("t_id" => $order["ticket_id"], "time" => date("Y-m-d H:i:s"), "status" => "answered", "canmessage" => 2, "new" => 2));


if ($settings["alert_newmessage"] ==  2) {
$msg = "Hello,<br><br>
You have received a new message in your support ticket.<br><br>
To view the message, please click the link below :<br>
" . site_url() . "tickets/$ticket_id<br><br>";


        $send = mail($order['email'],"New Message in Your Support Ticket",$msg);


} 
endif;
endif;

   





if($insert) :
$success = "Done Reply-";
print($success);
$success = $order["ticket_id"];
print($success);
$success = $failCount;
print($success);
else:
$success = "Failed Reply";
print($success);
$success = $order["ticket_id"];
print($success);

$success = $failCount;
print($success); 
endif;



endforeach;




?>

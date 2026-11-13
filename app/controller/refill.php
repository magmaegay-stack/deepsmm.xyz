<?php
if(!defined('BASEPATH')) {
   die('Direct access to the script is not allowed');
}
if( $panel["panel_status"] == "suspended" ): include 'app/views/frozen.twig';exit(); endif;
if( $panel["panel_status"] == "frozen" ): include 'app/views/frozen.twig';exit(); endif;

$title .= "Refill";

if( $_SESSION["msmbilisim_userlogin"] != 1  || $user["client_type"] == 1  ){
  Header("Location:".site_url('logout'));
}

if( $settings["email_confirmation"] == 1  && $user["email_type"] == 1  ){
  Header("Location:".site_url('confirm_email'));
}
if ($user["otp_type"] == 1 && $user["otp_v"] == 2  ) {
    header("Location: /2fa");exit();
}

$smmapi   = new SMMApi();
$fapi     = new socialsmedia_api();

$status_list  = ["all","Pending","Refilling","Completed","Rejected","Error","canceled"];
$search_statu = route(1); if( !route(1) ):  $route[1] = "all";  endif;

if( !in_array($search_statu,$status_list) ):
  $route[1]         = "all";
endif;

$status_list  = ["all","Pending","Refilling","Completed","Rejected","Error","canceled"];
$search_statu = route(1); if( !route(1) ):  $route[1] = "all";  endif;

if( !in_array($search_statu,$status_list) ):
  $route[1]         = "all";
endif;

if( route(2) ):
  $page         = route(2);
else:
  $page         = 1;
endif;
if( route(1) != "all" ): $search  = "&& task_status='".route(1)."'"; else: $search = ""; endif;
if( !empty(urldecode($_GET["search"])) ): $search.= " && ( order_url LIKE '%".urldecode($_GET["search"])."%' || order_id LIKE '%".urldecode($_GET["search"])."%' ) "; endif;
if( !empty($_GET["subscription"]) ): $search.= " && ( subscriptions_id LIKE '%".$_GET["subscription"]."%'  ) "; endif;
if( !empty($_GET["dripfeed"]) ): $search.= " && ( dripfeed_id LIKE '%".$_GET["dripfeed"]."%'  ) "; endif;
$c_id = $user["client_id"];
$to = 25;
$count_query = $conn->prepare("SELECT * FROM tasks WHERE client_id = :c_id $search");
$count_query->bindParam(':c_id', $c_id, PDO::PARAM_INT);
$count_query->execute();
$count = $count_query->rowCount();
$pageCount = ceil($count / $to);
if ($page > $pageCount) {
    $page = 1;
}
$where = ($page * $to) - $to;
$orders_query = $conn->prepare("
    SELECT tasks.*, orders.*, services.*
    FROM tasks
    LEFT JOIN orders ON tasks.order_id = orders.order_id
    LEFT JOIN services ON tasks.service_id = services.service_id
    WHERE tasks.client_id = :c_id $search
    ORDER BY tasks.order_id DESC
    LIMIT :where, :to
");
$orders_query->bindParam(':c_id', $c_id, PDO::PARAM_INT);
$orders_query->bindParam(':where', $where, PDO::PARAM_INT);
$orders_query->bindParam(':to', $to, PDO::PARAM_INT);
$orders_query->execute();
$orders = $orders_query->fetchAll(PDO::FETCH_ASSOC);
$ordersList = [];
foreach ($orders as $order) {
    $o["id"] = $order["order_id"];
    $o["date"] = date("Y-m-d H:i:s", (strtotime($order["task_created_at"]) + $user["timezone"])); // Use task_created_at
    $o["link"] = $order["order_url"];
    $o["service"] = $order["service_name"];
    $o["status"] = $languageArray["orders.status." . $order["order_status"]];
    $o["refill_id"] = $order["task_id"];
    $o["refill_status"] = $order["task_status"];
    $o["show_tasks"] = $order["show_tasks"];
    if ($order["order_status"] == "completed" && substr($order["order_remains"], 0, 1) == "-") {
        $o["remains"] = "+" . substr($order["order_remains"], 1);
    } else {
        $o["remains"] = $order["order_remains"];
    }
    $ordersList[] = $o;
}


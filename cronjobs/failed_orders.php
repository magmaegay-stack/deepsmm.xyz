<?php
define("BASEPATH", true);
require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/init.php";

$settingsQuery = $conn->prepare("SELECT * FROM settings WHERE id = 1");
$settingsQuery->execute();
$settings = $settingsQuery->fetch(PDO::FETCH_ASSOC);

$cancel_enabled = $settings["auto_fail_to_cancel_enabled"];
$cancel_delay = (int)$settings["auto_fail_to_cancel_delay_minutes"];
$inprogress_enabled = $settings["auto_fail_to_inprogress_enabled"];
$inprogress_delay = (int)$settings["auto_fail_to_inprogress_delay_minutes"];

$orders = $conn->prepare("SELECT * FROM orders WHERE order_status = 'pending'");
$orders->execute();
$orders = $orders->fetchAll(PDO::FETCH_ASSOC);

foreach ($orders as $order) {
    $orderid = $order["order_id"];
    $client_id = $order["client_id"];
    $placedTime = strtotime($order["order_create"]);
    $now = time();
    $time_diff = ($now - $placedTime) / 60;

    $start = $order["order_start"] ?: 0;
    $finish = $order["order_finish"] ?: 0;
    $remains = $order["order_remains"] ?: 0;
    $orderstatus = ["auto_fail_check" => true]; // fallback detail data

    // CANCEL CASE: api_orderid = 0 and delay passed
    if ($cancel_enabled && $time_diff >= $cancel_delay && $order["api_orderid"] == 0) {
        $conn->beginTransaction();

        $refundAmount = $order["order_charge"];
        $clientQuery = $conn->prepare("SELECT * FROM clients WHERE client_id = :id");
        $clientQuery->execute(["id" => $client_id]);
        $client = $clientQuery->fetch(PDO::FETCH_ASSOC);

        // Update client's balance and spent amount
        $updateClient = $conn->prepare("UPDATE clients SET balance = balance + :refund, spent = spent - :refund WHERE client_id = :id");

        // Update order to 'canceled' status and reset relevant fields
        $updateOrder = $conn->prepare("UPDATE orders SET order_status='canceled', order_charge=0, api_charge=0, order_profit=0, order_remains=:remains, order_start=:start, order_finish=:finish, order_detail=:detail, order_error='-' WHERE order_id=:id");

        // Insert report for the cancellation
        $insertReport = $conn->prepare("INSERT INTO client_report SET client_id=:id, action=:action, report_ip='127.0.0.1', report_date=:date");

        // Execute queries
        $ok1 = $updateClient->execute(["id" => $client_id, "refund" => $refundAmount]);
        $ok2 = $updateOrder->execute([
            "id" => $orderid,
            "remains" => $remains,
            "start" => $start,
            "finish" => $finish,
            "detail" => json_encode($orderstatus)
        ]);
        $ok3 = $insertReport->execute([
            "id" => $client_id,
            "date" => date("Y-m-d H:i:s"),
            "action" => "Order #$orderid canceled due to API timeout. Refunded $refundAmount."
        ]);

        // Commit or rollback transaction
        if ($ok1 && $ok2 && $ok3) {
            $conn->commit();
        } else {
            $conn->rollBack();
        }

        continue; // Move to next order after canceling this one
    }

    // INPROGRESS CASE: api_orderid != 0 and delay passed, error exists
    if ($inprogress_enabled && $time_diff >= $inprogress_delay && $order["api_orderid"] != 0 && $order["order_error"] != "-") {
        $conn->beginTransaction();

        $api_charge = $order["api_charge"] ?? 0;
        $order_profit = $order["order_charge"] - $api_charge;

        $update = $conn->prepare("UPDATE orders SET order_status='inprogress', order_remains=:remains, order_start=:start, order_finish=:finish, api_charge=:api_charge, order_profit=:profit, order_detail=:detail WHERE order_id=:id");
        $ok = $update->execute([
            "id" => $orderid,
            "remains" => $remains,
            "start" => $start,
            "finish" => $finish,
            "api_charge" => $api_charge,
            "profit" => $order_profit,
            "detail" => json_encode($orderstatus)
        ]);

        if ($ok) {
            $conn->commit();
        } else {
            $conn->rollBack();
        }
    }
}
?>

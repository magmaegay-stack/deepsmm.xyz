<?php
if (!defined('BASEPATH')) {
    define('BASEPATH', true);
    require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
    require $_SERVER["DOCUMENT_ROOT"] . "/app/init.php";
}
$settingQuery = $conn->prepare("SELECT * FROM settings WHERE id = 1");
$settingQuery->execute();
$settings = $settingQuery->fetch(PDO::FETCH_ASSOC);

// Agar auto_order_resend = 1 hai, toh script exit kar jaaye
if ($settings["auto_order_resend"] == 1) {
    exit; // Stop the cron
}
$smmapi = new SMMApi();
$fapi = new socialsmedia_api();

// Fetch orders that need to be resent
$orders = $conn->prepare("SELECT * FROM orders INNER JOIN services ON services.service_id = orders.service_id INNER JOIN service_api ON services.service_api = service_api.id WHERE orders.order_status = 'pending' AND orders.order_error != '-'");
$orders->execute();
$orders = $orders->fetchAll(PDO::FETCH_ASSOC);

foreach ($orders as $order) {
    // API order resend logic
    if ($order["api_type"] == 1) {
        if ($order["service_package"] == 1 || $order["service_package"] == 2 || $order["service_package"] == 11 || $order["service_package"] == 12) {
            $get_order = $smmapi->action(array('key' => $order["api_key"], 'action' => 'add', 'service' => $order["api_service"], 'link' => $order["order_url"], 'quantity' => $order["order_quantity"]), $order["api_url"]);
            if (!isset($get_order->order)) {
                $error = json_encode($get_order);
                $order_id = "";
            } else {
                $error = "-";
                $order_id = $get_order->order;
            }
        } elseif ($order["service_package"] == 3) {
            $get_order = $smmapi->action(array('key' => $order["api_key"], 'action' => 'add', 'service' => $order["api_service"], 'link' => $order["order_url"], 'comments' => $comments), $order["api_url"]);
            if (!isset($get_order->order)) {
                $error = json_encode($get_order);
                $order_id = "";
            } else {
                $error = "-";
                $order_id = $get_order->order;
            }
        }
        $orderstatus = $smmapi->action(array('key' => $order["api_key"], 'action' => 'status', 'order' => $order_id), $order["api_url"]);
        $balance = $smmapi->action(array('key' => $order["api_key"], 'action' => 'balance'), $order["api_url"]);
        $api_charge = $orderstatus->charge;
        if (!$api_charge) {
            $api_charge = 0;
        }
        $currency = $balance->currency;
        if ($currency == "TRY") {
            $currencycharge = 1;
        } elseif ($currency == "USD") {
            $currencycharge = $settings["dolar_charge"];
        } elseif ($currency == "EUR") {
            $currencycharge = $settings["euro_charge"];
        }
    } elseif ($order["api_type"] == 3) {
        if ($order["service_package"] == 1 || $order["service_package"] == 2) {
            $get_order = $fapi->query(array('cmd' => 'orderadd', 'token' => $order["api_key"], 'apiurl' => $order["api_url"], 'orders' => [['service' => $order["api_service"], 'amount' => $order["order_quantity"], 'data' => $order["order_url"]]]));
            if (!isset($get_order[0][0]['status']) || $get_order[0][0]['status'] == "error") {
                $error = json_encode($get_order);
                $order_id = "";
                $api_charge = "0";
                $currencycharge = 1;
            } else {
                $error = "-";
                $order_id = $get_order[0][0]["id"];
                $orderstatus = $fapi->query(array('cmd' => 'orderstatus', 'token' => $order["api_key"], 'apiurl' => $order["api_url"], 'orderid' => [$order_id]));
                $balance = $fapi->query(array('cmd' => 'profile', 'token' => $order["api_key"], 'apiurl' => $order["api_url"]));
                $api_charge = $orderstatus[$order_id]["order"]["price"];
                $currency = "TRY";
                if ($currency == "TRY") {
                    $currencycharge = 1;
                } elseif ($currency == "USD") {
                    $currencycharge = $settings["dolar_charge"];
                } elseif ($currency == "EUR") {
                    $currencycharge = $settings["euro_charge"];
                }
            }
        }
    }

    $profit = $order["order_charge"] - $api_charge;

    // Update order details
    $update = $conn->prepare("UPDATE orders SET order_api=:api, api_serviceid=:serviceid, order_error=:error, api_orderid=:orderid, order_detail=:detail, api_charge=:api_charge, api_currencycharge=:api_currencycharge, order_profit=:profit WHERE order_id=:id");
    $update->execute(array("error" => $error, "api" => $order["id"], "serviceid" => $order["api_service"], "orderid" => $order_id, "detail" => json_encode($get_order), "id" => $order["order_id"], "profit" => $profit, "api_charge" => $api_charge, "api_currencycharge" => $currencycharge));
}
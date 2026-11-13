<?php
ini_set('max_execution_time', '600');
define("BASEPATH", TRUE);
require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/init.php";

// Update currency rates
if ($settings["site_update_rates_automatically"] == "1") {
    $currency_codes = $conn->prepare("SELECT currency_code FROM currencies WHERE currency_code != :code");
    $currency_codes->execute(["code" => $settings["site_base_currency"]]);
    $currency_codes = $currency_codes->fetchAll(PDO::FETCH_ASSOC);

    $url = "http://www.floatrates.com/daily/" . strtolower($settings["site_base_currency"]) . ".json";
    $a = HTTP_REQUEST($url, "", array(""), "GET", 0);
    $floatrates_array = json_decode($a, true);

    foreach ($currency_codes as $currency) {
        $currency_code = $currency["currency_code"];
        $lower_case_currency_code = strtolower($currency_code);
        $currency_rate = $floatrates_array[$lower_case_currency_code]["rate"];
        $inverse_rate = $floatrates_array[$lower_case_currency_code]["inverseRate"];

        $update_db = $conn->prepare("UPDATE currencies SET currency_rate = :rate, currency_inverse_rate = :inverse_rate WHERE currency_code = :code");
        $update_db->execute([
            "rate" => $currency_rate,
            "inverse_rate" => $inverse_rate,
            "code" => $currency_code
        ]);
    }

    $settings_update = $conn->prepare("UPDATE settings SET last_updated_currency_rates = :time WHERE id = :id");
    $settings_update->execute([
        "time" => date('Y-m-d H:i:s'),
        "id" => 1
    ]);
}

// Check refill statuses
$smmapi = new SMMApi();
$refills = $conn->prepare("SELECT * FROM tasks WHERE task_type = :type");
$refills->execute(["type" => 1]);
$refills = $refills->fetchAll(PDO::FETCH_ASSOC);

foreach ($refills as $refill) {
    if ($refill["check_refill_status"] == 2) {
        $order_id_refill = $refill['order_id'];
        $task_id = $refill["task_id"];
        $refill_id = $refill["refill_orderid"];

        $order = $conn->prepare("SELECT * FROM orders INNER JOIN services ON services.service_id = orders.service_id INNER JOIN service_api ON services.service_api = service_api.id WHERE orders.order_id = :id");
        $order->execute(["id" => $order_id_refill]);
        $order = $order->fetch(PDO::FETCH_ASSOC);
        $order = json_decode(json_encode($order), true);

        $refill_apiurl = $order["api_url"];
        $status = "";

        if (get_domain($refill_apiurl) != "smqmteamindia.com" && get_domain($refill_apiurl) != "waorldofsmm.com") {
            $get_refill_status = $smmapi->action(['key' => $order["api_key"], 'action' => 'refill_status', 'refill' => $refill_id], $refill_apiurl);
            $status = $get_refill_status->status;
        } else {
            $login_url = "https://" . get_domain($refill_apiurl) . "/";
            $headers = [
                "Host: " . get_domain($refill_apiurl),
                "user-agent: Mozilla/5.0 (Linux; Android 8.1.0; vivo 1803 Build/O11019;) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/101.0.4951.61 Mobile Safari/537.36",
                "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
                "x-requested-with: mark.via.gp",
                "referer: https://" . get_domain($refill_apiurl) . "/",
                "accept-language: en-US,en;q=0.9"
            ];

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $login_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_COOKIEFILE, __DIR__ . "/cookies.txt");
            curl_setopt($curl, CURLOPT_COOKIEJAR, __DIR__ . "/cookies.txt");
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            $response = curl_exec($curl);
            curl_close($curl);

            preg_match('/name="_csrf"\s+value="(.*?)"/', $response, $match);

            $login_credentials = json_decode($order["api_login_credentials"], true);
            $data = "username=" . $login_credentials["username"] . "&password=" . $login_credentials["password"] . "&login_btn=Login&_csrf=" . $match[1];

            if (strlen($login_credentials["username"]) > 0 && strlen($login_credentials["password"]) > 0) {
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $login_url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_COOKIEFILE, __DIR__ . "/cookies.txt");
                curl_setopt($curl, CURLOPT_COOKIEJAR, __DIR__ . "/cookies.txt");
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_HEADER, 0);
                $response = curl_exec($curl);
                curl_close($curl);

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $login_url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_COOKIEFILE, __DIR__ . "/cookies.txt");
                curl_setopt($curl, CURLOPT_COOKIEJAR, __DIR__ . "/cookies.txt");
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_HEADER, 0);
                $response = curl_exec($curl);
                curl_close($curl);

                preg_match('/<tr>(?s).*?(\d+)<\/td>[\s\S]*?search=[^>]+>' . $order["api_orderid"] . '<\/a><\/td>[\s\S]*?<td[\s\S]*?<td[\s\S]*?\/td>[\s\S]*?>(.*?)<\/td>/', $response, $match);

                $refill_id = $match[1];
                $status = $match[2];

                $add_refill_id = $conn->prepare("UPDATE tasks SET refill_orderid = :refill_id WHERE task_id = :id");
                $add_refill_id->execute([
                    "refill_id" => $refill_id,
                    "id" => $task_id
                ]);

                if ($status == "Success") {
                    $status = "Completed";
                }
            }
        }

        if ($status == "Rejected") {
            $task_status = "rejected";
            $check_refill_status = 1;
        } elseif ($status == "Completed") {
            $task_status = "completed";
            $check_refill_status = 1;
        } else {
            $task_status = "inprogress";
            $check_refill_status = 2;
        }

        if (empty($refill_id) || $refill_id == null) {
            $task_status = "completed";
            $check_refill_status = 1;
        }

        $update = $conn->prepare("UPDATE tasks SET task_status = :status, task_updated_at = :updated_at, check_refill_status = :check_refill_status WHERE task_id = :id");
        $update->execute([
            "status" => $task_status,
            "updated_at" => date('Y.m.d H:i:s'),
            "check_refill_status" => $check_refill_status,
            "id" => $task_id
        ]);
    }
}

// Cancel orders
$cancel_orders = $conn->prepare("SELECT * FROM tasks WHERE task_status = :status AND task_type = :type");
$cancel_orders->execute([
    "status" => "inprogress",
    "type" => 2
]);
$cancel_orders = $cancel_orders->fetchAll(PDO::FETCH_ASSOC);

foreach ($cancel_orders as $cancel) {
    if ($cancel["check_refill_status"] == 2) {
        $cancel_api_response = json_decode($cancel["task_response"], true);

        if ($cancel_api_response["status"] == "Success" || $cancel_api_response["status"] == "success") {
            $update = $conn->prepare("UPDATE tasks SET task_status = :status, check_refill_status = :check WHERE task_type = :type");
            $update->execute([
                "status" => "canceled",
                "check" => 1,
                "type" => 2
            ]);
        } else {
            $update = $conn->prepare("UPDATE tasks SET task_status = :status, check_refill_status = :check WHERE task_type = :type");
            $update->execute([
                "status" => "failed",
                "check" => 1,
                "type" => 2
            ]);
        }
    }
}

// Create fake orders
if ($settings["fake_order_service_enabled"] == 1) {
    $min_orders = $settings["fake_order_min"];
    $max_orders = $settings["fake_order_max"];
    $next_order_id = rand($min_orders, $max_orders);
    $next_order_id = $settings["panel_orders"] + $next_order_id;

    $fake_order = "fake_order";

    $conn->beginTransaction();

    $insert = $conn->prepare("INSERT INTO orders SET order_start = :count, order_error = :error, order_id = :order_id, order_status = :order_status, client_id = :c_id, api_orderid = :order_id, service_id = :s_id, order_quantity = :quantity, order_charge = :price, order_url = :url, order_create = :create, order_extras = :extra, last_check = :last_check, order_api = :api, api_serviceid = :api_serviceid, dripfeed = :drip, dripfeed_totalcharges = :totalcharges, dripfeed_runs = :runs, dripfeed_interval = :interval, dripfeed_totalquantity = :totalquantity, dripfeed_delivery = :delivery");
    $insert->execute([
        "count" => $fake_order,
        "c_id" => $fake_order,
        "error" => "-",
        "order_status" => "fake_order",
        "s_id" => "",
        "quantity" => $fake_order,
        "price" => $fake_order,
        "order_id" => $next_order_id,
        "url" => $fake_order,
        "create" => date("Y.m.d H:i:s"),
        "extra" => $fake_order,
        "last_check" => date("Y.m.d H:i:s"),
        "api" => $fake_order,
        "api_serviceid" => "",
        "drip" => $fake_order,
        "totalcharges" => $fake_order,
        "runs" => $fake_order,
        "interval" => $fake_order,
        "totalquantity" => $fake_order,
        "delivery" => 1
    ]);

    $update = $conn->prepare("UPDATE settings SET panel_orders = :orders WHERE id = :id");
    $update->execute([
        "id" => 1,
        "orders" => $next_order_id
    ]);

    $delete = $conn->prepare("DELETE FROM orders WHERE order_id = :id");
    $delete->execute(["id" => $next_order_id]);

    $conn->commit();
}
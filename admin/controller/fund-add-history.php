<?php
if (!defined('BASEPATH')) {
    die('Direct access to the script is not allowed');
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET["action"] == "getData") {
        $search = isset($_GET["search"]) ? htmlspecialchars(trim($_GET["search"])) : '';

        $clients = $conn->prepare("SELECT client_id, username FROM clients");
        $clients->execute();
        $clients = $clients->fetchAll(PDO::FETCH_ASSOC);
        $clients = array_group_by($clients, "client_id");

        $query = "SELECT payment_id, client_id, client_balance, payment_amount, payment_method, payment_status, payment_delivery, payment_note, payment_mode, payment_extra, payment_create_date FROM payments";
        if ($search) {
            $query .= " WHERE client_id IN (SELECT client_id FROM clients WHERE username LIKE :search) OR payment_extra LIKE :search";
        }
        $query .= " ORDER BY payment_id DESC";

        $payments = $conn->prepare($query);
        if ($search) {
            $payments->execute(['search' => '%' . $search . '%']);
        } else {
            $payments->execute();
        }
        $payments = $payments->fetchAll(PDO::FETCH_ASSOC);

        $methods = $conn->prepare("SELECT methodId,methodVisibleName FROM paymentmethods");
        $methods->execute();
        $methods = $methods->fetchAll(PDO::FETCH_ASSOC);
        $methods = array_group_by($methods, "methodId");

        $PAYMENTS = [];
        for ($i = 0; $i < count($payments); $i++) {
            if ($payments[$i]["payment_status"] == 1 && $payments[$i]["payment_delivery"] == 1) {
                $paymentStatus = 'Pending';
            } elseif ($payments[$i]["payment_status"] == 3 && $payments[$i]["payment_delivery"] == 2) {
                $paymentStatus = 'Completed';
            } elseif ($payments[$i]["payment_status"] == 2 && $payments[$i]["payment_delivery"] == 2) {
                $paymentStatus = 'Failed';
            } else {
                $paymentStatus = "Pending";
            }
            $PAYMENTS[] = [
                "id" => $payments[$i]["payment_id"],
                "cid" => $payments[$i]["client_id"],
                "username" => $clients[$payments[$i]["client_id"]][0]["username"],
                "method" => $methods[$payments[$i]["payment_method"]][0]["methodVisibleName"],
                "user_balance" => number_format($payments[$i]["client_balance"], 2, '.', ''),
                "amount" => number_format($payments[$i]["payment_amount"], 2, '.', ''),
                "status" => $paymentStatus,
                "mode" => $payments[$i]["payment_mode"],
                "extra" => $payments[$i]["payment_extra"],
                "created_at" => str_replace(["am","pm"],["AM","PM"], date("j M Y, g:i a", strtotime($payments[$i]["payment_create_date"])))

            ];
        }
        header("Content-Type: application/json");
        echo json_encode($PAYMENTS);
        exit;
    }

    if ($_GET["action"] == "add_remove_balance") {
        $methods = $conn->prepare("SELECT methodId,methodVisibleName FROM paymentmethods");
        $methods->execute();
        $methods = $methods->fetchAll(PDO::FETCH_ASSOC);
        $select = "";
        for ($i = 0; $i < count($methods); $i++) {
            $select .= '<option value="' . $methods[$i]["methodId"] . '">' . $methods[$i]["methodVisibleName"] . '</option>';
        }

        // Fetch currencies from the database
        $currencies = $conn->prepare("SELECT currency_code, currency_name FROM currencies WHERE is_enable = 1");
        $currencies->execute();
        $currencies = $currencies->fetchAll(PDO::FETCH_ASSOC);
        $currencySelect = "";
        foreach ($currencies as $currency) {
            $currencySelect .= '<option value="' . $currency["currency_code"] . '">' . $currency["currency_name"] . '</option>';
        }

        // Fetch the site base currency
        $settings = $conn->prepare("SELECT site_base_currency FROM settings WHERE id = 1");
        $settings->execute();
        $settings = $settings->fetch(PDO::FETCH_ASSOC);
        $site_base_currency = $settings["site_base_currency"];

        $form = '<form method="POST" action="'.$rentaladmin.'/fund-add-history/manage-funds">';
        $form .= '<div class="form-group mb-3"><label class="form-label">Username</label><input type="text" name="username" class="form-control" required/></div>';
        $form .= '<div class="form-group mb-3"><label class="form-label">Currency</label><select class="form-select" name="currency" id="currency-select">' . $currencySelect . '</select></div>';
        
        $form .= '<div class="form-group mb-3"><label class="form-label">Amount</label><input type="number" name="amount" class="form-control" step="0.01" required id="amount-input" /></div>';
        $form .= '<div class="form-group mb-3"><label class="form-label">Method</label><select class="form-select" name="method">' . $select . '</select></div>';
        $form .= '<div class="form-group mb-3"><label class="form-label">Action</label><select class="form-select" name="action"><option value="add">Add</option><option value="deduct">Deduct</option></select></div>';
        $form .= '<div class="form-group mb-3"><label class="form-label">Order ID</label><input type="text" name="orderId" class="form-control" /></div>';
        $form .= '<div class="custom-modal-footer"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>&nbsp;&nbsp;<button type="submit" data-loading-text="Updating..." class="btn btn-primary">Apply</button></div></form>';
        $response = ["success" => true, "content" => $form, "site_base_currency" => $site_base_currency];
        header("Content-Type: application/json");
        echo json_encode($response);
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST["username"]));
    $amount = floatval($_POST["amount"]);
    $currency = $_POST["currency"];
    $methodId = intval($_POST["method"]);
    $action = $_POST["action"];
    $orderId = htmlspecialchars($_POST["orderId"]);

    // Fetch the site base currency
    $settings = $conn->prepare("SELECT site_base_currency FROM settings WHERE id = 1");
    $settings->execute();
    $settings = $settings->fetch(PDO::FETCH_ASSOC);
    $site_base_currency = $settings["site_base_currency"];

    // Check if the selected currency is the same as the site base currency
    if ($currency === $site_base_currency) {
        $convertedAmount = $amount;
    } else {
        // Fetch the conversion rate
        $conversionRate = getConversionRate($currency, $site_base_currency); // Implement this function to get the conversion rate
        $convertedAmount = $amount * $conversionRate;
    }

    $client = $conn->prepare("SELECT client_id, balance FROM clients WHERE username=:username");
    $client->execute(["username" => $username]);
    $client = $client->fetch(PDO::FETCH_ASSOC);

    if ($action == "add") {
    // Insert the payment record
    $insert = $conn->prepare("INSERT INTO payments SET client_id=:cid, client_balance=:balance, payment_amount=:amount, payment_method=:method, payment_status=:status, payment_delivery=:delivery, payment_mode=:mode, payment_create_date=:date, payment_ip=:ip, payment_extra=:extra");
    $insert->execute([
        "cid" => $client["client_id"],
        "balance" => $client["balance"],
        "amount" => +$convertedAmount,
        "method" => $methodId,
        "status" => 3,
        "delivery" => 2,
        "mode" => "Manual",
        "date" => date("Y-m-d H:i:s"),
        "ip" => GetIP(),
        "extra" => $orderId
    ]);

    // Update the client balance
    $update = $conn->prepare("UPDATE clients SET balance=:balance WHERE client_id=:id");
    $update->execute([
        "id" => $client["client_id"],
        "balance" => $client["balance"] + $convertedAmount
    ]);

    success_response_exit("Record added and amount added to balance.");
}

if ($action == "deduct") {
    // Insert the payment record
    $insert = $conn->prepare("INSERT INTO payments SET client_id=:cid, client_balance=:balance, payment_amount=:amount, payment_method=:method, payment_status=:status, payment_delivery=:delivery, payment_mode=:mode, payment_create_date=:date, payment_ip=:ip, payment_extra=:extra");
    $insert->execute([
        "cid" => $client["client_id"],
        "balance" => $client["balance"],
        "amount" => -$convertedAmount,
        "method" => $methodId,
        "status" => 3,
        "delivery" => 2,
        "mode" => "Manual",
        "date" => date("Y-m-d H:i:s"),
        "ip" => GetIP(),
        "extra" => $orderId
    ]);

    // Update the client balance
    $update = $conn->prepare("UPDATE clients SET balance=:balance WHERE client_id=:id");
    $update->execute([
        "id" => $client["client_id"],
        "balance" => $client["balance"] - $convertedAmount
    ]);

    success_response_exit("Record added and amount deducted from balance.");
}
}

function getConversionRate($fromCurrency, $toCurrency) {
    $url = "http://www.floatrates.com/daily/" . strtolower($fromCurrency) . ".json";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        // Log or handle cURL error
        curl_close($ch);
        return 1; // default fallback rate
    }

    curl_close($ch);

    $data = json_decode($response, true);

    if (isset($data[strtolower($toCurrency)]['rate'])) {
        return $data[strtolower($toCurrency)]['rate'];
    }

    return 1; // fallback if conversion not available
}

require admin_view("fund-add-history");
?>
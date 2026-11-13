<?php
if (!defined('ADDFUNDS')) {
    http_response_code(404);
    die();
}

// Fixed Function: Strict string check use kiya gaya hai
function GetBinanceData($params, $endpoint, $api_key, $secret_key) {
    $query_string = http_build_query($params);
    $query_string = str_replace('+', ' ', $query_string);

    $signature = hash_hmac('sha256', $query_string, $secret_key);
    $params['signature'] = $signature;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpoint . '?' . http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-MBX-APIKEY: ' . $api_key,
    ]);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        errorExit('Connection Error: ' . curl_error($ch));
    }
    curl_close($ch);

    return json_decode($response, true);
}

// Fixed Search: === ka use kiya gaya hai taaki "0123" aur "123" alag rahein
function search_tid($tid, $data) {
    foreach ($data as $d) {
        if (strval($d['orderId']) === strval($tid)) {
            return $d;
        }
    }
    return false;
}

$api_key = $methodExtras["api_key"];
$secret_key = $methodExtras["secret_key"];
$binance_tid = htmlspecialchars(trim($_POST["BinanceTransactionId"]));

if (empty($binance_tid)) {
    errorExit("Transaction ID cannot be empty.");
}

// SECURITY FIX: Sabse pehle check karein ki ye ID database mein kisi bhi haal mein exist toh nahi karti
$checkAlreadyUsed = $conn->prepare("SELECT * FROM payments WHERE payment_extra = :extra LIMIT 1");
$checkAlreadyUsed->execute(['extra' => $binance_tid]);

if ($checkAlreadyUsed->rowCount() > 0) {
    errorExit("This transaction ID has already been used or is currently being processed.");
}

$amount = $paymentAmount;
$endpoint = 'https://api3.binance.com/sapi/v1/pay/transactions';

$params = [
    'timestamp' => time() * 1000,
    'status' => '1', // Only success payments
    'startTime' => (time() - 604800) * 1000, // 7 days ago
    'endTime' => time() * 1000, 
];

$api_response = GetBinanceData($params, $endpoint, $api_key, $secret_key);
$data_list = $api_response['data'];

$found_data = search_tid($binance_tid, $data_list);

if ($found_data === false) {
    errorExit('Transaction not found or expired (Only last 7 days allowed).');
} else {
    // Double Check: Currency and Strict ID Match
    if ($found_data['currency'] !== 'USDT') {
        errorExit('You paid in the wrong currency. Please pay in USDT only.');
    }
    
    if (strval($found_data['orderId']) === strval($binance_tid)) {
        // Amount Check (Strictly compare as strings or floats)
        if (floatval($amount) == floatval($found_data['amount'])) {
            
            $insert = $conn->prepare(
                "INSERT INTO payments SET
                client_id=:client_id,
                payment_amount=:amount,
                payment_method=:method,
                payment_mode=:mode,
                payment_create_date=:date,
                payment_ip=:ip,
                payment_extra=:extra"
            );
            $insert->execute([
                "client_id" => $user["client_id"],
                "amount" => $paymentAmount,
                "method" => $methodId,
                "mode" => "Automatic",
                "date" => date("Y.m.d H:i:s"),
                "ip" => GetIP(),
                "extra" => $binance_tid
            ]);

            $paymentId = $conn->lastInsertId();
            $paidAmount = floatval($paymentAmount);

            if ($paymentFee > 0) {
                $fee = ($paidAmount * ($paymentFee / 100));
                $paidAmount = $paidAmount - $fee;
            }
            if ($paymentBonusStartAmount != 0 && $paidAmount > $paymentBonusStartAmount) {
                $bonus = $paidAmount * ($paymentBonus / 100);
                $paidAmount = $paidAmount + $bonus;
            }

            $paidAmount = from_to($currencies_array, $methodCurrency, $settings["site_base_currency"], $paidAmount);

            $update = $conn->prepare('UPDATE payments SET 
                client_balance=:balance, 
                payment_amount=:payment_amount, 
                payment_status=:status, 
                payment_delivery=:delivery WHERE payment_id=:id');
            $update->execute([
                'balance' => $user['balance'],
                "payment_amount" => $paidAmount,
                'status' => 3,
                'delivery' => 2,
                'id' => $paymentId
            ]);

            $updateBalance = $conn->prepare("UPDATE clients SET balance=:balance WHERE client_id=:id");
            $updateBalance->execute([
                "balance" => $user["balance"] + $paidAmount,
                "id" => $user["client_id"]
            ]);

            $response["success"] = true;
            $response["message"] = "Verified! Funds added to your account.";
            $response["content"] = '<script type="text/javascript">window.location.reload();</script>';
            
        } else {
            errorExit('The amount does not match. You entered '.$amount.' but found '.$found_data['amount']);
        }
    } else {
        errorExit('Transaction ID mismatch during verification.');
    }
}
?>
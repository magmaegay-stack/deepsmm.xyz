<?php
if (!defined('PAYMENT')) {
    http_response_code(404);
    die();
}

$merchant_uuid   = trim($methodExtras["merchant_uuid"]);
$payment_api_key = trim($methodExtras["payment_api_key"]);
$order_id = $_COOKIE['order_id_cookie'];

$paymentDetails = $conn->prepare("SELECT * FROM payments WHERE payment_extra = :extra");
$paymentDetails->execute(["extra" => $order_id]);

 if ($paymentDetails->rowCount()){
    $paymentDetails = $paymentDetails->fetch(PDO::FETCH_ASSOC);
    if (!countRow([
        'table' => 'payments',
        'where' => [
        'client_id' => $user['client_id'],
        'payment_method' => $methodId,
        'payment_status' => 3,
        'payment_delivery' => 2,
        'payment_extra' => $order_id
        ]])
    ){
        $postData = ['uuid' => $merchant_uuid,'order_id'=>$order_id];
        $body = json_encode($postData, JSON_UNESCAPED_UNICODE);
        $signature = md5(base64_encode($body) . $payment_api_key);
        $headers = [
            'Accept: application/json',
            'Content-Type: application/json;charset=UTF-8',
            'Content-Length: ' . strlen($body),
            "merchant: $merchant_uuid",
            "sign: $signature"
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://api.heleket.com/v1/payment/info",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => $body,
            CURLOPT_HTTPHEADER     => $headers
        ]);
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, true);
        $amount   = $result["result"]["payment_amount_usd"] ?? null;
        $status   = $result["result"]["status"] ?? null;
        $tid = $result["result"]["txid"] ?? null;

        if (countRow(['table' => 'payments','where' => ['client_id' => $user['client_id'],'t_id' => $tid]])){
            header("Location: " . site_url("addfunds"));
            errorExit("Payment already added.");
        }
        if(!empty($tid)){
            $update = $conn->prepare('UPDATE payments SET t_id=:utr WHERE payment_id=:id');
            $update->execute(['utr' => $tid,'id' => $paymentDetails['payment_id']]);
        }
        if (in_array($status, ['paid', 'paid_over'])){
            $paidAmount = floatval($amount);
            if ($paymentFee > 0) {
                $fee = ($paidAmount * $paymentFee) / 100;
                $paidAmount -= $fee;
            }
            if ($paymentBonusStartAmount > 0 && $paidAmount > $paymentBonusStartAmount) {
                $bonus = ($paidAmount * $paymentBonus) / 100;
                $paidAmount += $bonus;
            }
            $paidAmount = from_to($currencies_array, 'USD', $settings["site_base_currency"], $paidAmount);

            $update = $conn->prepare('UPDATE payments SET client_balance = :balance,payment_status = :status,payment_delivery = :delivery WHERE payment_id = :id');
            $update->execute(['balance'  => $user['balance'],'status'   => 3,'delivery' => 2,'id'=> $paymentDetails['payment_id']]);
            
            $new_balance = $user['balance'] + $paidAmount;
            $balance = $conn->prepare("UPDATE clients SET balance = :balance WHERE client_id = :id");
            $balance->execute(["balance" => $new_balance,"id"=> $user['client_id']]);
            header("Location: " . site_url("addfunds"));
            exit();
        }
    }else{
        header("Location: " . site_url("addfunds"));
        errorExit("Already processed.");
    }
 }else{
    header("Location: " . site_url("addfunds"));
    errorExit("Payment not found.");
 }
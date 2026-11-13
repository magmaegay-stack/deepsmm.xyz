<?php
if (!defined('ADDFUNDS')) {
    http_response_code(404);
    die();
}

$vri=md5(rand(1,999999));
           $pay_id = mt_rand(982538, 9825382937292);
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $nonce = '';
    for ($i = 1; $i <= 32; $i++) {
        $pos = mt_rand(0, strlen($chars) - 1);
        $char = $chars[$pos];
        $nonce .= $char;
    }
    $ch = curl_init();
    $timestamp = round(microtime(true) * 1000);
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
    "extra" => $pay_id
]);


    $_SESSION['TID'] = $pay_id;
    $_SESSION['VERI'] = $vri;

    $request = array(
        "env" => array(
            "terminalType" => "WEB"
        ),
        "merchantTradeNo" => $pay_id,
        "orderAmount" => $paymentAmount,
        "currency" => $methodExtras['currency'],
"returnUrl" => site_url('payment/binance?suc=' . $vri), // Corrected comma placement
        "cancelUrl" => site_url('addfunds'),
         "goods" => array(
            "goodsType" => "02",
            "goodsCategory" => "0000",
            "referenceGoodsId" => "7876763A3B",
            "goodsName" => "Addfunds in " . $_SERVER['REQUEST_URI'],
            "goodsDetail" => "Addfunds in " . $_SERVER['REQUEST_URI']        )
    );

    $json_request = json_encode($request);
    $payload = $timestamp . "\n" . $nonce . "\n" . $json_request . "\n";
    $binance_pay_key = $methodExtras['binance_pay_key'];
    $binance_pay_secret = $methodExtras['binance_pay_secret']; // Removed extra double quote here
    $signature = strtoupper(hash_hmac('SHA512', $payload, $binance_pay_secret));
    $headers = array();
    $headers[] = "Content-Type: application/json";
    $headers[] = "BinancePay-Timestamp: $timestamp";
    $headers[] = "BinancePay-Nonce: $nonce";
    $headers[] = "BinancePay-Certificate-SN: $binance_pay_key";
    $headers[] = "BinancePay-Signature: $signature";

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, "https://bpay.binanceapi.com/binancepay/openapi/v2/order");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_request);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    $responses = json_decode($result, true);

    // Check if the response contains a redirect URL
    if ($responses['status'] === 'SUCCESS') {
        // Check if the "checkoutUrl" is present in the data
        if (isset($responses['data']['checkoutUrl']) && !empty($responses['data']['checkoutUrl'])) {
               $checkOutURL = $responses['data']['checkoutUrl'];

    $redirectForm .= '<script type="text/javascript">
    window.location.href = "' . $checkOutURL . '";
    </script>';

    $response["success"] = true;
    $response["message"] = "Your payment has been initiated and you will now be redirected to the payment gateway.";
    $response["content"] = $redirectForm;
        } else {
            // Handle error or display response
            var_dump($responses);
        }
    } else {
        // Handle error or display response
        var_dump($responses);
    }

?>
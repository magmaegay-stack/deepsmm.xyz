<?php
if (!defined('ADDFUNDS')) {
    http_response_code(404);
    die();
}

function generateRandomString($length = 16): string {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

$merchant_uuid    = trim($methodExtras["merchant_uuid"]);
$payment_api_key  = trim($methodExtras["payment_api_key"]);
$orderId          = "heleket_" . strtolower(generateRandomString(32));
setcookie('order_id_cookie', $orderId, time() + 300, '/');
$callbackURL      = site_url("payment/" . $methodCallback); 
$webhookURL       = site_url("addfunds");     

$amountUSD = ROUND_AMOUNT($paymentAmount);
$postData = [
    'amount'                => (string) $amountUSD,
    'currency'              => 'USD',
    'order_id'              => $orderId,
    'url_return'            => $callbackURL,
    'url_callback'          => $webhookURL,
    'url_success'           => $callbackURL,
    'is_payment_multiple'   => false,
    'from_referral_code'    => 'w4pBRd',
    'additional_data'       => json_encode(['order_id' => $orderId])
];
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
    CURLOPT_URL            => "https://api.heleket.com/v1/payment",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 30,
    CURLOPT_CUSTOMREQUEST  => 'POST',
    CURLOPT_POSTFIELDS     => $body,
    CURLOPT_HTTPHEADER     => $headers
]);
$result = curl_exec($curl);
curl_close($curl);

$result = json_decode($result, true);
$checkOutURL = $result["result"]["url"];

if ($result["state"] == 0 && $checkOutURL) {
    $insert = $conn->prepare(
    "INSERT INTO payments SET
    client_id = :client_id,
    payment_amount = :amount,
    payment_method = :method,
    payment_mode = :mode,
    payment_create_date = :date,
    payment_ip = :ip,
    payment_extra = :extra"
);
$insert->execute([
    "client_id" => $user["client_id"],
    "amount"    => $paymentAmount,
    "method"    => $methodId,
    "mode"      => "Automatic",
    "date"      => date("Y.m.d H:i:s"),
    "ip"        => GetIP(),
    "extra"     => $orderId
]);
   $redirectForm .= '<script type="text/javascript">window.location.href = "' . $checkOutURL . '";</script>';
   $response["success"] = true;
   $response["message"] = "Your payment has been initiated and you will now be redirected to the payment gateway.";
   $response["content"] = $redirectForm;
} else {
   $errorText = $response['message'] ?? 'Heleket payment initiation failed.';
   errorExit($errorText);
}
?>
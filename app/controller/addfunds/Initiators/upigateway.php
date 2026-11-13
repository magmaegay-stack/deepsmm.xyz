<?php
if (!defined('ADDFUNDS')) {
    http_response_code(404);
    die();
}

$api_key = $methodExtras["APIKey"];
$orderId = md5(RAND_STRING(5) . time());
setcookie('order_id_cookie', $orderId, time() + 360, '/');
$callbackURL = site_url("payment/" . $methodCallback);


$postData = [
  "user_token" => $api_key,
  "amount" => $paymentAmount,
  "order_id" => $orderId,
  "redirect_url" => $callbackURL,
  "customer_mobile" => $phone,
  
];

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => 'https://indiapay.xyz/api/create-order',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => http_build_query($postData),
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/x-www-form-urlencoded'
    ]
]);

$result = curl_exec($curl);
curl_close($curl);
$result = json_decode($result, true);
$checkOutURL = $result["result"]["payment_url"];

if ($result["status"] == true) {

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
        "extra" => $orderId
    ]);



    $redirectForm .= '<script type="text/javascript">
window.location.href = "' . $checkOutURL . '";
</script>';

$response["success"] = true;
$response["message"] = "Your payment has been initiated and you will now be redirected to the payment gateway.";
$response["content"] = $redirectForm;

} else {
    errorExit("Something went wrong while initiating your payment.");
}

?>
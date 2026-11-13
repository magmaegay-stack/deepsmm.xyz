<?php
if (!defined('PAYMENT')) {
    http_response_code(404);
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["paymentId"])) {
        errorExit("Missing data.");
    }

    $razorPayPaymentId = htmlspecialchars(trim($_POST["paymentId"]));
    $APIPublicKey = $methodExtras["APIPublicKey"];
    $APISecretKey = $methodExtras["APISecretKey"];
    $razorPayPaymentAmount = $_POST["paymentAmount"];

    // Check if payment already exists
    $paymentExists = $conn->prepare("SELECT payment_extra FROM payments WHERE payment_extra=:razorPayPaymentId");
    $paymentExists->execute(["razorPayPaymentId" => $razorPayPaymentId]);
    if ($paymentExists->rowCount()) {
        errorExit("Order ID is already used.");
    }

    // Verify payment status before capturing
    $url = "https://api.razorpay.com/v1/payments/$razorPayPaymentId";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "$APIPublicKey:$APISecretKey");
    $response = curl_exec($ch);
    curl_close($ch);
    
    $paymentData = json_decode($response, true);

    if ($paymentData["status"] !== "authorized") {
        errorExit("Payment not authorized.");
    }

    // Capture payment
    $url = "https://api.razorpay.com/v1/payments/$razorPayPaymentId/capture";
    $ch = curl_init($url);
    $data = ["amount" => ($razorPayPaymentAmount * 100)];
    $headers = [
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode($APIPublicKey . ':' . $APISecretKey)
    ];

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    $response_array = json_decode($response, true);

    if ($response_array["status"] == "captured") {
        // Get latest user balance
        $userQuery = $conn->prepare("SELECT balance FROM clients WHERE client_id=:id");
        $userQuery->execute(["id" => $user["client_id"]]);
        $userData = $userQuery->fetch(PDO::FETCH_ASSOC);
        $currentBalance = $userData["balance"];

        $insert = $conn->prepare("INSERT INTO payments SET
          client_id=:client_id, payment_amount=:amount, payment_method=:method,
          payment_mode=:mode, payment_create_date=:date,
          payment_ip=:ip,
          payment_extra=:extra"
        );
        $insert->execute([
            "client_id" => $user["client_id"],
            "amount" => ($response_array["amount"] / 100),
            "method" => $methodId,
            "mode" => "Automatic",
            "date" => date("Y.m.d H:i:s"),
            "ip" => GetIP(),
            "extra" => $razorPayPaymentId
        ]);
        $paymentId = $conn->lastInsertId();
        $paidAmount = ($response_array["amount"] / 100);
        if($paymentFee > 0){
          $fee = ($paidAmount * ($paymentFee / 100));
          $paidAmount = $paidAmount - $fee;
        }
        if($paymentBonusStartAmount != 0 && $paidAmount > $paymentBonusStartAmount){
            $bonus = $paidAmount * ($paymentBonus / 100);
            $paidAmount = $paidAmount + $bonus;
        }       

        $paidAmount = from_to($currencies_array, $methodCurrency, $settings["site_base_currency"], $paidAmount);

        $update = $conn->prepare('UPDATE payments SET 
                client_balance=:balance,
                payment_status=:status, 
                payment_delivery=:delivery WHERE payment_id=:id');
        $update->execute([
            'balance' => $user["balance"],
            'status' => 3,
            'delivery' => 2,
            'id' => $paymentId
        ]);

        $balance = $conn->prepare('UPDATE clients SET balance=:balance WHERE client_id=:id');
        $balance->execute([
            "balance" => $user["balance"] + $paidAmount,
            "id" => $user["client_id"]
        ]);
        $response = ["success" => true, "message" => "The order ID is verified and the money has been added to your account."];
        header("Content-Type: application/json");
        echo json_encode($response);
    } else {
        errorExit("Payment failed.");
    }
} else {
    http_response_code(405);
    die();
}

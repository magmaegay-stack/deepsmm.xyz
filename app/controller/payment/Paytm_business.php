<?php

require_once("lib/encdec_paytm.php");

$merchantId = $methodExtras["merchantId"];
$payTMOrderId = htmlspecialchars(trim($_POST["orderid"]));

if (empty($payTMOrderId)) {
    errorExit("The Order ID cannot be empty.");
}
if (countRow(['table' => 'payments','where' => ['payment_extra' => $payTMOrderId]])){
    $paymentDetails = $conn->prepare("SELECT * FROM payments WHERE payment_extra=:orderid");
    $paymentDetails->execute(["orderid" => $payTMOrderId]);
    $paymentDetails = $paymentDetails->fetch(PDO::FETCH_ASSOC);
    
    $requestParamList = [
        "MID" => $merchantId,
        "ORDERID" => $payTMOrderId

    ];
    $responseParamList = getTxnStatusNew($requestParamList);
    if ($responseParamList["STATUS"] == "TXN_SUCCESS") {
        $update = $conn->prepare('UPDATE payments SET t_id=:orderid WHERE payment_id=:id');
        $update->execute(['orderid' => $payTMOrderId,'id' => $paymentDetails['payment_id']]);

        $paidAmount = floatval($responseParamList["TXNAMOUNT"]);
        if ($paymentFee > 0) {

            $fee = ($paidAmount * ($paymentFee / 100));
            $paidAmount -= $fee;
        }
        if ($paymentBonusStartAmount != 0 && $paidAmount > $paymentBonusStartAmount) {
            $bonus = $paidAmount * ($paymentBonus / 100);
            $paidAmount += $bonus;
        }
        $paidAmount = from_to($currencies_array, $methodCurrency, $settings["site_base_currency"], $paidAmount);
        $update = $conn->prepare('UPDATE payments SET 
        client_balance=:balance, 
        payment_status=:status, 
        payment_delivery=:delivery WHERE payment_id=:id AND payment_status=1');
        $update->execute(
            [
                'balance' => $user['balance'],
                'status' => 3,
                'delivery' => 2,
                'id' => $paymentDetails['payment_id']
            ]
        );
        
        if ($update->rowCount() > 0) {
            $updateBalance = $conn->prepare("UPDATE clients SET balance=:balance WHERE client_id=:id");
            $updateBalance->execute([
                "balance" => $user["balance"] + $paidAmount,
                "id" => $user["client_id"]
            ]);
            $response["message"] = "Payment added successfully!";
        } else {
            $response["message"] = "Payment already processed!";
        }
        
        $redirectForm .= '<script type="text/javascript">window.location.reload();</script>';
        $response["success"] = true;
        $response["content"] = $redirectForm;
        echo json_encode($response);
    } elseif ($responseParamList["STATUS"] == "TXN_FAILURE") {
        errorExit($responseParamList["RESPMSG"]);
    } else {
        errorExit("Order ID verification failed, please try again later.");
    }
}else {
    errorExit("This Order ID Not Found.");
}
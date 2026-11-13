<?php
if (!defined('PAYMENT')) {
    http_response_code(404);
    die();
}

$merchantTradeNoToFind = $_SESSION['TID'];

if ($_REQUEST['suc'] == $_SESSION['VERI']) {
    $transactionReference = $_SESSION['TID'];

    if (empty($_REQUEST['suc']) || empty($transactionReference)) {
        errorExit("Missing data.");
    }

    $paymentDetails = $conn->prepare("SELECT * FROM payments WHERE payment_extra=:transactionReference");
    $paymentDetails->execute([
        "transactionReference" => $transactionReference
    ]);

    if ($paymentDetails->rowCount()) {
        $paymentDetails = $paymentDetails->fetch(PDO::FETCH_ASSOC);

        if (!countRow([
            'table' => 'payments',
            'where' => [
                'client_id' => $user['client_id'],
                'payment_method' => $methodId,
                'payment_status' => 3,
                'payment_delivery' => 2,
                'payment_extra' => $transactionReference
            ]
        ])) {
            $paidAmount = floatval($paymentDetails["payment_amount"]);

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
                payment_delivery=:delivery WHERE payment_id=:id');

            $update->execute([
                'balance' => $user["balance"],
                'status' => 3,
                'delivery' => 2,
                'id' => $paymentDetails['payment_id']
            ]);

            $balance = $conn->prepare('UPDATE clients SET balance=:balance WHERE client_id=:id');
            $balance->execute([
                "balance" => $user["balance"] + $paidAmount,
                "id" => $user["client_id"]
            ]);

            unset($_SESSION['TID']);
            unset($_SESSION['VERI']);
            header("Location: " . site_url("addfunds"));
        } else {
            unset($_SESSION['TID']);
            unset($_SESSION['VERI']);
            errorExit("Fraudulent activity detected.");
        }
    } else {
        unset($_SESSION['TID']);
        unset($_SESSION['VERI']);
        errorExit("Order ID is already used.");
    }
} else {
    unset($_SESSION['TID']);
    unset($_SESSION['VERI']);
    errorExit("Order ID not found.");
}
// Extra closing brace removed
?>
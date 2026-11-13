<?php

if(!defined('BASEPATH')) {
   die('Direct access to the script is not allowed');
}

if ($admin["access"]["admin_access"] != 1) {
    header("Location:" . site_url("$rentaladmin"));
    exit();
}

if ($_GET["approve"]) {

    $r_p_id  = htmlspecialchars($_GET["approve"]);

    $r_payout = $conn->prepare("
        SELECT * FROM referral_payouts 
        INNER JOIN clients ON clients.ref_code = referral_payouts.r_p_code
        INNER JOIN referral ON referral.referral_code = referral_payouts.r_p_code
        WHERE r_p_id = :r_p_id
    ");
    $r_payout->execute(["r_p_id" => $r_p_id]);
    $r_payout = $r_payout->fetch(PDO::FETCH_ASSOC);

    if ($r_payout && $r_payout["r_p_status"] != 2 && $r_payout["r_p_status"] != 1) {

        $conn->beginTransaction();

        // ✅ Update payout status
        $update = $conn->prepare("
            UPDATE referral_payouts 
            SET r_p_status = :r_p_status, r_p_updated_at = :r_p_updated_at 
            WHERE r_p_id = :r_p_id
        ");
        $update->execute([
            "r_p_id" => $r_p_id, 
            "r_p_status" => 2, 
            "r_p_updated_at" => date("Y-m-d H:i:s")
        ]);

        // ✅ Add payment record
        $insert = $conn->prepare("
            INSERT INTO payments 
            SET client_id = :client_id, client_balance = :client_balance, 
                payment_amount = :payment_amount, payment_method = :payment_method,
                payment_status = :payment_status, payment_delivery = :payment_delivery,
                payment_note = :payment_note, payment_create_date = :payment_create_date,
                payment_update_date = :payment_update_date, payment_ip = :payment_ip,
                payment_extra = :payment_extra
        ");
        $insert->execute([
            "client_id" => $r_payout["client_id"],
            "client_balance" => $r_payout["balance"],
            "payment_amount" => $r_payout["r_p_amount_requested"],
            "payment_method" => 104,
            "payment_status" => 3,
            "payment_delivery" => 2,
            "payment_note" => "Affiliate Earning",
            "payment_create_date" => date("Y-m-d H:i:s"),
            "payment_update_date" => date("Y-m-d H:i:s"),
            "payment_ip" => GetIP(),
            "payment_extra" => "Affiliate Earning"
        ]);
        $last_payment_id = $conn->lastInsertId();

        // ✅ Update client balance
        $update_balance = $conn->prepare("
            UPDATE clients 
            SET balance = balance + :payment_amount 
            WHERE client_id = :client_id
        ");
        $update_balance->execute([
            "client_id" => $r_payout["client_id"],
            "payment_amount" => $r_payout["r_p_amount_requested"]
        ]);

        // ✅ Update referral commission data
        $update_referral = $conn->prepare("
            UPDATE referral 
            SET referral_earned_commision = referral_earned_commision + :payment_amount,
                referral_requested_commision = 0
            WHERE referral_code = :referral_code
        ");
        $update_referral->execute([
            "referral_code" => $r_payout["r_p_code"],
            "payment_amount" => $r_payout["r_p_amount_requested"]
        ]);

        // ✅ Update last_spent where referral_code matches ref_by
        $update_last_spent = $conn->prepare("
            UPDATE clients c
            INNER JOIN referral r ON c.ref_by = r.referral_code
            SET c.last_spent = c.spent
            WHERE r.referral_code = :referral_code
        ");
        $update_last_spent->execute([
            "referral_code" => $r_payout['r_p_code']
        ]);

        // ✅ Add to client report
        $report = $conn->prepare("
            INSERT INTO client_report 
            SET client_id = :client_id, action = :action,
                report_ip = :report_ip, report_date = :report_date
        ");
        $report->execute([
            "client_id" => $r_payout["client_id"],
            "action" => "Referral payout processed: Amount {$r_payout['r_p_amount_requested']} added. Payout ID: $r_p_id",
            "report_ip" => GetIP(),
            "report_date" => date("Y-m-d H:i:s")
        ]);

        $conn->commit();

        header("Location:" . site_url("$rentaladmin/payouts"));
        exit();
    }
}

if ($_GET["disapprove"]) {

    $r_p_id = $_GET["disapprove"];

    $r_payout = $conn->prepare("
        SELECT * FROM referral_payouts 
        WHERE r_p_id = :r_p_id
    ");
    $r_payout->execute(["r_p_id" => $r_p_id]);
    $r_payout = $r_payout->fetch(PDO::FETCH_ASSOC);

    if ($r_payout && $r_payout["r_p_status"] == 0) {
        $conn->beginTransaction();

        $update = $conn->prepare("
            UPDATE referral_payouts 
            SET r_p_status = 1, r_p_updated_at = :r_p_updated_at 
            WHERE r_p_id = :r_p_id
        ");
        $update->execute([
            "r_p_id" => $r_p_id,
            "r_p_updated_at" => date("Y-m-d H:i:s")
        ]);

        $conn->commit();
        header("Location:" . site_url("$rentaladmin/payouts"));
        exit();
    }
}

if ($_GET["reject"]) {

    $r_p_id = $_GET["reject"];

    $r_payout = $conn->prepare("
        SELECT * FROM referral_payouts 
        WHERE r_p_id = :r_p_id
    ");
    $r_payout->execute(["r_p_id" => $r_p_id]);
    $r_payout = $r_payout->fetch(PDO::FETCH_ASSOC);

    if ($r_payout && $r_payout["r_p_status"] == 0) {
        $conn->beginTransaction();

        $update = $conn->prepare("
            UPDATE referral_payouts 
            SET r_p_status = 3, r_p_updated_at = :r_p_updated_at 
            WHERE r_p_id = :r_p_id
        ");
        $update->execute([
            "r_p_id" => $r_p_id,
            "r_p_updated_at" => date("Y-m-d H:i:s")
        ]);

        $conn->commit();
        header("Location:" . site_url("$rentaladmin/payouts"));
        exit();
    }
}

$referral_payouts = $conn->prepare("
    SELECT * FROM referral_payouts 
    INNER JOIN clients ON clients.ref_code = referral_payouts.r_p_code 
    ORDER BY r_p_id DESC
");
$referral_payouts->execute();
$referral_payouts = $referral_payouts->fetchAll(PDO::FETCH_ASSOC);

require admin_view('payouts');


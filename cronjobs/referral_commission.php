<?php
// Increase execution time for large data processing
ini_set('max_execution_time', '600');
define("BASEPATH", TRUE);
require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/init.php";

// 1. Get commission rate from settings
$settings = $conn->prepare("SELECT referral_commision FROM settings LIMIT 1");
$settings->execute();
$settings = $settings->fetch(PDO::FETCH_ASSOC);
$commission_rate = $settings['referral_commision'] ?? 0;

if (!$commission_rate) {
    die("Commission rate not set in settings.\n");
}

// 2. Get all referral codes from referral table (ONLY where referral_status = 2)
$referrals = $conn->prepare("SELECT referral_id, referral_code FROM referral WHERE referral_status = :status");
$referrals->execute(["status" => 2]);
$referrals = $referrals->fetchAll(PDO::FETCH_ASSOC);

foreach ($referrals as $ref) {
    $referral_code = $ref['referral_code'];
    $referral_id = $ref['referral_id'];

    // 3. Get referred clients using ref_by
    $clients = $conn->prepare("SELECT spent, last_spent FROM clients WHERE ref_by = :referral_code");
    $clients->execute(["referral_code" => $referral_code]);
    $clients = $clients->fetchAll(PDO::FETCH_ASSOC);

    $total_commission = 0;

    foreach ($clients as $client) {
        $spent = $client['spent'] ?? 0;
        $client_last_spent = $client['last_spent'] ?? 0;

        // ✅ Commission only on the new spent amount
        $new_spent = $spent - $client_last_spent;
        if ($new_spent > 0) {
            $commission = ($new_spent * $commission_rate) / 100;
            $total_commission += $commission;
        }
    }

    // 4. Update total commission in referral table
    $update = $conn->prepare("UPDATE referral SET referral_total_commision = :total_commission WHERE referral_id = :referral_id");
    $update->execute([
        "total_commission" => $total_commission,
        "referral_id" => $referral_id
    ]);

    echo "Referral ID: {$referral_id} => Total Commission Updated: {$total_commission} <br>";
}

echo "Referral commission calculation complete!\n";

<?php
// Extend execution time in case of many users
ini_set('max_execution_time', '600');
define("BASEPATH", TRUE);

// Load dependencies
require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/init.php";

// 1. Fetch all clients
$clients = $conn->prepare("SELECT client_id, spent FROM clients");
$clients->execute();
$clients = $clients->fetchAll(PDO::FETCH_ASSOC);

// 2. Loop through each client
foreach ($clients as $client) {
    $clientId = $client['client_id'];
    $spent = $client['spent'];

    // 3. Find the best matching rank (fetch rank_name instead of rank_id)
    $rank = $conn->prepare("SELECT rank_name FROM ranks WHERE min_spent <= :spent ORDER BY min_spent DESC LIMIT 1");
    $rank->execute(["spent" => $spent]);
    $rankName = $rank->fetchColumn();

    // 4. Update client's rank_name
    $update = $conn->prepare("UPDATE clients SET rank_name = :rank_name WHERE client_id = :client_id");
    $update->execute([
        "rank_name" => $rankName,
        "client_id" => $clientId
    ]);

    echo "Client ID: {$clientId} → Assigned Rank Name: {$rankName}<br>";
}

echo "✅ Rank assignment cron executed successfully!";

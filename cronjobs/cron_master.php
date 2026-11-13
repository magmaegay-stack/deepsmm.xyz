<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Kolkata');

$domain = $_SERVER['HTTP_HOST']; 

function runCronJob($scriptPath) {
    global $domain;
    $url = "https://$domain$scriptPath";
    $command = "wget --spider -O - \"$url\" > /dev/null 2>&1";
    shell_exec($command);
}

$logFile = __DIR__ . '/cron_log.json';

if (file_exists($logFile)) {
    $lastRuns = json_decode(file_get_contents($logFile), true);
    if (!is_array($lastRuns)) {
        $lastRuns = [];
    }
} else {
    $lastRuns = [];
}

$currentTime = time();

$cronJobs = [
    5 => [  
        "/cronjobs/dripfeed.php",
        "/cronjobs/autoreply.php",
        "/cronjobs/payments.php",
        "/cronjobs/refill.php",
        "/cronjobs/average.php",
        "/cronjobs/orders.php",
        "/cronjobs/resend_orders.php",
        "/cronjobs/assign_ranks.php",
         "/cronjobs/failed_orders.php",
        "/cronjobs/autolike.php",
        "/cronjobs/seller-sync.php",
        "/cronjobs/referral_commission.php"
    ],
];

foreach ($cronJobs as $interval => $scripts) {
    foreach ($scripts as $job) {
        $lastRun = isset($lastRuns[$job]) ? (int) $lastRuns[$job] : 0;

        if (($currentTime - $lastRun) >= ($interval * 60)) { 
            runCronJob($job);
            $lastRuns[$job] = $currentTime;
        }
    }
}

file_put_contents($logFile, json_encode($lastRuns, JSON_PRETTY_PRINT));

echo "Cron jobs executed successfully on $domain.";
?>

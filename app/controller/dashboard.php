<?php
if (!defined('BASEPATH')) {
    die('Direct access to the script is not allowed');
}

$title .= "Dashboard";

if ($_SESSION["msmbilisim_userlogin"] != 1 || $user["client_type"] == 1) {
    header("Location:" . site_url('logout'));
    exit();
}
if ($settings["email_confirmation"] == 1 && $user["email_type"] == 1) {
    header("Location:" . site_url('confirm_email'));
    exit();
}

$clientId = $user["client_id"];

// Order stats counts
$stPending = $conn->prepare("SELECT COUNT(*) FROM orders WHERE client_id = :cid AND order_status = 'pending'");
$stPending->execute(['cid' => $clientId]);
$pendingCount = $stPending->fetchColumn() ?: 0;

$stProgress = $conn->prepare("SELECT COUNT(*) FROM orders WHERE client_id = :cid AND (order_status = 'inprogress' OR order_status = 'processing')");
$stProgress->execute(['cid' => $clientId]);
$inprogressCount = $stProgress->fetchColumn() ?: 0;

$stCompleted = $conn->prepare("SELECT COUNT(*) FROM orders WHERE client_id = :cid AND order_status = 'completed'");
$stCompleted->execute(['cid' => $clientId]);
$completedCount = $stCompleted->fetchColumn() ?: 0;

$stPartial = $conn->prepare("SELECT COUNT(*) FROM orders WHERE client_id = :cid AND order_status = 'partial'");
$stPartial->execute(['cid' => $clientId]);
$partialCount = $stPartial->fetchColumn() ?: 0;

$stCanceled = $conn->prepare("SELECT COUNT(*) FROM orders WHERE client_id = :cid AND (order_status = 'canceled' OR order_status = 'fail')");
$stCanceled->execute(['cid' => $clientId]);
$canceledCount = $stCanceled->fetchColumn() ?: 0;

// Recent orders
$stRecent = $conn->prepare("SELECT o.*, s.service_name FROM orders o LEFT JOIN services s ON s.service_id = o.service_id WHERE o.client_id = :cid ORDER BY o.order_id DESC LIMIT 5");
$stRecent->execute(['cid' => $clientId]);
$recentOrders = $stRecent->fetchAll(PDO::FETCH_ASSOC);

// Platform summary counts
$platformsData = [
    ['name' => 'Instagram', 'icon' => 'fab fa-instagram', 'color' => '#E1306C', 'cat_keyword' => 'Instagram', 'count' => 1768],
    ['name' => 'TikTok', 'icon' => 'fab fa-tiktok', 'color' => '#ffffff', 'cat_keyword' => 'TikTok', 'count' => 1591],
    ['name' => 'YouTube', 'icon' => 'fab fa-youtube', 'color' => '#FF0000', 'cat_keyword' => 'YouTube', 'count' => 1086],
    ['name' => 'Facebook', 'icon' => 'fab fa-facebook-f', 'color' => '#1877F2', 'cat_keyword' => 'Facebook', 'count' => 799],
    ['name' => 'X (Twitter)', 'icon' => 'fab fa-x-twitter', 'color' => '#cbd5e1', 'cat_keyword' => 'Twitter', 'count' => 528],
    ['name' => 'Telegram', 'icon' => 'fab fa-telegram-plane', 'color' => '#229ED9', 'cat_keyword' => 'Telegram', 'count' => 499],
    ['name' => 'Spotify', 'icon' => 'fab fa-spotify', 'color' => '#1ED760', 'cat_keyword' => 'Spotify', 'count' => 276],
    ['name' => 'Discord', 'icon' => 'fab fa-discord', 'color' => '#5865F2', 'cat_keyword' => 'Discord', 'count' => 36],
    ['name' => 'LinkedIn', 'icon' => 'fab fa-linkedin-in', 'color' => '#0A66C2', 'cat_keyword' => 'LinkedIn', 'count' => 59],
    ['name' => 'Snapchat', 'icon' => 'fab fa-snapchat-ghost', 'color' => '#FFFC00', 'cat_keyword' => 'Snapchat', 'count' => 34],
    ['name' => 'Twitch', 'icon' => 'fab fa-twitch', 'color' => '#9146FF', 'cat_keyword' => 'Twitch', 'count' => 27],
    ['name' => 'Google / Recensioni', 'icon' => 'fab fa-google', 'color' => '#4285F4', 'cat_keyword' => 'Google', 'count' => 89],
];

// Dynamically count services for each platform from DB
foreach ($platformsData as &$p) {
    $q = $conn->prepare("SELECT COUNT(*) FROM services s INNER JOIN categories c ON c.category_id = s.category_id WHERE c.category_name LIKE :kw AND s.service_type = 2");
    $q->execute(['kw' => '%' . $p['cat_keyword'] . '%']);
    $cnt = $q->fetchColumn();
    if ($cnt > 0) {
        $p['count'] = $cnt;
    }
}
unset($p);

$templateDir = "dashboard";

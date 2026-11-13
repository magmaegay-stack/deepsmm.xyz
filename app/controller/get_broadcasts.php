<?php
session_start();
include_once(__DIR__ . '/../config.php');

$servername = $config["db"]["host"];
$username   = $config["db"]["user"];
$password   = $config["db"]["pass"];
$database   = $config["db"]["name"];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($servername, $username, $password, $database);
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}

$current_date = date('Y-m-d H:i:s');
$user_logged_in = isset($user["client_id"]) ? $user["client_id"] : false;
$current_path = $_SERVER['REQUEST_URI'];

$query = "SELECT * FROM broadcast_notifications 
          WHERE status = 'active' 
          AND (expiry_date IS NULL OR expiry_date > ?);";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $current_date);
$stmt->execute();
$result = $stmt->get_result();

$broadcasts = [];

while ($row = $result->fetch_assoc()) {
    $target_users = $row['target_users']; // Can be 'logged-in', 'not-logged-in', or 'all'

    // Filter based on user login status
    if (($target_users === 'logged-in' && !$user_logged_in) || 
        ($target_users === 'not-logged-in' && $user_logged_in)) {
        continue;
    }

    // Add the broadcast to the list
    $broadcasts[] = [
        'id'                  => $row['id'],
        'title'               => htmlspecialchars($row['title']),
        'type'                => htmlspecialchars($row['type']),
        'info'                => htmlspecialchars($row['info']),
        'description'         => $row['description'],
        'close_button_text'   => htmlspecialchars($row['close_button_text']),
        'close_button_color'  => htmlspecialchars($row['close_button_color'] ?: '#000000'),
        'show_on_paths'       => $row['show_on_paths']
    ];
}

header('Content-Type: application/json');
echo json_encode($broadcasts, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
?>


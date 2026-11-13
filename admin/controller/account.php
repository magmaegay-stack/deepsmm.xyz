<?php
use PragmaRX\Google2FA\Google2FA;
if (!defined('BASEPATH')) {
    die('Direct access to the script is not allowed');
}


if (!$admin["access"]["super_admin"]) {
    header("Location:" . site_url(""));
    exit();
}

if (route(1) == "account" && $_POST) {

    $pass = $_POST["current_password"];
    $new_pass = $_POST["password"];
    $new_again = $_POST["confirm_password"];
    $old = $admin["password"]; // Direct password (no hashing)

    // Check if the old password is correct (no hashing, directly comparing)
    if ($old != $pass) {
        $error = 1;
        $errorText = "Incorrect current password.";
        $icon = "error";
    } elseif (strlen($new_pass) < 8) {
        $error = 1;
        $errorText = $languageArray["error.account.password.length"];
    } elseif ($new_pass != $new_again) {
        $error = 1;
        $errorText = $languageArray["error.account.passwords.notmach"];
    } else {
        // Update password directly in the database (no hashing)
        $update = $conn->prepare("UPDATE admins SET password=:pass WHERE admin_id=:id");
        $update->execute([
            "id" => $admin["admin_id"],
            "pass" => $new_pass
        ]);

        $adminbottoken = $settings["adminbottoken"];

        // Fetch chat ID of the admin whose password changed
        $stmt = $conn->prepare("SELECT chat_id FROM admins WHERE admin_id = :id LIMIT 1");
        $stmt->execute(["id" => $admin["admin_id"]]);
        $adminData = $stmt->fetch(PDO::FETCH_ASSOC);
        $chat_id = $adminData["chat_id"] ?? null; // Default NULL if chat_id not found

        // Prepare Telegram message
        $telegramMessage = "*Admin Password Changed*\n\n";
        $telegramMessage .= "*Date & Time:* `" . date("Y-m-d H:i:s") . "`\n";
        $telegramMessage .= "*IP Address:* `" . GetIP() . "`\n\n";
        $telegramMessage .= "This is an automated notification regarding an admin password change. If this was not you, please take immediate action to secure your account.";

        // Send notification only to the affected admin
        if (!empty($chat_id)) {
            $telegramSendMsg = "https://api.telegram.org/bot$adminbottoken/sendMessage?" . http_build_query([
                'chat_id' => $chat_id,
                'text' => $telegramMessage,
                'parse_mode' => 'Markdown'
            ]);

            // Send Telegram Notification
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $telegramSendMsg);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $response = curl_exec($ch);

            // Error Handling
            if (curl_errno($ch)) {
                error_log("Telegram API Error: " . curl_error($ch)); // Log error if any
            }

            curl_close($ch);
        }

        // Redirect to logout after the password change
        header("Location:" . site_url("$rentaladmin/logout"));
        exit();
    }
}



if (route(1) == "save_chat_id" && $_POST) {
    unset($_SESSION['error']);
    unset($_SESSION['success']);

    if (!empty($_POST["chat_id"])) {
        $chat_id = trim($_POST["chat_id"]);
        $chat_id = filter_var($chat_id, FILTER_SANITIZE_NUMBER_INT); // Sanitize chat ID

        $update = $conn->prepare("UPDATE settings SET chat_id = :chat_id WHERE id = :id");

        if ($update->execute(["id" => 1, "chat_id" => $chat_id])) {
            $_SESSION['success'] = "Your Telegram account has been successfully connected.";
        } else {
            $_SESSION['error'] = "There was an issue connecting your Telegram account. Please try again.";
        }
    }

    header("Location: " . site_url("$rentaladmin/account"));
    exit();
}

if (isset($_POST['disconnect_telegram'])) {
    unset($_SESSION['error']);
    unset($_SESSION['success']);

    $update = $conn->prepare("UPDATE admins SET chat_id = NULL WHERE admin_id = :id");

    if ($update->execute(["id" => $admin["admin_id"]])) {
        $_SESSION['success'] = "Your Telegram Chat ID has been removed successfully.";
    } else {
        $_SESSION['error'] = "Failed to disconnect your Telegram account. Please try again later.";
    }

    header("Location: " . site_url("$rentaladmin/account"));
    exit();
}


$google2fa = new Google2FA();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["actionType"])) {
    unset($_SESSION['error']);
    unset($_SESSION['success']);

    $actionType = $_POST["actionType"];

    // Fetch the chat_id for the admin making the change
    $stmt = $conn->prepare("SELECT chat_id FROM admins WHERE admin_id = :id LIMIT 1");
    $stmt->execute(['id' => $admin["admin_id"]]);
    $adminData = $stmt->fetch(PDO::FETCH_ASSOC);
    $chat_id = $adminData["chat_id"] ?? null; // Default NULL if chat_id not found

    $ipAddress = GetIP();
    $dateTime = date("Y-m-d H:i:s");

    if ($actionType == "enable") {
        if (!isset($_SESSION["google_2fa_secret"])) {
            echo json_encode(["success" => false, "message" => "Session expired. Please refresh and try again."]);
            exit();
        }

        $secretKey = $_SESSION["google_2fa_secret"];
        $verificationCode = trim($_POST["verificationCode"]);

        if ($google2fa->verifyKey($secretKey, $verificationCode)) {
            $update = $conn->prepare("UPDATE admins SET two_factor = '1', two_factor_secret_key = :secret_key WHERE admin_id = :id");
            $update->execute([
                "id" => $admin["admin_id"],
                "secret_key" => $secretKey
            ]);

            // Telegram Message - Google 2FA Enabled
            $telegramMessage = "*Google Two-Factor Authentication Enabled*\n\n";
            echo json_encode(["success" => true, "message" => "Google 2FA successfully enabled."]);
        } else {
            echo json_encode(["success" => false, "message" => "Invalid verification code. Try again."]);
            exit();
        }
    } elseif ($actionType == "disable") {
        $update = $conn->prepare("UPDATE admins SET two_factor = '0', two_factor_secret_key = NULL WHERE admin_id = :id");
        $update->execute(["id" => $admin["admin_id"]]);

        // Telegram Message - Google 2FA Disabled
        $telegramMessage = "*Google Two-Factor Authentication Disabled*\n\n";
        echo json_encode(["success" => true, "message" => "Google 2FA successfully disabled."]);
    }

    $telegramMessage .= "*IP Address:* `$ipAddress`\n";
    $telegramMessage .= "*Date & Time:* `$dateTime`\n\n";
    $telegramMessage .= "This is an automated notification regarding a security setting change. If this was not you, please take immediate action.";

    // Send Telegram Notification Only If chat_id Exists
    if (!empty($chat_id)) {
        $telegramSendMsg = "https://api.telegram.org/bot" . $settings["adminbottoken"] . "/sendMessage?" . http_build_query([
            'chat_id' => $chat_id,
            'text' => $telegramMessage,
            'parse_mode' => 'Markdown'
        ]);

        // Send Telegram Notification
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $telegramSendMsg);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($ch);

        // Error Handling
        if (curl_errno($ch)) {
            error_log("Telegram API Error: " . curl_error($ch)); // Log error if any
        }

        curl_close($ch);
    }

    exit();
}



if ($_POST) {
    // Clear previous session error or success messages
    unset($_SESSION['error']);
    unset($_SESSION['success']);

    // Fetch the current admin's chat_id
    $stmt = $conn->prepare("SELECT chat_id FROM admins WHERE admin_id = :id LIMIT 1");
    $stmt->execute(['id' => $admin["admin_id"]]);
    $adminData = $stmt->fetch(PDO::FETCH_ASSOC);
    $chat_id = $adminData["chat_id"] ?? null; // Default NULL if chat_id not found

    $ipAddress = GetIP();
    $dateTime = date("Y-m-d H:i:s");

    // Check for Email 2FA Enable/Disable Action
    if (isset($_POST["email_2fa_action"])) {
        $email_2fa_action = $_POST["email_2fa_action"];

        if ($email_2fa_action == "enable") {
            $update = $conn->prepare("UPDATE admins SET email_2fa = '1' WHERE admin_id = :id");
            $update->execute(['id' => $admin["admin_id"]]);
            $_SESSION['success'] = "Email 2FA has been successfully enabled.";

            // Telegram Message - Email 2FA Enabled
            $telegramMessage = "*Email Two-Factor Authentication Enabled*\n\n";
        } elseif ($email_2fa_action == "disable") {
            $update = $conn->prepare("UPDATE admins SET email_2fa = '0' WHERE admin_id = :id");
            $update->execute(['id' => $admin["admin_id"]]);
            $_SESSION['success'] = "Email 2FA has been successfully disabled.";

            // Telegram Message - Email 2FA Disabled
            $telegramMessage = "*Email Two-Factor Authentication Disabled*\n\n";
        }

        $telegramMessage .= "*IP Address:* `$ipAddress`\n";
        $telegramMessage .= "*Date & Time:* `$dateTime`\n\n";
        $telegramMessage .= "This is an automated notification regarding a security setting change. If this was not you, please take immediate action.";

        // Send Telegram Notification Only If chat_id Exists
        if (!empty($chat_id)) {
            $telegramSendMsg = "https://api.telegram.org/bot" . $settings["adminbottoken"] . "/sendMessage?" . http_build_query([
                'chat_id' => $chat_id,
                'text' => $telegramMessage,
                'parse_mode' => 'Markdown'
            ]);

            // Send Telegram Notification
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $telegramSendMsg);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $response = curl_exec($ch);

            // Error Handling
            if (curl_errno($ch)) {
                error_log("Telegram API Error: " . curl_error($ch)); // Log error if any
            }

            curl_close($ch);
        }
    }

    // Redirect to avoid form re-submission
    header("Location: " . site_url("$rentaladmin/account"));
    exit();
}



require admin_view('account');
?>

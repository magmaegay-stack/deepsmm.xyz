<?php
function controller($controllerName) {
    $controllerName = $controllerName;
   
    return PATH . '/app/controller/' . $controllerName . '.php';
}
function view($viewName) {
    $viewName = $viewName;
    return PATH . '/app/views/' . $viewName;
}
function route($index) {
    global $route;
    if (isset($route[$index])) {
        return $route[$index];
    } else {
     return false;
    }
}
function site_url($url = false) {
  
    return URL . '/' . $url;
}
function GetIP() {
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) $ip = getenv("HTTP_CLIENT_IP");
    else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) $ip = getenv("REMOTE_ADDR");
    else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) $ip = $_SERVER['REMOTE_ADDR'];
    else $ip = "unknown";
    return ($ip);
}

function themeExtras($which) {
    global $conn;
    $theme = $conn->prepare("SELECT * FROM themes WHERE theme_dirname=:dir ");
    $theme->execute(array('dir' => THEME));
    $theme = $theme->fetch(PDO::FETCH_ASSOC);
    return json_decode($theme["theme_extras"], true);
}
$stylesheet = themeExtras('stylesheets');


/**
 * Universal Email sender for DeepSMM OTP verification
 */
function sendDeepSmmVerificationEmail($email, $username, $code, $settings) {
    $site_name = !empty($settings["site_name"]) ? $settings["site_name"] : "DeepSMM";
    $from_mail = !empty($settings["smtp_user"]) ? $settings["smtp_user"] : "noreply@deepsmm.com";
    $subject = "Codice di verifica account: {$code} - {$site_name}";

    $html = '<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<title>' . htmlspecialchars($subject) . '</title>
<style>
body { margin:0; padding:0; background-color:#070a12; font-family:\'Plus Jakarta Sans\', Arial, sans-serif; color:#f1f5f9; }
.card { max-width:540px; margin:36px auto; background:#0c121e; border:1px solid #1a2538; border-radius:20px; padding:36px 30px; text-align:center; box-shadow:0 18px 45px rgba(0,0,0,0.6); }
.logo { font-size:26px; font-weight:800; color:#10b981; letter-spacing:1px; margin-bottom:8px; }
.title { font-size:20px; font-weight:700; color:#ffffff; margin:16px 0 8px; }
.sub { color:#94a3b8; font-size:14.5px; line-height:1.6; margin:0 0 24px; }
.otp-box { background:#101726; border:2px dashed #10b981; border-radius:14px; padding:18px 26px; display:inline-block; margin:8px auto 26px; }
.otp-digits { font-family:monospace, Courier; font-size:36px; font-weight:800; letter-spacing:10px; color:#10b981; }
.footer { border-top:1px solid #151f30; padding-top:20px; margin-top:24px; font-size:12.5px; color:#64748b; line-height:1.5; }
</style>
</head>
<body>
<div class="card">
  <div class="logo">👑 ' . htmlspecialchars($site_name) . '</div>
  <div class="title">Verifica il tuo indirizzo Email</div>
  <p class="sub">Ciao <strong>' . htmlspecialchars($username) . '</strong>,<br>grazie per esserti registrato su ' . htmlspecialchars($site_name) . '! Inserisci questo codice per confermare il tuo account:</p>
  <div class="otp-box">
    <div class="otp-digits">' . htmlspecialchars($code) . '</div>
  </div>
  <p class="sub" style="font-size:13px;color:#cbd5e1;">Questo codice di verifica ha una validità di <strong>30 minuti</strong>.<br>Non condividerlo con nessuno.</p>
  <div class="footer">
    Se non hai richiesto tu la registrazione su ' . htmlspecialchars($site_name) . ', puoi semplicemente ignorare questa email.<br>
    &copy; ' . date("Y") . ' ' . htmlspecialchars($site_name) . '. Tutti i diritti riservati.
  </div>
</div>
</body>
</html>';

    // 1. Try PHPMailer via SMTP if server is configured
    if (!empty($settings["smtp_server"]) && !empty($settings["smtp_user"])) {
        try {
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = $settings["smtp_server"];
            $mail->SMTPAuth = true;
            $mail->Username = $settings["smtp_user"];
            $mail->Password = $settings["smtp_pass"];
            $mail->SMTPSecure = ($settings["smtp_protocol"] == 'ssl') ? \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS : \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = intval($settings["smtp_port"] ?: 587);
            $mail->CharSet = 'UTF-8';
            $mail->setFrom($from_mail, $site_name);
            $mail->addAddress($email, $username);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $html;
            $mail->AltBody = "Il tuo codice di verifica per {$site_name} è: {$code}. Valido per 30 minuti.";
            $mail->send();
            return true;
        } catch (\Exception $e) {
            error_log("PHPMailer verification email error: " . $e->getMessage());
        }
    }

    // 2. Fallback to PHP native mail()
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: {$site_name} <{$from_mail}>\r\n";
    $headers .= "Reply-To: {$from_mail}\r\n";
    @mail($email, $subject, $html, $headers);
    return true;
}

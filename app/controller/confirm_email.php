<?php
if(!defined('BASEPATH')) {
   die('Direct access to the script is not allowed');
}

$title = "Verifica Email · " . $settings['site_name'];

// Recupera ID utente in attesa di verifica
$target_client_id = 0;
if (!empty($_SESSION["verify_client_id"])) {
  $target_client_id = intval($_SESSION["verify_client_id"]);
} elseif (!empty($_COOKIE["verify_uid"])) {
  $target_client_id = intval($_COOKIE["verify_uid"]);
  $_SESSION["verify_client_id"] = $target_client_id;
} elseif (!empty($_SESSION["msmbilisim_userid"])) {
  $target_client_id = intval($_SESSION["msmbilisim_userid"]);
}

// Se non c'è nessun utente in verifica, reindirizza a login
if ($target_client_id == 0) {
  header("Location: " . site_url('auth/login'));
  exit();
}

// Carica dati utente dal DB
$stmt = $conn->prepare("SELECT * FROM clients WHERE client_id=:id");
$stmt->execute(["id" => $target_client_id]);
$client = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$client) {
  unset($_SESSION["verify_client_id"]);
  header("Location: " . site_url('auth/login'));
  exit();
}

// Se l'utente è già verificato (email_type == 2)
if ($client["email_type"] == 2 && $client["mail_verify"] == 2) {
  $_SESSION["msmbilisim_userlogin"] = 1;
  $_SESSION["msmbilisim_userid"] = $client["client_id"];
  $_SESSION["msmbilisim_userpass"] = $client["password"];
  unset($_SESSION["verify_client_id"]);
  header("Location: " . site_url('dashboard'));
  exit();
}

$error = 0;
$errorText = "";
$success = 0;
$successText = "";

// Azione: Re-invia codice
if (route(1) == "resend") {
  $new_code = (string)mt_rand(100000, 999999);
  $new_expire = date("Y-m-d H:i:s", strtotime("+30 minutes"));
  
  $up = $conn->prepare("UPDATE clients SET email_verify_code=:code, email_verify_expire=:exp WHERE client_id=:id");
  $up->execute(["code" => $new_code, "exp" => $new_expire, "id" => $client["client_id"]]);
  
  sendDeepSmmVerificationEmail($client["email"], $client["username"], $new_code, $settings);
  
  $success = 1;
  $successText = "Un nuovo codice a 6 cifre è stato inviato alla tua email (" . htmlspecialchars($client["email"]) . ").";
}

// Azione: Verifica codice POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["verify_code"])) {
  $input_code = trim($_POST["verify_code"]);
  $input_code = preg_replace('/[^0-9]/', '', $input_code);

  if (empty($input_code) || strlen($input_code) != 6) {
    $error = 1;
    $errorText = "Inserisci un codice valido di 6 cifre.";
  } else {
    // Verifica codice e scadenza
    if (!empty($client["email_verify_code"]) && $client["email_verify_code"] === $input_code) {
      // Codice corretto: attiva account
      $up = $conn->prepare("UPDATE clients SET email_type=2, mail_verify=2, email_verify_code=NULL, email_verify_expire=NULL WHERE client_id=:id");
      $up->execute(["id" => $client["client_id"]]);

      // Effettua login e imposta sessioni e cookie completi
      $_SESSION["msmbilisim_userlogin"] = 1;
      $_SESSION["msmbilisim_userid"] = $client["client_id"];
      $_SESSION["msmbilisim_userpass"] = $client["password"];
      setcookie("u_id", $client["client_id"], strtotime('+28 days'), '/', null, null, true);
      setcookie("u_password", $client["password"], strtotime('+28 days'), '/', null, null, true);
      setcookie("u_login", 'ok', strtotime('+28 days'), '/', null, null, true);
      setcookie("verify_uid", "", time() - 3600, '/', null, null, true);
      unset($_SESSION["verify_client_id"]);

      header("Location: " . site_url('dashboard'));
      exit();
    } else {
      $error = 1;
      $errorText = "Il codice di verifica inserito non è corretto. Riprova.";
    }
  }
}

// Se non ha ancora un codice generato, ne creiamo uno subito
if (empty($client["email_verify_code"])) {
  $code = (string)mt_rand(100000, 999999);
  $exp = date("Y-m-d H:i:s", strtotime("+30 minutes"));
  $up = $conn->prepare("UPDATE clients SET email_verify_code=:code, email_verify_expire=:exp WHERE client_id=:id");
  $up->execute(["code" => $code, "exp" => $exp, "id" => $client["client_id"]]);
  $client["email_verify_code"] = $code;
  sendDeepSmmVerificationEmail($client["email"], $client["username"], $code, $settings);
}
?>
<!DOCTYPE html>
<html lang="it" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title) ?></title>
  <link rel="icon" type="image/png" href="/public/Eternity/logo.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', sans-serif; }
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #070a12;
      color: #f1f5f9;
      padding: 24px;
      position: relative;
    }
    body::before {
      content: '';
      position: absolute;
      width: 450px;
      height: 450px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(16, 185, 129, 0.12) 0%, transparent 70%);
      top: -100px;
      left: 50%;
      transform: translateX(-50%);
      pointer-events: none;
    }
    .verify-box {
      width: 100%;
      max-width: 440px;
      background: #0c121e;
      border: 1px solid #1a2538;
      border-radius: 24px;
      padding: 38px 32px;
      box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.7), 0 0 0 1px rgba(16, 185, 129, 0.15);
      position: relative;
      z-index: 2;
      text-align: center;
    }
    .brand-logo {
      height: 44px;
      margin-bottom: 20px;
      object-fit: contain;
      filter: drop-shadow(0 4px 12px rgba(16, 185, 129, 0.35));
    }
    .icon-badge {
      width: 54px;
      height: 54px;
      border-radius: 16px;
      background: rgba(16, 185, 129, 0.12);
      border: 1px solid rgba(16, 185, 129, 0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #10b981;
      font-size: 22px;
      margin: 0 auto 16px;
    }
    h2 { font-size: 22px; font-weight: 800; color: #fff; margin-bottom: 8px; }
    p.sub { font-size: 13.5px; color: #94a3b8; line-height: 1.6; margin-bottom: 24px; }
    p.sub strong { color: #10b981; }
    .otp-input {
      width: 100%;
      height: 54px;
      background: #101726;
      border: 1px solid #1e2c44;
      border-radius: 14px;
      color: #10b981;
      font-size: 26px;
      font-weight: 800;
      letter-spacing: 12px;
      text-align: center;
      margin-bottom: 20px;
      font-family: monospace;
      outline: none;
      transition: all 0.25s ease;
    }
    .otp-input:focus {
      border-color: #10b981;
      box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2);
    }
    .verify-btn {
      width: 100%;
      height: 48px;
      border-radius: 12px;
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: #fff;
      font-size: 15px;
      font-weight: 800;
      border: none;
      cursor: pointer;
      box-shadow: 0 8px 24px -5px rgba(16, 185, 129, 0.5);
      transition: all 0.25s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }
    .verify-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 28px -5px rgba(16, 185, 129, 0.65);
    }
    .alert-msg {
      padding: 12px 16px;
      border-radius: 12px;
      font-size: 13px;
      font-weight: 600;
      margin-bottom: 20px;
      text-align: left;
    }
    .alert-danger {
      background: rgba(239, 68, 68, 0.15);
      color: #f87171;
      border: 1px solid rgba(239, 68, 68, 0.3);
    }
    .alert-success {
      background: rgba(16, 185, 129, 0.15);
      color: #34d399;
      border: 1px solid rgba(16, 185, 129, 0.3);
    }
    .test-box {
      background: rgba(16, 185, 129, 0.08);
      border: 1px dashed #10b981;
      border-radius: 12px;
      padding: 12px;
      margin-bottom: 20px;
      font-size: 13px;
      color: #34d399;
    }
    .actions-foot {
      margin-top: 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 13px;
    }
    .actions-foot a {
      color: #7b8ca6;
      text-decoration: none;
      transition: color 0.2s;
    }
    .actions-foot a:hover {
      color: #10b981;
    }
  </style>
</head>
<body>
  <div class="verify-box">
    <img src="/public/Eternity/logo.png" alt="DeepSMM" class="brand-logo">
    
    <div class="icon-badge">
      <i class="fas fa-envelope-open-text"></i>
    </div>
    
    <h2>Verifica la tua Email</h2>
    <p class="sub">
      Abbiamo inviato un codice a 6 cifre all'indirizzo:<br>
      <strong><?= htmlspecialchars($client["email"]) ?></strong>
    </p>

    <?php if ($error): ?>
      <div class="alert-msg alert-danger">
        <i class="fas fa-exclamation-triangle me-1"></i> <?= htmlspecialchars($errorText) ?>
      </div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="alert-msg alert-success">
        <i class="fas fa-check-circle me-1"></i> <?= htmlspecialchars($successText) ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="/confirm_email">
      <input type="text" name="verify_code" class="otp-input" maxlength="6" placeholder="000000" autofocus required autocomplete="one-time-code">
      
      <button type="submit" class="verify-btn">
        <i class="fas fa-check"></i> Conferma & Attiva Account
      </button>
    </form>

    <div class="actions-foot">
      <a href="/confirm_email/resend"><i class="fas fa-redo me-1"></i> Invia di nuovo codice</a>
      <a href="/logout"><i class="fas fa-sign-out-alt me-1"></i> Esci</a>
    </div>
  </div>
</body>
</html>
<?php exit(); ?>

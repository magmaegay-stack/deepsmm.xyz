<?php
if(!defined('BASEPATH')) {
   die('Direct access to the script is not allowed');
}
if (!route(1)) {
  $route[1] = "signup";
}



$title .= $languageArray["signin.title"];


if ((route(1) == "login" || route(1) == "register") && $_SESSION["msmbilisim_userlogin"]) {
  Header("Location:" . site_url());
}
if (route(1) == "neworder" || route(1) == "orders" || route(1) == "tickets" || route(1) == "addfunds" || route(1) == "account" || route(1) == "dripfeeds" || route(1) == "reference" || route(1) == "subscriptions") {
  Header("Location:" . site_url());
  exit();
}
if ($_SESSION["msmbilisim_userlogin"] == 1  || $user["client_type"] == 1 || $settings["register_page"] == 1) {
  Header("Location:" . site_url());
} elseif ($route[1] == "signup" && $_POST) {
  foreach ($_POST as $key => $value) {
    $_SESSION["data"][$key]  = $value;
  }




  $name = !empty($_POST["name"]) ? filter_var(strip_tags($_POST["name"]), FILTER_SANITIZE_STRING) : '';
  $email = filter_var(strip_tags($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $username = filter_var(strip_tags($_POST["username"]), FILTER_SANITIZE_STRING);
  $phone = !empty($_POST["telephone"]) ? filter_var(strip_tags($_POST["telephone"]), FILTER_VALIDATE_INT) : '';
  $pass = $_POST["password"];
  





  $pass_again     = !empty($_POST["password_again"]) ? $_POST["password_again"] : $pass;
  $terms          = !empty($_POST["terms"]) ? $_POST["terms"] : 1;
  if (empty($name)) {
    $name = $username;
  }
  $captcha        = $_POST['g-recaptcha-response'];
  $googlesecret   = $settings["recaptcha_secret"];
  $captcha_control = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$googlesecret&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
  $captcha_control = json_decode($captcha_control);

  $ref_code =  substr(bin2hex(random_bytes(18)), 5, 6);

  if ($captcha && $settings["recaptcha"] == 2 && $captcha_control->success == false) {
    $error      = 1;
    $errorText  = $languageArray["error.signup.recaptcha"];
  } elseif (!username_check($username)) {
    $error      = 1;
    $errorText  = $languageArray["error.signup.usename"];
  } elseif (userdata_check("username", $username)) {
    $error      = 1;
    $errorText  = $languageArray["error.signup.username.used"];
  } elseif (!email_check($email)) {
    $error      = 1;
    $errorText  = $languageArray["error.signup.email"];
  } elseif (userdata_check("email", $email)) {
    $error      = 1;
    $errorText  = $languageArray["error.signup.email.used"];
  } elseif (strlen($pass) < 8) {
    $error      = 1;
    $errorText  = $languageArray["error.signup.password"];
  } elseif ($pass != $pass_again) {
    $error      = 1;
    $errorText  = $languageArray["error.signup.password.notmatch"];
  } elseif (!$terms) {
    $error      = 1;
    $errorText  = $languageArray["error.signup.terms"];
  } else {
    $apikey = CreateApiKey($_POST);
$secure_token = bin2hex(random_bytes(32));
$verify_code = (string)mt_rand(100000, 999999);
$verify_expire = date("Y-m-d H:i:s", strtotime("+30 minutes"));

$conn->beginTransaction();
$insert = $conn->prepare("INSERT INTO clients SET 
    name = :name, 
    username = :username, 
    email = :email, 
    password = :pass, 
    lang = :lang, 
    telephone = :phone, 
    register_date = :date, 
    apikey = :key, 
    ref_code = :ref_code, 
    email_type = 2, 
    balance = :spent, 
    spent = :spent, 
    currency_type = :currency_type, 
    secure_token = :secure_token, 
    balance_type = :balance_type, 
    debit_limit = :debit_limit, 
    access = :access, 
    rank_name = :rank_name,
    email_verify_code = NULL,
    email_verify_expire = NULL,
    mail_verify = 2");

$insert = $insert->execute(array(
    "lang" => $selectedLang,
    "name" => $name ? $name : $username,
    "username" => $username,
    "email" => $email,
    "pass" => md5($pass),
    "phone" => $phone ? $phone : "",
    "date" => date("Y.m.d H:i:s"),
    "key" => $apikey,
    "ref_code" => $ref_code,
    "spent" => "0.0000000",
    "currency_type" => get_default_currency(),
    "secure_token" => $secure_token,
    "balance_type" => 2,
    "debit_limit" => '',
    "access" => '',
    "rank_name" => 'Newbie'
));

if ($insert) :
    $client_id = $conn->lastInsertId();



    endif;



    $insert2 = $conn->prepare("INSERT INTO client_report SET client_id=:c_id, action=:action, report_ip=:ip, report_date=:date ");
    $insert2 = $insert2->execute(array("c_id" => $client_id, "action" => "A new user has successfully registered.", "ip" => GetIP(), "date" => date("Y-m-d H:i:s")));
    if ($insert && $insert2) :
      $conn->commit();
      unset($_SESSION["data"]);
      $success    = 1;
      $successText = $languageArray["error.signup.success"];

      if ($_COOKIE['ref']) {
        $ref_by = $_COOKIE['ref'];
        $insert12 = $conn->prepare("UPDATE clients SET ref_by=:ref_by WHERE client_id=:c_id");
        $insert12->execute(array("c_id" => $client_id, "ref_by" => $ref_by));






        if (countRow(['table' => 'referral', 'where' => ['referral_code' => $ref_by]])) {

          $select = $conn->prepare("SELECT * FROM referral WHERE referral_code=:referral_code");
          $select->execute(array("referral_code" => $ref_by));
          $select  = $select->fetch(PDO::FETCH_ASSOC);



          //update signup value
          $update = $conn->prepare("UPDATE referral SET referral_sign_up=:referral_sign_up WHERE referral_code=:referral_code");
          $update = $update->execute(array("referral_code" => $ref_by, "referral_sign_up" => $select["referral_sign_up"] + 1));
        } else {
          //insert

          $clients  = $conn->prepare("SELECT * FROM clients WHERE ref_code=:ref_code ");
          $clients->execute(array("ref_code" => $ref_by));
          $clients  = $clients->fetch(PDO::FETCH_ASSOC);


          $insert = $conn->prepare("INSERT INTO referral SET referral_code=:referral_code");
          $insert->execute(array("referral_code" => $ref_by));

          $update = $conn->prepare("UPDATE referral SET referral_client_id=:referral_client_id , referral_sign_up=:referral_sign_up WHERE referral_code=:referral_code");
          $update = $update->execute(array("referral_client_id" => $clients["client_id"],  "referral_code" => $ref_by, "referral_sign_up" => 1));
        }
      }


if ($settings["alert_welcomemail"] == 2) {
$site_name = $settings["site_name"];
 // Email content
    $to = "$email"; 
    $from = $settings["smtp_user"]; 
$fromName = $settings["site_seo"]; 
$replyTo = $settings["admin_mail"];
    $subject = "Welcome to {$settings['site_name']}!";
    $email_message = "<html><body style='font-family: Inter, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>";
$email_message .= "<div style='max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); padding: 20px; text-align: center;'>";
$email_message .= "<div style='background: #007bff; color: #ffffff; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 10px 10px 0 0;'>";
$email_message .= "Welcome to {$settings['site_name']}!</div>";
$email_message .= "<div style='padding: 20px; font-size: 16px; color: #333; line-height: 1.6;'>";
$email_message .= "<p>Hello, <strong>{$username}</strong>!</p>";
$email_message .= "<p>Thank you for signing up with <strong>{$settings['site_name']}</strong>!</p>";
$email_message .= "<p>Your account has been successfully created.</p>";
$email_message .= "<p><strong>Username:</strong> {$username}</p>";
$email_message .= "<p>You can log in to your account using the link below:</p>";
$email_message .= "<p><a href='" . site_url() . "' style='color: #007bff; text-decoration: none; font-weight: bold;'>" . site_url() . "</a></p>";
$email_message .= "<p>We look forward to serving you!</p><br>";
$email_message .= "<p>Best regards,<br><strong>{$settings['site_name']}</strong> Team</p>";
$email_message .= "</div>";
$email_message .= "<div style='margin-top: 20px; font-size: 14px; color: #777;'>";
$email_message .= "&copy; " . date("Y") . " {$settings['site_name']}. All rights reserved.";
$email_message .= "</div>";
$email_message .= "</div>";
$email_message .= "</body></html>";

$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
$headers .= 'Reply-To: '.$replyTo . "\r\n";
if(mail($to, $subject, $email_message, $headers)){ 
}else{ 
     } 
        
      }


$insert = $conn->prepare("INSERT INTO referral SET referral_code=:referral_code , referral_client_id=:referral_client_id");
         $insert->execute(array("referral_code" => $ref_code , 
      "referral_client_id" => $client_id));

if ($settings["freebalance"] == 2) {
$update111 = $conn->prepare("UPDATE clients SET balance=:balance WHERE client_id=:id ");
        $update111 = $update111->execute(array(
            "id" => $client_id,
            "balance" => $settings["freeamount"] + $user["balance"]
        ));
$freebalance = ($settings["freeamount"] + $user["balance"]) 
        ;
$insert = $conn->prepare("INSERT INTO payments SET client_id=:client_id , client_balance=:client_balance , 
            payment_amount=:payment_amount , payment_method=:payment_method ,
            payment_status=:payment_status , payment_delivery=:payment_delivery , payment_note=:payment_note,
            payment_create_date=:payment_create_date ,
             payment_update_date=:payment_update_date, 	payment_ip=:payment_ip , 
             payment_extra=:payment_extra ");
        $insert = $insert->execute(array(
            "client_id" => $client_id,
            "client_balance" => 0.00,
            "payment_amount" =>  $freebalance, "payment_method" => 104,
            "payment_status" => 3, "payment_delivery" => 2, "payment_note" => "Free balance of $freebalance credited for new user.",
             "payment_create_date" => date("Y-m-d H:i:s"),
            "payment_update_date" => date("Y-m-d H:i:s"), "payment_ip" => GetIP(),
            "payment_extra" => "Free balance of $freebalance credited for new user."
        ));

$insert2 = $conn->prepare("INSERT INTO client_report SET client_id=:c_id, action=:action, report_ip=:ip, report_date=:date ");
            
    $insert2 = $insert2->execute(array("c_id" => $client_id, "action" => 
    "Free balance of $freebalance credited for new user." , "ip" => GetIP(), "date" => date("Y-m-d H:i:s")));
} 
    // Login automatico immediato: accesso diretto alla dashboard
    $_SESSION["msmbilisim_userlogin"] = 1;
    $_SESSION["msmbilisim_userid"] = $client_id;
    $_SESSION["msmbilisim_userpass"] = md5($pass);
    $currency_hash = get_currency_hash_by_code(get_default_currency());
    $_SESSION["currency_hash"] = $currency_hash;

    setcookie("u_id", $client_id, strtotime('+28 days'), '/', null, null, true);
    setcookie("u_password", md5($pass), strtotime('+28 days'), '/', null, null, true);
    setcookie("u_login", 'ok', strtotime('+28 days'), '/', null, null, true);
    setcookie("currency_hash", $currency_hash, strtotime('+28 days'), '/', null, null, true);

    header('Location:' . site_url(''));
    exit();









    else :
      $conn->rollBack();
      $error      = 1;
      $errorText  = $languageArray["error.signup.fail"];
    endif;
  }
}


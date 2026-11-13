<?php
if(!defined('BASEPATH')) {
    die('Direct access to the script is not allowed');
}
if( $admin["access"]["manager"] != 1 ){

    header("Location:".site_url(""));
    exit();
}
if ($_SESSION["client"]["data"]):
    $data = $_SESSION["client"]["data"];
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    unset($_SESSION["client"]);
endif;


if (!route(2) ||  route(2) != "admins") :
    $route[2]   = "admins";
endif;


//Only Super Admin allowed
if (!$admin["access"]["super_admin"]) :
    header("Location:" . site_url("$rentaladmin"));
    exit();
endif;

$action = route(3);

if (route(2) == "admins") :
    $adminsData   = $conn->prepare("SELECT * FROM admins WHERE admin_type=:type ");
    $adminsData->execute(array("type" => 3));
    $admins = $adminsData->fetchAll(PDO::FETCH_ASSOC);

    $staffData   = $conn->prepare("SELECT * FROM admins WHERE admin_type=:type ");
    $staffData->execute(array("type" => 2));
    $staffsData   = $staffData->fetchAll(PDO::FETCH_ASSOC);
endif;

if($action == "delete_staff"):
    $id = route(4);
    $delete = $conn->prepare("DELETE FROM admins WHERE admin_id=:id");
    $delete->execute(array("id" => $id));
    $error    = 1;
    $errorText = "Successful";
    $icon     = "success";
    header("Location: ".site_url("$rentaladmin/manager"));
    exit();
elseif ($action == "edit") :

    $admin_id = route(4);

    $name = $_POST['name'];
    $name = strip_tags($name);
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = strip_tags($email);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $username = $_POST['username'];
    $username = strip_tags($username);
    $username = filter_var($username, FILTER_SANITIZE_STRING);

    $telephone = $_POST['telephone'];
    $telephone = strip_tags($telephone);
    $telephone = filter_var($telephone, FILTER_VALIDATE_INT);

    $client_type = $_POST['client_type'];
    $admin_access = $_POST['admin_access'];

    // Fetching two_factor and email_2fa from form
    $two_factor = $_POST['two_factor'];
    $email_2fa = $_POST['email_2fa'];

    $accessArray = array();
    foreach ($admin_access as $access) {
        $accessArray[$access] = 1;
    }

    if ($admin["access"]["super_admin"]) {
        $accessArray["super_admin"] = 1;
    }
    $accessArray = json_encode($accessArray);

    // Validation checks
    if (empty($name) || strlen($name) < 5) {
        $error      = 1;
        $errorText  = "Member name must be at least 5 characters";
        $icon     = "error";
    } elseif (!email_check($email)) {
        $error      = 1;
        $errorText  = "Please enter valid email format.";
        $icon     = "error";
    } elseif (!username_check($username)) {
        $error      = 1;
        $errorText  = "The username must contain a minimum of 4 and a maximum of 32 characters, including letters and numbers.";
        $icon     = "error";
    } elseif (!empty($telephone) && $conn->query("SELECT * FROM admins WHERE username!='$username' && telephone='$telephone'")->rowCount()) {
        $error      = 1;
        $errorText  = "The phone number you specified is used.";
        $icon     = "error";
    } else {
        // Update operation with two_factor and email_2fa
        $conn->beginTransaction();
        $update = $conn->prepare("UPDATE admins SET admin_name=:name, admin_email=:email,
        username=:username, telephone=:telephone,
        access=:access, client_type=:client_type,
        two_factor=:two_factor, email_2fa=:email_2fa WHERE admin_id=:id");
        
        $update->execute(array(
            "id" => $admin_id, "name" => $name, "email" => $email, "username" => $username,
            "telephone" => $telephone, "client_type" => $client_type, "access" => $accessArray,
            "two_factor" => $two_factor, "email_2fa" => $email_2fa
        ));

        if ($update) :
            $conn->commit();
            $referrer = site_url("$rentaladmin/manager");
            $error    = 1;
            $errorText = "Successful";
            $icon     = "success";
        else :
            $conn->rollBack();
            $error    = 1;
            $errorText = "Unsuccessful";
            $icon     = "error";
            $referrer = site_url("$rentaladmin/manager");
        endif;
    }

    echo json_encode(["t" => "error", "m" => $errorText, "s" => $icon, "r" => $referrer]);
    exit();

elseif ($action == "new") :

    $name = $_POST['name'];
    $name = strip_tags($name);
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = strip_tags($email);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $username = $_POST['username'];
    $username = strip_tags($username);
    $username = filter_var($username, FILTER_SANITIZE_STRING);

    $telephone = $_POST['telephone'];
    $telephone = strip_tags($telephone);
    $telephone = filter_var($telephone, FILTER_VALIDATE_INT);

    $client_type = $_POST['client_type'];
    $admin_access = $_POST['admin_access'];

    $password = $_POST['password'];

    // Getting the two_factor and email_2fa values from the form
    $two_factor = $_POST['two_factor'];
    $email_2fa = $_POST['email_2fa'];
    
    $accessArray = array();
    foreach ($admin_access as $access) {
        $accessArray[$access] = "1";
    }
    $accessArray = json_encode($accessArray);
    $secure_token = hash("sha256", uniqid(mt_rand(), true));
    // Validation checks for new admin
    if (empty($name) || strlen($name) < 5) {
        $error      = 1;
        $errorText  = "Member name must be at least 5 characters";
        $icon     = "error";
    } elseif (!email_check($email)) {
        $error      = 1;
        $errorText  = "Please enter valid email format.";
        $icon     = "error";
    } elseif ($conn->query("SELECT * FROM admins WHERE username!='$username' && admin_email='$email'")->rowCount()) {
        $error      = 1;
        $errorText  = "The email address you entered is used.";
        $icon     = "error";
    } elseif (strlen($password) < 8) {
        $error      = 1;
        $errorText  = "Password must be at least 8 characters.";
        $icon       = "error";
    } elseif (!username_check($username)) {
        $error      = 1;
        $errorText  = "The username must contain a minimum of 4 and a maximum of 32 characters, including letters and numbers.";
        $icon     = "error";
    } elseif ($conn->query("SELECT * FROM admins WHERE username='$username'")->rowCount()) {
        $error      = 1;
        $errorText  = "The username you specified is used.";
        $icon     = "error";
    } elseif (!empty($telephone) && $conn->query("SELECT * FROM admins WHERE username!='$username' && telephone='$telephone'")->rowCount()) {
        $error      = 1;
        $errorText  = "The phone number you specified is used.";
        $icon     = "error";
    } else {

        $conn->beginTransaction();
        $insert2 = $conn->prepare("INSERT INTO admins SET admin_name=:name, admin_email=:email, telephone=:telephone,
        access=:access, username=:username, password=:password, client_type=:client_type, admin_type=:admin_type, register_date=:register_date, two_factor=:two_factor, email_2fa=:email_2fa,secure_token=:secure_token");
        $insert2->execute(array(
            "name" => $name, "username" => $username, "email" => $email,
            "telephone" => $telephone, "admin_type" => 2, "password" => $password,
            "client_type" => $client_type, "access" => $accessArray,
            "register_date" => date('Y-m-d H:i:s'),
            "two_factor" => $two_factor, "email_2fa" => $email_2fa, "secure_token" => $secure_token
        ));

        if ($insert2) :
            $conn->commit();
            $referrer = site_url("$rentaladmin/manager");
            $error    = 1;
            $errorText = "Successful";
            $icon     = "success";
        else :
            $conn->rollBack();
            $error    = 1;
            $errorText = "Unsuccessful";
            $icon     = "error";
            $referrer = site_url("$rentaladmin/manager");
        endif;
    }

    echo json_encode(["t" => "error", "m" => $errorText, "s" => $icon, "r" => $referrer]);
    exit();
endif;

require admin_view('manager');

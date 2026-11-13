<?php
session_start();
ob_start();
$config = require __DIR__.'/app/config.php';
try {
  $conn = new PDO("mysql:host=".$config["db"]["host"].";dbname=".$config["db"]["name"].";charset=".$config["db"]["charset"].";", $config["db"]["user"], $config["db"]["pass"] );
} catch (PDOException $e) {
  die($e->getMessage());
}
$url = $_SERVER["SERVER_NAME"];  
$settings = $conn->prepare("SELECT * FROM settings WHERE id=:id");
$settings->execute(array("id"=>1));
$settings = $settings->fetch(PDO::FETCH_ASSOC);

$old = $settings['oldadminname'];
if(isset($_POST['newadminname'])){
     $new = $_POST['newadminname'];
	 define('psw_admin_url', "https://$url/$new/settings"); 
	 $oldfile = "app/controller/".$old.".php";
            $newfile = "app/controller/".$new.".php";
		rename($oldfile,$newfile);
		if(rename){
		$conn->beginTransaction();
            $update = $conn->prepare("UPDATE settings SET oldadminname=:old WHERE id=:id ");
            $update = $update->execute(array(
                "old" => $new,
                "id" => 1
            ));
		header('Location: ' . filter_var(psw_admin_url));
	}

	
}

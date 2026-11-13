<?php
if(!defined('BASEPATH')) {
   die('Direct access to the script is not allowed');
}

if( $admin["access"]["users"] != 1  ):
    header("Location:".site_url("$rentaladmin/access"));
    exit();
endif;

if( $_SESSION["client"]["data"] ):
    $data = $_SESSION["client"]["data"];
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    unset($_SESSION["client"]);
endif;

if( $_GET["mode"] ):
    $mode = $_GET["mode"];
    $mode = ($mode == "dark") ? "dark" : "sun";
    $update = $conn->prepare("UPDATE admins SET mode=:max WHERE admin_id=:id");
    $update->execute(array("max"=>$mode ,"id"=> $admin["admin_id"]));
    header("Location:".site_url("$rentaladmin"));
endif;

if( route(1) == "dark"):
    $update = $conn->prepare("UPDATE admins SET mode=:max WHERE admin_id=:id");
    $update->execute(array("max"=> "dark","id"=> $admin["admin_id"])); 
endif;

if( route(1) == "sun"):
    $update = $conn->prepare("UPDATE admins SET mode=:max WHERE admin_id=:id");
    $update->execute(array("max"=> "sun","id"=> $admin["admin_id"])); 
endif;

$units = $conn->prepare("SELECT * FROM units_per_page WHERE page=:page");
$units->execute(array("page"=> route(1)));
$units = $units->fetch(PDO::FETCH_ASSOC);
$pageunits = route(1);

if( $_GET["units"] ):
    $unit = $_GET["units"];
    $update = $conn->prepare("UPDATE units_per_page SET unit=:units WHERE id=:id");
    $update->execute(array("units"=>$unit,"id"=> 1));
    header("Location:".site_url("$rentaladmin/$pageunits"));
endif;

if( !route(2) ):
    $page = 1;
elseif( is_numeric(route(2)) ):
    $page = route(2);
elseif( !is_numeric(route(2)) ):
    $action = route(2);
endif;

// Set default sorting column and order
$sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'client_id';  // Default to sorting by ID
$order = isset($_GET['order']) ? $_GET['order'] : 'desc';  // Default to descending order

// Define allowed columns for sorting
$allowedSortColumns = ['client_id', 'balance', 'spent', 'orders'];

// Check if the sort column is allowed, else default to 'client_id'
if (!in_array($sortColumn, $allowedSortColumns)) {
    $sortColumn = 'client_id';
}

// Build the SQL ORDER BY clause
$orderByClause = "$sortColumn $order";

// Search functionality
if( empty($action) ):
    if( $_GET["search"] ):
        $search_where = $_GET["search_type"];
        $search_word  = urldecode($_GET["search"]);
        $search       = $search_where." LIKE '%".$search_word."%'";
        $count        = $conn->prepare("SELECT * FROM clients WHERE {$search}");
        $count->execute(array());
        $count = $count->rowCount();
        $search = "WHERE {$search}";
        $search_link = "?search=".$search_word."&search_type=".$search_where;
    else:
        $count = $conn->prepare("SELECT * FROM clients");
        $count->execute(array());
        $count = $count->rowCount();
    endif;

    $to = $units["unit"];
    $pageCount = ceil($count/$to);
    if( $page > $pageCount ): $page = 1; endif;
    $where = ($page * $to) - $to;

    $paginationArr = ["count"=>$pageCount, "current"=>$page, "next"=>$page+1, "previous"=>$page-1];

    // Fetch sorted clients
    $clients = $conn->prepare("SELECT * FROM clients $search ORDER BY $orderByClause LIMIT $where,$to");
    $clients->execute(array());
    $clients = $clients->fetchAll(PDO::FETCH_ASSOC);

    // Include the view
    require admin_view('clients');
elseif( $action == "set_discount_percentage" ):
$id = route(3);
if( $_POST ):
$discount_percent = $_POST["discount_percentage_value"];

$conn->beginTransaction();
$insert = $conn->prepare("UPDATE clients SET discount_percentage=:discount_percentage WHERE client_id=:id ");
$insert = $insert-> execute(array("discount_percentage"=>$discount_percent ,"id"=>$id));
  
if( $insert ):
$conn->commit();
$referrer = site_url("$rentaladmin/clients");
$error    = 1;
$errorText= "Success";
$icon     = "success";
else:
$conn->rollBack();
$error    = 1;
$errorText= "Failed";
$icon     = "error";
endif;

echo json_encode(["t"=>"error","m"=>$errorText,"s"=>$icon,"r"=>$referrer]);
endif;
elseif ($action == "set_discount"):
    if ($_POST) {
        $discount_percentage = $_POST["discount_percentage"];

        // Update discount percentage for all clients
        $update = $conn->prepare("UPDATE clients SET discount_percentage=:discount_percentage");
        $update->execute(array("discount_percentage" => $discount_percentage));

        if ($update) {
            $_SESSION["client"]["data"]["success"] = 1;
            $_SESSION["client"]["data"]["successText"] = "Discount set successfully.";
        } else {
            $_SESSION["client"]["data"]["error"] = 1;
            $_SESSION["client"]["data"]["errorText"] = "Failed to set discount.";
        }

        header("Location:" . site_url("$rentaladmin/clients"));
        exit();
    }
endif;
    
if( $action == "view" ):
$viewid = route(3);
$views        = $conn->prepare("SELECT * FROM clients WHERE client_id=:id ");
$views        -> execute(array("id" => $viewid ));
$views       = $views->fetchAll(PDO::FETCH_ASSOC);
    $viewList    = [];
      foreach ($views as $view) {
$_SESSION["msmbilisim_userlogin"]      = 1;
        $_SESSION["msmbilisim_userid"]         = $view["client_id"];
        $_SESSION["msmbilisim_userpass"]       = $view["password"];
        $_SESSION["recaptcha"]                = false;
        
            setcookie("u_id", $view["client_id"], strtotime('+1 days'), '/', null, null, true);
            setcookie("u_password", $view["password"], strtotime('+1 days'), '/', null, null, true);
            setcookie("u_login", 'ok', strtotime('+1 days'), '/', null, null, true );
        } 
        header('Location:'.site_url(''));

elseif ($action == "delete_fake_users") :
    $sevenDaysAgo = (new DateTime())->modify('-7 days')->format("Y-m-d H:i:s");

    // Fetch clients to delete
    $stmt = $conn->prepare("SELECT client_id, username FROM clients WHERE register_date < :sevenDaysAgo AND balance = 0 AND spent = 0");
    $stmt->execute(["sevenDaysAgo" => $sevenDaysAgo]);
    $clientsToDelete = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($clientsToDelete)) {
        $clientIds = array_column($clientsToDelete, "client_id");

        // Delete related reports first
        $deleteReports = $conn->prepare("DELETE FROM client_report WHERE client_id IN (" . implode(',', $clientIds) . ")");
        $deleteReports->execute();

        // Delete clients
        $deleteClients = $conn->prepare("DELETE FROM clients WHERE client_id IN (" . implode(',', $clientIds) . ")");
        $deleteClients->execute();

        // Generate deleted client list
        $deletedUsersList = "<ul class='list-group'>";
        foreach ($clientsToDelete as $client) {
            $deletedUsersList .= "<li class='list-group-item'>{$client['username']} </li>";
        }
        $deletedUsersList .= "</ul>";

        echo json_encode([
            "success" => true,
            "message" => "Successfully removed " . count($clientsToDelete) . " inactive users.",
            "deletedUsers" => $deletedUsersList
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "No inactive users found."
        ]);
    }
    exit();



  elseif( $action == "new" ):
      if( $_POST ):
        $name       = $_POST["name"];
        $email      = $_POST["email"];
        $username   = $_POST["username"];
        $pass       = $_POST["password"];
        $tel        = $_POST["telephone"];
        
        $email_type = $_POST["email_type"];
        $access     = $_POST["access"];
        $admin      = $_POST["access"]["admin_access"];
        

        if( !email_check($email) ){
          $error      = 1;
          $errorText  = "Please enter a valid email format.";
          $icon     = "error";
        }elseif( userdata_check("email",$email) ){
          $error      = 1;
          $errorText  = "The email address you entered is used.";
          $icon     = "error";
        }elseif( !username_check($username) ){
          $error      = 1;
          $errorText  = "The username must contain a minimum of 4 and a maximum of 32 characters, including letters and numbers.";
          $icon     = "error";
        }elseif( userdata_check("username",$username) ){
          $error      = 1;
          $errorText  = "The username you specified is used.";
          $icon     = "error";
        }elseif( !empty($phone) && userdata_check("telephone",$phone) ){
          $error      = 1;
          $errorText  = "The phone number you specified is used.";
          $icon     = "error";
        }elseif( strlen($pass) < 8 ){
          $error      = 1;
          $errorText  = "Password must be at least 8 characters.";
          $icon     = "error";
        }else{
          $apikey = CreateApiKey($_POST);
          $secure_token = bin2hex(random_bytes(32));
          $conn->beginTransaction();
          $insert = $conn->prepare("INSERT INTO clients SET name=:name, username=:username, email=:email, password=:pass, lang=:lang, telephone=:phone, register_date=:date, apikey=:key, access=:access, email_type=:email_type, secure_token=:secure_token ");
          $insert = $insert-> execute(array("lang"=>"en","name"=>$name,"username"=>$username,"email"=>$email,"pass"=>md5($pass),"phone"=>$tel,"date"=>date("Y.m.d H:i:s"),'key'=>$apikey,'access'=>json_encode($access),'email_type'=>$email_type,
                "secure_token"=> $secure_token ));
          if( $insert ):
            $conn->commit();
            $referrer = site_url("$rentaladmin/clients");
            $error    = 1;
            $errorText= "New user has been added successfully.";
            $icon     = "success";
          else:
            $conn->rollBack();
            $error    = 1;
            $errorText= "Failed to add the user. Please try again.";
            $icon     = "error";
          endif;
        }
        echo json_encode(["t"=>"error","m"=>$errorText,"s"=>$icon,"r"=>$referrer]);
      endif;
      
  elseif( $action == "edit" ):
    $user_id  = route(3);
    if( !countRow(["table"=>"clients","where"=>["client_id"=>$user_id]]) ): header("Location:".site_url("$rentaladmin/clients")); exit(); endif;
    $client_detail  = getRow(["table"=>"clients","where"=>["client_id"=>$client_id]]);
    $client_access  = json_decode($client_detail["access"],true);
        if( $_POST ):
          $name       = $_POST["name"];
          $username = $_POST["username"];
          $email      = $_POST["email"];
          $tel        = $_POST["telephone"];
          
          $email_type = $_POST["email_type"];
          $access     = $_POST["access"];
          $admin      = $_POST["access"]["admin_access"];
          $balance    = $_POST["balance"];

          if( !email_check($email) ){
            $error      = 1;
            $errorText  = "Please enter a valid email format.";
            $icon     = "error";
          }elseif( $conn->query("SELECT * FROM clients WHERE client_id!='$user_id' && email='$email' ")->rowCount() ){
            $error      = 1;
            $errorText  = "The email address you entered is used.";
            $icon     = "error";
          }elseif( !username_check($username) ){
            $error      = 1;
            $errorText  = "The username must contain a minimum of 4 and a maximum of 32 characters, including letters and numbers.";
            $icon     = "error";
          }elseif( !empty($phone) && $conn->query("SELECT * FROM clients WHERE client_id!='$user_id' && telephone='$telephone' ")->rowCount() ){
            $error      = 1;
            $errorText  = "The phone number you specified is used.";
            $icon     = "error";
          }else{
            $apikey = CreateApiKey($_POST);
            $conn->beginTransaction();
            
            $insert = $conn->prepare("UPDATE clients SET username=:username,name=:name, balance=:balance, email=:email, telephone=:phone, register_date=:date, email_type=:email_type, access=:access WHERE client_id=:id ");
            $insert = $insert-> execute(array("id"=>route(3),"username"=>$username,"balance"=>$balance,"name"=>$name,"email"=>$email,"phone"=>$tel,"date"=>date("Y.m.d H:i:s"),'email_type'=>$email_type,'access'=>json_encode($access) ));
            if( $insert ):
              $conn->commit();
              $referrer = site_url("$rentaladmin/clients");
              $error    = 1;
              $errorText= "User details have been updated successfully.";
              $icon     = "success";
            else:
              $conn->rollBack();
              $error    = 1;
              $errorText= "Failed to update user details. Please try again.";
              $icon     = "error";
            endif;
          }
          echo json_encode(["t"=>"error","m"=>$errorText,"s"=>$icon,"r"=>$referrer]);
        endif;
        
  elseif( $action == "pass" ):
    $username  = route(3);
    // if( !countRow(["table"=>"clients","where"=>["username"=>$username]]) ): header("Location:".site_url("$rentaladmin/clients")); exit(); endif;
    $client_detail  = getRow(["table"=>"clients","where"=>["username"=>$username]]);
    $client_access  = json_decode($client_detail["access"],true);
        if( $_POST ):
          $password = $_POST["password"];

          if( strlen($password) < 8 ){
            $error      = 1;
            $errorText  = "Password must be at least 8 characters.";
            $icon       = "error";
          }else{
            $conn->beginTransaction();
            $insert = $conn->prepare("UPDATE clients SET password=:pass WHERE username=:username ");
            $insert = $insert-> execute(array("username"=>$username,"pass"=>md5($password)));
            // $conn->commit();
            if( $insert ):
              $conn->commit();
              $referrer = site_url("$rentaladmin/clients");
              $error    = 1;
              $errorText= "User password has been changed successfully.";
              $icon     = "success";
            else:
              $conn->rollBack();
              $error    = 1;
              $errorText= "Failed to change password. Please try again.";
              $icon     = "error";
            endif;
          }
          echo json_encode(["t"=>"error","m"=>$errorText,"s"=>$icon,"r"=>$referrer]);
        endif;
        
elseif( $action == "export" ):
    if( $_POST ):
        $format           = $_POST["format"]; // JSON, CSV, XML, TXT
        $export_status    = $_POST["client_status"]; // All (-1), Active (1), Inactive (0)
        $colums           = $_POST["exportcolumn"]; // Selected columns
        $email_status     = $_POST["email_status"]; // Email verification status
        $export           = array();
        $colum            = "";

        foreach ($colums as $key => $value) {
            $colum .= $key . ",";
        }
        $colum = rtrim($colum, ",");

        $where = "WHERE ";
        if ($export_status != "all"): 
            $where .= "client_type=" . $export_status . " &&"; 
        endif;
        if ($email_status != "all"): 
            $where .= "email_type=" . $email_status; 
        else: 
            if (substr($where, -2) == "&&"): 
                $where = substr($where, 0, -2); 
            endif; 
        endif;
        if ($where == "WHERE "): 
            $where = ""; 
        endif;

        $row = $conn->prepare("SELECT $colum FROM clients $where ORDER BY client_id DESC");
        $row->execute(array());
        $row = $row->fetchAll(PDO::FETCH_ASSOC);

        if ($format == "json") {
            $file_name = 'users.json';
            file_put_contents($file_name, json_encode($row, JSON_PRETTY_PRINT));
        } elseif ($format == "csv") {
            $file_name = 'users.csv';
            $fp = fopen($file_name, 'w');
            fputcsv($fp, array_keys($row[0])); // Add column headers
            foreach ($row as $data) {
                fputcsv($fp, $data);
            }
            fclose($fp);
        } elseif ($format == "xml") {
            $file_name = 'users.xml';
            $xml = new SimpleXMLElement('<clients/>');
            foreach ($row as $data) {
                $client = $xml->addChild('client');
                foreach ($data as $key => $value) {
                    $client->addChild($key, htmlspecialchars($value));
                }
            }
            $xml->asXML($file_name);
        } elseif ($format == "txt") {
            $file_name = 'users.txt';
            $fp = fopen($file_name, 'w');
            foreach ($row as $data) {
                fwrite($fp, implode("\t", $data) . "\n");
            }
            fclose($fp);
        }

        if (file_exists($file_name)) {
            force_download($file_name);
            unlink($file_name);
        }

      endif;
      
  elseif( $action == "price" ):
    if( $_POST ):
      $client = route(3);
      foreach( $_POST["price"] as $id => $price ):
        if( $price == null ):
          $delete = $conn->prepare("DELETE FROM clients_price WHERE client_id=:client && service_id=:service ");
          $delete->execute(array("service"=>$id,"client"=>$client));
        elseif( getRow(["table"=>"clients_price","where"=>["client_id"=>$client,"service_id"=>$id] ]) ):
          $update = $conn->prepare("UPDATE clients_price SET client_id=:client, service_price=:price WHERE service_id=:service && client_id=:clientt ");
          $update->execute(array("service"=>$id,"client"=>$client,"clientt"=>$client,"price"=>$price));
        else:
          $insert = $conn->prepare("INSERT INTO clients_price SET client_id=:client, service_price=:price, service_id=:service ");
          $insert->execute(array("service"=>$id,"client"=>$client,"price"=>$price));
        endif;
      endforeach;
      $error    = 1;
      $errorText= "Success";
      $icon     = "success";
      echo json_encode(["t"=>"error","m"=>$errorText,"s"=>$icon,"r"=>$referrer]);
      exit();
    endif;
    $username  = route(3);
    if( !countRow(["table"=>"clients","where"=>["username"=>$username]]) ): header("Location:".site_url("$rentaladmin/clients")); exit(); endif;
    $client_detail  = getRow(["table"=>"clients","where"=>["username"=>$username]]);
    $client_access  = json_decode($client_detail["access"],true);
    $services       = $conn->prepare("SELECT * FROM services ORDER BY service_id ASC ");
    $services->execute(array());
    $services       = $services->fetchAll(PDO::FETCH_ASSOC);
    $serviceList    = [];
      foreach ($services as $service) {
        $price  = getRow(["table"=>"clients_price","where"=>["service_id"=>$service["service_id"],"client_id"=>$client_detail["client_id"]]]);
        $service["client_price"]  = $price["service_price"];
        array_push($serviceList,$service);
      }
  elseif( $action == "active" ):
    $client_id  = route(3);
    if( countRow(["table"=>"clients","where"=>["client_id"=>$client_id,"client_type"=>2]]) ): header("Location:".site_url("$rentaladmin/clients")); exit(); endif;
    $update = $conn->prepare("UPDATE clients SET client_type=:type WHERE client_id=:id ");
    $update->execute(array("type"=>2,"id"=>$client_id));
      if( $update ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Client successfully activated.";
      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Failed to activate client.";
      endif;
    header("Location:".site_url("$rentaladmin/clients"));
  elseif( $action == "deactive" ):
    $client_id  = route(3);
    if( countRow(["table"=>"clients","where"=>["client_id"=>$client_id,"client_type"=>1]]) ): header("Location:".site_url("$rentaladmin/clients")); exit(); endif;
    $update = $conn->prepare("UPDATE clients SET client_type=:type WHERE client_id=:id ");
    $update->execute(array("type"=>1,"id"=>$client_id));
      if( $update ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Client successfully deactivated.";
      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Failed to deactivate client.";
      endif;
      header("Location:".site_url("$rentaladmin/clients"));
  elseif( $action == "del_price" ):
    $client_id  = route(3);
    if( !countRow(["table"=>"clients_price","where"=>["client_id"=>$client_id]]) ): $_SESSION["client"]["data"]["error"]    = 1; $_SESSION["client"]["data"]["errorText"]= "Pricing for the member was not found."; header("Location:".site_url("$rentaladmin/clients")); exit(); endif;
    $delete = $conn->prepare("DELETE FROM clients_price  WHERE client_id=:id ");
    $delete->execute(array("id"=>$client_id));
      if( $delete ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Success";
      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Failed";
      endif;
    header("Location:".site_url("$rentaladmin/clients"));
  elseif( $action == "change_apikey" ):
    $client_id  = route(3);
    $client_detail  = getRow(["table"=>"clients","where"=>["client_id"=>$client_id]]);
    $apikey     = CreateApiKey(["email"=>$client_detail["email"],"username"=>$client_detail["username"]]);
    if( countRow(["table"=>"clients","where"=>["client_id"=>$client_id,"client_type"=>1]]) ): header("Location:".site_url("$rentaladmin/clients")); exit(); endif;
    $update = $conn->prepare("UPDATE clients SET apikey=:key WHERE client_id=:id ");
    $update->execute(array("key"=>$apikey,"id"=>$client_id));
      if( $update ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "API Key successfully updated.";
      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Failed to update API Key. Please try again later.";
      endif;
      header("Location:".site_url("$rentaladmin/clients"));
  elseif( $action == "secret_category" ):
    $client = route(3);
    $type   = $_GET["type"];
    $id     = $_GET["id"];
      if( $type == "on" ):
        $search   = $conn->query("SELECT * FROM clients_category WHERE client_id='$client' && category_id='$id' ");
        if( !$search->rowCount() ):
          $insert = $conn->prepare("INSERT INTO clients_category SET client_id=:client, category_id=:c_id  ");
          $insert->execute(array("client"=>$client,"c_id"=>$id));
            if( $insert ):
              echo "1";
            else:
              echo "0";
            endif;
        else:
          echo "0";
        endif;
      elseif( $type == "off" ):
        $search   = $conn->query("SELECT * FROM clients_category WHERE client_id='$client' && category_id='$id' ");
        if( $search->rowCount() ):
          $delete = $conn->prepare("DELETE FROM clients_category WHERE client_id=:client && category_id=:c_id  ");
          $delete->execute(array("client"=>$client,"c_id"=>$id));
            if( $delete ):
              echo "1";
            else:
              echo "0";
            endif;
          else:
            echo "0";
          endif;
      endif;
  elseif( $action == "secret_service" ):
    $client = route(3);
    $type   = $_GET["type"];
    $id     = $_GET["id"];
      if( $type == "on" ):
        $search   = $conn->query("SELECT * FROM clients_service WHERE client_id='$client' && service_id='$id' ");
        if( !$search->rowCount() ):
          $insert = $conn->prepare("INSERT INTO clients_service SET client_id=:client, service_id=:c_id   ");
          $insert->execute(array("client"=>$client,"c_id"=>$id));
            if( $insert ):
              echo "1";
            else:
              echo "0";
            endif;
          else:
            echo "0";
        endif;
      elseif( $type == "off" ):
        $search   = $conn->query("SELECT * FROM clients_service WHERE client_id='$client' && service_id='$id' ");
        if( $search->rowCount() ):
          $delete = $conn->prepare("DELETE FROM clients_service WHERE client_id=:client && service_id=:c_id  ");
          $delete->execute(array("client"=>$client,"c_id"=>$id));
            if( $delete ):
              echo "1";
            else:
              echo "0";
            endif;
        else:
          echo "0";
        endif;
      endif;
elseif ($action == "discount"):
    $discount_percentage = isset($_POST["discount_percentage"]) ? trim($_POST["discount_percentage"]) : null;
    $user_type = $_POST["discount_type"] ?? null;
    $specific_users = $_POST["specific_users"] ?? null;

    if ($user_type == "specific" && empty($specific_users)):
        $error = 1;
        $errorText = "Usernames cannot be empty for specific users.";
        $icon = "error";
    elseif ($discount_percentage === "" || !is_numeric($discount_percentage)):
        // ✅ Fix: Allow "0" as a valid discount but prevent empty values
        $error = 1;
        $errorText = "Discount Percentage cannot be empty or invalid.";
        $icon = "error";
    elseif ($user_type == "all"):
        // ✅ Update discount for all users
        $update = $conn->prepare("UPDATE clients SET discount_percentage = :discount_percentage");
        $update->execute(['discount_percentage' => $discount_percentage]);

        if ($update):
            $error = 0;
            $errorText = "Discount applied successfully to all users.";
            $icon = "success";
        else:
            $error = 1;
            $errorText = "Failed to apply discount.";
            $icon = "error";
        endif;
    elseif ($user_type == "specific"):
        // ✅ Update discount for specific users
        $usernames = preg_split('/\r\n|\r|\n/', $specific_users);
        $success = true;

        foreach ($usernames as $username):
            $username = trim($username);
            if (!empty($username)):
                $update = $conn->prepare("UPDATE clients SET discount_percentage = :discount_percentage WHERE username = :username");
                $result = $update->execute([
                    'discount_percentage' => $discount_percentage,
                    'username' => $username
                ]);

                if (!$result):
                    $success = false;
                    break;
                endif;
            endif;
        endforeach;

        if ($success):
            $error = 0;
            $errorText = "Discount applied successfully to the specified users.";
            $icon = "success";
        else:
            $error = 1;
            $errorText = "Failed to apply discount to some or all specified users.";
            $icon = "error";
        endif;
    endif;

    echo json_encode(["t" => ($error ? "error" : "success"), "m" => $errorText, "s" => $icon, "r" => $referrer]);
endif;

if ($action == "alert") {
    $message  = $_POST["message"];
    $user     = $_POST["user_type"];
    $username = $_POST["username"];
    $notification_type = $_POST["notification_type"];

    if ($user == "secret" && !getRow(["table" => "clients", "where" => ["username" => $username]])) {
        $error = 1;
        $errorText = "User not found";
        $icon = "error";
    } elseif (empty($message)) {
        $error = 1;
        $errorText = "Notification Message Cannot Be Empty";
        $icon = "error";
    } else {
        $users = ($user == "all") ? $conn->query("SELECT * FROM clients")->fetchAll(PDO::FETCH_ASSOC) : [getRow(["table" => "clients", "where" => ["username" => $username]])];

        foreach ($users as $user) {
            if (!$user) continue;
            $chat_id = $user["chat_id"];
            $to = $user["email"];
            $formattedMessage = nl2br(htmlspecialchars($message));

            if ($notification_type == "telegram" || $notification_type == "both") {
                $telegram_api_url = "https://api.telegram.org/bot" . $settings["telegramusertoken"] . "/sendMessage";
                $data = ['chat_id' => $chat_id, 'text' => $message];
                $ch = curl_init($telegram_api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_exec($ch);
                curl_close($ch);
            }

            if ($notification_type == "email" || $notification_type == "both") {
                $subject = "New Notification from " . $settings['site_name'];
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8\r\n";
                $headers .= "From: " . $settings["site_seo"] . "<" . $settings["smtp_user"] . ">\r\n";
                $headers .= "Reply-To: " . $settings["admin_mail"] . "\r\n";
                $htmlContent = "
<html>
<head>
    <title>New Notification</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; background: #ffffff; padding: 20px; margin: 20px auto; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); }
        .header { background-color: #007bff; color: white; padding: 15px; text-align: center; font-size: 20px; font-weight: bold; border-top-left-radius: 8px; border-top-right-radius: 8px; }
        .content { padding: 20px; font-size: 16px; color: #000000; }
        .highlight { background: #f8f9fa; padding: 10px; border-radius: 5px; font-size: 16px; color: #000000; font-weight: normal; }
        .footer { text-align: center; padding: 15px; font-size: 14px; color: #666; border-top: 1px solid #ddd; margin-top: 20px; }
        a { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>{$settings['site_name']} Notification</div>
        <div class='content'>
            <p>Dear <strong>{$user['username']}</strong>,</p>
            <p>You have received a new notification:</p>
            <p class='highlight'>$formattedMessage</p>
            <p>Please log in to your account to view further details.</p>
        </div>
        <div class='footer'>
            &copy; " . date("Y") . " {$settings['site_name']} | All rights reserved.
        </div>
    </div>
</body>
</html>";
                mail($to, $subject, $htmlContent, $headers);
            }
        }

        $error = 1;
        $errorText = "Notification sent successfully.";
        $icon = "success";
    }

    echo json_encode(["t" => "error", "m" => $errorText, "s" => $icon, "r" => $referrer]);
}


?>
    
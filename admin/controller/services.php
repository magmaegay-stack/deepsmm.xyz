<?php

if(!defined('BASEPATH')) {
   die('Direct access to the script is not allowed');
}
if( $admin["access"]["services"] != 1  ):
    header("Location:".site_url("$rentaladmin"));
    exit();
endif;

  if( $_SESSION["client"]["data"] ):
    $data = $_SESSION["client"]["data"];
    foreach ($data as $key => $value) {
      $$key = $value;
    }
    unset($_SESSION["client"]);
  endif;

  if( !route(2) ):
    $page   = 1;
  elseif( is_numeric(route(2)) ):
    $page   = route(2);
  elseif( !is_numeric(route(2)) ):
    $action = route(2);
  endif;

  if( empty($action) ):

		$query = $conn->query("SELECT * FROM settings", PDO::FETCH_ASSOC);
		if ( $query->rowCount() ):
			 foreach( $query as $row ):
				  $siraal = $row['servis_siralama'];
			 endforeach;
		endif;
		
		if($_GET["siralama"]!=""):
		
			$updatesiralama = $conn->prepare("UPDATE settings SET servis_siralama=:servis_siralama WHERE id=:id ");
			$updatesiralama->execute(array("servis_siralama"=>$_GET["siralama"],"id"=>1));
         
if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
		
		endif;


$images = $conn->prepare("SELECT * FROM files");
$images->execute();
$images = $images->fetchAll(PDO::FETCH_ASSOC);
$images = array_group_by($images,"id");


$unitsPerPage = isset($_GET['getstatus']) ? $_GET['getstatus'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;
if (isset($_GET['getstatus'])) {
    $services = $conn->prepare("SELECT * FROM services RIGHT JOIN categories ON categories.category_id = services.category_id LEFT JOIN service_api ON service_api.id = services.service_api WHERE categories.category_deleted=:cat_del AND services.service_type = :type ORDER BY categories.category_line,services.service_line ".$siraal);
    $services       -> execute([
		"cat_del" => 0,
		"type" => $unitsPerPage
		]);
    $services = $services->fetchAll(PDO::FETCH_ASSOC);
    $serviceList    = array_group_by($services, 'category_name');
} 
elseif (isset($_GET['id'])) {
    $services = $conn->prepare("SELECT * FROM services RIGHT JOIN categories ON categories.category_id = services.category_id LEFT JOIN service_api ON service_api.id = services.service_api WHERE categories.category_deleted=:cat_del AND services.service_api = :id ORDER BY categories.category_line,services.service_line ".$siraal);
    $services       -> execute([
		"cat_del" => 0,
		"id" => $id
		]);
    $services = $services->fetchAll(PDO::FETCH_ASSOC);
    $serviceList    = array_group_by($services, 'category_name');
} 
else{
$services = $conn->prepare("SELECT * FROM services RIGHT JOIN categories ON categories.category_id = services.category_id LEFT JOIN service_api ON service_api.id = services.service_api WHERE categories.category_deleted=:cat_del ORDER BY categories.category_line,services.service_line ".$siraal);
    $services       -> execute([
		"cat_del" => 0
		]);
    $services = $services->fetchAll(PDO::FETCH_ASSOC);
    $serviceList    = array_group_by($services, 'category_name');
}    
    
$unitsPerPage = isset($_GET['getservices']) ? $_GET['getservices'] : 10; 
if (isset($_GET['getservices'])) {
    $updateUnits = $conn->prepare("UPDATE units_per_page SET unit = :unit WHERE page = :page");
    $updateUnits->execute(array("unit" => $unitsPerPage, "page" => route(1)));
} 
    
$count = count($serviceList);

$units = $conn->prepare("SELECT * FROM units_per_page WHERE page=:page ");

$units-> execute(array("page"=> route(1)));

$units = $units->fetch(PDO::FETCH_ASSOC);
$pageunits =  route(2);
$to = $units["unit"];


$pageCount = ceil($count/$to); if( $page > $pageCount ): $page = 1; endif;
$where = ($page*$to)-$to;

$paginationArr  = ["count"=>$pageCount,"current"=>$page,"next"=>$page+1,"previous"=>$page-1];

$serviceList = array_slice($serviceList,$where,$to,true);
 
    require admin_view('services');
    
    

    
    
    
    elseif ($action == "sort_by_price_desc") :
    $cat_id = $_POST["method_id"];
    $rows = $conn->prepare("SELECT * FROM services WHERE category_id=:c_id");
    $rows->execute(array("c_id" => $cat_id));
    $rows = $rows->fetchAll(PDO::FETCH_ASSOC);
    if (empty($rows)) :
        $res["title"] = "Empty Category Found";
        $res["icon"] = "error";
        echo json_encode($res);
        exit();
    endif;
    usort($rows, function ($a, $b) {
        return $a['service_price'] < $b['service_price'];
    });
    $sLinesArray = [];
    foreach ($rows as $row) {
        array_push($sLinesArray, $row['service_line']);
    }
    usort($sLinesArray, function ($a, $b) {
        return $a > $b;
    });
    $idx = 0;
    foreach ($rows as $row) {
        $update = $conn->prepare("UPDATE services SET service_line=:service_line WHERE service_id=:service_id");
        $update =  $update->execute(array("service_id" => $row["service_id"], "service_line" => $row["category_id"] + $sLinesArray[$idx]));
        $idx++;
    }
    if ($update) :
        $res["title"] = "Successfully sorted";
        $res["icon"] = "success";
        echo json_encode($res);
        exit();
    else :
        $res["title"] = "Something went wrong";
        $res["icon"] = "error";
        echo json_encode($res);
        exit();
    endif;
     

    elseif ($action == "sort_by_price_asc") :
    $cat_id = $_POST["method_id"];
    $rows = $conn->prepare("SELECT * FROM services WHERE category_id=:c_id");
    $rows->execute(array("c_id" => $cat_id));
    $rows = $rows->fetchAll(PDO::FETCH_ASSOC);
    if (empty($rows)) :
        $res["title"] = "Empty Category Found";
        $res["icon"] = "error";
        echo json_encode($res);
        exit();
    endif;
    usort($rows, function ($a, $b) {
        return $a['service_price'] > $b['service_price'];
    });
    $sLinesArray = [];
    foreach ($rows as $row) {
        array_push($sLinesArray, $row['service_line']);
    }
    usort($sLinesArray, function ($a, $b) {
        return $a > $b;
    });
    $idx = 0;
    foreach ($rows as $row) {
        $update = $conn->prepare("UPDATE services SET service_line=:service_line WHERE service_id=:service_id");
        $update =  $update->execute(array("service_id" => $row["service_id"], "service_line" => $row["category_id"] + $sLinesArray[$idx]));
        $idx++;
    }
    if ($update) :
        $res["title"] = "Successfully sorted";
        $res["icon"] = "success";
        echo json_encode($res);
        exit();
    else :
        $res["title"] = "Something went wrong";
        $res["icon"] = "error";
        echo json_encode($res);
        exit();
    endif;

    
    
    elseif ($action == "del_category_services") :
    $category_id = route(3);
    $rows = $conn->prepare("SELECT * FROM services WHERE category_id=:c_id  ");
    $rows->execute(array("c_id" => $category_id));
    $rows = $rows->fetchAll(PDO::FETCH_ASSOC);
    $d = 0;
    foreach ($rows as $row) {
            $delete = $conn->prepare("UPDATE services SET service_deleted=:del WHERE service_id=:id ");
            $delete->execute(array("id" => $row["service_id"], "del"=> 1));
            if ($delete) :  $d++;
            endif;
    }
    if ($d) :
        $res["title"] = "Successfully Deleted";
        $res["icon"] = "success";
        echo json_encode($res);
        exit();
    else :
        $res["title"] = "Something went wrong";
        $res["icon"] = "error";
        echo json_encode($res);
        exit();
    endif;
    
    
    
 elseif ($action == "sort_rate") :
    $input = json_decode(file_get_contents("php://input"), true);
    $order = $input["order"] ?? null;

    if ($order === "low") {
        $updateQuery = $conn->prepare("
            UPDATE services AS s1
            JOIN (
                SELECT service_id, ROW_NUMBER() OVER(ORDER BY CAST(service_price AS DECIMAL(10, 5)) ASC) AS row_num
                FROM services
            ) AS s2 ON s1.service_id = s2.service_id
            SET s1.service_line = s2.row_num
        ");
    } elseif ($order === "high") {
        $updateQuery = $conn->prepare("
            UPDATE services AS s1
            JOIN (
                SELECT service_id, ROW_NUMBER() OVER(ORDER BY CAST(service_price AS DECIMAL(10, 5)) DESC) AS row_num
                FROM services
            ) AS s2 ON s1.service_id = s2.service_id
            SET s1.service_line = s2.row_num
        ");
    } elseif ($order === "reset") {
        $updateQuery = $conn->prepare("
            UPDATE services AS s1
            JOIN (
                SELECT service_id, ROW_NUMBER() OVER(ORDER BY service_id ASC) AS row_num
                FROM services
            ) AS s2 ON s1.service_id = s2.service_id
            SET s1.service_line = s2.row_num
        ");
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Invalid sorting order."
        ]);
        exit();
    }

    $updateQuery->execute();
    $count = $updateQuery->rowCount();

    if ($count > 0) {
        echo json_encode([
            "success" => true,
            "message" => "Successfully updated order for " . $count . " services."
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "No services updated."
        ]);
    }
    exit();


elseif ($action == "remove_duplicates") :
    // Decode the incoming JSON data
    $input = json_decode(file_get_contents("php://input"), true);
    $deleteList = $input["delete"] ?? [];

    // Check if any services were selected to delete
    if (empty($deleteList)) {
        echo json_encode([
            "success" => false,
            "message" => "No selections made."
        ]);
        exit();
    }

    // Flatten the array to get all selected service IDs
    $deleteIds = [];
    foreach ($deleteList as $api_service => $service_ids) {
        $deleteIds = array_merge($deleteIds, $service_ids); // Combine all selected service IDs
    }

    // Prepare placeholders for the query based on the number of IDs
    $placeholders = str_repeat('?,', count($deleteIds) - 1) . '?';

    // Prepare and execute the query to delete the selected services
    $deleteQuery = $conn->prepare("
        UPDATE services
        SET service_deleted = '1'
        WHERE service_deleted = '0'
        AND service_id IN ($placeholders)
    ");
    $deleteQuery->execute($deleteIds);
    $deleted = $deleteQuery->rowCount(); // Get the number of rows affected

    // Return success or failure message
    echo json_encode([
        "success" => true,
        "message" => $deleted > 0 ? "Successfully deleted $deleted service(s)." : "No services selected for deletion."
    ]);
    exit();

elseif ($action == "set_auto_cat_icon") :
    $icon_action = $_POST["icon_action"];
    $icon_type = $_POST["icon_type"] ?? null;

    $categories = $conn->prepare("SELECT * FROM categories");
    $categories->execute();
    $categories = $categories->fetchAll(PDO::FETCH_ASSOC);

    $ic = [ 'instagram' => 'fab fa-instagram','ig' => 'fab fa-instagram','ins' => 'fab fa-instagram','𝐈𝐧𝐬𝐭𝐚𝐠𝐫𝐚𝐦' => 'fab fa-instagram',

'𝐈𝐍𝐒𝐓𝐀' => 'fab fa-instagram','𝐈𝐍𝐒𝐓𝐀-' => 'fab fa-instagram',

'youtube' => 'fab fa-youtube','yt' => 'fab fa-youtube','you' => 'fab fa-youtube','facebook' => 'fab fa-facebook-square','fb' => 'fab fa-facebook-square', '𝐅𝐚𝐜𝐞𝐛𝐨𝐨𝐤' => 'fab fa-facebook-square',


'x' => 'fas fa-x','x-twitter' => 'fas fa-x','website' => 'fas fa-globe','web' => 'fas fa-globe','twitter' => 'fab fa-twitter','tw' => 'fab fa-twitter','whatsapp' => 'fab fa-whatsapp','wp' => 'fab fa-whatsapp','telegram' => 'fab fa-telegram-plane','tg' => 'fab fa-telegram-plane','𝐓𝐞𝐥𝐞𝐠𝐫𝐚𝐦' => 'fab fa-telegram-plane',
'𝐓𝐠' => 'fab fa-telegram-plane',

'subscription' => 'fas fa-bell','indian' => 'fas fa-flag','spotify' => 'fab fa-spotify','virtual' => 'fas fa-vr-cardboard','playstore' => 'fab fa-google-play','snapchat' => 'fab fa-snapchat-ghost','api' => 'fas fa-code','tiktok' => 'fab fa-tiktok','threads' => 'fab fa-threads','prime' => 'fas fa-gem','new' => 'fas fa-bolt' ];


    $updated = false;
    foreach ($categories as $category) {
        $cat_lwr = strtolower($category["category_name"]);
        
        if ($icon_action == "assign") {
            $icon = "fas fa-star"; // Default icon
            foreach ($ic as $sub => $iconC) {
                if (strpos($cat_lwr, $sub) !== false) {
                    $icon = $iconC;
                    break;
                }
            }

            $save = json_encode(["icon_type" => $icon_type === "black_white" ? "icon" : "image", "icon_class" => $icon], true);
            $update = $conn->prepare("UPDATE categories SET category_icon = :icon WHERE category_id = :id");
            $update->execute(["icon" => $save, "id" => $category["category_id"]]);
            $updated = true;
        
        } elseif ($icon_action == "remove") {
            $update = $conn->prepare("UPDATE categories SET category_icon = NULL WHERE category_id = :id");
            $update->execute(["id" => $category["category_id"]]);
            $updated = true;
        }
    }

    if ($updated) {
        echo json_encode([
            "success" => true,
            "message" => $icon_action == "assign" ? "Icons assigned successfully." : "Icons removed successfully."
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "No categories updated."
        ]);
    }
    exit();

elseif ($action == "delete_categories") :
    $data = json_decode(file_get_contents("php://input"), true);
    $deleteType = $data["deleteType"];

    if ($deleteType === "empty") {
        $categories = $conn->prepare("SELECT category_id, category_name FROM categories");
        $categories->execute();
        $categories = $categories->fetchAll(PDO::FETCH_ASSOC);

        $categoriesToDelete = [];
        foreach ($categories as $category) {
            $services = $conn->prepare("SELECT service_id FROM services WHERE category_id = :id AND service_deleted = 1");
            $services->execute(["id" => $category["category_id"]]);
            $services = $services->fetchAll(PDO::FETCH_ASSOC);

            if (empty($services)) {
                $categoriesToDelete[] = $category;
            }
        }

        if (!empty($categoriesToDelete)) {
            $categoryIds = array_column($categoriesToDelete, "category_id");

           
            $delete = $conn->prepare("DELETE FROM categories WHERE category_id IN (" . implode(',', $categoryIds) . ")");
            $delete->execute();

            
            $deletedCategoriesList = "<ul class='list-group'>";
            foreach ($categoriesToDelete as $category) {
                $deletedCategoriesList .= "<li class='list-group-item'>{$category['category_name']}</li>";
            }
            $deletedCategoriesList .= "</ul>";

            echo json_encode([
                "success" => true,
                "message" => "Successfully deleted " . count($categoriesToDelete) . " empty categories.",
                "deletedCategories" => $deletedCategoriesList
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "No empty categories found."
            ]);
        }
    } elseif ($deleteType === "all") {
      
        $stmt = $conn->prepare("SELECT category_id, category_name FROM categories");
        $stmt->execute();
        $categoriesToDelete = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($categoriesToDelete)) {
            $categoryIds = array_column($categoriesToDelete, "category_id");

           
            $deleteServices = $conn->prepare("DELETE FROM services WHERE category_id IN (" . implode(',', $categoryIds) . ")");
            $deleteServices->execute();

            
            $deleteCategories = $conn->prepare("DELETE FROM categories WHERE category_id IN (" . implode(',', $categoryIds) . ")");
            $deleteCategories->execute();

            echo json_encode([
                "success" => true,
                "message" => "Successfully deleted " . count($categoriesToDelete) . " categories."
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "No categories found to delete."
            ]);
        }
    }
    exit();


elseif ($action == "sync-services") :
    if ($_POST) :
        foreach ($_POST as $key => $value) {
            $$key = $value;
        }
        if (empty($price_percentage)) :
            $error = 1;
            $errorText = "Price Percentage can not be empty.";
            $icon = "error";
        elseif ($action == "decrease" && $price_percentage > 100) :
            $error = 1;
            $errorText = "You can decrease price more than 100%";
            $icon = "error";
        else :
            if ($category_name == 0) {
                $cat_id = 0;
            } else {
                $cat_id = $category_name;
            }
            if ($cat_id == 0) {
                $services       = $conn->prepare("SELECT * FROM services WHERE service_type=:service_type");
                $services->execute(array("service_type" => 2));
                $services       = $services->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $services       = $conn->prepare("SELECT * FROM services WHERE service_type=:service_type && category_id=:cat_id");
                $services->execute(array("service_type" => 2, "cat_id" => $cat_id));
                $services       = $services->fetchAll(PDO::FETCH_ASSOC);
            }
           if ($action == "set-price") {
            $currencies_array = get_currencies_array("all");
                foreach ($services as $service) {
            $service_api_detail = $service["api_detail"];
            if(!empty($service_api_detail)){
            $service_api_detail_array = json_decode($service_api_detail,true);
             $service_api_price = $service_api_detail_array["rate"];
             $seller_currency = $service_api_detail_array["currency"];
           $converted_service_api_price = from_to($currencies_array,$seller_currency,$settings["site_base_currency"],$service_api_price);
           } else {$converted_service_api_price = $service["service_price"];}
           $service_new_price = $converted_service_api_price + ($converted_service_api_price * ($price_percentage/100));
                    $update  = $conn->prepare("UPDATE services SET service_price=:price WHERE service_id=:id");
                    $update = $update->execute(array("id" => $service["service_id"], "price" => $service_new_price));
                    if ($update) :
                        $referrer = 'javascript:window.location.reload();';
                        $error    = 1;
                        $errorText = "Success";
                        $icon     = "success";
                    else :
                        $error    = 1;
                        $errorText = "Failed";
                        $icon     = "error";
                    endif;
                }
            } 
            if ($action == "increase") {
                foreach ($services as $service) {
                    $extra_price = $service["service_price"] * ($price_percentage / 100);
                    $service_new_price = $service["service_price"] +  $extra_price;
                    $update  = $conn->prepare("UPDATE services SET service_price=:price WHERE service_id=:id");
                    $update = $update->execute(array("id" => $service["service_id"], "price" => $service_new_price));
                    if ($update) :
                        $referrer = 'javascript:window.location.reload();';
                        $error    = 1;
                        $errorText = "Success";
                        $icon     = "success";
                    else :
                        $error    = 1;
                        $errorText = "Failed";
                        $icon     = "error";
                    endif;
                }
            } elseif ($action == "decrease") {
                foreach ($services as $service) {
                    $extra_price = $service["service_price"] * ($price_percentage / 100);
                    $service_new_price = $service["service_price"] - $extra_price;
                    $update  = $conn->prepare("UPDATE services SET service_price=:price WHERE service_id=:id");
                    $update = $update->execute(array("id" => $service["service_id"], "price" => $service_new_price));
                    if ($update) :
                       $referrer = 'javascript:window.location.reload();';
                        $error    = 1;
                        $errorText = "Success";
                        $icon     = "success";
                    else :
                        $error    = 1;
                        $errorText = "Failed";
                        $icon     = "error";
                    endif;
                }
            }
        endif;
        echo json_encode(["t" => "error", "m" => $errorText, "s" => $icon, "r" => $referrer]);
 endif;







   elseif ($action == "assign-category") :
         if (empty($category)) :
        $error = 1;
        $errorText = "Category cannot be empty";
        $icon = "error";
    elseif (empty($services)) :
        $error = 1;
        $errorText = "Service cannot be empty";
        $icon = "error";
    else :

        $i = 0;
        $conn->beginTransaction();
        foreach ($services as $service) :
            $update = $conn->prepare("UPDATE services SET category_id=:category_id WHERE service_id=:id ");
            $update = $update->execute(array("id" => $service, "category_id" => $category));
            if ($update) {
                $i++;
            }
        endforeach;

        if ($i != 0) :
            $conn->commit();
            $error    = 1;
            $errorText = "Successfully Updated.";
            $icon     = "success";
            $referrer = site_url("$rentaladmin/services");
        else :
            $conn->rollBack();
            $error    = 1;
            $errorText = "Failed";
            $icon     = "error";
        endif;
    endif;

    echo json_encode(["t" => "error", "m" => $errorText, "s" => $icon, "r" => $referrer]);

  elseif( $action == "new-service" ):
      if( $_POST ):
        $language   = $conn->prepare("SELECT * FROM languages WHERE default_language=:default");
        $language->execute(array("default"=>1));
        $language   = $language->fetch(PDO::FETCH_ASSOC);
        foreach ($_POST as $key => $value) {
$$key = $value;
        }
$cat = intval(@$_POST["category"]);

        if (!$cat) $cat = $category;
$name      = mb_convert_encoding($_POST["name"][$language["language_code"]],"UTF-8","UTF-8");
        $multiName = json_encode($_POST["name"]);
        if( $package == 2 ): $max = $min; endif;
        if( empty($name) ):
$error    = 1;
$errorText= "Product name cannot be blank";
$icon     = "error";
        elseif( empty($package) ):
$error    = 1;
$errorText= "The product package cannot be empty";
$icon     = "error";
        elseif( empty($category) ):
$error    = 1;
$errorText= "Product category cannot be empty";
$icon     = "error";
        elseif( !is_numeric($min) ):
$error    = 1;
$errorText= "Minimum order quantity cannot be empty";
$icon     = "error";
        elseif( $package != 2 && !is_numeric($max) ):
$error    = 1;
$errorText= "Maximum order quantity cannot be empty";
$icon     = "error";
        elseif( $min > $max ):
$error    = 1;
$errorText= "Minimum order quantity cannot exceed the maximum order quantity";
$icon     = "error";
        elseif( $mode != 1 && empty($provider) ):
$error    = 1;
$errorText= "Service provider cannot be empty";
$icon     = "error";
        elseif( $mode != 1 && empty($service) ):
$error    = 1;
$errorText= "Service provider service information cannot be empty";
$icon     = "error";
        elseif( empty($secret) ):
$error    = 1;
$errorText= "Service privacy cannot be empty";
$icon     = "error";
        elseif( empty($want_username) ):
$error    = 1;
$errorText= "Order link cannot be empty";
$icon     = "error";
        elseif( !is_numeric($price) ):
$error    = 1;
$errorText= "The product price should consist of numbers";
$icon     = "error";
        else:
if( empty($refill_days) ):
$refill_days ="30";
endif;
if( empty($refill_hours) ):
$refill_hours ="24";
endif;
$api=$conn->prepare("SELECT * FROM service_api WHERE id=:id "); $api->execute(array("id"=>$provider)); $api=$api->fetch(PDO::FETCH_ASSOC);
if( $mode == 1 ): $provider = 0; $service = 0; endif;
if( $mode == 2 && $api["api_type"] == 1 ):
  $smmapi   = new SMMApi(); $services = $smmapi->action(array('key' =>$api["api_key"],'action' =>'services'),$api["api_url"]); $balance = $smmapi->action(array('key' =>$api["api_key"],'action' =>'balance'),$api["api_url"]);
    foreach ($services as $apiService):
      if( $service == $apiService->service ):
        $detail["min"]=$apiService->min;
        $detail["max"]=$apiService->max;
        $detail["rate"]=$apiService->rate;
        $detail["currency"]=$balance->currency;
        $detail=json_encode($detail);
      endif;
    endforeach;
else:
  $detail="";
endif;
  $row = $conn->query("SELECT * FROM services WHERE category_id='$category' ORDER BY service_line DESC LIMIT 1 ")->fetch(PDO::FETCH_ASSOC);
  $conn->beginTransaction();
  $insert = $conn->prepare("INSERT INTO services SET name_lang=:multiName, service_secret=:secret, service_api=:api, service_dripfeed=:dripfeed, instagram_second=:instagram_second, start_count=:start_count, instagram_private=:instagram_private, api_service=:api_service, api_detail=:detail, category_id=:category, service_line=:line, service_type=:type, service_package=:package, service_name=:name, service_price=:price, service_min=:min, service_max=:max, want_username=:want_username, service_speed=:speed, cancelbutton=:cancelbutton, show_refill=:show_refill, refill_days=:refill_days, refill_hours=:refill_hour ");
  $insert = $insert-> execute(array("secret"=>$secret,"multiName"=>$multiName,"instagram_second"=>$instagram_second,"dripfeed"=>$dripfeed,"start_count"=>$start_count,"instagram_private"=>$instagram_private,"api"=>$provider,"api_service"=>$service,"detail"=>$detail,"category"=>$cat,"line"=>$row["service_line"]+1,"type"=>2,"package"=>$package,"name"=>$name,"price"=>$price,"min"=>$min,"max"=>$max,"want_username"=>$want_username,"speed"=>$speed,"cancelbutton"=>$cancelbutton,"show_refill"=>$show_refill,"refill_days"=>$refill_days,"refill_hour"=>$refill_hours ));
  if( $insert ):
$conn->commit();
if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
$referrer = $_SERVER["HTTP_REFERER"];
} else {
$referrer =site_url("$rentaladmin/services");
}
$error    = 1;
$errorText= "Successful";
$icon     = "success";
  else:
$conn->rollBack();
$error    = 1;
$errorText= "Unsuccessful";
$icon     = "error";
  endif;
        endif;
        echo json_encode(["t"=>"error","m"=>$errorText,"s"=>$icon,"r"=>$referrer]);
 endif;



 

  elseif( $action == "edit-service" ):
    $service_id  = route(3);
    if( !countRow(["table"=>"services","where"=>["service_id"=>$service_id]]) ): 
    if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
} 
    
    exit(); endif;
      if( $_POST ):
        $language   = $conn->prepare("SELECT * FROM languages WHERE default_language=:default");
        $language->execute(array("default"=>1));
        $language   = $language->fetch(PDO::FETCH_ASSOC);
foreach ($_POST as $key => $value) {
  $$key = $value;
}

//print_r($_POST);exit();

$cat = intval(@$_POST["category"]);
$name      = mb_convert_encoding($_POST["name"][$language["language_code"]], 'UTF-8', 'UTF-8');
$multiName = json_encode($_POST["name"]);



if( $package == 2 ): $max = $min; endif;
$serviceInfo  = $conn->prepare("SELECT * FROM services INNER JOIN service_api ON service_api.id = services.service_api WHERE service_id=:id ");
$serviceInfo -> execute(array("id"=>route(3) ));
$serviceInfo  = $serviceInfo->fetch(PDO::FETCH_ASSOC);
        if( empty($name) ):
$error    = 1;
$errorText= "Product name cannot be blank";
$icon     = "error";
        elseif( empty($package) ):
$error    = 1;
$errorText= "The product package cannot be empty";
$icon     = "error";
        elseif( empty($category) ):
$error    = 1;
$errorText= "Product category cannot be empty";
$icon     = "error";
        elseif( !is_numeric($min) ):
$error    = 1;
$errorText= "Minimum order quantity cannot be empty";
$icon     = "error";
        elseif( $package != 2 && !is_numeric($max) ):
$error    = 1;
$errorText= "Maximum order quantity cannot be empty";
$icon     = "error";
        elseif( $min > $max ):
$error    = 1;
$errorText= "Minimum order quantity cannot exceed the maximum order quantity";
$icon     = "error";
        elseif( $mode != 1 && empty($provider) ):
$error    = 1;
$errorText= "Service provider cannot be empty";
$icon     = "error";
        elseif( $mode != 1 && empty($service) ):
$error    = 1;
$errorText= "Service provider service information cannot be empty";
$icon     = "error";
        elseif( empty($secret) ):
$error    = 1;
$errorText= "Service privacy cannot be empty";
$icon     = "error";
        elseif( empty($want_username) ):
$error    = 1;
$errorText= "Order link cannot be empty";
$icon     = "error";
        elseif( !is_numeric($price) ):
$error    = 1;
$errorText= "The product price should consist of numbers";
$icon     = "error";
        else:
  $api=$conn->prepare("SELECT * FROM service_api WHERE id=:id "); $api->execute(array("id"=>$provider)); $api=$api->fetch(PDO::FETCH_ASSOC);
  if( $mode == 1 ): $provider = 0; $service = 0; endif;
  if( $mode == 2 && $api["api_type"] == 1 ):
$smmapi   = new SMMApi(); $services = $smmapi->action(array('key' =>$api["api_key"],'action' =>'services'),$api["api_url"]); $balance = $smmapi->action(array('key' =>$api["api_key"],'action' =>'balance'),$api["api_url"]);
  foreach ($services as $apiService):
    if( $service == $apiService->service ):
      $detail["min"]=$apiService->min;
      $detail["max"]=$apiService->max;
      $detail["rate"]=$apiService->rate;
      $detail["currency"]=$balance->currency;
      $detail=json_encode($detail);
    endif;
  endforeach;
  else:
$detail="";
  endif;
  if( $serviceInfo["category_id"] != $category ): $row = $conn->query("SELECT * FROM services WHERE category_id='$category' ORDER BY service_line DESC LIMIT 1 ")->fetch(PDO::FETCH_ASSOC); $last_category=$serviceInfo["category_id"]; $last_line=$serviceInfo["service_line"]; $line= $row["service_line"] + 1; else: $line= $serviceInfo["service_line"]; endif;
  $conn->beginTransaction();
  $update = $conn->prepare("UPDATE services SET api_detail=:detail, name_lang=:multiName, service_dripfeed=:dripfeed, api_servicetype=:type, instagram_second=:instagram_second, start_count=:start_count, instagram_private=:instagram_private, service_api=:api, api_service=:api_service, category_id=:category, service_package=:package, service_name=:name,service_price=:price, service_min=:min, service_secret=:secret, service_max=:max, want_username=:want_username, service_speed=:speed, cancelbutton=:cancelbutton, show_refill=:show_refill, refill_days=:refill_days, refill_hours=:refill_hour,
  service_overflow=:service_overflow,service_sync=:sync WHERE service_id=:id ");
  $update = $update-> execute(array("id"=>route(3),"multiName"=>$multiName,"secret"=>$secret,"type"=>2,"detail"=>$detail,"dripfeed"=>$dripfeed,"instagram_second"=>$instagram_second,"start_count"=>$start_count,"instagram_private"=>$instagram_private,"api"=>$provider,"api_service"=>$service,"category"=>$category,"package"=>$package,"name"=>$name,"price"=>$price,"min"=>$min,"max"=>$max,"want_username"=>$want_username,"speed"=>$speed,"cancelbutton"=>$cancelbutton,"show_refill"=>$show_refill,"refill_days"=>$refill_days,"refill_hour"=>$refill_hours,"service_overflow" => $service_overflow,"sync" => $service_sync));
  if( $update ):
$conn->commit();
$rows = $conn->prepare("SELECT * FROM services WHERE category_id=:c_id && service_line>=:line ");
$rows->execute(array("c_id"=>$last_category,"line"=>$last_line ));
$rows = $rows->fetchAll(PDO::FETCH_ASSOC);
  foreach( $rows as $row ):
    $update = $conn->prepare("UPDATE services SET service_line=:line WHERE service_id=:id ");
    $update->execute(array("line"=>$row["service_line"]-1,"id"=>$row["service_id"] ));
  endforeach;
$error    = 1;
$errorText= "Successful";
$icon     = "success";
if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
$referrer = $_SERVER["HTTP_REFERER"];
} else {
$referrer =site_url("$rentaladmin/services");
}
if($serviceInfo["show_refill"] != $show_refill ):

  
if($show_refill == "true"):
$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Refill Activated","description"=>"Refill Button Has Been Activated","date"=>date("Y-m-d H:i:s") ));
else:
$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Refill Deactivated","description"=>"Refill Button Has Been Deactivated","date"=>date("Y-m-d H:i:s") ));
endif;
endif;
if($serviceInfo["cancelbutton"] != $cancelbutton ):
if($cancelbutton == "1"):
$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Cancel Activated","description"=>"Cancel Button Has Been Activated","date"=>date("Y-m-d H:i:s") ));
else:
$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Cancel Deactivated","description"=>"Cancel Button Has Been Deactivated","date"=>date("Y-m-d H:i:s") ));
endif;
endif;



if($serviceInfo["service_price"] < $price ):

  

$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Price Increased","description"=>"Price changed from ". $serviceInfo["service_price"] ." to $price","date"=>date("Y-m-d H:i:s") ));
endif;
if($serviceInfo["service_price"] > $price ):

  

$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Price Decreased","description"=>"Price changed from ". $serviceInfo["service_price"] ." to $price","date"=>date("Y-m-d H:i:s") ));
endif;

if($serviceInfo["service_min"] < $min ):

  

$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Minimum Increased","description"=>"Minimum amount changed from ". $serviceInfo["service_min"] ." to $min","date"=>date("Y-m-d H:i:s") ));
endif;
if($serviceInfo["service_min"] > $min ):

  

$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Minimum Decreased","description"=>"Minimum amount changed from ". $serviceInfo["service_min"] ." to $min","date"=>date("Y-m-d H:i:s") ));
endif;
if($serviceInfo["service_max"] < $max ):

  

$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Maximum Increased","description"=>"Maximum amount changed from ". $serviceInfo["service_max"] ." to $max","date"=>date("Y-m-d H:i:s") ));
endif;
if($serviceInfo["service_max"] > $max ):

  

$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Maximum Decreased","description"=>"Maximum amount changed from ". $serviceInfo["service_max"] ." to $max","date"=>date("Y-m-d H:i:s") ));
endif;
 else:
$conn->rollBack();
$error    = 1;
$errorText= "Unsuccessful";
$icon     = "error";
  endif;
        endif;
        echo json_encode(["t"=>"error","m"=>$errorText,"s"=>$icon,"r"=>$referrer]);
      endif;

      elseif( $action == "edit-service-name" ):
        $service_id  = route(3);
    if( !countRow(["table"=>"services","where"=>["service_id"=>$service_id]]) ):
    if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
    header("Location:".$_SERVER["HTTP_REFERER"]); 
    } else {
    header("Location:".site_url("$rentaladmin/services")); 
    }
    
      exit();
      
      endif;
          if( $_POST ):
            $language   = $conn->prepare("SELECT * FROM languages WHERE default_language=:default");
            $language->execute(array("default"=>1));
            $language   = $language->fetch(PDO::FETCH_ASSOC);
    foreach ($_POST as $key => $value) {
      $$key = $value;
    }
        
    $multiDesc    = $_POST["service_name"];
    
    $multiName = json_encode($multiDesc);
    
      $conn->beginTransaction();
    $update = $conn->prepare("UPDATE services SET service_name=:name,name_lang=:name_lang WHERE service_id=:id ");
    $update = $update-> execute(array(
    "id"=>route(3),
    "name" =>  $multiDesc[$language["language_code"]],
    "name_lang"=>$multiName
    ));
    
      if( $update ):
    $conn->commit();
    $error    = 1;
    $errorText= "Successful";
    $icon     = "success";
      else:
    $conn->rollBack();
    $error    = 1;
    $errorText= "Unsuccessful";
    $icon     = "error";
      endif;
    
            echo json_encode(["t"=>"error","m"=>$errorText,"s"=>$icon]);
          endif;
  elseif( $action == "edit-description" ):
    $service_id  = route(3);
if( !countRow(["table"=>"services","where"=>["service_id"=>$service_id]]) ):
if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
 
  
  exit();
  
  endif;
      if( $_POST ):
        $language   = $conn->prepare("SELECT * FROM languages WHERE default_language=:default");
        $language->execute(array("default"=>1));
        $language   = $language->fetch(PDO::FETCH_ASSOC);
foreach ($_POST as $key => $value) {
  $$key = $value;
}
    
$multiDesc    = $_POST["service_description"];
$service_desc = mb_convert_encoding($_POST["service_description"][$language["language_code"]], 'UTF-8', 'UTF-8');
$multiDesc = json_encode($multiDesc);

  $conn->beginTransaction();
$update = $conn->prepare("UPDATE services SET service_description=:desc,description_lang=:description_lang WHERE service_id=:id ");
$update = $update-> execute(array(
"id"=>route(3),
"desc" => $service_desc,
"description_lang"=>$multiDesc
));

  if( $update ):
$conn->commit();
$error    = 1;
$errorText= "Successful";
$icon     = "success";
  else:
$conn->rollBack();
$error    = 1;
$errorText= "Unsuccessful";
$icon     = "error";
  endif;

        echo json_encode(["t"=>"error","m"=>$errorText,"s"=>$icon]);
      endif;
elseif ($action == "set_auto_avg_time_process") :
    $avg_time_action = $_POST["avg_time_action"] ?? null;
    $random_type = $_POST["random_type"] ?? null;
    $min_time = $_POST["min_time"] ?? null;
    $max_time = $_POST["max_time"] ?? null;
    $single_max_time = $_POST["single_max_time"] ?? null;
    $selected_api = $_POST["selected_api"] ?? null;

    $conn->beginTransaction();

    try {
        if ($avg_time_action == "set_random") {
            $servicesQuery = $conn->prepare("SELECT * FROM services");
            $servicesQuery->execute();
            $services = $servicesQuery->fetchAll(PDO::FETCH_ASSOC);

            foreach ($services as $service) {
                if ($random_type == "range" && $min_time !== null && $max_time !== null) {
                    $randomTime = mt_rand($min_time, $max_time);
                } elseif ($random_type == "single" && $single_max_time !== null) {
                    $randomTime = mt_rand(1, $single_max_time);
                } else {
                    continue;
                }

                $description = "$randomTime minutes";
                $multiDesc = json_encode(["en" => $description]);

                $update = $conn->prepare("UPDATE services SET time = :description, time_lang = :multi WHERE service_id = :id");
                $update->execute([
                    ":description" => $description,
                    ":multi" => $multiDesc,
                    ":id" => $service["service_id"]
                ]);
            }

        } elseif ($avg_time_action == "reset") {
            $update = $conn->prepare("UPDATE services SET time = 'Not enough data', time_lang = NULL");
            $update->execute();

        } elseif ($avg_time_action == "fetch_from_provider" && $selected_api !== null) {
            $stmt = $conn->prepare("SELECT api_name FROM service_api WHERE id = :id");
            $stmt->execute([":id" => $selected_api]);
            $api = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$api || empty($api['api_name'])) {
                throw new Exception("API name not found in database.");
            }

            $externalUrl = 'https://' . $api['api_name'] . '/services';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $externalUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $html = curl_exec($ch);

            if ($html === false) {
                throw new Exception("Error fetching data from API: " . curl_error($ch));
            }

            curl_close($ch);

            $doc = new DOMDocument();
            @$doc->loadHTML($html);
            $xpath = new DOMXPath($doc);
            $rows = $xpath->query("//tr");

            $dataPairs = [];
            foreach ($rows as $row) {
                $columns = $xpath->query(".//td", $row);
                if ($columns->length > 5) {
                    $id = trim($columns->item(0)->textContent);
                    $averageTime = trim($columns->item(5)->textContent);
                    if (!empty($id) && !empty($averageTime)) {
                        $dataPairs[$id] = $averageTime;
                    }
                }
            }

            foreach ($dataPairs as $id => $averageTime) {
                $stmt = $conn->prepare("UPDATE services SET time = :average_time WHERE api_service = :id");
                $stmt->execute([
                    ':average_time' => $averageTime,
                    ':id' => $id
                ]);
            }
        }

        $conn->commit();
        echo json_encode(["t" => "success", "m" => "Action completed successfully."]);
    } catch (Exception $e) {
        $conn->rollBack();
        echo json_encode(["t" => "error", "m" => $e->getMessage()]);
    }
    exit();

elseif ($action == "assign_category_process") :
   
    if (empty($_POST['category'])) {
        echo json_encode(["t" => "error", "m" => "Category cannot be empty!", "s" => "error"]);
        exit;
    }
    if (empty($_POST['services']) || !is_array($_POST['services'])) {
        echo json_encode(["t" => "error", "m" => "At least one service must be selected!", "s" => "error"]);
        exit;
    }

    $category = $_POST['category'];
    $services = $_POST['services'];

   
    $conn->beginTransaction();
    $updated = 0;

    try {
        $stmt = $conn->prepare("UPDATE services SET category_id = :category_id WHERE service_id = :service_id");

        foreach ($services as $service) {
            $stmt->execute([
                ":category_id" => $category,
                ":service_id"  => $service
            ]);
            $updated++;
        }

        if ($updated > 0) {
            $conn->commit();
            echo json_encode(["t" => "success", "m" => "Successfully updated $updated services.", "s" => "success", "r" => site_url("$rentaladmin/services")]);
        } else {
            $conn->rollBack();
            echo json_encode(["t" => "error", "m" => "No services were updated.", "s" => "error"]);
        }
    } catch (PDOException $e) {
        $conn->rollBack();
        echo json_encode(["t" => "error", "m" => "Database error: " . $e->getMessage(), "s" => "error"]);
    }
    exit;

 elseif( $action == "edit-time" ):
    $service_id  = route(3);
if( !countRow(["table"=>"services","where"=>["service_id"=>$service_id]]) ): if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}

exit(); endif;
      if( $_POST ):
        $language   = $conn->prepare("SELECT * FROM languages WHERE default_language=:default");
        $language->execute(array("default"=>1));
        $language   = $language->fetch(PDO::FETCH_ASSOC);
foreach ($_POST as $key => $value) {
  $$key = $value;
}
$description  = $_POST["description"][$language["language_code"]];
$multiDesc    = json_encode($_POST["description"]);

  $conn->beginTransaction();
  $update = $conn->prepare("UPDATE services SET time=:description, time_lang=:multi WHERE service_id=:id ");
  $update = $update-> execute(array("id"=>route(3),"multi"=>$multiDesc,"description"=>$description ));
  if( $update ):
$conn->commit();
$error    = 1;
$errorText= "Successful";
$icon     = "success";
  else:
$conn->rollBack();
$error    = 1;
$errorText= "Unsuccessful";
$icon     = "error";
  endif;
        echo json_encode(["t"=>"error","m"=>$errorText,"s"=>$icon]);
      endif;

elseif( $action == "new-category" ):
      if( $_POST ):
        $name   = $_POST["name"];
        $secret = $_POST["secret"];
        $icon   = $_POST["icon"];
        $position = $_POST["position"];

        if( empty($name) ):
$error    = 1;
$errorText= "Kategori adı boş olamaz";
$icon     = "error";
        else:
$row = $conn->query("SELECT * FROM categories ORDER BY category_line DESC LIMIT 1 ")->fetch(PDO::FETCH_ASSOC);
  $conn->beginTransaction();
 
 $nweIcon = $icon!=""?$icon:" ";
if($position == "top" ):
$cat = $conn->query("SELECT * FROM categories ORDER BY category_line ASC LIMIT 1 ")->fetch(PDO::FETCH_ASSOC);
  $insert = $conn->prepare("INSERT INTO categories SET category_name=:name, category_line=:line, category_icon=:icon, category_secret=:secret, is_refill=:is_refill ");
  $insert = $insert-> execute(array("name"=>$name,"secret"=>$secret,"icon"=>$nweIcon,"is_refill"=>"false","line"=>($cat["category_line"]-1) ));

else:
$insert = $conn->prepare("INSERT INTO categories SET category_name=:name, category_line=:line, category_icon=:icon, category_secret=:secret, is_refill=:is_refill ");
  $insert = $insert-> execute(array("name"=>$name,"secret"=>$secret,"icon"=>$nweIcon,"is_refill"=>"false","line"=>($row["category_line"]+1) ));
endif;
  if( $insert ):
  
$conn->commit();

unset($_SESSION["data"]);
$error    = 1;
$errorText= "Success";
$icon     = "success";
if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
$referrer = $_SERVER["HTTP_REFERER"];
} else {
$referrer =site_url("$rentaladmin/services");
}
  else:
$conn->rollBack();
   
$error    = 1;
$errorText= "Failed";
$icon     = "error";
  endif;
        endif;
        echo json_encode(["t"=>"error","m"=>$errorText,"s"=>$icon,"r"=>$referrer]);
      endif;
 elseif( $action == "edit-category" ):

if( $_POST ):

$category_id = $_POST["cat_id"];

$multiName = $_POST["category_name"];


$language   = $conn->prepare("SELECT * FROM languages WHERE default_language=:default");

$language->execute(array("default"=>1));

$language   = $language->fetch(PDO::FETCH_ASSOC);

$category_name = $multiName[$language["language_code"]];

$multiName = json_encode($multiName);

 

$icon_type = $_POST["icon_type"];
$icon_class = $_POST["icon_class"];
$image_id = $_POST["image_id"];


if($icon_type == "icon"){
    $save = array(
     "icon_type" => "icon",
     "icon_class" => $icon_class
     );
}
if($icon_type == "image"){
    $save = array(
     "icon_type" => "image",
     "image_id" => $image_id
     );
}
$save = json_encode($save,true);
$conn->beginTransaction();
$update = $conn->prepare("UPDATE categories SET category_name=:name, category_name_lang=:lang,category_icon=:icon WHERE category_id=:id");
$update = $update->execute(array(
"name"=>$category_name,
"lang" => $multiName,
"icon" => $save,
"id"=>$category_id
));
$conn->commit();
$resp = array(
 "success" => true,
 "message" => "Category Updated."
 );
echo json_encode($resp,true);
endif;
  elseif( $action == "new-subscription" ):
      if( $_POST ):
        $language   = $conn->prepare("SELECT * FROM languages WHERE default_language=:default");
        $language->execute(array("default"=>1));
        $language   = $language->fetch(PDO::FETCH_ASSOC);
        foreach ($_POST as $key => $value) {
$$key = $value;
        }
$cat = intval(@$_POST["category"]);
        if (!$cat) $cat = $category;
        $name      = mb_convert_encoding($_POST["name"][$language["language_code"]],"UTF-8","UTF-8");
        $multiName = json_encode($_POST["name"]);

        if( empty($name) ):
$error    = 1;
$errorText= "Product name cannot be blank";
$icon     = "error";
        elseif( empty($package) ):
$error    = 1;
$errorText= "The product package cannot be empty";
$icon     = "error";
        elseif( empty($category) ):
$error    = 1;
$errorText= "Product category cannot be empty";
$icon     = "error";
        elseif( empty($provider) ):
$error    = 1;
$errorText= "Service provider cannot be empty";
$icon     = "error";
        elseif( empty($service) ):
$error    = 1;
$errorText= "Service provider service information cannot be empty";
$icon     = "error";
        elseif( empty($secret) ):
$error    = 1;
$errorText= "Service privacy cannot be empty";
$icon     = "error";
        elseif(  ( $package == 11 || $package == 12 ) && !is_numeric($price) ):
$error    = 1;
$errorText= "The product price should consist of numbers";
$icon     = "error";
        elseif( ( $package == 11 || $package == 12 ) && !is_numeric($min) ):
$error    = 1;
$errorText= "Minimum order quantity cannot be empty";
$icon     = "error";
        elseif( ( $package == 11 || $package == 12 ) && !is_numeric($max) ):
$error    = 1;
$errorText= "Maximum order quantity cannot be empty";
$icon     = "error";
        elseif( ( $package == 11 || $package == 12 ) && $min > $max ):
$error    = 1;
$errorText= "Minimum order quantity cannot exceed the maximum order quantity";
$icon     = "error";
        elseif(  ( $package == 14 || $package == 15 ) && !is_numeric($autopost) ):
$error    = 1;
$errorText= "Post amount cannot be empty";
$icon     = "error";
        elseif(  ( $package == 14 || $package == 15 ) && !is_numeric($limited_min) ):
$error    = 1;
$errorText= "Order quantity cannot be empty";
$icon     = "error";
        elseif(  ( $package == 14 || $package == 15 ) && !is_numeric($autotime) ):
$error    = 1;
$errorText= "Package Time cannot be empty";
$icon     = "error";
        else:
  $api=$conn->prepare("SELECT * FROM service_api WHERE id=:id "); $api->execute(array("id"=>$provider)); $api=$api->fetch(PDO::FETCH_ASSOC);
  if( $mode == 1 ): $provider = 0; $service = 0; endif;
  if( $mode == 2 && $api["api_type"] == 1 ):
$smmapi   = new SMMApi(); $services = $smmapi->action(array('key' =>$api["api_key"],'action' =>'services'),$api["api_url"]); $balance = $smmapi->action(array('key' =>$api["api_key"],'action' =>'balance'),$api["api_url"]);
  foreach ($services as $apiService):
    if( $service == $apiService->service ):
      $detail["min"]=$apiService->min;
      $detail["max"]=$apiService->max;
      $detail["rate"]=$apiService->rate;
      $detail["currency"]=$balance->currency;
      $detail=json_encode($detail);
    endif;
  endforeach;
  else:
$detail="";
  endif;
  if( $package == 14 || $package == 15 ): $min = $limited_min; $max = $min; $price = $limited_price; endif;
  $row = $conn->query("SELECT * FROM services WHERE category_id='$category' ORDER BY service_line DESC LIMIT 1 ")->fetch(PDO::FETCH_ASSOC);
  $conn->beginTransaction();
  $insert = $conn->prepare("INSERT INTO services SET name_lang=:multiName, service_speed=:speed, service_api=:api, api_service=:api_service, api_detail=:detail, category_id=:category, service_line=:line, service_type=:type, service_package=:package, service_name=:name, service_price=:price, service_min=:min, service_max=:max, service_autotime=:autotime, service_autopost=:autopost, service_secret=:secret ");
  $insert = $insert-> execute(array("api"=>$provider,"multiName"=>$multiName,"speed"=>$speed,"detail"=>$detail,"api_service"=>$service,"category"=>$cat,"line"=>$row["service_line"]+1,"type"=>2,"package"=>$package,"name"=>$name,"price"=>$price,"min"=>$min,"max"=>$max,"autotime"=>$autotime,"autopost"=>$autopost,"secret"=>$secret ));
  if( $insert ):
$conn->commit();
$error    = 1;
$errorText= "Successful";
if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
$referrer = $_SERVER["HTTP_REFERER"];
} else {
$referrer =site_url("$rentaladmin/services");
}
$icon     = "success";
  else:
$conn->rollBack();
$error    = 1;
$errorText= "Unsuccessful";
$icon     = "error";
  endif;
        endif;
        echo json_encode(["t"=>"error","m"=>$errorText,"s"=>$icon,"r"=>$referrer]);
      endif;
  elseif( $action == "edit-subscription" ):
      if( $_POST ):
        $language   = $conn->prepare("SELECT * FROM languages WHERE default_language=:default");
        $language->execute(array("default"=>1));
        $language   = $language->fetch(PDO::FETCH_ASSOC);
        foreach ($_POST as $key => $value) {
$$key = $value;
        }
        // ismi değiştirdiği alan servicslerden
         $cat = intval(@$_POST["category"]);
$name      = $_POST["name"][$language["language_code"]];
$multiName = json_encode($_POST["name"]);
        $serviceInfo  = $conn->prepare("SELECT * FROM services INNER JOIN service_api ON service_api.id = services.service_api WHERE service_id=:id ");
        $serviceInfo -> execute(array("id"=>route(3) ));
        $serviceInfo  = $serviceInfo->fetch(PDO::FETCH_ASSOC);
        if( empty($name) ):
$error    = 1;
$errorText= "Product name cannot be blank";
$icon     = "error";
        elseif( empty($category) ):
$error    = 1;
$errorText= "Product category cannot be empty";
$icon     = "error";
        elseif( empty($provider) ):
$error    = 1;
$errorText= "Service provider cannot be empty";
$icon     = "error";
        elseif( empty($service) ):
$error    = 1;
$errorText= "Service provider service information cannot be empty";
$icon     = "error";
        elseif( empty($secret) ):
$error    = 1;
$errorText= "Service privacy cannot be empty";
        elseif(  ( $serviceInfo["service_package"] == 11 || $serviceInfo["service_package"] == 12 ) && !is_numeric($price) ):
$error    = 1;
$errorText= "The product price should consist of numbers";
$icon     = "error";
        elseif( ( $serviceInfo["service_package"] == 11 || $serviceInfo["service_package"] == 12 ) && !is_numeric($min) ):
$error    = 1;
$errorText= "Minimum order quantity cannot be empty";
$icon     = "error";
        elseif( ( $serviceInfo["service_package"] == 11 || $serviceInfo["service_package"] == 12 ) && !is_numeric($max) ):
$error    = 1;
$errorText= "Maximum order quantity cannot be empty";
$icon     = "error";
        elseif( ( $serviceInfo["service_package"] == 11 || $serviceInfo["service_package"] == 12 ) && $min > $max ):
$error    = 1;
$errorText= "Minimum order quantity cannot exceed the maximum order quantity";
$icon     = "error";
        elseif(  ( $serviceInfo["service_package"] == 14 || $serviceInfo["service_package"] == 15 ) && !is_numeric($autopost) ):
$error    = 1;
$errorText= "Post amount cannot be empty";
$icon     = "error";
        elseif(  ( $serviceInfo["service_package"] == 14 || $serviceInfo["service_package"] == 15 ) && !is_numeric($limited_min) ):
$error    = 1;
$errorText= "Order quantity cannot be empty";
$icon     = "error";
        elseif(  ( $serviceInfo["service_package"] == 14 || $serviceInfo["service_package"] == 15 ) && !is_numeric($autotime) ):
$error    = 1;
$errorText= "Package Time cannot be empty";
$icon     = "error";
        else:
  $api=$conn->prepare("SELECT * FROM service_api WHERE id=:id "); $api->execute(array("id"=>$provider)); $api=$api->fetch(PDO::FETCH_ASSOC);
  if( $mode == 1 ): $provider = 0; $service = 0; endif;
  if( $mode == 2 && $api["api_type"] == 1 ):
$smmapi   = new SMMApi(); $services = $smmapi->action(array('key' =>$api["api_key"],'action' =>'services'),$api["api_url"]); $balance = $smmapi->action(array('key' =>$api["api_key"],'action' =>'balance'),$api["api_url"]);
  foreach ($services as $apiService):
    if( $service == $apiService->service ):
      $detail["min"]=$apiService->min;
      $detail["max"]=$apiService->max;
      $detail["rate"]=$apiService->rate;
      $detail["currency"]=$balance->currency;
      $detail=json_encode($detail);
    endif;
  endforeach;
  else:
$detail="";
  endif;
  if( $serviceInfo["service_package"] == 14 || $serviceInfo["service_package"] == 15 ): $min = $limited_min; $max = $min; $price = $limited_price; endif;
  if( $serviceInfo["category_id"] != $category ): $row = $conn->query("SELECT * FROM services WHERE category_id='$category' ORDER BY service_line DESC LIMIT 1 ")->fetch(PDO::FETCH_ASSOC); $last_category=$serviceInfo["category_id"]; $last_line=$serviceInfo["service_line"]; $line= $row["service_line"] + 1; else: $line= $serviceInfo["service_line"]; endif;
  $conn->beginTransaction();
			// abone update işlem yeri
  $update = $conn->prepare("UPDATE services SET 
			service_speed=:speed, 
cancelbutton=:cancelbutton, 
show_refill=:show_refill, 
			service_api=:api,
			api_servicetype=:type, 
			api_service=:api_service, 
			api_detail=:detail,
			category_id=:category, 
			service_name=:name, 
			service_price=:price, 
			service_min=:min, 
			service_max=:max, 
			service_autotime=:autotime, 
			service_autopost=:autopost,
      name_lang=:name_lang,
			service_secret=:secret,service_overflow=:overflow WHERE service_id=:id ");
  $update = $update-> execute(array("id"=>route(3),"type"=>2,"speed"=>$speed,"detail"=>$detail,"api"=>$provider,"api_service"=>$service,"category"=>$category,"name"=>$name,"price"=>$price,"min"=>$min,"max"=>$max,"autotime"=>$autotime,"autopost"=>$autopost,"name_lang"=>$multiName,"secret"=>$secret,"cancelbutton"=>$cancelbutton,"show_refill"=>$show_refill,"overflow" => $service_overflow));
  if( $update ):
$conn->commit();
$rows = $conn->prepare("SELECT * FROM services WHERE category_id=:c_id && service_line>=:line ");
$rows->execute(array("c_id"=>$last_category,"line"=>$last_line ));
$rows = $rows->fetchAll(PDO::FETCH_ASSOC);
  foreach( $rows as $row ):
    $update = $conn->prepare("UPDATE services SET service_line=:line WHERE service_id=:id ");
    $update->execute(array("line"=>$row["service_line"]-1,"id"=>$row["service_id"] ));
  endforeach;
$error    = 1;
$errorText= "Successful";
if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
$referrer = $_SERVER["HTTP_REFERER"];
} else {
$referrer =site_url("$rentaladmin/services");
}
$icon     = "success";
  else:
$conn->rollBack();
$error    = 1;
$errorText= "Unsuccessful";
$icon     = "error";
  endif;
        endif;
        echo json_encode(["t"=>"error","m"=>$errorText,"s"=>$icon,"r"=>$referrer]);
      endif;
  elseif( $action == "service-active" ):
    $service_id  = route(3);
    if( countRow(["table"=>"services","where"=>["service_id"=>$service_id,"service_type"=>2]]) ):
  if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
  
  exit(); endif;
    $update = $conn->prepare("UPDATE services SET service_type=:type WHERE service_id=:id ");
    $update->execute(array("type"=>2,"id"=>$service_id));
      if( $update ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Successful";
//Create Updates
$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Activated","description"=>"","date"=>date("Y-m-d H:i:s") ));      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Unsuccessful";
      endif;
    if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
  elseif( $action == "service-deactive" ):
    $service_id  = route(3);
    if( countRow(["table"=>"services","where"=>["service_id"=>$service_id,"service_type"=>1]]) ):
   if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
   endif;
    $update = $conn->prepare("UPDATE services SET service_type=:type WHERE service_id=:id ");
    $update->execute(array("type"=>1,"id"=>$service_id));
      if( $update ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Successful";
//Create Updates
 $insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Disabled","description"=>"","date"=>date("Y-m-d H:i:s") ));
     else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Unsuccessful";
      endif;
      if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}



elseif( $action == "refill-active" ):
    $service_id  = route(3);
    if( countRow(["table"=>"services","where"=>["service_id"=>$service_id,"show_refill"=>true ]]) ):
     if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
     
     exit();
     
     endif;
    $update = $conn->prepare("UPDATE services SET show_refill=:show_refill WHERE service_id=:id ");
    $update->execute(array("show_refill"=>true,"id"=>$service_id));
      if( $update ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Success";

//Create updates 
$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Activated","description"=>"Refill Button Has Been Activated","date"=>date("Y-m-d H:i:s") ));
   
      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Failed";
      endif;
    if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
  elseif( $action == "refill-deactive" ):
    $service_id  = route(3);
    if( countRow(["table"=>"services","where"=>["service_id"=>$service_id,"show_refill"=>false ]]) ): 
   if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
   exit();
   endif;
    $update = $conn->prepare("UPDATE services SET show_refill=:show_refill WHERE service_id=:id ");
    $update->execute(array("show_refill"=>"false","id"=>$service_id));
      if( $update ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Success";
//Create Updates
$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Disabled","description"=>"Refill Button Has Been Disabled","date"=>date("Y-m-d H:i:s") ));
   
      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Failed";
      endif;

      if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}

elseif( $action == "cancelbutton-active" ):
    $service_id  = route(3);
    if( countRow(["table"=>"services","where"=>["service_id"=>$service_id,"cancelbutton"=>1]]) ):
     if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
} 
     
     exit(); endif;
    $update = $conn->prepare("UPDATE services SET cancelbutton=:cancelbutton WHERE service_id=:id ");
    $update->execute(array("cancelbutton"=>1,"id"=>$service_id));
      if( $update ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Success";
//Create Updates
$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Activated","description"=>"Cancel Button Has Been Activated","date"=>date("Y-m-d H:i:s") ));
   
      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Failed";
      endif;
   if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
  elseif( $action == "cancelbutton-deactive" ):
    $service_id  = route(3);
    if( countRow(["table"=>"services","where"=>["service_id"=>$service_id,"cancelbutton"=>2]]) ):
   if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
   
   exit(); endif;
    $update = $conn->prepare("UPDATE services SET cancelbutton=:cancelbutton WHERE service_id=:id ");
    $update->execute(array("cancelbutton"=>2,"id"=>$service_id));
      if( $update ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Success";
//Create Updates
$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$service_id,"action"=>"Disabled","description"=>"Cancel Button Has Been Disabled","date"=>date("Y-m-d H:i:s") ));
   
      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Failed";
      endif;

      if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}


  elseif( $action == "del_price" ):
    $service_id  = route(3);
    if( !countRow(["table"=>"clients_price","where"=>["service_id"=>$service_id]]) ): $_SESSION["client"]["data"]["error"]    = 1; $_SESSION["client"]["data"]["errorText"]= "Servise ait fiyatlandırma bulunamadı."; 
  if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
  
  exit(); endif;
    $delete = $conn->prepare("DELETE FROM clients_price  WHERE service_id=:id ");
    $delete->execute(array("id"=>$service_id));
      if( $delete ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Successful";
      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Unsuccessful";
      endif;
    if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
};
  elseif( $action == "category-active" ):
    $category_id  = route(3);
    $update = $conn->prepare("UPDATE categories SET category_type=:type WHERE category_id=:id ");
    $update->execute(array("type"=>2,"id"=>$category_id));
      if( $update ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Successful";
      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Unsuccessful";
      endif;
    if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
  elseif( $action == "category-deactive" ):
    $category_id  = route(3);
    $update = $conn->prepare("UPDATE categories SET category_type=:type WHERE category_id=:id ");
    $update->execute(array("type"=>1,"id"=>$category_id));
      if( $update ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Successful";
      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Unsuccessful";
      endif;
      if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
 elseif( $action == "del_category" ):
   foreach ($services as $id => $value):
      $delete = $conn->prepare("DELETE FROM categories WHERE category_id=:id ");
      $delete->execute(array("id"=>$id));
    endforeach;
if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
  elseif( $action == "multi-action" ):
    $services = $_POST["service"];
    $action   = $_POST["bulkStatus"];
      if( $action ==  "active" ):
        foreach ($services as $id => $value):
$update = $conn->prepare("UPDATE services SET service_type=:type WHERE service_id=:id ");
$update->execute(array("type"=>2,"id"=>$id));
//Create Updates
$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$id,"action"=>"Activated","description"=>"","date"=>date("Y-m-d H:i:s") ));      
  
        endforeach;
      elseif( $action ==  "deactive" ):
        foreach ($services as $id => $value):
$update = $conn->prepare("UPDATE services SET service_type=:type WHERE service_id=:id ");
$update->execute(array("type"=>1,"id"=>$id));

//Create Updates
 $insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$id,"action"=>"Disabled","description"=>"","date"=>date("Y-m-d H:i:s") ));

        endforeach;
      elseif( $action ==  "secret" ):
        foreach ($services as $id => $value):
$update = $conn->prepare("UPDATE services SET service_secret=:secret WHERE service_id=:id ");
$update->execute(array("secret"=>1,"id"=>$id));
        endforeach;
      elseif( $action ==  "desecret" ):
        foreach ($services as $id => $value):
$update = $conn->prepare("UPDATE services SET service_secret=:secret WHERE service_id=:id ");
$update->execute(array("secret"=>2,"id"=>$id));
        endforeach;
elseif( $action ==  "refill-active" ):
        foreach ($services as $id => $value):
$update = $conn->prepare("UPDATE services SET show_refill=:refill WHERE service_id=:id ");
$update->execute(array("refill"=>"true","id"=>$id));
//Create updates 
$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$id,"action"=>"Activated","description"=>"Refill Button Has Been Activated","date"=>date("Y-m-d H:i:s") ));

        endforeach;
elseif( $action ==  "refill-inactive" ):
        foreach ($services as $id => $value):
$update = $conn->prepare("UPDATE services SET show_refill=:refill WHERE service_id=:id ");
$update->execute(array("refill"=>"false","id"=>$id));
//Create Updates
$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$id,"action"=>"Disabled","description"=>"Refill Button Has Been Disabled","date"=>date("Y-m-d H:i:s") ));
        endforeach;
elseif( $action ==  "cancel-active" ):
        foreach ($services as $id => $value):
$update = $conn->prepare("UPDATE services SET cancelbutton=:button WHERE service_id=:id ");
$update->execute(array("button"=>"1","id"=>$id));

//Create Updates
$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$id,"action"=>"Activated","description"=>"Cancel Button Has Been Activated","date"=>date("Y-m-d H:i:s") ));

        endforeach;
elseif( $action ==  "cancel-inactive" ):
        foreach ($services as $id => $value):
$update = $conn->prepare("UPDATE services SET cancelbutton=:button WHERE service_id=:id ");
$update->execute(array("button"=>"2","id"=>$id));
//Create Updates
$insert2= $conn->prepare("INSERT INTO updates SET service_id=:s_id, action=:action, description=:description, date=:date ");
$insert2= $insert2->execute(array("s_id"=>$id,"action"=>"Disabled","description"=>"Cancel Button Has Been Disabled","date"=>date("Y-m-d H:i:s") ));
        endforeach;


elseif( $action ==  "del-cat" ):
        foreach ($services as $id => $value):
$delete = $conn->prepare("DELETE FROM categories WHERE category_id=:id ");
    $delete->execute(array("id"=>$id));
        endforeach;

elseif( $action == "refill-active" ):
    $service_id  = route(3);
    if( countRow(["table"=>"services","where"=>["service_id"=>$service_id,"show_refill"=>1]]) ):
        if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
        exit(); endif;
    $update = $conn->prepare("UPDATE services SET show_refill=:show_refill WHERE service_id=:id ");
    $update->execute(array("show_refill"=>1,"id"=>$service_id));
      if( $update ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Success";
      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Failed";
      endif;
    if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
  elseif( $action == "refill-deactive" ):
    $service_id  = route(3);
    if( countRow(["table"=>"services","where"=>["service_id"=>$service_id,"show_refill"=>2]]) ): 
   if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
   
   exit();
   
   endif;
    $update = $conn->prepare("UPDATE services SET show_refill=:show_refill WHERE service_id=:id ");
    $update->execute(array("show_refill"=> "false" ,"id"=>$service_id));
      if( $update ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Success";
      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Failed";
      endif;

      if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}

elseif( $action == "cancelbutton-active" ):
    $service_id  = route(3);
    if( countRow(["table"=>"services","where"=>["service_id"=>$service_id,"cancelbutton"=>1]]) ): 
if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
} 
        exit(); endif;
    $update = $conn->prepare("UPDATE services SET cancelbutton=:cancelbutton WHERE service_id=:id ");
    $update->execute(array("cancelbutton"=>1,"id"=>$service_id));
      if( $update ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Success";
      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Failed";
      endif;
    if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
  elseif( $action == "cancelbutton-deactive" ):
    $service_id  = route(3);
    if( countRow(["table"=>"services","where"=>["service_id"=>$service_id,"cancelbutton"=>2]]) ): 
if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
exit(); endif;
    $update = $conn->prepare("UPDATE services SET cancelbutton=:cancelbutton WHERE service_id=:id ");
    $update->execute(array("cancelbutton"=>2,"id"=>$service_id));
      if( $update ):
        $_SESSION["client"]["data"]["success"]    = 1;
        $_SESSION["client"]["data"]["successText"]= "Success";
      else:
        $_SESSION["client"]["data"]["error"]    = 1;
        $_SESSION["client"]["data"]["errorText"]= "Failed";
      endif;

      if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
      elseif( $action ==  "del_price" ):
        foreach ($services as $id => $value):
$delete = $conn->prepare("DELETE FROM clients_price  WHERE service_id=:id ");
$delete->execute(array("id"=>$id));
        endforeach;
        elseif( $action == "del_service" ):
 foreach ($services as $id => $value):
      $delete = $conn->prepare("UPDATE services SET service_deleted=:deleted WHERE service_id=:id ");
      $delete->execute(array("deleted"=>1,"id"=>$id));
    endforeach;
      endif;
    if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
elseif( $action == "get_services_add" ):


$format = $general["currency_format"];
    $services     = $_POST["servicesList"];
$percentage_increase = $_POST["percent"];
    $provider_id  = $_POST["provider"];
$language   = $conn->prepare("SELECT * FROM languages WHERE default_language=:default");
        $language->execute(array("default"=>1));
        $language   = $language->fetch(PDO::FETCH_ASSOC);

    $smmapi       = new SMMApi();
    $provider     = $conn->prepare("SELECT * FROM service_api WHERE id=:id");
    $provider     ->execute(array("id"=>$provider_id));
    $cat = intval(@$_POST["category"]);
    $provider     = $provider->fetch(PDO::FETCH_ASSOC);
    $apiServices  = $smmapi->action(array('key'=>$provider["api_key"],'action'=>'services'),$provider["api_url"]);
    $balance      = $smmapi->action(array('key'=>$provider["api_key"],'action'=>'balance'),$provider["api_url"]);
      if( count($services) ):
        foreach ($services as $service => $price):
foreach ($apiServices as $apiService):
  if( $service == $apiService->service && $service != 0 ):
$detail["min"]=$apiService->min;
$detail["max"]=$apiService->max;
$detail["rate"]=$apiService->rate;
$detail["refill"]=$apiService->refill;
$detail["desc"]=$apiService->desc;
$detail["currency"]=$balance->currency;

$package= serviceTypeGetList($apiService->type);
$name2 = $apiService->name;


$multidetail[$language["language_code"]]= $name2;
$multiName=json_encode($multidetail);


if($apiService->refill  == "1") {
   $apiService->refill = "true";
  }
if($apiService->refill  == "2") {
   $apiService->refill = "false";
  }
if (empty($apiService->refill)) {
   $apiService->refill = "false";
  }

if (empty($apiService->desc)) {
   $apiService->desc = "$apiService->package_description";
  }
  $multidesc[$language["language_code"]]=$apiService->desc;
$multiDesc=json_encode($multidesc);
  if( $currency["site_currency"] == "USD" ):    
  
     
if($provider["currency"] == "IR"){
    $price = $price;    
}else{
    $price = $price*0.0073;
}
  

  if( $package == 11 ):
      
    $insert = $conn->prepare("INSERT INTO services SET service_api=:api, name_lang=:multiName, api_service=:api_service, category_id=:category, service_line=:line, service_type=:type, service_package=:package, service_name=:name, service_price=:price, service_min=:min, service_max=:max, service_description=:desc,  service_profit=:profit, description_lang=:multi ");
    $insert = $insert-> execute(array("api"=>$provider_id,"api_service"=>$service,"detail"=>json_encode($detail),"category"=>$cat,"line"=>1,"type"=>2,"package"=>$package,"name"=>$name2,"price"=> number_format($price, $format, '.', ''),"min"=>$apiService->min,"max"=>$apiService->max,"desc"=>$apiService->desc, "profit"=>$percentage_increase,"multiName"=>$multiName,"multi"=>$multiDesc));
  else:
      $package = $package==""?1:$package;
     
    $insert = $conn->prepare("INSERT INTO services SET service_api=:api, api_service=:api_service, api_detail=:detail, category_id=:category, service_line=:line, service_type=:type, service_package=:package, service_name=:name, service_price=:price, service_min=:min, service_max=:max, name_lang=:multiName,  service_description=:desc , show_refill=:refill,  service_profit=:profit, description_lang=:multi ");
    $insert = $insert-> execute(array("api"=>$provider_id,"api_service"=>$service,"detail"=>json_encode($detail),"category"=>$cat,"line"=>1,"type"=>2,"package"=>$package,"name"=>$apiService->name,"price"=>number_format($price, $format, '.', '') ,"min"=>$apiService->min,"max"=>$apiService->max,"desc"=>$apiService->desc,"refill"=>$apiService->refill, "profit"=>$percentage_increase,"multiName"=>$multiName,"multi"=>$multiDesc));
  endif;
  
  else:
  
  if($provider["currency"] == "INR"){
      $foo = $price*$conv_rate;
      $formatted_price = number_format((float)$foo, 2, '.', ''); 
  }else{
      $formatted_price = $price;
  }
  
  
  if( $package == 11 ):
      
    $insert = $conn->prepare("INSERT INTO services SET service_api=:api, api_service=:api_service, category_id=:category, service_line=:line, service_type=:type, service_package=:package, service_name=:name, service_price=:price, service_min=:min, service_max=:max,  service_description=:desc , show_refill=:refill,  service_profit=:profit, name_lang=:multiName, description_lang=:multi ");
    $insert = $insert-> execute(array("api"=>$provider_id,"api_service"=>$service,"detail"=>json_encode($detail),"category"=>$cat,"line"=>1,"type"=>2,"package"=>$package,"name"=>$name2,"price"=>number_format($price, $format, '.', ''),"min"=>$apiService->min,"max"=>$apiService->max,"desc"=>$apiService->desc,"refill"=>$apiService->refill, "profit"=>$percentage_increase,"multiName"=>$multiName,"multi"=>$multiDesc));
  else:
      $package = $package==""?1:$package;
     
    $insert = $conn->prepare("INSERT INTO services SET service_api=:api, api_service=:api_service, api_detail=:detail, category_id=:category, service_line=:line, service_type=:type, service_package=:package, service_name=:name, service_price=:price, service_min=:min, service_max=:max,  service_description=:desc , show_refill=:refill,  service_profit=:profit, name_lang=:multiName, description_lang=:multi  ");
    $insert = $insert-> execute(array("api"=>$provider_id,"api_service"=>$service,"detail"=>json_encode($detail),"category"=>$cat,"line"=>1,"type"=>2,"package"=>$package,"name"=>$apiService->name,"price"=>number_format($price, $format, '.', ''),"min"=>$apiService->min,"max"=>$apiService->max,"desc"=>$apiService->desc,"refill"=>$apiService->refill, "profit"=>$percentage_increase,"multiName"=>$multiName,"multi"=>$multiDesc));
  endif;
  endif;
  endif;
endforeach;
        endforeach;
echo json_encode(["t"=>"error","m"=>"Success","s"=>"success","r"=>site_url("$rentaladmin/services"),"time"=>0]);
else:
echo json_encode(["t"=>"error","m"=>"Please select at least 1 service you want to add","s"=>"error"]);
      endif;
  endif;
     if( route(2) == "delehh" ):
    $id     = route(3);
    $delete = $conn->prepare("DELETE FROM services WHERE service_id=:id ");
    $delete->execute(array("id"=>$id));
    if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
};
  endif;
   
    if( $action == "get_service_add" ):

$format = $general["currency_format"];
    $services     = $_POST["servicesList"];
    $provider_id  = $_POST["provider"];
    $percentage_increase = $_POST["percent"];
 
    $currency     = $conn->prepare("SELECT * FROM settings WHERE id=:id");
    $currency     ->execute(array("id"=>"1"));
    $currency     = $currency->fetch(PDO::FETCH_ASSOC);
    $conv_rate = $currency["dolar_charge"];
    $smmapi       = new SMMApi();
    $provider     = $conn->prepare("SELECT * FROM service_api WHERE id=:id");
    $provider     ->execute(array("id"=>$provider_id));
    $provider     = $provider->fetch(PDO::FETCH_ASSOC);
$language   = $conn->prepare("SELECT * FROM languages WHERE default_language=:default");
        $language->execute(array("default"=>1));
        $language   = $language->fetch(PDO::FETCH_ASSOC);

    $apiServices  = $smmapi->action(array('key'=>$provider["api_key"],'action'=>'services'),$provider["api_url"]);
    $balance      = $smmapi->action(array('key'=>$provider["api_key"],'action'=>'balance'),$provider["api_url"]);
      if( count($services) ):
        foreach ($services as $service => $price):
foreach ($apiServices as $apiService):
  
  // die();
  if( $service == $apiService->service && $service != 0 ):
  
  $check_category = $conn->prepare("SELECT * FROM categories WHERE category_name=:name");
  $check_category->execute(array("name"=>$apiService->category));
  $check_category = $check_category->fetch(PDO::FETCH_ASSOC);
  if(!empty($check_category)){
      $cat = $check_category["category_id"];
  }else{
      $check_category = $conn->prepare("SELECT * FROM categories ORDER BY category_line DESC LIMIT 1");
      $check_category->execute();
      $check_category = $check_category->fetch(PDO::FETCH_ASSOC);
      $insertcat = $conn->prepare("INSERT INTO categories SET category_name=:name, category_line=:line, category_type=:type, category_secret=:secret, category_icon=:icon, is_refill=:refill ");
      $insertcat = $insertcat->execute(array("name"=>$apiService->category,"line"=>$check_category["category_line"]+1,"type"=>"2","secret"=>"2","icon"=>"","refill"=>"false" ));
      $cat = $conn->lastInsertId();
  }    
$detail["min"]=$apiService->min;
$detail["max"]=$apiService->max;
$detail["rate"]=$apiService->rate;
$detail["refill"]=$apiService->refill;
$detail["currency"]=$balance->currency;
$package= serviceTypeGetList($apiService->type);
$name2 = $apiService->name;
$multidetail[$language["language_code"]]= $name2;
$multiName=json_encode($multidetail);

if($apiService->refill  == "1") {
   $apiService->refill = "true";
  }
if($apiService->refill  == "2") {
   $apiService->refill = "false";
  }

if (empty($apiService->refill)) {
   $apiService->refill = "false";
  }
if (empty($apiService->desc)) {
   $apiService->desc = "$apiService->api_package_description";
  }
$multidesc[$language["language_code"]]=$apiService->desc;
$multiDesc=json_encode($multidesc);

 if( $currency["site_currency"] == "INR" ):    
  
     
if($provider["currency"] == "INR"){
    $price = $price;    
}else{
    $price = $price*$conv_rate;
}
  
  if( $package == 11 ):
      
    $insert = $conn->prepare("INSERT INTO services SET service_api=:api, api_service=:api_service, category_id=:category, service_line=:line, service_type=:type, service_package=:package, service_name=:name, service_price=:price, service_min=:min, service_max=:max,  service_description=:desc,  service_profit=:profit , show_refill=:refill, name_lang=:multiName, description_lang=:multi ");
    $insert = $insert-> execute(array("api"=>$provider_id,"api_service"=>$service,"detail"=>json_encode($detail),"category"=>$cat,"line"=>1,"type"=>2,"package"=>$package,"name"=>$name2,"price"=>number_format($price, $format, '.', ''),"min"=>$apiService->min,"max"=>$apiService->max,"desc"=>$apiService->desc,"refill"=>$apiService->refill, "profit"=>$percentage_increase,"multiName"=>$multiName,"multi"=>$multiDesc));
  else:
      $package = $package==""?1:$package;
     
    $insert = $conn->prepare("INSERT INTO services SET service_api=:api, api_service=:api_service, api_detail=:detail, category_id=:category, service_line=:line, service_type=:type, service_package=:package, service_name=:name, service_price=:price, service_min=:min, service_max=:max,  service_description=:desc , show_refill=:refill,  service_profit=:profit, name_lang=:multiName, description_lang=:multi  ");
    $insert = $insert-> execute(array("api"=>$provider_id,"api_service"=>$service,"detail"=>json_encode($detail),"category"=>$cat,"line"=>1,"type"=>2,"package"=>$package,"name"=>$apiService->name,"price"=>number_format($price, $format, '.', ''),"min"=>$apiService->min,"max"=>$apiService->max,"desc"=>$apiService->desc,"refill"=>$apiService->refill, "profit"=>$percentage_increase,"multiName"=>$multiName,"multi"=>$multiDesc));
  endif;
  
  else:
  
  if($provider["currency"] == "INR"){
      $foo = $price/$conv_rate;
      $formatted_price = number_format((float)$foo, 2, '.', ''); 
  }else{
      $formatted_price = $price;
  }
  
  
  if( $package == 11 ):
      
    $insert = $conn->prepare("INSERT INTO services SET service_api=:api, api_service=:api_service, category_id=:category, service_line=:line, service_type=:type, service_package=:package, service_name=:name, service_price=:price, service_min=:min, service_max=:max,  service_description=:desc , show_refill=:refill,  service_profit=:profit, name_lang=:multiName, description_lang=:multi ");
    $insert = $insert-> execute(array("api"=>$provider_id,"api_service"=>$service,"detail"=>json_encode($detail),"category"=>$cat,"line"=>1,"type"=>2,"package"=>$package,"name"=>$name2,"price"=>number_format($price, $format, '.', ''),"min"=>$apiService->min,"max"=>$apiService->max,"desc"=>$apiService->desc,"refill"=>$apiService->refill, "profit"=>$percentage_increase,"multiName"=>$multiName,"multi"=>$multiDesc));
  else:
      $package = $package==""?1:$package;
     
    $insert = $conn->prepare("INSERT INTO services SET service_api=:api, api_service=:api_service, api_detail=:detail, category_id=:category, service_line=:line, service_type=:type, service_package=:package, service_name=:name, service_price=:price, service_min=:min, service_max=:max,  service_description=:desc , show_refill=:refill,  service_profit=:profit, name_lang=:multiName, description_lang=:multi ");
    $insert = $insert-> execute(array("api"=>$provider_id,"api_service"=>$service,"detail"=>json_encode($detail),"category"=>$cat,"line"=>1,"type"=>2,"package"=>$package,"name"=>$apiService->name,"price"=>number_format($price, $format, '.', ''),"min"=>$apiService->min,"max"=>$apiService->max,"desc"=>$apiService->desc,"refill"=>$apiService->refill, "profit"=>$percentage_increase,"multiName"=>$multiName,"multi"=>$multiDesc));
  endif;
  endif;
  endif;
endforeach;
        endforeach;
        echo json_encode(["t"=>"error","m"=>"Success","s"=>"success","r"=>site_url("$rentaladmin/services"),"time"=>0]);
      else:
        echo json_encode(["t"=>"error","m"=>"
Please select at least 1 service you want to add","s"=>"error"]);
      endif;
  endif;
  
   if( route(2) == "delete" ):
    $id     = route(3);
    $delete = $conn->prepare("UPDATE services SET service_deleted=:deleted WHERE service_id=:id ");
    $delete->execute(array("deleted"=> 1,"id"=>$id));
    if(strpos($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"]) != false){
header("Location:".$_SERVER["HTTP_REFERER"]); 
} else {
header("Location:".site_url("$rentaladmin/services")); 
}
  endif;
  
if( route(2)  ==  "provider" ):
    $count          = $conn->prepare("SELECT * FROM services WHERE service_deleted = :del ");
    $count        ->execute(array("del"=>0));
    $count          = $count->rowCount();
    $services = $conn->prepare("SELECT * FROM service_api");
    $services->execute(array());
    $services = $services->fetchAll(PDO::FETCH_ASSOC);
    $active   = $_POST["active"];
    echo '<li'; if( !$active ): echo ' class="active"'; endif; echo '>
             <a href="/' . $rentaladmin . '/services">All Services (' . $count . ')</a>
          </li>';
      foreach ($services as $service):
        echo '<li'; if( $service["id"] == $active ): echo ' class="active"'; endif; echo '>
                 <a href="/' . $rentaladmin . '/services?id=' . $service["id"] . '">
                    <span class="label-id">' . $service["id"] . '</span> ' . $service["api_name"] . ' (' . 
                    countRow(["table" => "services", "where" => ["service_api" => $service["id"], "service_deleted" => 0]]) . ')
                </a>
</li>';
      endforeach;
    exit();
  endif;

  

if (route(2) == "del_category") :
    $id = route(3);
    $delete = $conn->prepare("DELETE FROM categories WHERE category_id=:id");
    $delete->execute(array("id" => $id));

    if ($delete) {
        if (strpos($_SERVER["HTTP_REFERER"], $_SERVER["HTTP_HOST"]) !== false) {
            header("Location:" . $_SERVER["HTTP_REFERER"]);
        } else {
            header("Location:" . site_url("$rentaladmin/services"));
        }
    } else {
        // Handle error if needed
        header("Location:" . site_url("$rentaladmin/services"));
    }
    exit();
endif;
 
  

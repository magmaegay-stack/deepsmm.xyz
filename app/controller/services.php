<?php
if(!defined('BASEPATH')) {
   die('Direct access to the script is not allowed');
}
$title .= $languageArray["services.title"];

if( $settings["service_list"] == 1 && !$_SESSION["msmbilisim_userlogin"] ):
  header("Location:".site_url());
endif;

$categoriesRows = $conn->prepare("SELECT * FROM categories WHERE category_type=:type AND category_deleted=:deleted ORDER BY categories.category_line ASC ");
$categoriesRows->execute(array("type" => 2, "deleted" => 0));
$categoriesRows = $categoriesRows->fetchAll(PDO::FETCH_ASSOC);

$query = $conn->query("SELECT * FROM settings", PDO::FETCH_ASSOC);
if ($query->rowCount()) :
    foreach ($query as $row) :
        $siraal = $row['servis_siralama'];
    endforeach;
endif;

$categories = [];
foreach ($categoriesRows as $categoryRow) {
    // Check if category is visible to the current user
    $search = $conn->prepare("SELECT * FROM clients_category WHERE category_id=:category && client_id=:c_id ");
    $search->execute(array("category" => $categoryRow["category_id"], "c_id" => $user["client_id"]));
    if ($categoryRow["category_secret"] == 2 || $search->rowCount()) :

        // Select all services for this category
        $rows = $conn->prepare("
            SELECT s.*, 
                   (SELECT 1 FROM favorite_services f WHERE f.user_id = :uid AND f.service_id = s.service_id) as is_fav 
            FROM services s
            WHERE s.category_id = :id 
              AND s.service_type = :type 
              AND s.service_deleted = :deleted 
            ORDER BY service_line " . $siraal);
        $rows->execute([
            "id" => $categoryRow["category_id"],
            "type" => 2,
            "deleted" => 0,
            "uid" => $user["client_id"]
        ]);
        $rows = $rows->fetchAll(PDO::FETCH_ASSOC);

        $services = [];
        foreach ($rows as $row) {
            $s["service_price"] = format_amount_string($user["currency_type"], from_to(get_currencies_array("enabled"), $settings["site_base_currency"], $user["currency_type"], service_price($row["service_id"])));
            $s["without_login_service_price"] = format_amount_string($settings["site_base_currency"], from_to(get_currencies_array("enabled"), "", "", service_price($row["service_id"])));
            $s["service_id"] = $row["service_id"];
            $s["service_name"] = $row["service_name"];
            $s["service_description"] = str_replace("\n", "<br />", $row["service_description"]);
            $s["time"] = $row["time"];
            $s["service_min"] = $row["service_min"];
            $s["service_max"] = $row["service_max"];

            // Check if the client has access to this service
            $search = $conn->prepare("SELECT * FROM clients_service WHERE service_id=:service && client_id=:c_id ");
            $search->execute(array("service" => $row["service_id"], "c_id" => $user["client_id"]));
            if ($row["service_secret"] == 2 || $search->rowCount()) :
                // Add service to the list if the user has access
                $s["is_fav"] = $row["is_fav"] ? true : false; // Add the favorite status
                array_push($services, $s);
            endif;
        }

        // Prepare the category and services for display
        $c["category_name"] = $categoryRow["category_name"];
        $c["category_icon"] = $categoryRow["category_icon"];
        $c["category_id"] = $categoryRow["category_id"];
        $c["services"] = $services;

        // Add category to the list of categories
        array_push($categories, $c);
    endif;
}

<?php
if (!defined('BASEPATH')) {
    die('Direct access to the script is not allowed');
}

// Check admin bulk access
if ($admin["access"]["bulk"] != 1) {
    header("Location:" . site_url("$rentaladmin"));
    exit();
}

// Session data handling
if ($_SESSION["client"]["data"]) {
    $data = $_SESSION["client"]["data"];
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    unset($_SESSION["client"]);
}

// Handle GET request
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (route(2) == "getData") {
        $services = $conn->prepare("
            SELECT service_id, service_name, service_min, service_max, service_price, service_description 
            FROM services 
            WHERE service_deleted = :deleted AND category_id = :cid
        ");

        $services->execute([
            "deleted" => 0,
            "cid" => $_GET["categoryId"]
        ]);

        $services = $services->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($services);
        exit();
    } else {
        require admin_view('bulk');
    }
}

// Handle POST request (Bulk Update)
if ($_POST) {

    $services = $_POST["service"];

    $conn->beginTransaction();

    try {
        foreach ($services as $id => $value) {

            // Prepare JSON encoded values for "en" language
            $nameLang = json_encode(["en" => $_POST["name-$id"]], JSON_UNESCAPED_UNICODE);
            $descLang = json_encode(["en" => $_POST["desc-$id"]], JSON_UNESCAPED_UNICODE);

            // Extract normal text values
            $serviceName = $_POST["name-$id"];
            $serviceDesc = $_POST["desc-$id"];

            // Update query
            $update = $conn->prepare("
                UPDATE services 
                SET 
                    service_name = :service_name, 
                    service_description = :service_desc,
                    name_lang = :name_lang,
                    description_lang = :desc_lang,
                    service_min = :min, 
                    service_max = :max, 
                    service_price = :price
                WHERE service_id = :id
            ");

            $update->execute([
                "service_name"  => $serviceName,
                "service_desc"  => $serviceDesc,
                "name_lang"     => $nameLang,
                "desc_lang"     => $descLang,
                "min"           => $_POST["min-$id"],
                "max"           => $_POST["max-$id"],
                "price"         => $_POST["price-$id"],
                "id"            => $id
            ]);
        }

        $conn->commit();

        $_SESSION["client"]["data"]["success"] = 1;
        $_SESSION["client"]["data"]["successText"] = "Successful";

    } catch (Exception $e) {
        $conn->rollBack();
        $_SESSION["client"]["data"]["error"] = 1;
        $_SESSION["client"]["data"]["errorText"] = "Update Failed: " . $e->getMessage();
    }

    header("Location:" . site_url("$rentaladmin/bulk"));
    exit();
}

<?php
ini_set('max_execution_time', '600');
define("BASEPATH", TRUE);
require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/init.php";

$SMM_API = new SMMApi();
$settings_query = $conn->prepare("SELECT auto_avg_time FROM settings LIMIT 1");
$settings_query->execute();
$settings_data = $settings_query->fetch(PDO::FETCH_ASSOC);

$AUTO_AVG_TIME_SETTING = $settings_data['auto_avg_time']; 
$SELLERS = $conn->prepare("SELECT id, api_name, api_url, api_key, currency FROM service_api WHERE api_sync=:sync");
$SELLERS->execute([
    "sync" => 1
]);
$SELLERS = $SELLERS->fetchAll(PDO::FETCH_ASSOC);
$SELLERS = replaceKeys("id", "api_id", $SELLERS);
$SELLERS = replaceKeys("currency", "api_currency", $SELLERS);

function convertTime($minutes) {
    if ($minutes === null || $minutes === '' || $minutes == 0) {
        return 'Not enough data';
    }

    $hours = floor($minutes / 60);
    $minutes = $minutes % 60;

    if ($hours > 0 && $minutes > 0) {
        return $hours . ' hours ' . $minutes . ' minutes';
    } elseif ($hours > 0) {
        return $hours . ' hour' . ($hours > 1 ? 's' : '');
    } else {
        return $minutes . ' minutes';
    }
}

for ($i = 0; $i < count($SELLERS); $i++) {
    $SERVICES_OF_SELLER = $conn->prepare("SELECT * FROM services WHERE service_api=:apitype AND service_sync=:sync");
    $SERVICES_OF_SELLER->execute(array(
        "apitype" => $SELLERS[$i]["api_id"],
        "sync" => 1
    ));
    $SERVICES_OF_SELLER = $SERVICES_OF_SELLER->fetchAll(PDO::FETCH_ASSOC);

    if (count($SERVICES_OF_SELLER)) {
        sleep(rand(5, 30));
        $API_SERVICES = $SMM_API->action(
            array(
                'key' => $SELLERS[$i]["api_key"], 'action' => 'services'
            ),
            $SELLERS[$i]["api_url"]
        );

        if (is_array($API_SERVICES)) {
            $API_SERVICES = json_encode($API_SERVICES, true);
            $API_SERVICES = array_group_by(json_decode($API_SERVICES, true), "service");

            for ($j = 0; $j < count($SERVICES_OF_SELLER); $j++) {
                $PANEL_SERVICE_ID = $SERVICES_OF_SELLER[$j]["service_id"];
                $PANEL_API_SERVICE_ID = $SERVICES_OF_SELLER[$j]["api_service"];
                $API_DETAIL_JSON = $SERVICES_OF_SELLER[$j]["api_detail"];
                $API_DETAIL_ARRAY = json_decode($API_DETAIL_JSON, 1);
                $PANEL_SERVICE_PRICE = $SERVICES_OF_SELLER[$j]["service_price"];
                $PANEL_SERVICE_MIN_QUANTITY = $SERVICES_OF_SELLER[$j]["service_min"];
                $PANEL_SERVICE_MAX_QUANTITY = $SERVICES_OF_SELLER[$j]["service_max"];
                $PANEL_PRICE_SERVICE_PROFIT = $SERVICES_OF_SELLER[$j]["price_profit"];
                $PANEL_API_SERVICE_TYPE = $SERVICES_OF_SELLER[$j]["api_servicetype"];
                $PANEL_SERVICE_SECRET = $SERVICES_OF_SELLER[$j]["service_secret"];

                if (!empty($API_SERVICES[$PANEL_API_SERVICE_ID])) {
                    $API_SERVICE_PRICE = $API_SERVICES[$PANEL_API_SERVICE_ID][0]["rate"];
                    $API_SERVICE_MIN_QUANTITY = $API_SERVICES[$PANEL_API_SERVICE_ID][0]["min"];
                    $API_SERVICE_MAX_QUANTITY = $API_SERVICES[$PANEL_API_SERVICE_ID][0]["max"];
                    $API_SERVICE_AVG_TIME = $API_SERVICES[$PANEL_API_SERVICE_ID][0]["average_time"];
                    $API_SERVICE_REFILL = $API_SERVICES[$PANEL_API_SERVICE_ID][0]["refill"];
                    $API_SERVICE_CANCEL = $API_SERVICES[$PANEL_API_SERVICE_ID][0]["cancel"];
                     if ($SERVICES_OF_SELLER[$j]["show_refill"] != ($API_SERVICE_REFILL ? 'true' : 'false')) {
                        $update_refill_status = $conn->prepare("UPDATE services SET show_refill=:show_refill WHERE service_id=:service_id");
                        $update_refill_status->execute([
                            "show_refill" => $API_SERVICE_REFILL ? 'true' : 'false',
                            "service_id" => $PANEL_SERVICE_ID
                        ]);

                        // Log refill update
                        $insert_refill_log = $conn->prepare("INSERT INTO sync_logs SET service_id=:service_id, api_id=:api_id, action=:action, description=:description, date=:date");
                        $insert_refill_log->execute([
                            "service_id" => $PANEL_SERVICE_ID,
                            "api_id" => $SELLERS[$i]["api_id"],
                            "action" => "SERVICE REFILL UPDATED",
                            "description" => "Service Refill <b>" . ($API_SERVICE_REFILL ? 'Enabled' : 'Disabled') . "</b>",
                            "date" => date("Y-m-d H:i:s")
                        ]);
                        $insert_refill_update = $conn->prepare("INSERT INTO updates SET service_id=:service_id, action=:action, description=:description, date=:date");
    $insert_refill_update->execute([
        "service_id" => $PANEL_SERVICE_ID,
        "action" => "REFILL STATUS UPDATED",
        "description" => "Service Refill Status <b>" . ($API_SERVICE_REFILL ? 'Enabled' : 'Disabled') . "</b>",
        "date" => date("Y-m-d H:i:s")
    ]);
                    }

                    // Cancel Button Update
                    if ($SERVICES_OF_SELLER[$j]["cancelbutton"] != ($API_SERVICE_CANCEL ? '1' : '2')) {
                        $update_cancel_status = $conn->prepare("UPDATE services SET cancelbutton=:cancelbutton WHERE service_id=:service_id");
                        $update_cancel_status->execute([
                            "cancelbutton" => $API_SERVICE_CANCEL ? '1' : '2',
                            "service_id" => $PANEL_SERVICE_ID
                        ]);

                        // Log cancel update
                        $insert_cancel_log = $conn->prepare("INSERT INTO sync_logs SET service_id=:service_id, api_id=:api_id, action=:action, description=:description, date=:date");
                        $insert_cancel_log->execute([
                            "service_id" => $PANEL_SERVICE_ID,
                            "api_id" => $SELLERS[$i]["api_id"],
                            "action" => "SERVICE CANCEL UPDATED",
                            "description" => "Service Cancel <b>" . ($API_SERVICE_CANCEL ? 'Enabled' : 'Disabled') . "</b>",
                            "date" => date("Y-m-d H:i:s")
                        ]);
                         $insert_cancel_update = $conn->prepare("INSERT INTO updates SET service_id=:service_id, action=:action, description=:description, date=:date");
    $insert_cancel_update->execute([
        "service_id" => $PANEL_SERVICE_ID,
        "action" => "CANCEL BUTTON UPDATED",
        "description" => "Service Cancel Status <b>" . ($API_SERVICE_CANCEL ? 'Enabled' : 'Disabled') . "</b>",
        "date" => date("Y-m-d H:i:s")
    ]);
                    }
if ($AUTO_AVG_TIME_SETTING == 2) {
                    // Skip if average time is not available, empty, or zero
                    if ($API_SERVICE_AVG_TIME !== null && $API_SERVICE_AVG_TIME !== '' && $API_SERVICE_AVG_TIME != 0) {
                        $converted_time = convertTime($API_SERVICE_AVG_TIME);

                        if ($SERVICES_OF_SELLER[$j]["time"] != $converted_time) {
                            // API SERVICE AVERAGE TIME CHANGED
                            $update_service_time = $conn->prepare("UPDATE services SET time=:average_time WHERE service_id=:service_id");
                            $update_service_time->execute(array(
                                "service_id" => $PANEL_SERVICE_ID,
                                "average_time" => $converted_time
                            ));
                        } // API SERVICE AVERAGE TIME CHANGED
                    }
}
                    if ($API_DETAIL_ARRAY["rate"] != $API_SERVICE_PRICE) {
                        // API SERVICE PRICE CHANGED 
                        $API_DETAIL_ARRAY["rate"] = $API_SERVICE_PRICE;
                        $API_DETAIL_UPDATED_JSON = json_encode($API_DETAIL_ARRAY, 1);
                        $update_api_detail = $conn->prepare("UPDATE services SET api_detail=:detail WHERE service_id=:service_id");
                        $update_api_detail->execute(array(
                            "service_id" => $PANEL_SERVICE_ID,
                            "detail" => $API_DETAIL_UPDATED_JSON
                        ));
                        // CONVERTING AND UPDATING PANEL PRICE
                        $NEW_BASE_CURRENCY_CONVERTED_PANEL_PRICE = from_to(get_currencies_array("all"), $SELLERS[$i]["api_currency"], $settings["site_base_currency"], $API_SERVICE_PRICE);
                        $get_old_price = $conn->prepare("SELECT service_price FROM services WHERE service_id=:service_id");
$get_old_price->execute(["service_id" => $PANEL_SERVICE_ID]);
$old_price_data = $get_old_price->fetch(PDO::FETCH_ASSOC);
$old_price = format_amount_string($settings["site_base_currency"], $old_price_data["service_price"]); 

                        $NEW_PANEL_SERVICE_PRICE = $NEW_BASE_CURRENCY_CONVERTED_PANEL_PRICE + (($PANEL_PRICE_SERVICE_PROFIT / 100) * $NEW_BASE_CURRENCY_CONVERTED_PANEL_PRICE);
                        $new_price = format_amount_string($settings["site_base_currency"], $NEW_PANEL_SERVICE_PRICE);

                        $update_panel_service_price = $conn->prepare("UPDATE services SET service_price=:price WHERE service_id=:service_id");
                        $update_panel_service_price->execute(array(
                            "service_id" => $PANEL_SERVICE_ID,
                            "price" => $NEW_PANEL_SERVICE_PRICE
                        ));

                        // INSERT PRICE CHANGE LOGS
                        $insert_rate_changed_log = $conn->prepare("INSERT INTO sync_logs SET service_id=:service_id, api_id=:api_id, action=:action,  description=:description, date=:date");

                        $insert_rate_changed_log = $insert_rate_changed_log->execute(array(
                            "service_id" => $PANEL_SERVICE_ID,
                            "api_id" => $SELLERS[$i]["api_id"],
                            "action" => "SERVICE PRICE UPDATED",
                            "description" => "Service rate changed from <b>" . format_amount_string($settings["site_base_currency"], $PANEL_SERVICE_PRICE) . "</b> to <b>" . format_amount_string($settings["site_base_currency"], $NEW_PANEL_SERVICE_PRICE) . "</b>",
                            "date" => date("Y-m-d H:i:s")
                        ));
                         $insert_price_update = $conn->prepare("INSERT INTO updates SET service_id=:service_id, action=:action, description=:description, date=:date");
    $insert_price_update->execute([
        "service_id" => $PANEL_SERVICE_ID,
        "action" => "SERVICE PRICE UPDATED",
        "description" => "Service price changed from <b>" . $old_price . "</b> to <b>" . $new_price . "</b>",
        "date" => date("Y-m-d H:i:s")
    ]);
                    } // API SERVICE PRICE CHANGED

                    // SERVICE MINIMUM QUANTITY CHANGED
                    if ($API_DETAIL_ARRAY["min"] != $API_SERVICE_MIN_QUANTITY) {
                        $old_min = $API_DETAIL_ARRAY["min"];
                        $API_DETAIL_ARRAY["min"] = $API_SERVICE_MIN_QUANTITY;

                        $API_DETAIL_UPDATED_JSON = json_encode($API_DETAIL_ARRAY, 1);
                        $update_api_detail = $conn->prepare("UPDATE services SET api_detail=:detail WHERE service_id=:service_id");
                        $update_api_detail->execute(array(
                            "service_id" => $PANEL_SERVICE_ID,
                            "detail" => $API_DETAIL_UPDATED_JSON
                        ));

                        $update_service_min_quantity = $conn->prepare("UPDATE services SET service_min=:min WHERE service_id=:service_id");
                        $update_service_min_quantity->execute(array(
                            "service_id" => $PANEL_SERVICE_ID,
                            "min" => $API_SERVICE_MIN_QUANTITY
                        ));

                        $insert_min_changed_log = $conn->prepare("INSERT INTO sync_logs SET service_id=:service_id, api_id=:api_id, action=:action,  description=:description, date=:date");

                        $insert_min_changed_log = $insert_min_changed_log->execute(array(
                            "service_id" => $PANEL_SERVICE_ID,
                            "api_id" => $SELLERS[$i]["api_id"],
                            "action" => "SERVICE MINIMUM QUANTITY UPDATED",
                            "description" => "Service minimum quantity changed from <b>" . $PANEL_SERVICE_MIN_QUANTITY . "</b> to <b>" . $API_SERVICE_MIN_QUANTITY . "</b>",
                            "date" => date("Y-m-d H:i:s")
                        ));
                        $insert_min_update = $conn->prepare("INSERT INTO updates SET service_id=:service_id, action=:action, description=:description, date=:date");
    $insert_min_update->execute([
        "service_id" => $PANEL_SERVICE_ID,
        "action" => "SERVICE MINIMUM QUANTITY UPDATED",
        "description" => "Service minimum quantity changed from <b>$old_min</b> to <b>$API_SERVICE_MIN_QUANTITY</b>",
        "date" => date("Y-m-d H:i:s")
    ]);
                    } // SERVICE MIN QUANTITY CHANGED 

                    if ($API_DETAIL_ARRAY["max"] != $API_SERVICE_MAX_QUANTITY) {
                        $old_max = $API_DETAIL_ARRAY["max"];
                        $API_DETAIL_ARRAY["max"] = $API_SERVICE_MAX_QUANTITY;

                        $API_DETAIL_UPDATED_JSON = json_encode($API_DETAIL_ARRAY, 1);
                        $update_api_detail = $conn->prepare("UPDATE services SET api_detail=:detail WHERE service_id=:service_id");
                        $update_api_detail->execute(array(
                            "service_id" => $PANEL_SERVICE_ID,
                            "detail" => $API_DETAIL_UPDATED_JSON
                        ));

                        $update_service_max_quantity = $conn->prepare("UPDATE services SET service_max=:max WHERE service_id=:service_id");
                        $update_service_max_quantity->execute(array(
                            "service_id" => $PANEL_SERVICE_ID,
                            "max" => $API_SERVICE_MAX_QUANTITY
                        ));

                        $insert_max_changed_log = $conn->prepare("INSERT INTO sync_logs SET service_id=:service_id, api_id=:api_id, action=:action,  description=:description, date=:date");

                        $insert_max_changed_log = $insert_max_changed_log->execute(array(
                            "service_id" => $PANEL_SERVICE_ID,
                            "api_id" => $SELLERS[$i]["api_id"],
                            "action" => "SERVICE MAXIMUM QUANTITY UPDATED",
                            "description" => "Service maximum quantity changed from <b>" . $PANEL_SERVICE_MAX_QUANTITY . "</b> to <b>" . $API_SERVICE_MAX_QUANTITY . "</b>",
                            "date" => date("Y-m-d H:i:s")
                        ));
                        $insert_max_update = $conn->prepare("INSERT INTO updates SET service_id=:service_id, action=:action, description=:description, date=:date");
    $insert_max_update->execute([
        "service_id" => $PANEL_SERVICE_ID,
        "action" => "SERVICE MAXIMUM QUANTITY UPDATED",
        "description" => "Service maximum quantity changed from <b>$old_max</b> to <b>$API_SERVICE_MAX_QUANTITY</b>",
        "date" => date("Y-m-d H:i:s")
    ]);
                    } // SERVICE MAX QUANTITY CHANGED 

                    // API SERVICE WAS MARK DISABLED ENABLE IT 
                    // PANEL SERVICE WILL STILL BE DISABLED (if manually disabled)
                    if ($PANEL_API_SERVICE_TYPE == 1) {
                        $update_api_service_type = $conn->prepare("UPDATE services SET api_servicetype=:service_type WHERE service_id=:service_id");

                        $update_api_service_type->execute(array(
                            "service_id" => $PANEL_SERVICE_ID,
                            "service_type" => 2
                        ));

                        if ($PANEL_SERVICE_SECRET == 2) {
                            $update_service_type = $conn->prepare("UPDATE services SET service_type=:service_type WHERE service_id=:service_id");

                            $update_service_type->execute(array(
                                "service_id" => $PANEL_SERVICE_ID,
                                "service_type" => 2
                            ));
                        }

                        $insert_service_type_changed_log = $conn->prepare("INSERT INTO sync_logs SET service_id=:service_id, api_id=:api_id, action=:action,  description=:description, date=:date");

                        $insert_service_type_changed_log = $insert_service_type_changed_log->execute(array(
                            "service_id" => $PANEL_SERVICE_ID,
                            "api_id" => $SELLERS[$i]["api_id"],
                            "action" => "SERVICE ADDED BY THE PROVIDER",
                            "description" => "Service marked <b>ACTIVE</b>",
                            "date" => date("Y-m-d H:i:s")
                        ));
                        $insert_service_active_update = $conn->prepare("INSERT INTO updates SET service_id=:service_id, action=:action, description=:description, date=:date");
    $insert_service_active_update->execute([
        "service_id" => $PANEL_SERVICE_ID,
        "action" => "SERVICE ACTIVATED",
        "description" => "Service marked <b>ACTIVE</b>",
        "date" => date("Y-m-d H:i:s")
    ]);
                    } // API SERVICE WAS MARKED DISABLE
                } // PACKAGE EXIST IN API RESPONSE 
                else {
                    // MARK SERVICE INACTIVE IN PANEL
                    // IF SERVICE IS DISABLED FROM API
                    if ($PANEL_API_SERVICE_TYPE == 2) {
                        $update_service_type = $conn->prepare("UPDATE services SET api_servicetype=:api_servicetype,service_type=:service_type WHERE service_id=:service_id");

                        $update_service_type->execute(array(
                            "service_id" => $PANEL_SERVICE_ID,
                            "api_servicetype" => 1,
                            "service_type" => 1
                        ));

                        $insert_service_type_changed_log = $conn->prepare("INSERT INTO sync_logs SET service_id=:service_id, api_id=:api_id, action=:action,  description=:description, date=:date");

                        $insert_service_type_changed_log = $insert_service_type_changed_log->execute(array(
                            "service_id" => $PANEL_SERVICE_ID,
                            "api_id" => $SELLERS[$i]["api_id"],
                            "action" => "SERVICE REMOVED BY THE PROVIDER",
                            "description" => "Service marked <b>INACTIVE</b>",
                            "date" => date("Y-m-d H:i:s")
                        ));
                        $insert_service_inactive_update = $conn->prepare("INSERT INTO updates SET service_id=:service_id, action=:action, description=:description, date=:date");
    $insert_service_inactive_update->execute([
        "service_id" => $PANEL_SERVICE_ID,
        "action" => "SERVICE DEACTIVATED",
        "description" => "Service marked <b>INACTIVE</b>",
        "date" => date("Y-m-d H:i:s")
    ]);
                    } // CONDITION FOR SERVICE DISABLED
                } // PACKAGE DOESN'T EXIST IN API RESPONSE 
            } // loop for updating services
        } // CHECK IF RESPONSE IS AN ARRAY
    } // CONDITION FOR IF SELLER SERVICES PRESENT
} // LOOP FOR SELLER
?>
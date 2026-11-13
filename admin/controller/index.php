<?php
if(!defined('BASEPATH')) {
   die('Direct access to the script is not allowed');
}
if( $admin["access"]["admin_access"] != 1  ){

    header("Location:".site_url("$rentaladmin"));

    exit();
}


$clients = $conn->prepare("SELECT * FROM clients ORDER BY client_id DESC LIMIT 500");
$clients->execute(array());
$clients = $clients->fetchAll(PDO::FETCH_ASSOC);

$failCount = $conn->prepare("SELECT * FROM orders WHERE orders.dripfeed='1' && orders.subscriptions_type='1' && order_error!=:error ");
$failCount->execute(array("error"=>"-"));
$failCount = $failCount->rowCount();

$todayCount = $conn->prepare("SELECT * FROM orders WHERE last_check=:error ");
$todayCount->execute(array("error"=> date("Y-m-d") ));
$todayCount = $todayCount->rowCount();

$services = $conn->prepare("SELECT * FROM services RIGHT JOIN categories ON categories.category_id = services.category_id LEFT JOIN service_api ON service_api.id = services.service_api ORDER BY categories.category_line,services.service_line ASC ");
$services->execute(array());
$services = $services->fetchAll(PDO::FETCH_ASSOC);
$serviceList = array_group_by($services, 'category_name');

if( empty($yearList) ): $yearList[0] = date("Y"); endif;
if( $_GET["year"] ):
    $year = $_GET["year"];
else:
    $year = date("Y");
endif;

// Fetch daily new user registration data for the current month
$dailyRegistrations = $conn->prepare("SELECT DATE(register_date) as date, COUNT(*) as count FROM clients WHERE MONTH(register_date) = MONTH(CURRENT_DATE()) AND YEAR(register_date) = YEAR(CURRENT_DATE()) GROUP BY DATE(register_date)");
$dailyRegistrations->execute();
$dailyRegistrations = $dailyRegistrations->fetchAll(PDO::FETCH_ASSOC);

// Fetch monthly new user registration data for the current year
$monthlyRegistrations = $conn->prepare("SELECT MONTH(register_date) as month, COUNT(*) as count FROM clients WHERE YEAR(register_date) = YEAR(CURRENT_DATE()) GROUP BY MONTH(register_date)");
$monthlyRegistrations->execute();
$monthlyRegistrations = $monthlyRegistrations->fetchAll(PDO::FETCH_ASSOC);

// Prepare data for the chart
$daysInMonth = date('t');
$dailyData = array_fill(1, $daysInMonth, 0);
foreach ($dailyRegistrations as $registration) {
    $day = (int)date('j', strtotime($registration['date']));
    $dailyData[$day] = $registration['count'];
}

$monthlyData = array_fill(1, 12, 0);
foreach ($monthlyRegistrations as $registration) {
    $month = (int)$registration['month'];
    $monthlyData[$month] = $registration['count'];
}

// Fetch daily number of orders data for the current month
$dailyOrders = $conn->prepare("SELECT DATE(order_create) as date, COUNT(*) as count FROM orders WHERE MONTH(order_create) = MONTH(CURRENT_DATE()) AND YEAR(order_create) = YEAR(CURRENT_DATE()) GROUP BY DATE(order_create)");
$dailyOrders->execute();
$dailyOrders = $dailyOrders->fetchAll(PDO::FETCH_ASSOC);

// Fetch monthly number of orders data for the current year
$monthlyOrders = $conn->prepare("SELECT MONTH(order_create) as month, COUNT(*) as count FROM orders WHERE YEAR(order_create) = YEAR(CURRENT_DATE()) GROUP BY MONTH(order_create)");
$monthlyOrders->execute();
$monthlyOrders = $monthlyOrders->fetchAll(PDO::FETCH_ASSOC);

// Prepare data for the orders chart
$dailyOrdersData = array_fill(1, $daysInMonth, 0);
foreach ($dailyOrders as $order) {
    $day = (int)date('j', strtotime($order['date']));
    $dailyOrdersData[$day] = $order['count'];
}

$monthlyOrdersData = array_fill(1, 12, 0);
foreach ($monthlyOrders as $order) {
    $month = (int)$order['month'];
    $monthlyOrdersData[$month] = $order['count'];
}

// Fetch daily number of payments data for the current month
$dailyPayments = $conn->prepare("SELECT DATE(payment_create_date) as date, COUNT(*) as count FROM payments WHERE MONTH(payment_create_date) = MONTH(CURRENT_DATE()) AND YEAR(payment_create_date) = YEAR(CURRENT_DATE()) GROUP BY DATE(payment_create_date)");
$dailyPayments->execute();
$dailyPayments = $dailyPayments->fetchAll(PDO::FETCH_ASSOC);

// Fetch monthly number of payments data for the current year
$monthlyPayments = $conn->prepare("SELECT MONTH(payment_create_date) as month, COUNT(*) as count FROM payments WHERE YEAR(payment_create_date) = YEAR(CURRENT_DATE()) GROUP BY MONTH(payment_create_date)");
$monthlyPayments->execute();
$monthlyPayments = $monthlyPayments->fetchAll(PDO::FETCH_ASSOC);

// Prepare data for the payments chart
$dailyPaymentsData = array_fill(1, $daysInMonth, 0);
foreach ($dailyPayments as $payment) {
    $day = (int)date('j', strtotime($payment['date']));
    $dailyPaymentsData[$day] = $payment['count'];
}

$monthlyPaymentsData = array_fill(1, 12, 0);
foreach ($monthlyPayments as $payment) {
    $month = (int)$payment['month'];
    $monthlyPaymentsData[$month] = $payment['count'];
}

// Fetch daily profits data for the current month
$dailyProfits = $conn->prepare("SELECT DATE(order_create) as date, SUM(order_profit) as total_profit FROM orders WHERE MONTH(order_create) = MONTH(CURRENT_DATE()) AND YEAR(order_create) = YEAR(CURRENT_DATE()) GROUP BY DATE(order_create)");
$dailyProfits->execute();
$dailyProfits = $dailyProfits->fetchAll(PDO::FETCH_ASSOC);

// Fetch monthly profits data for the current year
$monthlyProfits = $conn->prepare("SELECT MONTH(order_create) as month, SUM(order_profit) as total_profit FROM orders WHERE YEAR(order_create) = YEAR(CURRENT_DATE()) GROUP BY MONTH(order_create)");
$monthlyProfits->execute();
$monthlyProfits = $monthlyProfits->fetchAll(PDO::FETCH_ASSOC);

// Prepare data for the profits chart
$dailyProfitsData = array_fill(1, $daysInMonth, 0);
foreach ($dailyProfits as $profit) {
    $day = (int)date('j', strtotime($profit['date']));
    $dailyProfitsData[$day] = $profit['total_profit'];
}

$monthlyProfitsData = array_fill(1, 12, 0);
foreach ($monthlyProfits as $profit) {
    $month = (int)$profit['month'];
    $monthlyProfitsData[$month] = $profit['total_profit'];
}

// Pass the data to the view
require admin_view('index');


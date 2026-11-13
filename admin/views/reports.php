<?php include 'header.php'; ?>

<style>
    /* Prevent Responsive Scaling */
    @media screen and (max-width: 768px) {
        /* Fixed width to simulate desktop on smaller screens */
        .container-fluid {
            min-width: 1024px;
        }
    }

    .nav-tabs {
        margin-bottom: 20px;
    }

    .nav-tabs .nav-item {
        margin-right: 15px;
    }

    .nav-tabs .nav-link {
        border: 1px solid transparent;
        padding: 14px 28px;
        height: unset !important;
        border-radius: 4px;
        color: #5a5a5a;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .nav-tabs .nav-link.active {
        background-color: #007bff;
        color: white;
    }

    .selectpicker {
        width: auto;
    }

    .report-table {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        margin-top: 20px;
        width: 100%;
    }

    .report-table th,
    .report-table td {
        padding: 12px;
        vertical-align: middle;
        text-align: center;
    }

    .thead-light {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 4px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    h4 {
        margin-top: 30px;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .p-b {
        padding-bottom: 15px;
    }

    input[type="hidden"] {
        display: none;
    }

    .mt-4 {
        margin-top: 1.5rem !important;
    }

    /* Link */
    li.active > a.nav-link {
        background: linear-gradient(145deg, #007bff, #0056b3);
        color: #ffffff;
        padding: 14px 28px;
        font-size: 14px;
        font-weight: 500;
        border: none;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background 0.3s ease, transform 0.2s ease;
    }

    li.active > a.nav-link:hover {
        background: linear-gradient(145deg, #0056b3, #003c82);
        color: #ffffff;
        transform: translateY(-2px);
    }

    @import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap");

    /* Button */
    .form-inline > .btn-group a {
        display: flex;
        align-items: center;
        background-color: #e9ecef;
        border-radius: 8px;
        padding: 12px;
        color: #333;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        min-height: 50px;
    }

    .nav-tabs .form-inline .btn-primary {
        background: linear-gradient(145deg, #007bff, #0056b3);
        color: #ffffff;
        padding: 14px 28px;
        font-size: 14px;
        font-weight: 500;
        border: none;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .nav-tabs .form-inline .btn-primary:hover {
        background: linear-gradient(145deg, #0056b3, #003c82);
        transform: translateY(-2px);
    }

    .container-fluid .nav-tabs {
        font-family: 'Inter', sans-serif;
    }

    .container-fluid .table-responsive {
        font-family: 'Inter', sans-serif;
    }

    .report-table tr th {
        text-transform: uppercase;
    }
    /* Button */
.form-inline .btn-group .dropdown-toggle{
 display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}


</style>
<style>
.log-menu {
   padding-left: 0;
   margin: 0;
}

.log-menu li {
   list-style: none;
   padding: 10px 15px;
   font-weight: 400;
   color: #337ab7;
   border-radius: 6px;
   margin-bottom: 5px;
   transition: background 0.2s;
}

.log-menu li.active {
   background-color: #e0e0e0;
   color: #000;
}

.log-menu li a {
   color: inherit;
   text-decoration: none;
   display: block;
}
</style>
<!-- Meta tag to fix viewport -->
<meta name="viewport" content="width=1024, initial-scale=1">

<div class="container-fluid">
    <ul class="nav nav-tabs p-b">
    <ul class="log-menu">
        <li class="<?php echo ($action == "profit") ? "active" : ""; ?>">
            <a href="<?php echo site_url("$rentaladmin/reports"); ?>">Profit</a>
        </li>
        <li class="<?php echo ($action == "payments") ? "active" : ""; ?>">
            <a href="<?php echo site_url("$rentaladmin/reports/payments"); ?>">Payments</a>
        </li>
        <li class="<?php echo ($action == "orders") ? "active" : ""; ?>">
            <a href="<?php echo site_url("$rentaladmin/reports/orders"); ?>">Orders</a>
        </li>
        
    </ul><br>
        <form action="<?php echo site_url("$rentaladmin/reports/".$action."?year=".$year); ?>" method="post" class="form-inline pull-right">
            <div class="btn-group">
                <?php foreach ($yearList as $yearl): ?>
                    <a href="<?php echo site_url("$rentaladmin/reports/".$action."?year=".$yearl); ?>" class="btn btn-default <?php if ($yearl == $year) echo "active"; ?>">
                        <?php echo $yearl; ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <?php if ($action == "payments"): ?>
                <div class="form-group mx-2">
                    
                </div>
            <?php endif; ?>

            <?php if ($action == "profit" || $action == "orders"): ?>
                <div class="form-group mx-2">
                    <select class="selectpicker" data-actions-box="true" data-live-search="true" name="services[]" multiple data-max-options="100" data-size="10" title="Services">
                        <?php foreach ($serviceList as $category => $services): ?>
                            <optgroup label="<?= $category ?>">
                                <?php foreach ($services as $service): ?>
                                    <option value="<?php echo $service["service_id"]; ?>" <?php if ($_POST && in_array($service["service_id"], $_POST["services"])) echo 'selected'; else echo 'selected'; ?>>
                                        <?php echo $service["service_id"]." - ".$service["service_name"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mx-2">
                    <select class="selectpicker" name="statuses[]" multiple data-max-options="100" data-size="10" title="Order Status">
                        <option value="cron" <?php if ($_POST && in_array("cron", $_POST["statuses"])) echo 'selected'; else echo 'selected'; ?>>Waiting for CRON</option>
                        <option value="fail" <?php if ($_POST && in_array("fail", $_POST["statuses"])) echo 'selected'; else echo 'selected'; ?>>Failed</option>
                        <option value="pending" <?php if ($_POST && in_array("pending", $_POST["statuses"])) echo 'selected'; else echo 'selected'; ?>>Pending</option>
                        <option value="inprogress" <?php if ($_POST && in_array("inprogress", $_POST["statuses"])) echo 'selected'; else echo 'selected'; ?>>In Progress</option>
                        <option value="completed" <?php if ($_POST && in_array("completed", $_POST["statuses"])) echo 'selected'; else echo 'selected'; ?>>Completed</option>
                        <option value="partial" <?php if ($_POST && in_array("partial", $_POST["statuses"])) echo 'selected'; else echo 'selected'; ?>>Partial</option>
                        <option value="canceled" <?php if ($_POST && in_array("canceled", $_POST["statuses"])) echo 'selected'; else echo 'selected'; ?>>Cancelled</option>
                        <option value="processing" <?php if ($_POST && in_array("processing", $_POST["statuses"])) echo 'selected'; else echo 'selected'; ?>>Processing</option>
                    </select>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table report-table">
                    <thead class="thead-light">
                        <tr>
                            <th></th>
                            <th>January</th>
                            <th>February</th>
                            <th>March</th>
                            <th>April</th>
                            <th>May</th>
                            <th>June</th>
                            <th>July</th>
                            <th>August</th>
                            <th>September</th>
                            <th>October</th>
                            <th>November</th>
                            <th>December</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($action == "profit"): ?>
                            <?php for ($day = 1; $day <= 31; $day++): ?>
                                <tr>
                                    <td><?= $day ?></td>
                                    <?php for ($month = 1; $month <= 12; $month++): ?>
                                        <td>
                                            <?php echo dayCharge($day, $month, $year, ["services" => $_POST["services"], "status" => $_POST["statuses"]]); ?>
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endfor; ?>
                            <tr>
                                <td><strong>Gross Profit:</strong></td>
                                <?php for ($month = 1; $month <= 12; $month++): ?>
                                    <td><strong><?php echo monthCharge($month, $year, ["services" => $_POST["services"], "status" => $_POST["statuses"]]); ?></strong></td>
                                <?php endfor; ?>
                            </tr>
                            <tr>
                                <td><strong>Net Profit:</strong></td>
                                <?php for ($month = 1; $month <= 12; $month++): ?>
                                    <td><strong><?php echo monthChargeNet($month, $year, ["services" => $_POST["services"], "status" => $_POST["statuses"]]); ?></strong></td>
                                <?php endfor; ?>
                            </tr>
                        <?php elseif ($action == "payments"): ?>
                            <?php for ($day = 1; $day <= 31; $day++): ?>
                                <tr>
                                    <td><?= $day ?></td>
                                    <?php for ($month = 1; $month <= 12; $month++): ?>
                                        <td>
                                            <?php echo dayPayments($day, $month, $year, ["methods" => $_POST["methods"]]); ?>
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endfor; ?>
                            <tr>
                                <td><strong>Total:</strong></td>
                                <?php for ($month = 1; $month <= 12; $month++): ?>
                                    <td><strong><?php echo monthPayments($month, $year, ["methods" => $_POST["methods"]]); ?></strong></td>
                                <?php endfor; ?>
                            </tr>
                        <?php elseif ($action == "orders"): ?>
                            <?php for ($day = 1; $day <= 31; $day++): ?>
                                <tr>
                                    <td><?= $day ?></td>
                                    <?php for ($month = 1; $month <= 12; $month++): ?>
                                        <td>
                                            <?php echo dayOrders($day, $month, $year, ["services" => $_POST["services"], "status" => $_POST["statuses"]]); ?>
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endfor; ?>
                            <tr>
                                <td><strong>Total:</strong></td>
                                <?php for ($month = 1; $month <= 12; $month++): ?>
                                    <td><strong><?php echo monthOrders($month, $year, ["services" => $_POST["services"], "status" => $_POST["statuses"]]); ?></strong></td>
                                <?php endfor; ?>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

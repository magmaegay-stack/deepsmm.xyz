<?php include 'header.php'; ?>
<style>
/* Prevent Responsive Scaling */
@media screen and (max-width: 768px) {
    .container-fluid {
        min-width: 1024px;
    }
}

body {
    background-color: #f9f9f9;
    font-family: 'Inter', sans-serif;
    color: #333;
}

/* Table Styling */
.table {
    margin-top: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.table thead th {
    background-color: #f1f1f1;
    color: #333;
    font-weight: 600;
    padding: 12px;
    text-align: center;
    text-transform: uppercase;
}

.table tbody td {
    padding: 12px;
    vertical-align: middle;
    color: #555;
    text-align: center;
}

/* Search Box */
.form-inline .input-group {
    margin-top: 10px;
}

.form-control {
    border: 1px solid #ced4da;
    border-radius: 5px;
    font-size: 14px;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 4px rgba(0, 123, 255, 0.2);
}

/* Search Button */
.btn-default {
    background-color: #007bff;
    color: #fff;
}

.btn-default:hover {
    background-color: #0056b3;
}

/* Dropdown Styling */
.dropdown-menu {
    min-width: 150px;
}

.dropdown-menu a {
    color: #555;
}

.dropdown-menu a:hover {
    background-color: #f1f1f1;
}

/* Active Navigation */
.nav-stacked .active a {
    background: linear-gradient(145deg, #007bff, #0056b3);
    color: #ffffff;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.nav-stacked li a {
    color: #5a5a5a;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border-radius: 5px;
    transition: background 0.3s ease, transform 0.2s ease;
}

/* Button Styling */
.btn-danger {
    background: linear-gradient(145deg, #c71f1f, #e04d4d);
    color: #ffffff;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    transition: background 0.3s ease, transform 0.2s ease;
}

.btn-danger:hover {
    background: linear-gradient(145deg, #e04d4d, #f76c6c);
    transform: translateY(-2px);
}

/* Input Fields */
.input-group .input-group-btn .btn {
    background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
.form-inline .input-group input[type=text]{
    background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
/* Remove Border Radius for First and Last Input */
.form-inline .input-group input[type=text] {
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
}

.input-group .input-group-btn .btn {
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
}

/* Fix Table Overflow */
.container-fluid .order-table {
    border-radius: 8px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
}

.order-table tr th {
    text-align: center;
}

/* Dropdown Buttons */
.service-block__action .dropdown .btn-xs-caret {
    background-color: #f0f0f0 !important;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
}

</style>
<div class="container-fluid">
<div class="row">
<div class="col-md-2">
<ul class="nav nav-pills nav-stacked p-b">
<li class=""><a href="https://<?php echo "$url/"; echo $rentaladmin; ?>/referrals">Referrals</a></li>
<li class="active"><a href="https://<?php echo "$url/"; echo $rentaladmin; ?>/payouts">Payouts</a></li>
</ul>
</div>
<div class="col-md-10">
<ul class="nav nav-tabs">
<li class="pull-right p-b">
<form class="form-inline" action="" method="GET">
<div class="input-group">
<input type="text" name="search" class="form-control" placeholder="Search">
<input type="hidden" name="type" value="referrals">
<span class="input-group-btn">
<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
</span>
</div>
</form>
</li>
</ul>
                            <table class="table order-table">
                                <thead>
                                    <tr>
                                        <th class="p-l">#</th>
                                        <th> Code</th>
                                        <th> Username </th>
                                        <th>Amount Requested</th>
                                        <th>Payout Status</th>
                                        <th>Payout Created At</th>
                                        <th>Payout Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <form id="changebulkForm" action="<?php echo site_url("$rentaladmin/payouts") ?>" method="post">
                                    <tbody>
                                        <?php foreach ($referral_payouts as $referral_payout) : ?>
                                            <tr>
                                                <td><?php echo $referral_payout["r_p_id"] ?></td>
                                                <td><?php echo $referral_payout["r_p_code"] ?></td>
                                                <td><?php echo $referral_payout["username"] ?></td>
                                                <td><?php echo $referral_payout["r_p_amount_requested"] ?></td>
                                                <td><?php if ($referral_payout["r_p_status"] == 0) {
                                                        echo "Pending";
                                                    } elseif (
                                                        $referral_payout["r_p_status"] == 1
                                                    ) {
                                                        echo "Disapproved ";
                                                    }elseif (
                                                        $referral_payout["r_p_status"] == 2
                                                    ){
                                                        echo "Approved ";
                                                    } else {
                                                        echo "Rejected ";
                                                    }
                                                       
                                                      ?></td>
                                                <td><?php echo $referral_payout["r_p_requested_at"] ?></td>
                                                <td><?php echo $referral_payout["r_p_updated_at"] ?></td>


                                                <td class="service-block__action">
                                                    <div class="dropdown pull-right">
                                                        <button type="button" class="btn btn-primary btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Action</button>
                                                        <ul class="dropdown-menu">

                                                            <?php if ($referral_payout["r_p_status"] == 0) : ?>
                                                              
                                                                    <li><a href="<?= site_url("$rentaladmin/payouts?approve=" . $referral_payout["r_p_id"]) ?>">Approve</a></li>
                                                                    <li><a href="<?= site_url("$rentaladmin/payouts?disapprove=" . $referral_payout["r_p_id"]) ?>">Disapprove</a></li>
                                                                    <li><a href="<?= site_url("$rentaladmin/payouts?reject=" . $referral_payout["r_p_id"]) ?>">Reject</a></li>

                                                             
                                                            <?php else : ?>

                                                                <li><a href="javascript:void(0)">No options to use</a></li>
                                                            <?php endif; ?>

                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <input type="hidden" name="bulkStatus" id="bulkStatus" value="0">
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'footer.php'; ?>


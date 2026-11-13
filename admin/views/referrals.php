<?php include 'header.php'; ?>

<style>
/* Prevent Responsive Scaling */
    @media screen and (max-width: 768px) {
        /* Fixed width to simulate desktop on smaller screens */
        .container-fluid {
            min-width: 1024px;
        }
    }
    body {
        background-color: #f9f9f9;
        font-family: 'Inter', sans-serif;
        color: #333;
    }

    
    

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
    }

    .table tbody td {
        padding: 12px;
        vertical-align: middle;
        color: #555;
    }

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

    .btn-default {
        background-color: #007bff;
        color: #fff;
    }

    .btn-default:hover {
        background-color: #0056b3;
    }

    .dropdown-menu {
        min-width: 150px;
    }

    .dropdown-menu a {
        color: #555;
    }

    .dropdown-menu a:hover {
        background-color: #f1f1f1;
    }
    /* Th */
.order-table tr .p-l{
 text-transform:uppercase;
}

/* Th */
.order-table tr th{
 text-transform:uppercase;
}

/* Button */
.input-group .input-group-btn .btn{
 background-color:rgba(255,255,255,0);
 min-height:34px;
}


/* Link */
.nav-stacked .active a{
 background: linear-gradient(145deg, #007bff, #0056b3); /* Light gradient */
    color: #ffffff;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
}

/* Link */
.nav-stacked li a{
    color: #5a5a5a;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
}
/* Table Data */
.order-table tr td{
 text-align:center;
}

/* Service block  action */
.order-table tr .service-block__action{
 text-align:center;
 padding-left:1px !important;
 padding-right:20px !important;
}
.btn-danger{
 background: linear-gradient(145deg, #c71f1f, #e04d4d); /* Gradient background for a professional look */
  color: #ffffff; /* Text color */
 padding: 14px 28px;
  font-size: 14px; /* Font size */
  font-weight: 500; /* Font weight */
  border: none; /* Remove default border */
  border-radius: 5px; /* Slightly rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Subtle shadow for depth */
  transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
}
.btn-danger:hover {
  background: linear-gradient(145deg, #e04d4d, #f76c6c); /* Darker gradient on hover */
  transform: translateY(-2px); /* Slight lift effect */
}
.service-block__action .dropdown .btn-xs-caret{
    background-color: #f0f0f0 !important;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
}
/* Input */
.form-inline .input-group input[type=text]{
 background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Button */
.input-group .input-group-btn .btn{
 background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
/* Input */
.form-inline .input-group input[type=text]{
 border-top-right-radius:0px !important;
 border-bottom-right-radius:0px !important;
}

/* Button */
.input-group .input-group-btn .btn{
 border-top-left-radius:0px !important;
 border-bottom-left-radius:0px !important;
}
/* Order table */
.container-fluid .order-table{
 left:-22px;
}

.container-fluid .order-table {
    border-radius: 8px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
}
/* Th */
.order-table tr th{
 text-align:center;
}



</style>
<!-- Meta tag to fix viewport -->
<meta name="viewport" content="width=1024, initial-scale=1">
<div class="container-fluid">
<div class="row">
<div class="col-md-2">
<ul class="nav nav-pills nav-stacked p-b">
<li class="active"><a href="https://<?php echo "$url/"; echo $rentaladmin; ?>/referrals">Referrals</a></li>
<li class=""><a href="https://<?php echo "$url/"; echo $rentaladmin; ?>/payouts">Payouts</a></li>
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
                                        <th class="p-l">ID</th>
                                        <th>Username</th>
                                        <th>Total Visits</th>
                                        <th>Sign Up</th>
                                        <th>Total Commission</th>
                                        <th>Status</th>
                                        <!-- <th>Reffered Accounts Username</th> -->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <form id="changebulkForm" action="<?php echo site_url("$rentaladmin/payments/online/multi-action") ?>" method="post">
                                    <tbody>
                                        <?php foreach ($referrals as $referral) : ?>
                                            <tr>
                                               <td><?php echo $referral["referral_id"] ?></td> 
                                               <td><?php echo $referral["username"] ?></td>
                                               <td><?php echo $referral["referral_clicks"] ?></td>
                                               <td><?php echo $referral["referral_sign_up"] ?></td>
                                               <td><?php echo $referral["referral_total_commision"] ?></td>
                                               <td><?php if($referral["referral_status"]==2){echo "Active";}else{echo "Inactive";}  ?></td>
                                               <td class="service-block__action">
                                                <div class="dropdown pull-right">
                                                    <button type="button" class="btn btn-primary btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Action</button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" data-toggle="modal" data-target="#modalDiv" data-action="reffered_users" data-id="<?php echo $referral["referral_code"] ?>">View Referred Users</a></li>
                                                        <!-- <li><a >Disable Refferal</a></li> -->
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

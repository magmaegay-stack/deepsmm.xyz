<?php include 'header.php'; ?>

<style>
    .report-table {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .report-table th,
    .report-table td {
        padding: 12px;
        vertical-align: middle;
    }
    
    .thead-light {
        background-color: #f8f9fa;
        color: #343a40;
        font-weight: 600;
    }

    .table-responsive {
        margin-top: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .modal-title {
        font-weight: bold;
    }

    h4 {
        margin-top: 30px;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .p-b {
        padding-bottom: 15px;
    }

    

    .btn {
        border-radius: 4px;
    }

    .form-control {
        border-radius: 4px;
    }

    input[type="hidden"] {
        display: none;
    }

    .mt-3 {
        margin-top: 1rem !important;
    }

    .mt-4 {
        margin-top: 1.5rem !important;
    }
    /* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Menu */
.container-fluid .row ul{
 font-family:'Inter', sans-serif;
}

/* Column 12/12 */
.container-fluid .col-md-12{
 font-family:'Inter', sans-serif;
}

/* Th */
.col-md-12 tr th{
 text-transform:uppercase;
}

/* Button */
.nav-tabs .p-b .btn-primary{
    width:100%;
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
.nav-tabs .p-b .btn-primary:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Modal div */
#modalDiv{
 font-family:'Inter', sans-serif;
}

/* Modal title */
#modalTitle{
 font-weight:600;
 text-transform:capitalize;
}

/* Label */
.modal-body .form-group label{
 text-transform:capitalize;
}

/* Input */
.modal-body .form-group input[type=text]{
  display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Button */
.form .modal-footer .btn-primary{
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
.form .modal-footer .btn-primary:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Button */
.form .modal-footer .btn-danger{
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
.form .modal-footer .btn-danger:hover {
  background: linear-gradient(145deg, #e04d4d, #f76c6c); /* Darker gradient on hover */
  transform: translateY(-2px); /* Slight lift effect */
}

</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="p-b">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDiv" data-action="yeni_kupon">Create Coupon</button>
                </li>
            </ul>

            <div class="table-responsive mt-3">
                <table class="table report-table">
                    <thead class="thead-light">
                        <tr>
                            <th width="33%">Coupon Code</th>
                            <th width="15%">Piece</th>
                            <th width="33%">Amount</th>
                            <th width="19%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($kuponlar as $kupon): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($kupon["kuponadi"]); ?></td>
                                <td><?php echo htmlspecialchars($kupon["adet"]); ?></td>
                                <td><?php echo htmlspecialchars($kupon["tutar"]); ?></td>
                                <td class="text-center">
                                    <form action="<?php echo site_url("$rentaladmin/kuponlar/delete"); ?>" method="post" onsubmit="return confirm('Do you want to delete this coupon ?');" style="display:inline;">
                                        <input type="hidden" name="kupon_id" value="<?php echo htmlspecialchars($kupon["id"]); ?>">
                                        <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <hr class="mt-4">
            <h4>Coupons Used</h4>

            <div class="table-responsive">
                <table class="table report-table">
                    <thead class="thead-light">
                        <tr>
                            <th width="33%">Member Number</th>
                            <th width="15%">Coupon Code</th>
                            <th width="33%">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($kupon_kullananlar as $kupons): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($kupons["uye_id"]); ?></td>
                                <td><?php echo htmlspecialchars($kupons["kuponadi"]); ?></td>
                                <td><?php echo htmlspecialchars($kupons["tutar"]); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

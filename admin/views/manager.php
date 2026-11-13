<?php require 'header.php'; ?>
<style>
html, body {
    background-color: #f5f5f5 !important; /* Light gray background */
    color: #333; /* Dark text color */
    font-family: 'Inter', sans-serif;
}

.nav-tabs {
    border-bottom: 1px solid #ccc;
}

h3 {
    color: #333; /* Dark text color */
    margin: 20px 0;
}

.table {
    background-color: #ffffff; /* White background for the table */
    color: #333; /* Dark text color */
    border-radius: 8px;
    width: 100%;
    text-align: left;
    table-layout: auto;
    margin-bottom: 20px;
}

.table th, .table td {
    padding: 15px;
    border-bottom: 1px solid #ddd; /* Light border for table cells */
}

.table th {
    background-color: #f0f0f0; /* Light gray background for headers */
    font-weight: 600;
    text-transform: uppercase;
}

.table td {
    background-color: #ffffff; /* White background for table data */
}

.table thead th {
    border: none;
}

.td-caret .dropdown .btn-xs-caret {
    background-color: #f0f0f0 !important;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
  }

.nav-tabs .p-b .btn-primary {
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
/* Button */
.form .modal-footer .btn-primary {
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

.form .modal-footer .btn-danger {
    background: linear-gradient(145deg, #c71f1f, #e04d4d); /* Gradient background for a professional look */
    color: #ffffff; /* Text color */
    padding: 14px 28px; /* Padding for consistency */
    font-size: 14px; /* Font size */
    font-weight: 500; /* Font weight */
    border: none; /* Remove default border */
    border-radius: 5px; /* Slightly rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
}

.form .modal-footer .btn-danger:hover {
    background: linear-gradient(145deg, #e04d4d, #f76c6c); /* Darker gradient on hover */
    transform: translateY(-2px); /* Slight lift effect */
}
/* Input */
.form .modal-body input[type=text]{
 display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Select */
.form .modal-body select{
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
.form .modal-body .dropdown-toggle{
display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Th */
.col-md-12 tr th{
 text-align:center;
}

/* Table Data */
.col-md-12 tr td{
 text-align:center;
}


</style>
<div class="container-fluid">
    <div class="col-md-12">
        <ul class="nav nav-tabs p-b">
            <li class="pull-right p-b">
                <?php if (route(2) == "admins") : ?>
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalDiv" data-action="add_admin">Add New Admin</button>
                <?php endif; ?>
            </li>
        </ul>

        <?php if (route(2) == "admins") : ?>
        <div class="row">
            <center>
                <h3><strong>Super Admin</strong></h3>
            </center>
            <div style="overflow:scroll; height:140px;" class="">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>WhatsApp</th> <!-- New Column -->
                            <th>Google 2FA</th> <!-- New Column -->
                            <th>Email 2FA</th> <!-- New Column -->
                            <th nowrap="">Created At</th>
                            <th nowrap="">Last Login</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admins as $mainadmin): ?>
                        <tr>
                            <td><?php echo $mainadmin["admin_name"] ?></td>
                            <td><?php echo $mainadmin["admin_email"] ?></td>
                            <td><?php echo $mainadmin["username"] ?></td>
                            <td><?php echo $mainadmin["client_type"] == 2 ? "Active"  : "Inactive" ?></td>
                            <td><?php echo $mainadmin["telephone"] ?></td> <!-- Display WhatsApp Number -->
                            <td><?php echo $mainadmin["two_factor"] == 1 ? "Enabled" : "Disabled" ?></td> <!-- Google 2FA Status -->
                            <td><?php echo $mainadmin["email_2fa"] == 1 ? "Enabled" : "Disabled" ?></td> <!-- Email 2FA Status -->
                            <td><?php echo str_replace(["am","pm"],["AM","PM"], date("j M Y, g:i a", strtotime($mainadmin["register_date"]))); ?></td>
                            <td><?php echo str_replace(["am","pm"],["AM","PM"], date("j M Y, g:i a", strtotime($mainadmin["login_date"]))); ?></td>

                            <td class="td-caret">
                                <div class="dropdown pull-right">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown" aria-expanded="true">
                                        Actions <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" data-toggle="modal" data-target="#modalDiv" data-action="edit_admin" data-id="<?php echo $mainadmin["admin_id"] ?>">Edit Account</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <center>
                <h3><strong>Staff</strong></h3>
            </center>
            <div style="overflow:scroll;"><br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>WhatsApp</th> <!-- New Column -->
                            <th>Google 2FA</th> <!-- New Column -->
                            <th>Email 2FA</th> <!-- New Column -->
                            <th nowrap="">Created at</th>
                            <th nowrap="">Last Login</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($staffsData as $staff) : ?>
                        <tr>
                            <td><?php echo $staff["admin_name"] ?></td>
                            <td><?php echo $staff["admin_email"] ?></td>
                            <td><?php echo $staff["username"] ?></td>
                            <td><?php echo $staff["client_type"] == 2 ? "Active"  : "Inactive" ?></td>
                            <td><?php echo $staff["telephone"] ?></td> <!-- Display WhatsApp Number -->
                            <td><?php echo $staff["two_factor"] == 1 ? "Enabled" : "Disabled" ?></td> <!-- Google 2FA Status -->
                            <td><?php echo $staff["email_2fa"] == 1 ? "Enabled" : "Disabled" ?></td> <!-- Email 2FA Status -->
                            <td><?php echo str_replace(["am","pm"],["AM","PM"], date("j M Y, g:i a", strtotime($staff["register_date"]))); ?></td>
                            <td><?php echo str_replace(["am","pm"],["AM","PM"], date("j M Y, g:i a", strtotime($staff["login_date"]))); ?></td>

                            <td class="td-caret">
                                <div class="dropdown pull-right">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                        Actions <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" data-toggle="modal" data-target="#modalDiv" data-action="edit_admin" data-id="<?php echo $staff["admin_id"] ?>">Edit Account</a></li>
                                        <li><a href="/<?= $rentaladmin ?>/manager/admins/delete_staff/<?php echo $staff['admin_id']; ?>">Delete Staff Member</a>
</li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>


<?php require 'footer.php'; ?>

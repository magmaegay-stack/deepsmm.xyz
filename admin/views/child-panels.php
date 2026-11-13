<style>
  /* General Styling */
  body {
    font-family: 'Inter', sans-serif;
    background-color: #f7f9fc;
    color: #333333;
  }

  /* Table Styling */
  .table-responsive {
    margin-top: 20px;
    overflow-x: auto;
  }

  

  /* Status and Action Styling */
  .btn-default {
    background-color: #f0f0f0;
    color: #333;
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 5px 10px;
  }

  .dropdown-menu {
    min-width: 150px;
    font-size: 0.9em;
  }

  .dropdown-menu a {
    color: #333;
    text-decoration: none;
  }

  .dropdown-menu a:hover {
    background-color: #f0f0f0;
  }
  /* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Division */
.container-fluid .row div{
 font-family:'Inter', sans-serif;
 text-transform:capitalize;
 text-align:center;
}

/* Th */
#dt tr th{
 text-align:center;
 text-transform:uppercase;
}
#dt{
    border-radius: 8px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
}
#dt thead{
    border: 1px solid #ddd;
    background: #f8f8f8;
    border-radius: 3px;
    position: relative;
}
/* Th */
#dt tr th{
 font-weight:600;
 font-size:14px;
}

/* Table */
#dt{
 font-size:14px;
}
/* Division */
.container-fluid .row > div{
 padding-left:15px;
 padding-right:15px;
}

/* Button */
#dt tr .btn-xs-caret{
 background-color: #f0f0f0;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
}
/* Table Data */
#dt tr td{
 text-align:center;
 text-transform:none;
}
/* Heading */
center h2{
 font-size:24px;
 font-weight:700;
}






</style>


<?php include 'header.php'; ?>
<center><h2>Child Panels</h2></center>
<div class="container-fluid">
    
  <div class="row">    
   <div style="overflow-x:scroll;">
  
    <table  class="table table-responsive" id="dt">
<thead>
    <tr>

<th>User</th>
<th>Domain</th>
<th>Created At</th>
<th>Renewal</th>
<th>Currency</th>
<th>Username</th>
<th>Password</th>
<th>Status</th>
<th>Actions</th>
</tr>
</thead>
    <tbody>
<?php foreach($payments as $payment): ?>
<tr>
    
    <td><?php echo $payment["username"] ?></td>
    <td><?php echo $payment["domain"] ?></td>
    <td><?php echo str_replace(["am","pm"],["AM","PM"], date("j M Y, g:i a", strtotime($payment["created_on"]))); ?></td>
    <td><?php echo str_replace(["am","pm"],["AM","PM"], date("j M Y, g:i a", strtotime($payment["renewal_date"]))); ?></td>
 <td><?php echo $payment["child_panel_currency"]; ?></td>
 <td><?php echo $payment["child_panel_username"]; ?></td>
  <td><?php echo $payment["child_panel_password"]; ?></td>
    <td><?php echo $payment["child_panel_status"]; ?></td>
    <td>

<div class="dropdown pull-right">
<button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Actions <span class="caret"></span></button>
<ul class="dropdown-menu">
<li>
<a href="<?php echo site_url("$rentaladmin/child-panels/".$payment["id"]."/activate");?>">Status To Active</a>
<a href="<?php echo site_url("$rentaladmin/child-panels/".$payment["id"]."/suspend");?>">Status to Suspended</a>
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
</div>


<?php include 'footer.php'; ?>

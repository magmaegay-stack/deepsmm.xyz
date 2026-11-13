<?php include 'header.php'; ?>
<style>
/* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");
/* General Styles */
html, body {
    font-family: 'Inter', sans-serif;
    background-color: #f9fafb;
    color: #343a40;
}
.table-responsive {
    border-radius: 8px;
}

.table {
    background-color: #ffffff;
    color: #495057;
}

.table th, .table td {
    padding: 12px;
    vertical-align: middle;
    border-top: 1px solid #dee2e6;
}

.table thead th {
    background-color: #f1f3f5;
    font-weight: 600;
    color: #495057;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f8f9fa;
}

.table-hover tbody tr:hover {
    background-color: #e9ecef;
}
.panel {
    background-color: #ffffff;
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.panel-heading {
    background-color: #007bff;
    color: #ffffff;
    font-weight: 600;
    font-size: 18px;
    padding: 15px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.panel-body {
    padding: 20px;
}
/* Link */
.table-striped td a{
 color:#c0392b;
}
/* Action list */
.checkAll-th .action-block .action-list{
 top:1px;
 height:23px;
}

/* Button */
.action-list li .btn-xs-caret{
 border-style:solid;
 border-width:0px;
 background-color:rgba(255,255,255,0);
}

/* Action list */
.container-fluid .row .col-lg-12 .panel .panel-body .table-responsive .table-striped thead tr .checkAll-th .action-block .action-list{
 border-width:1px !important;
}

/* Button */
.container-fluid .row .col-lg-12 .panel .panel-body .table-responsive .table-striped thead tr .checkAll-th .action-block .action-list li .dropdown .btn-xs-caret{
 border-left-width:1px !important;
}

/* Panel heading */
.col-lg-12 .panel .panel-heading{
 text-transform:uppercase;
 text-align:center;
}

/* Th */
.table-striped tr th{
 text-transform:uppercase;
 text-align:center;
}

/* Table Data */
.table-striped tr td{
 text-align:center;
}
/* List Item */
.action-block .action-list > li{
 text-transform:capitalize;
}
.btn-primary {
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

.btn-primary:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}

.btn-danger {
    background: linear-gradient(145deg, #dc3545, #c82333);
    color: #ffffff;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
}

.btn-danger:hover {
    background: linear-gradient(145deg, #c82333, #bd2130);
    transform: translateY(-2px);
}



</style><style>
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
<div class="container-fluid">
<ul class="log-menu">
   <li>
     <a href="<?php echo site_url("$rentaladmin/logs") ?>">User Logs</a>



   </li>
   <li class="active">
     <a href="<?php echo site_url("$rentaladmin/synced_logs") ?>">API Updates</a>
   </li>
   <li>
      <a href="<?php echo site_url("$rentaladmin/updates") ?>">Service Updates</a>
   </li>
</ul>
  <br>
  

   <div class="row">
      <div class="col-lg-12">
         <div class="panel panel-default">
            <div class="panel-heading">
              Services Synced Logs
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead>
                        <tr>
                          <th class="checkAll-th">
  <div class="checkAll-holder">
     <input type="checkbox" id="checkAll">
     <input type="hidden" id="checkAllText" value="order">
  </div>
  <div class="action-block">
     <ul class="action-list" style="margin:5px 0 0 0!important">
        <li><span class="countlogs"></span> Selected Logs</li>
        <li>
           <div class="dropdown">
              <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown"> Batch Operations <span class="caret"></span></button>
              <ul class="dropdown-menu">
                 <li>
                   <a class="bulkorder" data-type="delete">Delete</a>
                 </li>
              </ul>
           </div>
        </li>
     </ul>
  </div>
                          </th>
<th>API Name</th>
<th>Service Name</th>
<th>Changes</th>
<th>Action</th>
<th>Date & Time</th>
<th>Action</th>
</tr>
</thead>
<form id="changebulkForm" action="<?php echo site_url("$rentaladmin/synced_logs/multi-action") ?>" method="post">
<tbody>
<?php if( !$logs ): ?>
<tr>
  <td colspan="7"><center>No logs found</center></td>
</tr>
                         <?php endif; ?>
<?php foreach($logs as $log): ?>
<tr>
 <td><input type="checkbox" class="selectOrder" name="log[<?php echo $log["id"] ?>]" value="1"></td>
 
  <td><?php echo GET_API_NAME_BY_ID($log["api_id"]); ?></td>

<td><span class="label-id"><?php echo $log["service_id"] ?></span> <?php echo GET_SERVICE_NAME_BY_ID($log["service_id"]); ?></td>
<td><?php echo $log["description"] ?></td>
<td><?php echo $log["action"] ?></td>


<td>
     <?php 
        echo str_replace(["am", "pm"], ["AM", "PM"], date('j M Y, g:i a', strtotime($log["date"])));
    ?>
</td>

  <td> <a href="<?php echo site_url("$rentaladmin/synced_logs/delete/".$log["id"]) ?>" style="font-size:12px">Delete</a> </td>
                          </tr>
                        <?php endforeach; ?>
                       </tbody>
                       <input type="hidden" name="bulkStatus" id="bulkStatus" value="0">
                     </form>
                  </table>
               </div>
            </div>
         </div>
         <?php if( $paginationArr["count"] > 1 ): ?>
           <div class="row">
              <div class="col-sm-8">
                 <nav>
                    <ul class="pagination">
                      <?php if( $paginationArr["current"] != 1 ): ?>
                       <li class="prev"><a href="<?php echo site_url("$rentaladmin/synced_logs/1/".$search_link) ?>">&laquo;</a></li>
                       <li class="prev"><a href="<?php echo site_url("$rentaladmin/synced_logs/".$paginationArr["previous"]."/".$search_link) ?>">&lsaquo;</a></li>
                       <?php
endif;
for ($page=1; $page<=$pageCount; $page++):
  if( $page >= ($paginationArr['current']-9) and $page <= ($paginationArr['current']+9) ):
                       ?>
                       <li class="<?php if( $page == $paginationArr["current"] ): echo "active"; endif; ?> "><a href="<?php echo site_url("$rentaladmin/synced_logs/".$page."/".$status.$search_link) ?>"><?=$page?></a></li>
                       <?php endif; endfor;
  if( $paginationArr["current"] != $paginationArr["count"] ):
                       ?>
                       <li class="next"><a href="<?php echo site_url("$rentaladmin/synced_logs/".$paginationArr["next"]."/".$search_link) ?>" data-page="1">&rsaquo;</a></li>
                       <li class="next"><a href="<?php echo site_url("$rentaladmin/synced_logs/".$paginationArr["count"]."/".$search_link) ?>" data-page="1">&raquo;</a></li>
                       <?php endif; ?>
                    </ul>
                 </nav>
              </div>
           </div>
         <?php endif; ?>
      </div>
   </div>
</div>

<div class="modal modal-center fade" id="confirmChange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
   <div class="modal-dialog modal-dialog-center" role="document">
      <div class="modal-content">
         <div class="modal-body text-center">
            <h4>Are you sure you want to take action ?</h4>
            <div align="center">
               <a class="btn btn-primary" href="" id="confirmYes">Yes</a>
               <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include 'footer.php'; ?>

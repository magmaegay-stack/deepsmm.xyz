<?php include 'header.php'; ?>

<style>
    body {
        background-color: #f9f9f9;
        font-family: 'Inter', sans-serif;
        color: #333;
    }

    .nav-tabs .btn-primary {
        background: linear-gradient(145deg, #007bff, #0056b3);
        color: #fff;
        font-weight: 500;
        border: none;
        border-radius: 6px;
    }

   

    .btn-outline-secondary {
        border-color: #007bff;
        color: #007bff;
    }
    
    .btn-outline-secondary:hover {
        background-color: #007bff;
        color: #fff;
    }

    .card {
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .table {
       border-radius: 8px !important;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
}

    .table th {
        background-color: #f1f1f1;
        color: #333;
        padding: 14px;
        font-weight: 600;
    }

    .table td {
        padding: 12px;
        color: #555;
        vertical-align: middle;
    }

    .table tbody tr .dropdown-toggle{
        background-color: #f0f0f0;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
  }
/* Button */
.dropdown-th .dropdown .btn-th{
  font-weight: 600;
    text-transform: uppercase;
    background-color: #f0f0f0;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
}


    .pagination .page-item.active .page-link {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .modal-center .modal-content {
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .modal-body h4 {
        color: #333;
        font-weight: 600;
    }

    .btn-primary {
        background: linear-gradient(145deg, #007bff, #0056b3);
    }
/* Button */
.input-group .search-select-wrap .btn-primary{
 background-image:none;
 color:#5a5a5a;
 border-style:solid;
 border-width:1px;
 border-color:#cccccc;
}

/* Custom search */
.container-fluid .nav-tabs .custom-search{
 right:auto !important;
 left:10px;
}

/* Button */
.nav-tabs .export-li a{
 left:20px;
}

/* Th */
.table-striped tr th{
 text-transform:uppercase;
 text-align:center;
}

/* Table Data */
.table-striped tr td{
 text-transform:none;
 text-align:center;
}
/* Th */
.table thead .p-l{
 text-transform:uppercase;
 text-align:center;
}

/* Th */
.table tr th{
 text-transform:uppercase;
 text-align:center;
}

/* Button */
.dropdown-th .dropdown .btn-th{
 background-image:none;
 font-weight:600;
 color:#5a5a5a;
}

/* Subject */
.table tr .subject{
 text-align:center;
}

/* Table Data */
.table tr td{
 text-align:center;
}

/* Button */
.container-fluid .p-b .btn{
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

.container-fluid .p-b .btn:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Link */
.dropdown-th .active a{
 color:#ffffff !important;
 text-transform:capitalize;
}

/* Link */
.dropdown-th li a{
 text-transform:capitalize;
}

/* List Item */
.action-block .action-list > li{
 text-transform:capitalize;
}

/* Button */
.action-list li .dropdown-toggle{
 text-transform:capitalize;
}

/* Button */
.dropdown-th .dropdown .btn-th{
 text-transform:uppercase;
}

@media (max-width:767px){

 /* Custom search */
 .container-fluid .nav-tabs .custom-search{
  right:0px !important;
  left:0px !important;
 }
 
 /* Link */
 .container-fluid .nav-tabs .export-li a{
  left:0px !important;
 }
 
}
/* Modal title */
#modalTitle{
 text-transform:capitalize;
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
/* Text Area */
.form .modal-body textarea{

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
/* Body Of Table */
.dof-inherit .table tbody{
 border-top-left-radius:8px;
 border-top-right-radius:8px;
 border-bottom-left-radius:8px;
 border-bottom-right-radius:8px;
}
.table td:nth-child(4){
 text-transform:capitalize;
}
/* Button */
.dropdown-th .dropdown .btn-th{
 font-size:14px;
 color:#333333 !important;
}

/* Th */
.table tr th{
 color:#333333;
}

/* Link */
.dropdown-th .active a{
 background-image:none;
 color:#5a5a5a;
}

/* Link */
.row-xs .col .card .dof-inherit .container-fluid .table thead tr .dropdown-th .dropdown .dropdown-menu li a{
 color:#5a5a5a !important;
}

.dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover{
    background:none !important;
}
/* Link */
.table thead tr .dropdown-th .dropdown .dropdown-menu .active a{
 background-color:#ffffff !important;
}

/* Link */
.dropdown-th li a{
 background-color:#ffffff;
}


 /* List */
 .dropdown-th .dropdown ul{
  position:absolute !important;
 }
 /* Dropdown menu */
 .table tbody .dropdown-menu{
  position:absolute !important;
  text-transform:capitalize;
 } 
/* Input */
.form-inline .input-group input[type=text]{
  background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;

    border-top-left-radius:0px;
 border-bottom-left-radius:0px;

}

/* Select */
.input-group .search-select-wrap select{
  background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;

    border-top-left-radius:0px;
 border-bottom-left-radius:0px;

}

/* Button */
.input-group .search-select-wrap .btn{
  background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;

    border-top-left-radius:0px;
 border-bottom-left-radius:0px;

}
/* Input */
.form-inline .input-group input[type=text]{
 border-top-left-radius:8px !important;
 border-bottom-left-radius:8px !important;
 border-top-right-radius:0px !important;
 border-bottom-right-radius:0px !important;
}
.search-select-wrap:before{
    display:none !important;
}
/* Select */
.input-group .search-select-wrap select{
 text-align:center;
}

/* Link */
.container-fluid .nav-tabs a{
 top:10px;
}


@media (max-width:767px){

 /* Table */
 .container-fluid .row-xs .col .card .dof-inherit .container-fluid .table{
  left:-20px !important;
 }
 
}
/* Table Data */
.table tr td:nth-child(5){
 text-transform:capitalize;
}
.btn-primary{
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
.btn-danger{
  background: linear-gradient(145deg, #c71f1f, #e04d4d); /* Gradient background for a professional look */
  color: #ffffff; /* Text color */
   padding: 14px 28px;
  font-size: 14px; /* Font size */
  font-weight: 500; /* Font weight */
  border: none; /* Remove default border */
  border-radius: 5px; /* Slightly rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0,danger 0.3); /* Subtle shadow for depth */
  transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
}
.btn-danger:hover {
  background: linear-gradient(145deg, #e04d4d, #f76c6c); /* Darker gradient on hover */
  transform: translateY(-2px); /* Slight lift effect */
}
@media (max-width:767px){

 /* Card */
 .row-xs .card{
  padding-left:15px;
  padding-right:15px;
 }
 
}
.export .export-title{
 color:#5a5a5a !important;
}
</style>

<div class="container-fluid">
   <ul class="nav nav-tabs">
      <li class="p-b"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalDiv" data-action="new_ticket">New Ticket</button></li>
      <li class="pull-right custom-search">
         <form class="form-inline" action="" method="get">
            <div class="input-group">
               <input type="text" name="search" class="form-control" value="<?=$search_word?>" placeholder="Search">
               <span class="input-group-btn search-select-wrap">
                  <select class="form-control search-select" name="search_type">
                     <option value="subject" <?php if( $search_where == "subject" ): echo 'selected'; endif; ?> >Subject</option>
                     <option value="client" <?php if( $search_where == "client" ): echo 'selected'; endif; ?> >Username</option>
                  </select>
                  <button type="submit" class="btn btn-default"><span class="fa fa-search" aria-hidden="true"></span></button>
               </span>
            </div>
         </form>
      </li>
       <li class="pull-right export-li">
          <?php if($_GET["search"] == 'unread'){ ?>
         <a href="<?=site_url("$rentaladmin/tickets")?>" class="export">
         <span class="export-title">Show All</span>
         </a>
         <?php }else{ ?>
                      <a href="<?=site_url("$rentaladmin/tickets")?>?search=unread" class="export">
         <span class="export-title">Show Unread</span>
         </a>
             
        <?php } ?>
      </li>
   </ul>
<div class="row row-xs">

            <div class="col">
                <div class="card dwd-100">
                    <div class="card-body pd-20 table-responsive dof-inherit">
                        <div class="container-fluid pd-t-20 pd-b-20">
                            <ul class="nav nav-tabs pull-right dborder-0">
                                <li class="pull-right export-li">
                                    
                                </li>
                            </ul>
   <table class="table">
      <thead>
         <tr>
             <th class="checkAll-th">
               <div class="checkAll-holder">
                  <input type="checkbox" id="checkAll">
                  <input type="hidden" id="checkAllText" value="order">
               </div>
               <div class="action-block">
                  <ul class="action-list">
                     <li><span class="countOrders"></span> Tickets selected</li>
                     <li>
                        <div class="dropdown">
                           <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown"> Bulk Actions <span class="caret"></span></button>
                           <ul class="dropdown-menu">
                              <li>
                                 <a class="bulkorder" data-type="unread">Mark as unread</a>
                                 <a class="bulkorder" data-type="lock">Lock</a>
                                 <a class="bulkorder" data-type="unlock">Unlock</a>
                                 <a class="bulkorder" data-type="close">Close</a>
                                 <a class="bulkorder" data-type="pending">Mark as awaiting answer</a>
                                 <a class="bulkorder" data-type="answered">Mark as answered</a>
<a class="bulkorder" data-type="delete">Delete Selected</a>
                              </li>
                           </ul>
                        </div>
                     </li>
                  </ul>
               </div>
            </th>
            <th width="5%" class="p-l">ID</th>
            <th width="15%">Member</th>
            <th width="50%">Subject</th>
            <th width="10%" class="dropdown-th">
               <div class="dropdown">
                  <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Status <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                     <li class="active"><a href="<?=site_url("$rentaladmin/tickets")?>">All (<?=countRow(["table"=>"tickets"]);?>)</a></li>
                     <li><a href="<?=site_url("$rentaladmin/tickets")?>?status=pending">Pending (<?=countRow(["table"=>"tickets","where"=>["status"=>"pending"]]);?>)</a></li>
                     <li><a href="<?=site_url("$rentaladmin/tickets")?>?status=answered">Answered (<?=countRow(["table"=>"tickets","where"=>["status"=>"answered"]]);?>)</a></li>
                     <li><a href="<?=site_url("$rentaladmin/tickets")?>?status=closed">Closed (<?=countRow(["table"=>"tickets","where"=>["status"=>"closed"]]);?>)</a></li>
                  </ul>
               </div>
            </th>
            <th width="10%">Creation Date</th>
            <th width="10%" nowrap="">Last Updated</th>
            <th></th>
         </tr>
      </thead>
      <form id="changebulkForm" action="<?php echo site_url("$rentaladmin/tickets/multi-action") ?>" method="post">
        <tbody>
          <?php foreach($tickets as $ticket ): ?>
              <tr>
                 <td><input type="checkbox" class="selectOrder" name="ticket[<?php echo $ticket["ticket_id"] ?>]" value="1" style="border:1px solid #fff"></td>
                 
                 <td class="p-l"><?php echo $ticket["ticket_id"] ?></td>
                 <td><?php echo $ticket["username"] ?></td>
                 <td class="subject"><?php  if( $ticket["canmessage"] == 1 ): echo '<i class="fa fa-lock"></i> '; endif;  ?><a href="<?=site_url("$rentaladmin/tickets/read/".$ticket["ticket_id"])?>"><?php if( $ticket["client_new"] == 2 ): echo "<b>".$ticket["subject"]."</b>"; else: echo $ticket["subject"]; endif; ?></a></td>
                 <td><?php echo $ticket["status"] ?></td>
                 <td nowrap="">  <?php 
        echo str_replace(["am", "pm"], ["AM", "PM"], date('j M Y, g:i a', strtotime($ticket["time"])));
    ?></td>
                 <td nowrap="">  <?php 
        echo str_replace(["am", "pm"], ["AM", "PM"], date('j M Y, g:i a', strtotime($ticket["lastupdate_time"])));
    ?></td>
                 <td class="service-block__action">
                   <div class="dropdown pull-right">
                     <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Options <span class="caret"></span></button>
                     <ul class="dropdown-menu">
                       <?php if( $ticket["client_new"] == 1 ): ?>
                         <li><a href="<?php echo site_url("$rentaladmin/tickets/unread/".$ticket["ticket_id"]) ?>">Mark as unread</a></li>
                       <?php endif; if( $ticket["canmessage"] == 2 ): ?>
                         <li><a href="<?php echo site_url("$rentaladmin/tickets/lock/".$ticket["ticket_id"]) ?>">Lock support request</a></li>
                       <?php else: ?>
                         <li><a href="<?php echo site_url("$rentaladmin/tickets/unlock/".$ticket["ticket_id"]) ?>">Unlock support request</a></li>
                       <?php endif; if( $ticket["status"] != "closed" ): ?>
                         <li><a href="<?php echo site_url("$rentaladmin/tickets/close/".$ticket["ticket_id"]) ?>">Close support request</a></li>
                       <?php endif; ?>
<li><a href="<?php echo site_url("$rentaladmin/tickets/delete/".$ticket["ticket_id"]) ?>">Delete</a></li>
                     </ul>
                   </div>
                 </td>
              </tr>
            <?php endforeach; ?>
        </tbody>
        <input type="hidden" name="bulkStatus" id="bulkStatus" value="0">
      </form>
   </table>
   <?php if( $paginationArr["count"] > 1 ): ?>
     <div class="row">
        <div class="col-sm-8">
           <nav>
              <ul class="pagination">
                <?php if( $paginationArr["current"] != 1 ): ?>
                 <li class="prev"><a href="<?php echo site_url("$rentaladmin/tickets/1".$search_link) ?>">&laquo;</a></li>
                 <li class="prev"><a href="<?php echo site_url("$rentaladmin/tickets/".$paginationArr["previous"].$search_link) ?>">&lsaquo;</a></li>
                 <?php
                     endif;
                     for ($page=1; $page<=$pageCount; $page++):
                       if( $page >= ($paginationArr['current']-9) and $page <= ($paginationArr['current']+9) ):
                 ?>
                 <li class="<?php if( $page == $paginationArr["current"] ): echo "active"; endif; ?> "><a href="<?php echo site_url("$rentaladmin/tickets/".$page.$search_link) ?>"><?=$page?></a></li>
                 <?php endif; endfor;
                       if( $paginationArr["current"] != $paginationArr["count"] ):
                 ?>
                 <li class="next"><a href="<?php echo site_url("$rentaladmin/tickets/".$paginationArr["next"].$search_link) ?>" data-page="1">&rsaquo;</a></li>
                 <li class="next"><a href="<?php echo site_url("$rentaladmin/tickets/".$paginationArr["count"].$search_link) ?>" data-page="1">&raquo;</a></li>
                 <?php endif; ?>
              </ul>
           </nav>
        </div>
     </div>
   <?php endif; ?>
</div>
<div class="modal modal-center fade" id="confirmChange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
   <div class="modal-dialog modal-dialog-center" role="document">
      <div class="modal-content">
         <div class="modal-body text-center">
            <h4>Are you sure you want to update the status ?</h4>
            <div align="center">
               <a class="btn btn-primary" href="" id="confirmYes">Yes</a>
               <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
         </div>
      </div>
   </div>
</div>

<?php include 'footer.php'; ?>
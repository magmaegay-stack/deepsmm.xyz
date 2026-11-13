<?php include 'header.php'; ?>
<style>
/* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Button */
.input-group .search-select-wrap .btn-primary{
 background-color:rgba(255,255,255,0);
 color:#5a5a5a;
 border-style:solid;
 border-width:1px;
 border-color:#ccc;
}

/* Menu */
.container-fluid .nav-tabs{
 font-family:'Inter', sans-serif;
}

/* Body */
body{
 font-family:'Inter', sans-serif;
}

/* Th */
.table-striped tr th{
 text-transform:uppercase;
 text-align:center;
}

.table-striped tr td{
 text-align:center;
}



pre{
 display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
.table-responsive{
    border-radius: 8px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
}
/* Th */
.table-striped tr th{
 border-right-style:none !important;
 border-left-style:none !important;
}

/* Table Data */
.table-striped tr td{
 border-style:none !important;
 background-color:#ffffff;
}

/* Button */
.table-striped tr .btn-sm{
  background-color: #f0f0f0 !important;
    color: #333333 !important;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
  }
.btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover, .btn-primary:active.focus, .btn-primary:active:focus, .btn-primary:active:hover, .open>.dropdown-toggle.btn-primary.focus, .open>.dropdown-toggle.btn-primary:focus, .open>.dropdown-toggle.btn-primary:hover{
    border-color:#ccc !important;
}
/* Table Row */
.table-striped .table-light tr{
 background-color:#f8f8f8;
}

/* Table light */
.card-body .table-striped .table-light{
 background-color:#f8f8f8;
}

/* Dropdown menu */
.table-striped tr .dropdown-menu{
 left:-107px;
}
/* Table Data */
.container-fluid .card .card-body .table-striped tbody tr td{
 border-bottom-style:solid !important;
}

@media (max-width:500px){

 /* Dropdown menu */
 .table-striped tr .dropdown-menu{
  left:-60px !important;
 }
 
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
.input-group .search-select-wrap .btn-primary{
 background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;

    border-top-left-radius:0px;
 border-bottom-left-radius:0px;

}

.search-select-wrap:before{
    display:none!important;
}
/* Select */
.input-group .search-select-wrap select{
 text-align:center;
}

/* Input */
.form-inline .input-group input[type=text]{
 border-top-left-radius:8px !important;
 border-bottom-left-radius:8px !important;
 border-top-right-radius:0px !important;
 border-bottom-right-radius:0px !important;
}




</style>

<div class="container-fluid">
    <?php if( $success ): ?>
        <div class="alert alert-success "><?php echo $successText; ?></div>
    <?php endif; ?>
    <?php if( $error ): ?>
        <div class="alert alert-danger "><?php echo $errorText; ?></div>
    <?php endif; ?>

    <ul class="nav nav-tabs p-b">
        <li class="ml-auto custom-search">
            <form class="form-inline" action="<?=site_url("$rentaladmin/tasks")?>" method="get">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" value="<?=$search_word?>" placeholder="Search">
                    <span class="input-group-btn search-select-wrap">
                        <select class="form-control search-select" name="search_type">
                            <option value="order_id" <?php if( $search_where == "order_id" ): echo 'selected'; endif; ?>>Order ID</option>
                        </select>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-search" aria-hidden="true"></span></button>
                    </span>
                </div>
            </form>
        </li>
    </ul>

    <div class="card shadow-sm mt-4">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Task ID</th>
                        <th>Order ID</th>
                        <th>Username</th>
                        <th>Service</th>
                        <th>Link</th>
                        <th>Beginning</th>
                        <th>Quantity</th>
                        <th>Request</th>
                        <th>Task Status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <form id="changebulkForm" action="<?php echo site_url("$rentaladmin/tasks/multi-action") ?>" method="post">
                    <tbody>
                        <?php foreach( $orders as $order ): ?>
                            <tr>
                                <td><?=$order["task_id"]?></td>
                                <td><?php echo $order["order_id"] ?></td>
                                <td><?php echo $order["username"]; ?></td>
                                 <td width="30%"><span class="label-id"><?php echo $order["service_id"]; ?></span><?php echo $order["service_name"]; ?></td>
                
                                <td><?php echo $order["order_url"]; ?></td>
                                <td><?php echo $order["order_start"]; ?></td>
                                <td><?php echo $order["order_quantity"]; ?></td>
                                <td>
                                    <?php if($order["task_type"] == 1): ?>
                                        <span class="badge bg-success">REFILL</span>
                                    <?php elseif($order["task_type"] == 2): ?>
                                        <span class="badge bg-danger">CANCEL</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($order["task_status"] == "failed"): ?>
                                        Failed
                                    <?php elseif($order["task_status"] == "inprogress"): ?>
                                        In Progress
                                    <?php elseif($order["task_status"] == "rejected"): ?>
                                        Rejected
                                    <?php elseif($order["task_status"] == "completed"): ?>
                                        Completed
                                    <?php elseif($order["task_status"] == "canceled"): ?>
                                        Cancelled
                                    <?php endif; ?>
                                </td>
                                <td>
    <?php 
        echo str_replace(["am", "pm"], ["AM", "PM"], date('j M Y, g:i a', strtotime($order["task_created_at"])));
    ?>
</td>
<td>
    <?php 
        echo str_replace(["am", "pm"], ["AM", "PM"], date('j M Y, g:i a', strtotime($order["task_updated_at"])));
    ?>
</td>

                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                            Actions <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php if($order["task_type"] == 2 ): ?>
                                                <li><a href="<?=site_url("$rentaladmin/tasks/cancel_order/".$order["task_id"])?>">Cancel & Refund</a></li>
                                            <?php endif; ?>
                                            <?php if($order["task_type"] == 1 && $order["check_refill_status"] != 1): ?>
                                                <li><a href="<?=site_url("$rentaladmin/tasks/update_refill_status/".$order["refill_orderid"])?>">Update Refill Status</a></li>
                                            <?php endif; ?>
                                            <li><a href="#" class="check_seller_last_response" data-toggle="modal" data-action="task_id=<?=$order["task_id"]?>" data-target="#flipFlop">Seller Last Response</a></li>
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

    <?php if( $paginationArr["count"] > 1 ): ?>
        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <?php if( $paginationArr["current"] != 1 ): ?>
                    <li class="page-item"><a class="page-link" href="<?php echo site_url("$rentaladmin/tasks/1/".$status.$search_link) ?>">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="<?php echo site_url("$rentaladmin/tasks/".$paginationArr["previous"]."/".$status.$search_link) ?>">&lsaquo;</a></li>
                <?php endif; ?>
                <?php for ($page=1; $page<=$pageCount; $page++): ?>
                    <?php if( $page >= ($paginationArr['current']-2) && $page <= ($paginationArr['current']+2) ): ?>
                        <li class="page-item <?php if($page == $paginationArr["current"]) echo "active"; ?>">
                            <a class="page-link" href="<?php echo site_url("$rentaladmin/tasks/".$page."/".$status.$search_link) ?>"><?=$page?></a>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>
                <?php if( $paginationArr["current"] != $paginationArr["count"] ): ?>
                    <li class="page-item"><a class="page-link" href="<?php echo site_url("$rentaladmin/tasks/".$paginationArr["next"]."/".$status.$search_link) ?>">&rsaquo;</a></li>
                    <li class="page-item"><a class="page-link" href="<?php echo site_url("$rentaladmin/tasks/".$paginationArr["count"]."/".$status.$search_link) ?>">&raquo;</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalLabel">Provider's Last Response</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Response content here -->
            </div>
           
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

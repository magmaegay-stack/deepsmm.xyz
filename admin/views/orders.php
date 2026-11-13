<?php include 'header.php'; ?>
<style>
     .orders-table {
     overflow-y:scroll;
     width:100%;
 }
 /* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Body */
body{
 font-family:'Inter', sans-serif;
}
/* Th */
#dt tr th{
 text-transform:uppercase;
 text-align:left;
}

/* List Item */
.action-block .action-list > li{
 text-transform:capitalize;
}

.table{
    border-radius: 8px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow-x: auto; /* Allows horizontal scrolling on small screens */
  }
/* Link */
.nav-tabs li a{
 color:#5a5a5a !important;
}

/* Button */
#serviceList{
 text-transform:uppercase;
}

/* Service list content */
#serviceListContent{
 text-transform:none;
 transform:translatex(0px) translatey(0px);
 overflow:auto !important;
}

/* Link */
#serviceListContent .active a{
 color:#ffffff !important;
}

/* Button */
#dt tr .btn-th{
 text-transform:uppercase;
}

/* Link */
#dt .active a{
 color:#ffffff !important;
}

/* Dropdown menu */
#dt .dropdown-th .dropdown-menu{
 text-transform:none;
}


.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control{
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
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
.modal-content{
     font-family:'Inter', sans-serif;
          
           
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
.search-select-wrap:before{
    display:none !important;
}

/* Dropdown toggle */
.nav-tabs .dropdown .dropdown-toggle{
    background: linear-gradient(145deg, #007bff, #0056b3); /* Light gradient */
    color: #ffffff !important;
    padding: 14px 28px;
     text-align:center;
    font-size: 14px;
    height:unset !important;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
}
.nav-tabs .dropdown-menu{
    width:100%;
    
}
.dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover{
    color:#ffffff !important;
}
#dt .active a{
   
   
    background: linear-gradient(145deg, #0069d9, #0056b3);
}
/* Button */
#dt tbody .dropdown-toggle{
  background-color: #f0f0f0 !important;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
  }
.dropdown-submenu>a:after{
    display:none !important;
}
/* Button */
#serviceList{
  font-weight:600;
 text-transform:uppercase;
  background-color: #f0f0f0;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
   
  }

/* Button */
#dt tr .btn-th{
  font-weight:600;
 text-transform:uppercase;
  background-color: #f0f0f0;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
   
  }

.orders-table{
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
 text-align:center !important;
}

/* Table Data */
#dt tr td{
 text-align:center;
}
.form-control{
    background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
/* Select */
.input-group .search-select-wrap select{
 border-top-left-radius:0px;
 border-bottom-left-radius:0px;
}
.input-group-btn:last-child>.btn, .input-group-btn:last-child>.btn-group{
    background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;

    border-top-left-radius:0px;
 border-bottom-left-radius:0px;

}
/* Action list */
.checkAll-th .action-block .action-list{
 top:-1px;
}

/* Button */
.modal-body div .btn:nth-child(2){
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

.modal-body div .btn:nth-child(2):hover {
  background: linear-gradient(145deg, #e04d4d, #f76c6c); /* Darker gradient on hover */
  transform: translateY(-2px); /* Slight lift effect */
}
/* Button */
#dt .service-block__service .btn-xs{
background-color: #f0f0f0 !important;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
    position:relative;
 left:10px;
}
 .nav-tabs .dropdown .dropdown-toggle:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}

/* Table Data */
#dt tbody .p-l{
 text-align:left;
}

/* Th */
.container-fluid .orders-table #dt thead tr th{
 text-align:left !important;
}

/* Table Data */
#dt tr td{
 text-align:left !important;
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
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            Order Status <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li class="<?php if ($status == "all") echo "active"; ?>">
                <a href="<?= site_url("$rentaladmin/orders") ?>">All Orders 
                    <span class="badge" style="background-color: #808080"><?= countRow(["table" => "orders"]) ?></span>
                </a>
            </li>
            <li class="<?php if ($status == "cronpending") echo "active"; ?>">
                <a href="<?= site_url("$rentaladmin/orders/1/cronpending") ?>">Awaiting 
                    <span class="badge" style="background-color: #808080"><?= $cronpendingcount ?? 0 ?></span>
                </a>
            </li>
            <li class="<?php if ($status == "pending") echo "active"; ?>">
                <a href="<?= site_url("$rentaladmin/orders/1/pending") ?>">Pending 
                    <span class="badge" style="background-color: #808080"><?= $pendingcount ?? 0 ?></span>
                </a>
            </li>
            <li class="<?php if ($status == "processing") echo "active"; ?>">
                <a href="<?= site_url("$rentaladmin/orders/1/processing") ?>">Processing 
                    <span class="badge" style="background-color: #808080"><?= $processingcount ?? 0 ?></span>
                </a>
            </li>
            <li class="<?php if ($status == "inprogress") echo "active"; ?>">
                <a href="<?= site_url("$rentaladmin/orders/1/inprogress") ?>">Inprogress 
                    <span class="badge" style="background-color: #808080"><?= $inprogresscount ?? 0 ?></span>
                </a>
            </li>
            <li class="<?php if ($status == "completed") echo "active"; ?>">
                <a href="<?= site_url("$rentaladmin/orders/1/completed") ?>">Completed 
                    <span class="badge" style="background-color: #808080"><?= $completedcount ?? 0 ?></span>
                </a>
            </li>
            <li class="<?php if ($status == "partial") echo "active"; ?>">
                <a href="<?= site_url("$rentaladmin/orders/1/partial") ?>">Partial 
                    <span class="badge" style="background-color: #808080"><?= $partialcount ?? 0 ?></span>
                </a>
            </li>
            <li class="<?php if ($status == "canceled") echo "active"; ?>">
                <a href="<?= site_url("$rentaladmin/orders/1/canceled") ?>">Cancelled 
                    <span class="badge" style="background-color: #808080"><?= $canceledcount ?? 0 ?></span>
                </a>
            </li>
            <li class="<?php if ($status == "fail") echo "active"; ?>">
                <a href="<?= site_url("$rentaladmin/orders/1/fail") ?>">Fail 
                    <span class="badge" style="background-color: #8b3a3a"><?= $failCount ?? 0 ?></span>
                </a>
            </li>
        </ul>
    </li>


      <li class="pull-right custom-search">
   <form class="form-inline" action="<?=site_url("$rentaladmin/orders")?>" method="get">
      <div class="input-group">
         <input type="text" name="search" class="form-control" value="<?=$search_word?>" placeholder="Search">
         <span class="input-group-btn search-select-wrap">
            <select class="form-control search-select" name="search_type">
               <option value="order_id" <?php if( $search_where == "order_id" ): echo 'selected'; endif; ?>>Order ID</option>
               <option value="order_url" <?php if( $search_where == "order_url" ): echo 'selected'; endif; ?>>Order URL</option>
               <option value="username" <?php if( $search_where == "username" ): echo 'selected'; endif; ?>>Username</option>
               <option value="service_id" <?php if( $search_where == "service_id" ): echo 'selected'; endif; ?>>Service ID</option>
            </select>
            <button type="submit" class="btn btn-default"><span class="fa fa-search" aria-hidden="true"></span></button>
         </span>
      </div>
   </form>
</li>

   </ul>
               
                    
<div class="orders-table">
<table class="table" id="dt">
                                <thead>
         <tr>
            <th class="checkAll-th">
               <div class="checkAll-holder">
                  <input type="checkbox" id="checkAll">
                  <input type="hidden" id="checkAllText" value="order">
               </div>
               <div class="action-block">
                  <ul class="action-list">
                     <li><span class="countOrders"></span> Orders Selected</li>
                     <li>
                        <div class="dropdown">
                           <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown"> Bulk Actions <span class="caret"></span></button>
                           <ul class="dropdown-menu">
                              <li>
								  <?php if( $status  ==  "fail" ): ?>
                                 <a class="bulkorder" data-type="resend">Resend</a>
                                <?php endif; ?>
                                 <a class="bulkorder" data-type="pending">Pending</a>
                                 <a class="bulkorder" data-type="inprogress">In Progress</a>
                                 <a class="bulkorder" data-type="completed">Completed</a>
                                 <a class="bulkorder" data-type="canceled">Cancel & Refund</a>
                                 
                              </li>
                           </ul>
                        </div>
                     </li>
                  </ul>
               </div>
            </th>
            <th class="p-l">ID</th>
            <th>User</th>
            <th>Charge</th>
            <th>Profit</th>
            <th class="service-block__service">Link</th>
            <th>Start</th>
            <th>Quantity</th>
            <th>Service</th>
            
            <th>Status</th>
            <th>Remains</th>
            <th width="10%">Date</th>
            <th width="5%" class="dropdown-th">
              <div class="dropdown">
                <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Mode
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li class="<?php if( !$_GET["mode"] ): echo "active"; endif; ?>"><a href="<?=site_url("$rentaladmin/orders/1/".$status)?>">All</a></li>
                    <li class="<?php if( $_GET["mode"] == "manuel" ): echo "active"; endif; ?>"><a href="<?=site_url("$rentaladmin/orders/1/".$status)?>?mode=manuel">Manual</a></li>
                    <li class="<?php if( $_GET["mode"] == "auto" ): echo "active"; endif; ?>"><a href="<?=site_url("$rentaladmin/orders/1/".$status)?>?mode=auto">Automatic</a></li>
                </ul>
              </div>
            </th>
            <th></th>
         </tr>
      </thead>
      <form id="changebulkForm" action="<?php echo site_url("$rentaladmin/orders/multi-action") ?>" method="post">
        <tbody>
          <?php foreach( $orders as $order ): ?>
              <tr>
                 <td><input type="checkbox" class="selectOrder"  name="order[<?php echo $order["order_id"] ?>]" value="1" style="border:1px solid #fff"></td>
                 <td class="p-l">
                  <?php echo $order["order_id"] ?>
                  <?php if( $order["api_orderid"] != 0 ): echo '<div class="label label-api">'.$order["api_orderid"].'</div>'; endif; ?>
                </td>
                 <td><?php echo $order["username"]; if( $order["order_where"] == "api" ): echo ' <span class="label label-api">API</span>'; endif; ?> </td>
                 <td class="service-block__minorder">
                   <div style="width:85px;">
 
<?php echo format_amount_string($settings["site_base_currency"],$order["order_charge"]); ?>
                   
<?php if( $order["service_api"] != 0 ): echo '<div class="service-block__provider-value">'.format_amount_string($settings["site_base_currency"],$order["api_charge"]).'</div>'; endif; ?>
</div>
                 </td>
<td>
 <div style="width:85px;"><?php echo format_amount_string($settings["site_base_currency"],$order["order_profit"]); ?>
 
 </div>
 </td>
<td class="service-block__service">
    <?php echo $order["order_url"]; 
    if (!empty($order["order_extras"]) && $order["order_extras"] != "[]") {
        echo '<a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#uniqueCommentModal" data-action="order_comment" data-id="'.$order["order_id"].'">Details</a>'; 
    }
    ?>
    <a href="https://href.li/<?php echo $order["order_url"]; ?>" class="order-link" target="_blank">
        <span class="fa fa-external-link"></span>
    </a>
  
</td>
<div class="modal fade" id="uniqueCommentModal" tabindex="-1" role="dialog" aria-labelledby="modalLabelUnique" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Comments
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="service-mode__block">
          <div class="form-group">
            <!-- Box ke andar comments -->
            <div id="uniqueModalContent" 
                 style="
                 
                 border: 1px solid #ccc; 
                 padding: 10px; 
                 max-height: 300px; 
                 overflow-y: auto;
                 background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    ">
              Loading...
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    $('#uniqueCommentModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var orderId = button.data('id');
        var action = button.data('action');

        if (action === 'order_comment') {
            $.ajax({
                url: '<?= site_url($rentaladmin . "/orders?action=get_comments") ?>',
                type: 'GET',
                data: { order_id: orderId },
                success: function(response) {
                    $('#uniqueModalContent').html(response);
                },
                error: function() {
                    $('#uniqueModalContent').html('<p>Error loading comments.</p>');
                }
            });
        }
    });
});
</script>


<td><?php echo $order["order_start"]; ?></td>
                 <td><?php echo $order["order_quantity"]; ?></td>
                <td width="30%">
    <span class="badge badge-dark"><?php echo htmlspecialchars($order["service_id"]); ?></span><br>
    <?php echo htmlspecialchars($order["service_name"]); ?>
    <br>
     <span class="tooltip-container">
        <i class="fa fa-info-circle info-icon"></i>
        <span class="tooltip-text">
            <?php echo htmlspecialchars(GET_API_NAME_BY_ID($order["order_api"])); ?>
            <?php if (!empty($order["api_serviceid"])): ?>
            (<?php echo htmlspecialchars($order["api_serviceid"]); ?>)
        <?php endif; ?>
        </span>
    </span>
    
   <?php if (!empty($order["order_api"]) && !empty($order["api_serviceid"])): ?>
        <a href="#" class="search-icon" 
           data-api-id="<?php echo htmlspecialchars($order["order_api"]); ?>" 
           data-service-id="<?php echo htmlspecialchars($order["api_serviceid"]); ?>">
            <i class="fa fa-search"></i>
        </a>
    <?php endif; ?>
</td>
<style>
    .search-icon {
        color: #000; /* 👈 Black Color */
        font-size: 16px;
        margin-left: 8px;
        cursor: pointer;
        transition: color 0.2s ease;
    }
    .search-icon:hover {
        color: #333; /* 👈 Dark Grey on Hover */
    }
    .tooltip-container {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .tooltip-text {
        display: none;
        position: absolute;
        background-color: #000;
        color: #fff;
        text-align: center;
        padding: 6px 10px;
        border-radius: 5px;
        white-space: nowrap;
        z-index: 9999;
        top: 120%;
        left: 50%;
        transform: translateX(-50%);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        opacity: 0;
        transition: opacity 0.2s ease;
        pointer-events: none;
        font-size: 14px;
    }

    .tooltip-container.active .tooltip-text,
    .tooltip-container:hover .tooltip-text {
        display: block;
        opacity: 1;
        pointer-events: auto;
    }

    .info-icon {
        color: #000; 
        font-size: 16px;
        margin-left: 5px;
    }
    
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
     $('.search-icon').off('click').on('click', function(e) {
        e.preventDefault();

        var apiId = $(this).data('api-id');
        var serviceId = $(this).data('service-id');

        if (apiId && serviceId) {
            $.ajax({
                url: '<?= site_url($rentaladmin . "/orders?action=get_api_url") ?>',
                type: 'GET',
                data: { api_id: apiId, service_id: serviceId },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        if (data.url) {
                            window.open(data.url, '_blank');
                        } else {
                            alert(data.error || 'API URL not found!');
                        }
                    } catch (error) {
                        alert('Invalid response from server');
                    }
                },
                error: function() {
                    alert('Error fetching API URL!');
                }
            });
        } else {
            alert('Invalid API or Service ID');
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const tooltips = document.querySelectorAll('.tooltip-container');

    tooltips.forEach((tooltip) => {
        tooltip.addEventListener('click', (event) => {
            event.stopPropagation();
            document.querySelectorAll('.tooltip-container.active').forEach((activeTooltip) => {
                if (activeTooltip !== tooltip) {
                    activeTooltip.classList.remove('active');
                }
            });
            tooltip.classList.toggle('active');
        });
    });
   document.addEventListener('click', () => {
        document.querySelectorAll('.tooltip-container.active').forEach((activeTooltip) => {
            activeTooltip.classList.remove('active');
        });
    });
});
</script>
<td><div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?= $order['order_status'] == 'canceled' ? 'disabled' : '' ?>>
        <?php echo orderStatu($order["order_status"], $order["order_error"], $order["order_detail"]); ?>
        <span class="caret"></span>
    </button>
    <?php if ($order['order_status'] != 'canceled'): ?>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuStatus">
        <?php if( $order["order_status"]  ==  "pending" || $order["order_status"]  ==  "completed"  || $order["order_status"]  ==  "processing" || $order["order_status"]  ==  "partial" || $order["order_status"]  ==  "fail" ): ?>
            <li><a href="#" data-toggle="modal" data-target="#confirmChange" data-href="<?=site_url("$rentaladmin/orders/order_cancel/".$order["order_id"])?>">Cancel & Refund</a></li>
        <?php endif; ?>
        <?php if( $order["order_status"]  ==  "pending" || $order["order_status"]  ==  "inprogress"  || $order["order_status"]  ==  "processing" ): ?>           
            <li><a href="#" data-toggle="modal" data-target="#confirmChange" data-href="<?=site_url("$rentaladmin/orders/order_complete/".$order["order_id"])?>">Complete</a></li>
        <?php endif; ?>             
        <?php if( $order["order_status"]  ==  "pending"  || $order["order_status"]  ==  "processing"  ): ?>
            <li><a href="#" data-toggle="modal" data-target="#confirmChange" data-href="<?=site_url("$rentaladmin/orders/order_inprogress/".$order["order_id"])?>">In Progress</a></li>
        <?php endif; ?>
         <?php if( $order["order_status"] != "partial"): ?>
                <li><a href="#" data-toggle="modal" data-target="#modalDiv" data-action="order_partial" data-id="<?php echo $order["order_id"] ?>">Mark Partial</a></li>
            <?php endif; ?>
    </ul>
    <?php endif; ?>
</div>
                                <?php 
if (
    isset($settings["order_completion_time"]) && $settings["order_completion_time"] == 2 && 
    isset($settings["order_completion_visibility"]) && in_array($settings["order_completion_visibility"], ["both", "admins"])
): 
?>
    <?php if ($order["order_status"] == "completed" && $order["completion_time"]): ?>
        <span style="font-size: 0.8em; color: #888;"><?php echo $order["completion_time"]; ?></span>
    <?php endif; ?>
<?php endif; ?>


                            </td>
    
                 <td><?php if( $order["order_status"] == "completed" && substr($order["order_remains"], 0,1) == "-" ): echo "+".substr($order["order_remains"], 1);  else: echo $order["order_remains"]; endif; ?></td>
                 <td width="10%">
    <?php 
        echo str_replace(["am", "pm"], ["AM", "PM"], date('j M Y, g:i a', strtotime($order["order_create"])));
    ?>
</td>

<td width="5%"><?php if( $order["api_service"] == 0 ): echo "Manual"; else: echo "Automatic"; endif; ?></td>
                 <td class="service-block__action">
                   <div class="dropdown pull-right">
                     <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Actions <span class="caret"></span></button>
                     <ul class="dropdown-menu">
                       <?php if( $order["order_error"] != "-" && $order["service_api"] != 0 ): ?>
                         <li><a href="#"  data-toggle="modal" data-target="#modalDiv" data-action="order_errors" data-id="<?php echo $order["order_id"] ?>">Order Errors</a></li>
                         <li><a href="<?=site_url("$rentaladmin/orders/order_resend/".$order["order_id"])?>">Resend Order</a></li>
                       <?php endif; ?>
                       <?php if( $order["order_error"] == "-" && $order["service_api"] != 0 ): ?>
                         <li><a href="#"  data-toggle="modal" data-target="#modalDiv" data-action="order_details" data-id="<?php echo $order["order_id"] ?>">Order Details</a></li>
                       <?php endif; ?>
                       <?php if( $order["service_api"] == 0 || $order["order_error"] != "-"  ): ?>
                         <li><a href="#"  data-toggle="modal" data-target="#modalDiv" data-action="order_orderurl" data-id="<?php echo $order["order_id"] ?>">Edit Order URL</a></li>
                       <?php endif; ?>
                         <li><a href="#"  data-toggle="modal" data-target="#modalDiv" data-action="order_startcount" data-id="<?php echo $order["order_id"] ?>">Edit Start Count</a></li>
                      


                       
                     </ul>
                   </div>
                 </td>
              </tr>
            <?php endforeach; ?>
        </tbody>
        <input type="hidden" name="bulkStatus" id="bulkStatus" value="0">
      </form>
   </table></div>
   <?php if( $paginationArr["count"] > 1 ): ?>
     <div class="row">
        <div class="col-sm-8">
           <nav>
              <ul class="pagination">
                <?php if( $paginationArr["current"] != 1 ): ?>
                 <li class="prev"><a href="<?php echo site_url("$rentaladmin/orders/1/".$status.$search_link) ?>">&laquo;</a></li>
                 <li class="prev"><a href="<?php echo site_url("$rentaladmin/orders/".$paginationArr["previous"]."/".$status.$search_link) ?>">&lsaquo;</a></li>
                 <?php
                     endif;
                     for ($page=1; $page<=$pageCount; $page++):
                       if( $page >= ($paginationArr['current']-9) and $page <= ($paginationArr['current']+9) ):
                 ?>
                 <li class="<?php if( $page == $paginationArr["current"] ): echo "active"; endif; ?> "><a href="<?php echo site_url("$rentaladmin/orders/".$page."/".$status.$search_link) ?>"><?=$page?></a></li>
                 <?php endif; endfor;
                       if( $paginationArr["current"] != $paginationArr["count"] ):
                 ?>
                 <li class="next"><a href="<?php echo site_url("$rentaladmin/orders/".$paginationArr["next"]."/".$status.$search_link) ?>" data-page="1">&rsaquo;</a></li>
                 <li class="next"><a href="<?php echo site_url("$rentaladmin/orders/".$paginationArr["count"]."/".$status.$search_link) ?>" data-page="1">&raquo;</a></li>
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
               <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
         </div>
      </div>
   </div>
</div>

<?php include 'footer.php'; ?>

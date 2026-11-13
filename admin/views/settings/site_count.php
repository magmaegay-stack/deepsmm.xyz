<style>
/* Heading */
.panel .panel-body h1{
 font-size:24px;
 font-weight:700;
 line-height:1.42em;
}

/* Button */
.panel .panel-body a{
 position:relative;
 top:3px;
}

/* Label */
.form .form-group label{
 font-weight:500;
}

/* Label */
.panel-body .form-group label{
 font-weight:500;
}

/* Span Tag */
.panel-body p span{
 font-weight:500;
}
/* Accordion Content */
.col-md-8 .panel .panel-body{
 width: 100%;
     border-style:none;

    
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

/* Input */
.form .form-group input[type=number]{
  display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Next order value */
#next_order_id_value{
 display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Total orders prefix */
#total_orders_prefix{
 display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Total orders suffix */
#total_orders_suffix{
  display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Span Tag */
  .panel-body .form-group span{

    
    border-style: none;
    border-radius: 8px !important;
    padding: 12px;
    
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.5);
    min-height:50px;
    

}
/* Heading */
.panel .panel-body h1{
 font-weight:600 !important;
}

/* Button */
.panel .panel-body a{
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
.panel .panel-body a:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Button */
.form .form-group .btn-primary{
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
.form .form-group .btn-primary:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Button */
#next_order_id_value_btn{
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
#next_order_id_value_btn:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}

/* Button */
#set_total_orders_pattern{
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
#set_total_orders_pattern:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Panel */
.container .panel{
 border-style:none;
}

/* Button */
.panel .panel-body a{
 top:-8px !important;
}


</style>
<div class="col-md-8">
  <div class="panel panel-default">
    <div class="panel-body">
<h1>Virtual Order Tool </h1><a href="<?php echo site_url("$rentaladmin/settings/site_count/service_enable_disable");?>" style="float:center;margin-top:-70px;width:100%;" class="btn btn-primary btn-sm"><?php if($settings["fake_order_service_enabled"] == 0){ echo "Enable Service";} else { echo  "Disable Service";}?></a>
<br>
<form class="form  <?php if($settings["fake_order_service_enabled"] == 0){ echo "disabledDiv"; }?>" action="" method="post">
<div class="form-group">
<label class="">Minimum number of fake orders</label>
<input class="form-control" type="number" name="min_count" value="<?php if(is_numeric($settings["fake_order_min"])){
echo $settings["fake_order_min"];}?>">
</div>
<div class="form-group">
<label class="">Maximum number of fake orders</label>
<input class="form-control" type="number" name="max_count" value="<?php if(is_numeric($settings["fake_order_max"])){
echo $settings["fake_order_max"];}?>">
</div>

<div class="form-group">
<button class="btn btn-primary" type="submit">Update Settings</button>
</div>
</form>
<div class="alert alert-info">
Note : When this module is enabled, orders are incremented every 5 minutes. Leave the fields empty to choose randomly min and max fake orders.</div>

<div class="form-group">
<label class="">Next Order ID</label><small class="text-muted">
 ( Must be greater than <?=$settings["panel_orders"]?> )
</small>
<input class="form-control" type="number" id="next_order_id_value" value="<?=$settings["panel_orders"] + 1?>">
</div>
<div class="form-group">
<button type="button" id="next_order_id_value_btn" class="btn btn-primary">Submit</button>
</div>
<div class="alert alert-info">

Note : The above setting will create a fake order with the entered order ID. The next order ID will start from that entered order ID.</div>




<p style="font-weight:bold;"><span>Total Orders Prefix</span>
<span style="float:right;" class="">Total Orders Suffix</span></p>
<div class="form-group">
<div class="input-group">
<?php 
$sff = json_decode($settings["panel_orders_pattern"],true);
$prefix = $sff["panel_orders_prefix"];
$suffix = $sff["panel_orders_suffix"];

?>
<input type="number" class="form-control" id="total_orders_prefix" value="<?=$prefix?>" placeholder="10">
<span class="input-group-addon"><?=$settings["panel_orders"]?></span>

<input type="number" class="form-control" id="total_orders_suffix" value="<?=$suffix?>" placeholder="10">
</div></div>
<div class="form-group">
<button type="button" id="set_total_orders_pattern" class="btn btn-primary">Submit</button>
</div>

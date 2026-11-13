<style>
body{
 font-family:'Inter', sans-serif;
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            
}
.col-md-8 .panel .panel-body{
     width: 100%;
     border-style:none;
   
    
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }
       /* Panel */
.container .panel{
 border-style:none !important;
 border-width:0px !important;
 border-top-left-radius:12px;
 border-top-right-radius:12px;
 border-bottom-left-radius:12px;
 border-bottom-right-radius:12px;
}

/* Accordion Content */
.col-md-8 .panel .panel-body{
 border-style:none;
}
.panel-body form select{
    text-transform:capitalize;
 display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

.panel-body form input[type=text]{
display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

.panel-body form .btn-primary{
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
  .panel-body form .btn-primary:hover {
             background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Select */
.panel-body form select{
 border-style:none !important;
}
.input-group {
    display: flex;
    align-items: center;
    border-radius: 8px;
    background-color: #e9ecef;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.input-group .form-control {
    border: none;
    border-radius: 0;
    padding: 12px;
    color: #333;
    flex: 1;
    min-height: 50px;
    background: transparent;
}

.input-group .btn-generate {
    background: linear-gradient(145deg, #007bff, #0056b3);
    color: #ffffff;
    padding: 12px 20px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

.input-group .btn-generate:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Generate */
.panel-body form .btn-generate{
 height:50px;
}


</style>
<div class="col-md-8">

  <div class="panel panel-default">

    <div class="panel-body">
        
      <form action="" method="post" enctype="multipart/form-data">


<div class="row">
          <div class="col-md-6 form-group">
            <label class="control-label">Welcome Message <div class="tooltip5">  </div>  </label>
            <select class="form-control" name="welcomemail">
              <option value="2" <?= $settings["alert_welcomemail"] == 2 ? "selected" : null; ?> >Enabled</option>
              <option value="1" <?= $settings["alert_welcomemail"] == 1 ? "selected" : null; ?>>Disabled</option>
            </select>
          </div>
 <div class="col-md-6 form-group">
            <label class="control-label">API Key Changed </label>
            <select class="form-control" name="apimail">
              <option value="2" <?= $settings["alert_apimail"] == 2 ? "selected" : null; ?> >Enabled</option>
              <option value="1" <?= $settings["alert_apimail"] == 1 ? "selected" : null; ?>>Disabled</option>
            </select>
          </div>
           <div class="col-md-6 form-group">
            <label class="control-label">New Ticket Message </label>
            <select class="form-control" name="newmessage">
              <option value="2" <?= $settings["alert_newmessage"] == 2 ? "selected" : null; ?> >Enabled</option>
              <option value="1" <?= $settings["alert_newmessage"] == 1 ? "selected" : null; ?>>Disabled</option>
            </select>
          </div>
          </div>
<hr>
     <div class="row">
          <div class="col-md-6 form-group">
            <label class="control-label">API Balance Notification</label>
            <select class="form-control" name="alert_apibalance">
              <option value="2" <?= $settings["alert_apibalance"] == 2 ? "selected" : null; ?> >Enabled</option>
              <option value="1" <?= $settings["alert_apibalance"] == 1 ? "selected" : null; ?>>Disabled</option>
            </select>
          </div>
          <div class="col-md-6 form-group">
            <label class="control-label">Service Provider Changed Information</label>
            <select class="form-control" name="serviceapialert">
              <option value="2" <?= $settings["alert_serviceapialert"] == 2 ? "selected" : null; ?> >Enabled</option>
              <option value="1" <?= $settings["alert_serviceapialert"] == 1 ? "selected" : null; ?>>Disabled</option>
            </select>
          </div>
          <div class="col-md-6 form-group">
            <label class="control-label">New Support Ticket Notification</label>
            <select class="form-control" name="alert_newticket">
              <option value="2" <?= $settings["alert_newticket"] == 2 ? "selected" : null; ?> >Enabled</option>
              <option value="1" <?= $settings["alert_newticket"] == 1 ? "selected" : null; ?>>Disabled</option>
            </select>
          </div>

          <div class="col-md-6 form-group">
            <label class="control-label">New Manual Orders <div class="tooltip5">  <span class="fas fa-info-circle"></span><span class="tooltiptext5">Automatically notifies staff at regular intervals when new manual orders are received, ensuring timely processing and management.</span></div>  </label>
            <select class="form-control" name="alert_newmanuelservice">
              <option value="2" <?= $settings["alert_newmanuelservice"] == 2 ? "selected" : null; ?> >Enabled</option>
              <option value="1" <?= $settings["alert_newmanuelservice"] == 1 ? "selected" : null; ?>>Disabled</option>
            </select>
          </div>
          <div class="col-md-6 form-group">
            <label class="control-label">Failed Orders <div class="tooltip5">  <span class="fas fa-info-circle"></span><span class="tooltiptext5">Automatically notifies staff at regular intervals if any orders receive a 'Failed' status, ensuring prompt action and resolution.</span></div> </label>
            <select class="form-control" name="orderfail">
              <option value="2" <?= $settings["alert_orderfail"] == 2 ? "selected" : null; ?> >Enabled</option>
              <option value="1" <?= $settings["alert_orderfail"] == 1 ? "selected" : null; ?>>Disabled</option>
            </select>
          </div>
          


     

        
		 <div class="col-md-12 form-group">
        <hr>
            <label class="control-label">Admin Email</label>
            <input type="text" class="form-control" name="admin_mail" placeholder="yourmail@gmail.com" value="<?=$settings["admin_mail"]?>">
			 
          </div>
      
      
        </div>
      <div class="row">
          <div class="form-group col-md-6">
            <label class="control-label">SMTP Email</label>
            <input type="text" class="form-control" name="smtp_user" value="<?=$settings["smtp_user"]?>" placeholder="noreply@yourdomain.com">
          </div>
          <div class="form-group col-md-6">
            <label class="control-label">SMTP Password</label>
            <input type="text" class="form-control" name="smtp_pass" value="<?=$settings["smtp_pass"]?>">
          </div>
          <div class="form-group col-md-6">
            <label class="control-label">SMTP Server</label>
            <input type="text" class="form-control" name="smtp_server" value="<?=$settings["smtp_server"]?>">
          </div>
          <div class="form-group col-md-3">
            <label class="control-label">SMTP Port</label>
            <input type="text" class="form-control" name="smtp_port" value="<?=$settings["smtp_port"]?>">
          </div>
          <div class="col-md-3 form-group">
            <label class="control-label">SMTP Protocol</label>
            <select class="form-control" name="smtp_protocol">
              <option value="0" <?= $settings["smtp_protocol"] == 0 ? "selected" : null; ?> >None</option>
              <option value="tls" <?= $settings["smtp_protocol"] == "tls" ? "selected" : null; ?>>TLS</option>
              <option value="ssl" <?= $settings["smtp_protocol"] == "ssl" ? "selected" : null; ?>>SSL</option>
            </select>
          </div>
        </div>
        
        <br>
 <button type="submit" class="btn btn-primary">Update Settings</button>
      
    
            </table>
        </div>
    </div>

</form>
</div>
  </div>
</div>
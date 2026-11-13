<style>
/* Panel */
.container .panel{
 border-style:none;
}

/* Button */
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
/* Font Icon */
.col-md-2 .setting-block__image .setting-block__image-remove a span{
 top:3px;
 left:4px;
 bottom:3px;
 right:6px;
}

/* Font Icon */
.col-md-1 a span{
 top:3px;
 left:4px;
 bottom:4px;
}

/* Accordion Content */
.col-md-8 .panel .panel-body{
 width: 100%;
     border-style:none;
   
    
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

/* Select */
.panel-body form .alert > .form-group > select{
 display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Input */
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

/* Select */
form .alert .row .form-group select{
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
.panel-body .form-group .form-group select{
display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Input */
.panel-body form input[type=number]{
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
.panel-body form textarea{
 display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
/* Control label */
.panel-body form .alert > .form-group > .control-label{
 text-transform:capitalize;
}

/* Label */
.panel-body .form-group .form-group label{
 text-transform:capitalize;
}

/* Label */
.panel-body form .alert > .form-group > label{
 text-transform:capitalize;
}



</style>
  <div class="col-md-8">
  <div class="panel panel-default">
    <div class="panel-body">
    
      <form action="" method="post" enctype="multipart/form-data">
 
<div class="alert" >
       
        <div class="form-group">
            <?php 
            if($settings["register_page"] == "2"){
                $reg_active = "selected";
            }else{
                $reg_passive = "selected";
            } ?>
<div class="form-group field-editgeneralform-skype_field required" >
          <label class="control-label" for="editgeneralform-registration_page">Sign Up Page <div class="tooltip5">  <span class="fas fa-info-circle"></span><span class="tooltiptext5">Allow Users To Register</span></div></label>

          <select class="form-control"  name="registration_page">
            <option value="2" <?= $reg_active ?> >Enabled</option>
            <option value="1" <?= $reg_passive ?>>Disabled</option>
          </select>
        </div></div>
    <div class="form-group">
          <label class="control-label" for="editgeneralform-name_field">Name Field 
            <div class="tooltip5">
              <span class="fas fa-info-circle"></span>
              <span class="tooltiptext5">Name Field On The Sign Up Page</span>
            </div>
          </label>
          <select class="form-control" name="name_fileds">
            <option value="1" <?= $settings["name_fileds"] == 1 ? "selected" : null; ?>>Enabled</option>
            <option value="2" <?= $settings["name_fileds"] == 2 ? "selected" : null; ?>>Disabled</option>
          </select>
        </div>
<div class="form-group field-editgeneralform-skype_field required">
<label class="control-label" for="editgeneralform-skype_field">Whatsapp Field <div class="tooltip5">  <span class="fas fa-info-circle"></span><span class="tooltiptext5">Whatsapp Field On The Sign Up Page</span></div></label>
          <select class="form-control" name="skype_feilds">
            <option value="1" <?= $settings["skype_feilds"] == 1 ? "selected" : null; ?> >Enabled</option>
            <option value="2" <?= $settings["skype_feilds"] == 2 ? "selected" : null; ?>>Disabled</option>
          </select>
          </div>
       
<div class="form-group field-editgeneralform-skype_field required">
<label class="control-label" for="editgeneralform-skype_field">Email Confirmation <div class="tooltip5">  <span class="fas fa-info-circle"></span><span class="tooltiptext5">(Enables Mandatory Email Confirmation For The User After Signing Up)</span></div> </label>
          <select class="form-control" name="email_confirmation">
            <option value="1" <?= $settings["email_confirmation"] == 1 ? "selected" : null; ?> >Enabled</option>
            <option value="2" <?= $settings["email_confirmation"] == 2 ? "selected" : null; ?>>Disabled</option>
          </select>
          </div>
    
<div class="form-group">
          <label for="" class="control-label">Resend Email Link Max <div class="tooltip5">  <span class="fas fa-info-circle"></span><span class="tooltiptext5">(Recommended : 2)</span></div> </label>
          <input type="text" class="form-control" name="resend_max" value="<?=$settings["resend_max"]?>">
        </div>
        
		<hr>
                    
        <button type="submit" class="btn btn-primary w-100">Update Settings</button>
      </form>
    </div>
  </div>
</div>
<div class="modal modal-center fade" id="confirmChange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
 <div class="modal-dialog modal-dialog-center" role="document">
   <div class="modal-content">
     <div class="modal-body text-center">
       <h4>Are you sure?</h4>
       <div align="center">
         <a class="btn btn-primary" href="" id="confirmYes">Yes</a>
         <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
       </div>
     </div>
   </div>
 </div>

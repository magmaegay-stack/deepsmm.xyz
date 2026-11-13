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
.card-body .form-group .btn-xs-caret{
 background-color: #f0f0f0;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
  }
/* Th */
.table tr th{
 text-transform:uppercase;
 text-align:center;
}

/* Table Data */
.table tr td{
 text-align:center;
}
.btn-primary{
    background: linear-gradient(145deg, #0069d9, #0056b3) !important; /* Blue gradient background */
    color: #ffffff !important;
   padding: 14px 28px;
    font-size: 14px !important;
    font-weight: 500 !important;
    border: none !important;
    border-radius: 5px !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important; 
    transition: background 0.3s ease, transform 0.2s ease !important;

}
.btn-primary:hover {
    background: linear-gradient(145deg, #0056b3, #004494); /* Darker gradient on hover */
   transform: translateY(-2px); /* Slight lift effect */
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



</style>
  <div class="col-md-8">
  <div class="panel panel-default">
    <div class="panel-body">
    
      <form action="" method="post" enctype="multipart/form-data">
 
<div class="alert" >
        <div class="form-group">
        
          <div class="row">
            <div class="col-md-10">
              <label for="preferenceLogo" class="control-label">Site Logo</label>
              <input type="file" name="logo" id="preferenceLogo">
            </div>
            <div class="col-md-2">
              <?php if( $settings["site_logo"] ):  ?>
                <div class="setting-block__image">
                      <img class="img-thumbnail" src="<?=$settings["site_logo"]?>">
                    <div class="setting-block__image-remove">
                      <a href="" data-toggle="modal" data-target="#confirmChange" data-href="<?=site_url("$rentaladmin/settings/general/delete-logo")?>"><span class="fa fa-remove"></span></a>
                    </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-11">
              <label for="preferenceFavicon" class="control-label">Site Favicon</label>
              <input type="file" name="favicon" id="preferenceFavicon">
            </div>
            <div class="col-md-1">
              <?php if( $settings["favicon"] ):  ?>
                <div class="setting-block__image">
                    <img class="img-thumbnail" src="<?=$settings["favicon"]?>">
                    <div class="setting-block__image-remove">
                      <a href="" data-toggle="modal" data-target="#confirmChange" data-href="<?=site_url("$rentaladmin/settings/general/delete-favicon")?>"><span class="fa fa-remove"></span></a>
                    </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
          <hr>
      
        <div class="form-group">
          <label class="control-label">Maintenance mode  
            </label>
          <select class="form-control" name="site_maintenance">
            <option value="2" <?= $settings["site_maintenance"] == 2 ? "selected" : null; ?> >Inactive</option>
            <option value="1" <?= $settings["site_maintenance"] == 1 ? "selected" : null; ?>>Active</option>
          </select></div>
          
          
        <div class="form-group">
          <label class="control-label">Panel name</label>
          <input type="text" class="form-control" name="name" value="<?=$settings["site_name"]?>">
</div></div>

<div class="alert" >
        
        <div class="form-group">
            <?php 
            if($settings["service_list"] == "2"){
                $servlist_active = "selected";
            }else {
                $servlist_passive = "selected";
            } ?>
          <label class="control-label">Service List</label>
          <select class="form-control" name="service_list">
            <option value="2" <?= $servlist_active ?> >Active For Everyone</option>
            <option value="1" <?= $servlist_passive ?>>Active For Only Users</option>
          </select>
        </div>
                <div class="form-group">

            <?php 

            if($settings["services_average_time"] == "1"){
                $avg_time_active = "selected";
            }else {
                $avg_time_passive = "selected";
            } ?>
          <label class="control-label">Service Average Time</label>
          <select class="form-control" name="services_average_time">
            <option value="1" <?= $avg_time_active ?> >Enabled</option>
            <option value="0" <?= $avg_time_passive ?>>Disabled</option>
          </select>
        </div>
         <hr>
</div>
                 
<div class="alert" >
        <div class="form-group">
          <label class="control-label">Header codes</label>
          <textarea class="form-control" rows="7" name="custom_header" placeholder='<style type="text/css">...</style>'><?=$settings["custom_header"]?></textarea>
        </div>
        <div class="form-group">
          <label>Footer codes</label>
          <textarea class="form-control" rows="7" name="custom_footer" placeholder='<script>...</script>'><?=$settings["custom_footer"]?></textarea>
        </div><hr>
	
    <div class="card mt-3">
  
  <div class="card-body">

    <!-- File Upload -->
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
          
        <label for="siteFile">Upload File (.html, .txt, .xml)</label><button type="submit" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret pull-right">Upload File</button>
        <input type="file" class="form-control-file" id="siteFile" name="file" accept=".html, .txt, .xml">
         
      </div>
     
    </form>

    <hr>

    <!-- Uploaded Files Table -->
    <?php 
      $files = glob($_SERVER["DOCUMENT_ROOT"] . '/*.{html,txt,xml}', GLOB_BRACE);
      if ($files):
    ?>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>File Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $i = 1;
              foreach ($files as $file):
                $file_name = basename($file);
            ?>
              <tr>
                <td><?= $i++ ?></td>
                <td><?= $file_name ?></td>
                <td>
                  <a href="/<?= $file_name ?>" target="_blank" class="btn btn-success btn-sm">
                    <i class="fa fa-eye"></i> View
                  </a>
                  <form action="<?= site_url("$rentaladmin/settings/general/delete-file") ?>" method="POST" style="display:inline;">
                    <input type="hidden" name="file_name" value="<?= $file_name ?>">
                    <button type="submit" class="btn btn-success btn-sm">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-muted">No files uploaded yet.</p>
    <?php endif; ?>

  </div>
</div>
                 <hr>   
        <button type="submit" class="btn btn-primary w-100">Update Settings</button>
      </form>
    </div>
  </div>
</div>
</div>
<div class="modal modal-center fade" id="confirmChange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
 <div class="modal-dialog modal-dialog-center" role="document">
   <div class="modal-content">
     <div class="modal-body text-center">
       <h4>Are you sure ?</h4>
       <div align="center">
         <a class="btn btn-primary" href="" id="confirmYes">Yes</a>
         <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
       </div>
     </div>
   </div>
 </div>

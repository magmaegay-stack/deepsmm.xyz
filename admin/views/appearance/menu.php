<style>
  .panel-custom {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }
    .table {
        table-layout: fixed;
    }

    .table td {
        padding: 12px 8px;
        border-bottom: 1px solid #e0e0e0;
    }

    .table__drag .handle svg {
        fill: #606060;
        width: 20px;
        height: 20px;
    }

    

    .settings-menu__title {
        font-size: 18px;
        color: #333;
        font-weight: 600;
    }

    .settings-menu__description {
        font-size: 14px;
        color: #666;
    }
    @media (max-width:767px){

 /* Column 9/12 */
 .container .row .col-md-8 .panel .panel-body .settings-menu__row .col-md-9{
  
  margin-top:15px !important;
 }
 
}
/* Button */
.panel-body tr .btn-xs-caret{
 background-color: #f0f0f0;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
  }

.panel-body tr .btn-danger{
background-color: #c9302c;
    color: #fff;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
  }
/* Table Data */
.panel-body tr td{
 line-height:2.5em !important;
}
/* Input */
.modal-body .form-group input[type=text]{
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

/* Span Tag */
.modal-body .form-group span{
 display:none;
}

/* Modal footer */
.form .modal-body .modal-footer{
 padding-left:0px;
}
/* Button */
.panel-body .add-modal-menu{
  background-color: #f0f0f0;
    color: #333333;
    padding:14px 28px !important;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    
  }
/* Your existing styles */
.disabled-menu {
    background-color: #f8f9fa; /* Light background for disabled items */
    color: #6c757d; /* Gray text color for disabled items */
}
/* Button */
.disabled-menu td .btn-success{
 padding-left:12px;
 padding-right:12px;
 padding-top:6px;
 padding-bottom:6px;
 width:64px;
 height:30px;
}



</style>

<div class="col-md-8">
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row settings-menu__row">
        <div class="col-md-3">
          <div class="settings-menu__title">Public</div>
          <div class="settings-menu__description">Shown for any visitors</div>
        </div>
        <div class="col-md-9">
          <div class="dd">
            <table class="table">
              <tbody class="menu-sortable">
                <?php foreach($menus as $menu): ?>
                  <?php if($menu["visible"] == "External"): ?>
                    <tr data-id="<?php echo $menu["id"]; ?>" class="<?php echo $menu["type"] == 1 ? 'disabled-menu' : ''; ?>">
                      <td>
                        <div class="table__drag handle">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Drag-Handle</title>
                            <path d="M7 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm6-8c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"></path>
                          </svg>
                        </div>
                        <div class="settings-menu__icon">
                          <span class="<?php echo $menu["icon"]; ?>"></span>
                          <?php echo $menu["name"]; ?>
                          <?php if($menu["tiptext"]): ?>
                            <div class="tooltip5">
                              <span class="fas fa-info-circle"></span>
                              <span class="tooltiptext5"><?php echo $menu["tiptext"]; ?></span>
                            </div>
                          <?php endif; ?>
                        </div>
                      </td>
                      <td>
                        <?php if($menu["type"] == 1): ?>
                          <a href="<?php echo site_url("$rentaladmin/appearance/menu/enable/".$menu["id"]) ?>" class="btn btn-default btn-xs btn-success pull-right">
                            Enable
                          </a>
                        <?php else: ?>
                          <a href="<?php echo site_url("$rentaladmin/appearance/menu/disable/".$menu["id"]) ?>" class="btn btn-default btn-xs btn-danger pull-right">
                            Disable
                          </a>
                        <?php endif; ?>
                        <a data-toggle="modal" data-target="#modalDiv" data-action="edit_external" data-id="<?php echo $menu["id"]; ?>" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret pull-right">Edit</a>
                      </td>
                    </tr>
                  <?php endif; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <a data-toggle="modal" data-target="#modalDiv" data-action="add_external" class="btn btn-default m-b add-modal-menu">Add menu item</a>
        </div>
      </div>
      <div class="row settings-menu__row">
        <div class="col-md-3">
          <div class="settings-menu__title">Signed</div>
          <div class="settings-menu__description">Available for signed in users</div>
        </div>
        <div class="col-md-9">
          <div class="dd">
            <table class="table">
              <tbody class="menu-sortable">
                <?php foreach($menus as $menu): ?>
                  <?php if($menu["visible"] == "Internal"): ?>
                    <tr data-id="<?php echo $menu["id"]; ?>" class="<?php echo $menu["type"] == 1 ? 'disabled-menu' : ''; ?>">
                      <td>
                        <div class="table__drag handle">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Drag-Handle</title>
                            <path d="M7 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm6-8c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"></path>
                          </svg>
                        </div>
                        <div class="settings-menu__icon">
                          <span class="<?php echo $menu["icon"]; ?>"></span>
                          <?php echo $menu["name"]; ?>
                          <?php if($menu["tiptext"]): ?>
                            <div class="tooltip5">
                              <span class="fas fa-info-circle"></span>
                              <span class="tooltiptext5"><?php echo $menu["tiptext"]; ?></span>
                            </div>
                          <?php endif; ?>
                        </div>
                      </td>
                      <td>
                        <?php if($menu["type"] == 1): ?>
                          <a href="<?php echo site_url("$rentaladmin/appearance/menu/enable/".$menu["id"]) ?>" class="btn btn-default btn-xs btn-success pull-right">
                            Enable
                          </a>
                        <?php else: ?>
                          <a href="<?php echo site_url("$rentaladmin/appearance/menu/disable/".$menu["id"]) ?>" class="btn btn-default btn-xs btn-danger pull-right">
                            Disable
                          </a>
                        <?php endif; ?>
                        <a data-toggle="modal" data-target="#modalDiv" data-action="edit_internal" data-id="<?php echo $menu["id"]; ?>" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret pull-right">Edit</a>
                      </td>
                    </tr>
                  <?php endif; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <a data-toggle="modal" data-target="#modalDiv" data-action="add_internal" class="btn btn-default m-b add-modal-menu">Add menu item</a>
        </div>
      </div>
    </div>
  </div>
</div>
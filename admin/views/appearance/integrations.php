<style>
  /* General Styling */
  body {
    font-family: 'Inter', sans-serif;
    background-color: #f7f9fc;
    color: #333333;
  }
  .settings-emails__block {
    border-radius: 8px;
    background-color: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
  }
  .settings-emails__block-title {
    font-weight: 600;
    font-size: 1.2em;
    color: #333333;
    padding: 16px;
    border-bottom: 1px solid #e9ecef;
  }
/* Table Styling */
  table {
    width: 100%;
    border-collapse: collapse;
  }
  th, td {
    
    text-align: left;
  }

  .settings-emails__row {
    border-bottom: 1px solid #e9ecef;
  }

  .settings-emails__row:hover {
    background-color: #f9fbfd;
  }
   .settings-emails__row-img img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
  }

  /* Row Styling */
  .settings-emails__row-name {
    font-weight: 600;
    color: #333333;
  }

  .settings-emails__row-description {
    color: #777777;
    font-size: 0.9em;
  }

  .settings-emails__row-disable {
    opacity: 0.6;
  }
  /* Button Styling */
  .btn-default {
    background-color: #f0f0f0;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
  }

  .btn-default:hover {
    background-color: #e9ecef;
  }

  .btn-primary {
    background-color: #007bff;
    color: #ffffff;
    border-radius: 6px;
    padding: 6px 12px;
  }
  /* Editintegrationform code */
#editintegrationform-code{
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
.edit-integration-modal-body .field-editintegrationform-visibility select{
 display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Button */
#modalContent .form .btn-primary{
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
#modalContent .form .btn-primary:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Button */
#modalContent .form .btn-danger{
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
#modalContent .form .btn-danger:hover {
  background: linear-gradient(145deg, #e04d4d, #f76c6c); /* Darker gradient on hover */
  transform: translateY(-2px); /* Slight lift effect */
}

/* Input */
.modal-body .form-group input[type=text]{
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
.modal-body .form-group select{
 display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
textarea.form-control{
 display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}


  </style>
<div class="col-md-8">

<?php if($active){ ?>
<!-- Active Section -->
<div class="settings-emails__block">
   <div class="settings-emails__block-title">
      Active
   </div>
   <div class="settings-emails__block-body">
      <table>
         <thead>
            <tr>
               <th></th>
               <th class="settings-emails__th-name"></th>
               <th class="settings-emails__th-actions"></th>
            </tr>
         </thead>
         <tbody>
         <?php foreach($active as $int){ ?>
            <tr class="settings-emails__row">
               <td class="settings-emails__row-img">
                  <img src="<?=$int['icon_url']?>" alt="<?=$int['name']?>">
               </td>
               <td>
                  <div class="settings-emails__row-name">
                    <?=$int['name']?> 
                  </div>
                  <div class="settings-emails__row-description">
                    <?=$int['description']?> 
                  </div>
               </td>
               <td class="settings-emails__td-actions">
                  <?php 
                  // Dynamically determine the edit action
                  if (in_array($int["id"], [13, 15, 21, 22, 23])) {
                      $editAction = '';
                      switch ($int["id"]) {
                          case 13:
                              $editAction = "edit_google";
                              break;
                          
                          case 21:
                              $editAction = "edit_whatsapp";
                              break;
                          case 22:
                              $editAction = "edit_telegram";
                              break;
                           case 23:
                              $editAction = "edit_seo";
                              break;
                      }
                  ?>
                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalDiv" data-action="<?=$editAction?>">Edit</button>
                  <?php } else { ?>
                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalDiv" data-action="edit_code" data-id="<?=$int['id']?>">Edit</button>
                  <?php } ?>
               </td>
            </tr>
         <?php } ?>
         </tbody>
      </table>
   </div>
</div>  
<?php } ?>

<?php if($other){ ?>
<!-- Inactive Section -->
<div class="settings-emails__block">
   <div class="settings-emails__block-title">
      Other
   </div>
   <div class="settings-emails__block-body">
      <table>
         <thead>
            <tr>
               <th></th>
               <th class="settings-emails__th-name"></th>
               <th class="settings-emails__th-actions"></th>
            </tr>
         </thead>
         <tbody>
         <?php foreach($other as $int){ ?>
            <tr class="settings-emails__row settings-emails__row-disable">
               <td class="settings-emails__row-img">
                  <img src="<?=$int['icon_url']?>" alt="<?=$int['name']?>">
               </td>
               <td>
                  <div class="settings-emails__row-name">
                     <?=$int['name']?> 
                  </div>
                  <div class="settings-emails__row-description">
                     <?=$int['description']?>
                  </div>
               </td>
               <td class="settings-emails__td-actions">
    <?php
    // Dynamically create the activation link
    $activateUrl = "https://$url/$rentaladmin/appearance/integrations/enabled/" . $int['id'];
    
    if ($int["id"] == 13) {
        $activateUrl = "https://$url/$rentaladmin/appearance/integrations/enabledg/" . $int['id'];
    } elseif ($int["id"] == 21) {
        $activateUrl = "https://$url/$rentaladmin/appearance/integrations/enabledwa/" . $int['id'];
    } elseif ($int["id"] == 22) {
        $activateUrl = "https://$url/$rentaladmin/appearance/integrations/enabledtg/" . $int['id'];
    } elseif ($int["id"] == 23) {
        $activateUrl = "https://$url/$rentaladmin/appearance/integrations/enabledseo/" . $int['id'];
    }
    ?>
    <a class="btn btn-xs btn-default activate-integration" href="<?=$activateUrl?>">Activate</a>
</td>

            </tr>
         <?php } ?>
         </tbody>
      </table>
   </div>
</div>
<?php } ?>

</div>  

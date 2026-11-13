<?php if( !route(3) ): ?>
<style>
  body {
    font-family: 'Inter', sans-serif;
    background-color: #f7f9fc; /* Light theme background */
    color: #333333; /* Dark text for readability */
    margin: 0;
    padding: 0;
  }

  .table {
    border-collapse: separate;
    border-spacing: 0 10px;
    width: 100%;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
  }

  .table th {
    font-weight: 600;
    color: #555555;
    padding: 12px;
  }

  .table td {
    padding: 14px;
    background-color: #ffffff;
    border-radius: 8px;
  }

  .badge {
    background-color: #4caf50;
    color: #ffffff;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
  }

  .form-group select, .form-control {
    background-color: #ffffff;
    border: 1px solid #e2e6ea;
    color: #333;
    padding: 8px;
    border-radius: 4px;
    font-size: 14px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
  }

  .panel {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
    margin-top: 20px;
    padding: 20px;
  }

  .panel-heading {
    font-weight: 600;
    font-size: 18px;
    color: #333333;
    margin-bottom: 10px;
  }

  .list-group-item {
    background-color: #ffffff;
    color: #333333;
    border: 1px solid #e2e6ea;
    border-radius: 4px;
    padding: 8px 16px;
    margin: 4px 0;
  }

  /* Table Data */
  .table tr td{
    border-top-right-radius:0px;
    border-bottom-right-radius:0px;
    border-top-left-radius:0px;
    border-bottom-left-radius:0px;
  }

  .table tr td{
    border-top-style:none !important;
    border-bottom-style:solid;
    border-bottom-color:#ddd;
  }

  .container .row .col-md-8 .table tbody tr td{
    border-bottom-width:1px !important;
  }

  /* Button */
  .table tr .btn-xs-caret{
    background-color: #f0f0f0;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
  }
</style>

<div class="col-md-8">
  <table class="table">
    <thead>
      <tr>
        <th>Themes</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($themes as $theme): ?>
        <tr>
          <td> 
            <?php echo $theme["theme_name"]; 
            if( $settings["site_theme"] == $theme["theme_dirname"] ): 
              echo ' <span class="badge">Active</span>'; 
            endif; ?> 
          </td>
          <td>
            <?php if( $settings["site_theme"] == $theme["theme_dirname"] ):
              if( $theme["colour"] == "2" && $theme["theme_dirname"] == "Simplify"):
                echo ' 
                <div class="dropdown pull-right">
                  <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Colour Change <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <select class="form-control" name="site_theme_alt">
                          <option value="Red">Red</option>
                          <option value="Blue">Blue</option>
                          <option value="Lime">Lime</option>
                          <option value="Grapes">Grapes</option>
                          <option value="Cyan">Cyan</option>
                          <option value="Coral">Coral</option>
                          <option value="Green">Green</option>
                          <option value="Grey">Grey</option>
                          <option value="Lilac">Lilac</option>
                          <option value="Orange">Orange</option>
                        </select>
                      </div> 
                      <center>
                        <button type="submit" class="btn btn-default">Update</button>
                      </center>
                    </form>
                  </ul>';
              endif;

              if( $theme["colour"] == "2" && $theme["theme_dirname"] == "Eternity"):
                echo ' 
                <div class="dropdown pull-right">
                  <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Colour Change <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <select class="form-control" name="site_theme_alt">
                          <option value="lilac">Eternity Lilac</option>
                          <option value="coral">Eternity Coral</option>
                          <option value="azure">Eternity Azure</option>
                          <option value="grey">Eternity Grey</option>
                          <option value="lime">Eternity Lime</option>
                          <option value="navy">Eternity Navy</option>
                          <option value="pink">Eternity Pink</option>
                          <option value="raspberry">Eternity Raspberry</option>
                          <option value="cyan">Eternity Cyan</option>
                          <option value="black">Eternity Black</option>
                          <option value="purple">Eternity Purple</option>
                        </select>
                      </div> 
                      <center>  
                        <button type="submit" class="btn btn-default">Update</button>
                      </center>
                    </form>
                  </ul>';
              endif;

              if( $theme["colour"] == "2" && $theme["theme_dirname"] == "Engaging"):
                echo ' 
                <div class="dropdown pull-right">
                  <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Colour Change <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <select class="form-control" name="site_theme_alt">
                          <option value="Red">Orange</option>
                          <option value="Azure">Azure</option>
                          <option value="Blue">Blue</option>
                          <option value="Coral">Coral</option>
                          <option value="Cyan">Cyan</option>
                          <option value="Dark">Gasoline</option>
                          <option value="Gasoline">Dark</option>
                          <option value="Grapes">Grapes</option>
                          <option value="Grey">Yellow</option>
                          <option value="Lilac">Lilac</option>
                          <option value="Lime">Green</option>
                          <option value="Yellow">Red</option>
                        </select>
                      </div> 
                      <center>  
                        <button type="submit" class="btn btn-default">Update</button>
                      </center>
                    </form>
                  </ul>';
              endif;

              if( $theme["colour"] == "2" && $theme["theme_dirname"] == "pitchy"):
                echo ' 
                <div class="dropdown pull-right">
                  <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Colour Change <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <select class="form-control" name="site_theme_alt">
                          <option value="green">Clementine Green</option>
                          <option value="parrot">Clementine Parrot</option>
                          <option value="orange">Clementine Orange</option>
                        </select>
                      </div> 
                      <center>  
                        <button type="submit" class="btn btn-default">Update</button>
                      </center>
                    </form>
                  </ul>';
              endif;

            endif; ?>
          </td>
          <td class="text-right col-md-1">
            <div class="dropdown pull-right">
              <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown" 
              <?php echo ($settings["site_theme"] == $theme["theme_dirname"]) ? 'disabled' : ''; ?>>Options <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <?php if( $settings["site_theme"] != $theme["theme_dirname"] ): ?>
                  <li>
                    <a href="<?php echo site_url("$rentaladmin/appearance/themes/active/".$theme["id"]) ?>">
                      Activate
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php elseif( route(3) ): ?>
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading edit-theme-title"><strong><?php echo $theme["theme_name"] ?></strong> edit the theme named</div>

      <div class="row">
        <div class="col-md-3 padding-md-right-null">
          <div class="panel-body edit-theme-body">
            <div class="twig-editor-block">
              <?php
                foreach ($layouts as $style => $layout):
                  echo '<div class="twig-editor-list-title" data-toggle="collapse" href="#folder_'.$style.'"><span class="fa fa-folder-open"></span>'.$style.'</div><ul class="twig-editor-list collapse in" id="folder_'.$style.'">';
                  foreach ($layouts[$style] as $layout) :
                    if( $lyt == $layout ):
                      $active = ' class="active file-modified" ';
                    else:
                      $active = '';
                    endif;
                    echo '
                    <li '. $active .'><a href="'.site_url("$rentaladmin/appearance/themes/".$theme["id"]).'?file='.$layout.'">'.$layout.'</a></li>';
                  endforeach;
                  echo '</ul>';
                endforeach;
              ?>
            </div>
          </div>
        </div>
        <div class="col-md-9 padding-md-left-null edit-theme__block-editor">
          <?php if( !$lyt ): ?>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="theme-edit-block">
                    <div class="alert alert-info" role="alert">
                      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                      <script>
                        swal("Nhi ", "Tere Baap Ki Script Hai", "error");
                      </script>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

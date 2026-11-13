<style>
 body {
    font-family: 'Inter', sans-serif;
    background-color: #f7f9fc;
    color: #333333;
  }

  /* Container and Form Styling */
  .col-md-8 {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
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

  /* File Upload Styling */
  .form-control[type="file"] {
    padding: 4px 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background-color: #fafafa;
  }

  /* Table Styling */
  .files__table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
  }

  .files__table thead th {
    border-bottom: 2px solid #ddd;
    font-weight: 600;
    color: #555;
    padding: 10px;
  }

  .files__table tbody tr {
    border-bottom: 1px solid #eee;
  }

  .files__table-preview img {
    width: 40px;
    height: 40px;
    border-radius: 4px;
    margin-right: 10px;
    object-fit: cover;
    border: 1px solid #ddd;
  }

  /* Column Styling */
  .p-l {
    padding-left: 10px;
  }

  .p-r {
    padding-right: 10px;
  }

  /* Align text to the right in table rows */
  .text-right {
    text-align: right;
  }
  /* Th */
.files__table thead .p-l{
 text-transform:uppercase;
}


</style>
    <div class="col-md-8">
<div class="p-b">                
<div class="pull-left">
                  <form action="https://<?php echo "$url/"; echo $rentaladmin; ?>/appearance/files" method="POST" enctype="multipart/form-data">

       <input class="form-control" type="file" name="logo" accept="image/*"> 

                   
                    </div>
                                    <div class="pull-right">
                                        
                                        <button style="margin-bottom: 12px;" type="submit" class="btn btn-default">Upload File</button>
</div>  </form>   
            </div>

                        <div id="filesContainer">
                <table class="table files__table">
    <thead>
    <tr>
        <th class="p-l" colspan="2">File</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
<?php foreach( $fileList as $file ){ ?>

    <tr>
        <td>
            <div class="files__table-preview">
                <img src="<?=$file['link']?>" onerror="this.style.display='none'">
            </div
        </td>
        <td class="p-l">
            <a href="<?=$file['link']?>" target="_blank">
                <?php
                $m2 = str_ireplace(site_url(),"",$file["link"]);
                echo $m2;

                ?>
                        </a>
        </td>
        <td class="p-r text-right">
            <a class="btn btn-default btn-xs delete-file " href="https://<?php echo "$url/"; echo $rentaladmin; ?>/appearance/files/delete/<?=$file['id']?>">Delete</a>        </td>
    </tr>
<?php } ?>
    </tbody>
</table>

<nav>
    </nav>            </div>
        </div>
    </div>
</div>
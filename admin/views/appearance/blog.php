<?php if( !route(3) ): ?>
<style>

  /* General Light Theme Styling */
  body {
    font-family: 'Inter', sans-serif;
    background-color: #f7f9fc;
    color: #333333;
  }

  /* Panel Styling */
  .panel {
    border: none;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
  }

  .panel-body {
    padding: 20px;
  }

  /* Table Styling */
  .report-table {
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #ffffff;
  }

  .report-table th,
  .report-table td {
    padding: 12px;
    border-bottom: 1px solid #e9ecef;
    text-align: left;
    color: #555555;
  }

  .report-table th {
    font-weight: 600;
    color: #333333;
  }

  /* Form Styling */
  .form-group label {
    font-weight: 600;
    color: #555555;
    margin-bottom: 8px;
    display: block;
  }

  .form-control {
    border: 1px solid #e2e6ea;
    border-radius: 6px;
    padding: 10px;
    background-color: #f9fbfd;
    color: #333333;
  }

  .form-control:focus {
    border-color: #007bff;
    background-color: #ffffff;
  }

  /* Button Styling */
  .btn-primary {
    background-color: #007bff;
    border: none;
    color: #ffffff;
    padding: 8px 20px;
    font-weight: 600;
    border-radius: 6px;
  }

  .btn-default {
    background-color: #f0f0f0;
    color: #333333;
    border: 1px solid #ccc;
    padding: 8px 12px;
    border-radius: 6px;
    margin-right: 5px;
  }

  .btn-danger {
    background-color: #e63946;
    color: #ffffff;
  }
  /* Report table */
.container .settings-header__table .report-table{
 border-style:none !important;
}

/* Button */
.col-md-8 a .m-b{
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

.col-md-8 a .m-b:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Th */
.report-table tr th{
 text-transform:uppercase;
 text-align:center;
}
/* Table Data */
.report-table tr td{
 text-align:center;
}

 table.report-table th, table.report-table td {
        vertical-align: middle;
        padding: 10px;
        border: 1px solid #dee2e6;
        text-align: left;
    }

    table.report-table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

/* Th */
.report-table tr th{
 text-align:center !important;
}

/* Table Data */
.report-table tr td{
 text-align:center !important;
}



</style>

            
<div class="settings-header__table">

            <div class="col-md-8">
	<div class="settings-header__table">
	<a href="https://<?php echo "$url/"; echo $rentaladmin; ?>/appearance/blog/new" >	<button type="button" class="btn btn-default m-b">Create Blog</button></a>
	</div>
	

   <table class="table report-table" style="border:1px solid #ddd">
      <thead>
         <tr>
            <th>Blog Title</th>
<th>Created</th>
<th>Visibility</th>
            <th width="20%">Action</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach($blogs as $blog): ?>
         <tr>
<td> <?php echo $blog["title"]; ?> </td>
            <td>  <?php echo str_replace(["am","pm"],["AM","PM"], date("j M Y, g:i a", strtotime($blog["published_at"]))); ?>
</td>
<td><?php if($blog["status"]==1){ echo 'Published';}else{ echo 'Not Published';}   ?></td>

			 
			 
			 
			
            <td>
                   <a href="<?php echo site_url("$rentaladmin/appearance/blog/edit/".$blog["id"]) ?>" class="btn btn-default btn-xs">
                  Edit
                  </a>
                  <a href="<?php echo site_url("$rentaladmin/appearance/blog/delete/".$blog["id"]) ?>" class="btn btn-default btn-xs btn-danger">
                  Delete
                  </a>
              
            </td>
         </tr>
         <?php endforeach; ?>



      </tbody>
   </table>
</div>
</div>



<?php elseif( route(3) == "new" ): ?>
<style>
/* Panel */
.container .panel{
 border-style:none !important;
}

/* Accordion Content */
.col-md-8 .panel .panel-body{
   width: 100%;
     border-style:none;
   
    
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
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

/* Summernote example */
#summernoteExample{
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
.panel-body form select{
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
.panel-body form span{
 border-style: none;
    border-radius: 8px !important;
    padding: 12px;
    
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.5);
    min-height:50px;
    

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
</style>
<div class="col-md-8">
   <div class="panel panel-default">
      <div class="panel-body">
          <form action="<?php echo site_url("$rentaladmin/appearance/blog/new") ?>" method="post" enctype="multipart/form-data">
<div class="form-group">
               <label class="control-label">Blog Image (<a href="https://imgur.com/upload"> Upload Here </a>)</label>
               <input type="text" class="form-control" name="url" value="">
            </div>
        
            <div class="form-group">
               <label class="control-label">Blog Title</label>
               <input type="text" class="form-control" name="title" value="">
            </div>
            <div class="form-group">
               <label class="control-label">Page Content</label>
               <textarea class="form-control" id="summernoteExample" rows="5" name="content" placeholder=""></textarea>
            </div>
<hr>
                    <div class="form-group" >
                        <label class="control-label" for="createblogform-url">URL</label>                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2"><?=site_url("blog/")?></span>
                            <input type="text" id="createblogform-url" class="form-control" name="blogurl" value="">                   </div>
                    </div>
<div class="form-group">
          <label class="control-label">Visibility
            </label>
          <select class="form-control" name="status">
            <option value="2">Not Published</option>
            <option value="1">Published</option>
          </select>
</div> 
            <hr>
            <button type="submit" class="btn btn-primary">Update Settings</button>
         </form>
      </div>
   </div>
</div>

<?php elseif( route(3) == "edit" ): ?>
         
<div class="col-md-8">
   <div class="panel panel-default">
      <div class="panel-body">
<form action="<?php echo site_url("$rentaladmin/appearance/blog/edit/".route(4)) ?>" method="post" enctype="multipart/form-data">

         <div class="form-group">
               <label class="control-label">Blog Image</label>
               <input type="text" class="form-control" name="url" value="<?=$bloge["image_file"];?>">
            </div>
            <div class="form-group">
               <label class="control-label">Blog Title</label>
               <input type="text" class="form-control" name="title" value="<?=$bloge["title"];?>">
            </div>
            <div class="form-group">
               <label class="control-label">Blog Content</label>
               <textarea class="form-control" id="summernoteExample" rows="5" name="content" ><?=$bloge["content"];?></textarea>
            </div>
                          
                    <hr>
                    <div class="form-group" >
                        <label class="control-label" for="createblogform-url">URL</label>                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2"><?=site_url("blog/")?></span>
                            <input type="text" id="createblogform-url" class="form-control" name="blogurl" value="<?=$bloge["blog_get"];?>">                   </div>
                    </div>
                    
                    

        <div class="form-group">
          <label class="control-label">Visibility
            </label>
          <select class="form-control" name="status">
            <option value="2" <?= $bloge["status"] == 2 ? "selected" : null; ?> >Not Published</option>
            <option value="1" <?= $bloge["status"] == 1 ? "selected" : null; ?>>Published</option>
          </select>
</div>
            <hr>
<button type="submit" class="btn btn-primary">Update Settings</button>
                                            <a class="btn btn-link pull-right delete-btn" href="/<?php echo $rentaladmin; ?>/appearance/delete-blog/<?= $bloge["id"]; ?>"data-title="Confirm Deletion ?">Delete</a>
         </form>
      </div>
   </div>
</div>
         
<?php endif; ?>


          
        
               
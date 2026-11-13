<style>

.col-md-8 {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
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
.btn-xs, .ticket-btn-group>.btn{
    
background-color: #f0f0f0;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
}
.btn-danger{
background-color: #c9302c;
    color: #fff;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
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

    .form-control {
        padding: 8px;
        font-size: 14px;
        border-radius: 4px;
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }

    .panel {
        border: 1px solid #dee2e6;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    .panel-body {
        padding: 20px;
    }

    .seo-preview {
        background-color: #f8f9fa;
        padding: 12px;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        margin-bottom: 12px;
    }

    .seo-preview__title {
        font-size: 18px;
        font-weight: bold;
    }

    .seo-preview__url {
        color: #007bff;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .seo-preview__description {
        color: #6c757d;
        font-size: 14px;
    }
    .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control{
        background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
.form-control  {
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
/* Th */
.report-table tr th{
 text-align:center !important;
 text-transform:uppercase;
}

/* Table Data */
.report-table tr td{
 text-align:center !important;
}



</style>


<?php if(! route(3) ): ?>
<div class="col-md-8">
            <a class="btn btn-primary" href="/<?=$rentaladmin?>/appearance/pages/create">Add Page</a>
           <br><br>
            <table class="table">
               

   <table class="table report-table" style="border:1px solid #ddd">
      <thead>
         <tr>
            <th><div style="float:left;">Page Name</div></th>

<th>Last Modified</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach($pageList as $page): ?>
         <tr>
            <td> <div style="float:left;"><?php echo $page["page_name"]; ?></div> <br>  <label class="switch">
        <input type="checkbox" class="switch-input addon" 
            data-id="<?php echo $page["page_id"]; ?>" 
            <?php echo $page["page_status"] == 1 ? "checked" : ""; ?>>
        <span class="switch-label" data-on="" data-off=""></span>
        <span class="switch-handle"></span>
    </label> </td>
           
        

<script>
    document.querySelectorAll('.switch-input').forEach(function(switchInput) {
        switchInput.addEventListener('change', function() {
            const id = this.getAttribute('data-id');
            const type = this.checked ? 'on' : 'off';

            fetch(`<?= site_url("$rentaladmin/appearance/pages/type") ?>?id=${id}&type=${type}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // ✅ Success message in modal
                        document.getElementById('statusModalBody').innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                    } else {
                        // ❌ Error message in modal
                        document.getElementById('statusModalBody').innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                    }
                    
                    // ✅ Modal show karo
                    let statusModal = new bootstrap.Modal(document.getElementById('statusModal'));
                    statusModal.show();

                    // ✅ Page ko refresh karo modal band hone ke baad
                    document.getElementById('statusModal').addEventListener('hidden.bs.modal', () => {
                        location.reload();
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('statusModalBody').innerHTML = `<div class="alert alert-danger">An error occurred.</div>`;
                    let statusModal = new bootstrap.Modal(document.getElementById('statusModal'));
                    statusModal.show();
                });
        });
    });
</script>

<!-- Status Update Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Status Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="statusModalBody">
                <!-- Message will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php if( $page["last_modified"]== "0000-00-00 00:00:00"): ?>
<td> Never</td>
<?php else: ?>
<td>   <?php echo str_replace(["am","pm"],["AM","PM"], date("j M Y, g:i a", strtotime($page["last_modified"]))); ?>
</td>

<?php endif; ?>

             <td >  <a href="<?php echo site_url("$rentaladmin/appearance/pages/edit/".$page["page_get"]) ?>" class="btn btn-default btn-xs">
                  Edit
                  </a>

				 <?php if( $page["del"]== "1"): ?>
				 
               <a href="<?php echo site_url("$rentaladmin/appearance/pages/delete/".$page["page_id"]) ?>" class="btn btn-default btn-xs btn-danger">
                  Delete
                  </a>
               <?php endif; ?>
            </td>
         </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</div>
<?php elseif( route(3) == "edit" ): ?>
<div class="col-md-8">
   <div class="panel panel-default">
      <div class="panel-body">
         <form action="<?php echo site_url("$rentaladmin/appearance/pages/edit/".route(4)) ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label class="control-label">Page Name</label>
               <input type="text" class="form-control" value="<?=$page["page_name"];?>" readonly>
            </div>
            <div class="form-group">
               <label class="control-label">Page Content TOP</label>
               <textarea class="form-control" id="summernote" rows="5" name="content" placeholder=""><?php echo $page["page_content"]; ?></textarea>
            </div>
			  <div class="form-group">
               <label class="control-label">Page Content BOTTOM</label>
               <textarea class="form-control" id="summernote1" rows="5" name="content2" placeholder=""><?php echo $page["page_content2"]; ?></textarea>
            </div>

<hr>
    <div class="appearance-seo__block">
        <div class="appearance-seo__block-title" href="#collapse-languages-seo" role="button" data-toggle="collapse">   <span> Edit Search Engine Listing Preview    </span> </div>
             <div class="seo-preview">
            <div class="seo-preview__title edit-seo__title"></div>

            <div class="seo-preview__title edit-seo__title"><?=$page["seo_title"];?></div>
    <div class="seo-preview__url"><?=site_url("")?><span class="edit-seo__url"><?=$page["page_get"];?></span>
 <div class="seo-preview__description edit-seo__meta"><?=$page["seo_description"];?></div>
        
</div>
            <div class="seo-preview__description edit-seo__meta"></div>
        </div>
    </div>
    <div class="collapse appearance-seo__block-collapse" id="collapse-languages-seo">
        <div class="form-group">
            <label class="control-label" for="editpageform-seo_title">Page Title</label>            <input type="text" id="editpageform-seo_title" class="form-control" name="seo_title" value="<?=$page["seo_title"];?>">        </div>

            <div class="form-group">
            <label class="control-label" for="editpageform-seo_description">Meta-Keywords</label>            <textarea id="editpageform-seo_keywords" class="form-control" name="seo_keywords" rows="5"><?=$page["seo_keywords"];?></textarea>        </div>
    <div class="form-group">
        <div class="form-group">
            <label class="control-label" for="editpageform-seo_description">Meta-Description</label>            <textarea id="editpageform-seo_description" class="form-control" name="seo_description" rows="5"><?=$page["seo_description"];?></textarea>        </div>
    </div>
</div>                                                                
                       

            <hr>
            <button type="submit" class="btn btn-primary">Update Settings</button>
			  
			 <?php if( $page["del"]== "1"): ?>
			 <a class="btn btn-link pull-right delete-btn" href="/<?= $rentaladmin; ?>/appearance/delete-page/<?= $page["page_id"]; ?>" data-title="Confirm Deletion ?">Delete</a>

			 <?php endif; ?>
			 
         </form>
      </div>
   </div>
</div>


<?php elseif( route(3) == "create" ): ?>
<div class="col-md-8">
   <div class="panel panel-default">
      <div class="panel-body">
         <form action="<?php echo site_url("$rentaladmin/appearance/pages/create") ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label class="control-label">Page Name</label>
               <input type="text" class="form-control"  name="name"  value="">
            </div>
            <div class="form-group">
               <label class="control-label">Page Content TOP</label>
               <textarea class="form-control" id="summernote" rows="5" name="content" placeholder=""></textarea>
            </div>
			  <div class="form-group">
               <label class="control-label">Page Content BOTTOM</label>
               <textarea class="form-control" id="summernote1" rows="5" name="content2" placeholder=""></textarea>
            </div>
<div class="form-group" >
                        <label class="control-label" for="createblogform-url">URL</label>                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2"><?=site_url("")?></span>
                            <input type="text" id="createblogform-url" class="form-control" name="pageget" value="">                   </div>
                    </div>

<hr>
    <div class="appearance-seo__block">
        <div class="appearance-seo__block-title" href="#collapse-languages-seo" role="button" data-toggle="collapse"> <span>   Edit Search Engine Listing Preview </span>    </div>
             <div class="seo-preview">
            <div class="seo-preview__title edit-seo__title"></div>

            <div class="seo-preview__title edit-seo__title"><?=$page["seo_title"];?></div>
    <div class="seo-preview__url"><?=site_url("")?><span class="edit-seo__url"><?=$page["page_get"];?></span>
 <div class="seo-preview__description edit-seo__meta"><?=$page["seo_description"];?></div>
        
</div>
            <div class="seo-preview__description edit-seo__meta"></div>
        </div>
    </div>
    <div class="collapse appearance-seo__block-collapse" id="collapse-languages-seo">
        <div class="form-group">
            <label class="control-label" for="editpageform-seo_title">Page Title</label>            <input type="text" id="editpageform-seo_title" class="form-control" name="seo_title" value="">        </div>

		
		
		
            <div class="form-group">
            <label class="control-label" for="editpageform-seo_keywords">Meta-Keywords</label> 
				

				<textarea id="editpageform-seo_description" class="form-control" name="seo_keywords" rows="5"></textarea>        </div>
    <div class="form-group">
        <div class="form-group">
            <label class="control-label" for="editpageform-seo_description">Meta-Description</label>            <textarea id="editpageform-seo_description" class="form-control" name="seo_description" rows="5"></textarea>                </div>
    </div>
</div>                                                                
                       

            <hr>
            <button type="submit" class="btn btn-primary">Update Settings</button>
         </form>
      </div>
   </div>
</div>
	

<?php endif; ?>
	

	

	
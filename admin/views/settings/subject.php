<style>
body {
    font-family: 'Inter', sans-serif;
    height: 100%;
    width: 100%;
    margin: 0;
    padding: 0;
}
.container .panel:nth-child(2){
    width: 100%;
    border-style: none;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}
.container .panel {
    border-style: none !important;
    border-radius: 12px;
}
.col-md-9 .dd ol {
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    margin-bottom: 30px;
    overflow-x: auto;
}
.col-md-9 .panel .add-modal-menu {
    width: 100%;
    background: linear-gradient(145deg, #007bff, #0056b3);
    color: #ffffff;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
}
.col-md-9 .panel .add-modal-menu:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Input */
.panel-body form input[type=text], 
.panel-body form select, 
.panel-body form textarea {
    display: flex;
    align-items: center;
    background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
.panel-body form .btn-primary {
    background: linear-gradient(145deg, #007bff, #0056b3);
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
.panel-body form a {
    background: linear-gradient(145deg, #c71f1f, #e04d4d);
    color: #ffffff !important;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    transition: background 0.3s ease, transform 0.2s ease;
}
.panel-body form a:hover {
    background: linear-gradient(145deg, #e04d4d, #f76c6c);
    transform: translateY(-2px);
}
.ui-sortable .dd-item .edit-modal-menu{
 background-color: #f0f0f0;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
  }

.ui-sortable .dd-item .btn-danger{
background-color: #c9302c;
    color: #fff;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
  }
 .ui-sortable .dd-item .edit-modal-menu{
 position:relative;
 top:-5px;
}

/* Button */
.ui-sortable .dd-item .btn-danger{
 position:relative;
 top:-5px;
}
/* Panel */
.container .panel:nth-child(1){
 background-color:rgba(255,255,255,0);
 border-style:none;
 border-bottom-color:rgba(221,221,221,0);
 border-top-color:rgba(221,221,221,0);
 border-right-color:rgba(221,221,221,0);
 border-left-color:rgba(221,221,221,0);
 box-shadow:0px 1px 1px 0px rgba(0,0,0,0);
}

.container .panel:nth-child(1) .panel-body{
    padding:0px;
}


</style>

<?php if( !route(4) ): ?>

<div class="col-md-9">
    <?php if( $success ): ?>
        <div class="alert alert-success"><?php echo $successText; ?></div>
    <?php endif; ?>
    <?php if( $error ): ?>
        <div class="alert alert-danger"><?php echo $errorText; ?></div>
    <?php endif; ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dd">
                <ol class="dd-list ui-sortable">
                    <?php foreach($subjectList as $subject): ?>
                        <li class="dd-item ui-sortable-handle">
                            <div class="dd-handle"><?php echo $subject["subject"]?></div>
                            <div class="settings-menu__action">
                                <?php if($subject["auto_reply"] == 1): ?>
                                    <i class="fas fa-magic"></i> 
                                <?php endif; ?>
                                <a href="<?php echo site_url("$rentaladmin/settings/subject/edit/".$subject["subject_id"].'') ?>" class="btn btn-default btn-xs edit-modal-menu">Edit</a>

                <a href="<?php echo site_url("$rentaladmin/settings/subject/delete/".$subject["subject_id"]) ?>" class="btn btn-default btn-xs btn-danger pull-right">Delete</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </div>

    <!-- "Create New Title" Form - Now Default Open -->
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="<?php echo site_url("$rentaladmin/settings/subject") ?>" method="post" enctype="multipart/form-data">
                <div class="form-group relative">
                    <label class="control-label">Support Title</label>
                    <input type="text" class="form-control" name="subject">
                </div>
                <div class="form-group">
                    <label class="control-label">Auto Answer</label>
                    <select class="form-control" name="auto_reply">
                        <option value="0" selected>Closed</option>
                        <option value="1">Active</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Message to Auto Reply</label>
                    <textarea class="form-control" rows="5" name="content"></textarea>
                </div>
                <p>Automatic reply when a new support request is created under this topic.</p>
                <hr>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>

<?php elseif( route(3) == "edit" ): ?>
<div class="col-md-9">
    <a href="/<?php echo $rentaladmin; ?>/settings/subject" class="details_backButton btn btn-link"><span>‹</span> Back</a>

    <?php if( $success ): ?>
        <div class="alert alert-success"><?php echo $successText; ?></div>
    <?php endif; ?>
    <?php if( $error ): ?>
        <div class="alert alert-danger"><?php echo $errorText; ?></div>
    <?php endif; ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <form action="<?php echo site_url("$rentaladmin/settings/subject/edit/".route(4)) ?>" method="post" enctype="multipart/form-data">
                <div class="form-group relative">
                    <label class="control-label">Support Title</label>
                    <input type="text" class="form-control" name="subject" value="<?=$post["subject"]?>">
                </div>
                <div class="form-group">
                    <label class="control-label">Auto Answer</label>
                    <select class="form-control" name="auto_reply">
                        <option value="0" <?= $post["auto_reply"] == 0 ? 'selected' : '' ?>>Closed</option>
                        <option value="1" <?= $post["auto_reply"] == 1 ? 'selected' : '' ?>>Active</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Message to Auto Reply</label>
                    <textarea class="form-control" rows="5" name="content"><?=$post["content"]?></textarea>
                </div>
                <p>Automatic reply when a new support request is created under this topic.</p>
                <hr>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo site_url("$rentaladmin/settings/subject/delete/".$post["subject_id"]) ?>" class="btn btn-link pull-right deactivate-integration-btn">Delete</a>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

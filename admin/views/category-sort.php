<?php include 'new-header.php'; ?>
<style>
    .list-group-item {
        display: flex;
        align-items: center;
        padding: 12px;
        border: 1px solid #ddd;
        background-color: #ffffff;
        margin-bottom: 5px;
        transition: background-color 0.2s ease;
    }

    .list-group-item:hover {
        background-color: #f9f9f9;
    }

    .category-sort-handle {
        cursor: grab;
        font-size: 22px;
        color: #999;
        padding-right: 10px;
    }

    .category-edit-input {
        border: none;
        background-color: transparent;
        width: 100%;
        font-size: 16px;
        padding: 5px;
        outline: none;
    }

    .category-edit-input:focus {
        border-bottom: 1px solid #007bff;
        background-color: #f1f1f1;
    }

    .sortable-placeholder {
        background-color: #f0f0f0;
        border: 1px dashed #ccc;
        height: 40px;
        margin-bottom: 5px;
    }

    .container {
        max-width: 600px;
        margin-top: 20px;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .category-list-container {
        max-height: 500px; /* Scrollable area */
        overflow-y: auto;
        padding-right: 5px;
    }

    .save-btn {
        width: 100%;
        margin-bottom: 10px;
    }

    /* Title Styling */
    .editor-title {
        font-size: 24px;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 15px;
        text-align: center;
    }
/* Input */
#category-list .list-group-item input[type=text]{
 background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Editor title */
.container .editor-title{
 color:#5a5a5a;
 font-weight:500px;
}

/* Button */
#save-changes-btn{
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
#save-changes-btn{
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Container */
.container{
 background-color:rgba(248,249,250,0) !important;
 box-shadow:0px 4px 8px 0px rgba(0,0,0,0) !important;
}


</style>
<style>
.log-menu {
   padding-left: 0;
   margin: 0;
}

.log-menu li {
   list-style: none;
   padding: 10px 15px;
   font-weight: 400;
   color: #337ab7;
   border-radius: 6px;
   margin-bottom: 5px;
   transition: background 0.2s;
}

.log-menu li.active {
   background-color: #e0e0e0;
   color: #000;
}

.log-menu li a {
   color: inherit;
   text-decoration: none;
   display: block;
}
</style>
<div class="container">
    <ul class="log-menu">
   <li >
     <a href="<?php echo site_url("$rentaladmin/bulk") ?>">Services Editor</a>



   </li>
   <li class="active">
     <a href="<?php echo site_url("$rentaladmin/category-sort") ?>">Categories Editor</a>
   </li>
   
</ul><br>
    <div class="editor-title">Bulk Categories Editor</div>
     <div class="category-list-container">
        <ul id="category-list" class="list-group">
            <?= $list ?>
        </ul>
        
    </div>
   
</div>

<script>
    $(document).ready(function () {
        // Auto-save category name as user types
        $(".category-edit-input").on("input", function () {
            var inputField = $(this);
            var categoryId = inputField.data("category-id");
            var categoryName = inputField.val();

            $.post("<?= $rentaladmin ?>/category-sort", {
                action: "update_category",
                category_id: categoryId,
                category_name: categoryName
            }, function (response) {
                var data = JSON.parse(response);
                if (data.status === "success") {
                    console.log("Category updated successfully.");
                }
            });
        });
    });
</script>

<?php include "new-footer.php"; ?>

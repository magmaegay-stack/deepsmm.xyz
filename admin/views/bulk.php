<?php include 'header.php'; ?>
<style>


.input {
  width: 5%;
  
  
}
	.input2 {
  width: 40%;
  
}
	.input3 {
  width: 7%;
  
}
	.input4 {
  width: 8%;
  
}
	.input5 {
  width: 8%;
  
}
	.input6 {
  width: 30%;
  
}

/* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Body */
body{
 font-family:'Inter', sans-serif;
}

/* Heading */
center h2{
 font-size:24px;
}

/* Th */
.table tr th{
 text-transform:uppercase;
}

/* Button */
div a.btn{
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

/* Button */
div form .btn{
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

div a.btn:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
div form .btn:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
.form-control{
    width:100% !important;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;

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
#modalContent{
    min-height:150px;
}
.form-control:focus{
    width:100% !important;
}
/* Heading */
center h2{
 font-weight:700;
}


</style><style>
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
<script>
  // Override viewport for desktop mode
  document.addEventListener("DOMContentLoaded", function() {
    const metaViewport = document.querySelector("meta[name='viewport']");
    if (!metaViewport) {
      const newMetaViewport = document.createElement("meta");
      newMetaViewport.name = "viewport";
      newMetaViewport.content = "width=1024"; // Adjust width for desktop
      document.head.appendChild(newMetaViewport);
    } else {
      metaViewport.content = "width=1024"; // Adjust width for desktop
    }
  });
</script> <div class="container-fluid">
<ul class="log-menu">
   <li class="active">
     <a href="<?php echo site_url("$rentaladmin/bulk") ?>">Services Editor</a>



   </li>
   <li>
     <a href="<?php echo site_url("$rentaladmin/category-sort") ?>">Categories Editor</a>
   </li>
   
</ul><br>
<center><h2>Bulk Service Editor</h2></center>
<br>
  
       
    <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#modalDiv" data-action="bulkGetCategories">Select Category</a><br><br>
       <form id="bulk-edit" action="" method="post" enctype="multipart/form-data">
      <table class="table" style="border:1px solid #ddd">
<thead>
  
<th class="input">ID</th>
<th class="input2">Name</th>
<th class="input3" >Min</th> 
<th class="input4" >Max</th>
<th class="input5" >Price</th>
<th class="input6" >Description</th>
            
         </thead>
      <tbody>

</tbody>
</table>
<br>
<center><button type="submit" class="btn btn-primary" >Save Changes</button></center>
</form>
         </div>


<div class="modal modal-center fade" id="confirmChange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
 <div class="modal-dialog modal-dialog-center" role="document">
   <div class="modal-content">
     <div class="modal-body text-center">
       <h4>Are you sure you want to update the status ?</h4>
       <div align="center">
         <a class="btn btn-primary" href="" id="confirmYes">Yes</a>
         <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
       </div>
     </div>
   </div>
 </div>
</div>




<?php include 'footer.php'; ?>
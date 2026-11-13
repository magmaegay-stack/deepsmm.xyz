<?php include 'header.php'; ?>
<style>
  body {
    background-color: #fff;
    font-family: Arial, sans-serif;
    color: #333;
    overflow-x: hidden; /* Prevent horizontal scrolling */
  }

  .container-fluid {
    font-family: 'Inter', sans-serif;
     }

  .clients-table {
    border-radius: 8px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow-x: auto; /* Allows horizontal scrolling on small screens */
  }

  /* Dropdown button styling */
  .dropdown .btn-primary {
    background: linear-gradient(135deg, #4a90e2, #007aff);
    border: none;
    color: #fff;
    border-radius: 6px;
    padding: 8px 16px;
  }

  /* Search bar */
  .form-inline .input-group .form-control {
    border: 1px solid #ddd;
    border-radius: 4px 0 0 4px;
    height: 38px;
  }

  .input-group-btn .btn-default {
    border-radius: 0 4px 4px 0;
    border: 1px solid #ddd;
  }

  /* Table styling */
  .table th, .table td {
    text-align: center;
    padding: 10px;
    vertical-align: middle;
    border-bottom: 1px solid #eee;
  }

  .table th {
    background-color: #f5f5f5;
    font-weight: 600;
  }

 
  /* Modal center styling */
  .modal-center .modal-dialog {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
  }

  
  /* Select */
  .input-group .input-group-btn select {
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
  }

 

  /* Select */
  .input-group .input-group-btn select {
    border-top-right-radius: 4px !important;
    border-bottom-right-radius: 4px !important;
    border-top-left-radius: 0;
  }
/* Button */
.container-fluid form .btn-primary{
 width:100%;

    background: linear-gradient(145deg, #0069d9, #0056b3); /* Blue gradient background */
    color: #ffffff;
   padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;

}
.container-fluid form .btn-primary:hover {
    background: linear-gradient(145deg, #0056b3, #004494); /* Darker gradient on hover */
   transform: translateY(-2px); /* Slight lift effect */

}
/* List */
.container-fluid form ul{
 width:100% !important;
 text-align:center;
}


/* Select */
.container-fluid .form-inline .input-group .input-group-btn select{
 border-top-right-radius:0px !important;
 border-bottom-right-radius:0px !important;
}

/* Button */
.input-group .input-group-btn .btn{
 min-height:38px;
}
/* Button */
.container-fluid form .custom_method{
 padding-top:8px;
 padding-bottom:8px;
 padding-left:16px;
 padding-right:16px;
}
/* Table Data */
.table tr td{
 padding-left:25px !important;
 padding-right:25px !important;
 
}
/* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Swal2 icon warning */
.swal2-container .swal2-icon-warning{
 font-family:'Inter', sans-serif;
}

/* Swal2 warning */
.swal2-container .swal2-icon-warning .swal2-warning{
 display:none !important;
}
div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm{

    background: linear-gradient(145deg, #0069d9, #0056b3); /* Blue gradient background */
    color: #ffffff; /* Text color */
  padding: 14px 28px; /* Padding for consistency with primary button */
  font-size: 14px; /* Font size */
  font-weight: 500; /* Font weight */
  border: none; /* Remove default border */
  border-radius: 5px; /* Slightly rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Subtle shadow for depth */
  transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
}
div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm:hover {
    background: linear-gradient(145deg, #0056b3, #004494); /* Darker gradient on hover */
   transform: translateY(-2px); /* Slight lift effect */

}
div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel{
    background: linear-gradient(145deg, #c71f1f, #e04d4d); /* Gradient background for a professional look */
  color: #ffffff; /* Text color */
  padding: 14px 28px; /* Padding for consistency with primary button */
  font-size: 14px; /* Font size */
  font-weight: 500; /* Font weight */
  border: none; /* Remove default border */
  border-radius: 5px; /* Slightly rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Subtle shadow for depth */
  transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
}
@media (max-width:767px){

 /* Button */
 .container-fluid .form-inline .input-group .input-group-btn .btn{
  left:-140px !important;
  background-color:rgba(255,255,255,0) !important;
  border-style:none !important;
 }
 
}
  @media (max-width:767px){

 /* Body */
 body{
  overflow-x:hidden !important;
 }
 .container-fluid {
     overflow-x:hidden !important;
}
}
/* Th */
.table tr th{
 text-transform:uppercase;
}

/* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Modal div */
#modalDiv{
 font-family:'Inter', sans-serif;
}

/* Modal title */
#modalTitle{
 text-transform:capitalize;
}

/* Label */
.form .modal-body label{
 text-transform:capitalize;
}




/* Modal footer */
.form .modal-body .modal-footer{
 padding-left:0px;
 padding-right:0px;
 padding-top:15px;
}

/* Input */
.form .modal-body input[type=text]{
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
.form .modal-body select{
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
.form .form-group .btn-danger{
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

/* Button */
.form .modal-body .btn-primary{
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
.form .modal-body .btn-primary:hover {
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
/* Button */
.form .modal-footer .btn-primary{
 background-color:#1e3251;
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
/* Text Area */
#username textarea{
  background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Label */
#modalContent form label{
 text-transform:capitalize;
}

/* Text Area */
#modalContent form textarea{
 background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Button */
#modalContent form .btn-danger{
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
#modalContent form .btn-danger:hover {
  background: linear-gradient(145deg, #e04d4d, #f76c6c); /* Darker gradient on hover */
  transform: translateY(-2px); /* Slight lift effect */
}
/* Modal body */
#modalContent form .modal-body{
 font-weight:400;
 transform:translatex(0px) translatey(0px);
}

/* Label */
#modalContent form label{
 font-weight:600;
}



/* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Swal2 success ring */
.swal2-icon-success .swal2-success .swal2-success-ring{
 display:none;
}

/* Swal2 success circular line right */
.swal2-icon-success .swal2-success .swal2-success-circular-line-right{
 display:none;
}

/* Swal2 success */
.swal2-container .swal2-icon-success .swal2-success{
 display:none !important;
}

/* Swal2 icon success */
.swal2-container .swal2-icon-success{
 font-family:'Inter', sans-serif;
 font-weight:400;
 transform:translatex(0px) translatey(0px);
}

/* Heading */
.swal2-container .swal2-icon-success h2{
 font-weight:500;
 font-size:18px;
}

/* Swal2 confirm */
.swal2-icon-success .swal2-actions .swal2-confirm{
 background: linear-gradient(145deg, #0069d9, #0056b3); /* Blue gradient background */
    color: #ffffff; /* Text color */
  padding: 14px 28px; /* Padding for consistency with primary button */
  font-size: 14px; /* Font size */
  font-weight: 500; /* Font weight */
  border: none; /* Remove default border */
  border-radius: 5px; /* Slightly rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Subtle shadow for depth */
  transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
}
.swal2-icon-success .swal2-actions .swal2-confirm:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}

/* Form control */
.service-mode__block .form-group .form-control{
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
#modalTitle span{
 position:relative;
 top:-1px;
}

/* Button */
.container-fluid form .custom_method{
 padding-left:28px !important;
 padding-right:28px !important;
 padding-top:14px !important;
  padding-bottom:14px !important;
}

/* Button */
.table tr .btn-xs-caret{
  background-color: #f0f0f0 !important;
    color: #333333 !important;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
  }
  
/* Button */
.table tr .btn-xs-caret{
 background-image:none;
}
.btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover, .btn-primary:active.focus, .btn-primary:active:focus, .btn-primary:active:hover, .open>.dropdown-toggle.btn-primary.focus, .open>.dropdown-toggle.btn-primary:focus, .open>.dropdown-toggle.btn-primary:hover{
     border: 1px solid #ccc !important;
}

/* Button */
.table tr .disabled{
    background-color: #f0f0f0 !important;
    color: #333333 !important;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
}
/* Span Tag */
#modalTitle span{
 text-transform:none;
 background-color:#0069d9 !important;
}
/* Font Icon */
.table tr .fa-whatsapp{
 font-size:20px;
 padding:5px;
}

/* Font Icon */
.table tr .fa-telegram{
 font-size:20px;
}
/* Input */
.form-inline .input-group input[type=text]{
background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Select */
.input-group .input-group-btn select{
background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Button */
.input-group .input-group-btn .btn{
background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
/* Button */
.input-group .input-group-btn .btn{
 border-top-left-radius:0px !important;
 border-bottom-left-radius:0px !important;
}

/* Input */
.form-inline .input-group input[type=text]{
 border-top-right-radius:0px !important;
 border-bottom-right-radius:0px !important;
}

@media (max-width:767px){

 /* Button */
 .container-fluid .form-inline .input-group .input-group-btn .btn{
  left:-146px !important;
 }
 
}

@media (max-width:500px){

 /* Button */
 .input-group .input-group-btn .btn{
  border-top-right-radius:0px;
  border-bottom-right-radius:0px;
 }
 
 /* Input */
 .form-inline .input-group input[type=text]{
  border-bottom-left-radius:0px !important;
  border-bottom-right-radius:0px;
  border-top-left-radius:0px !important;
 }
 
}
/* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Modal header */
#setDiscountModal .modal-dialog .modal-header{
 font-size:18px;
 height:53px;
}

/* Set discount modal label */
#setDiscountModalLabel{
 font-size:18px;
 font-family:'Inter', sans-serif;
}

/* Span Tag */
#setDiscountModal .close span{
 position:relative;
 top:-20px;
}

/* Modal body */
#setDiscountModal .modal-dialog .modal-body{
 font-family:'Inter', sans-serif;
}

/* Discount percentage */
#discount_percentage{
 background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Discount type */
#discount_type{
 background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}


/* Button */
#discountForm .btn-primary{
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
#discountForm .btn-primary:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
@media (max-width:500px){

 /* Button */
 .container-fluid .form-inline .input-group .input-group-btn .btn{
  left:-140px !important;
 }
 
}
@media (max-width:500px){

 /* Input */
 .container-fluid .form-inline .input-group input[type=text]{
  border-top-left-radius:8px !important;
  border-bottom-left-radius:8px !important;
 }
 
 /* Select */
 .container-fluid .form-inline .input-group .input-group-btn select{
  border-top-right-radius:8px !important;
  border-bottom-right-radius:8px !important;
 }
 
 /* Input group */
 .form-inline .input-group .input-group-btn{
  border-top-right-radius:8px !important;
  border-bottom-right-radius:8px !important;
 }
 
}

/* Sorting arrows */
.sortable {
    cursor: pointer;
}

.sortable i {
    margin-left: 5px;
}
</style>
<style>
.tooltip-container {
  position: relative;
  display: inline-block;
}

.tooltip-container .tooltip-text {
  visibility: hidden;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px;
  border-radius: 5px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 50%;
  transform: translateX(-50%);
  white-space: nowrap;
}

.tooltip-container:hover .tooltip-text {
  visibility: visible;
}
/* Colorful icons */
.icon-whatsapp {
    color: #25D366 !important;
}

.icon-telegram {
    color: #0088cc !important;
}
/* Tooltip container */
.table tr .tooltip-container{
 font-size:14px;
}
/* Font Icon */
.table tr .fa-google{
 position:relative;
 
}
@media (max-width:500px){

 /* Button */
 .input-group .input-group-btn .btn{
  border-top-color:rgba(255,255,255,0);
  border-right-color:rgba(221,221,221,0);
  border-bottom-color:rgba(221,221,221,0);
  border-left-color:rgba(221,221,221,0);
  border-color:rgba(73,73,73,0);
  box-shadow:0px 2px 4px 0px rgba(0,0,0,0) inset !important;
 }
 
}
/* Font Icon */
#clientsTable tr .fa-google{
 font-size:14px;
}

/* Font Icon */
#clientsTable tr .icon-whatsapp{
 font-size:17px;
 position:relative;
 top:1px;
}

/* Tooltip container */
#clientsTable tr .tooltip-container{
 font-size:14px;
}

/* Font Icon */
#clientsTable tr .icon-telegram{
 font-size:17px;
 position:relative;
 top:1px;
}
/* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Swal2 popup */
.swal2-container .swal2-popup{
 font-family:'Inter', sans-serif;
}
div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
    background: linear-gradient(145deg, #0069d9, #0056b3) !important;
    color: #ffffff !important;
    padding: 14px 28px !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    border: none !important;
    border-radius: 5px !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3) !important;
    transition: background 0.3sease, transform 0.2sease !important;
}
div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel {
     background: linear-gradient(145deg, #c71f1f, #e04d4d) !important ;
    color: #ffffff !important; 
    padding: 14px 28px !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    border: none !important;
    border-radius: 5px !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3) !important;
    transition: background 0.3sease, transform 0.2sease !important;
}

/* Table Data */
#clientsTable tr td{
 text-align:left;
 padding-left:10px !important;
 padding-right:10px !important;
}

/* Th */
#clientsTable tr th{
 text-align:left;
 padding-left:10px;
 padding-right:10px;
}

/* Font Icon */
#clientsTable tr .icon-whatsapp{
 padding-left:0px;
 padding-right:0px;
 padding-top:0px;
 padding-bottom:0px;

}
/* Font Icon */
#clientsTable tr .icon-telegram{
 font-size:15px !important;
}

/* Font Icon */
#clientsTable tr .icon-whatsapp{
 font-size:16px !important;
}




</style>

<div class="container-fluid">
     <form class="mb-4">
<div class="dropdown">
<button type="button" class="btn btn-primary" data-toggle="dropdown">Options</button>
<ul class="dropdown-menu">
    <li>
        <a class="p-b m-r" type="button" data-toggle="modal" data-target="#modalDiv" data-action="new_user">Add User</a>
        <a class="p-b m-r" type="button" data-toggle="modal" data-target="#modalDiv" data-action="export_user">Export Users</a>
        <a class="p-b m-r" type="button" data-toggle="modal" data-target="#modalDiv" data-action="all_numbers">Contact Information</a>
        <a class="p-b m-r" type="button" data-toggle="modal" data-target="#modalDiv" data-action="details">More Details</a>
        <a class="p-b m-r" type="button" data-toggle="modal" data-target="#modalDiv" data-action="alert_user">Send Notification</a>
        <a class="p-b m-r" type="button" data-toggle="modal" data-target="#modalDiv" data-action="discount">Set Bulk Discount</a>
          <a class="p-b m-r" type="button" data-toggle="modal" data-target="#modalDiv" data-action="remove_inactive">
            Remove Inactive Users
        </a>
    </li>
</ul>

                </div>

                </form>



<hr>
  <!-- Search form -->
 <form class="form-inline" action="" method="get" enctype="multipart/form-data">
    <div class="input-group">
        <input type="text" name="search" class="form-control" value="<?=$search_word?>" placeholder="Search">
        <span class="input-group-btn">
            <select class="form-control search-select" name="search_type">
                <option value="username" <?php if( $search_where == "username" ): echo 'selected'; endif; ?> >Username</option>
                <option value="name" <?php if( $search_where == "name" ): echo 'selected'; endif; ?> >Name</option>
                <option value="email" <?php if( $search_where == "email" ): echo 'selected'; endif; ?> >Email</option>
                <option value="telephone" <?php if( $search_where == "telephone" ): echo 'selected'; endif; ?> >Phone No.</option>
            </select>
            <button type="submit" class="btn btn-default"><span class="fa fa-search" aria-hidden="true"></span></button>
        </span>
    </div>
</form>


  <!-- Clients table -->
  <div class="clients-table table-responsive">
    <table class="table" id="clientsTable">
      <thead>
        <tr>
        <th>
    <a href="<?php echo site_url("$rentaladmin/clients?sort=id&order=" . ($order === 'asc' ? 'desc' : 'asc')) ?>">
        ID <i class="fa <?= ($sortColumn === 'id' ? ($order === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort') ?>"></i>
    </a>
</th>

<th>Username</th>
<th>Email</th>

<th>
    <a href="<?php echo site_url("$rentaladmin/clients?sort=balance&order=" . ($order === 'asc' ? 'desc' : 'asc')) ?>">
        Balance <i class="fa <?= ($sortColumn === 'balance' ? ($order === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort') ?>"></i>
    </a>
</th>

<th>
    <a href="<?php echo site_url("$rentaladmin/clients?sort=spent&order=" . ($order === 'asc' ? 'desc' : 'asc')) ?>">
        Spent <i class="fa <?= ($sortColumn === 'spent' ? ($order === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort') ?>"></i>
    </a>
</th>
<?php if ($settings['rank_display'] == 2): ?>
  <th>Rank</th>
<?php endif; ?>

<th>Orders</th>

<th>Discount</th>
<th>Registered Date</th>
<th>Last Login</th>
<th>Location</th>
<th></th>

        </tr>
      </thead>
      <tbody>
        <?php foreach($clients as $client): ?>
                  <tr class="<?= ($client["client_type"] == 1 ? 'grey' : '') ?>">
                    <td><?= $client["client_id"] ?></td>
                    <td>
                      <a href="<?php echo site_url("$rentaladmin/clients/view/" . $client['client_id']) ?>" style="color: #0069d9;">
                        <?= $client["username"] ?>
                      </a>
                   
                    </td>
 <td>
                            <?= $client["email"] ?>
                            <br>
                            <?php if(!empty($client["name"])): ?>
    <span class="tooltip-container">
        <i class="fas fa-user-circle icon-profile"></i>
        <span class="tooltip-text"><?= htmlspecialchars($client["name"]) ?></span>
    </span>
<?php endif; ?>

                           <?php if($client["email_type"] == "2"): ?>
                           <span class="tooltip-container">
                                    <i style="color:#DB4437;" class="fab fa-google"></i>
                                    <span class="tooltip-text">Verified by Google</span>
                                </span>
    
<?php endif; ?>

                            <?php if(!empty($client["telephone"])): ?>
                                <span class="tooltip-container">
                                    <i class="fab fa-whatsapp icon-whatsapp"></i>
                                    <span class="tooltip-text"><?= $client["telephone"] ?></span>
                                </span>
                                

                            <?php endif; ?>
                            <?php if(!empty($client["chat_id"])): ?>
                                <span class="tooltip-container">
                                    <i class="fab fa-telegram icon-telegram"></i>
                                    <span class="tooltip-text"><?= $client["chat_id"] ?></span>
                                </span>
                            <?php endif; ?>
                        </td>



                    <td>
                      <div style="width:85px;">
                        <?php echo format_amount_string($settings["site_base_currency"], $client["balance"]); ?>
                      </div>
                    </td>
                    <td>
                      <div style="width:85px;">
                        <?php echo format_amount_string($settings["site_base_currency"], $client["spent"]); ?>
                      </div>
                    </td>
                    <?php if ($settings['rank_display'] == 2): ?>
                    <td>
                      
                        <?php echo $client["rank_name"] ?>
                      
                    </td>
                    <?php endif; ?>
                    <td><?php echo countRow(["table" => "orders", "where" => ["client_id" => $client["client_id"]]]); ?></td>
                    <td>
                      <button type="button" class="btn btn-default btn-xs disabled" style="cursor:pointer;" data-toggle="modal" data-target="#modalDiv" data-id="<?php echo $client["client_id"] ?>" data-action="set_discount_percentage">Discount (<?php echo $client["discount_percentage"]; ?>%)</button>
                    </td>


 <td width =10%>
    <?php 
        echo str_replace(["am", "pm"], ["AM", "PM"], date('j M Y, g:i a', strtotime($client["register_date"])));
    ?>
</td>
<td>
    <?php 
        if (!empty($client["login_date"])) {
            echo str_replace(["am", "pm"], ["AM", "PM"], date('j M Y, g:i a', strtotime($client["login_date"])));
        } else {
            echo ""; // Leave blank if null
        } 
    ?> 
</td>

<td>
<?php if (!empty($client["login_ip"])): ?>
    <div class="loc-data" data-ip="<?= $client["login_ip"] ?>">
        <?= $client["login_ip"] ?><br>
        <small class="text-muted geo-info" id="geo-<?= $client["client_id"] ?>">Loading location...</small>
    </div>
<?php endif; ?>
</td>






 <td class="td-caret">
 <div class="dropdown pull-right">
   <button type="button" class="btn btn-primary btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">
    <i class="fas fa-ellipsis-h"></i>
</button>

   <ul class="dropdown-menu">
       <li>
  <a class="dcs-pointer" data-toggle="modal" data-target="#modalDiv" data-action="edit_user" data-id="<?=$client["client_id"]?>">Edit User</a>
       </li>
       <li>
  <a class="dcs-pointer" data-toggle="modal" data-target="#modalDiv" data-action="pass_user" data-id="<?=$client["client_id"]?>">Change Password</a>
       </li>
       <li>
  <a href="<?php echo site_url("$rentaladmin/clients/change_apikey/".$client["client_id"]) ?>">Set New API Key</a>
       </li>
       <?php if( $client["client_type"] == 1 ): $type = "active"; else: $type = "deactive"; endif; ?>
       <li>
  <a href="<?php echo site_url("$rentaladmin/clients/".$type."/".$client["client_id"]) ?>"><?php if( $client["client_type"] == 1 ): echo "Activate"; else: echo "Deactivate"; endif; ?> Account</a>
       </li>
       
       <li>
  <a href="<?php echo site_url("$rentaladmin/clients/del_price/".$client["client_id"]) ?>">Reset Special Pricing</a>
       </li>
<li>
                <a class="dcs-pointer client-report-btn" data-toggle="modal" data-target="#modalDiv" data-id="<?php echo $client["client_id"] ?>" data-action="client_report">
                    Client Report
                </a>
            </li>




   </ul>
 </div>
 </td>
      </tr>
  <?php endforeach; ?>
</tbody>
</table>
</div>

   <?php if( $paginationArr["count"] > 1 ): ?>
     <div class="row">
        <div class="col-sm-8">
  <nav>
 <ul class="pagination">
 <?php if( $paginationArr["current"] != 1 ): ?>
  <li class="prev"><a href="<?php echo site_url("$rentaladmin/clients/1".$search_link) ?>">&laquo;</a></li>
  <li class="prev"><a href="<?php echo site_url("$rentaladmin/clients/".$paginationArr["previous"].$search_link) ?>">&lsaquo;</a></li>
  <?php
      endif;
      for ($page=1; $page<=$pageCount; $page++):
        if( $page >= ($paginationArr['current']-9) and $page <= ($paginationArr['current']+9) ):
  ?>
  <li class="<?php if( $page == $paginationArr["current"] ): echo "active"; endif; ?> "><a href="<?php echo site_url("$rentaladmin/clients/".$page.$search_link) ?>"><?=$page?></a></li>
  <?php endif; endfor;
        if( $paginationArr["current"] != $paginationArr["count"] ):
  ?>
  <li class="next"><a href="<?php echo site_url("$rentaladmin/clients/".$paginationArr["next"].$search_link) ?>" data-page="1">&rsaquo;</a></li>
  <li class="next"><a href="<?php echo site_url("$rentaladmin/clients/".$paginationArr["count"].$search_link) ?>" data-page="1">&raquo;</a></li> 
  <?php endif; ?>
 </ul>
  </nav>
        </div>
     </div>
   <?php endif; ?>
</div></div>
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



<script>
  function showInfo(info) {
    alert(info);
  }
</script>


<script>
/**
 * Naza Host - Anti-Block Geo Location Fix
 * Sequence: [Flag] Country, State, City
 */
document.addEventListener("DOMContentLoaded", function() {
    const locElements = document.querySelectorAll('.loc-data');

    const fetchMasterGeo = async (el, ip, attempt = 0) => {
        const infoBox = el.querySelector('.geo-info');
        
        // Anti-Block API List (Hosting compatible)
        const sources = [
            `https://ipapi.co/${ip}/json/`, 
            `https://ip-api.com/json/${ip}?fields=status,country,countryCode,regionName,city`,
            `https://freeipapi.com/api/json/${ip}`
        ];

        if (attempt >= sources.length) {
            infoBox.innerHTML = "<i class='fa fa-lock'></i> Location Private";
            return;
        }

        try {
            const response = await fetch(sources[attempt], {
                method: 'GET',
                mode: 'cors', // Fix for Hosting Privacy/CORS
                headers: { 'Accept': 'application/json' }
            });

            const data = await response.json();

            // Mapping for all API types
            const country = data.country || data.country_name || data.countryName || "";
            const state = data.regionName || data.region || data.region_name || "";
            const city = data.city || data.cityName || "";
            const code = (data.countryCode || data.country_code || "").toLowerCase();

            if (country && code) {
                const flagUrl = `https://flagcdn.com/w20/${code}.png`;
                // Final Professional Format: [Flag] Country, State, City
                infoBox.innerHTML = `<img src="${flagUrl}" width="16" style="vertical-align:middle; margin-right:6px; border-radius:2px;"> ${country}, ${state}, ${city}`;
            } else {
                throw new Error("Retry_Next");
            }
        } catch (err) {
            // Agar ek block ho toh turant dusri API try kare bina page freeze kiye
            fetchMasterGeo(el, ip, attempt + 1);
        }
    };

    // Admin Fast Load Logic: 180ms delay per row (Firewall Safe)
    locElements.forEach((el, index) => {
        const ip = el.getAttribute('data-ip');
        if (ip && ip.length > 6 && ip !== '127.0.0.1' && ip !== '::1') {
            setTimeout(() => fetchMasterGeo(el, ip), index * 180);
        } else {
            el.querySelector('.geo-info').innerHTML = "<i class='fa fa-desktop'></i> System Access";
        }
    });
});
</script>
<?php include 'footer.php'; ?>

<?php include 'header.php';?>
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

    background: linear-gradient(145deg, #0069d9, #0056b3); /* Blue gradient background */
    color: #ffffff;
   
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

.table tr .btn-xs-caret{
    width:100%;

    background: linear-gradient(145deg, #0069d9, #0056b3); /* Blue gradient background */
    color: #ffffff;
   
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;

}
.table tr .btn-xs-caret:hover {
    background: linear-gradient(145deg, #0056b3, #004494); /* Darker gradient on hover */
   transform: translateY(-2px); /* Slight lift effect */

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
.nav-tabs .p-b .btn{
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


.nav-tabs .p-b .btn:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}



/* Dropdown menu */
.nav-tabs .p-b .dropdown-menu{
 width:100%;
}

/* Link */
.nav-tabs .p-b a{
 background-color:#ffffff;
 color:#5a5a5a;
}
/* Link */
.nav-tabs .p-b a{
 padding-left:28px;
 padding-right:28px;
 padding-top:14px;
 padding-bottom:14px;
}

.nav-tabs .p-b a:hover {
    color:#fff;
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Span Tag */
.swal2-icon-error .swal2-error > span{
 display:none;
}

/* Swal2 error */
.swal2-container .swal2-icon-error .swal2-error{
 display:none !important;
}

/* Swal2 icon error */
.swal2-container .swal2-icon-error{
 font-family:'Inter', sans-serif;
}

/* Swal2 confirm */
.swal2-icon-error .swal2-actions .swal2-confirm{
 background: linear-gradient(145deg, #007bff, #0056b3); /* Light gradient */
    color: #ffffff;
    padding: 14px 28px;
    height:unset;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
}
.swal2-icon-error .swal2-actions .swal2-confirm:hover {
    color:#fff;
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Heading */
.swal2-container .swal2-icon-error h2{
 text-transform:capitalize;
}
/* Button */
.form .modal-body .dropdown-toggle{
 background-color:rgba(255,255,255,0);
 border-style:none;
}
.form .modal-body .dropdown-toggle:active {
     background-color:rgba(255,255,255,0);
 border-style:none;
}
/* Button */
.form .modal-footer .btn:nth-child(2){
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
.form .modal-footer .btn:nth-child(2):hover {
  background: linear-gradient(145deg, #e04d4d, #f76c6c); /* Darker gradient on hover */
  transform: translateY(-2px); /* Slight lift effect */
}

/* Form control */
.form .modal-body .form-control{
  display: flex;
    align-items: center;
    background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
.services-table {
    border-radius: 8px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
}
/* Service block  service */
#sticker tr .service-block__service{
 font-weight:600;
 text-align:center;
}

/* Th */
#sticker tr th{
 text-transform:uppercase;
 font-weight:600;
 text-align:center;
}

/* Service block  category title */
.category-sortable .categories .service-block__category-title{
 font-weight:600;
}

/* Service block  minorder */
#servicesTableList .service-sortable .service-block__minorder{
 text-align:center;
 min-width:1px;
}

/* Table Data */
#servicesTableList .service-sortable td{
 text-align:center;
}
/* Dropdown menu */
#servicesTableList .dropdown .dropdown-menu{
 margin-left:0px;
 text-align:left;
 width:200px !important;
 min-width:2px;
}
/* Service block  service */
#servicesTableList .service-sortable .service-block__service{
 text-align:left;
}

/* Service block */
#servicesTableList .service-sortable .service-block__id{
 text-align:left;
}
/* Service block  service */
#sticker tr .service-block__service{
 min-width:4px;
 width:498px;
}
/* Service block  minorder */
#sticker tr .service-block__minorder{
 transform:translatex(-35px) translatey(0px);
}

/* Service block  provider */
#sticker tr .service-block__provider{
 transform:translatex(-35px) translatey(0px);
}

/* Service block  rate */
#sticker tr .service-block__rate{
 transform:translatex(-15px) translatey(0px);
}

/* Service block  minorder */
#sticker tr .service-block__minorder:nth-child(10){
 transform:translatex(0px) translatey(0px);
}

/* Service block  minorder */
#sticker tr .service-block__minorder:nth-child(11){
 transform:translatex(0px) translatey(0px);
}
/* Button */
.category-sortable .categories .service-block__category .in .service-block__packages #servicesTableList .service-sortable .ui-state-default .service-block__action .dropdown .dropdown-toggle{

  background-color: #f0f0f0 !important;
    color: #333333 !important;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85em;
  }



/* Service block  rate */
#sticker tr .service-block__rate{
 transform:translatex(-25px) translatey(0px) !important;
}

/* Service block  minorder */
#sticker tr .service-block__minorder:nth-child(10){
 transform:translatex(-12px) translatey(0px) !important;
}

/* Service block  minorder */
#sticker tr .service-block__minorder:nth-child(11){
 transform:translatex(-12px) translatey(0px) !important;
}

/* Service block  visibility */
#sticker tr .service-block__visibility{
 transform:translatex(-12px) translatey(0px);
}

/* Service block  collapse button */
.category-sortable .categories .service-block__collapse-button{
 text-transform:capitalize;
}

/* Button */
.nav-tabs .pull-right a{
background-color:#eaeaea;
 color:#5a5a5a;
    padding: 14px 28px;
    height:unset !important;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
}
.nav-tabs .pull-right a:hover {
     color:#ffffff;
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Price services */
#priceServices{
 background-color: #e9ecef; /* Light input background */
    border-radius: 8px;
    padding: 12px;
    color: #333; /* Dark text color */
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}
.service-block__collapse-block .service-block__collapse-button:after{
    display:none;
}
/* Action list */
.checkAll-th .action-block .action-list{
 top:1px;
 text-transform:capitalize;
}

/* Button */
.action-list li .dropdown-toggle{
 background-color:#ffffff;
 background-image:none;
 color:#333333;
}

/* List Item */
.action-block .action-list > li{
 color:#333333;
}

/* Button */
#serviceList{
 text-transform:uppercase;
 font-weight:600;
  background-color: #f0f0f0;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
    
}

/* Button */
#sticker .service-block__visibility .dropdown-toggle{
 font-weight:600;
 text-transform:uppercase;
  background-color: #f0f0f0;
    color: #333333;
    border: 1px solid #ccc;
    padding: 6px 12px;
    border-radius: 6px;
   
  }
/* Service block  visibility */
#sticker tr .service-block__visibility{
 position:relative;
 left:18px;
}

/* Service block  minorder */
#sticker tr .service-block__minorder{
 left:26px;
}

/* Service block  provider */
#sticker tr .service-block__provider{
 position:relative;
 left:18px;
}

/* Service block  rate */
#sticker tr .service-block__rate{
 position:relative;
 left:26px;
}
@media (max-width:767px){

 /* Service block  provider */
 #sticker tr .service-block__provider{
  left:55px !important;
 }
 
 /* Service block  provider */
 .container-fluid .services-table .sticker-head #sticker thead tr .service-block__provider{
  right:auto !important;
 }
 
 /* Service block  rate */
 #sticker tr .service-block__rate{
  left:65px !important;
 }
 
 /* Service block  minorder */
 #sticker tr .service-block__minorder:nth-child(10){
  left:60px;
 }
 
 /* Service block  minorder */
 #sticker tr .service-block__minorder:nth-child(11){
  left:36px;
 }
 
 /* Service block  minorder */
 #sticker tr .service-block__minorder:nth-child(7){
  left:72px;
 }
 
 /* Service block  minorder */
 #sticker tr .service-block__minorder:nth-child(6){
  left:90px;
 }
}



/* Service list content */
#serviceListContent{
 text-transform:none;
}

/* Link */
#serviceListContent .active a{

 color:#ffffff !important;
}

/* List */
#sticker .service-block__visibility ul{
 text-transform:capitalize;
}

/* Link */
#sticker .service-block__visibility .active a{
 color:#ffffff !important;
}
/* Service block  provider */
#sticker tr .service-block__provider{
 z-index:1050;
}

/* Service block  visibility */
#sticker tr .service-block__visibility{
 z-index:1050;
}

/* Button */
#assignCategoryForm .modal-body .dropdown-toggle{
 padding-right:0px;
 padding-left:0px;
 padding-top:0px;
 padding-bottom:0px;
 border-style:none;
 box-shadow:0px 3px 0px 0px rgba(0,0,0,0) inset;
}

/* Link */
#assignCategoryForm .active a{
 background-image:none;
 transform:translatex(0px) translatey(0px);
}

/* Glyphicon */
#assignCategoryForm li .glyphicon-ok{
 top:12px;
}

/* Form control */
.container-fluid #modalDiv .modal-dialog .modal-content #modalContent #assignCategoryForm .modal-body .form-group > .form-control{
 width:100% !important;
}


/* Filter option */
#assignCategoryForm .modal-body .filter-option{
 border-left-style:none;
 border-style:none;
 border-width:0px;
}
/* Button */
#confirmYes{
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
#confirmYes:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Button */
.modal-body div .btn:nth-child(2){
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
.modal-body div .btn:nth-child(2):hover {
  background: linear-gradient(145deg, #e04d4d, #f76c6c); /* Darker gradient on hover */
  transform: translateY(-2px); /* Slight lift effect */
}
/* Span Tag */
#modalTitle span{
 background-color:#777777 !important;
}

/* Form group  service name */
#modalContent .modal-body .form-group__service-name{
 text-transform:capitalize;
}

/* Input */
#modalContent .modal-body input[type=text]{
 background-color: #e9ecef;
    border-radius: 8px;
    padding: 12px;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 50px;
}

/* Label */
.iconpicker-div label{
 text-transform:capitalize;
}

/* Button */
#update-category{
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
#update-category:hover {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Button */
#modalContent .modal-body .btn-danger{
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

#modalContent .modal-body .btn-danger:hover {
  background: linear-gradient(145deg, #e04d4d, #f76c6c); /* Darker gradient on hover */
  transform: translateY(-2px); /* Slight lift effect */
}
.tooltip5 {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

.tooltip5 .tooltiptext5 {
    visibility: hidden;
    width: 180px;
    background-color: #333;
    color: #fff;
    text-align: left;
    padding: 5px;
    border-radius: 4px;
    position: absolute;
    z-index: 10;
    bottom: 125%; /* Position above the icon */
    left: 50%;
    margin-left: -90px;
    opacity: 0;
    transition: opacity 0.2s;
}

.tooltip5:hover .tooltiptext5 {
    visibility: visible;
    opacity: 1;
}
/* Service block  service */
#servicesTableList .service-sortable .service-block__service{
 min-width:34px;
}

/* Service block  service */
.container-fluid .services-table .service-block__body .service-block__body-scroll #changebulkForm .category-sortable .categories .service-block__category .in .service-block__packages #servicesTableList .service-sortable .ui-state-default .service-block__service{
 width:400px !important;
}

/* Service block  service */
#sticker tr .service-block__service{
 width:400px !important;
}

#sticker tr th:nth-child(4){
 display:none;
}

/* Service block  minorder */
#sticker tr .service-block__minorder{
 left:56px !important;
}


#sticker tr .service-block__provider {
    position: relative;
    left: 45px !important;
}
#sticker tr .service-block__rate {
    position: relative;
    left: 40px!important;
}
/* Service block  rate */
.container-fluid .services-table .service-block__body .service-block__body-scroll #changebulkForm .category-sortable .categories .service-block__category .in .service-block__packages #servicesTableList .service-sortable .ui-state-default .service-block__rate{
 width:1% !important;
}


</style>
<div class="container-fluid">
    <ul class="nav nav-tabs nav-tabs__service">
        <br>
        <li class="p-b"><button class="btn btn-default" data-toggle="modal" data-target="#modalDiv" data-action="new_service">New Service</button></li>
        <li class="p-b"><button class="btn btn-default m-l" data-toggle="modal" data-target="#modalDiv" data-action="new_subscriptions">New Subscription</button></li>
        <li class="p-b"><button class="btn btn-default m-l" data-toggle="modal" data-target="#modalDiv" data-action="new_category">New Category</button></li>
        
    
<style>.dropdown-item{cursor:pointer},.dropdown-item.ab,.dropdown-item.ab:hover{background-color:#007bff}.dropdown-togglel::after{content:"\25BC";margin-left:5px;font-size:10px}.dropdown-menu .dropdown-item{padding:8px 20px;color:#fff;text-decoration:none;display:block;margin:2px;border-radius:1px}.dropdown-menu a:focus,a:hover{color:#fff;text-decoration:underline}.dropdown-item.abc,.dropdown-item.abc:hover{background-color:#e54034}</style>
<li class="m-l p-b" class="dropdown">
    <button class="btn btn-primary dropdown-togglel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Choose More Actions 
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
   <a class="dropdown-item ab" data-toggle="modal" data-target="#modalDiv" data-action="assign_category">
    Assign Categories
</a>


 <a class="dropdown-item ab" data-toggle="modal" data-target="#modalDiv" data-action="delete_categories">
    Delete Categories
</a>


       
 <a class="dropdown-item ab" data-toggle="modal" data-target="#modalDiv" data-action="sync_services">
    Set Services Rate
</a>
<a class="dropdown-item ab" data-toggle="modal" data-target="#modalDiv" data-action="set_auto_avg_time">
    Set / Reset Average Time
</a>

 <a class="dropdown-item ab" data-toggle="modal" data-target="#modalDiv" data-action="auto_cat_icon">
    Auto Assign / Remove Category Icons
</a>
<a class="dropdown-item ab" data-toggle="modal" data-target="#modalDiv" data-action="duplicate_services">
    Find & Remove Duplicate Services
</a>


<a class="dropdown-item ab" data-toggle="modal" data-target="#modalDiv" data-action="rate_sort">
    Sort Services
</a>

    </div>
</li>









                        
                        
                        
<li class="pull-right">
<a class="btn btn-primary" href="<?= site_url("$rentaladmin/api-services") ?>"><i class="fas fa-plus-circle"></i> Import Services</a>
        </li>



     


<li class="pull-right">
<style>#priceServices {padding: 6px 24px 6px 15px;}</style>
<div class="form-inline">

 
<input class="form-control" placeholder="Search" id="priceServices" type="text" value="">
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>$("#priceServices").on("keyup",function(){var e=$(this).val().toUpperCase();$('[data-id^="service-"]').each(function(){var t=$(this).find(".service-block__id").text(),i=$(this).attr("data-service"),s=$(this).attr("data-category");i.toUpperCase(),i.toUpperCase().indexOf(e)>-1||t.toUpperCase().indexOf(e)>-1?($(this).show(),$(this).attr("id","serviceshow"+s)):($(this).hide(),$(this).attr("id","servicehide"))}),$('[id^="Servicecategory-"]').each(function(){var e=$(this).attr("data-id");0==$("#servicesTableList > tbody > tr#serviceshow"+e).length?$("#"+e).hide():$("#"+e).show()})});</script>
</li>


    </ul>
    <ul></ul>
   <div class="services-table">
        <div class="sticker-head">
            <table class="service-block__header" id="sticker">
                <thead>
<th class="checkAll-th service-block__checker null">
    <div class="checkAll-holder">
        <input type="checkbox" id="checkAll">
        <input type="hidden" id="checkAllText" value="order">
    </div>
    <div class="action-block">
        <ul class="action-list">
            <li><span class="countOrders"></span> Services Selected</li>
            <li>
                <div class="dropdown">
<button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Batch Operations<span class="caret"></span></button>
<ul class="dropdown-menu">
    <li>
    <li>
    <li>
        <a class="bulkorder" data-type="active">Enable Selected Services</a>
        <a class="bulkorder" data-type="deactive">Disable Selected Services</a>
        <a class="bulkorder" data-type="secret">Make Selected Serivces Secret</a>
        <a class="bulkorder" data-type="desecret">Remove Selected from Secret Serivces</a>
        <a class="bulkorder" data-type="del_price">Delete Selected Services Custom Pricing</a>
        <a class="bulkorder" data-type="del_service">Delete Selected Services</a>
        <a class="bulkorder" data-type="refill-active">Refill Enable Selected Services</a>
        <a class="bulkorder" data-type="refill-inactive">Refill Disable Selected Services</a>
        <a class="bulkorder" data-type="cancel-active">Cancel Enable Selected Services</a>
        <a class="bulkorder" data-type="cancel-inactive">Cancel Disable Selected Services</a>
    </li>
</ul>
                </div>
            </li>
        </ul>
    </div>
</th>
<th class="service-block__id">ID</th>
<th class="service-block__service">Service</th>
<th></th>

<th class="service-block__provider">
    <div class="dropdown">
        <button class="btn btn-th btn-default dropdown-toggle"
                data-active="<?= isset($_GET["id"]) ? htmlspecialchars($_GET["id"], ENT_QUOTES, 'UTF-8') : '' ?>"
                type="button"
                id="serviceList"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
            Provider <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="serviceList" id="serviceListContent">
            <!-- Dropdown content dynamically loaded here -->
        </ul>
    </div>
</th>

<script>
    $(document).ready(function() {
        $("#serviceList").on("click", function () {
            let dropdownContent = $("#serviceListContent");
            let providerURL = "<?= site_url($rentaladmin . '/services/provider') ?>";

            // Load dropdown content dynamically
            $.post(providerURL, function(response) {
                dropdownContent.html(response);
            });
        });
    });
</script>

<th class="service-block__rate">Price</th>
<th class="service-block__minorder">Min</th>
<th class="service-block__minorder">Max</th>
<th class="service-block__visibility">
    
   <div class="dropdown">
<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Status <span style="margin-left:8px;"class="caret"></span></button>
<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
<li class="<?php if( !$_GET["getstatus"] ): echo "active"; endif; ?>"><a href="<?= site_url("$rentaladmin/services") ?>">All (<?php echo countRow(["table"=>"services","where"=>["service_deleted"=>0]]) ?>)</a></li>
<li class="<?php if( $_GET["getstatus"] == "2" ): echo "active"; endif; ?>"><a href="<?= site_url("$rentaladmin/services") ?>?getstatus=2">Enabled (<?php echo countRow(["table"=>"services","where"=>["service_deleted"=>0, "service_type"=>2]]) ?>)</a></li>
<li class="<?php if( $_GET["getstatus"] == "1" ): echo "active"; endif; ?>"><a href="<?= site_url("$rentaladmin/services") ?>?getstatus=1">Disabled (<?php echo countRow(["table"=>"services","where"=>["service_deleted"=>0, "service_type"=>1]]) ?>)</a></li>
</ul></div>
    
</th>
<th class="service-block__action text-right"><span id="allServices" class="service-block__hide-all fa fa-compress"></span></th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="service-block__body">
        <div class="service-block__body-scroll">
            <div style="width: 100%; height: 0px;"></div>


<form action="<?php echo site_url("$rentaladmin/services/multi-action") ?>" method="post" id="changebulkForm">
<div style="" class="category-sortable">
<?php $c = 0; foreach ($serviceList as $category => $services): $c++; ?>
<div class="categories" data-id="<?=$services[0]["category_id"] ?>">
    <div class="<?php if ($services[0]["category_type"] == 1): echo 'grey'; endif; ?>  service-block__category ">
        <div class="service-block__category-title" class="categorySortable" data-category="<?=$category ?>" id="category-<?=$c ?>">
            <div class="service-block__drag handle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
<title>Drag-Handle</title>
<path d="M7 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm6-8c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"></path>
                </svg>
            </div>
<?php if ($services[0]["category_secret"] == 1): echo '<small data-toggle="tooltip" data-placement="top" title="" data-original-title="gizli kategori"><i class="fa fa-lock"></i></small> '; endif; 

if($services[0]["category_type"] == 2){
echo '<span data-post="category_id='.$services[0]["category_id"].'" class="category-visibility category-visible"></span>';
} 
if($services[0]["category_type"] == 1){
echo '<span data-post="category_id='.$services[0]["category_id"].'" class="category-visibility category-invisible"></span>';
} 

$category_icon_array = json_decode($services[0]["category_icon"],true);

$category_icon_type = $category_icon_array["icon_type"];

if($category_icon_type == "image"){

$icon = "<img style=\"margin-right:10px;\" src=\"".$images[$category_icon_array["image_id"]][0]["link"]."\" class=\"img-responsive btn-group-vertical\">";
} elseif($category_icon_type == "icon"){

$icon = "<i style=\"margin-right:10px;font-size:18px;\" class=\"".$category_icon_array["icon_class"]."\" aria-hidden=\"true\"></i>";
} else {
    $icon = "";
    
}


echo '<span class="category-name">'.$icon.$category.'</span>'; ?>
<span style="margin-left:10px;margin-right:10px;font-weight:bold;">|</span>

<!-- Edit Icon (Black Color) -->
<a class="text-dark dcs-pointer edit-icon" 
   data-toggle="modal" 
   data-target="#modalDiv" 
   data-action="edit_category" 
   data-id="<?=$services[0]["category_id"]?>" 
   title="Edit Category">
   <i class="fas fa-edit"></i>
</a>

<!-- Delete Icon (Red) -->
<a class="text-danger delete-icon" 
   href="<?php echo site_url("$rentaladmin/services/del_category/".$services[0]["category_id"]) ?>" 
   data-action="del_category" 
   title="Delete Category">
   <i class="fas fa-trash-alt"></i>
</a>

<style>
    .edit-icon, .delete-icon {
        font-size: 16px; /* Icon size */
        margin-right: 10px;
        transition: all 0.3s ease-in-out;
    }

    /* Black color for edit icon */
    .edit-icon {
        color: #000 !important;
    }

    .edit-icon:hover {
        transform: scale(1.2);
    }

    /* Red color for delete icon */
    .delete-icon:hover {
        color: #dc3545; /* Bootstrap danger red */
        transform: scale(1.2);
    }
</style>


<?php if (!empty($services[0]["service_id"])): ?>

            <div class="service-block__collapse-block">
                <div id="collapedAdd-<?=$c ?>" class="service-block__collapse-button" data-category="category-<?=$c ?>"></div>
            </div>
            <?php endif; ?>
        </div>
        <div class="collapse in">
            <div class="service-block__packages">
                <table id="servicesTableList" class="Servicecategory-<?=$c ?>">
<tbody class="service-sortable">
    <div class="serviceSortable" id="Servicecategory-<?=$c ?>" data-id="category-<?=$c ?>">
        <?php for ($i = 0; $i < count($services); $i++): 
      if($services[$i]["service_deleted"] == 0):
        $api_detail = json_decode($services[$i]["api_detail"], true); ?>
        <tr id="serviceshowcategory-<?=$c ?>" class="ui-state-default <?php if ($services[$i]["service_type"] == 1): echo "grey"; endif; ?>" data-category="category-<?=$c ?>" data-id="service-<?php echo $services[$i]["service_id"] ?>" data-service="<?php echo $services[$i]["service_name"] ?>">
<?php if (!empty($services[0]["service_id"])): ?>
<td class="service-block__checker">
<?php if ($services[$i]["api_servicetype"] == 1): echo '<div class="service-block__danger"></div>'; endif; ?>
<span></span>
<div class="service-block__checkbox">
    <div class="service-block__drag handle">
        <svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Drag-Handle</title>
                <path d="M7 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm6-8c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"></path>
            </svg>
        </svg>
    </div>
    <input type="checkbox" class="selectOrder" name="service[<?php echo $services[$i]["service_id"] ?>]" value="1" style="border:1px solid #fff">
</div>
</td>

<td class="service-block__id"><?php echo $services[$i]["service_id"] ?></td>
<td class="service-block__service"><?php if ($services[$i]["service_secret"] == 1): echo '<small data-toggle="tooltip" data-placement="top" title="" data-original-title="Secret Service"><i class="fa fa-lock"></i></small> '; endif; echo $services[$i]["service_name"]; ?><br><br>

  <span class="badge badge-dark">
    <?php echo servicePackageType($services[$i]["service_package"]); ?>
</span>

    
    <?php 
    // Fetch order stats for this service
    $stmt = $conn->prepare("
        SELECT 
            COUNT(*) AS total,
            SUM(order_status = 'completed') AS completed,
            SUM(order_status = 'pending') AS pending,
            SUM(order_status = 'processing') AS processing,
            SUM(order_status = 'partial') AS partial,
            SUM(order_status = 'inprogress') AS inprogress,
            SUM(order_status = 'canceled') AS canceled
        FROM orders 
        WHERE service_id = ?
    ");
    $stmt->execute([$services[$i]['service_id']]);
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <!-- Info Icon -->
    <div class="tooltip5">
        &nbsp;<i class="fas fa-info-circle"></i>
        <span class="tooltiptext5">
            Total: <?php echo $stats['total']; ?>
            <?php if ($stats['total'] > 0): ?>
                <br>Completed: <?php echo $stats['completed']; ?>
                <br>Pending: <?php echo $stats['pending']; ?>
                <br>Processing: <?php echo $stats['processing']; ?>
                <br>Partial: <?php echo $stats['partial']; ?>
                <br>In Progress: <?php echo $stats['inprogress']; ?>
                <br>Canceled: <?php echo $stats['canceled']; ?>
            <?php endif; ?>
        </span>
    </div><?php if ($services[$i]["time"] != "Not enough data"): ?><div class="tooltip5">
&nbsp;<i class="fas fa-clock"></i><span class="tooltiptext5"><?php echo $services[$i]["time"]; ?> </span>
</div>
<?php endif; ?><?php if ($services[$i]["show_refill"] == "true"): echo '<div  class="tooltip5">&nbsp;<i class="fas fa-sync"></i></span><span class="tooltiptext5" >Refill Button Enabled</span></div>'; endif; ?>
<?php if ($services[$i]["cancelbutton"] == 1): echo '<div  class="tooltip5">&nbsp;<i  class="fas fa-ban"></i></span><span class="tooltiptext5" >Cancel Button Enabled</span></div>'; endif; ?>

</td>



<td class="service-block__provider"><?php if ($services[$i]["service_api"] != 0): echo $services[$i]["api_name"]." <span class=\"badge badge-secondary\">".$services[$i]["currency"]."</span><br><span class=\"label label-api\">".$services[$i]["api_service"]."</span>"; else : echo "Manual"; endif; ?></td>

<td class="service-block__rate">
<?php
$api_price = $api_detail["rate"];
?>
<div style="width:100px;<?php if (!$api_detail["rate"]): echo "Empty"; elseif ($services[$i]["service_api"] != 0 && from_to(get_currencies_array("all"), $settings["site_base_currency"], "INR", $services[$i]["service_price"]) > from_to(get_currencies_array("enabled"), $services[$i]["currency"], "INR", $api_price)):
    echo "color: #38E54D;";
    elseif ($services[$i]["service_api"] != 0 && from_to(get_currencies_array("all"), $settings["site_base_currency"], "INR", $services[$i]["service_price"]) < from_to(get_currencies_array("all"), $services[$i]["currency"], "INR", $api_price)):
echo "color: #D2001A;";elseif($services[$i]["service_api"] != 0 && from_to(get_currencies_array("all"), $settings["site_base_currency"], "INR", $services[$i]["service_price"]) == from_to(get_currencies_array("all"), $services[$i]["currency"], "INR", $api_price)):
echo "color: #FFB200;";
endif;?>">
    <?php if ($settings["site_base_currency"] !== $services[$i]["currency"]) {
        echo "≈ ".format_amount_string($settings["site_base_currency"], $services[$i]["service_price"]);
    } elseif ($settings["site_base_currency"] == $services[$i]["currency"]) {
        echo format_amount_string($settings["site_base_currency"], $services[$i]["service_price"]);
    }
    ?>
</div>
<div class="service-block__provider-value">
    <?php if ($services[$i]["service_api"] != 0 && $api_detail["rate"]):
    if ($settings["site_base_currency"] !== $services[$i]["currency"]) {
        echo "≈ ".format_amount_string($settings["site_base_currency"], from_to(get_currencies_array("all"), $services[$i]["currency"], $settings["site_base_currency"], $api_detail["rate"]));
    } elseif ($settings["site_base_currency"] == $services[$i]["currency"]) {

        echo format_amount_string($settings["site_base_currency"], from_to(get_currencies_array("all"), $services[$i]["currency"], $settings["site_base_currency"], $api_detail["rate"]));

    }
    endif; ?>
</div>
</td>
<td class="service-block__minorder">
<div>
    <?php echo $services[$i]["service_min"] ?>
</div>
<?php if ($services[$i]["service_api"] != 0): echo '<div class="service-block__provider-value">'.$api_detail["min"].'</div>'; endif; ?>
</td>
<td class="service-block__minorder">
<div>
    <?php echo $services[$i]["service_max"] ?>
</div>
<?php if ($services[$i]["service_api"] != 0): echo '<div class="service-block__provider-value">'.$api_detail["max"].'</div>'; endif; ?>
</td>
<td class="service-block__visibility"><?php if ($services[$i]["service_type"] == 1): echo "Disabled"; else : echo "Enabled"; endif; ?> <?php if ($services[$i]["api_servicetype"] == 1): echo '<span class="text-danger" title="Service provider removed service"><span class="fa fa-exclamation-circle"></span></span>'; endif; ?> </td>
<td class="service-block__action">
<div class="dropdown pull-right">
    <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Options <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <li><a style="cursor:pointer;" data-toggle="modal" data-target="#modalDiv" data-action="edit_service" data-id="<?=$services[$i]["service_id"] ?>">Edit Service</a></li>
        <li><a style="cursor:pointer;" data-toggle="modal" data-target="#modalDiv" data-action="edit_service_name" data-id="<?=$services[$i]["service_id"] ?>">Edit Service Name</a></li>
        <li><a style="cursor:pointer;" data-toggle="modal" data-target="#modalDiv" data-action="edit_description" data-id="<?=$services[$i]["service_id"] ?>">Edit Description</a></li>
        <li><a style="cursor:pointer;" data-toggle="modal" data-target="#modalDiv" data-action="edit_time" data-id="<?=$services[$i]["service_id"] ?>">Edit Average Time</a></li>
        <?php if ($services[$i]["service_type"] == 1): $type = "service-active"; else : $type = "service-deactive"; endif; ?>
        <li><a href="<?php echo site_url("$rentaladmin/services/".$type."/".$services[$i]["service_id"]) ?>">Service <?php if ($services[$i]["service_type"] == 1): echo "Activate"; else : echo "Deactivate"; endif; ?></a></li>

        <?php if ($services[$i]["show_refill"] == "true"): $type = "refill-deactive"; else : $type = "refill-active"; endif; ?>
        <li><a href="<?php echo site_url("$rentaladmin/services/".$type."/".$services[$i]["service_id"]) ?>">Refill <?php if ($services[$i]["show_refill"] == "true"): echo "Deactivate"; else : echo "Activate"; endif; ?></a></li>

        <?php if ($services[$i]["cancelbutton"] == 2): $type = "cancelbutton-active"; else : $type = "cancelbutton-deactive"; endif; ?>
        <li><a href="<?php echo site_url("$rentaladmin/services/".$type."/".$services[$i]["service_id"]) ?>">Cancel <?php if ($services[$i]["cancelbutton"] == 1): echo "Deactivate"; else : echo "Activate"; endif; ?></a></li>


        <li><a href="<?php echo site_url("$rentaladmin/services/delete/".$services[$i]["service_id"]) ?>">Delete Service</a></li>
    </ul>
</div>
</td>
<?php endif; ?>
        </tr>
        <?php 
        endif;
        endfor; ?>
    </div>
</tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php
$services = $conn->prepare("SELECT * FROM services LEFT JOIN service_api ON service_api.id = services.service_api WHERE services.category_id=:c_id ORDER BY services.service_line ASC ");
$services -> execute(array("c_id" => 0));
$services = $services->fetchAll(PDO::FETCH_ASSOC);
if ($services):
?>
<div class="service-block__category ">
    <div class="service-block__category-title" class="categorySortable" data-category="notcategory" id="category-0">
        Uncategorized
        <div class="service-block__collapse-block">
            <div id="collapedAdd-0" class="service-block__collapse-button" data-category="category-0"></div>
        </div>
    </div>
    <div class="collapse in">
        <div class="service-block__packages">
            <table id="servicesTableList" class="Servicecategory-0">
                <tbody class="service-sortable">
<div class="serviceSortable" id="Servicecategory-0" data-id="category-0">
    <?php foreach ($services as $service): $api_detail = json_decode($service["api_detail"], true); ?>
    <tr id="serviceshowcategory-0" class="ui-state-default <?php if ($service["service_type"] == 1): echo "grey"; endif; ?>" data-category="category-0" data-id="service-<?php echo $service["service_id"] ?>" data-service="<?php echo mb_convert_encoding($service["service_name"], "UTF-8", "UTF-8") ?>">
        <td class="service-block__checker">
<!-- <div class="service-block__danger"></div> //Servis diğer sitede pasifse burayı aktif et-->
<span></span>
<div class="service-block__checkbox">
<div class="service-block__drag handle">
    <svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <title>Drag-Handle</title>
            <path d="M7 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm6-8c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"></path>
        </svg>
    </svg>
</div>
<input type="checkbox" class="selectOrder" name="service[<?php echo $service["service_id"] ?>]" value="1" style="border:1px solid #fff">
</div>
        </td>
        <td class="service-block__id"><?php echo $service["service_id"] ?></td>
        <td class="service-block__service"><?php if (mb_convert_encoding($service["service_secret"], "UTF-8", "UTF-8") == 1): echo '<small data-toggle="tooltip" data-placement="top" title="" data-original-title="Secret service"><i class="fa fa-lock"></i></small> '; endif; echo mb_convert_encoding($service["service_name"], "UTF-8", "UTF-8"); ?></td>
        <td class="service-block__type" nowrap=""><?php echo servicePackageType($service["service_package"]); ?></td>
        <td class="service-block__provider"><?php if ($service["service_api"] != 0): echo $service["api_name"]; else : echo "Manual"; endif; ?></td>
        <td class="service-block__rate">
<?php
if ($api_detail["currency"] == "USD"):
$api_price = $api_detail["rate"];
endif;
?>
<div style="<?php if ($service["service_api"] != 0 && $service["service_price"] > $api_price): echo "color: green"; elseif ($service["service_api"] != 0 && $service["service_price"] < $api_price): echo "color: red"; endif ?>">
<?php echo $service["service_price"] ?>
</div>
<?php if ($service["service_api"] != 0): echo '<div class="service-block__provider-value"><i class="fa fa-'.strtolower($api_detail["currency"]).'"></i> '.priceFormat($api_detail["rate"]).'</div>'; endif; ?>
        </td>
        <td class="service-block__minorder">
<div>
<?php echo $service["service_min"] ?>
</div>
<?php if ($service["service_api"] != 0): echo '<div class="service-block__provider-value">'.$api_detail["min"].'</div>'; endif; ?>
        </td>
        <td class="service-block__minorder">
<div>
<?php echo $service["service_max"] ?>
</div>
<?php if ($service["service_api"] != 0): echo '<div class="service-block__provider-value">'.$api_detail["max"].'</div>'; endif; ?>
        </td>
        <td class="service-block__visibility"><?php if ($service["service_type"] == 1): echo "Deactive"; else : echo "Active"; endif; ?> </td>
        <td class="service-block__action">
<div class="dropdown pull-right">
<button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Options <span class="caret"></span></button>
<ul class="dropdown-menu">
    <li><a style="cursor:pointer;" data-toggle="modal" data-target="#modalDiv" data-action="edit_service" data-id="<?=$service["service_id"] ?>">Edit Service</a></li>
    <li><a style="cursor:pointer;" data-toggle="modal" data-target="#modalDiv" data-action="edit_description" data-id="<?=$service["service_id"] ?>">Edit Description</a></li>
    <?php if ($service["service_type"] == 1): $type = "service-active"; else : $type = "service-deactive"; endif; ?>
    <li><a href="<?php echo site_url("$rentaladmin/services/".$type."/".$service["service_id"]) ?>">Service <?php if ($service["service_type"] == 1): echo "Enable"; else : echo "Disable"; endif; ?></a></li>
    <li><a href="<?php echo site_url("$rentaladmin/services/del_price/".$service["service_id"]) ?>">Delete Price</a></li>
    <li><a href="<?php echo site_url("$rentaladmin/services/delete/".$services[$i]["service_id"]) ?>">Delete Service</a></li>
</ul>
</div>
        </td>
    </tr>
    <?php endforeach; ?>
</div>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php endif; ?>
</div>

<input type="hidden" name="bulkStatus" id="bulkStatus" value="-1">
            </form>
        </div>
    </div>
    
</div>



<?php if( $paginationArr["count"] > 1 ): ?>
     <div class="row">
        <div class="col-sm-8">
  <nav>
 <ul class="pagination">
 <?php if( $paginationArr["current"] != 1 ): ?>
  <li class="prev"><a href="<?php echo site_url("$rentaladmin/services/1".$search_link) ?>">&laquo;</a></li>
  <li class="prev"><a href="<?php echo site_url("$rentaladmin/services/".$paginationArr["previous"].$search_link) ?>">&lsaquo;</a></li>
  <?php
      endif;
      for ($page=1; $page<=$pageCount; $page++):
        if( $page >= ($paginationArr['current']-9) and $page <= ($paginationArr['current']+9) ):
  ?>
  <li class="<?php if( $page == $paginationArr["current"] ): echo "active"; endif; ?> "><a href="<?php echo site_url("$rentaladmin/services/".$page.$search_link) ?>"><?=$page?></a></li>
  <?php endif; endfor;
        if( $paginationArr["current"] != $paginationArr["count"] ):
  ?>
  <li class="next"><a href="<?php echo site_url("$rentaladmin/services/".$paginationArr["next"].$search_link) ?>" data-page="1">&rsaquo;</a></li>
  <li class="next"><a href="<?php echo site_url("$rentaladmin/services/".$paginationArr["count"].$search_link) ?>" data-page="1">&raquo;</a></li> 
  <?php endif; ?>
 </ul>
  </nav>
        </div>
     </div>
   <?php endif; ?>





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
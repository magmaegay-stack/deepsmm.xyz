<!doctype html>

<html>

<head>
  <base href="<?php echo site_url(); ?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title><?php echo htmlspecialchars($settings['site_name']); ?> Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css"/>
  <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">

  <link href="<?php echo site_url("public/admin/css/tom-select.bootstrap5.min.css"); ?>" rel="stylesheet">
  <link rel="stylesheet" href="public/admin/iziToast.min.css">
  <link rel="stylesheet" href="<?php echo site_url("public/admin/css/fancyselect.css"); ?>">
  <link rel="stylesheet" href="public/admin/css/rwd-table.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  
  <style>
  /* Open Unknowndown */

  /* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family:'Inter', sans-serif;
      font-size: 1rem;
      line-height: 1.5;
    }

    input,
    textarea,
    button,
    select,
    a,
    div {
      -webkit-tap-highlight-color: transparent;
    }

    header {
      width: 100%;
    }
    header .mobile-nav-close-btn{
 position:relative;
}
/* Mobile nav close */
header .mobile-nav-close-btn{
 top:20px;
}



    .mobile-nav-close-btn {
      position: fixed;
      z-index: 5;
      top: 15px;
      left: 18px;
      cursor: pointer;
      -webkit-transition: left 500ms cubic-bezier(0.6, 0.05, 0.28, 0.91);
      transition: left 500ms cubic-bezier(0.6, 0.05, 0.28, 0.91);
    }

    .mobile-nav-close-btn div {
      width: 35px;
      height: 2px;
      margin-bottom: 8px;
      background-color: #e0e0e0;
      -webkit-transition: -webkit-transform 500ms cubic-bezier(0.6, 0.05, 0.28, 0.91), opacity 500ms, box-shadow 250ms, background-color 500ms;
      transition: transform 500ms cubic-bezier(0.6, 0.05, 0.28, 0.91), opacity 500ms, box-shadow 250ms, background-color 500ms;
    }

    .mobile-nav-close-btn.active {
      left: 210px;
    }

    .mobile-nav-close-btn.active div {
      background-color: #fff;
      color: #fff;
    }


    .mobile-nav-close-btn.active .bar-top {
      -webkit-transform: translateY(10px) rotate(-135deg);
      -ms-transform: translateY(10px) rotate(-135deg);
      transform: translateY(10px) rotate(-135deg);
    }

    .mobile-nav-close-btn.active .bar-middle {
      -webkit-transform: scale(0);
      -ms-transform: scale(0);
      transform: scale(0);
    }

    .mobile-nav-close-btn.active .bar-bottom {
      -webkit-transform: translateY(-10px) rotate(-45deg);
      -ms-transform: translateY(-10px) rotate(-45deg);
      transform: translateY(-10px) rotate(-45deg);
    }

    .mobile-navbar {
      position: fixed;
      z-index: 4;
      top: 0px;
      left: -260px;
      width: 260px;
      opacity: 0;
      padding: 20px 0px;
      height: 100%;
      background-color: #1e1e1e;
      color: #fff;
      -webkit-transition: all 350ms cubic-bezier(0.6, 0.05, 0.28, 0.91);
      transition: all 350ms cubic-bezier(0.6, 0.05, 0.28, 0.91);
    }

    .mobile-navbar.active {
      left: 0px;
      opacity: 1;
    }

    .mobile-navbar .logo-details {
      margin-left: 0.5rem;
      margin-top: -0.5rem;
    }

    .mobile-navbar .logo-details .logo_name {
      font-size: 1rem;
      font-weight: 600;
      font-family: Arial,
        Helvetica, sans-serif;
      background: linear-gradient(to right, #f32170, #ff6b08,
          #cf23cf, #eedd44);
      -webkit-text-fill-color: transparent;
      background-clip: text;
      -webkit-background-clip: text;
      color: #11101d;
      text-transform: uppercase;
      margin-left: 1rem;

    }

    .mobile-navbar .nav-list {

      margin-top: 1rem;
      height: 100%;
      padding: 1rem;
      overflow-y: scroll;
    }

    .mobile-navbar li {
      position: relative;
      list-style: none;
      margin-bottom: 0.3rem;
    }

    .mobile-navbar .search-nav-input {
      font-size: 15px;
      color: #FFF;
      font-weight: 400;
      outline: none;
      height: 50px;
      width: 100%;
      width: 50px;
      border: none;
      border-radius: 12px;
      transition: all 0.5s ease;
      background: #1d1b31;
    }

    .mobile-navbar .search-nav-input {
      padding: 0 20px 0 50px;
      margin-bottom: 1rem;
      width: 100%;
    }

    .mobile-navbar .search-nav-input-icon {
      position: absolute;
      top: 50%;
      left: 10px;
      transform: translateY(-50%);
      font-size: 18px;
      background: #1d1b31;
      color: #FFF;
    }

    .mobile-navbar li:not(.search-box-li) {
      padding-left: 0.4rem;
      padding-right: 0.4rem;
      padding-top: 0.6rem;
      padding-bottom: 0.6rem;
      border: none;
      border-radius: 8px;
      transition: background-color 0.3s;
      cursor: pointer;
    }

    .mobile-navbar li:hover:not(.search-box-li) {
      background-color: rgb(29, 27, 49);
      color: #fff;
    }

    .mobile-navbar li.open-dropdown:not(.search-box-li) {
      background-color: rgb(29, 27, 49);
      color: #fff;
    }

    .mobile-navbar li a .arrow {
      float: right;
      margin-top: 6px;
      margin-right: 2px;
      transition: transform 0.2s;
    }

    .mobile-navbar li .content {
      display: none;
    }

    .mobile-navbar li .content a {
      padding-left: 1rem;
      padding-right: 0.2rem;
      padding-top: 0.4rem;
      padding-bottom: 0.4rem;
      margin-bottom: 0.2rem;
      border: none;
      border-radius: 8px;
      transition: background-color 0.3s;
      cursor: pointer;
    }

    .mobile-navbar li .content a:nth-child(1) {
      margin-top: 0.3rem;
    }

    .mobile-navbar li .content a:hover {
      background-color: #fff;
      color: #11101d;
    }

    .mobile-navbar li.open-dropdown a .arrow {
      transform: rotate(90deg);
    }

    .form-control.search-nav-input:focus {
      box-shadow: 0 0 0 .1rem rgba(0, 188, 228, .8);
    }

    .fsb-select {
      border: none;
      border-radius: 4px;
      width: 100%;
      box-shadow: none;
    }

    .fsb-button {
      border: 1px solid #ced4da;
      border-radius: 4px;
      transition: box-shadow .2s;
    }

    .fsb-button[aria-expanded="true"] {
      border: 1px solid #fff;
      box-shadow: 0 0 0 .1rem rgb(13, 109, 253);
    }

    .fsb-option:hover {
      background-color: rgba(222, 234, 254);
    }

    .form-control {
      border-radius: 4px;
    }

    .input-group-text {
      border-radius: 4px;
    }

    .fsb-option[aria-selected="true"] {
      background-color: #0d6efd;
      color: #fff;
    }

    .fsb-list {
      margin-top: 5px;
    }

    .margin-top-container,
    .increase-decrease-form {
      margin-top: 4rem;
    }

    .ts-control {
      border-radius: 4px;
      background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%23000' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3E%3C/svg%3E");

      background-position: right .75rem center;

      background-repeat: no-repeat;
      background-size: 16px 12px;
    }


    .focus .ts-control {
      border: 1px solid #fff;
      border-radius: 4px;
      box-shadow: 0 0 0 .1rem rgb(13, 109, 253);
      background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%23000' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m2 5 6 6 6-6'/%3E%3C/svg%3E") !important;
    }

    .ts-wrapper.multi .ts-control>div {
      margin: 0 2px 2px 0;
      padding: 0.5px 0 0.5px 2px;
      font-size: 12px;
      display: flex;
      min-width: 0px;
      background-color: rgb(230, 230, 230);
      border-radius: 2px;

    }

    .ts-wrapper.plugin-remove_button:not(.rtl) .item .remove {
      border-left: 0;
      margin-left: 0;
      font-weight: 700;
      font-size: 15px;
    }

    .ts-dropdown,
    .ts-dropdown.form-control,
    .ts-dropdown.form-select {
      border: 0.5px solid rgba(0, 0, 0, .175);
      border-radius: 4px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, .175);
    }

    .ts-dropdown [data-selectable].option {
      padding: 7px 7px;
    }

    .ts-dropdown [data-selectable].option:hover {
      background-color: rgba(222, 234, 254);
      color: #000;
    }

    .ts-dropdown .active {
      background-color: #0d6efd;
      color: #fff;
    }

    .mobile-navbar li .content a.active {
      background-color: #fff;
      color: #11101d;
    }

    .spinner {
      pointer-events: none;
      -webkit-animation: rotate 1.5s linear infinite;
      animation: rotate 1.5s linear infinite;
      width: 3.2rem;
      height: 3.2rem;
      transition: opacity 0.3s linear 0.15s;
      margin-right: 10px;
    }

    .spinner.large {
      width: 2.5rem;
      height: 2.5rem;
    }

    .spinner.medium {

      width: 1.5rem;

      height: 1.5rem;
    }

    .spinner.small {
      width: 1rem;
      height: 1rem;
    }

    .spinner .path {
      stroke: #0d6efd;
      stroke-linecap: round;
      -webkit-animation: dash 1.5s ease-in-out infinite;
      animation: dash 1.5s ease-in-out infinite;
    }

    @-webkit-keyframes rotate {
      100% {
        transform: rotate(360deg);
      }
    }

    @keyframes rotate {
      100% {
        transform: rotate(360deg);
      }
    }

    @-webkit-keyframes dash {
      0% {
        stroke-dasharray: 1, 150;
        stroke-dashoffset: 0;
      }

      50% {
        stroke-dasharray: 90, 150;
        stroke-dashoffset: -35;
      }

      100% {
        stroke-dasharray: 90, 150;
        stroke-dashoffset: -124;
      }
    }

    @keyframes dash {
      0% {
        stroke-dasharray: 1, 150;
        stroke-dashoffset: 0;
      }

      50% {
        stroke-dasharray: 90, 150;
        stroke-dashoffset: -35;
      }

      100% {
        stroke-dasharray: 90, 150;
        stroke-dashoffset: -124;
      }
    }

    .plugin-clear_button .clear-button {
      position: absolute;
      right: calc(2.5rem);
      top: 50%;
      transform: translateY(-50%);
      transition: opacity .5s;
      font-size: 20px !important;
      margin-right: 15px !important;
    }

    .ts-control::after {

      content: '';
      display: block;
      position: absolute;
      top: 50%;
      right: 2.5em;
      height: 1.25em;
      width: 1px;
      background-color: #6b7177;
      -webkit-transform: translateY(-50%);
      transform: translateY(-50%);
    }

    .category-list-div {
      margin-bottom: 20px;
      height: 80vh;
      overflow-y: auto;
      width: 100%;
    }

    .category-sort-handle {
      margin-right: 10px;
      font-size: 25px;
      font-weight: bold;
      cursor: move;
      cursor: -webkit-grabbing;
    }

    .list-group {
      margin: 10px;
    }

    .blue-background-class {
      background-color: #0d6efd;
      opacity: 0.8;
      color: #fff;
    }

    .ts-wrapper:not(.multiple) .ts-control .item {

      text-overflow: ellipsis;
      white-space: nowrap;
      width: calc(100% - 3rem);
      overflow: hidden;
    }

    .custom-modal-footer {
      border-top: 1px solid #ced4da;
      width: calc(100% + 2rem);
      margin-left: -1rem;
      padding-top: 1rem;
      padding-left: 1rem;
    }

    @media (max-width : 992px) {
      .special_pricing_service_name {
        width: 300px;
        white-space: normal;
      }

      table thead tr th {

        font-size: 15px;

      }
    }

    .fa-stack {
      display: inline-block;
      height: 2em;
      line-height: 2em;
      position: relative;
      vertical-align: middle;
      width: 2.5em;
    }

    .actions-icon {
      width: 30px;
      height: 30px;
    }

    .btn-labeled {
      padding-top: 0;
      padding-bottom: 0;
    }

    .btn-label {
      position: relative;
      left: -12px;
      display: inline-block;
      padding: 6px 12px;
      background: rgba(0, 0, 0, 0.15);
      border-radius: 0.375rem 0 0 0.375rem;
    }

    .badge {
      padding: .25em .4em;
      font-size: 75%;
      font-weight: 700;
      border-radius: .25rem;
    }

    .badge-info {
      color: #fff;
      background-color: #17a2b8;
    }
    .page-content {
  
    margin-bottom: 50px;
    overflow-x: auto;
    overflow-y: auto;
    max-height: calc(100vh - 1.5rem - 48px - 2em);
}
  
    .payment-card {
      display:inline-block;
      margin-top: 10px;
      margin-bottom: 10px;
      padding: 10px 5px;
      width: 310px;
      border-radius: 10px;
      /* border: 1px solid grey; */
      box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }
    @media only screen and (max-width: 768px) {
      .payment-card {
        display: block;
        width:100%;
      }
    }
    .payment-card .method-logo {
      text-align: center;
    }
    .payment-card .method_name {
      text-align: center;
      font-size: 20px;
    }

    .payment-card .vertical-line {
      width: 100%;
      height: 1px;
      background-color: grey;
      margin: 10px 0px;
    }
    .payment-card .method-status {
      margin-top: -2px;
      margin-left: 5px;
    }
    .payment-card .method_min_max {
      text-align: center;
      font-weight: bold;
    }
    .payment-card .method_min_max .min {
      color:green;
    }
    .payment-card .method_min_max .max {
      color:red;
    }
    .payment-card .green-circle {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background-color: rgb(41, 191, 18);
      box-shadow: 2px 2px 2px rgba(41, 191, 18, 0.4);
      cursor: pointer;
    }
    .payment-card .red-circle {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background-color: rgb(239, 35, 60);
      box-shadow: 2px 2px 2px rgba(239, 35, 60, 0.4);
      cursor: pointer;
    }
    .payment-card .actions {
      text-align: center;
    }
    .method-sort-handle {
      float:right;
      margin-top: -30px;
      margin-right: 5px;
      font-size: 25px;
    }
  </style>
  <style>
  /* Header */
header{
 min-height:60px;
 border-style:none;
 border-bottom-width:1px !important;
 border-bottom-style:solid;
}
/* Active */
header > .active{
 background-color:#ffffff;
 color:#5a5a5a;
 transform:translatex(0px) translatey(0px);
 
}

/* Open Unknowndown */
header .active .open-dropdown{
 background-color:#ffffff !important;
 color:#5a5a5a !important;
}

/* Active */
.open-dropdown .active{
 background: linear-gradient(145deg, #007bff, #0056b3); /* Light gradient */
    color: #ffffff !important;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
}

/* Nav href logo */
.open-dropdown .nav-link .nav-li-href-logo{
 display:none;
}

/* Nav href logo */
.nav-list .dropdown .nav-li-href-logo{
 display:none;
}

/* Nav href logo */
.nav-list li .nav-li-href-logo{
 display:none;
}

/* Bar bottom */
header .active .bar-bottom{
 color:#5a5a5a;
 background-color:#5a5a5a;
}

/* Bar top */
header .active .bar-top{
 background-color:#5a5a5a;
}

/* List */

/* Nav link */
.open-dropdown .content .nav-link{
 padding-left:28px !important;
 padding-right:28px;
 padding-top:14px;
 padding-bottom:14px;
}

/* List Item */
header .active li{
 
 padding-top:14px !important;
 padding-bottom:14px !important;
 transform:translatex(0px) translatey(0px);
}

/* Nav link */
.nav-list .open-dropdown .nav-link{
 padding-left:2px;
 padding-top:14px;
 padding-bottom:14px;
}

/* Active */
.open-dropdown .active{
 
 font-size:16px;
}

/* Italic Tag */
.nav-list .dropdown i{
 position:relative;
 top:-5px;
}
.mobile-navbar li:not(.search-box-li){
    padding-left:14px;
    padding-right:14px;
}
/* List Item */
header .active .nav-list li:active {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
/* Bar top */
header .mobile-nav-close-btn .bar-top{
 background-color:#5a5a5a;
}

/* Bar middle */
header .mobile-nav-close-btn .bar-middle{
 background-color:#5a5a5a;
}

/* Bar bottom */
header .mobile-nav-close-btn .bar-bottom{
 background-color:#5a5a5a;
}
header > .active{
 background-color:rgba(255,255,255,0);
}

/* List */
header .active ul{
 background-color:#f8f9fa;
}

/* Body */
body{
 background-color:#f8f9fa;
}




.mobile-navbar li.open-dropdown:not(.search-box-li):hover{
background-color:#f8f9fa !important;
}

header .active .open-dropdown:hover{
 transform:translatex(0px) translatey(0px) !important;
 background-color:rgba(248,249,250,0) !important;
}
/* Nav link */
.nav-list .open-dropdown .content .nav-link{
 font-size:16px !important;
}
/* List Item */
header .active .nav-list li:hover{
    color:#5a5a5a !important;
background-color:#f8f9fa !important;
}
header .active .nav-list li:active{
    
background: linear-gradient(145deg, #007bff, #0056b3); /* Light gradient */
    color: #ffffff !important;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
}
/* Header */
header{
 min-height:5px;
 height:50px;
 border-bottom-color:#e7e7e7;
 background-color:rgba(255,255,255,0.7);
}

/* Body */
body{
 background-color:#f0f4f8;
}

/* Mobile nav close */
header .mobile-nav-close-btn{
 top:15px;
}

/* List */
header .active ul{
 position:relative;
 top:15px;
}
/* Header */
header{
 overflow-x:hidden;
}





</style>
</head>

<body>
    
  <header>
      
    <div class="mobile-nav-close-btn w-10 h-10 flex flex-col items-center justify-center cursor-pointer relative">
  <div class="bar-top w-6 h-1 bg-gray-800 rounded transition-all"></div>
  <div class="bar-middle w-6 h-1 bg-gray-800 rounded mt-1 transition-all"></div>
  <div class="bar-bottom w-6 h-1 bg-gray-800 rounded mt-1 transition-all"></div>
</div>

    <div class="mobile-navbar">
     

      <ul class="nav-list">
        

        <li>
          <a class="nav-link" href="<?php echo site_url("$rentaladmin"); ?>">
              
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li class="dropdown <?php
        if (route(1) == "clients" || route(1) == "special-pricing" || route(1) == "fund-add-history") {
          echo "open-dropdown";
        }
        ?>">
          <a class="nav-link" href="javascript:void(0)">
            <img class="img-responsive nav-li-href-logo" height="30" width="30"
              src="<?php echo site_url("img/admin/users.png"); ?>">
            <span class="links_name">Users</span><i class="bi bi-chevron-right arrow"></i>
          </a>
          <div class="content">
            <a class="nav-link <?php if (route(1) == "clients") {
              echo "active";
            } ?>" href="<?php echo site_url("$rentaladmin/clients"); ?>"><img class="img-responsive nav-li-href-logo"
                height="30" width="30" src="<?php echo site_url("img/admin/users.png"); ?>"> Users</a>
      
          
      
            <a class="nav-link <?php if (route(1) == "special-pricing") {
              echo "active";
            } ?>" href="<?php echo site_url("$rentaladmin/special-pricing"); ?>"><img class="img-responsive nav-li-href-logo"
                height="30" width="30" src="<?php echo site_url("img/admin/special-pricing.png"); ?>"> Special
              Pricing</a>
          </div>
        </li>
       
        <li class="dropdown">
          <a class="nav-link" href="javascript:void(0)">
            <img class="img-responsive nav-li-href-logo" height="30" width="30"
              src="<?php echo site_url("img/admin/orders.png"); ?>">
            <span class="links_name">Orders</span><i class="bi bi-chevron-right arrow"></i>
          </a>
          <div class="content">
            <a class="nav-link" href="<?php echo site_url("$rentaladmin/orders"); ?>"><img
                class="img-responsive nav-li-href-logo" height="30" width="30"
                src="<?php echo site_url("img/admin/orders.png"); ?>"> Orders</a>
            <a style="font-size:14px;" class="nav-link" href="<?php echo site_url("$rentaladmin/tasks"); ?>"><img
                class="img-responsive nav-li-href-logo" height="30" width="30"
                src="<?php echo site_url("img/admin/cancel-refill-tasks.png"); ?>"> Refill and Cancel Tasks</a>
          </div>
        </li>
         <li class="dropdown <?php
        if (route(1) == "services" || route(1) == "update-prices" || route(1) == "bulk" || route(1) == "synced-logs" || route(1) == "category-sort") {
          echo "open-dropdown";
        }
        ?>">
          <a class="nav-link" href="javascript:void(0)">
            <img class="img-responsive nav-li-href-logo" height="30" width="30"
              src="<?php echo site_url("img/admin/services.png"); ?>">
            <span class="links_name">Services</span><i class="bi bi-chevron-right arrow"></i>
          </a>
          <div class="content">
            <a class="nav-link  <?php if (route(1) == "services") {
              echo "active";
            } ?>" href="<?php echo site_url("$rentaladmin/services"); ?>"><img class="img-responsive nav-li-href-logo"
                height="30" width="30" src="<?php echo site_url("img/admin/services.png"); ?>"> Services</a>
                <a class="nav-link  <?php if (route(1) == "update-prices") {
              echo "active";
            } ?>" href="<?php echo site_url("$rentaladmin/update-prices"); ?>"><img class="img-responsive nav-li-href-logo"
                height="30" width="30" src="<?php echo site_url("img/admin/update-prices.png"); ?>"> Update Prices</a>
                <a class="nav-link  <?php if (route(1) == "bulk") {
              echo "active";
            } ?>" href="<?php echo site_url("$rentaladmin/bulk"); ?>"><img class="img-responsive nav-li-href-logo" height="30"
                width="30" src="<?php echo site_url("img/admin/bulk-services-edit.png"); ?>"> Bulk Services & Categories Manager</a>
            
            
            
          </div>
        </li>
<li>
          <a class="nav-link" href="<?php echo site_url("$rentaladmin/fund-add-history"); ?>">
            <img class="img-responsive nav-li-href-logo" height="30" width="30"
              src="<?php echo site_url("img/admin/payments.png"); ?>">
            <span class="links_name">Payments</span>
          </a>
        </li>

        <li>
          <a class="nav-link" href="<?php echo site_url("$rentaladmin/tickets"); ?>">
            <img class="img-responsive nav-li-href-logo" height="30" width="30"
              src="<?php echo site_url("img/admin/tickets.png"); ?>">
            <span class="links_name">Support</span>
          </a>
        </li>

        <li class="dropdown">
          <a class="nav-link" href="javascript:void(0)">
            <img class="img-responsive nav-li-href-logo" height="30" width="30"
              src="<?php echo site_url("img/admin/additionals.png"); ?>">
            <span class="links_name">Menu</span><i class="bi bi-chevron-right arrow"></i>
          </a>
          <div class="content">
            <a class="nav-link" href="<?php echo site_url("$rentaladmin/referrals"); ?>"><img
                class="img-responsive nav-li-href-logo" height="30" width="30"
                src="<?php echo site_url("img/admin/referrals.png"); ?>"> Affiliates</a>
            <a class="nav-link" href="<?php echo site_url("$rentaladmin/broadcasts"); ?>"><img
                class="img-responsive nav-li-href-logo" height="30" width="30"
                src="<?php echo site_url("img/admin/broadcasts.png"); ?>"> Notifications</a>
                
            <a class="nav-link" href="<?php echo site_url("$rentaladmin/logs"); ?>"><img
                class="img-responsive nav-li-href-logo" height="30" width="30"
                src="<?php echo site_url("img/admin/logs.png"); ?>"> Logs</a>
                

            <a class="nav-link" href="<?php echo site_url("$rentaladmin/reports"); ?>"><img
                class="img-responsive nav-li-href-logo" height="30" width="30"
                src="<?php echo site_url("img/admin/reports.png"); ?>"> Reports</a>
            <a class="nav-link" href="<?php echo site_url("$rentaladmin/kuponlar"); ?>"><img
                class="img-responsive nav-li-href-logo" height="30" width="30"
                src="<?php echo site_url("img/admin/coupons.png"); ?>"> Coupon Code</a>
            <a class="nav-link" href="<?php echo site_url("$rentaladmin/child-panels"); ?>"><img
                class="img-responsive nav-li-href-logo" height="30" width="30"
                src="<?php echo site_url("img/admin/child-panels.png"); ?>"> Child Panels</a>
            
          </div>
        </li>
<li class="dropdown">
          <a class="nav-link" href="javascript:void(0)">
            <img class="img-responsive nav-li-href-logo" height="30" width="30"
              src="<?php echo site_url("img/admin/additionals.png"); ?>">
            <span class="links_name">Control Panel</span><i class="bi bi-chevron-right arrow"></i>
          </a>
          <div class="content">
            <a class="nav-link" href="<?php echo site_url("$rentaladmin/appearance"); ?>"><img
                class="img-responsive nav-li-href-logo" height="30" width="30"
                src="<?php echo site_url("img/admin/referrals.png"); ?>"> Appearance</a>
            <a class="nav-link" href="<?php echo site_url("$rentaladmin/settings"); ?>"><img
                class="img-responsive nav-li-href-logo" height="30" width="30"
                src="<?php echo site_url("img/admin/broadcasts.png"); ?>"> Settings</a>
            
          </div>
        </li>
        <li class="dropdown">
          <a class="nav-link" href="javascript:void(0)">
            <img class="img-responsive nav-li-href-logo" height="30" width="30"
              src="<?php echo site_url("img/admin/additionals.png"); ?>">
            <span class="links_name">Manage</span><i class="bi bi-chevron-right arrow"></i>
          </a>
          <div class="content">
            <a class="nav-link" href="<?php echo site_url("$rentaladmin/manager"); ?>"><img
                class="img-responsive nav-li-href-logo" height="30" width="30"
                src="<?php echo site_url("img/admin/referrals.png"); ?>"> Staff Members</a>
            <a class="nav-link" href="<?php echo site_url("$rentaladmin/account"); ?>"><img
                class="img-responsive nav-li-href-logo" height="30" width="30"
                src="<?php echo site_url("img/admin/broadcasts.png"); ?>"> Account</a>
            <a class="nav-link" href="<?php echo site_url("$rentaladmin/logout"); ?>">
            <img class="img-responsive nav-li-href-logo" height="30" width="30"
              src="<?php echo site_url("img/admin/logout.png"); ?>"><span class="links_name"> Logout</span>
          </a>
          </div>
        </li>

      </ul>
    </div>
  </header>
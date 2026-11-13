<?php include 'header.php'; ?>
<style>
 @import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* General Light Theme Settings */
body, .container {
    background-color: #f9f9f9; /* Light gray background */
    color: #333; /* Dark text color */
    font-family: 'Inter', sans-serif;
}

/* Menu Styling */
.container ul {
    font-family: 'Inter', sans-serif;
}

/* Active Link */
.nav-stacked .active a {
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

/* Link */
.nav-stacked .active a{
 padding-left:14px !important;
 padding-right:14px !important;
}


/* Hover Effect for Links */
.nav-stacked li:hover a {
    background: linear-gradient(145deg, #0056b3, #003c82);
   
     padding: 14px 28px !important;
}



/* Link Styling */
.nav-stacked .settings_menus a {
    color: #333; /* Dark text color */
    padding: 14px !important;
}

/* Span Tag */
.nav-stacked a span{
 display:none;
}

/* Link */
.nav-stacked .appearance_menus a{
 color:#5a5a5a ;
}

/* Dropdown toggle */
.navbar-left-block li .dropdown-toggle{
 color:#5a5a5a;
}



/* Additional Spacing */
.nav-stacked a span.badge-primary {
    margin-left: 8px;
}
</style>
<body>
<div class="container">
  <div class="row">
    <?php if( ( route(2) == "themes" && !route(3) ) || route(2) != "themes"  ):  ?>
          <div class="col-md-2 col-md-offset-1">
            <ul class="nav nav-pills nav-stacked p-b">
<?php foreach($menuList as $menuName => $menuLink ):
?>
<li class="appearance_menus <?php if( $route["2"] == $menuLink ): echo "active"; endif; ?>"><a href="<?=site_url("$rentaladmin/appearance/".$menuLink)?>"><?=$menuName?></a></li>
<?php endforeach; ?>
</ul>
</div>
<?php endif;
if( $access ):
include admin_view('appearance/'.route(2));
else:
include admin_view('settings/access');
endif;
    ?>


  </div>
</div>

</body>
<?php include 'footer.php'; ?>

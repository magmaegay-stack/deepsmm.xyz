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


/* Hover Effect for Links */
.nav-stacked li:hover a {
    background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
    padding:14px 28px !important;
}

/* Column Styling */
.container .col-md-offset-1 {
    transform: translatex(0px) translatey(0px);
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



/* Additional Spacing */
.nav-stacked a span.badge-primary {
    margin-left: 8px;
}
</style>

<div class="container">
  <div class="row">
    <?php if( ( route(2) == "themes" && !route(3) ) || route(2) != "themes"  ):  ?>
    <div class="col-md-2 col-md-offset-1">
        <ul class="nav nav-pills nav-stacked p-b">
            <?php foreach($menuList as $menuName => $menuLink ): ?>
                <li class="settings_menus <?php if( $route["2"] == $menuLink ): echo "active"; endif; ?>">
                    <a href="<?=site_url("$rentaladmin/settings/".$menuLink)?>"><?=$menuName?>
                    <?php if( $menuLink == "providers"): 
                        echo '<span style="float:right;" class="badge badge-primary">'.$sellers_count.'</span>';
                    endif;

                    if( $menuLink == "payment-methods"): 
                        echo '<span style="float:right;" class="badge badge-primary">'.$pay_methods_count.'</span>';
                    endif;

                    if( $menuLink == "site_count"): 
                        echo '<span style="float:right;" class="badge badge-primary">'.$orders_count.'</span>';
                    endif;

                    if( $menuLink == "currency-manager"): 
                        echo '<span style="float:right;" class="badge badge-primary">'.$currencies_count.'</span>';
                    endif;
                    ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php  endif;
          if( $access ):
            include admin_view('settings/'.route(2));
          else:
            include admin_view('settings/access');
          endif;
    ?>
  </div>
</div>

<?php include 'footer.php'; ?>

<?php
if(!defined('BASEPATH')) {
   die('Direct access to the script is not allowed');
}

 if( $admin["access"]["broadcast"] != 1  ):
    header("Location:".site_url("$rentaladmin"));
    exit();
  endif;

  if( !route(2) ):
    $page   = 1;
  elseif( is_numeric(route(2)) ):
    $page   = route(2);
  elseif( !is_numeric(route(2)) ):
    $action = route(2);
  endif;

  
    
    require admin_view('broadcasts');
	
	
	
	
 
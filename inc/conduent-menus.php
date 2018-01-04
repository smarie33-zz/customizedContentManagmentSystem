<?php
function register_menu_locations() {
  register_nav_menus(
    array(  
        'secondary_top_menu' => __( 'Secondary Top Menu' )
    )
  );
} 
add_action( 'init', 'register_menu_locations' );
?>
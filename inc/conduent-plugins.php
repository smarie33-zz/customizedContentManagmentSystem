<?php
function init_to_check_for_plugins() {
    if ( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
        add_action('admin_enqueue_scripts', 'add_conduent_admin_style');
    }
} 
add_action( 'admin_init', 'init_to_check_for_plugins' );
?>
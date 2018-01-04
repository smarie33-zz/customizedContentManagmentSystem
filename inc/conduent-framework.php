<?php
function get_conduent_framework_url($path)
{

    $explicit_cwf_version = get_option( 'cdu_framework_version', 'current' );

    $homepath = ABSPATH;

    if (getenv("vagrant_dev") === "true") {
        return "/cwf/current/$path";
    }

    // I HATE THIS LINE OF CODE. We need to fix it to check based on file existance, not if localhost 
    // in the meantime I'm checking to see if it's running on Vagrant using a port number check
    else if (file_exists(get_template_directory(). "/css-build/$path") || (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false)) {
       
        return get_template_directory_uri() . "/css-build/$path";
    }
    else if($explicit_cwf_version != null && $explicit_cwf_version != 'current' && is_string($explicit_cwf_version))
    {
    		// use CDN domain
        return "https://www.conduentassets.com/cwf/" . $explicit_cwf_version . "/$path";
    }
    else if($explicit_cwf_version == 'current')
    {
        // use domain that bypasses CDN
        return "https://cduthemeassets.wpengine.com/cwf/current/$path?t=".time();
    }
    else if (file_exists("{$homepath}cwf/current/{$path}")) {
        // Lets check to see if the path actually exists before trying to load from there.
        return site_url("/cwf/current/{$path}");
    }  
    else {
        // if all else fails
        return "https://cduthemeassets.wpengine.com/cwf/current/$path?t=".time();
    }
}

/**
 * add js from framework into footer
 */
function add_conduent_js_to_footer() {
    wp_register_script( 'conduent-framework-js',  get_conduent_framework_url('js/cwf_full.min.js'),'','0.0.6', true );  
    wp_register_script( 'conduent-theme-js', get_template_directory_uri() . '/js/c_wp_theme.min.js','','1.1', true );
    wp_register_script( 'conduent-search-toggle-js', get_template_directory_uri() . '/js/search-toggle.js','','1.0', true );
    
    wp_enqueue_script('conduent-framework-js');
    wp_enqueue_script('conduent-theme-js');
    wp_enqueue_script('conduent-search-toggle-js');
}
add_action( 'wp_enqueue_scripts', 'add_conduent_js_to_footer' ); 

//load custom js for admin area
function load_cwf_admin_js() {
    wp_register_script( 'conduent-custom-admin-js',  get_template_directory_uri() .'/js/admin.js','','1', true );
    wp_enqueue_script('conduent-custom-admin-js');
}
add_action( 'admin_enqueue_scripts', 'load_cwf_admin_js' );


function style_connections_sidebar() {
  echo '<style type="text/css">
    #cwf_connections .inside div{
        padding: 2px 0;
    }
    #cwf_connections .inside div div{
        padding: 0 5px;
    }
    #cwf_connections .inside div div a{
        font-size: 10px;
    }
    #cwf_connections .inside div:nth-child(even){
        background-color: #e6eeff;
    }
    #cwf_connections h4{
        margin: 1em 0 .3em 0;
    }
  </style>';
}
add_action('admin_head', 'style_connections_sidebar');

?>
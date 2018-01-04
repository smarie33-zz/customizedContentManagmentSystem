<?php
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function conduent_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'conduent_content_width', 640 );
}
add_action( 'after_setup_theme', 'conduent_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function conduent_scripts() {
  wp_enqueue_style( 'conduent-style', get_stylesheet_uri() );
  wp_enqueue_script( 'conduent-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

  global $post;
  if (is_page() && $post->post_name == 'insights') {
    wp_enqueue_script ( 'conduent-insights', get_template_directory_uri() . '/js/insights.js', array(), '20161031', true );
  }

  if(is_front_page()){
    wp_enqueue_script ( 'conduent-masonry-video', get_template_directory_uri() . '/js/masonry-video.js', array(), '20170101', true );
  }

  if(is_search()){
    wp_enqueue_script ( 'conduent-search-on-page', get_template_directory_uri() . '/js/search.js', array(), '20161229', true );
  }
  
	wp_enqueue_script( 'conduent-events', get_template_directory_uri() . '/js/the-events-calendar.js', array(), '20161208', true );
  wp_enqueue_script( 'conduent-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'conduent_scripts' );

/**
 * style from sass build
 */
function add_conduent_framework() {

  wp_enqueue_style( 'conduent-icon-font', get_template_directory_uri() . '/fonts/conduent-icon-font.css' );

  wp_enqueue_style( 'conduent-framework', get_conduent_framework_url('css/cwf_full.min.css') );       

  wp_enqueue_style( 'conduent-framework-theme', get_template_directory_uri() . '/css/c_wp_theme.min.css' );
  wp_enqueue_script('jquery');
  wp_register_script( 'bootstrap-js',   get_conduent_framework_url('js/bootstrap.min.js'),'','.3.3.7' );
  wp_register_script('conduent-insights', get_template_directory_uri() . '/js/insights.js', '', '' );
  wp_register_script('moment', get_template_directory_uri() . '/js/moment.min.js', '', '' );
  wp_register_script('jsrender', get_template_directory_uri() . '/js/jsrender.js', '', '' );  
  wp_register_script('connect', get_template_directory_uri() . '/js/connect.js', '', '' );
  wp_register_script('tel_fix', get_template_directory_uri() . '/js/tel_fix.js', '', '' );

  wp_enqueue_script('bootstrap-js');
  wp_enqueue_script('moment');
  wp_enqueue_script('jsrender');
  wp_enqueue_script('connect');  
  wp_enqueue_script('tel_fix');
  
}
add_action( 'wp_enqueue_scripts', 'add_conduent_framework' );

/**
 * Include bootstrap
 */
$theme = wp_get_theme();
if ('conduent' == $theme->name):
    add_filter('stylesheet_directory_uri','wpi_stylesheet_dir_uri',10,2);
endif;
/**
 * wpi_stylesheet_dir_uri
 * overwrite theme stylesheet directory uri
 * filter stylesheet_directory_uri
 * @see get_stylesheet_directory_uri()
 */
function wpi_stylesheet_dir_uri ($stylesheet_dir_uri, $theme_name){

  $subdir = '/sass';
  return $stylesheet_dir_uri.$subdir;

}

/**
 * add css for admin area
 */
function add_conduent_admin_style() {
  wp_enqueue_style('conduent-admin-styles', get_template_directory_uri().'/css/c_wp_theme_admin.css');
}
?>
<?php
//clean up admin interface
function clean_up_admin_menu() {
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
    remove_menu_page('edit.php?post_type=blog');
}
add_action( 'admin_menu', 'clean_up_admin_menu' );

/* admin field for framework version */
register_setting('general', 'cdu_framework_version', 'esc_attr');
if (is_admin()) {
	add_filter('admin_init', 'cdu_framework_add_settings_fields');
}

function cdu_framework_add_settings_fields() {
	add_settings_field('cdu_framework_version', '<label for="cdu_framework_version">Conduent Framework Version</label>' , 'cdu_framework_version_html', 'general');
}

function cdu_framework_version_html()
{
    $value = get_option( 'cdu_framework_version', 'current' );
    echo '<input type="text" id="cdu_framework_version" name="cdu_framework_version" value="' . $value . '" />';
}

if ( function_exists('acf_add_options_page') ) {
    acf_add_options_sub_page(array(
        'page_title'    => '404 Page',
    ));
    acf_set_options_page_menu('404 Page');
}

// remove the column type for Articles and Topics
// add parent column
// put parent column before date column
function cwf_manage_columns( $columns ) {
  unset($columns['type']);
  $columns['parent'] = 'Parent';
  $rearrange = array();
  foreach($columns as $key => $title) {
    if ($key == 'date')
      $rearrange['parent'] = 'Parent';
    $rearrange[$key] = $title;
  }
  return $rearrange;
}

function cwf_new_columns($name){
    global $post;
    switch ($name) {
        case 'parent':
            if($post->post_parent == 0){
                $parent = '—';
            }else{
                $parent = get_the_title($post->post_parent);
            }
            echo $parent;
    }
}

function cwf_column_init() {
    add_filter('manage_edit-insights_columns', 'cwf_manage_columns' );
    add_filter('manage_edit-solution_columns', 'cwf_manage_columns' );
    add_action('manage_insights_posts_custom_column',  'cwf_new_columns');
    add_action('manage_solution_posts_custom_column',  'cwf_new_columns');
}
add_action( 'admin_init' , 'cwf_column_init' );

$all_posttypes_array = array('page', 'post', 'services', 'industry', 'insights', 'solutions', 'tribe_events');

add_action( 'admin_menu', 'remove_author_box' );
add_action( 'add_meta_boxes', 'author_in_publish' );
add_action( 'add_meta_boxes', 'excerpt_in_publish' );

//move author box to the right siderail
function remove_author_box($all_posttypes_array) {
  remove_meta_box( 'authordiv', $all_posttypes_array, 'normal' );
  remove_meta_box( 'postexcerpt', $all_posttypes_array, 'normal' );
}

function author_in_publish($all_posttypes_array) {
  add_meta_box( 'authordiv', 'Author', 'fill_with_author_dd', $all_posttypes_array, 'side', 'low');
}

function fill_with_author_dd(){
  global $post_ID;
  $post = get_post( $post_ID );
  post_author_meta_box( $post );
}  

function excerpt_in_publish($all_posttypes_array) {
  global $post_ID;
  echo 'test '.$post_ID;
  if ( $post_ID !== (int) get_option( 'page_on_front' ) ){
    add_meta_box( 'postexcerpt', 'Excerpt', 'fill_with_excrpt_box', $all_posttypes_array, 'after_title', 'high');
  }
}

//after title output
function oz_run_after_title_meta_boxes() {
  global $post, $wp_meta_boxes;
  # Output the `below_title` meta boxes:
  do_meta_boxes( get_current_screen(), 'after_title', $post );
}
add_action( 'edit_form_after_title', 'oz_run_after_title_meta_boxes' );

function fill_with_excrpt_box(){
  global $post_ID;
  $post = get_post( $post_ID );
  post_excerpt_meta_box( $post );
  echo '<p>150 character count limit including spaces</p>';
}  

//reorder admin side menu
function reorder_admin_menu( $__return_true ) {
    return array(
         'index.php', // Dashboard
         'edit.php?post_type=services',
         'edit.php?post_type=industry',
         'edit.php?post_type=solution',
         'edit.php?post_type=insights',
         'edit.php?post_type=page', // Pages
         'upload.php', // Media
         'edit.php?post_type=tribe_events',
         'themes.php', // Appearance         
         'edit-comments.php', // Comments 
         'users.php', // Users
         'plugins.php', // Plugins
         'tools.php', // Tools
         'options-general.php', // Settings
   );
}
add_filter( 'custom_menu_order', 'reorder_admin_menu' );
add_filter( 'menu_order', 'reorder_admin_menu' );

add_action( 'add_meta_boxes', 'cwf_display_connections_metaboxadd' );
function cwf_display_connections_metaboxadd() {
  add_meta_box( 'cwf_connections', 'Connections', 'cwf_display_connections', array('services','industry'), 'side', 'low' );
}

function cwf_display_connections(){
  global $post_ID;
  $post = get_post( $post_ID );
  $checkInsights = get_page_by_title( $post->post_title, 'OBJECT', 'insights' );
  $checkSolutions = get_page_by_title( $post->post_title, 'OBJECT', 'solution' );

  if($post->post_type == 'services'){
    $post_kind = 'Service';
  }else{
    $post_kind = $post->post_type;
  }

  if(is_object($checkSolutions)){
    $args = array(
      'post_parent' => $checkSolutions->ID,
      'post_type'   => 'solution', 
      'numberposts' => -1,
      'post_status' => 'publish',
      'order'       => 'ASC',
      'orderby'     => 'title'
    );
    $solutionChildren = get_children( $args );

    if (!empty($solutionChildren)) {
        echo '<h4>Solutions under this '.$post_kind.'</h4>';
        foreach ( $solutionChildren as $solutionChild ) {
          echo '<div><div><a href="'.admin_url().'post.php?post='.$solutionChild->ID.'&action=edit">'.$solutionChild->post_title.'</a></div></div>';
        }
    }
  };
  
  if(is_object($checkInsights)){
    $args = array(
      'post_parent' => $checkInsights->ID,
      'post_type'   => 'insights', 
      'numberposts' => -1,
      'post_status' => 'publish',
      'order'       => 'ASC',
      'orderby'     => 'title'
    );
    $insightChildren = get_children( $args );

    if (!empty($insightChildren)) {
        echo '<h4>Insights under this '.$post_kind.'</h4>';
        foreach ( $insightChildren as $insightChild ) {
          echo '<div><div><a href="'.admin_url().'post.php?post='.$insightChild->ID.'&action=edit">'.$insightChild->post_title.'</a></div></div>';
        }
    }
  };

}

//check that the taxonomy does not already exist and if it is a service title
//if it does delete it
function wp_custom_save_taxonomy($term_id, $all_current_cats = '') {
  $this_screen = get_current_screen();
  $correct_screen = false;
  if($this_screen['taxonomy'] == 'category' && $this_screen['post_type'] == 'services'){
    $correct_screen = true;
  }
  if(isset($_POST['tag-name'])){
    $current_title = $_POST['tag-name'];
  }else{
    $current_title = get_the_category_by_ID($term_id);
  }
  $current_id = $term_id;
  $gotten_categories = get_categories(array('hide_empty' => false));

  $already_there = 0;

  foreach($gotten_categories as $got_cat){      
    if(strtolower($got_cat->name) == strtolower($current_title) && $got_cat->term_id != $current_id){
      wp_delete_category($current_id);
      $already_there++;
      if($correct_screen){
        print_r('This category already exists');
      }else{
        add_action( 'admin_notices', 'cat_exists_notice__error' );
      }
    }
  }

  if($already_there == 0){
    $get_services = get_posts(array(
      'numberposts' => -1,
      'post_type' => 'services',
      'post_status' => 'publish'
    ));
    
    $checkForTitle = 0;
    foreach($get_services as $got_service){
      if(strtolower($current_title) == strtolower($got_service->post_title)){
        $checkForTitle++;
      }
    }

    if($checkForTitle == 0){
      wp_delete_category($current_id);
      if($correct_screen){
        print_r('Categories need to have the same names as Services');
      }else{
        add_action( 'admin_notices', 'cat_same_name_notice__error' );
      }
    }
  }

}
add_action('create_term','wp_custom_save_taxonomy');

//notify on non category screens
function cat_same_name_notice__error() {
  $class = 'notice notice-error';
  $message = __( 'Categories need to have the same names as Services.', 'conduent' );

  printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
}

function cat_exists_notice__error() {
  $class = 'notice notice-error';
  $message = __( 'This category already exists.', 'conduent' );

  printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
}


//push yoast to bottom of admin ui
add_filter( 'wpseo_metabox_prio', 'jw_filter_yoast_seo_metabox' );
function jw_filter_yoast_seo_metabox() {
  return 'low';
}

?>
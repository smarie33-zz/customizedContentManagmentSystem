<?php

function cwf_insights_post_types() {

  $post_types = get_terms(array(
    'taxonomy' => 'insights_types', 
    'hide_empty' => false,
  ));
  $type_list = array();
  foreach ( $post_types as $post_type ) {
    $type_list[] = array(
      'slug'  => $post_type->slug,
      'label' => $post_type->name
    );
  }
  return $type_list;
}

function cwf_insights_filtered_posts_args() {

  $post_types = cwf_insights_post_types();
  $type_list = array();
  
  foreach ( $post_types as $post_type ) {
    $type_list[] = $post_type['slug'];
  }
  
  $post_type = isset($_REQUEST['post-type']) && !empty($_REQUEST['post-type']) ?
    $_REQUEST['post-type'] : 
    $type_list;
    
  $services_list = cwf_services_list();
  $cat_list = array();
  $cat_list[] = 'about';
  foreach ($services_list as $service) {
    $cat_list[] = $service->slug;
  }
  
  $category  = isset($_REQUEST['category']) && !empty($_REQUEST['category']) ? 
    $_REQUEST['category'] :
    $cat_list;
  
  $posts_per_page = 9;
  $offset = isset($_REQUEST['offset']) ? $_REQUEST['offset'] : 0;
  $paged = 1;
  if(get_query_var('paged')) {
    $paged = get_query_var('paged');
  } elseif (get_query_var('page')) {
    $paged = get_query_var('page');
  }
  
  if ($paged > 1) {
    $offset = ($paged - 1) * $posts_per_page;
  }
  
  $args = array(
    'post_type' => $post_type,
    'post_status' => 'publish',
    'orderby' => 'date',
    'suppress_filters' => false,
    'fields' => 'ids',
    'posts_per_page' => -1
  );
  if (isset($_REQUEST['category']) && !empty($_REQUEST['category'])) {
    // This was added only a few days ago, but prepending with ind_ or svc_ 
    // is now deprecated (2016-12-28) :p
    $svc_slug = str_replace(array('ind_', 'svc_'), '', $category);
    //check if there are services with this as a category
    $svc_list = get_posts(array( 
      'post_type' => 'services', 
      'category_name' => $svc_slug,
      'posts_per_page' => -1,
      'suppress_filters' => false
    ));
    // otherwise it's an industry or not a top-level service
    // so we can just get that insights post
    // so we can get its child posts
    if (empty($svc_list)) {
      $svc_list = get_posts(array(
        'post_type' => 'insights',
        'post_status' => 'publish',
        'name' => $svc_slug,
        'suppress_filters' => false
      ));   
    }
    if (!empty($svc_list)) {
      $svc_slugs = array();
      // Add the slug into the list of parents 
      // because sometimes a top-level service 
      // will also have its own insights posts
      $svc_slugs[] = $svc_slug;
      foreach ($svc_list as $svc) {
        $svc_slugs[] = $svc->post_name;
      }
      $parents = get_posts(array(
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'post_name__in' => $svc_slugs,
        'suppress_filters' => false
      ));    
      $parent_ids = array();
      foreach($parents as $parent) {
        $parent_ids[] = $parent->ID;
      }
      if (empty($parent_ids)) {
        $args['post_parent'] = -99999999999;
      } else {
        $args['post_parent__in'] = $parent_ids;
      }
    } else {
      $args['post_parent'] = -99999999999;
    }
    $child_posts = new WP_Query($args);
    $tagged_posts = new WP_Query( array(
      'post_type' => $post_type,
      'post_status' => 'publish',
      'posts_per_page' => $posts_per_page,
      'paged' => $paged,
      'orderby' => 'date',
      'offset' => $offset,
      'suppress_filters' => false,
      'tax_query' => array(
        array(
          'taxonomy' => 'post_tag',
          'field'    => 'slug',
          'terms'    => $category,
        ),
      ),
      'fields' => 'ids'
    ));
    $all_posts = array_merge($child_posts->posts, $tagged_posts->posts);
    $all_posts = empty($all_posts) ? array(-99999999999) : $all_posts;
    $args = array(
      'post__in' => $all_posts, 
      'orderby' => 'date',
      'suppress_filters' => false,
      'posts_per_page' => $posts_per_page,
      'paged' => $paged,
      'offset' => $offset,
      'post_status' => 'publish',
      'post_type' => $post_type,      
      'meta_query' => array(
        'relation' => 'OR',
        array(
          'key'     => 'exclude_from_insights_page',
          'value'   => '1',
          'compare' => '!='
        ),
        array(
          'key'     => 'exclude_from_insights_page',
          'value'   => '1',
          'compare' => 'NOT EXISTS'
        )
      )
    );
    
  } else {
    $parent_ids = get_children(array( 
      'post_parent' => 0, 
      'post_type' => 'insights', 
      'post_status' => 'publish',
      'suppress_filters' => false,
      'fields' => 'ids'
    ));
    $args['post_parent__in'] = $parent_ids;
    $svc_and_ind_posts = new WP_Query($args);

    $about_posts = new WP_Query(array(
      'post_type' => $post_type,
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'orderby' => 'date',
      'suppress_filters' => false,
      'tax_query' => array(
        array(
          'taxonomy' => 'post_tag',
          'field'    => 'slug',
          'terms'    => $category,
        ),
      ),
      'fields' => 'ids'
    ));

    $args = array(
      'post__in' => array_merge($svc_and_ind_posts->posts, $about_posts->posts), 
      'suppress_filters' => false,      
      'post_status' => 'publish',
      'posts_per_page' => $posts_per_page,
      'paged' => $paged,
      'orderby' => 'date',
      'suppress_filters' => false,
      'offset' => $offset,
      'post_type' => $post_type,      
      'meta_query' => array(
        'relation' => 'OR',
        array(
          'key'     => 'exclude_from_insights_page',
          'value'   => '1',
          'compare' => '!='
        ),
        array(
          'key'     => 'exclude_from_insights_page',
          'value'   => '1',
          'compare' => 'NOT EXISTS'
        )
      )
    );
  }

  return $args;
  
}

function cwf_insights_filtered_posts_ajax() {

  if ( isset($_REQUEST) ) {
    $args = cwf_insights_filtered_posts_args();
    
    $insights_posts = new WP_Query( $args );
    ob_start();
    if ($insights_posts->have_posts()) {
      echo '<div class="container cwf-post-list cwf-section-padding">
                        <div class="row">';
      $article_posts = $insights_posts->posts;
      $template_pull = 'template-parts/article-preview-with-meta.php';
      include(locate_template('template-parts/grid-layout.php'));
            echo'</div>
                    </div>';
    }
    $grid_content = ob_get_contents();
    ob_end_clean();
    $insights_obj = array(
      'content' => $grid_content,
      'offset'  => $args['offset'],
      'posts_per_page' => $args['posts_per_page'],
      'max_pages' => $insights_posts->max_num_pages
    );
    wp_send_json($insights_obj);
  }
}
add_action( 'wp_ajax_cwf_insights_filtered_posts_ajax', 'cwf_insights_filtered_posts_ajax' );
add_action( 'wp_ajax_nopriv_cwf_insights_filtered_posts_ajax', 'cwf_insights_filtered_posts_ajax' );

?>

<?php
function cwf_services_list() {
  // $services = get_terms(array(
    // 'taxonomy' => 'category',
    // 'hide_empty' => false,
    // 'exclude' => 1
  // ));
  $service_posts = get_posts(array(
    'post_type' => 'services',
    'category__not_in' => get_terms('category', array('fields' => 'ids')),
    'posts_per_page' => -1,
    'orderby' => 'post_title',
    'order' => 'asc',
    'suppress_filters' => false
  ));
  $services_list = array();
  // $services_list[] = (object)array(
    // 'slug' => 'about',
    // 'name' => _e('About', 'Conduent'),
    // 'type' => 'about'
  // );
  foreach ($service_posts as $svc) {
    $services_list[] = (object)array(
      'slug' => "{$svc->post_name}",
      'name' => $svc->post_title,
      'type' => $svc->post_type
    );
  }

  $industries = get_posts(array(
    'post_type' => 'industry',
    'posts_per_page' => -1,
    'orderby' => 'post_title',
    'order' => 'asc',
    'suppress_filters' => false

  ));
  foreach ($industries as $ind) {
    $services_list[] = (object)array(
      'slug' => "{$ind->post_name}",
      'name' => $ind->post_title,
      'type' => $ind->post_type
    );
  }
  return $services_list;
}

function cwf_services_list_ajax() {
  $services_list = cwf_services_list();
  wp_send_json($services_list);
}

add_action( 'wp_ajax_cwf_services_list_ajax', 'cwf_services_list_ajax' );
add_action( 'wp_ajax_nopriv_cwf_services_list_ajax', 'cwf_services_list_ajax' );
?>

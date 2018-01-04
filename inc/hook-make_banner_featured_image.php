<?php
//automatically make the banner image of topics/articles the featured image

function cwf_make_banner_featured_image($post_id, $post){
  $post_type = get_post_type($post_id);
  if ($post_type == 'solution' || $post_type == 'insights') {
    $needle = 'banner_image="';
    $post_content = $post->post_content;
    if (strpos($post_content, $needle) !== false) {
      $start = strpos($post_content, $needle) + strlen($needle);
      $trimmed_content = substr($post_content, $start);
      $end = strpos($trimmed_content, '"');
      $image_id = substr($trimmed_content, 0, $end);

      if ($image_id)
        set_post_thumbnail($post_id, $image_id);
    }
  }
}
add_action( 'save_post', 'cwf_make_banner_featured_image', 10, 2 );

?>

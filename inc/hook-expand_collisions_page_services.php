<?php
function cwf_expand_collisions_page_services( $post_ID, $post, $update ) {
    // allow 'publish', 'draft', 'future'
    if (!in_array( $post->post_type, array( 'services', 'page' )) || $post->post_status == 'auto-draft')
        return;

    // only change slug when the post is created (both dates are equal)
    if ($post->post_date_gmt != $post->post_modified_gmt)
        return;

    $cur_slug = $post->post_name;

    $post_type = $post->post_type;

    //check in corrisponding post type for slug that is the same, collision detection already works within a post type
    if('services' == $post_type){
        $check_against = 'page';
    }else{
        $check_against = 'services';
    }

    $args = array(
        'post_type'      => $check_against,
        'name'           => $cur_slug,
        'posts_per_page' => -1
    );
    $check_these = get_posts($args);

    // unhook this function to prevent infinite looping
    remove_action( 'save_post', 'cwf_expand_collisions_page_services', 10, 3 );

    // update the post slug if there is the same slug in the other post type
    $amt_returned = count($check_these);

    if($amt_returned > 0){
        wp_update_post( array(
            'ID' => $post_ID,
            'post_name' => $cur_slug.'-'.$amt_returned
        ));
    }
    // re-hook this function
    add_action( 'save_post', 'cwf_expand_collisions_page_services', 10, 3 );

}
add_action( 'save_post', 'cwf_expand_collisions_page_services', 10, 3 );
?>
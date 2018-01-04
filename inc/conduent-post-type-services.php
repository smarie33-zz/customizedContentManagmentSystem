<?php
// remove services custom post types from url
function cwf_remove_cpt_slug( $post_link, $post, $leavename ) {
    if ( ! in_array( $post->post_type, array( 'services' ) ) || 'publish' != $post->post_status )
        return $post_link;
    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    return $post_link;
}
add_filter( 'post_type_link', 'cwf_remove_cpt_slug', 10, 3 );

?>
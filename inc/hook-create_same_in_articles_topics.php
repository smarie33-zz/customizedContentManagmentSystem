<?php
//automatically add published Services and Industies to Topics and Articles
// Temporarily disabled because of infinite loop. Also it just duplicates articles/topics when they're updated.
// Is it only supposed to run on Services/Industries posts? 
// No, it checks if a post witht the same title as the post just created exists in topics or articles, if it does it, it should automatically create this post
/* 
function cwf_create_same_in_articles_topics($ID, $post){
   $check_these_posttypes = array('insights', 'solution');
   $this_title = $post->post_title;
   
   foreach($check_these_posttypes as $check_this_posttype){
        $check_the_title = get_page_by_title($this_title, 'OBJECT', $check_this_posttype);
        if(empty($check_the_title)){
           $add_new_post = array(
                'post_title'    => $this_title,
                'post_status'   => 'publish',
                'post_author'   => 1,
                'post_type'     => $check_this_posttype
            );
            wp_insert_post( $add_new_post );
        }
   }
}
add_action( 'save_post', 'cwf_create_same_in_articles_topics', 10, 2 );
*/
?>
<?php
// We remove 'services' from the url in inc > conduent-post-type-services.php
// Because we remove it, we stop that post from being associated with its custom post type
// Now that this custom post type does not appear in the post's query, we must tell the query
// it is one of serveral post types (at least page, posts and another post type since page and posts are the only post types that do not
// require a post type slug in the url)

// match postname to any public post types
// higer risk of slug collision
function cwf_parse_request_tricksy( $query ) {
   
    // Only loop the main query. If this is not the main query leave this function without doing anything.
    // The original query that is going to output all the posts. 
    // Excluding any queries happening lower on this page or inside any included php pages
    // https://codex.wordpress.org/Function_Reference/is_main_query
    if ( ! $query->is_main_query() )
        return;

    // Leave this function if this query array does not contain the 'page' key, it is malformed or not the main loop
    // https://codex.wordpress.org/Class_Reference/WP_Query#Pagination_Parameters
    if ( ! isset( $query->query['page'] ) )
        return;

    // Leave this function if this query array contains the 'post_type' key
    //it is not the custom post type we have modified that does not contain the post type in its url
    // https://codex.wordpress.org/Class_Reference/WP_Query#Type_Parameters
    if (isset( $query->query['post_type'] ) )
        return;

    // If the 'name' key has a value (this value is the slug of the current post),
    // give this post any of the following post types so that going to this page does not end in a 404
    // 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
    // https://codex.wordpress.org/Class_Reference/WP_Query#Post_.26_Page_Parameters
    if ( ! empty( $query->query['name'] ) )
        $query->set( 'post_type', array( 'post', 'services', 'page' ) );   
}

// this function will run after the query object is created, but before the query is run
// https://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
add_action( 'pre_get_posts', 'cwf_parse_request_tricksy' );

// same idea as the above, but in the WPML parser
function cwf_filter_wpml_query($q) {
	if ( $q->is_main_query()) {
		$post_type = $q->get('post_type');
		if ($post_type == "solution" || $post_type == "insights" || $post_type == "") {
			$post_name = $q->get( 'name' );
			if ($_SERVER['REQUEST_URI'] == "/".$post_name."/") {
				$q->set( 'post_type', array( 'post', 'services', 'page' ) );
			}
		}
	}
	return $q;
}

add_filter( 'wpml_pre_parse_query', 'cwf_filter_wpml_query' );

?>
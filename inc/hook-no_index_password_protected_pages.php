<?php
// don't index password protected pages

function no_index_header() {

	global $post;

	if (!empty($post->post_password)) {
		echo '<meta name="robots" content="noindex">'."\n";
	}

}

add_action('wp_head', 'no_index_header');

?>

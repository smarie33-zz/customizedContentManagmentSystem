<?php
/* 
		prevent Yoast from building 301 redirects automatically on term changes
	 	instructions from https://kb.yoast.com/kb/how-to-disable-automatic-redirects/
*/

// posts and pages
add_filter('wpseo_premium_post_redirect_slug_change', '__return_true' );
// taxonomies
add_filter('wpseo_premium_term_redirect_slug_change', '__return_true' );
// suppress canonical
add_filter( 'wpseo_canonical', '__return_false' );
?>
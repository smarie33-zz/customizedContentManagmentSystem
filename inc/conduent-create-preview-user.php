<?php

//user redirected to homepage when going to admin area
function restrict_admin_for_preview_user() {
	$current_user = wp_get_current_user();
	if($current_user->user_email == "webteam@conduent.com" && $current_user->user_login == 'conduent01'){
		wp_redirect('https://conduent.wpengine.com/');
		exit;
	}
}
add_action( 'admin_init', 'restrict_admin_for_preview_user', 1 );

//remove items from admin bar for this user
function remove_admin_bar_stuff_for_preview_user( $wp_admin_bar ) {
	$current_user = wp_get_current_user();
	if($current_user->user_email == "webteam@conduent.com" && $current_user->user_login == 'conduent01'){
		$wp_admin_bar->remove_node( 'comments' );
		$wp_admin_bar->remove_node( 'new-content' );
		$wp_admin_bar->remove_node( 'edit' );
		$wp_admin_bar->remove_node( 'wpseo-menu' );
		$wp_admin_bar->remove_node( 'vc_inline-admin-bar-link' );
	}
}
add_action( 'admin_bar_menu', 'remove_admin_bar_stuff_for_preview_user', 99999 );

function remove_admin_bar_item_that_are_stubborn() {
	$current_user = wp_get_current_user();
	if($current_user->user_email == "webteam@conduent.com" && $current_user->user_login == 'conduent01'){	
		echo '<style>
	    #wp-admin-bar-new_draft, #wp-admin-bar-tribe-events, .edit-link{
			display: none;
	    }
	    </style>';
	}
}
add_action('wp_head', 'remove_admin_bar_item_that_are_stubborn');

?>

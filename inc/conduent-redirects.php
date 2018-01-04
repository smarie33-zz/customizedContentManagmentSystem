<?php
//if template is solutions or articles and the page has children, redirect this page to corrisponding services page
function cwf_page_template_redirect(){
    global $post;
	
	if (!empty($post) && !is_search()) {
		if( in_array( $post->post_type, array( 'insights', 'solution' ) ) ){
			if($post->post_parent == 0){
				$corrisponding_services_page = get_page_by_title($post->post_title, 'OBJECT', 'services');
				$corrisponding_services_pagei = get_page_by_title($post->post_title, 'OBJECT', 'industry');
				if(!empty($corrisponding_services_page)){
					wp_redirect( get_permalink($corrisponding_services_page->ID), 301 );
					exit();
				}else if(!empty($corrisponding_services_pagei)){
					wp_redirect( get_permalink($corrisponding_services_pagei->ID), 301 );
					exit();
				}
				
			}
		}
	}

    if($_SERVER["REQUEST_URI"] == '/industry/'){
        wp_redirect( get_bloginfo('url').'/industries', 301 );
    };
}
add_action( 'template_redirect', 'cwf_page_template_redirect' );
?>
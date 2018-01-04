<?php
// Filter to only show parents that have the same title in services or industries
//in the page attributes area
add_filter( 'page_attributes_dropdown_pages_args', 'cwf_only_show_acceptable_parents' );  
  
// Also perform the same filter when doing a 'Quick Edit'  
add_filter( 'quick_edit_dropdown_pages_args', 'cwf_only_show_acceptable_parents' );  
  
function cwf_only_show_acceptable_parents( $args )  
{  
    $for_these_post_types = array('insights', 'solution');

    if(in_array( $args['post_type'],$for_these_post_types)){
        //get all the post titles from services, industries and current post type
        $argsThis = array(
            'post_type' => array('services', 'industry', $args['post_type']),
            'post_status' => 'publish',
            'posts_per_page' => -1
        );
        $get_relevant_things = new WP_Query( $argsThis );

        $services_indstries_titles = array();
        $all_this_post_type_info = array();
        $exlude_these = array();
        $iterate = 0;

       // $also_remove_current_post = $args['exclude_tree'];
        $services_industries = $get_relevant_things->get_posts();

        //get only the ids of all posts that have the post meta allowed_to_parent
        $argsTheseToo = array(
            'post_type' => $args['post_type'],
            'post_status' => 'publish',
            'meta_key' => 'allowed_to_parent',
            'posts_per_page' => -1,
            'fields' => 'ids'
        );
        $get_all_post_allowed_to_parent = new WP_Query( $argsTheseToo );

        
        foreach($services_industries as $service_industry ){
            if($service_industry->post_type == 'services' || $service_industry->post_type == 'industry'){
                array_push($services_indstries_titles, strtolower($service_industry->post_title));
            }else{
                $all_this_post_type_info[$iterate]['post_title'] = strtolower($service_industry->post_title);
                $all_this_post_type_info[$iterate]['ID'] = $service_industry->ID;
                $iterate++;
            }
        }

        //if the looped title is not in services or industries AND the ID is not in the allowed to parent array, add to the exclude array
        foreach($all_this_post_type_info as $search_this_info){
            if(!in_array($search_this_info['post_title'], $services_indstries_titles) && !in_array($search_this_info['ID'], $get_all_post_allowed_to_parent->posts)){
                array_push($exlude_these, $search_this_info['ID']);
            }
        }

        $args['exclude_tree'] = $exlude_these;
    }
    return $args;
}

?>
<?php
//find the highest parent from categories
function cwf_top_parent_category_id($catid) {
    while ($catid) {
        $cat = get_category($catid);
        $catid = $cat->category_parent;
        $catParent = $cat->cat_ID;
    }
    return $catParent;
}

//add all post types to search
function cwf_add_cpts_to_search($query) {

    // Check to verify it's search page
    if( is_search() ) {
        // Get post types
        $post_types = get_post_types(array('public' => true, 'exclude_from_search' => false), 'objects');
        $searchable_types = array();
        // Add available post types
        if( $post_types ) {
            foreach( $post_types as $type) {
                $searchable_types[] = $type->name;
            }
        }
        $query->set( 'post_type', $searchable_types );
    }
    return $query;
}
if (!is_admin()) {
    add_action( 'pre_get_posts', 'cwf_add_cpts_to_search' );
}

//reduce output by word
function cwf_create_short_excerpt($words, $excerptLength=115){
    if(strlen($words) > $excerptLength){
        $the_str = substr($words, 0, $excerptLength);
        return $the_str.'...';
    }else{
        return $words;
    }
}

//sort and array by a specific key
function array_sort($array, $on, $order=SORT_ASC){
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

function cwf_modify_posts_per_page_in_search( $query ) {
    if ( $query->is_search() ) {
        $query->set( 'posts_per_page', '10' );
    }
}
add_action( 'pre_get_posts', 'cwf_modify_posts_per_page_in_search' );

?>
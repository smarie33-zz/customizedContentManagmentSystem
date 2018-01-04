<?php
function build_page_link_from_cat($cat_id, $base_post){
    $current_cat_title = get_the_category_by_ID($cat_id);
    $find_post = get_page_by_title($current_cat_title, 'OBJECT', $base_post);
    if(strtolower($current_cat_title) == 'services'){
        $current_cat_title = 'Services';
        $url = get_bloginfo('url').'/services';
    }elseif(strtolower($current_cat_title) == 'industries'){
        $current_cat_title = 'Industries';
        $url = get_bloginfo('url').'/industries';
    }else{
        $url = get_permalink($find_post->ID);
    }
    return '<a href="'.$url.'">'.$current_cat_title.'</a>';
}
?>
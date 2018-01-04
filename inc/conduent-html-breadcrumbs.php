<?php
function cwf_breadcrumbs($home_title, $pass_some_classes, $show_home) {

    // Settings
    $breadcrumbs_id      = 'breadcrumbs';
    $breadcrumbs_class   = 'breadcrumb';
    $breadcrumb_pos      = 1;
    if (trim($home_title) == '') {
        $home_title = 'Homepage';
    }



    if(!is_bool($show_home)){
        $show_home = true;
    }


    if(trim($pass_some_classes) != ''):
        $pass_some_classes = ' '.$pass_some_classes;
    endif;

    $post_types_to_not_output_type = array('articles','topics', 'solution', 'insights');

    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';

    // Get the query & post information
    global $post,$wp_query;

    // Do not display on the homepage
    if ( !is_front_page() ) {

        // Build the breadcrumbs
        echo '<ol id="' . $breadcrumbs_id . '" class="' . $breadcrumbs_class . $pass_some_classes.'" itemscope itemtype="http://schema.org/BreadcrumbList">';

        // Home page
        if ($show_home == true) {
            echo '<li class="item-home" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" class="bread-link bread-home text-capitalize" href="' . get_home_url() . '" title="' . $home_title . '"><span itemprop="name">' . $home_title . '</span></a><meta itemprop="position" content="' . $breadcrumb_pos .'" /></li>';
            $breadcrumb_pos++;
        }
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {

           // echo '<li class="item-current item-archive" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</span></li>';

        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post' && !in_array($post_type, $post_types_to_not_output_type)) {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li class="item-cat item-custom-post-type-' . $post_type . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '"><span itemprop="name">' . $post_type_object->labels->name . '</span></a><meta itemprop="position" content="' . $breadcrumb_pos .'" /></li>';
                $breadcrumb_pos++;
            }

            $custom_tax_name = get_queried_object()->name;
            //echo '<li class="item-current item-archive" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-archive">' . $custom_tax_name . '</span></li>';

        } else if ( is_single() ) {

            // If post is a custom post type
            $post_type = get_post_type();
            // If it is a custom post type display name and link unless it is in this array of custom post types

            if($post_type != 'post' && !in_array($post_type, $post_types_to_not_output_type)) {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                $lable_name = $post_type_object->labels->name;

                if(strtolower($lable_name) == 'industries'){
                    $url = get_bloginfo('url').'/industries';
                }else if(strtolower($lable_name) == 'articles'){
                    $url = get_bloginfo('url').'/insights';
                    $lable_name = 'Insights';
                }else{
                    $url = $post_type_archive;
                }


                if(strtolower($lable_name) == 'services' && count(get_the_category($post->ID)) === 0){
                    $url = get_bloginfo('url').'/services';
                    echo '<li class="item-cat item-custom-post-type-' . $post_type . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $url . '" title="' . $post_type_object->labels->name . '"><span itemprop="name">' . $lable_name . '</span></a><meta itemprop="position" content="' . $breadcrumb_pos .'" /></li>';
                    $breadcrumb_pos++;
                }

                if(strtolower($lable_name) != 'services'){
                    echo '<li class="item-cat item-custom-post-type-' . $post_type . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $url . '" title="' . $post_type_object->labels->name . '"><span itemprop="name">' . $lable_name . '</span></a><meta itemprop="position" content="' . $breadcrumb_pos .'" /></li>';
                    $breadcrumb_pos++;
                }
            }

            if( $post->post_parent ){

                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Define the variable before trying to use it!!
                $parents = "";

                // Parent page loop
                //for the services post type, parents automatically get redirected to the correct service because of the
                // the code in inc/conduent-redirects.php, for industries we must do a search for the title in that CPT and
                //change the url to this
                foreach ( $anc as $ancestor ) {
                    $title_from_thisPT_parent = get_the_title($ancestor);
                    $look_somewhere_else = get_page_by_title($title_from_thisPT_parent, 'OBJECT', 'industry');
                    if($look_somewhere_else != ''){
                       $this_id = $look_somewhere_else->ID;
                    }else{
                        $this_id = $ancestor;
                    }
                    $parents .= '<li class="item-parent item-parent-' . $this_id . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" class="bread-parent bread-parent-' . $this_id . '" href="' . get_permalink($this_id) . '" title="' . get_the_title($this_id) . '"><span itemprop="name">' . get_the_title($this_id) . '</span></a><meta itemprop="position" content="' . $breadcrumb_pos .'" /></li>';
                    $breadcrumb_pos++;
                }

                // Display parent pages
                echo $parents;

            }

            //Get post topic and article info
            $category = get_the_category();
            if($category) {
                // Get last category post is in
                $get_last_of_this_array = array_values($category);
                $last_category = end($get_last_of_this_array);
                // Get parent any categories and create array
                $post_type = get_post_type();
                $cats_parents = array();
                if(in_array($post_type, $post_types_to_not_output_type) && $last_category->name != 'Uncategorized') {
                    $get_cat_parents = get_ancestors($last_category->term_id, 'category');

                    //get the highest parent, which should be services or industries
                    $end_of_cat_array = end(array_values($get_cat_parents));
                    $first_parent = strtolower(get_the_category_by_ID($end_of_cat_array));
                    //get the page that has the same title as this category name and build a link out of it with that page's url
                    array_push($cats_parents, build_page_link_from_cat($last_category->term_id, $first_parent));

                    foreach($get_cat_parents as $gotten_parent) {
                        //if category has no parent, then find the url in the page post type;
                        if(!category_has_parent($gotten_parent)){
                            $pt = 'page';
                        }else{
                            $pt = $first_parent;
                        }
                        array_push($cats_parents, build_page_link_from_cat($gotten_parent, $pt));
                    };
                    $cat_parents = array_reverse($cats_parents);
                }else{
                    if($last_category->name != 'Uncategorized'){
                        array_push($cats_parents, build_page_link_from_cat($last_category->term_id, $post->post_type));
                    }

                    //$get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                    //$cat_parents = explode(',',$get_cat_parents);
                }

                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cats_parents as $parents){
                    $cat_display .= '<li class="item-cat text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">'.$parents.'</li>';
                }
            }

            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;

            }

            //Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
               // echo '<li class="item-current item-' . $post->ID . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';

            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {

              //  echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '"><span itemprop="name">' . $cat_name . '</span></a><meta itemprop="position" content="' . $breadcrumb_pos .'" /></li>';
              //  $breadcrumb_pos++;
             //   echo '<li class="item-current item-' . $post->ID . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';

            } else {

              //  echo '<li class="item-current item-' . $post->ID . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';

            }

        } else if ( is_category() ) {

            // Category page
            echo '<li class="item-current item-cat" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-cat text-capitalize">' . single_cat_title('', false) . '</span></li>';

        } else if ( is_page() ) {

            // Standard page
            if( $post->post_parent ){

                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '"><span itemprop="name">' . get_the_title($ancestor) . '</span></a><meta itemprop="position" content="' . $breadcrumb_pos .'" /></li>';
                    $breadcrumb_pos++;
                }

                // Display parent pages
                echo $parents;

                // Current page
                echo '<li class="item-current item-' . $post->ID . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span title="' . get_the_title() . '"> ' . get_the_title() . '</span></li>';

            } else {

                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</span></li>';

            }

        } else if ( is_tag() ) {

            // Tag page

            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;

            // Display the tag name
          echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</span></li>';

        } elseif ( is_day() ) {

            // Day archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '"><span itemprop="name">' . get_the_time('Y') . ' Archives</span></a><meta itemprop="position" content="' . $breadcrumb_pos .'" /></li>';
            $breadcrumb_pos++;

            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '"><span itemprop="name">' . get_the_time('M') . ' Archives</span></a><meta itemprop="position" content="' . $breadcrumb_pos .'" /></li>';
            $breadcrumb_pos++;

            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</span></li>';

        } else if ( is_month() ) {

            // Month Archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemscope itemtype="http://schema.org/Thing" itemprop="item" class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '"><span itemprop="name">' . get_the_time('Y') . ' Archives</span></a><meta itemprop="position" content="' . $breadcrumb_pos .'" /></li>';
            $breadcrumb_pos++;

            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</span></li>';

        } else if ( is_year() ) {

            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</span></li>';

        } else if ( is_author() ) {

            // Auhor archive

            // Get the author information
            global $author;
            $userdata = get_userdata( $author );

            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</span></li>';

        } else if ( get_query_var('paged') ) {

            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</span></li>';

        } else if ( is_search() ) {

            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . ' text-capitalize" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</span></li>';

        } elseif ( is_404() ) {

            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }

        echo '</ol>';

    }

}

?>

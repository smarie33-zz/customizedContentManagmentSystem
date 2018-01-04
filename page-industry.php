<?php
/*
Template Name: Industries
*/

get_header(); 



?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

      <?php 

      include(locate_template('template-parts/small-image-header.php'));
      include(locate_template('template-parts/banner.php'));

      $all_category_ids = get_terms('category', array(
          'hide_empty'     => false,
          'suppress_filters' => false,
          'fields'         => 'ids'
      ));

      //get correct industries and only return ids
      $ind_query = new WP_Query( array( 
        'post_type'        => 'industry', 
        'post_status'      => 'publish',
        'order'            => 'ASC',
        'orderby'          => 'title',
        'posts_per_page'   => -1,
        'category__not_in' => $all_category_ids,
        'fields'           => 'ids',
        'suppress_filters' => false
      ) );

      //get the ids of all selected services
      $selected_services = get_field('services_on_industry_page');

      $pull_these = array_merge($ind_query->posts, $selected_services);

      //get all industries and selected services in alphabetical order
      // suppress those with blank blurbs
      $pt_query = new WP_Query( array( 
        'post_type'        => array('industry','services'), 
        'post_status'      => 'publish',
        'order'            => 'ASC',
        'orderby'          => 'title',
        'posts_per_page'   => -1,
        'post__in'         => $pull_these,
        'suppress_filters' => false,
				'meta_query'	=> array(
					relation => 'AND',
					array(
						'key'		=> 'text_blurb',
						'value'		=> '',
						'compare'	=> '!='
					))
      ) );

    ?>
      <?php get_template_part( 'template-parts/social-rail', 'page' ); ?>
      <section>
        <div class="container cwf-post-list cwf-padding-top-sm-64 cwf-padding-top-xs-0 cwf-padding-bottom-sm-104 cwf-padding-bottom-xs-0">
          <div class="row">
            <?php
              $article_posts = $pt_query->posts;
              $template_pull = 'template-parts/article-category-preview.php';
              include(locate_template('template-parts/grid-layout.php'));
            ?>
          </div>
        </div>
      </section>
    </main><!-- #main -->
  </div><!-- #primary -->

<?php
  get_footer();
?>

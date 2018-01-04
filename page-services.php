<?php
/*
Template Name: Services
*/

get_header(); 



?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

      <?php 

      include(locate_template('template-parts/small-image-header.php'));
      include(locate_template('template-parts/banner.php'));
    
      //get all category ids
      //we're looking for any services pages excluded from all categories
      $all_category_ids_get = get_terms(array(
          'taxonomy'       => 'category'
      ) );

      $all_category_ids = array();
      foreach($all_category_ids_get as $all_category_ids_got):
        array_push($all_category_ids, $all_category_ids_got->term_id);
      endforeach;
      
      $pt_query = new WP_Query( array( 
        'post_type'        => 'services', 
        'post_status'      => 'publish',
        'order'            => 'ASC',
        'orderby'          => 'title',
        'posts_per_page'   => -1,
        'category__not_in' => $all_category_ids,
        'suppress_filters' => false
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

<?php
/*
Template Name: Filter
*/

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
			?>
				<section class="container">
					<div class="row">
						<div class="col-md-12">
							<!-- <h1><?php the_title(); ?></h1> -->
						</div>
					</div>
				</section>
				<?php

				get_template_part( 'template-parts/banner', 'page' );

				get_template_part( 'template-parts/filter', 'page' );

				get_template_part( 'template-parts/social-rail', 'page' );
        
				?>

				<section id="insights-grid">
					<div class="container cwf-post-list cwf-section-padding">
						<div class="row">
            <?php
            				
              $filter_args = cwf_insights_filtered_posts_args();
              $insights_posts = new WP_Query( $filter_args );
              $article_posts = $insights_posts->posts;
              $template_pull = 'template-parts/article-preview-with-meta.php';
              include(locate_template('template-parts/grid-layout.php'));
            ?>
            </div>
					</div>
				</section>
        <?php 
          $maxpages = $insights_posts->max_num_pages;
          $no_results = $maxpages > 0 ? '' : ' no-results';
        ?>

        <section class="container cwf-pagination<?php echo $no_results;?>">
            <div class="col-md-offset-3 col-md-6 ">
              <div class="input-group">
                  <span class="input-group-btn">
                  <?php
                    $pagenum = ($filter_args['offset'] / $filter_args['posts_per_page']) + 1;
                    // $disabled = $maxpages <= 1 ? 'disabled' : '';
                    $prev_disabled = $next_disabled = '';
                    if ($pagenum <= 1) {
                      $prev_disabled = 'disabled';
                    }
                    if ($pagenum == $maxpages) {
                      $next_disabled = 'disabled';
                    }
                  ?>
                    <svg class="pagination-arrow <?php echo $prev_disabled;?>" height="46" width="102">
                      <text x="26" y="28"><?php _e('Previous', 'Conduent'); ?></text>
                      <polygon class="previous-arrow" points="99,4 16,4 4,23 16,43 99,43"></polygon> <!-- left pointing arrow -->
                    </svg>
                  </span>
                  <div class="number-container">
                    <input type="text" class="form-control text-center" value="<?php echo $pagenum;?>" placeholder="1" id='cwf-pagenum'>
                    <div id='cwf-max-pages' data-pages-per-load='9' data-maxpage="<?php echo $maxpages; ?>" class="of-number"><?php _e('of', 'Conduent'); echo " $maxpages";?></div>
                  </div>
                  <span class="input-group-btn">
                    <svg class="pagination-arrow <?php echo $next_disabled; ?>" height="46" width="102">
                      <text x="29" y="28"><?php _e('Next', 'Conduent'); ?></text>
                      <polygon class="next-arrow" points="4,4 87,4 99,23 87,43 4,43"></polygon> <!-- right pointing arrow -->
                    </svg>

                  </span>
                </div>
            </div>
        </section>
				<?php
				//get_template_part( 'template-parts/pagination', 'page' );
				
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();

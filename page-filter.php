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
        <script>
        jQuery(document).ready(function($) {
          
          $('.dropdown li[data-filter]').click(function(event) {
            event.preventDefault();
            clicked_filter = $(this).data('filter');
            $('[data-filter="' + clicked_filter + '"]').removeClass('active');
            $(this).addClass('active');
            var post_category = $('.active[data-filter="category"]').data('slug');
            var post_type = $('.active[data-filter="post-type"]').data('slug');
            var new_url = location.origin + location.pathname;
            $('.dropdown li.active[data-filter]').each(function() {
              if (new_url.indexOf('?') == -1) {
                new_url = new_url + '?' + $(this).data('filter') + '=' + $(this).data('slug');
              }
              else {
                new_url = new_url + '&' + $(this).data('filter') + '=' + $(this).data('slug');
              }
            });
            history.replaceState({'Insights': 'Insights'}, 'Insights', new_url);
            $.ajax({
                url: window.cdu_vars.site_url + '/wp-admin/admin-ajax.php',
                crossDomain: true,
                data: {
                    'action':'cwf_insights_filtered_posts_ajax',
                    'category': post_category,
                    'post-type': post_type
                },
                xhrFields: {
                    withCredentials: true
                },                
                success:function(data) {
                    $('#insights-grid').html(data);
                },
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });          
          });
          $('.cwf-reset a').click(function(event) {
            event.preventDefault();
            if ($('.dropdown li.active[data-filter]').length > 0) {
              $('.dropdown li.active[data-filter]').removeClass('active');
              var new_url = location.origin + location.pathname;
              history.replaceState({'Insights': 'Insights'}, 'Insights', new_url);
              $.ajax({
                url: window.cdu_vars.site_url + '/wp-admin/admin-ajax.php',
                crossDomain: true,
                data: {
                    'action':'cwf_insights_filtered_posts_ajax'
                },
                xhrFields: {
                    withCredentials: true
                },                
                success:function(data) {
                    $('#insights-grid').html(data);
                },
                error: function(errorThrown){
                    console.log(errorThrown);
                }
              });
            }
          });
          var filter_args = location.search.split(/[?&]/);
          for(var i = 1; i < filter_args.length; i++) {
            [filter, slug] = filter_args[i].split('=');
            $('[data-filter="' + filter + '"][data-slug="' + slug + '"]').addClass('active');
          }
        });
        </script>
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
				get_template_part( 'template-parts/pagination', 'page' );
				
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();

<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Conduent
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main search-results" role="main">
			<section class="container">
				<div class="row cwf-padding-top-xs-24 cwf-padding-bottom-xs-24 cwf-padding-top-sm-64 cwf-padding-bottom-sm-64 cwf-padding-top-lg-104 cwf-padding-bottom-lg-104 cwf-padding-top-md-104 cwf-padding-bottom-md-104">
					<div class="col-sm-12 col-lg-8 col-md-8 cwf-padding-top-xs-24 cwf-padding-top-sm-0 cwf-padding-top-lg-0 cwf-padding-top-md-0 cwf-margin-bottom-xs-64 cwf-margin-bottom-sm-80 cwf-margin-bottom-md-80">

						<h1 class="cwf-margin-top-0"><?php the_field('404_page_title', 'option'); ?></h1>

						<?php if(get_field('404_show_url', 'option')): ?>
							<h2>The requested URL <b><?php echo $_SERVER['REQUEST_URI']; ?></b> could not be found on our site.</h2>
						<?php endif; ?>

						<?php if(get_field('404_show_search_trigger', 'option')): ?>
							<h2>Please check the URL and try again, browse topics below or <a href="/search" class="link-blue trigger-search">search</a> by keyword.</h2>
						<?php endif; ?>
						
						<?php the_field('404_page_body', 'option'); ?>

					</div>

					<div class="col-xs-12 hr visible-xs"><hr class="cwf-margin-bottom-xs-16 cwf-margin-top-xs-0"></div>

					<div class="col-xs-offset-0 col-sm-offset-0 col-sm-12 col-xs-12 col-lg-3 col-md-offset-1 col-md-3 col-sm-offset-0 cwf-padding-top-md-0 cwf-padding-bottom-xs-24 cwf-padding-bottom-lg-0 cwf-padding-bottom-md-0">

						<div class="hr visible-sm"><hr class="cwf-margin-bottom-xs-16 cwf-margin-top-xs-0"></div>

						<?php if(trim(get_field('404_sidebar_title', 'option')) != ''): ?>
							<p class="cwf-margin-top-xs-0 cwf-padding-bottom-xs-32 visible-md visible-lg"><?php the_field('404_sidebar_title', 'option'); ?></p>
							<h2 class="cwf-margin-bottom-xs-0 cwf-padding-bottom-xs-16 visible-sm visible-xs"><?php the_field('404_sidebar_title', 'option'); ?></h2>
						<?php endif; ?>
						
						<?php
							$side_post = get_field('404_side_article', 'option');
							if($side_post):
								$vec = '';
								$end_content = '';
								if (has_post_thumbnail($side_post->ID)) {
								    $image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id($side_post->ID, 'full'));
								    $selected_thumb = $image_attributes[0];
								    if(get_post_mime_type(get_post_thumbnail_id($side_post->ID, 'full')) == 'image/svg+xml'){
								      $post_image_parts = explode('_', $image_attributes[0]);
								      array_pop($post_image_parts);
								      $selected_thumb = implode('_', $post_image_parts) . '_md.svg';
								      $vec = ' vector';
								    }
								} else {
								    $selected_thumb = 'http://placehold.it/600x200';
								}
								echo '<a href="' . get_permalink($side_post->ID) . '" class="cwf-article-title-under sidebar cwf-padding-left-0 cwf-padding-right-0 col-xs-12 cwf-border-med-light-gray individual_post'.$vec.'">';
									echo '<div class="image col-xs-12 col-sm-3 col-md-12 col-lg-12" style="background-image: url('.$selected_thumb.')"></div>';
									echo '<div class="content col-xs-12 col-sm-9 col-md-12">';
									echo '<hr class="cwf-hr article" />';

									echo '<h4 class="title">' . wp_trim_words($side_post->post_title, '6', '...') . '</h4>';

									if (trim($side_post->post_excerpt) != "") {
										echo '<p>' . wp_trim_words($side_post->post_excerpt, '10', '...') . '</p>';
									} else {
										$vc_post_content = $side_post->post_content;
										if (substr($vc_post_content, 0, 3) == '[vc') {
									      $needle = '[vc_column_text]';
									      $start_pos = strpos($vc_post_content, $needle) + strlen($needle);
									      $vc_post_content = substr($vc_post_content, $start_pos);
									    }
									    $my_excerpt = preg_split( '/(\.|!|\?)\s/', $vc_post_content, 4, PREG_SPLIT_DELIM_CAPTURE);
									    echo '<p>';
									    for ($i=0; $i<1; $i++) {
									      if (array_key_exists($i, $my_excerpt)) {
									        echo wp_trim_words($my_excerpt[$i], '10', '...');
									      }
									    }
									    echo '</p>';
									}
									echo '<div class="cta cwf-padding-top-32 link-blue">' .get_field('404_side_article_cta', 'option'). '</div>';
									echo '</div>';
								echo '</a>';
							endif;
						?>

						<?php if(get_field('404_show_button_in_sidebar', 'option')): 
								$link_type = get_field('link_type', 'option');
						?>
						<a class="btn block-arrow regular cwf-margin-top-32 cwf-margin-bottom-xs-16 cwf-margin-bottom-sm-16 cwf-margin-bottom-md-0 cwf-margin-bottom-lg-0 col-xs-12 col-sm-12 col-md-12 col-md-offset-0 col-lg-12" href="<?php the_field($link_type.'_link', 'option'); ?>">
							<div>
								<?php the_field('cta_text', 'option'); ?>
							</div>
							<div class="cwf-clear"></div>
						</a>
						<?php endif; ?>

						<div class="pb_clearfix"></div>
					</div>
				</div>
			</section>

			<?php include(locate_template('template-parts/link-list.php'));  ?>

			

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();

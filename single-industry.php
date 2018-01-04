<?php

/*
Template for displaying Industry pages
*/

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
				if( function_exists('have_rows')):
				include(locate_template('template-parts/medium-image-header.php'));
				include(locate_template('template-parts/banner.php'));

				get_template_part( 'template-parts/social-rail', 'page' );

				$noposts = '';
				$article_posts = array();
				$cur_post_title = get_the_title();
				$associated_category = get_cat_ID($cur_post_title);

				//get the ids of all selected items on this service page
				$selected_items = get_field('add_to_solutions');

				$pullthis = array();
				if(!empty($selected_items)):
					$pullthis['fields'] = 'ids';
				endif;

				//if there is no category with the same name as this services page,
				//then this services does not have any services under it
				if($associated_category == 0):
					$children_array = array();
				else:
					$pullthis['post_type'] 		= 'industry';
					$pullthis['post_status'] 	= 'publish';
					$pullthis['orderby' ] 		= 'title';
					$pullthis['order'] 			= 'ASC';
					$pullthis['cat'] 			= $associated_category;
					$pullthis['suppress_filters'] = false;

					$children_array = get_children($pullthis);

					if(!empty($selected_items)):
      					$grab_these = array_merge($children_array, $selected_items);
      				endif;
				endif;

				// this services page has no children then find solutions associated with it
				// pull only solutions that are children of a solution that has the same title
				//as this services page
				if(empty($children_array)):
					$solution_page_parent = get_page_by_title($cur_post_title, 'OBJECT', 'solution');
					if($solution_page_parent != ''):

							$pullthis['post_type']		= 'solution';
							$pullthis['post_status']	= 'publish';
							$pullthis['posts_per_page']	= -1;
							$pullthis['order']			= 'ASC';
							$pullthis['orderby']		= 'title';
							$pullthis['post_parent']	= $solution_page_parent->ID;
							$pullthis['suppress_filters'] = false;

							$solutions_query  = new WP_Query($pullthis);

							if(!empty($selected_items)):
								$grab_these = array_merge($solutions_query->posts, $selected_items);
							else:
								$solutions_query = new WP_Query($pullthis);
							endif;
					elseif(!empty($selected_items)):
						$grab_these = $selected_items;
					endif;
				endif;

				if(!empty($selected_items)):
  					//get all selected items and services in alphabetical order
				    $pt_query = new WP_Query( array(
				    	'post_type'		   => get_post_types(),
				        'post_status'      => 'publish',
				        'order'            => 'ASC',
				        'orderby'          => 'title',
				        'posts_per_page'   => -1,
				        'post__in'         => $grab_these,
						'suppress_filters' => false
				    ) );

  				endif;

				if(empty($children_array)):
					if($solution_page_parent != ''):
						if(!empty($selected_items)):
							$article_posts = $pt_query->posts;
						else:
							$article_posts = $solutions_query->get_posts();
						endif;
					elseif(!empty($selected_items)):
						$article_posts = $pt_query->posts;
					else:
						$noposts = 'This page currently has no solutions';
					endif;
				else:
					if(!empty($selected_items)):
						$article_posts = $pt_query->posts;
					else:
						$article_posts = $children_array;
					endif;

				endif;

				if($associated_category == 0):
					$s_title = 'Solutions';
				else:
					$s_title = 'Solution Sets';
				endif;

			?>
					 <section class="light-gray-bg solution-holder">
						<div class="container cwf-padding-top-48 cwf-padding-bottom-24">
							<div class="row">
								<div class="col-md-12">
									<div class="cwf-margin-bottom-16 cwf-margin-top-0 h1"><?php _e($s_title, 'Conduent'); ?></div>
								</div>

								<div class="container cwf-post-list solutions">
									<div class="row">
										<?php

											echo $noposts;

											if( !empty($article_posts)):
												foreach( $article_posts as $article_post):
										?>
												<div class="col-xs-12 col-sm-6 col-md-6">
													<a href="<?php echo get_permalink($article_post->ID) ?>" class="cwf-card">
														<hr class="cwf-hr article">
														<h2 class="title text-capitalize"><?php echo get_the_title($article_post->ID); ?></h2>
														<?php $blurb = (trim($article_post->post_excerpt) == '') ? get_field('text_blurb', $article_post->ID) : $article_post->post_excerpt; ?>
														<div class="excerpt black-text"><?php echo $blurb; ?></div>
														<div class="clearfix"></div>
													</a>
												</div>
										<?php
												endforeach;
											endif;
										?>
									</div>
								</div>
					</section>

					<section>
						<div class="container cwf-post-list insights cwf-padding-top-64 cwf-padding-bottom-sm-80 cwf-padding-bottom-md-104">
							<div class="row">
								<div class="col-md-9 col-sm-8">
									<div class="col-md-12 cwf-margin-bottom-16 cwf-margin-top-0 h1"><?php the_field('section_title') ?></div>
								</div>
								<?php if(get_field('show_link_to_page')):
										$keyInsightsLink = '';
										if(get_field('show_link_to_insights_page') == 'external'):
											$keyInsightsLink = get_field('url_to_non-site_page');
										else:
											$keyInsightsLink = get_field('link_to_internal_page');
										endif;
								?>
								<div class="col-md-3 col-sm-4 cwf-padding-bottom-10 hidden-xs">
									<a href="<?php echo $keyInsightsLink; ?>" class="btn block-arrow regular"><?php the_field('link_text'); ?></a>
								</div>
								<?php endif; ?>
							</div>
							<div class="row">
								<?php
									$get_article_posts = get_field('select_articles_to_show');
									if(is_array($get_article_posts)):
										// clearing out the array to get rid of the solution posts from 
										unset($article_posts);
										$article_posts = array();
										
										if(is_object($get_article_posts[0])):
											// if first value in the array is an object it is an original or
											// manually selected insights so pass info as is											
											$article_posts = $get_article_posts;
										else:
											// if is an array, this is a collection of ids where the translations
											// need to be found
											foreach($get_article_posts as $gap):
												$translated_article_post = apply_filters( 'wpml_object_id', $gap, 'insights' );
												if(trim($translated_article_post) != ''):
													array_push($article_posts, $translated_article_post);
												endif;
											endforeach;
										endif;
										$template_pull = 'template-parts/article-preview-no-meta.php';
										include(locate_template('template-parts/grid-layout.php'));
									endif;
								?>
							</div>
							<?php if(get_field('show_link_to_page')): ?>
							<div class="col-sm-12 cwf-padding-top-sm-24 cwf-padding-top-xs-48 visible-xs-block">
								<a href="<?php echo $keyInsightsLink; ?>" class="btn block-arrow regular"><?php the_field('link_text'); ?></a>
							</div>
							<?php endif; ?>
						</div>
					</section>
			<?php
				endif; //end if function_exists
			endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
?>

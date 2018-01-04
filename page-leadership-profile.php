<?php
/**
* Template Name: Leadership Profile

* @package Conduent

**/

get_header(); ?>
	<div id="primary" class="content-area leader-profile corporate-page light-gray-bg">
		<main id="main" class="site-main" role="main">

			<section class="cwf-profile-image-header container-fluid" style="background-image: url(<?php the_field('profile_banner_portrait'); ?>)">
				<div class="name-title col-sm-6">
					<h1 class="white-text cwf-margin-top-0 cwf-margin-bottom-0"><?php the_field('profile_name'); ?></h1>			
					<h2 class="white-text"><?php the_field('profile_title'); ?></h2>
				</div>
			</section>


			<section class="container-fluid white-bg">

				<?php get_template_part( 'template-parts/social-rail', 'leadership' ); ?>

				<div class="container profile">
					<div class="row">

						<div class="pb_column_container col-sm-12 col-lg-8 col-md-8">
							<p><?php the_field('profile_copy'); ?></p>
						</div>

						<div class="pb_column_container col-sm-12 col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3 col-sm-offset-0">
							<div class="cwf-article-menu cwf-padding-left-0 cwf-padding-right-0 col-xs-12 col-xs-offset-0 col-sm-11 col-sm-offset-1 col-md-12 col-md-offset-0 cwf-padding-bottom-48">
								<?php
									// get parent url
									global $post;
									$parent_url = get_permalink($post->post_parent);
								?>
								<h3 class="visible-md-block visible-lg-block"><a href="<?php echo $parent_url; ?>">Leadership</a></h3>
								<ul class="visible-md-block visible-lg-block" style="margin-bottom: 32px;">
								<?php
								$profile_array = array(
									'post_type'      => 'page',
									'meta_key'       => '_wp_page_template',
									'meta_value'     => 'page-leadership-profile.php',
									'orderby'        => 'menu_order',
									'post_status'    =>  'publish', 
									'order'          => 'ASC',
									'posts_per_page' => -1
								);
								$exec_query = new WP_Query($profile_array);
								if($exec_query->have_posts()):
									while($exec_query->have_posts()): $exec_query->the_post();
										$pid = get_the_ID();
										if(get_field('profile_type', $pid) == 'executive'):
											if ( is_page($pid) ) {
												echo '<li class="current">' . get_field('profile_name', $pid) . '</li>' . PHP_EOL;
											} else {
												echo '<li><a href="' . get_permalink($pid) . '">' . get_field('profile_name', $pid) . '</a></li>' . PHP_EOL;
											}
										endif;
									endwhile;
								endif;
								wp_reset_query();
								?>
								</ul>
								<h3 class="visible-md-block visible-lg-block"><a href="<?php echo $parent_url; ?>">Board of Directors</a></h3>
								<ul class="visible-md-block visible-lg-block" style="margin-bottom: 32px;">
								<?php
								$bod_query = new WP_Query($profile_array);
								if($bod_query->have_posts()):
									while($bod_query->have_posts()): $bod_query->the_post();
										$pid = get_the_ID();
										if(get_field('profile_type', $pid) == 'director'):
											if ( is_page($pid) ) {
												echo '<li class="current">' . get_field('profile_name', $pid) . '</li>' . PHP_EOL;
											} else {
												echo '<li><a href="' . get_permalink($pid) . '">' . get_field('profile_name', $pid) . '</a></li>' . PHP_EOL;
											}
										endif;
										wp_reset_query();
									endwhile;
								endif;
								?>
								</ul>
							</div>
						</div>

					</div>
				</div>
			</section>

			<section class="container bottom-articles">
				<div class="row">
				<?php
				if(have_rows('corporate_page_cards')):
					while(have_rows('corporate_page_cards')): the_row();
						$open_new_pg = '';
						$link_kind = get_sub_field('link_type_link_type');
						if($link_kind == 'external'):
							$open_new_pg = ' target="_blank"';
						endif;
						echo '<div class="col-xs-12 col-md-6 article-container">' . PHP_EOL;
							echo '<a class="cwf-article-image-left" href="' . get_sub_field('link_type_'.$link_kind.'_link') . '"'.$open_new_pg.'>' . PHP_EOL;
								echo '<div class="image col-xs-6" style="background-image: url(' . get_sub_field('card_image') . ');"></div>' . PHP_EOL;
								echo '<div class="content col-xs-6">' . PHP_EOL;
									echo '<hr class="cwf-hr article">' . PHP_EOL;
									echo '<h4 class="title">' . get_sub_field('card_title') . '</h4>' . PHP_EOL;
									echo '<p class="hidden-xs">' . get_sub_field('card_text') . '</p>' . PHP_EOL;
									echo '<div class="cta link-blue hidden-xs">Learn more</div>' . PHP_EOL;
								echo '</div>' . PHP_EOL;
							echo '</a>' . PHP_EOL;
						echo '</div>' . PHP_EOL;
					endwhile;
				endif;
				?>
				</div>
			</section>

		</main>
	</div>

<?php
get_footer();

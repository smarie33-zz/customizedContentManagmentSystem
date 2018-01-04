 <?php
/**
* Template Name: Leadership

* @package Conduent

**/

get_header(); ?>
	<div id="primary" class="content-area leadership corporate-page light-gray-bg">
		<main id="main" class="site-main" role="main">

			<section class="cwf-large-image-header container-fluid">
				<div class="image" style="background-image: url(<?php the_field('leadspace_background'); ?>)"></div>
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-10 col-md-9">
							<h6 class="white-text eyebrow cwf-margin-top-76 cwf-margin-bottom-0"><?php the_field('eyebrow'); ?></h6>
							<h1 class="white-text title tablet-outlier"><?php the_field('leadspace_title'); ?></h1>
							<p class="white-text tablet-outlier"><?php the_field('leadspace_text'); ?></p>
						</div>
					</div>
				</div>
			</section>

			<?php
			/*
			$profile_array = array(
				'post_type'  => 'page',
				'meta_key'   => '_wp_page_template',
				'meta_value' => 'page-leadership-profile.php',
				'orderby'    => 'menu_order',
				'order'      => 'ASC'
			);
			$profile_query = new WP_Query($profile_array);
			if($profile_query->have_posts()):
				while($profile_query->have_posts()): $profile_query->the_post();
					$pid = get_the_ID();
					$q_name = get_field('profile_name', $pid);
					if($q_name == $e_name) {
						$profile_link = get_permalink($pid);
						break 2;
					}
				endwhile;
			endif;
			wp_reset_query();
			*/
			?>

			<section class="container leaders">
				<div class="row">
					<?php
					if(have_rows('executives')):
						while(have_rows('executives')): the_row();
							$e_name = trim( get_sub_field('executive_name') );
							// determine executive profile link
							$profile_array = array(
								'post_type'      => 'page',
								'meta_key'       => '_wp_page_template',
								'meta_value'     => 'page-leadership-profile.php',
								'orderby'        => 'menu_order',
								'order'          => 'ASC',
								'posts_per_page' => -1
							);
							$profile_query = new WP_Query($profile_array);
							if($profile_query->have_posts()):
								while($profile_query->have_posts()): $profile_query->the_post();
									$eid = get_the_ID();
									if (get_field('profile_type') == 'executive') {
										$qe_name = trim( get_field('profile_name', $eid) );
										if($e_name == $qe_name) {
											$profile_link = get_permalink($eid);
											break 1;
										}
									}
								endwhile;
							endif;
							wp_reset_query();
							/******************************* REMOVE THIS ONCE EXEC PORTRAITS ARE SORTED OUT!!!!!! *******************************/
							$temp_bg_color_fix = ($e_name == 'Brian Webb-Walsh' || $e_name == 'Jay Chu') ? ' background-color: #989898; background-position-y: 0px' : '';
							/********************************************************************************************************************/
							echo '<div class="col-sm-6 col-xs-12">' . PHP_EOL;
								echo '<a href="' . $profile_link . '" class="leader" style="background-image: url(' . get_sub_field('executive_portrait') . ');' . $temp_bg_color_fix . '">' . PHP_EOL;
									echo '<div class="name-title">' . PHP_EOL;
										echo '<h2 class="name white-text cwf-margin-bottom-0">' . $e_name . '</h2>' . PHP_EOL;
										echo '<span class="title white-text">' . get_sub_field('executive_title') . '</span>' . PHP_EOL;
									echo '</div>' . PHP_EOL;
								echo '</a>' . PHP_EOL;
							echo '</div>' . PHP_EOL;
							$profile_link = '#';
						endwhile;
					endif;
					?>
				</div>
			</section>

			<section class="container directors">
				<div class="row">
					<h1 class="text-center cwf-margin-top-sm-64 cwf-margin-top-xs-48 cwf-margin-bottom-md-64 cwf-margin-bottom-xs-32"><?php the_field('section_title'); ?></h1>
				</div>
				<div class="row">
					<?php
					if(have_rows('directors')):
						while(have_rows('directors')): the_row();
							$d_name = trim( get_sub_field('director_name') );
							// determine director profile link
							$d_profile_array = array(
								'post_type'      => 'page',
								'meta_key'       => '_wp_page_template',
								'meta_value'     => 'page-leadership-profile.php',
								'orderby'        => 'menu_order',
								'order'          => 'ASC',
								'posts_per_page' => -1
							);
							$d_profile_query = new WP_Query($d_profile_array);
							if($d_profile_query->have_posts()):
								while($d_profile_query->have_posts()): $d_profile_query->the_post();
									$did = get_the_ID();
									if (get_field('profile_type') == 'director') {
										$qd_name = trim( get_field('profile_name', $did) );
										if($d_name == $qd_name) {
											$d_profile_link = get_permalink($did);
											break 1;
										}
									}
								endwhile;
							endif;
							wp_reset_query();
							echo '<div class="col-md-4 col-sm-6 col-xs-12">' . PHP_EOL;
								echo '<a href="' . $d_profile_link . '" class="director" style="background-image: url(' . get_sub_field('director_portrait') . ');">' . PHP_EOL;
									echo '<div class="name-title">' . PHP_EOL;
										echo '<h2 class="name white-text cwf-margin-bottom-0">' . $d_name . '</h2>' . PHP_EOL;
										echo '<span class="title white-text">' . get_sub_field('director_title') . '</span>' . PHP_EOL;
									echo '</div>' . PHP_EOL;
								echo '</a>' . PHP_EOL;
							echo '</div>' . PHP_EOL;
							$d_profile_link = '#';
						endwhile;
					endif;
					?>
				</div>
			</section>

			<section class="container-fluid future-leaders half-frost">
				<div class="row">
				<?php
				if(have_rows('half_frosted_banner')):
					while(have_rows('half_frosted_banner')): the_row();
						if(get_sub_field('light_text')) {
							$txt_class = 'white-text';
						} else {
							$txt_class = '';
						}
						echo '<div class="image col-xs-12 visible-xs-block" style="background-image: url(' . get_sub_field('background_image') . ');"></div>' . PHP_EOL;
						echo '<div class="background col-xs-12 col-sm-6">' . PHP_EOL;
							echo '<svg>' . PHP_EOL;
								echo '<defs>' . PHP_EOL;
									echo '<filter id="blur">' . PHP_EOL;
										echo '<feGaussianBlur in="SourceGraphic" stdDeviation="20"></feGaussianBlur>' . PHP_EOL;
									echo '</filter>' . PHP_EOL;
								echo '</defs>' . PHP_EOL;
								echo '<image filter="url(#blur)" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' . get_sub_field('background_image') . '" x="0" y="0" height="100%" width="100%" preserveAspectRatio="xMinYMid slice"></image>' . PHP_EOL;
							echo '</svg>' . PHP_EOL;
						echo '</div>' . PHP_EOL;
						echo '<div class="content col-xs-12 col-sm-6">' . PHP_EOL;
							echo '<h1 class="' . $txt_class . ' cwf-margin-top-0">' . get_sub_field('banner_title') . '</h1>' . PHP_EOL;
							echo '<p class="' . $txt_class . '">' . get_sub_field('banner_text') . '</p>' . PHP_EOL;
							if(have_rows('large_cta_button')):
								while(have_rows('large_cta_button')): the_row();
									if( get_row_layout() == 'cta' ){
										if (get_sub_field('white_button_text')) {
											$btn_class = 'white';
										}
										echo '<a class="btn btn-lg transparent ' . $btn_class . ' text-uppercase" href="' . get_sub_field('cta_url') . '">' . get_sub_field('button_text') . '</a>' . PHP_EOL;
									}
								endwhile;
							endif;
						echo '</div>' . PHP_EOL;
						echo '<div class="image col-sm-6 hidden-xs" style="background-image: url(' . get_sub_field('background_image') . ');"></div>' . PHP_EOL;
					endwhile;
				endif;
				?>
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

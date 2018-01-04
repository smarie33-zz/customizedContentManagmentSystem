<?php
/**
* Template Name: Jobs

* @package Conduent

**/

get_header(); ?>
	<div id="primary" class="content-area careers corporate-page light-gray-bg">
		<main id="main" class="site-main" role="main">

		<?php
		include(locate_template('template-parts/large-video-header.php'));
		?>

			<div class="cwf-inverse-arrow">
				<div class="left"></div><div class="right"></div>
			</div>
			
			<section class="main-copy" style="background-image: url(<?php the_field('background_pattern'); ?>)">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-3">
							<hr class="cwf-hr call-out">
							<h2 class="white-text"><?php the_field('video_callout_title'); ?></h2>
							<p class="tablet-outlier white-text"><?php the_field('video_callout_text'); ?></p>
						</div>
						<div class="col-xs-12 col-sm-8 cold-md-9">
							<iframe class="youtube-video" width="710" height="399" src="<?php the_field('youtube_video_url'); ?>" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
					<div class="second row">
						<div class="col-xs-12 col-md-offset-4 col-md-8">
							<hr class="cwf-hr call-out">
							<h1 class="white-text"><?php the_field('careers_page_title'); ?></h1>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-offset-4 col-md-8">
							<p class="tablet-outlier white-text"><?php the_field('careers_page_text'); ?></p>
						</div>
					</div>
				</div>
			</section>

			<section class="container-fluid perks">
				<?php
				$index_classes = array('', 'second ', 'third ', 'fourth ', 'fifth ', 'sixth ', 'seventh ', 'eighth ', 'ninth ', 'tenth ');
				$index = 0;
				if(have_rows('career_perks')):
					while(have_rows('career_perks')): the_row();
						if(get_sub_field('image_position') == 'right') {
							$img_pos_class = ' col-sm-push-6 right-image';
							$txt_pos_class = ' col-sm-pull-6 left-text';
						} else if (get_sub_field('image_position') == 'left'){
							$img_pos_class = ' col-md-7 left-image';
							$txt_pos_class = ' col-md-5 right-text';
						}
						echo '<div class="' . $index_classes[$index] . 'row">' . PHP_EOL;
							echo '<div class="col-xs-12 col-sm-6' . $img_pos_class . '">' . PHP_EOL;
								echo '<div class="bg" style="background-image: url(' . get_sub_field('ornament') . ');">' . PHP_EOL;
									echo '<div class="image" style="background-image: url(' . get_sub_field('perks_image') . ');"></div>' . PHP_EOL;
								echo '</div>' . PHP_EOL;
							echo '</div>' . PHP_EOL;
							echo '<div class="col-xs-12 col-sm-6' . $txt_pos_class . '">' . PHP_EOL;
								echo '<hr class="cwf-hr call-out">' . PHP_EOL;
								echo '<h1>' . get_sub_field('perks_title') . '</h1>' . PHP_EOL;
								echo '<p>' . get_sub_field('perks_text') . '</p>' . PHP_EOL;
							echo '</div>' . PHP_EOL;
						echo '</div>' . PHP_EOL;
						$index++;
					endwhile;
				endif;
				?>
			</section>

			<section class="container-fluid white-bg opportunity">
				<div class="container">
					<div class="row">
						<h1 class="xlarge text-center"><?php the_field('map_title'); ?></h1>
					</div>
					<div class="content row">
						<div class="col-xs-12 col-sm-12 col-md-9">
							<img class="map" src="<?php bloginfo('template_url') ?>/svg/map_1.svg">
							<img class="map" src="<?php bloginfo('template_url') ?>/svg/map_2.svg">
							<img class="map" src="<?php bloginfo('template_url') ?>/svg/map_3.svg">
							<img class="map" src="<?php bloginfo('template_url') ?>/svg/map_4.svg">
							<svg class="map orangeDots" viewBox="0 0 957 502">
								<defs><style>.cls-1{fill:#ff8700;}</style></defs>
								<circle class="cls-1" cx="484.9" cy="117.4" r="3"/><circle class="cls-1" cx="497.2" cy="123" r="3"/><circle class="cls-1" cx="441.7" cy="123" r="3"/><circle class="cls-1" cx="491" cy="134.1" r="3"/><circle class="cls-1" cx="429.4" cy="156.4" r="3"/><circle class="cls-1" cx="478.7" cy="83.9" r="3"/><circle class="cls-1" cx="521.8" cy="106.2" r="3"/><circle class="cls-1" cx="743.8" cy="256.8" r="3"/><circle class="cls-1" cx="780.8" cy="212.2" r="3"/><circle class="cls-1" cx="281.5" cy="396.2" r="3"/><circle class="cls-1" cx="195.1" cy="262.4" r="3"/><circle class="cls-1" cx="244.5" cy="273.5" r="3"/><circle class="cls-1" cx="324.6" cy="334.9" r="3"/><circle class="cls-1" cx="269.1" cy="362.7" r="3"/><circle class="cls-1" cx="182.8" cy="123" r="3"/><circle class="cls-1" cx="232.2" cy="156.4" r="3"/><circle class="cls-1" cx="152" cy="206.6" r="3"/><circle class="cls-1" cx="201.3" cy="217.8" r="3"/><circle class="cls-1" cx="232.2" cy="223.3" r="3"/><circle class="cls-1" cx="509.5" cy="117.4" r="3"/><circle class="cls-1" cx="472.6" cy="123" r="3"/><circle class="cls-1" cx="441.7" cy="134.1" r="3"/><circle class="cls-1" cx="484.9" cy="162" r="3"/><circle class="cls-1" cx="435.6" cy="111.8" r="3"/><circle class="cls-1" cx="842.45" cy="407.45" r="3"/><circle class="cls-1" cx="768.5" cy="279.1" r="3"/><circle class="cls-1" cx="817.7" cy="167.6" r="3"/><circle class="cls-1" cx="756.1" cy="173.1" r="3"/><circle class="cls-1" cx="663.7" cy="228.9" r="3"/><circle class="cls-1" cx="725.35" cy="240.1" r="3"/>
							</svg>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-3 copy">
							<p class="text-left cwf-padding-bottom-md-0 tablet-outlier"><?php the_field('map_text'); ?></p>
							<?php
							if(have_rows('map_call_to_action')):
								while(have_rows('map_call_to_action')): the_row();
									if( get_row_layout() == 'cta' ) {
										$cta_url = get_sub_field('cta_url');
										$cta_text = get_sub_field('cta_text');
									}
								endwhile;
							endif;
							?>
							<a class="btn btn-lg transparent black hidden-xs hidden-sm cwf-margin-top-64 text-uppercase" href="<?php echo $cta_url; ?>" target="_blank"><strong><?php echo $cta_text; ?></strong></a>
						</div>
						<div class="col-xs-12 col-sm-4 text-center hidden-md hidden-lg">
						<a class="btn btn-lg transparent black text-uppercase cwf-margin-top-sm-32 cwf-margin-top-md-0" href="<?php echo $cta_url; ?>" target="_blank"><strong><?php echo $cta_text; ?></strong></a>
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

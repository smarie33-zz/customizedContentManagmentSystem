<?php
/*
Template Name: Home Page Masonry
*/

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php 
				//if(get_field('use_video_header')):
					include(locate_template('template-parts/large-video-header.php')); 
				//else:
			 		//include(locate_template('template-parts/large-image-header.php'));
			 	//endif;
			?>

			<div class="cwf-inverse-arrow container-fluid">
				<div class="row">
					<div class="left"></div><div class="right"></div>
				</div>
			</div>
			<section class="container-fluid light-gray-bg cwf-padding-top-xs-32 cwf-padding-bottom-xs-64 cwf-padding-top-sm-16 cwf-padding-bottom-sm-48 cwf-padding-bottom-md-64 cwf-stat-callout">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<hr class="cwf-hr call-out">							
						</div>
						<div class="col-md-3 col-sm-5">
							<h2 class="tablet-outlier"><?php the_field('call_out_title') ?></h2>
						</div>
						<div class="col-md-8 col-md-offset-1 col-sm-12">
							<p class="xs-small tablet-outlier light cwf-margin-bottom-0 cwf-margin-top-0 cwf-padding-bottom-0">
								<?php the_field('call_out_blurb') ?>
							</p>
							<?php if(function_exists("cdu_banner_display_head_section")): ?>
							<div class="cwf-padding-top-32">
								<a class="btn btn-lg transparent black-text" href="<?php the_field('call_out_cta_'.get_field('call_out_cta_link_type').'_link'); ?>"><strong><?php the_field('call_out_cta_cta_text') ?></strong></a>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>

			<section class="container-fluid light-gray-bg cwf-padding-bottom-24">
				<div class="container">
					<div class="row">
						<div id="masonry">

							<?php  //////////////// MASONRY GRID PULLING FROM ACF /////////////////

								if(function_exists('get_field')):
									$amt = get_field('grid_size'); 

								$no_col_wrapper = false;
								$change_col_size = '';
								if($amt == 9):
									$zone1 = get_field('zone_1_9up_serviceinsightvideo');
									$area = $zone1['value'].'_';
									include(locate_template('template-parts/masonry-'.$zone1['label'].'-8col.php'));

									$area = 'zone_2_9up_social_connect_';
									include(locate_template('template-parts/masonry-socialconnect.php'));

									$zone3 = get_field('zone_3_9up_servicequotevideo');
									$area = $zone3['value'].'_';
									include(locate_template('template-parts/masonry-'.$zone3['label'].'-4col.php'));

									$zone4 = get_field('zone_4_9up_serviceinsightvideo');
									$area = $zone4['value'].'_';
									include(locate_template('template-parts/masonry-'.$zone4['label'].'-8col.php'));
								
									$zone5 = get_field('zone_5_9up_serviceinsightvideo');
									$area = $zone5['value'].'_';
									include(locate_template('template-parts/masonry-'.$zone5['label'].'-8col.php'));
									
									echo '<div class="clearfix"></div>';
									echo '<div class="col-md-8">';
										$no_col_wrapper = true;
										$zone6 = get_field('zone_6_9up_serviceinsightvideo');
										$area = $zone6['value'].'_';
										include(locate_template('template-parts/masonry-'.$zone6['label'].'-8col.php'));

										$zone8 = get_field('zone_8_9up_socialinsightvideo');
										$area = $zone8['value'].'_';
										include(locate_template('template-parts/masonry-'.$zone8['label'].'-6col.php'));

										$zone9 = get_field('zone_9_9up_socialinsightvideo');
										$area = $zone9['value'].'_';
										include(locate_template('template-parts/masonry-'.$zone9['label'].'-6col.php'));
									echo '</div>';

									$zone7 = get_field('zone_7_9up_servicequotevideo');
									$area = $zone7['value'].'_';
									include(locate_template('template-parts/masonry-'.$zone7['label'].'-4col.php'));
								else:
									$zone1 = get_field('zone_1_4up_servicequotevideo');
									$area = $zone1['value'].'_';
									include(locate_template('template-parts/masonry-'.$zone1['label'].'-4col.php'));

									echo '<div class="col-md-8">';
										$change_col_size = 6;
										$zone2 = get_field('zone_2_4up_socialinsightvideo');
										$area = $zone2['value'].'_';
										include(locate_template('template-parts/masonry-'.$zone2['label'].'-6col.php'));

										$area = 'zone_3_4up_social_connect_';
										include(locate_template('template-parts/masonry-socialconnect.php'));

										$change_col_size = 12;
										$zone4 = get_field('zone_4_4up_serviceinsightvideo');
										$area = $zone4['value'].'_';
										include(locate_template('template-parts/masonry-'.$zone4['label'].'-8col.php'));
									echo '</div>';

								endif;
							endif; //end of function check
						?>
							<?php if(get_field('use_trailing_button')): ?>
							<div class="col-md-12 center cwf-padding-top-48">
								<a class="btn btn-lg transparent black-text" href="<?php the_field('trailing_button_'.get_field('trailing_button_link_type').'_link') ?>"><strong><?php the_field('trailing_button_cta_text') ?></strong></a>
							</div>
							<?php endif; ?>
							<div class="col-md-12 cwf-padding-bottom-24 hidden-xs hidden-sm"></div>
						</div>
					</div>
				</div>
			</section>

			<?php 
				if(get_field('use_a_banner')):
					include(locate_template('template-parts/banner.php')); 
				endif;
				?>

			<?php 
				if(get_field('use_link_list')):
					include(locate_template('template-parts/link-list.php'));
				endif; 
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

<?php
/**
* Template Name: Innovation

* @package Conduent

**/

get_header(); ?>
	<div id="primary" class="content-area innovation corporate-page light-gray-bg">
		<main id="main" class="site-main" role="main">

			<section class="cwf-large-image-header container-fluid">
				<svg class="shape hidden-xs" width="3001" height="660" viewBox="0 0 3001.43 659.83">
					<defs>
						<style>.cls-1{opacity:0.6;}</style>
					</defs>
					<path class="cls-1" d="M-1233.36-962.92l3001.43-.17L1411.9-303.44l-2645.26.17Z" transform="translate(1233.36 963.1)"/>
				</svg>
			<?php
			if(have_rows('large_leadspace_image')):
				while(have_rows('large_leadspace_image')): the_row();
					echo '<div class="image" style="background-image: url(' . get_sub_field('background_image') . ');"></div>' . PHP_EOL;
					echo '<div class="container">' . PHP_EOL;
						echo '<div class="row">' . PHP_EOL;
							echo '<div class="col-xs-12 col-sm-8 col-md-7 content">' . PHP_EOL;
								echo '<h6 class="white-text eyebrow cwf-margin-top-76 cwf-margin-bottom-0">' . get_sub_field('eyebrow') . '</h6>' . PHP_EOL;
								echo '<h1 class="white-text tablet-outlier cwf-margin-top-0">' . get_sub_field('leadspace_title') . '</h1>' . PHP_EOL;
							echo '</div>' . PHP_EOL;
						echo '</div>' . PHP_EOL;
 					echo '</div>' . PHP_EOL;
				endwhile;
			endif;
			?>
			</section>

			<div class="cwf-inverse-arrow">
				<div class="left"></div><div class="right"></div>
			</div>

			<div class="white-bg">

				<?php
				if(have_rows('innovation_page_title')):
					while(have_rows('innovation_page_title')): the_row();
						echo '<section class="container technology-driven">' . PHP_EOL;
							echo '<div class="row">' . PHP_EOL;
								echo '<div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">' . PHP_EOL;
									echo '<hr class="cwf-hr call-out">' . PHP_EOL;
									echo '<h1 class="xlarge text-center">' . get_sub_field('page_title') . '</h1>' . PHP_EOL;
									echo '<p class="text-center">' . get_sub_field('page_text') . '</p>'  . PHP_EOL;
								echo '</div>' . PHP_EOL;
		 					echo '</div>' . PHP_EOL;
	 					echo '</section>' . PHP_EOL;
					endwhile;
				endif;
				?>
				
				<section class="container frosted-tiles cwf-margin-top-xs-16 cwf-margin-top-md-48">
					<div class="row">
					<?php
					if(have_rows('frosted_tiles')):
						while(have_rows('frosted_tiles')): the_row();
							echo '<div class="col-xs-12 col-sm-4">' . PHP_EOL;
								echo '<div class="tile">' . PHP_EOL;
									echo '<div class="tile-bg" style="background-image: url(' . get_sub_field('background_image') . ');">' . PHP_EOL;
									echo '</div>' . PHP_EOL;
									if (get_sub_field('add_frosting')) {
										echo '<div class="frost">' . PHP_EOL;
											echo '<svg>' . PHP_EOL;
												echo '<defs>' . PHP_EOL;
													echo '<filter id="blur">' . PHP_EOL;
														echo '<feGaussianBlur in="SourceGraphic" stdDeviation="10"></feGaussianBlur>' . PHP_EOL;
													echo '</filter>' . PHP_EOL;
												echo '</defs>' . PHP_EOL;
												echo '<image filter="url(#blur)" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' . get_sub_field('background_image') . '" x="0" y="0" height="100%" width="100%" preserveAspectRatio="xMidYMax slice"></image>' . PHP_EOL;
											echo '</svg>' . PHP_EOL;
										echo '</div>' . PHP_EOL;
									}
									echo '<div class="labels">' . PHP_EOL;
										echo '<h1 class="white-text">' . get_sub_field('card_header') . '</h1>' . PHP_EOL;
										echo '<p class="white-text">' . get_sub_field('card_text') . '</p>' . PHP_EOL;
									echo '</div>' . PHP_EOL;
								echo '</div>' . PHP_EOL;
							echo '</div>' . PHP_EOL;
						endwhile;
					endif;
					?>
					</div>
				</section>


				<section class="container-fluid focus-areas">
					<div class="row">
						<div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
							<h1 class="xlarge text-center"><?php the_field('focus_title'); ?></h1>
							<p class="light text-center"><?php the_field('focus_text'); ?></p>
						</div>
					</div>

					<?php
					/*
					CLASSES

					LEFT BLEED IMAGE / RIGHT SIDE TEXT
					col-xs-12 col-sm-6
					col-xs-12 col-sm-6 

					RIGHT BLEED IMAGE / LEFT SIDE TEXT
					col-xs-12 col-sm-7 col-sm-push-5
					col-xs-12 col-sm-5 col-sm-pull-7

					*/
					if(have_rows('focus_sections')):
						while(have_rows('focus_sections')): the_row();
							if(get_sub_field('image_bleed') == 'right')  {
								$img_class = 'col-xs-12 col-sm-7 col-sm-push-5 ';
								$txt_class = 'col-xs-12 col-sm-5 col-sm-pull-7 ';
							} else if(get_sub_field('image_bleed') == 'left') {
								$img_class = 'col-xs-12 col-sm-6 ';
								$txt_class = $img_class;
							}
							$section_class = get_sub_field('section_class')['value'];
						echo '<div class="row">' . PHP_EOL;
							echo '<div class="focus-section ' . $section_class . '">' . PHP_EOL;
								echo '<div class="' . $img_class . 'image">' . PHP_EOL;
									echo '<div class="bg" style="background-image: url(' . get_sub_field('focus_image') . ')"></div>' . PHP_EOL;
								echo '</div>' . PHP_EOL;
								echo '<div class="' . $txt_class . 'content">' . PHP_EOL;
									echo '<hr class="cwf-hr call-out">' . PHP_EOL;
									echo '<h1>' . get_sub_field('section_title') . '</h1>' . PHP_EOL;
									echo '<p>' . get_sub_field('section_text') . '</p>' . PHP_EOL;
								echo '</div>' . PHP_EOL;
							echo '</div>' . PHP_EOL;
						echo '</div>' . PHP_EOL;
						endwhile;
					endif;
					?>
				</section>


				<section class="container-fluid track-record cwf-padding-bottom-64">
					<div class="row">
						<h1 class="xlarge text-center cwf-margin-top-xs-64 cwf-margin-top-md-0"><?php the_field('track_record_main_header'); ?></h1>
					</div>
					<div class="row cwf-margin-top-xs-16 cwf-margin-sm-32 cwf-margin-top-md-64">
						<div class="col-xs-12 col-sm-5 left-col">
							<?php
							if(have_rows('track_record_image')):
								while(have_rows('track_record_image')): the_row();
									if(get_row_layout() == 'compose_image'):
										echo '<div class="bg" style="background-image: url(' . get_sub_field('image_ornament') . ')">' . PHP_EOL;
											echo '<div class="image" style="background-image: url(' . get_sub_field('image') . ')"></div>' . PHP_EOL;
										echo '</div>' .PHP_EOL;
									endif;
								endwhile;
							endif;
							?>
						</div>
						<div class="col-xs-12 col-sm-7 right-col">
							<h1 class="cwf-margin-top-0 cwf-margin-bottom-16"><?php the_field('track_record_title'); ?></h1>
							<p><?php the_field('track_record_text'); ?></p>
							<?php
							if(have_rows('track_record_cta')):
								while(have_rows('track_record_cta')): the_row();
									if(get_row_layout() == 'cta'):
										echo '<p>' . PHP_EOL;
											echo '<a class="cta" href="' . get_sub_field('link_url') . '" target="_blank">' . get_sub_field('link_text') . '</a>' . PHP_EOL;
										echo '</p>' . PHP_EOL;
									endif;
								endwhile;
							endif;
							?>
							<?php
							$call_out_array = array();
							if(have_rows('track_record_call_outs')):
								while(have_rows('track_record_call_outs')): the_row();
									$gn = get_sub_field('giant_number');
									$l = get_sub_field('legend');
									$call_out_array[] = array('giant_number' => $gn, 'legend' => $l);
								endwhile;
							endif;
							?>
							<div class="row cwf-margin-top-16 hidden-sm">
								<div class="col-sm-6">
									<hr class="cwf-hr call-out">
									<div class="giant-number"><?php echo $call_out_array[0]['giant_number']; ?></div>
									<span class="legend"><?php echo $call_out_array[0]['legend']; ?></span>
								</div>
								<div class="col-sm-6 cwf-margin-top-xs-32 cwf-margin-top-sm-0">
									<hr class="cwf-hr call-out">
									<div class="giant-number"><?php echo $call_out_array[1]['giant_number']; ?></div>
									<span class="legend"><?php echo $call_out_array[1]['legend']; ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row visible-sm-block cwf-margin-top-64">
						<div class="col-sm-offset-3 col-sm-3">
							<hr class="cwf-hr call-out">
							<div class="giant-number"><?php echo $call_out_array[0]['giant_number']; ?></div>
							<span class="legend"><?php echo $call_out_array[0]['legend']; ?></span>
						</div>
						<div class="col-sm-3">
							<hr class="cwf-hr call-out">
							<div class="giant-number"><?php echo $call_out_array[1]['giant_number']; ?></div>
							<span class="legend"><?php echo $call_out_array[1]['legend']; ?></span>
						</div>
					</div>
				</section>

			</div>

			<section class="container cwf-margin-top-xs-32 cwf-margin-top-sm-64">
				<?php
				if(have_rows('in_the_news')):
					while(have_rows('in_the_news')): the_row();
						if(get_row_layout() == 'news'):
							$index_class = ($last_card) ? ' hidden-xs hidden-sm' : '';
							echo '<div class="row">' . PHP_EOL;
								echo '<h1 class="text-center cwf-margin-bottom-md-64 cwf-margin-bottom-sm-48">' . get_sub_field('section_header') . '</h1>' . PHP_EOL;
							echo '</div>' . PHP_EOL;
							echo  '<div class="row">' . PHP_EOL;
								if(have_rows('news_card')):
									while(have_rows('news_card')): the_row();
										echo '<div class="col-xs-12 col-sm-6 col-md-4">' . PHP_EOL;
											echo '<a class="cwf-article-title-under" href="' . get_sub_field('card_url') . '">' . PHP_EOL;
												if(have_rows('card_image')):
													while(have_rows('card_image')): the_row();
														if (get_row_layout() == 'image_source'):
															if (get_sub_field('image_from_url')) {
																$image_url = get_sub_field('image_url');
															}
															if (get_sub_field('upload_image')) {
																$image_url = get_sub_field('library_image');
															}
															echo '<div class="image" style="background-image: url(' . $image_url . ')"></div>' . PHP_EOL;
														endif;
													endwhile;
												endif;
												echo '<div class="content">' . PHP_EOL;
													echo '<hr class="cwf-hr article">' . PHP_EOL;
													echo '<h2 class="title">' . get_sub_field('card_title') . '</h2>' . PHP_EOL;
													echo '<p>' . get_sub_field('card_excerpt') . '</p>' . PHP_EOL;
													echo '<div class="cta link-blue" target="_blank">Read more</div>' . PHP_EOL;
												echo '</div>' . PHP_EOL;
											echo '</a>' . PHP_EOL;
										echo '</div>' . PHP_EOL;
									endwhile;
								endif;
							echo '</div>' . PHP_EOL;
						endif;
					endwhile;
				endif;
				?>
			</section>

			<!-- <div class="text-center">
				<a class="btn btn-lg transparent black text-uppercase see-news-btn" href="https://www.news.conduent.com/">See latest news</a>
			</div> -->

			<section class="conduent-labs cwf-margin-top-md-104 cwf-margin-top-xs-80">
				<?php
				if(have_rows('lab_card')):
					while(have_rows('lab_card')): the_row();
						if(get_sub_field('left_column')) {
							$col_class = 'left-col';
						} else {
							$col_class = 'right-col';
						}
						echo '<div class="' . $col_class . '">' . PHP_EOL;
							echo '<div class="lab" style="background-image: url(' . get_sub_field('background_image') . ')">' . PHP_EOL;
								echo '<div class="lab-info">' . PHP_EOL;
									echo '<h2>' . get_sub_field('card_header') . '</h2>' . PHP_EOL;
									echo '<p>' . get_sub_field('card_text') . '</p>' . PHP_EOL;
									if(have_rows('call_to_action')):
										while(have_rows('call_to_action')): the_row();
											if(get_row_layout() == 'cta'):
												//echo '<div class="text-center">' . PHP_EOL;
												$open_in_new_window = get_sub_field('open_in_new_window') ? ' target="_blank"' : '';
												echo '<a class="btn btn-lg transparent black text-uppercase cwf-margin-top-md-32 cwf-margin-top-xs-32" href="' . get_sub_field('cta_url') . '"' . $open_in_new_window . '><strong>' . get_sub_field('cta_text') . '</strong></a>' . PHP_EOL;
												//echo '</div>' . PHP_EOL;
											endif;
										endwhile;
									endif;
								echo '</div>' . PHP_EOL;
							echo '</div>' . PHP_EOL;
						echo '</div>';
					endwhile;
				endif;
				?>
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

<?php
/**
* Template Name: About

* @package Conduent

**/

get_header(); ?>

<div id="primary" class="content-area about-us corporate-page light-gray-bg">
	<main id="main" class="site-main" role="main">

		<?php
		include(locate_template('template-parts/large-video-header.php'));
		?>

		<div class="cwf-inverse-arrow">
			<div class="left"></div><div class="right"></div>
		</div>
			
		<section class="container conduent-difference">
			<div class="row">
				<div class="col-xs-12 col-sm-offset-4 col-sm-8">
					<hr class="cwf-hr call-out">	
					<h1 class="xlarge"><?php the_field('headline'); ?></h1>
					<p class="light"><?php the_field('intro_text'); ?></p>
				</div>
			</div>
		</section>
			
		<?php
		if(have_rows('difference_row')):
			while(have_rows('difference_row')): the_row();
				if(get_row_layout() == 'add_columns'):
					$col1_text = get_sub_field('column_1');
					if(have_rows('column_2')):
						while(have_rows('column_2')): the_row();
							if(get_row_layout() == 'col_2_lockup'):
								$col2_big_num = get_sub_field('giant_number');
								$col2_text = get_sub_field('description');
							endif;
						endwhile;
					endif;
					if(have_rows('column_3')):
						while(have_rows('column_3')): the_row();
							if(get_row_layout() == 'col_3_lockup'):
								$col3_big_num = get_sub_field('giant_number');
								$col3_text = get_sub_field('description');
							endif;
						endwhile;
					endif;
				endif;
			endwhile;
		endif;		
		?>

		<section class="container cwf-margin-top-xs-0 cwf-margin-top-sm-32 cwf-margin-top-md-64">
			<div class="row">
				<div class="col-xs-12 col-sm-4 top-border lives cwf-margin-bottom-xs-32"><?php echo $col1_text; ?></div>
				<div class="col-xs-6 col-sm-4 top-border industries">
					<div class="giant-number"><?php echo $col2_big_num; ?></div>
					<?php echo $col2_text; ?>
				</div>
				<div class="col-xs-6 col-sm-4 top-border countries">
					<div class="giant-number"><?php echo $col3_big_num; ?></div>
					<?php echo $col3_text; ?>
				</div>
			</div>
		</section>

		<section class="container frosted-tiles cwf-margin-top-xs-32 cwf-margin-top-sm-48 cwf-margin-top-md-64 cwf-padding-top-md-64">
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
									echo '<h6 class="white-text eyebrow">' . get_sub_field('eyebrow_text') . '</h6>' . PHP_EOL;
									echo '<div class="white-text giant-number">' . get_sub_field('giant_number') . '</div>' . PHP_EOL;
									echo '<p class="white-text">' . get_sub_field('card_text') . '</p>' . PHP_EOL;
								echo '</div>' . PHP_EOL;
							echo '</div>' . PHP_EOL;
						echo '</div>' . PHP_EOL;
					endwhile;
				endif;
				?>

			</div>
		</section>

		<?php
		if(have_rows('motto')):
			while(have_rows('motto')): the_row();
				$light_text = get_sub_field('light_text') ? 'white-text ': '';
				echo '<section class="container-fluid motto" style="background-image: url(' . get_sub_field('background_image') . ');">' . PHP_EOL;
					echo '<h1 class="' . $light_text . 'text-center">' . get_sub_field('motto_text') . '</h1>' . PHP_EOL;
				echo '</section>' . PHP_EOL;
			endwhile;
		endif;
		?>

		<section class="container">
			<div class="row">
				<h1 class="xlarge text-center cwf-margin-top-104 cwf-margin-bottom-md-64 cwf-margin-bottom-sm-48 cwf-padding-bottom-md-16"><?php the_field('recognition_header'); ?></h1>
			</div>
			<div class="row">
			<?php
			if(have_rows('award')):
				while(have_rows('award')): the_row();
					echo '<div class="award col-xs-12 col-sm-6 col-md-4">' . PHP_EOL;
						echo '<hr class="cwf-hr call-out">' . PHP_EOL;
						echo '<h6 class="eyebrow">' . get_sub_field('eyebrow') . '</h6>' . PHP_EOL;
						echo '<span class="award-title">' . get_sub_field('award_title') . '</span>' . PHP_EOL;
						echo '<p>' . get_sub_field('awarder') . '</p>' . PHP_EOL;
					echo '</div>' . PHP_EOL;
				endwhile;
			endif;
			?>
			</div>
		</section>

		<section class="container-fluid innovation half-frost cwf-margin-top-32">
			<div class="row">
			<?php
			if (have_rows('half_frosted_banner')):
				while(have_rows('half_frosted_banner')): the_row();
					$white_text = get_sub_field('light_text') ? 'white-text ' : '';
					echo '<div class="image col-xs-12 visible-xs-block" style="background-image: url(' . get_sub_field('mobile_background_image') . ');">' . PHP_EOL;
					echo '</div>' . PHP_EOL;
					echo '<div class="background col-xs-12 col-sm-6">' .PHP_EOL;
						echo '<svg>' . PHP_EOL;
							echo '<image filter="url(#blur)" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' . get_sub_field('frosted_background') . '" x="0" y="0" height="100%" width="100%" preserveAspectRatio="xMidYMax slice"></image>' . PHP_EOL;
						echo '</svg>' . PHP_EOL;
					echo '</div>' . PHP_EOL;
					echo '<div class="content col-xs-12 col-sm-6">' . PHP_EOL;
						echo '<h1 class="' . $white_text . 'cwf-margin-top-0">' . get_sub_field('banner_title') . '</h1>' . PHP_EOL;
						echo '<p class="' . $white_text . '">' .  get_sub_field('banner_text') . '</p>' . PHP_EOL;
						if(have_rows('large_cta_button')):
							while(have_rows('large_cta_button')): the_row();
								if(get_row_layout() == 'cta'):
									$white_button_text = get_sub_field('white_button_text') ? 'white ' : '';
									echo '<a href="' . get_sub_field('cta_url') . '" class="btn btn-lg transparent ' . $white_button_text . 'text-uppercase">' . get_sub_field('button_text') . '</a>' . PHP_EOL;
								endif;
							endwhile;
						endif;
					echo '</div>' . PHP_EOL;
					echo '<div class="image col-sm-6 hidden-xs" style="background-image: url(' . get_sub_field('background_image') . ');">' . PHP_EOL;
					echo '</div>' . PHP_EOL;
				endwhile;
			endif;
			?>
			</div>
		</section>

		<section class="container cwf-margin-top-xs-32 cwf-margin-top-sm-64">
			<?php
			if(have_rows('in_the_news')):
				while(have_rows('in_the_news')): the_row();
					if(get_row_layout() == 'news'):
						echo '<div class="row">' . PHP_EOL;
							echo '<h1 class="text-center cwf-margin-bottom-md-64 cwf-margin-bottom-sm-48">' . get_sub_field('section_header') . '</h1>' . PHP_EOL;
						echo '</div>' . PHP_EOL;
						echo '<div class="row">' . PHP_EOL;
						if(have_rows('news_card')):
							while(have_rows('news_card')): the_row();
								echo '<div class="col-xs-12 col-sm-6 col-md-4">' . PHP_EOL;
									echo '<a class="cwf-article-title-under" href="' . get_sub_field('card_url') . '" target="_blank">' . PHP_EOL;
										if(have_rows('card_image')):
											while(have_rows('card_image')): the_row();
												if (get_row_layout() == 'image_source'):
													if (get_sub_field('image_from_url')) {
														$image_url = get_sub_field('image_url');
													}
													if (get_sub_field('upload_image')) {
														$image_url = get_sub_field('library_image');
													}
													echo '<div class="image" style="background-image: url(' . $image_url . ');"></div>' . PHP_EOL;
												endif;
											endwhile;
										endif;
										echo '<div class="content">' . PHP_EOL;
											echo '<hr class="cwf-hr article">' . PHP_EOL;
											echo '<h2 class="title">' . get_sub_field('card_title') . '</h2>' . PHP_EOL;
											echo '<p>' . get_sub_field('card_excerpt') . '</p>' . PHP_EOL;
											echo '<div class="cta link-blue">Read more</div>' . PHP_EOL;
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

		<div class="text-center">
			<a class="btn btn-lg transparent black text-uppercase see-news-btn" href="https://www.news.conduent.com/" target="_blank">See latest news</a>
		</div>

		<section class="container-fluid headquarters">
			<div class="row">
				<?php
				if(have_rows('corporate_headquarters')):
					while(have_rows('corporate_headquarters')): the_row();
						echo '<div class="image" style="background-image: url(' . get_sub_field('background_image') . ')"></div>' . PHP_EOL;
						echo '<div class="content">' . PHP_EOL;
							echo '<h2 class="title">' . get_sub_field('banner_title') . '</h2>' . PHP_EOL;
							echo '<p>' . get_sub_field('address') . '</p>' . PHP_EOL;
							if (get_sub_field('show_map')):
								echo '<p class="cwf-padding-bottom-sm-32">' . PHP_EOL;
									echo '<a target="_blank" href="' . get_sub_field('map_url') . '">MAP</a>' . PHP_EOL;
								echo '</p>' . PHP_EOL;
							endif;
						echo '</div>' . PHP_EOL;
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

<?php
/**
 * Template part for displaying a medium sized header
 * 1 large image
 * 1 title
 *
 * single.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */

get_template_part( 'template-parts/breadcrumbs', 'page' );

include(locate_template('template-parts/warning-box.php'));

if( function_exists('have_rows')):
	$changeTextClass = '';
	$changeBtnClass = '';
if(get_field('light_or_dark_text')):
	if(get_field('light_or_dark_text') == 'light'):
		$changeTextClass = 'white-text';
		$changeBtnClass = ' white';
	else:
		$changeTextClass = 'black-text';
	endif;
else:
	$changeTextClass = 'black-text';
endif;


$bg_image = get_field('background_image');
if(is_numeric($bg_image)):
	$get_url = wp_get_attachment_image_src($bg_image, 'full');
	$bg_image_output = $get_url[0];
else:
	$bg_image_output = $bg_image;
endif;

$pathfill="";
if(get_field('overly_light_dark')):
	$pathfill = get_field('overly_light_dark');
endif;

?>

<section class="cwf-medium-image-header container-fluid" style="background-image: url(<?php echo $bg_image_output; ?>)">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h6 class="<?php echo $changeTextClass; ?>"><?php the_title(); ?></h6>
				<?php  if(trim(get_field('text_title')) != ''):  ?>
				<h1 class="<?php echo $changeTextClass; ?>"><?php the_field('text_title'); ?></h1>
				<?php endif; ?>
			</div>
			<div class="col-sm-7">				
				<?php  if(trim(get_field('text_blurb')) != ''):  ?>
				<h2 class="<?php echo $changeTextClass; ?>"><?php the_field('text_blurb'); ?></h2>
				<?php endif; ?>
				<?php if(get_field('use_button')): ?>
					<a class="btn btn-lg transparent<?php echo $changeBtnClass; ?> text-uppercase" href="<?php the_field('button_url') ?>"><strong><?php the_field('button_text') ?></strong></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php if(get_field('use_overlay')): ?>
	<div class="for-mobile visible-xs-block">
		<div class="overlay <?php echo $pathfill; ?>"></div>
		<svg width="100%" height="100%" style="position: relative; left: 0; top: 0;">
			<defs>
				<filter id="blur" x="0%" y="0%" width="100%" height="100%">
					<feGaussianBlur in="SourceGraphic" stdDeviation="10"></feGaussianBlur>
					<feComponentTransfer>
						<feFuncA type="discrete" tableValues="1 1"></feFuncA>
					</feComponentTransfer>
				</filter>
			</defs>
			<image filter="url(#blur)" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $bg_image_output; ?>" x="0" y="0" height="100%" width="100%" preserveAspectRatio="xMinYMin slice"></image>
		</svg>
	</div>
	<div class="holder hidden-xs">
		<svg class="shape hidden-xs" width="100%" height="100%" viewBox="0 0 1442 659.83">		
			<defs>
				<style>.cls-1{opacity:0.6;}</style>
			</defs>
			<path class="cls-1" d="M-3250,-300 L-3250,780 L800,780 1100,-300 Z" fill="<?php echo $pathfill; ?>"></path>
	 	 </svg>
 	 </div>
<?php endif; ?>
</section>

<?php endif; ?>

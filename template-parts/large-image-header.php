<?php
/**
 * Template part for displaying a large size header
 * 1 large image
 * 1 large title
 * optional overlay
 * optional overlay title
 * optional overlay blurb
 *
 * page-home.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */


?>

<?php if( function_exists('have_rows')):
$changeTextClass = '';
$changeBtnClass = '';
if (get_field('light_or_dark_text') == 'light'):
	$changeTextClass = 'white-text';
	$changeBtnClass = ' white';
endif;

$bg_image = get_field('background_image');
if(is_numeric($bg_image)):
	$get_url = wp_get_attachment_image_src($bg_image, 'full');
	$bg_image_output = $get_url[0];
else:
	$bg_image_output = $bg_image;
endif;

?>

<section class="cwf-large-image-header container-fluid">
	<div class="image" style="background-image: url(<?php echo $bg_image_output; ?>)"></div>
	<?php if (get_field('darken_image')): ?><div class="darken-image"></div><?php endif; ?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-8">
				<?php  if(trim(get_field('text_title')) != ''):  ?>
				<h1 class="tablet-outlier <?php echo $changeTextClass; ?>"><?php the_field('text_title'); ?></h1>
				<?php endif; ?>
				<?php  if(trim(get_field('text_blurb')) != ''):  ?>
				<h3 class="<?php echo $changeTextClass; ?>"><?php the_field('text_blurb') ?></h3>
				<?php endif; ?>
				<?php if(get_field('use_button')): ?>
					<button class="btn btn-lg transparent<?php echo $changeBtnClass; ?>" href="<?php the_field('button_url') ?>"><strong><?php the_field('button_text') ?></strong></button>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>

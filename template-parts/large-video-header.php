<?php
/**
 * Template part for displaying a large video header
 * 1 mobile fallback image
 * 1 large video mp4
 * 1 large video webm
 * 1 large title
 * optional overlay
 * optional overlay title
 *
 * page-about-dev.php
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
?>

<section class="cwf-video-header container-fluid">
	<div class="mobile-bg hidden-md hidden-lg" style="background-image: url(<?php the_field('mobile_background_fallback'); ?>)"></div>

	<video autoplay="" loop="" muted="" class="hidden-xs hidden-sm">
		<source src="<?php the_field('large_background_mp4'); ?>" type="video/mp4">
		<source src="<?php the_field('large_background_webm'); ?>" type="video/webm">
	</video>

	<?php if (get_field('darken_image')): ?><div class="darken-image"></div> <?php endif; ?>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-7">
				<?php if(trim(get_field('eyebrow')) != ''): ?>
				<h6 class="<?php echo $changeTextClass; ?> eyebrow cwf-margin-top-76 cwf-margin-bottom-32"><?php the_field('eyebrow'); ?></h6>
				<?php endif; ?>
				<?php  if(trim(get_field('text_title')) != ''):  ?>
				<h1 class="<?php echo $changeTextClass; ?> tablet-outlier cwf-margin-top-0"><?php the_field('text_title'); ?></h1>
				<?php endif; ?>
				<?php if(get_field('use_button')): ?>
					<?php if(get_field('this_is_a_video_popup')): ?>
						<a class="btn btn-lg<?php echo $changeBtnClass; ?> transparent video-click cta-primary" href="<?php the_field('video_url') ?>">
							<?php
							the_field('button_text');
							get_template_part('template-parts/video-play-button');
							?>							
						</a>
					<?php else: ?>
					<?php $open_new_tab = get_field('open_new_tab') ? ' target="_blank"' : '';?>
					<a class="btn btn-lg<?php echo $changeBtnClass; ?> transparent" href="<?php the_field('button_url') ?>"<?php echo $open_new_tab; ?>><?php the_field('button_text'); ?></a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>

<?php
/**
 * Template part for displaying the social 6 col width
 *
 *
 *
 * page-home.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */

?>

<div class="col-md-6 no-tablet-padding">
	<a target="_BLANK" class="cwf-masonry-block dark-teal facebook masonry-social masonry-<?php the_field($area.'social_type'); ?>-social" href="<?php the_field($area.'link'); ?>">
		<h3 class="social-icon white-text i-cwf-<?php the_field($area.'social_type'); ?>-icon"></h3>
		<div class="white-text col-md-12 col-md-offset-0 col-sm-8 col-sm-offset-2 cwf-padding-left-0 masonry-social-blurb"><?php the_field($area.'blurb'); ?></div>
	</a>
</div>
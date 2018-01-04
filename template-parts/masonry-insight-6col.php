<?php
/**
 * Template part for displaying the insight 6 col width
 *
 *
 *
 * page-home.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */

$open_new_pg = '';
if(get_field($area.'link_select_is_link_type') == 'external'):
	$open_new_pg = 'target="_blank" ';
endif;

?>

<div class="col-md-6 no-tablet-padding">
	<a href="<?php the_field($area.'link_select_is_'.get_field($area.'link_select_is_link_type').'_link'); ?>" <?php echo $open_new_pg; ?>class="cwf-masonry-block white-bg right-image">
		<div class="col-md-12 col-sm-8 col-xs-12 full-height">
			<div class="eyebrow dark-gray-text text-uppercase"><?php the_field($area.'eyebrow'); ?></div>
			<hr class="cwf-hr article">
			<h4 class="title"><?php the_field($area.'headline'); ?></h4>
			<div class="masonry-blurb"><?php the_field($area.'blurb'); ?></div>
			<div class="cta dock cwf-padding-left-0 hidden-xs"><?php the_field($area.'link_select_is_cta_text'); ?></div>
		</div>
		<div class="cta dock cwf-padding-left-0 visible-xs-block">Read more</div>
	</a>
</div>
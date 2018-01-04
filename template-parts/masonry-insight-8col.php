<?php
/**
 * Template part for displaying the services/insights/video 8 col width
 *
 *
 *
 * page-home.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */


if($change_col_size == ''): 
	$change_col_size_to_this = 8;
else:
	$change_col_size_to_this = $change_col_size;
endif; 

if($no_col_wrapper):
	$col_top = '';
	$col_bottom = '';
else:
	$col_top = '<div class="col-md-'.$change_col_size_to_this.'">';
	$col_bottom = '</div>';
endif;

$open_new_pg = '';
if(get_field($area.'link_select_ih_link_type') == 'external'):
	$open_new_pg = 'target="_blank" ';
endif;

?>

<?php echo $col_top; ?>
	<a href="<?php the_field($area.'link_select_ih_'.get_field($area.'link_select_ih_link_type').'_link'); ?>" <?php echo $open_new_pg; ?>class="cwf-masonry-block col-md-12 white-bg <?php the_field($area.'sit_image'); ?>-image">
		<?php if(get_field($area.'sit_image') == 'left'): ?> 
			<div class="col-sm-4 hidden-xs full-height" style="background-image: url(<?php the_field($area.'image'); ?>); background-position: right bottom;"></div> 
		<?php endif; ?>
		<div class="<?php if(get_field($area.'sit_image') == 'left'): ?>col-md-8 col-sm-8 col-xs-12 <?php else: ?>col-md-12<?php endif; ?> full-height">
			<?php if(get_field($area.'sit_image') == 'right'): ?>
			<div class="col-sm-7 col-xs-12">
			<?php endif; ?>
				<div class="eyebrow dark-gray-text text-uppercase"><?php the_field($area.'eyebrow'); ?></div>
				<hr class="cwf-hr article">
				<h4 class="title"><?php the_field($area.'headline'); ?></h4>
				<?php the_field($area.'blurb'); ?>
				<?php if(get_field($area.'sit_image') == 'left'): ?><div class="cta dock hidden-xs"><?php the_field($area.'link_select_ih_cta_text'); ?></div><?php endif; ?>
			<?php if(get_field($area.'sit_image') == 'right'): ?>
			</div>
			<?php endif; ?>
			<?php if(get_field($area.'sit_image') == 'right'): ?>
			<div class="col-sm-4 col-sm-offset-1 full-height hidden-xs" style="background-image: url(<?php the_field($area.'image'); ?>)"></div>
			<?php endif; ?>
		</div>
		<div class="cta dock<?php if(get_field($area.'sit_image') == 'left'): ?> cwf-padding-left-24 visible-xs-block<?php endif; ?>"><?php the_field($area.'link_select_ih_cta_text'); ?></div>
	</a> 
<?php echo $col_bottom; ?>

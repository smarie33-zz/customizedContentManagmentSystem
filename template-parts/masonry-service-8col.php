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
if(get_field($area.'link_select_ssh_link_type') == 'external'):
	$open_new_pg = 'target="_blank" ';
endif;

?>

<?php echo $col_top; ?>
	<a href="<?php the_field($area.'link_select_ssh_'.get_field($area.'link_select_ssh_link_type').'_link') ?>" <?php echo $open_new_pg; ?>style="background-image: url(<?php the_field($area.'image'); ?>)" class="cwf-masonry-block black-bg<?php if(get_field($area.'sit_image') == 'right'): ?> wide<?php endif; ?>">
		<div class="for-mobile visible-xs-block" style="background-image: url(<?php the_field($area.'image'); ?>); background-position: left center"></div>
		<div class="box-frost">
			<div class="frost-gradient"></div>
			<div class="frost-this">
				<svg>
				    <defs>
				      <filter id="blur">
				        <feGaussianBlur in="SourceGraphic" stdDeviation="10"></feGaussianBlur>
				      </filter>
				    </defs>
				    <image filter="url(#blur)" xlink:href="<?php the_field($area.'image'); ?>" x="0" y="0" height="100%" width="100%" preserveAspectRatio="xMinYMin slice"></image>
				 </svg>
			</div>
		</div>
		<div class="unfrosted-content">
			<?php if(get_field($area.'sit_image') == 'left'): ?><div class="col-sm-6"></div> <?php endif; ?>
			<div class="col-sm-<?php if(get_field($area.'sit_image') == 'left'): ?>6 <?php else: ?>5 <?php endif; ?>frost">
				<div class="eyebrow text-uppercase white-text"><?php the_field($area.'eyebrow'); ?></div>
				<?php if(get_field($area.'use_a_stat')): ?>
				<div class="large-number white-text"><?php the_field($area.'stat'); ?><?php if(get_field($area.'use_percentage')): ?><sup>%</sup><?php endif; ?></div>
				<p class="white-text light"><?php the_field($area.'blurb'); ?></p>
				<?php else: ?>
				<p class="white-text light blurb_lrg"><?php the_field($area.'blurb_large'); ?></p>
				<?php endif; ?>
				<div class="cta dock dark-bg hidden-xs"><?php the_field($area.'link_select_ssh_cta_text'); ?></div>
				<div class="cta dark-bg visible-xs-block">Learn more</div>
				<div class="clear-fix"></div>
			</div>
		</div>
	</a>
<?php echo $col_bottom; ?>

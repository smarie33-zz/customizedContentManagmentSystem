<?php
/**
 * Template part for displaying the services 4 col width (long)
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
if(get_field($area.'link_select_ssv_link_type') == 'external'):
	$open_new_pg = 'target="_blank" ';
endif;

?>

<div class="col-md-4">
	<a href="<?php the_field($area.'link_select_ssv_'.get_field($area.'link_select_ssv_link_type').'_link') ?>" <?php echo $open_new_pg; ?>class="cwf-masonry-block long black-bg" style="background-image: url(<?php the_field($area.'image'); ?>)">
		<div class="for-mobile visible-xs-block" style="background-image: url(<?php the_field($area.'image'); ?>); background-position: center top;"></div>
		<div class="box-frost">
			<div class="frost-gradient"></div>
			<div class="frost-this">
				<svg>
				    <defs>
				      <filter id="blur">
				        <feGaussianBlur in="SourceGraphic" stdDeviation="10"></feGaussianBlur>
				      </filter>
				    </defs>
				    <image filter="url(#blur)" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php the_field($area.'image'); ?>" x="0" y="0" height="100%" width="100%" preserveAspectRatio="xMinYMin slice"></image>
				 </svg>
			</div>
		</div>
		<div class="unfrosted-content">
			<div class="visible-sm-block col-sm-6"></div>
			<div class="col-md-12 col-sm-6 frost">
				<div class="eyebrow text-uppercase white-text"><?php the_field($area.'eyebrow'); ?></div>
				<?php if(get_field($area.'use_a_stat')): ?>
				<div class="large-number white-text"><?php the_field($area.'stat'); ?><?php if(get_field($area.'use_percentage')): ?><sup>%</sup><?php endif; ?></div>
				<p class="white-text light"><?php the_field($area.'blurb'); ?></p>
				<?php else: ?>
				<p class="white-text light blurb_lrg"><?php the_field($area.'blurb_large'); ?></p>
				<?php endif; ?>
				<div class="cta dock dark-bg hidden-xs"><?php the_field($area.'link_select_ssv_cta_text'); ?></div>
				<div class="cta dark-bg visible-xs-block">Learn more</div>
			</div>
		</div>
	</a>
</div>

<?php
/**
 * Template part for displaying the quote 4 col width (long)
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
$current_quote_field = get_field($area.'link_select_quote_link_type');

if($current_quote_field == 'external'):
	$open_new_pg = ' target="_blank"';
endif;

?>

<div class="col-md-4">
	<a href="<?php the_field($area.'link_select_quote_'.$current_quote_field.'_link'); ?>"<?php echo $open_new_pg; ?> class="cwf-masonry-block long black-bg quote"<?php echo $open_new_pg; ?> style="background-image: url(<?php the_field($area.'image'); ?>)">
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
			<div class="col-md-12 col-sm-6"></div>
			<div class="col-md-12 col-sm-6 frost">
				<div class="quote-text">
					<div class="social-icon teal-text text-left i-cwf-quote-start-icon"></div>
					<h2 class="white-text tablet-outlier text-left "><?php the_field($area.'quote'); ?></h2>
					<div class="social-icon teal-text text-right i-cwf-quote-end-icon"></div>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 dock">
					<p class="white-text text-right"><?php the_field($area.'attribute'); ?></p>
				</div>
			</div>
		</div>
	</a>
</div>
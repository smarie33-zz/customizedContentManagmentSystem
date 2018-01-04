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

?>

<?php echo $col_top; ?>
	<a href="<?php the_field($area.'video_link'); ?>" class="cwf-masonry-block video black-bg" style="background-image: url(<?php the_field($area.'video_still'); ?>)">
		<div class="for-mobile visible-xs-block" style="background-image: url(<?php the_field($area.'video_still'); ?>)">
		<div class="cwf-padding-bottom-xs-32"></div>
		<svg class="visible-xs-block" width="54" height="54" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMaxYmax meet">
			    <defs></defs>
			    <g id="Style-Guide" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
			        <g id="play-button-round-icon" fill="#000000">
			            <path d="M32,64 C49.673112,64 64,49.673112 64,32 C64,14.326888 49.673112,0 32,0 C14.326888,0 0,14.326888 0,32 C0,49.673112 14.326888,64 32,64 Z M25,16 L25,46 L49,31 L25,16 Z" id="Combined-Shape"></path>
			        </g>
			    </g>
			</svg>
		</div>
		<div class="unfrosted-content">
			<div class="col-sm-7 play_icon hidden-xs">
				<svg width="104" height="104" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMaxYmax meet">
				    <defs></defs>
				    <g id="Style-Guide" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				        <g id="play-button-round-icon" fill="#000000">
				            <path d="M32,64 C49.673112,64 64,49.673112 64,32 C64,14.326888 49.673112,0 32,0 C14.326888,0 0,14.326888 0,32 C0,49.673112 14.326888,64 32,64 Z M25,16 L25,46 L49,31 L25,16 Z" id="Combined-Shape"></path>
				        </g>
				    </g>
				</svg>
			</div>
			<div class="col-sm-5 video-content black-bg">
				<div class="eyebrow white-text text-uppercase"><?php the_field($area.'eyebrow'); ?></div>
				<hr class="cwf-hr article">
				<h4 class="white-text"><?php the_field($area.'title'); ?></h4>
				<p class="white-text light hidden-xs"><?php the_field($area.'blurb'); ?></p>
				<div class="cta dark-bg">Watch Video</div>
				<div class="clear-fix"></div>
			</div>
		</div>
	</a>
<?php echo $col_bottom; ?>

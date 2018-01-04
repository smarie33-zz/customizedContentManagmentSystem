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

<div class="col-md-6 video no-tablet-padding">
	<div class="top-image visible-xs-block" style="background-image: url(<?php the_field($area.'video_still'); ?>)">
		<div class="cwf-padding-bottom-xs-32"></div>
		<svg class="visible-xs-block" width="54" height="54" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMaxYmax meet">
		    <defs></defs>
		    <g id="Style-Guide" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
		        <g id="play-button-round-icon" fill="#ffffff">
		            <path d="M32,64 C49.673112,64 64,49.673112 64,32 C64,14.326888 49.673112,0 32,0 C14.326888,0 0,14.326888 0,32 C0,49.673112 14.326888,64 32,64 Z M25,16 L25,46 L49,31 L25,16 Z" id="Combined-Shape"></path>
		        </g>
		    </g>
		</svg>
	</div>
	<a href="<?php the_field($area.'video_link'); ?>" class="cwf-masonry-block video-click black-bg"  style="background-image: url(<?php the_field($area.'video_still'); ?>)">
		<div class="col-sm-7 visible-sm-block">
			<svg width="104" height="104" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMaxYmax meet">
			    <defs></defs>
			    <g id="Style-Guide" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
			        <g id="play-button-round-icon" fill="#ffffff">
			            <path d="M32,64 C49.673112,64 64,49.673112 64,32 C64,14.326888 49.673112,0 32,0 C14.326888,0 0,14.326888 0,32 C0,49.673112 14.326888,64 32,64 Z M25,16 L25,46 L49,31 L25,16 Z" id="Combined-Shape"></path>
			        </g>
			    </g>
			</svg>
		</div>
		<div class="col-md-12 col-sm-5 col-xs-12 full-height black-bg">
			<div class="top-image hidden-xs hidden-sm" style="background-image: url(<?php the_field($area.'video_still'); ?>)">
				<svg width="54" height="54" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMaxYmax meet">
				    <defs></defs>
				    <g id="Style-Guide" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				        <g id="play-button-round-icon" fill="#ffffff">
				            <path d="M32,64 C49.673112,64 64,49.673112 64,32 C64,14.326888 49.673112,0 32,0 C14.326888,0 0,14.326888 0,32 C0,49.673112 14.326888,64 32,64 Z M25,16 L25,46 L49,31 L25,16 Z" id="Combined-Shape"></path>
				        </g>
				    </g>
				</svg>
			</div>
			<div class="eyebrow text-uppercase white-text"><?php the_field($area.'eyebrow'); ?></div>
			<hr class="cwf-hr article">
			<h4 class="white-text"><?php the_field($area.'title'); ?></h4>
			<div class="cta dock cwf-padding-left-0 hidden-xs">Watch Video</div>
		</div>
		<div class="cta dock visible-xs-block">Watch Video</div>
	</a>
</div>
<?php
/**
 * Template part for displaying a warning box on top of T03 pages
 *
 * message
 * dismiss and dismiss forever messages
 * date to stop displaying
 * 
 *
 * single-industry.php, single-services.php
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */

$removal_date = get_field('removal_date');
$show_warning = true;
$extra_classes = '';

if ($removal_date != ""):
  $date = new DateTime($removal_date); // format: MM/DD/YYYY
  $date_to_remove = $date->format('U');
  $date_today = getDate()[0];
  if ($date_today > $date_to_remove):
	  $show_warning = false;
  endif;
endif;

$extra_classes = get_field('color');

if (get_field('$no_margin'))
    $extra_classes = ' no-margin';

if(get_field('warning_box') && $show_warning):
	wp_enqueue_script ( 'conduent-warning-box', get_template_directory_uri() . '/js/warning-box.js', array(), '20170101', true );
	echo '		
		<section class="container-fluid cwf-warning-box-holder '.get_field('color').'">
			<section class="container-fluid offset-cwf-warning-box hidden-xs white-bg"></section>
				<div class="container">
					<div class="row">
						<div class="cwf-warning-box-container col-md-12">
							  <div class="cwf-warning-box">
								  <h4>' . get_field('message') . '</h4>
								  <a class="cwf-warning-box-close">' . __( "Close", "conduent") . '</a><span> | </span><a class="cwf-warning-box-remove">' . __( "Don&rsquo;t show this message again", "conduent") . '</a>
							  </div>
						</div>
					</div>
				</div>
			</div>
		</section>';
endif;

?>





<?php
/**
 * Day View Nav
 * This file contains the day view navigation.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/nav.php
 *
 * @package TribeEventsCalendar
 * @version 4.2
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$earliest = tribe_events_earliest_date( Tribe__Date_Utils::DBDATEFORMAT );
$latest   = tribe_events_latest_date( Tribe__Date_Utils::DBDATEFORMAT );

?>

<h3 class="screen-reader-text" tabindex="0"><?php esc_html_e( 'Day Navigation', 'the-events-calendar' ) ?></h3>
<ul class="tribe-events-sub-nav">

	<!-- Previous Page Navigation -->
	<li class="tribe-events-nav-previous" aria-label="previous day link">
		<?php

			$date = tribe_get_the_day_link_date( 'previous day' );
			if ( $date >= $earliest && $date <= $latest ) {
				printf( '<span class="i-cwf-caret-right-icon left"></span>' );
				tribe_the_day_link( 'previous day' );
			}
		?>
	</li>

	<!-- Next Page Navigation -->
	<li class="tribe-events-nav-next" aria-label="next day link">
		<?php
			$date = tribe_get_the_day_link_date( 'next day' );
			if ( $date >= $earliest && $date <= $latest ) {
				tribe_the_day_link( 'next day' );
				printf( '<span class="i-cwf-caret-right-icon right"></span>' );
			}
		?>
	</li>

</ul>

<?php
/**
 * The sidebar containing the main widget area.
 *
 * single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Conduent
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area cwf-padding-top-64" role="complementary">
	<?php //dynamic_sidebar( 'sidebar-1' ); ?>
	<div class="cwf-article-menu cwf-padding-bottom-48">
		<h3 class="med-blue-text cwf-padding-bottom-24">Customer Care</h3>
		<ul>
			<li><a href="#">Analytics and Automation</a></li>
			<li><a href="#">Customer Acquisition</a></li>
			<li class="current">Customer Rentention and Relationship Managment</li>
			<li><a href="#">Customer Service Experience</a></li>
			<li><a href="#">Industries</a></li>
			<li><a href="#">Technical Service</a></li>
		</ul>
	</div>
	<div class="clearfix"></div>

	<div class="cwf-info-box cwf-border">
		<h3 class="med-blue-text">Thought Leaderhship</h3>
		<a href="#">View our Healthcare insights</a>
	</div>

	<div class="cwf-article-title-under sidebar cwf-border-med-light-gray">
		<div class="image" style="background-image: url(<?php echo get_template_directory_uri(); ?>/placeholderdummycontent/547016545.jpg)"></div>
		<div class="content">
			<hr class="cwf-hr article">
			<h4>Healthcare in Transition</h4>
			<p>How value-based care is driving change for consumers, payers and providers alike.</p>
			<a href="#" class="i-cwf-caret-right-icon after">Read more</a>
		</div>
	</div>

</aside><!-- #secondary -->

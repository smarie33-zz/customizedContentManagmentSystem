<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Conduent
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/medium-image-header', 'page' );

			get_template_part( 'template-parts/banner', 'page' );

			get_template_part( 'template-parts/social-rail', 'page' );
		?>
			<section class="container cwf-section-padding">
				<div class="row">
				<div class="col-md-9">
					<?php get_template_part( 'template-parts/demo-article-content', 'page' ); ?>
					<?php get_template_part( 'template-parts/resources', 'page' ); ?>
				</div>
				<div class="col-md-3">
					<?php get_sidebar( 'right' ); ?>
				</div>
			</section>			
			<?php get_template_part( 'template-parts/two-column-articles', 'page' ); ?>
		<?php

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
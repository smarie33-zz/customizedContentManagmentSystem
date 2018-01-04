<?php
/*
Template Name: Demo Home
*/

$flexable_content = true;

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
				if( function_exists('have_rows')):
					if( have_rows('homepage_elements') ):
						while ( have_rows('homepage_elements') ) : the_row();
						if( get_row_layout() == 'large_header' ):
							get_template_part( 'template-parts/large-image-header', 'page' );
						endif;

						if( get_row_layout() == 'banner' ):
							get_template_part( 'template-parts/banner', 'page' );
						endif;

						if( get_row_layout() == 'post_list' ):
							get_template_part( 'template-parts/post-list', 'page' );
						endif;

						if( get_row_layout() == 'post_list_links' ):
							get_template_part( 'template-parts/post-list-links', 'page' );
						endif;
						
							//get_template_part( 'template-parts/content', 'page' );
						endwhile;
					endif; //end if  have_rows
				endif; //end if function_exists

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();


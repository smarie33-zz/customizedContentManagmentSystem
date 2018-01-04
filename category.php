<?php
/*
Template Name: Category
*/

get_header(); 

$current_category = get_category( get_query_var( 'cat' ) );
$current_cat_id = $current_category->cat_ID;
$catslug = $current_category->slug;
if($catslug == 'industries'):
	$catslug = 'industry';
endif;

if ( post_type_exists(strtolower($catslug))):

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php 

			include(locate_template('template-parts/small-image-header.php'));
			include(locate_template('template-parts/banner.php'));
		

			$pt_query = new WP_Query( array( 
				'post_type' 	=> $catslug, 
				'post_status' 	=> 'publish',
				'order'			=> 'ASC',
				'orderby' 		=> 'title',
				'post_parent' 	=> 0
			) );
		?>
			<?php get_template_part( 'template-parts/social-rail', 'page' ); ?>
			<section>
				<div class="container cwf-post-list cwf-padding-top-sm-64 cwf-padding-top-xs-0 cwf-padding-bottom-sm-104 cwf-padding-bottom-xs-0">
					<div class="row">
						<?php
							$article_posts = $pt_query->posts;
							$template_pull = 'template-parts/article-category-preview.php';
							include(locate_template('template-parts/grid-layout.php'));
						?>
					</div>
				</div>
			</section>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
	get_footer();
else:
	include( get_query_template( '404' ) );
endif; //end checking if post type exists
?>
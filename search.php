<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Conduent
 */

get_header(); 

global $wp_query;
$found_amount = $wp_query->found_posts;
if($found_amount > 1){
	$plural = 's';
}else{
	$plural = '';
}

$search_term = get_search_query();

if(get_query_var('paged') == 0):
	$amnt_of_pages = 1;
else:
	$amnt_of_pages = get_query_var('paged');
endif;

$featured = false;

?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main search-results" role="main">
			<section class="container">
				<div class="row">
					<div class="col-md-12 cwf-padding-top-xs-24 cwf-padding-bottom-xs-24">
						<div class=" col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 cwf-caption">
							<?php 
								if($found_amount > 0):
									echo $found_amount; echo __( ' results for', 'conduent' ); 
								else:
									echo __( 'Sorry, we found no results for', 'conduent' );
								endif;
							?>
						</div>

						<form id="cwf-hdr-search-form-embed" action="<?php bloginfo('url'); ?>">
							<div class="cwf-hdr-searchbox-container col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0  col-md-8 col-md-offset-2">
							<input id="cwf-hdr-search-input" name="s" value="<?php echo $search_term; ?>" placeholder="Search">
								<div id="cwf-hdr-search-clear">
									<span class="cwf-hdr-search-clear-line" id="cwf-hdr-search-clear-line-1"></span> 
									<span class="cwf-hdr-search-clear-line" id="cwf-hdr-search-clear-line-2"></span>
								</div>
							</div>
						</form>

					</div>
				</div>
			</section>

			<?php
			if ( have_posts() ) : ?>

			<section class="container">

			<?php if($featured): ?>
			<div class="row">
				<div class="col-md-8 col-md-offset-2 featured light-gray-bg">
					<?php include( locate_template( 'template-parts/article-preview-no-image.php' ) ); ?>
					<div class="col-md-12 hidden-xs hidden-sm cwf-padding-bottom-24"></div>
				</div>
				<div class="col-md-12 hidden-xs hidden-sm cwf-padding-bottom-24"></div>
			</div>
			<?php endif; ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
			?>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<?php get_template_part( 'template-parts/article-preview-no-image', 'search' ); ?>
					</div>
					<hr class="med-gray cwf-margin-top-0 cwf-margin-bottom-0 visible-xs-block">
				</div>

			<?php endwhile; ?>

			</section>

			<!-- <section class="container">
				<div class="row">
					<div class="col-md-12">						
					<?php the_posts_navigation(); ?>
					</div>
				</div>
			</section> -->

		<?php else : ?>

		<section class="container">
			<div class="row">
				<div class="col-md-12 text-center cwf-padding-top-xs-48 hidden-xs">	
					Try another search,	or explore our capabilities below.
				</div>
				<div class="col-md-12 text-center visible-xs-block">	
					Try another search,<br /> or explore our capabilities below.
				</div>
			</div>
		</section>

		<?php include(locate_template( 'template-parts/link-list.php' )); ?>

		<?php endif; ?>

		<?php if($found_amount !== 0 && $wp_query->max_num_pages > 1): ?>
			<section class="container visible-md-block visible-lg-block">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<hr class="med-gray cwf-margin-top-0 cwf-margin-bottom-0">
					</div>
				</div>
			</section>
		
			<?php include(locate_template( 'template-parts/pagination-search.php' )); 
			else:
			?>
			<div class="cwf-padding-top-xs-104 hidden-xs"></div>
			<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();

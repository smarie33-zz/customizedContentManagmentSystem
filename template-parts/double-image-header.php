<?php
/**
 * Template part for displaying a medium sized header
 * 1 large image
 * 1 title
 *
 * single.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */

get_template_part( 'template-parts/breadcrumbs', 'page' );

?>

<section class="cwf-medium-image-header">
	<div class="container-fluid background cwf-blur" style="background: url(<?php echo get_template_directory_uri() ?>/placeholderdummycontent/537417114.jpg)">
			<div class="row">
				<div class="col-md-12">
					<img class="center-block" src="<?php echo get_template_directory_uri() ?>/placeholderdummycontent/slanted_jumbotron_T.png">
				</div>
			</div>
	</div>
	<div class="container-fluid image-overlay">
			<div class="row">
				<div class="col-md-12">
					<img class="center-block" src="<?php echo get_template_directory_uri() ?>/placeholderdummycontent/slanted_jumbotron_T.png">
				</div>
		</div>
	</div>
</section>

<!-- <section class="container-fluid cwf-image-header medium" style="background: url(http://placehold.it/2000x350)">
	<div class="container">
		<div class="row">
			<div class="col-md-12 title">
				<h1>
					<?php 
						if(is_category()):
							single_cat_title();
						else:
							the_title();
						endif; 
					?>
				</h1>
			</div>
		</div>
	</div>
</section> -->

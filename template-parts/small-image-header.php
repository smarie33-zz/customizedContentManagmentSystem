<?php
/**
 * Template part for displaying a large size header
 * 1 small image
 * category.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */
?>

<?php if( function_exists('get_field')): 

?>

<?php if(is_category()): 
		$small_header_image_field = get_field('small_header_image', 'category_'.$current_cat_id);
	else:
		$small_header_image_field = get_field('small_header_image');
	endif;
?>

<section class="container-fluid cwf-image-header-small" style="background-image: url(<?php echo $small_header_image_field; ?>)">
	<div class="row">
		<div class="col-md-12">
		</div>
	</div>
</section><!-- .no-results -->

<?php endif; ?>

<?php
/**
 * Template part for displaying the preview of an article in a rectangle.
 *
 * title
 * link url
 * post excerpt
 *
 * featured article is dummy until admin feature is built
 *
 * search.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */

//get taxonomy


?>

<?php if(!empty($featured)): ?>

<a class="cwf-article-preview-no-image cwf-padding-bottom-24" href="<?php the_permalink(); ?>">
	<hr class="cwf-hr featured"></hr>
	<div class="eyebrow dark-gray-text"><strong>featured</strong></div>
	<div class="content-container">
		<h2 class="title link-blue">Transportation lorem ipsum dolor sit amet</h2>
		<p>Consectetuer adipiscing elit, sed diam transportation nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci transportation suscipit lobortis nisl ut aliquip.</p>
		<div class="clearfix"></div>
	</div>
</a>

<?php else:
	$post_type = explode('_', get_post_type());
	$mainTaxonomy = implode(' ', $post_type);
?>

<a class="cwf-article-preview-no-image cwf-padding-bottom-24 cwf-padding-top-24 <?php if(!empty($featured)): ?> light-gray-bg<?php endif; ?>" href="<?php the_permalink(); ?>">
	
	<?php if(!empty($mainTaxonomy) && isset($noTaxonomy) && !$noTaxonomy): ?><div class="eyebrow dark-gray-text"><strong><?php echo trim($mainTaxonomy); ?></strong></div> <?php endif; ?>
	<div class="content-container">
		<h2 class="title link-blue"><?php the_title(); ?></h2>
		<p><?php echo wp_strip_all_tags(get_the_excerpt(), true); ?></p>
		<div class="clearfix"></div>
	</div>
</a>

<?php endif; ?>
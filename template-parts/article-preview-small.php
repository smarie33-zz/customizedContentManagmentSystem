<?php
/**
 * Template part for displaying the preview of an article in a rectangle.
 *
 * title
 * link url
 * feature image
 * post excerpt
 *
 * single.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */

?>

<a class="cwf-article-preview-small" href="<?php echo get_permalink($article_post); ?>">
	<div class="image" style="background: url(<?php echo $post_thumbnail_url[0]; ?>)">
		<h3 class="title"><?php echo get_the_title($article_post); ?></h3>
	</div>
	<div class="excerpt light-gray-bg">
		<?php  echo wp_trim_words( apply_filters('the_content', get_post_field('post_content', $article_post)), 10, '...' ); ?>
	</div>
</a>
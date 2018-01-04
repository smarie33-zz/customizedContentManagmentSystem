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

if(is_array($article_post)){
	$article_post_id = $article_post->ID;
	$article_post_excerpt = $article_post->post_excerpt;
}else{
	$article_post_id = $article_post;
	$article_post_excerpt = get_the_excerpt($article_post);
}

$post_thumbnail_id = get_post_thumbnail_id($article_post_id);
$post_thumbnail_url = wp_get_attachment_image_src( $post_thumbnail_id, 'medium' );

$vec = '';
$selected_thumb = $post_thumbnail_url[0];
if(get_post_mime_type($post_thumbnail_id) == 'image/svg+xml'){
  $post_image_parts = explode('_', $post_thumbnail_url[0]);
  array_pop($post_image_parts);
  $selected_thumb = implode('_', $post_image_parts) . '_md.svg';
  $vec = ' vector';
}

?>

<a class="cwf-article-preview-small meta<?php echo $vec; ?>" href="<?php echo get_permalink($article_post_id); ?>">
	<div class="content-container">
		<div class="image" style="background-image: url(<?php echo $selected_thumb; ?>)">
		</div>
		<h4 class="title"><?php echo get_the_title($article_post_id); ?></h4>
		<div class="excerpt-container">
			<div class="excerpt"><?php echo cwf_create_short_excerpt($article_post_excerpt); ?></div>
		</div>
		<div class="mobile-cta link-blue hidden-md hidden-lg">Read more</div>
		<div class="clearfix"></div>
	</div>
</a>

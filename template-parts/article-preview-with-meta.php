<?php
/**
 * Template part for displaying the preview of an article in a rectangle.
 *
 * title
 * link url
 * feature image
 * post exerpt
 *
 * single.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */

$post_thumbnail_id = get_post_thumbnail_id($article_post->ID);
$post_thumbnail_url = wp_get_attachment_image_src( $post_thumbnail_id, 'medium' );	
$post_type = get_post_type($article_post->ID);
$post_type_obj = get_post_type_object( $post_type );
$post_type = $post_type_obj->labels->singular_name;
$parents = get_post_ancestors( $article_post->ID );
/* Get top level parent as replacement for category*/ 
$id = ($parents) ? $parents[count($parents)-1]: $post->ID;
$parent = get_post( $id );
$post_category = $parent->post_title;

$vec = '';
$selected_thumb = $post_thumbnail_url[0];
if(get_post_mime_type($post_thumbnail_id) == 'image/svg+xml'){
  $post_image_parts = explode('_', $post_thumbnail_url[0]);
  array_pop($post_image_parts);
  $selected_thumb = implode('_', $post_image_parts) . '_md.svg';
  $vec = ' vector';
}

?>

<a class="cwf-article-preview-small meta<?php echo $vec; ?>" href="<?php echo get_permalink($article_post); ?>">
	<div class="taxonomy-space">
    <h6 class="taxonomy eyebrow text-uppercase light-gray-bg dark-gray-text"><?php echo $post_category; ?></h6>
	</div>
	<div class="image" style="background-image: url(<?php echo $selected_thumb; ?>)">
	</div>
	<h4 class="title"><?php echo get_the_title($article_post->ID); ?></h4>
	<div class="excerpt-container">
    	<div class="excerpt"><?php  if (function_exists('cwf_create_short_excerpt')) { echo cwf_create_short_excerpt($article_post->post_excerpt); } ?></div>
	</div>
	<p class="text-uppercase dark-gray-text text-left small type">
		<sub class="i-cwf-<?php echo strtolower($post_type); ?>-icon"></sub><span class="eyebrow"><?php echo $post_type; ?></span>
	</p>
	<div class="clearfix"></div>
</a>

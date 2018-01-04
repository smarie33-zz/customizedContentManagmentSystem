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

<a class="cwf-article-category cwf-padding-bottom-16" href="<?php echo get_permalink($article_post->ID); ?>">
	<div class="content-container">
		<hr class="cwf-hr article">
		<h2 class="title text-capitalize"><?php echo get_the_title($article_post->ID); ?></h2>
		<div class="excerpt black-text"><?php 
      $text_blurb = get_the_excerpt($article_post->ID);
      if ($text_blurb == false) {
        $text_blurb = get_field('text_blurb', $article_post->ID);
      }
      echo cwf_create_short_excerpt($text_blurb);
      ?>
    </div>
		<div class="mobile-cta link-blue">Read more</div>
	</div>
	<div class="clearfix"></div>
</a>

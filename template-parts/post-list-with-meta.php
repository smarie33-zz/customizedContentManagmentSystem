<?php
/**
 * Template part for displaying a preview of an article in a rectangle.
 * title
 * 1 background image
 * article excerpt
 *
 * post_list.php
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */


$post_list_show_link = get_field('post_list_show_link');
$post_list_section_title = get_field('post_list_section_title');
$post_list_link_to_post_list_page = get_field('post_list_link_to_post_list_page', false, false);
$post_list_posts = get_field('post_list_posts');


if($post_list_show_link == true):
	$col_w_of_title = 'col-md-6';
else:
	$col_w_of_title = 'col-md-12';
endif;


?>
<section>
	<div class="container cwf-post-list cwf-section-padding">
		<div class="row">
			<div class="<?php echo $col_w_of_title; ?>">
				<h2><?php echo $post_list_section_title; ?></h2>
			</div>

			<?php if($post_list_show_link == true):
					$page_id_selected = $post_list_link_to_post_list_page;
			?>
			<div class="col-md-6">
				<a href="<?php the_permalink($page_id_selected); ?>"><?php the_title($page_id_selected); ?></a>
			</div>
			<?php endif; ?>

			<?php
			$article_posts = $post_list_posts;
			$template_pull = 'template-parts/article-preview-with-meta.php';
			include(locate_template('template-parts/grid-layout.php'));
			?>
		</div>
	</div>
</section>
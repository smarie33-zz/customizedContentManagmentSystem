<?php
/**
 * Template part for displaying a preview of an article in a rectangle.
 * title
 * 1 background image
 * article exerpt
 *
 * post-list-with-meta.php
 * category.php
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */


			
			$apCNT = 2;
			$addCass = '';
				if( $article_posts ): 
					$noBorderFoU = count($article_posts) % 3;
					if($noBorderFoU === 0):
						$lastones = count($article_posts) - 3;
					else:
						$lastones = count($article_posts) - $noBorderFoU;
					endif;
					$lastCNT = 1;
					$noborder = '';
					foreach( $article_posts as $article_post):
						if ($lastCNT > $lastones) {
							$noborder = ' no-bottom-border';
						}
						if($noBorderFoU == 1 && $lastCNT == count($article_posts)){
							$noborder .= ' right-border';
						}
						if($apCNT == 3):
							$addCass = ' center';
							$apCNT = 0;
						else:
							$addCass = '';
						endif;
						$apCNT++;
						$lastCNT++;
			?>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 <?php echo $addCass.$noborder; ?>">
					<?php include(locate_template($template_pull)); ?>						
					</div>
			<?php
					endforeach;
				endif;
			?>
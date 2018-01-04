<?php
/**
 * Template part for displaying pagination.
 *
 *
 * search.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */

?>

<section class="container cwf-pagination">
	<div class="row">
		<div class="col-md-offset-3 col-md-6">
			<div class="input-group">
			    <span class="input-group-btn">
			    	<?php if($amnt_of_pages != 1 && $amnt_of_pages != 0): ?><a href="<?php bloginfo('url'); ?>?s=<?php echo $search_term; ?>&paged=<?php echo $amnt_of_pages - 1; ?>"><?php endif; ?>
				    	<svg class="pagination-arrow<?php if($amnt_of_pages == 1 || $amnt_of_pages == 0): ?> disabled<?php endif; ?>" height="46" width="102">
			              <text x="26" y="30">Previous</text>
			              <polygon class="previous-arrow" points="99,4 16,4 4,23 16,43 99,43"></polygon> <!-- left pointing arrow -->
			            </svg>
			        <?php if($amnt_of_pages != 1 && $amnt_of_pages != 0): ?></a><?php endif; ?>
			    </span>
			    <div class="number-container">
			    	<form action="<?php bloginfo('url'); ?>">
			    		<input type="hidden"  name="s" value="<?php echo $search_term; ?>">

			    		<input type="text" class="form-control text-center" name="paged" value="<?php echo $amnt_of_pages; ?>" placeholder="1" id='cwf-pagenum'>
			    	</form>
			    	<div class="of-number" id='cwf-max-pages'>of <?php echo $wp_query->max_num_pages; ?></div>
			    </div>
			    <span class="input-group-btn">
			    	<?php if($amnt_of_pages < $wp_query->max_num_pages): ?><a href="<?php bloginfo('url'); ?>?s=<?php echo $search_term; ?>&paged=<?php echo $amnt_of_pages + 1; ?>"><?php endif; ?>
				    	<svg class="pagination-arrow<?php if($amnt_of_pages == $wp_query->max_num_pages): ?> disabled<?php endif; ?>" height="46" width="102">
			              <text x="29" y="30">Next</text>
			              <polygon class="next-arrow" points="4,4 87,4 99,23 87,43 4,43"></polygon> <!-- right pointing arrow -->
			            </svg>
					<?php if($amnt_of_pages < $wp_query->max_num_pages): ?></a><?php endif; ?>
			    </span>
		    </div>
		</div>
		
		<!-- <div class="clearfix"></div> -->
	</div>
</section>
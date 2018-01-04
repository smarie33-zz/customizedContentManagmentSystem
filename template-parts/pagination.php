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

?>

<section class="container cwf-pagination">
	<div class="row">
		<div class="col-md-offset-3 col-md-6">
			<div class="input-group">
			    <span class="input-group-btn">
			    	<svg class="pagination-arrow" height="46" width="102">
		              <text x="26" y="30">Previous</text>
		              <polygon class="previous-arrow" points="99,4 16,4 4,23 16,43 99,43"></polygon> <!-- left pointing arrow -->
		            </svg>
			    </span>
			    <div class="number-container">
			    	<input type="text" class="form-control text-center" value="1" placeholder="1" id='cwf-pagenum'>
			    	<div class="of-number" id='cwf-max-pages'>of 1</div>
			    </div>
			    <span class="input-group-btn">
			    	<svg class="pagination-arrow" height="46" width="102">
		              <text x="29" y="30">Next</text>
		              <polygon class="next-arrow" points="4,4 87,4 99,23 87,43 4,43"></polygon> <!-- right pointing arrow -->
		            </svg>

			    </span>
		    </div>
		</div>
		
		<!-- <div class="clearfix"></div> -->
	</div>
</section>
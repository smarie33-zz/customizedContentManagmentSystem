<?php
/**
 * Template part for displaying filter.
 *
 * page-filter.php
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */

?>

<section class="container-fluid cwf-filter dark-gray-bg">
	<div class="container">
		<div class="row">
			<div class="navbar-header">
				<a class="mobile-filter-dropdown visible-xs-block col-xs-12 navbar-toggle collapsed" data-toggle="collapse" data-target="#filter-for-mobile-tablet" href='##'>
          <?php _e('Filters', 'Conduent'); ?>
          <span class='caret'></span>
				</a>
			</div>
      <?php 
        $dropdownClass = "cwf-dropdown"; 
      ?>
			<div class="clearfix visible-xs-block visible-sm-block"></div>
			<div class="collapse navbar-collapse" id="filter-for-mobile-tablet">
				<div class="col-lg-3 col-md-4 col-xs-12 col-sm-4 <?php echo $dropdownClass; ?>">
					<div class="dropdown" >
						<button class="btn btn-default btn-full dropdown-toggle btn-med-gray" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false ">
              <span class="filter-selection"><?php _e('All Categories', 'Conduent'); ?></span>
							<span class="caret"></span>
						</button>
            <?php
            $service_cats = cwf_services_list();
            $industry_label = false;
            ?>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li data-slug='<?php echo 'about'?>' data-filter='category'><a href='#' onclick='return false;'><?php _e('About', 'Conduent'); ?></a></li>
              <li class="dropdown-header"><?php _e('Services', 'Conduent'); ?></li>
            <?php foreach ($service_cats as $svc):?>
              <?php if ($svc->type === 'industry' && $industry_label == false): $industry_label = true;?>
              <li class="dropdown-header"><?php _e('Industries', 'Conduent'); ?></li>
              <?php endif;?>
              <li data-slug='<?php echo $svc->slug?>' data-filter='category'><a href='#' onclick='return false;'><?php echo $svc->name?></a></li>
            <?php endforeach;?>
						</ul>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-xs-12 col-sm-4 <?php echo $dropdownClass; ?>">
          <!--
					<div class="dropdown clearfix">
						<button class="btn btn-default btn-full dropdown-toggle btn-med-gray" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="filter-selection">All Types</span>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
              <?php

                // $post_types = cwf_insights_post_types(); 

                // foreach ( $post_types  as $post_type ) {
                  // $type_slug = $post_type['slug'];
                  // $type_name = $post_type['label'];
                  // echo "<li data-slug='$type_slug' data-filter='post-type'><a href='#' onclick='return false;'>$type_name</a></li>";
                // }
              ?>
						</ul>
					</div>
          -->
				</div>
				<div class="col-lg-3 col-md-3 col-md-offset-1 col-xs-8 col-sm-3 cwf-switcher">
					<!--
          <div class="btn-group switch" role="group" aria-label="switch">
					  <button type="button" class="btn btn-default btn-med-gray">Featured</button>
					  <button type="button" class="btn btn-default btn-med-gray active">Recent</button>
					</div>
          -->
				</div>
        
				<div class="col-lg-1 col-md-1 col-xs-4 col-sm-1 cwf-reset text-right ">
					<a href="#" class="white-text"><?php _e('Reset', 'Conduent'); ?></a>	
				</div>
				<!--
        <div class="col-xs-4 cwf-reset text-right visible-xs-block visible-sm-block">
					<a href="#" onclick="return false;" class="white-text">Reset</a>	
				</div>
        -->
			</div> <!-- END OF COLLAPSE ON TABLET AND MOBILE -->
		</div>
	</div>
</section>

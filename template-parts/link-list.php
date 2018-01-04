<?php
/**
 * Template part for displaying a list of links, collapes into dropdowns on mobile
 *
 * choose light or dark
 * default to all services and industries
 * use ACF to pull choosen links: remove default links
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */

$ll_bg_color = get_field('ll_background_color');
if($ll_bg_color == ''):
	$ll_bg_color = 'dark-gray-bg';
endif;

if(is_search()):
	$ll_bg_color = 'white-bg';
endif;

if($ll_bg_color == 'dark-gray-bg'):
	$make_white = 'white-text ';
	$only_white = 'white ';
else:
	$make_white = '';
	$only_white = '';
endif;

$services_array = array();
$industry_array = array();

if(!get_field('manual_create_links')):
	$list_args = array( 
		'posts_per_page' 	=> -1,
		'post_type'			=> array('services', 'industry'),
		'post_status'		=> 'publish',
		'order'				=> 'ASC',
		'order_by'			=> 'title',
		'suppress_filters' => false
		);

	$pull_link_list = get_posts( $list_args );
	foreach ( $pull_link_list as $link_in_list ):
		if($link_in_list->post_type == 'services'):
			$grab_cats = get_the_category($link_in_list->ID);
			if(empty($grab_cats)):
				$get_links = array();
				$get_links['title'] = $link_in_list->post_title;
				$get_links['url'] = get_permalink($link_in_list->ID);
				array_push($services_array, $get_links);
			endif;
		elseif($link_in_list->post_type == 'industry'):
			$grab_cats = get_the_category($link_in_list->ID);
			if(empty($grab_cats)):
				$get_links = array();
				$get_links['title'] = $link_in_list->post_title;
				$get_links['url'] = get_permalink($link_in_list->ID);
				array_push($industry_array, $get_links);
			endif;
		endif;
	endforeach; 
endif;

$services_array = array_sort($services_array, 'title', SORT_ASC);
$industry_array = array_sort($industry_array, 'title', SORT_ASC);

$services_pg = get_page_by_title('Services', 'OBJECT', 'page');
$industries_pg = get_page_by_title('Industries', 'OBJECT', 'page');


?>



<section class="container-fluid <?php echo $ll_bg_color; ?> cwf-section-padding cwf-link-list">
	<div class="container">
		<div class="row">
		<?php if(get_field('manual_create_links')): 
				//get all selected posts, add to an array so we don't have to hit the database more than once per section
				if( have_rows('link_lists') ):
					$cntNow = 0;
				    while ( have_rows('link_lists') ) : the_row();
				    $all_posts = array();
					$cur_post = array();
				    	$link_posts = get_sub_field('list_of_links');
						if( $link_posts ):
							foreach($link_posts as $post):
								setup_postdata($post); 
								$cur_post['title'] = ucwords(get_the_title());
								$cur_post['url'] = get_the_permalink();
								array_push($all_posts, $cur_post);
							endforeach; 
							wp_reset_postdata();
						endif;
						// user can choose up to 12 links, if the use more button is checked and there are more than 11
						// links selected, remove 1 and add the more link in it's place, otherwise just add the more link
						// to the array
						if(get_sub_field('use_more_link')):
							$more_link = array();
							$more_link['title'] = get_sub_field('cta');
							$more_link['url'] = get_sub_field(get_sub_field('type_of_link').'_link');
							if(count($all_posts) > 11):
								array_pop($all_posts);
							endif;
							array_push($all_posts, $more_link);
						endif;
					?>
						<div class="col-sm-12<?php if($cntNow != 0): ?> cwf-padding-top-xs-32 cwf-padding-top-sm-24 cwf-padding-top-md-32 <?php endif; ?>">
					<?php
					        // display a sub field value
					        if(get_sub_field('ll_header')):
					?>
							<h2 class="<?php echo $make_white; ?>cwf-margin-bottom-16"><?php the_sub_field('ll_header'); ?></h2>
							<hr class="<?php echo $only_white; ?>hidden-xs">
					<?php
					        endif;
					?>
							<div class="dropdown visible-xs-block">
								<button class="btn btn-default btn-full dropdown-toggle btn-med-gray" type="button" id="dropdownMenuService" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false ">
								    <?php the_sub_field('ll_dropdown_title'); ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenuService">
								<?php 
										foreach($all_posts as $this_posts):
								?>
											<li><a href="<?php echo $this_posts['url'] ?>"><?php echo $this_posts['title']; ?></a></li>
								<?php 
										endforeach; 
								?>
								</ul>
							</div>
						</div>					

					<?php 
						$rows_of_4 = 0;
						$arraycont = count($all_posts);
						$contdwnarray = 1;
						foreach($all_posts as $this_posts):
							if($rows_of_4 == 0):
							?>
								<div class="col-sm-4 hidden-xs">
							<?php endif; 
								if($contdwnarray == $arraycont):
							?>
								<a href="<?php echo $this_posts['url'] ?>" class="<?php echo $make_white; ?>cwf-small-callout"><?php if($ll_bg_color != 'dark-gray-bg'): ?><span class="black-text"><?php endif; ?><?php echo $this_posts['title']; ?><?php if($ll_bg_color != 'dark-gray-bg'): ?></span><?php endif; ?></a>
							<?php else: ?>
								<a href="<?php echo $this_posts['url'] ?>"><h4 class="<?php echo $make_white; ?>"><?php echo $this_posts['title']; ?></h4></a>
							<?php 
								endif;
								if($rows_of_4 == 3 || $contdwnarray == $arraycont): ?>
								</div>
							<?php
									$rows_of_4 = 0;
								else:
									$rows_of_4++;
								endif;
								$contdwnarray++;
						endforeach; 

						$cntNow++;
					endwhile;
				endif; //end of if user is creating manual links
			else: ?>

			<div class="col-sm-12">
				<h2 class="<?php echo $make_white; ?>cwf-margin-bottom-16">Industries</h2>
				<hr class="<?php echo $only_white; ?>hidden-xs">

				<div class="dropdown visible-xs-block">
					<button class="btn btn-default btn-full dropdown-toggle btn-med-gray" type="button" id="dropdownMenuService" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false ">
					    Explore our industries
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuService">
					<?php foreach($industry_array as $this_industry): ?>
						<li><a href="<?php echo $this_industry['url']; ?>"><?php echo ucwords($this_industry['title']); ?></a></li>
					<?php endforeach; ?>
					</ul>
				</div>

			</div>
		
			<?php $cnt_industry = 0;
				  $truncate_industry = 1;
				  if(count($industry_array) <= 11):
				  	$limit_number = count($industry_array);
				  else:
				  	$limit_number = 11;
				  endif;
				  foreach($industry_array as $this_industry):
				  	if($truncate_industry <= $limit_number):
				  		if($cnt_industry == 0):
			?>
				  			<div class="col-sm-4 hidden-xs">
			<?php
				  		endif;
			?>
							<a href="<?php echo $this_industry['url']; ?>"><h4 class="<?php echo $make_white; ?>"><?php echo ucwords($this_industry['title']); ?></h4></a>
			<?php 	
						if($cnt_industry == 3 || $truncate_industry == $limit_number):
							if($truncate_industry == $limit_number):
			?>
							<a href="<?php the_permalink( $industries_pg->ID ); ?>" class="<?php echo $make_white; ?>cwf-small-callout"><?php if($ll_bg_color != 'dark-gray-bg'): ?><span class="black-text"><?php endif; ?>All Industries<?php if($ll_bg_color != 'dark-gray-bg'): ?></span><?php endif; ?></a>
						<?php endif; ?>
						</div>
			<?php
							$cnt_industry = 0;
						else:
							$cnt_industry++;
						endif;
							$truncate_industry++;
					endif;
				endforeach;

			?>

			<div class="col-sm-12 cwf-padding-top-xs-32 cwf-padding-top-sm-24 cwf-padding-top-md-32">
				<h2 class="<?php echo $make_white; ?>cwf-margin-bottom-16">Services</h2>
				<hr class="<?php echo $only_white; ?>hidden-xs">

				<div class="dropdown visible-xs-block">
					<button class="btn btn-default btn-full dropdown-toggle btn-med-gray" type="button" id="dropdownMenuService" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false ">
					    Explore our services
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuService">
					<?php foreach($services_array as $this_service): ?>
						<li><a href="<?php echo $this_service['url']; ?>"><?php echo ucwords($this_service['title']); ?></a></li>
					<?php endforeach; ?>
					</ul>
				</div>

			</div>
	
			<?php $cnt_service = 0;
				  $truncate_services = 1;
				  if(count($services_array) <= 11):
				  	$limit_number = count($services_array);
				  else:
				  	$limit_number = 11;
				  endif;
				  foreach($services_array as $this_service):
				  	if($truncate_services <= $limit_number):
				  		if($cnt_service == 0):
			?>
				  			<div class="col-sm-4 hidden-xs">
			<?php
				  		endif;
			?>
							<a href="<?php echo $this_service['url']; ?>"><h4 class="<?php echo $make_white; ?>"><?php echo ucwords($this_service['title']); ?></h4></a>
			<?php 	
						if($cnt_service == 3 || $truncate_services == $limit_number):
							if($truncate_services == $limit_number):
			?>
							<a href="<?php the_permalink( $services_pg->ID ); ?>" class="<?php echo $make_white; ?> cwf-small-callout"><?php if($ll_bg_color != 'dark-gray-bg'): ?><span class="black-text"><?php endif; ?>All Services<?php if($ll_bg_color != 'dark-gray-bg'): ?></span><?php endif; ?></a>
						<?php endif; ?>
						</div>
			<?php
							$cnt_service = 0;
						else:
							$cnt_service++;
						endif;
							$truncate_services++;
					endif;
				endforeach; 

			endif; //END OF IF manual_create_links 
			?>

		</div>
		<?php if(!is_search()): ?><hr class="cwf-margin-top-sm-48 cwf-margin-top-md-80 <?php echo $only_white; ?>hidden-xs"><?php endif; ?>
	</div>
</section>
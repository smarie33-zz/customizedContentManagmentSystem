<?php
/**
 * Template part for displaying the social connect area
 *
 *
 *
 * page-home.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */

$social_choosen = get_field($area.'show_these_social_follows');
?>

<?php if($change_col_size == ''): ?>
<div class="col-md-4">
<?php else: ?>
<div class="col-md-<?php echo $change_col_size; ?>">
<?php endif; ?>
	<div class="cwf-masonry-block teal social">
		<div class="col-md-12 col-sm-6 col-xs-12">
			<div class="eyebrow text-uppercase white-text">Follow</div>
			<h2 class="cwf-padding-top-32 cwf-margin-bottom-0 white-text tablet-outlier">Connect with us on<br> social media</h2>
		</div>
		<div class="col-md-12 col-sm-6 col-xs-12 cwf-padding-left-0 cwf-padding-right-0 vertical-center">

			<?php 
				// if ($social_choosen instanceof \Traversable)
				// {
					foreach($social_choosen as $i_choose_you) 
					{
						$switch_abbrev = '';
						if($i_choose_you == 'facebook'):
							$switch_abbrev = 'fb';
						endif;
						$social_col_size = 12 / count($social_choosen);
			?>
				<div class="col-xs-<?php echo $social_col_size; ?>">
					<a target="_blank" class="social" href="<?php the_field($area.$i_choose_you.'_link'); ?>">
					<h2 class="large white-text text-left i-cwf-<?php if($switch_abbrev != ''): echo $switch_abbrev; else: echo $i_choose_you; endif; ?>-icon"></h2>
					</a>
				</div>
			<?php 
					}
				// }
			?>
			
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>								
</div>
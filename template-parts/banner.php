<?php
/**
 * Template part for displaying a banner
 *
 * left blurb
 * optional title above button
 * button name
 * button url
 * blurb right of button
 *
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Conduent
 */

?>



<?php if(is_category()): 
		$banner_title = single_cat_title( '', false );
		$blurb = category_description($current_cat_id);
	else:
		$banner_title = get_field('banner_title');
		$blurb = get_field('banner_blurb');		
	endif;

	if(is_category()):
		$get_this = 'category_'.$current_cat_id;
	else:
		$get_this = get_the_ID();
	endif;
	$use_contact = get_field('add_contact_info', $get_this);
	$use_phone = get_field('use_phone_number', $get_this);
	$use_contact_form = get_field('use_contact_form', $get_this);
	$phone = get_field('phone_number', $get_this);
	$marketo_number = get_field('add_marketo_form_number', $get_this);
	$marketo_title = get_field('add_marketo_title', $get_this);
	$external_contact_form_url = get_field('external_contact_form_url', $get_this);
?>
<section class="container-fluid cwf-banner black-bg">
	<div class="container black-bg">
		<?php if(!is_singular( 'services' ) && !is_front_page()): ?><hr class="cwf-hr header" /><?php endif; ?>
		<div class="row">
			<div class="<?php if($use_contact): ?>col-xs-12 col-sm-7 col-md-8<?php else: ?>col-md-12<?php endif; ?> cwf-padding-top-xs-16 cwf-padding-bottom-xs-32 cwf-padding-top-sm-32 cwf-padding-bottom-sm-48">
				<?php if($banner_title != ''): ?>
				<h1 class="white-text"><?php echo $banner_title; ?></h1>
				<?php endif; ?>
				<p class="h2 white-text">
					<?php echo $blurb; ?>
				</p>
			</div>
			<?php if($use_contact): ?>
			<div class="col-xs-12 col-sm-4 col-sm-offset-1 col-md-3 col-md-offset-1 cwf-padding-top-xs-0 cwf-padding-top-sm-32 cwf-padding-bottom-sm-48 cwf-contant-info<?php if(is_category()): ?> cwf-category<?php endif; ?>">
				<h6 class="text-uppercase white-text text-center"><?php the_field('user_contact_header_text'); ?></h6>

				<?php if($use_phone && $phone): ?>					
				<a href="tel:<?php echo($phone); ?>" class="btn btn-teal-border btn-full btn-block text-uppercase">
					<sub class="i-cwf-customer-service-icon"></sub>
					<span><?php echo $phone; ?></span>
				</a>
				<?php endif; ?>

				<?php if(!$use_contact_form && $external_contact_form_url): ?>
				<a id="banner-contact-us" type="button" class="btn btn-teal-border btn-full btn-block text-uppercase" target="_BLANK" href="<?php echo $external_contact_form_url; ?>">
					<sub class="i-cwf-form-icon"></sub>
					<span>Contact Online</span>
				</a>
				<!--<button id="banner-contact-us" type="button" class="btn btn-teal-border btn-full btn-block text-uppercase" href="<?php echo $external_contact_form_url; ?>"><sub class="i-cwf-form-icon"></sub><span>Contact Online</span></button>-->
				<?php  
				//TODO link button with footer button
				?>
				<?php endif; ?>

				<?php if($use_contact_form && $marketo_number): ?>
				<button id="banner-contact-us" type="button" class="btn btn-teal-border btn-full btn-block text-uppercase">
					<sub class="i-cwf-form-icon"></sub>
					<span><?php echo $marketo_title; ?></span>
				</button>
				<?php  
				echo apply_filters( 'the_content','[marketo_form form_id="'.$marketo_number.'" trigger_selector="#banner-contact-us" trigger_type="custom" title="'.$marketo_title.'"]'); ?>
				<?php endif; ?>
			</div>		
			<?php endif; ?>
		</div>
	</div>
</section>

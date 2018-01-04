<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Conduent
 */

/* 404 'fail up' redirect */
if (! is_admin()) {
	if (is_404()) {
		$cdu_uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
		$cdu_url_segments = explode('/',$cdu_uri_parts[0]);
		if ($cdu_url_segments[1] == "insights") {
			array_pop($cdu_url_segments);
			array_pop($cdu_url_segments);
			array_push($cdu_url_segments,"");
			wp_redirect(implode('/',$cdu_url_segments),301);
		}
	}
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php
/* Conduent header/footer CSS, etc. */
if (function_exists("cdu_banner_display_head_section")) {
	echo cdu_banner_display_head_section();
}
?>
<?php if(!function_exists("cdu_banner_display_head_section")): ?>
    <link rel="stylesheet" type="text/css" href="https://www.conduentassets.com/hfs/static/css/hfs.minimal.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    <link rel="preload" as="image" href="https://www.conduentassets.com/conduent-logo.svg">
<?php endif; ?>

<?php
/* preload featured image if present */
if (is_front_page()) {
	//echo '<link rel="preload" as="image" href="'.get_template_directory_uri().'/placeholderdummycontent/GettyImages-181891493-1024x682.jpg">';
} else {
	$cdu_preload_post = get_post();
	if ($cdu_preload_post) {
		$cdu_background_image = null;

		if (function_exists("get_field") == true) {
			$cdu_background_image = get_field('background_image', $cdu_preload_post->ID);
		}
		if (!empty($cdu_background_image)) {
			echo '<link rel="preload" as="image" href="'.$cdu_background_image.'">';
		} else {
			$cdu_preload_thumbnail = get_post_thumbnail_id( get_post($cdu_preload_post) );
			if ($cdu_preload_thumbnail) {
				echo '<link rel="preload" as="image" href="'.wp_get_attachment_image_url(get_post_thumbnail_id( get_post() ),'full').'">';
			}
		}
	}
}

	/* Conduent locale vars */
	if (function_exists("cdu_head_section_locale_vars")) {
		echo "<script>var cdu_vars = ".cdu_head_section_locale_vars().";\n";
		echo <<<EOT
		var cduDataLayer = cduDataLayer || [];
		cduDataLayer.push(cdu_vars);
</script>
EOT;
	}	else {
		echo "<!-- no locale vars -->";
	}
?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>

<div id="page" class="site">
	<?php
		if (function_exists("cdu_banner_display_header")) {
			echo cdu_banner_display_header();
		}
		$rawtier = get_site_option( 'cdu_banner_tier', 'prod' );
		$tier = $rawtier;
		if ($tier === "testnocache") {
			$tier = "test";
		}
		if (!isset($locale)) {
			$locale = get_locale();
		}
		$locale_data = get_site_option('cdu_locale_data_'.$tier.'_'.$locale);
	?>
	<?php if(!function_exists("cdu_banner_display_head_section")): ?>
    <div id="cwf-top-bar">
      <header class="cwf-hdr fixed" data-locale="en_US">
        <div>
          <div class="cwf-hdr-container">
            <div class="cwf-hdr-fixed">
              <div class="cwf-hdr-logo-container">
                <a class="cwf-hdr-logo" href="http://www.conduent.com"></a>
                <div class="cwf-hdr-third-party"><?php echo $locale_data["country-name-english"] ?></div>
                <div class="cwf-clear"></div>
              </div>
            </div>
          </div>
        </div>
      </header>
    </div>
	<?php endif; ?>

	<div id="content" class="site-content">

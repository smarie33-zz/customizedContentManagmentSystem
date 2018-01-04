<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Conduent
 */

?>

	</div><!-- #content -->

	<?php include(locate_template('template-parts/connect.php'));//( 'template-parts/connect', 'page' ); ?>

	<?php
		if (function_exists("cdu_banner_display_footer")) {
			echo cdu_banner_display_footer();
		}	
	?>
	<?php if(!function_exists("cdu_banner_display_head_section")): ?>	
      <footer class="cwf-ftr" data-locale="en_US">
        <div class="cwf-ftr-container">
          <div class="cwf-ftr-col cwf-ftr-primary">
            <ul>
              <li><a href="https://www.news.conduent.com" target="_self">News</a></li>
              <li><a href="https://investor.conduent.com" target="_self">Investors</a></li>
              <li><a href="https://www.conduent.com/jobs/" target="_self">Careers</a></li>
            </ul>
          </div>
          <div class="cwf-ftr-col cwf-ftr-secondary">
            <ul>
              <li><a href="https://www.conduent.com/privacy-policy/" target="_self">Privacy</a></li>
              <li><a href="https://www.conduent.com/website-terms-and-conditions/" target="_self">Legal</a></li>
              <li><a href="https://www.conduent.com/privacy-policy/#adchoices" target="_self">Privacy Choices</a></li>
            </ul>
          </div>
          <div class="cwf-ftr-col cwf-ftr-copyright">
            &copy; 2017 Conduent Business Services, LLC. All rights reserved. Conduent and Conduent Agile Star are trademarks of Conduent Business Services, LLC in the United States and/or other countries.
          </div>
          <div class="cwf-clear"></div>
        </div>
      </footer>
	<?php endif; ?>

	<?php wp_footer(); ?>
	
</div><!-- #page -->

</body>
</html>

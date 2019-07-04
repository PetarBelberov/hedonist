<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hedonist
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
        <!-- Home Container -->
        <div class="site-info" id="5">
            <?php dynamic_sidebar( 'footer-widget-area' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hedonist
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_theme_file_uri( 'images/google-favicon.ico' ); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	

	<header id="masthead" class="site-header">
		<div class="site-branding" id="1">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$hedonist_description = get_bloginfo( 'description', 'display' );
			if ( $hedonist_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $hedonist_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->
		<?php 
		
		// Checks whether is it privacy policy page or 404 page
		$privacy_policy_page_id = (int)get_option( 'wp_page_for_privacy_policy' );
		if ($privacy_policy_page_id == get_the_ID() || is_404()) {
			?>
			<nav id="site-navigation" class="main-navigation">
				<div id="privacy-policy-back-button">
					<a href="<?php echo home_url(); ?>"><span class="dashicons dashicons-admin-home"></span></a>
				</div>
			</nav><!-- #site-navigation -->
			<?php
		}
		
		else {
			?>
			<nav id="site-navigation" class="main-navigation">
				<div id="toggle">
					<img src="<?php bloginfo('template_url'); ?>/images/menu.png" alt="menu-icon">
				</div>
				<div id="popout-2"></div>    
				<div id="popout">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'menu_class'        => 'menu',
					) );
					?>
				</div>
			</nav><!-- #site-navigation -->
		<?php } ?>
		<?php 
		// Insert schema markup
		$schemamarkup = get_post_meta(get_the_ID(), 'schema-markup', true);
		if(!empty($schemamarkup)) {
		  echo $schemamarkup;
		}
		?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">

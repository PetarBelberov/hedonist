<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hedonist
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
            
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.

        // Checks whether is it privacy policy page
        $privacy_policy_page_id = get_option( 'wp_page_for_privacy_policy' );
        if ($privacy_policy_page_id != get_the_ID()) {
            
            // Slider Container
            if (!dynamic_sidebar("slide-widget") ) : endif;?>

                <!-- Services Container -->
                <div class="services-main">
                    <div class="services-title" id="2"><p><?php echo get_option('services_widget_title') ?></p></div>
                        <div class="services">
                            <div class="row services-containers">
                                    <?php (!dynamic_sidebar("service-widget") ) ?>
                            </div>
                        </div>
                </div>

                <!-- Our Team Container -->
                <?php include_once( get_template_directory() . '/widgets/hedonist-our-team/hedonist-our-team.php' ); ?>
                <div class="our-team-main">
                    <div class="our-team-title" id="3"><p><?php echo get_option('our_team_widget_title') ?></p></div>
                        <div class="row our-team">
                                <?php if (!dynamic_sidebar("our-team-widget") ) : endif;?>
                        </div>
                </div>
                <!-- Home Container -->
                    <?php if (!dynamic_sidebar("home-widget") ) : endif;
            }
        else {
            get_template_part( 'template-parts/content', 'page' );
        }
        ?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();

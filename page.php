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

//			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

    <!-- Slider Container -->
<?php if (!dynamic_sidebar("Slide") ) : endif;?>

    <!-- Services Container -->
    <div class="services-main">
        <div class="services-title" id="2"><h1><?php echo get_option('services_widget_title') ?></h1></div>
            <div class="services">
                <div class="row services-containers">
                        <?php (!dynamic_sidebar("Service") ) ?>
                </div>
            </div>
    </div>

    <!-- Our Team Container -->
    <?php include_once( get_template_directory() . '/widgets/hedonist-our-team/hedonist-our-team.php' ); ?>
    <div class="our-team-main">
        <div class="our-team-title" id="3"><h1><?php echo get_option('our_team_widget_title') ?></h1></div>
            <div class="row our-team">
                    <?php if (!dynamic_sidebar("Our Team") ) : endif;?>
            </div>
    </div>
    <!-- Home Container -->
        <?php if (!dynamic_sidebar("Home") ) : endif;?>

    <!-- Test -->
        <?php if (!dynamic_sidebar("Test") ) : endif;?>
<script type="text/javascript">


</script>
<?php
get_sidebar();
get_footer();

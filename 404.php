<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Hedonist
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<div class="page-content">
                    <div id="notfound">
                        <div class="notfound">
                            <div class="notfound-404">
                                <h1>404</h1>
                            </div>
                            <h2><?php esc_html_e( 'Страницата не е намерена!'); ?></h2>
                            <p><?php esc_html_e( 'Страницата, която търсите може да е премахната, да е със сменено име или да е временно недостъпна.'); ?></p>
                            <a href="<?php echo home_url(); ?>"><?php esc_html_e( 'Начална страница'); ?></a>
                        </div>
                    </div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

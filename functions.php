<?php
/**
 * Hedonist functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Hedonist
 */

if ( ! function_exists( 'hedonist_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hedonist_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Hedonist, use a find and replace
		 * to change 'hedonist' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hedonist', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'hedonist' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'hedonist_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'hedonist_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hedonist_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'hedonist_content_width', 640 );
}
add_action( 'after_setup_theme', 'hedonist_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hedonist_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hedonist' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'hedonist' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'hedonist_widgets_init' );

function home_widget() {
    register_sidebar(array(
        'name' => 'Home #4',
        'id' => 'home-widget',
        'before_widget' => '<div class="home-container">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="home-widget-title" id="4">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'home_widget');

// First footer widget area, located in the footer. Empty by default.
function footer_widget() {
    register_sidebar(array(
        'name' => __('Footer Widget Area #5', 'hedonist'),
        'id' => 'footer-widget-area',
        'description' => __('Footer widget area', 'hedonist'),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'footer_widget');
/**
 * Enqueue scripts and styles.
 */
function hedonist_scripts() {
	wp_enqueue_style( 'hedonist-style', get_stylesheet_uri() );

    wp_register_script( 'slidepanel', get_template_directory_uri() . '/js/slidepanel.js' );

    // Localizes a registered script with data for a JavaScript variable.
    $url_custom = array( 'template_url' => get_bloginfo('template_url') );
    wp_localize_script( 'slidepanel', 'url_custom', $url_custom );

    wp_enqueue_script( 'slidepanel', get_template_directory_uri() . '/js/slidepanel.js', array('jquery'), '20160909', true );

	wp_enqueue_script( 'hedonist-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    wp_enqueue_script( 'custom', get_template_directory_uri() . '/custom-style/custom.js', array('jquery'), 1.1, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hedonist_scripts' );

function custom_enqueue_styles() {

    wp_enqueue_style( 'custom', get_template_directory_uri() . '/custom-style/custom.css' );
    wp_enqueue_style( 'core', get_template_directory_uri() . '/custom.css' );
    wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );

}
add_action( 'wp_enqueue_scripts', 'custom_enqueue_styles');

function add_google_fonts() {
    wp_enqueue_style( 'add_google_fonts', 'https://fonts.googleapis.com/css?family=Bad+Script|Playfair+Display&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

function bootstrap_enqueue_styles() {

    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css' );
    wp_enqueue_style( 'core', get_template_directory_uri() . '/style.css' );

}
add_action( 'wp_enqueue_scripts', 'bootstrap_enqueue_styles');

function bootstrap_enqueue_scripts() {
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'bootstrap_enqueue_scripts');


//Function to add Meta Tags in Header without Plugin
function add_meta_tags() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">';
}
add_action('wp_head', 'add_meta_tags');
//Function to add Meta Tags in Header without Plugin

function disable_page_header(  ) {
    return false;
}
add_filter( 'wpex_display_page_header', 'disable_page_header' );

// Add custom widgets and widget areas
require get_template_directory() . '/widgets/hedonist-our-team/hedonist-our-team.php';

require get_template_directory() . '/widgets/hedonist-slide/hedonist-slide.php';

require get_template_directory() . '/widgets/hedonist-services/hedonist-services.php';
// Add custom widgets and widget areas



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

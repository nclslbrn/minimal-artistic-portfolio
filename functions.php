<?php
/**
 * Minimal-Artistic-Portfolio functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Minimal-Artistic-Portfolio
 */

if ( ! function_exists( 'map_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function map_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Minimal-Artistic-Portfolio, use a find and replace
		 * to change 'Minimal-Artistic-Portfolio' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'Minimal-Artistic-Portfolio', get_template_directory() . '/languages' );
		$local      = get_locale();
		$local_file = get_template_directory() . "/languages/$local";

		if ( is_readable( $local_file ) ) {
			require_once $local_file;
		}

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
		register_nav_menus(
			array(
				'primary'     => esc_html__( 'Primary', 'Minimal-Artistic-Portfolio' ),
				'footer-menu' => esc_html__( 'Footer Menu', 'Minimal-Artistic-Portfolio' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'map_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'map_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function map_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'map_content_width', 640 );
}
add_action( 'after_setup_theme', 'map_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function map_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'Minimal-Artistic-Portfolio' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'Minimal-Artistic-Portfolio' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'map_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function map_scripts() {
	wp_enqueue_style( 'leafletStyle', 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css', '', '1.7.1', 'all' );
	wp_enqueue_style( 'Minimal-Artistic-Portfolio-style', get_template_directory_uri() . '/style.css', '', '2.0.1', 'all' );
	wp_enqueue_style( 'Minimal-Artistic-Portfolio-font', get_template_directory_uri() . '/build/fonts/stylesheet.css', '', '2.0.0', 'all' );
	wp_enqueue_script( 'leafletScript', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', '', '2.1.9', false );
	wp_enqueue_script( 'Minimal-Artistic-Portfolio-script', get_template_directory_uri() . '/build/js/front.js', array( 'leafletScript' ), '2.0.1', true );
	wp_enqueue_style( 'vidstack-style', 'https://cdn.vidstack.io/player.css', '', '', 'all');
	wp_register_script_module( 'vidstack-script', 'https://cdn.vidstack.io/player.core@1.11.21', array(), '1.11.21', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'map_scripts' );

/**
 * Add a dedicated stylesheet for WordPress Admin
 */
function map_admin_scripts() {
	wp_enqueue_style( 'Minimal-Artistic-Portfolio-adminstyle', get_template_directory_uri() . '/admin.css', '', '1.0.0', 'all' );
	wp_enqueue_script( 'Minimal-Artistic-Portfolio-script', get_template_directory_uri() . '/build/js/back.js', array( 'leafletScript' ), '1.0.0', true );
}
add_action( 'admin_head', 'map_admin_scripts' );

/*
 * ADD A DIFFERENT SIZE FOR EVENT COVER
 *
 */
add_image_size( 'cover', 640, 400, true );
add_image_size( 'carton', 400, 640, false );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom post type feature (ie: projects & events).
 */
require get_template_directory() . '/inc/custom-post.php';

/**
 * Load a dynamic project menu (comment to disable it)
 */
require get_template_directory() . '/inc/map-dynamic-project-menu.php';

/**
 * Load meta box features.
 */
require get_template_directory() . '/inc/meta-box.php';

/**
 * Load night mode widget
 */
require get_template_directory() . '/inc/class-map-night-mode-widget.php';

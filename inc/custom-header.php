<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
	<?php } // if ( ! empty( $header_image ) ) ?>
 *
 * @package Minimal-artistic-portfolio
 * @since Minimal-artistic-portfolio 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @uses map_header_style()
 * @uses map_admin_header_style()
 * @uses map_admin_header_image()
 *
 * @package Minimal-artistic-portfolio
 */
function map_custom_header_setup() {
	$args = array(
		'default-image'          => '',
		'default-text-color'     => '000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'map_header_style',
		'admin-head-callback'    => 'map_admin_header_style',
		'admin-preview-callback' => 'map_admin_header_image',
	);

	$args = apply_filters( 'map_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-header', $args );
	} 
}
add_action( 'after_setup_theme', 'map_custom_header_setup' );

/**
 * Shiv for get_custom_header().
 * get_custom_header() was introduced to WordPress
 * in version 3.4. To provide backward compatibility
 * with previous versions, we will define our own version
 * of this function.
 *
 * @return stdClass All properties represent attributes of the curent header image.
 *
 * @package Minimal-artistic-portfolio
 * @since Minimal-artistic-portfolio 1.1
 */

if ( ! function_exists( 'map_get_custom_header' ) ) {
	/**
	 * Gets the header image data.
	 *
	 * @link https://developer.wordpress.org/reference/functions/get_custom_header/
	 */
	function map_get_custom_header() {
		return (object) array(
			'url'           => get_header_image(),
			'thumbnail_url' => get_header_image(),
			// phpcs:ignore
			'width'         => HEADER_IMAGE_WIDTH,
			// phpcs:ignore
			'height'        => HEADER_IMAGE_HEIGHT,
		);
	}
}

if ( ! function_exists( 'map_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog
	 *
	 * @see map_custom_header_setup().
	 *
	 * @since Minimal-artistic-portfolio 1.0
	 */
	function map_header_style() {
		// phpcs:ignore
		if ( HEADER_TEXTCOLOR === get_header_textcolor() ) {
			return;
		}
		// If we get this far, we have custom styles. Let's do this.
		?>
	<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( 'blank' === get_header_textcolor() ) : 
			?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
		<?php else : ?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( get_header_textcolor() ); ?> !important;
		}
		<?php endif; ?>
	</style>
		<?php
	}
endif;

if ( ! function_exists( 'map_admin_header_style' ) ) :
	/**
	 * Styles the header image displayed on the Appearance > Header admin panel.
	 *
	 * @see map_custom_header_setup().
	 *
	 * @since Minimal-artistic-portfolio 1.0
	 */
	function map_admin_header_style() {
		?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
	}
	#headimg h1 {
	}
	#headimg h1 a {
	}
	#desc {
	}
	#headimg img {
	}
	</style>
		<?php
	}
endif;

if ( ! function_exists( 'map_admin_header_image' ) ) :
	/**
	 * Custom header image markup displayed on the Appearance > Header admin panel.
	 *
	 * @see map_custom_header_setup().
	 *
	 * @since Minimal-artistic-portfolio 1.0
	 */
	function map_admin_header_image() { 
		?>
	<div id="headimg">
			<?php
			if ( 'blank' === get_header_textcolor() || '' === get_header_textcolor() ) {
				$style = ' style="display:none;"';
			} else {
				$style = ' style="color:#' . get_header_textcolor() . ';"';
			}
			?>
		<h1><a id="name"<?php echo esc_attr( $style ); ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo esc_attr( $style ); ?>><?php bloginfo( 'description' ); ?></div>
		<?php 
		$header_image = get_header_image();
		if ( ! empty( $header_image ) ) : 
			?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
		<?php 
	}
endif;

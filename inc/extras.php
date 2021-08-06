<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Minimal-Artistic-Portfolio
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function map_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'map_body_classes' );


add_filter( 'image_send_to_editor', 'map_fluidbox_capable', 10, 7 );

/**
 * Add fluidbox CSS class to inside post_content images
 *
 * @param string $html <img> outer_text
 * @param int    $id media ID
 * @param string $alt alt description text
 * @param string $title media title
 * @param string $url url of media
 * @param string $size name of thumbnail size
 * @return string $html the text insterted in post_content 
 */
function map_fluidbox_capable( $html, $id, $alt, $title, $align, $url, $size ) {
	$classes_to_add = 'fluidbox';
	if ( preg_match( '/<a.? class=".?">/', $html ) ) {
		$html = preg_replace( '/(<a.? class=".?)(".\?>)/', '$1 ' . $classes_to_add . '$2', $html );
	} else {
		$html = preg_replace( '/(<a.*?)>/', '$1 class="' . $classes_to_add . '">', $html );
	}
	return $html;
}

/**
 * Add light/dark theme chooser
 */
function map_mode_chooser_button() {
	?>
	<li class="mode-switcher">
		<svg class="icon icon-sun"><use xlink:href="#icon-sun"></use></svg>
		<label class="switch">
		  <input type="checkbox" name="mode-switcher" 
			  <?php echo ( isset( $_COOKIE['mode'] ) && $_COOKIE['mode'] === 'dark' ) ? 'checked' : ''; ?>>
		  <span class="slider"></span>
		</label>

		<?php // _e('Dark', 'minimal_artistic_portfolio'); ?>
		<svg class="icon icon-moon"><use xlink:href="#icon-moon"></use></svg>
	</li>
	<?php
}
?>

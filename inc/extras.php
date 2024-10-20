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
function map_body_classes($classes)
{
	// Adds a class of group-blog to blogs with more than 1 published author.
	if (is_multi_author()) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if (! is_singular()) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter('body_class', 'map_body_classes');


add_filter('image_send_to_editor', 'map_fluidbox_capable', 10, 7);

/**
 * Add fluidbox CSS class to inside post_content images
 *
 * @param string $html <img> outer_text.
 * @param int    $id media ID.
 * @param string $alt alt description text.
 * @param string $title media title.
 * @param string $align media alignment property.
 * @param string $url url of media.
 * @param string $size name of thumbnail size.
 * @return string $html the text insterted in post_content.
 */
function map_fluidbox_capable($html, $id, $alt, $title, $align, $url, $size)
{
	$classes_to_add = 'fluidbox';
	if (preg_match('/<a.? class=".?">/', $html)) {
		$html = preg_replace('/(<a.? class=".?)(".\?>)/', '$1 ' . $classes_to_add . '$2', $html);
	} else {
		$html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes_to_add . '">', $html);
	}
	return $html;
}


/**
 * Add light/dark theme chooser (switch)
 *
 * @return string $switch the HTML markup of the switch
 */
function map_mode_chooser_button()
{
	$switch  = '';
	$switch .= '<li class="mode-switcher">';
	$switch .= '<fieldset>';
	$switch .= '<svg class="icon icon-sun"><use xlink:href="#icon-sun"></use></svg>';
	$switch .= '<label class="switch">';
	$switch .= '<input type="checkbox" name="mode-switcher" ' .
		((isset($_COOKIE['mode']) && 'dark' === $_COOKIE['mode']) ? 'checked' : '') . '>';
	$switch .= '<span class="slider"></span>';
	$switch .= '</label>';

	$switch .= '<svg class="icon icon-moon"><use xlink:href="#icon-moon"></use></svg>';
	$switch .= '</fieldset>';
	$switch .= '</li>';

	return $switch;
}

/**
 * Add light/dark theme chooser (menu)
 *
 * @return string $entry the HTML markup of menu entry
 */
function map_mode_chooser_menu()
{
	$icon_name = isset($_COOKIE['mode']) && 'dark' === $_COOKIE['mode'] ? 'moon' : 'sun';
	$entry     = '<li class=\'menu-item menu-item-has-children\'>';
	$entry    .= '<a data-current-theme title=\'' . esc_attr__('Theme', 'Minimal-Artistic-Portfolio') . '\'>' .
		'<svg class=\'icon icon-' . $icon_name . '\'>' .
		'<use xlink:href=\'#icon-' . $icon_name . '\'>' .
		'</use>' .
		'</svg>' .
		'</a>';
	$entry    .= '<ul class=\'sub-menu\'>';


	$entry .= '<li class=\'theme-mode\'>';
	$entry .= '<button name="mode-switcher" class=\'theme-mode-button\' value=\'light\'>';
	$entry .= esc_html__('Light', 'Minimal-Artistic-Portfolio');
	$entry .= '<svg class="icon icon-sun"><use xlink:href="#icon-sun"></use></svg>';
	$entry .= '</button>';
	$entry .= '</li>';

	$entry .= '<li class=\'theme-mode\'>';
	$entry .= '<button name="mode-switcher" class=\'theme-mode-button\' value=\'dark\'>';
	$entry .= esc_html__('Dark', 'Minimal-Artistic-Portfolio');
	$entry .= '<svg class="icon icon-moon"><use xlink:href="#icon-moon"></use></svg>';
	$entry .= '</button>';
	$entry .= '</li>';
	$entry .= '</ul>';
	$entry .= '</li>';

	return $entry;
}

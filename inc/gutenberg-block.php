<?php

/**
 *
 * Add custom block style to default gutenberg block
 *
 * @package Minimal-Artistic-Portfolio
 * @version 1.0.0
 */


function map_gutenberg_scripts()
{
	wp_enqueue_script(
		'map-editor',
		get_stylesheet_directory_uri() . '/build/js/editor.js',
		array('wp-blocks', 'wp-dom'),
		filemtime(get_stylesheet_directory() . '/build/js/editor.js'),
		true
	);
}
add_action('enqueue_block_editor_assets', 'map_gutenberg_scripts');


<?php

/**
 * Use to get file path and file name (Vite add cache burster)
 * */
if (!function_exists('map_get_vite_assets_files'))
{

	if (!defined('IS_DEV_SERVER')) define('IS_DEV_SERVER', false);
	if (!defined('VITE_SERVER_URL')) define('VITE_SERVER_URL', 'http://localhost:5173');

	function map_get_vite_assets_files()
	{
		$map_asset_files = Array(
			'vite-client' 	=> false,
			'front-js' 		=> false,
			'front-css'		=> false,
			'back-js'  		=> false,
			'back-css'		=> false,
			'editor-js' 	=> false,
			'editor-js' 	=> false,
		);

		// Running on development server
		if (defined('IS_DEV_SERVER') && defined('VITE_SERVER_URL') && IS_DEV_SERVER)
		{
			$map_asset_files['vite-client'] = VITE_SERVER_URL . '/@vite/client';

			$map_asset_files['front-js'] = VITE_SERVER_URL . '/src/js/front.js';
			$map_asset_files['front-css'] = VITE_SERVER_URL . '/src/sass/style.scss';

			$map_asset_files['back-js'] = VITE_SERVER_URL . '/src/js/back.js';
			$map_asset_files['back-css'] = VITE_SERVER_URL . '/src/sass/back.scss';

			$map_asset_files['editor-js'] = VITE_SERVER_URL . '/src/js/editor.js';
			$map_asset_files['editor-css'] = VITE_SERVER_URL . '/src/sass/editor.scss';
		}
		// Fallback to transpiled files listed in manifest
		else
		{
			$manifest_path = get_theme_file_path('build/.vite/manifest.json');

			if (!file_exists($manifest_path)) {
				return $map_asset_files;
			}

			$manifest = json_decode(file_get_contents($manifest_path), true);
			if ($manifest['src/js/front.js'] && $manifest['src/js/front.js']['file'])
				$map_asset_files['front-js'] = get_template_directory_uri() . '/build/' . $manifest['src/js/front.js']['file'];

			if ($manifest['src/sass/style.scss'] && $manifest['src/sass/style.scss']['file'])
				$map_asset_files['front-css'] = get_template_directory_uri() . '/build/' . $manifest['src/sass/style.scss']['file'];

			if ($manifest['src/js/back.js'] && $manifest['src/js/back.js']['file'])
				$map_asset_files['back-js'] = get_template_directory_uri() . '/build/' . $manifest['src/js/back.js']['file'];

			if ($manifest['src/sass/back.scss'] && $manifest['src/sass/back.scss']['file'])
				$map_asset_files['back-css'] = get_template_directory_uri() . '/build/' . $manifest['src/sass/back.scss']['file'];

			if ($manifest['src/js/editor.js'] && $manifest['src/js/editor.js']['file'])
				$map_asset_files['editor-js'] = get_template_directory_uri() . '/build/' . $manifest['src/js/editor.js']['file'];

			if ($manifest['src/sass/editor.scss'] && $manifest['src/sass/editor.scss']['file'])
				$map_asset_files['editor-css'] = '/build/' . $manifest['src/sass/editor.scss']['file'];

		}
		return $map_asset_files;
	}
}

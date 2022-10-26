export default {
	themeSlug: 'minimal-artistic-portfolio',
	server: {
		proxy: 'nicolas-lebrun.localhost',
		port: 8080
	},
	srcDir: './src',
	dstDir: './build',
	styles: {
		srcDir: './src/sass',
		src: [ 'style.scss', 'admin.scss' ],
		dstDir: './'
	},
	scripts: {
		srcDir: './src/js',
		entries: [ 'front.js', 'back.js' ],
		dstDir: './build/js',
		babelPreset: [
			[
				'@babel/env',
				{
					corejs: 3,
					useBuiltIns: 'usage',
					targets: {
						browsers: 'defaults'
					}
				}
			]
		],
		external: [
			'jquery',
			'@wordpress/components',
			'@wordpress/compose',
			'@wordpress/edit-post',
			'@wordpress/block-editor',
			'@wordpress/dom-ready',
			'@wordpress/element',
			'@wordpress/plugins',
			'@wordpress/editor',
			'@wordpress/blocks',
			'@wordpress/hooks',
			'@wordpress/utils',
			'@wordpress/date',
			'@wordpress/data',
			'@wordpress/i18n',
			'@wordpress/url',
			'@wordpress/a11y',
			'@wordpress/keycodes',
			'lodash',
			'react',
			'react-dom'
		],
		globals: {
			jquery: 'jQuery',
			'@wordpress/components': 'wp.components',
			'@wordpress/compose': 'wp.compose',
			'@wordpress/edit-post': 'wp.editPost',
			'@wordpress/dom-ready': 'wp.domReady',
			'@wordpress/block-editor': 'wp.blockEditor',
			'@wordpress/element': 'wp.element',
			'@wordpress/plugins': 'wp.plugins',
			'@wordpress/editor': 'wp.editor',
			'@wordpress/blocks': 'wp.blocks',
			'@wordpress/hooks': 'wp.hooks',
			'@wordpress/utils': 'wp.utils',
			'@wordpress/date': 'wp.date',
			'@wordpress/data': 'wp.data',
			'@wordpress/i18n': 'wp.i18n',
			'@wordpress/url': 'wp.url',
			'@wordpress/a11y': 'wp.a11y',
			'@wordpress/keycodes': 'wp.keycodes',
			lodash: 'lodash',
			react: 'React',
			'react-dom': 'ReactDOM'
		}
	},
	images: {
		srcDir: './src/img',
		dstDir: './build/img'
	},
	translate: {
		srcDir: './',
		src: [ '**/*.php' ],
		dstDir: './languages'
	},
	otherFiles: [

		// examples:
		'./src/fonts/**',
		{
			origPath: [ './src/js/back/customizer.js' ],
			path: './js/customizer.js'
		}

		// {
		//   origPath: ["node_modules/optinout.js/dist/optinout.js"],
		//   path: "web/app/themes/efs/assets/libs/"
		// },
		// {
		//   origPath: ["node_modules/optinout.js/dist/optinout.js"],
		//   base: "node_modules/optinout.js",
		//   path: "web/app/themes/efs/assets/libs/"
		// }
	]
}

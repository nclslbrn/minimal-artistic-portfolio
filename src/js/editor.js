wp.domReady( () => {
	wp.blocks.registerBlockStyle( 'core/gallery', [
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},
		{
			name: 'tiled',
			label: 'Tiled',
		}
	]);

	wp.blocks.registerBlockStyle( 'core/image', [
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},
		{
			name: 'oneCol',
			label: '1 column',
		},
		{
			name: 'twoCol',
			label: '2 columns'
		},
		{
			name: 'threeCol',
			label: '3 columns'
		},
		{
			name: 'fourCol',
			label: '4 columns'
		},
		{
			name: 'fiveCol',
			label: '5 columns'
		}
	]);

} );

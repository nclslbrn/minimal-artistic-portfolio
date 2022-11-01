export default function() {
	const menuToggle = document.querySelector( '.menu-toggle' )
	const subMenuToggle = document.querySelectorAll( '.menu-item-has-children' )
	let menu

	if ( menuToggle !== undefined ) {
		const menuId = menuToggle.getAttribute( 'aria-labelledby' )
		menu = document.getElementById( menuId ).parentNode
		console.log( menu )
		menuToggle.addEventListener( 'click', function() {
			menuToggle.classList.toggle( 'open' )
			menuToggle.setAttribute( 'aria-expanded',
				menuToggle.classList.contains( 'open' ) ?
					'false' :
					'true'
			)
			menu.classList.toggle( 'toggled' )
			document.body.classList.toggle( 'fixed' )
		})

		subMenuToggle.forEach( ( toggle ) => {
			addEventListener( 'click', function() {
				toggle.classList.toggle( 'open' )
			})
		})
	}
}

export default function() {

	( function( $ ) {
		$( '.menu-toggle' ).on( 'click', function() {
			$( this ).toggleClass( 'open' )
			$( this ).attr( 'aria-expanded', $( this ).hasClass( open ) ? 'false' : 'true' )
			$( '#site-navigation' ).toggleClass( 'toggled' )
			$( 'body' ).toggleClass( 'fixed' )
		})

		$( '.menu-item-has-children' ).click( function() {
			$( this ).toggleClass( 'open' )
		})
	}( jQuery ) )
}

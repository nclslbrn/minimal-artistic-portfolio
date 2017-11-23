
jQuery( ".menu-toggle" ).click(function() {
	jQuery(this).toggleClass("open");
  jQuery( '#site-navigation' ).toggleClass( "toggled" );
});

jQuery(".menu-item-has-children").click(function() {
	jQuery(this).toggleClass("open");
});
jQuery('body').addClass('no-scroll');
jQuery(window).load(function() {
	// Animate loader off screen
	jQuery('#loader').fadeOut('slow');
	jQuery('body').removeClass('no-scroll');
});

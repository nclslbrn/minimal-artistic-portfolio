
jQuery( ".menu-toggle" ).click(function() {
	jQuery(this).toggleClass("open");
  jQuery( '#site-navigation' ).toggleClass( "toggled" );
});

jQuery(".menu-item-has-children").click(function() {
	jQuery(this).toggleClass("open");
});

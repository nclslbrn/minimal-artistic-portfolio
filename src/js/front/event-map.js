jQuery( document ).ready(function( $ ) {

  var mapHeight = $('.map-overlay').height();
  var mapWidth = $('.map-overlay').width();

  if( mapHeight == 0 || mapWidth == 0 ){
    mapHeight = 500;
    mapWidth = $('.map-overlay').width();
  }

  $('#map').height( mapHeight );
  $('#map').width( mapWidth );

  L.Util.requestAnimFrame(map.invalidateSize,map,!1,map._container);
  //map.resize();
  //  console.log( "ready!" );
  //map.invalidateSize();​
});

//setTimeout(function(){ map.invalidateSize()}, 400);

jQuery( ".map-overlay" ).click(function() {
	jQuery(this).addClass('active');
  jQuery(this).unbind('click');
  //console.log( "map active !" );
});

jQuery(document).ready(function($) {

    if ($('.map-overlay').length && $('#map')) {

        let mapHeight = $('.map-overlay').height();
        let mapWidth = $('.map-overlay').width();

        if (mapHeight == 0 || mapWidth == 0) {
            mapHeight = 500;
            mapWidth = $('.map-overlay').width();
        }

        $('#map').height(mapHeight);
        $('#map').width(mapWidth);

        L.Util.requestAnimFrame(map.invalidateSize, map, !1, map._container);

        jQuery(".map-overlay").click(function() {
            jQuery(this).addClass('active');
            jQuery(this).unbind('click');
        });
    }

});
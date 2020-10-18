<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Minimal-Artistic-Portfolio
 */

?>
</div><!-- .wrapper .row -->
<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="wrapper row">

		<div class="col-3 footer-menu">
			<?php if ( has_nav_menu( 'footer-menu' ) ) {
			  			wp_nav_menu( array( 'theme_location' => 'footer-menu') );
						} ?>
		</div>
		<div class="col-9 site-info">
			<p>
				
				<?php echo get_site_url() . ' '; ?><?php _e( 'All right reserved', 'Minimal-Artistic-Portfolio' ); ?>

				<span class="sep"> | </span>
				<a href="https://studio.nicolas-lebrun.fr">
					<?php _e( 'Designed by Nicolas Lebrun', 'Minimal-Artistic-Portfolio' ); ?>
				</a>
			</p>
		</div><!-- .site-info -->

	</div><!-- .wrapper -->
</footer><!-- #colophon -->

</div><!-- #content -->
</div><!-- #page -->
<?php wp_footer(); ?>
<?php /* register js script for map with unique marker on event page */ ?>
<?php global $latt; ?>
<?php global $long; ?>
<?php global $actualEvents; ?>
<?php //global $encodeMapData; ?>
<?php /* if( !empty( $GLOBALS['latt'] ) && !empty( $GLOBALS['long'] && empty( $actualEvents )) ): ?>

	<script>
	window.addEventListener("load", function(event) {
		    
		  
		var latlng = L.latLng(<?php echo $GLOBALS['latt']; ?>, <?php echo $GLOBALS['long']; ?>);

		var map = L.map('map').setView(latlng, 18);
		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibmNsc2xicm4iLCJhIjoiZDg4MjQ0ZDY0MTdmNDgwNGIwYThmNDQ0ODFhOTJkOGEifQ.xHiQa0_sxMS9a6f_msoWig', {
	    	attribution: '',
	    	maxZoom: 18,
	    	id: 'nclslbrn.mecljejb',
	    	accessToken: 'pk.eyJ1IjoibmNsc2xicm4iLCJhIjoiZDg4MjQ0ZDY0MTdmNDgwNGIwYThmNDQ0ODFhOTJkOGEifQ.xHiQa0_sxMS9a6f_msoWig'
		}).addTo(map);
		marker = new L.marker( latlng ).addTo(map);
	});
	</script>

<?php endif; */ ?>
<?php wp_reset_query(); ?>

<?php if ( is_page_template( 'events.php' ) && isset( $GLOBALS['encodeMapData'] ) ): /* ?>
	<script>
	<?php echo "var locations = ". $GLOBALS['encodeMapData']  . ";\n"; ?>
		var map = L.map('map').setView([46.481170, 2.440409], 6);
		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibmNsc2xicm4iLCJhIjoiZDg4MjQ0ZDY0MTdmNDgwNGIwYThmNDQ0ODFhOTJkOGEifQ.xHiQa0_sxMS9a6f_msoWig', {
				attribution: '',
				maxZoom: 18,
				id: 'nclslbrn.mecljejb',
				accessToken: 'pk.eyJ1IjoibmNsc2xicm4iLCJhIjoiZDg4MjQ0ZDY0MTdmNDgwNGIwYThmNDQ0ODFhOTJkOGEifQ.xHiQa0_sxMS9a6f_msoWig'
		}).addTo(map);

		for ( var i=0; i < locations.length; ++i )
		{
		   marker = new L.marker( [locations[i].latt, locations[i].long] )
		      .bindPopup( locations[i].info )
		      .addTo( map );
		}
		jQuery(document).ready(function(){
			jQuery("#change-event-display-mode button").on("click", function(){
				
				jQuery("#change-event-display-mode button").removeClass("active");
				jQuery(this).addClass("active");
				var target = jQuery(this).data("toggle");
				
				if( jQuery("#" + target ) ) {
					if( target === "map") {
						
						L.Util.requestAnimFrame(map.invalidateSize,map,!1,map._container);
						jQuery("#events-list").css("display", "none");
						jQuery("#map").css("height", "500px");
						
					} else if( target === "events-list" ) {
						
						jQuery("#map").css("height", "0");
						jQuery("#events-list").css("display", "block");
					}
				}
			});
		});
	</script>
	<?php */ endif; ?>

</body>
</html>

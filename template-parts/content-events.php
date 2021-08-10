<?php 
/**
 * Template for displaying all events in events.php page template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 */ 

?>

<div class="entry-content">
  	<div id="change-event-display-mode" class="event-menu">

		<button data-toggle="map" class="button">
			<svg class="icon icon-location">
				<use xlink:href="#icon-location"></use>
			</svg>
			<?php esc_html( __( 'Map', 'Minimal-Artistic-Portfolio' ) ); ?>
		</button>

		<button data-toggle="events-list" class="button active">
			<svg class="icon icon-calendar">
				<use xlink:href="#icon-calendar"></use>
			</svg>
			<?php esc_html( __( 'List', 'Minimal-Artistic-Portfolio' ) ); ?>
		</button>
 	</div>

  	<div class="clearfix"></div>

  	<div id="events-list">
		
	 	<?php map_list_posts_by_years( 'event', -1 ); ?>

		<section class="ac-container">
			<div class="event-year-section">
				<?php map_get_metabox( get_the_ID(), 'school', true ); ?>
				<?php map_get_metabox( get_the_ID(), 'experience', true ); ?>
			</div>
		</section>
  	</div><!-- #event-list -->

  	<!-- <div class="map-overlay" style="height: 0; overflow: hidden;"> -->
	<div id="map" class="map multiple-marker"></div>
  	<!-- </div> .map-overlay -->

</div><!-- .entry-content -->

<?php /* template for displaying all events on events.php page template */ ?>

<div class="entry-content">
  <div class="event-menu">

    <button id="toggle-map" class="button">
      <svg class="icon icon-location">
        <use xlink:href="#icon-location"></use>
      </svg>
      <?php _e( 'Map', 'Minimal-Artistic-Portfolio'); ?>
    </button>
    <button id="toggle-projects-list" class="button">
      <svg class="icon icon-calendar">
        <use xlink:href="#icon-calendar"></use>
      </svg>
      <?php _e( 'List', 'Minimal-Artistic-Portfolio'); ?>
    </button>
  </div>

  <div class="clearfix"></div>

  <div id="events-list">
    <?php $GLOBALS['encodeMapData'] = list_custom_posts_by_date( "event", -1 );?>
    <section class="ac-container">
      <div class="event-year-section">
        <?php get_metabox(get_the_ID(), 'school', true);?>
      </div>
    </section>
  </div>
  <div class="map-overlay">
    <div id="map" class="map" style="height: 0; overflow: hidden;"></div>
  </div>

</div><!-- .entry-content -->

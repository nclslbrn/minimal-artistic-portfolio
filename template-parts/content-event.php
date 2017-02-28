<?php
    /* template for displaying one event on single-event.php */
?>

<div id="event-<?php echo get_the_ID(); ?>" class="event clearfix">

  <header class="entry-header">
    <h1 class="event-title"><?php echo get_the_title(); ?></h1>
  </header>
  <div class="row">
    <div class="col-6 column">
      <?php echo get_the_post_thumbnail( get_the_ID(), 'full' ); ?>
    </div>

    <div class="col-6 column col-map">
      <?php if( !empty($GLOBALS['latt'] ) && !empty($GLOBALS['long'] ) ): ?>
        <div class="map-overlay">
          <div id='map' class='map'>
          </div>
        </div>
      <?php endif; ?>
    </div>

  </div>
  <div class="row">

    <div class="col-3 column">

      <p class="place"><?php echo get_post_meta( get_the_ID(), 'PLACE', 'true'); ?></p><br />

      <p class="date">
        <?php _e( 'From', 'Minimal-Artistic-Portfolio' ); ?><?php echo ' ' . date_i18n('j F Y', strtotime(get_post_meta( get_the_ID(), 'BEGINDATE', 'true') ) ); ?>
        <?php _e( 'to', 'Minimal-Artistic-Portfolio' ); ?><?php echo ' ' . date_i18n('j F Y', strtotime(get_post_meta( get_the_ID(), 'ENDDATE', 'true') ) ); ?>
      </p></br />

      <p class="related-project">
        <?php get_project(get_the_ID(), 'projet(s)/project(s)');?>
      </p>
    </div>
    <div class="col-9 column">
        <?php the_content(); ?>
    </div>

  </div>
<?php  ?>

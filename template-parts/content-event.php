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
          <div id='map' 
               class='map single-marker' 
               data-latitude="<?php echo $GLOBALS['latt']; ?>"
               data-longitude="<?php echo $GLOBALS['long'];?>"
          >
          </div>
        </div>
      <?php endif; ?>
    </div>

  </div>
  <div class="row event-text
  <?php if( get_the_content() !== '') echo ' filled'; ?>
  <?php if( get_project( get_the_ID() ) == false) echo ' no-project'; ?>
  ">

    <div class="col-4 column">

      <p class="place">
        <svg class="icon icon-location">
          <use xlink:href="#icon-location"></use>
        </svg>
        <?php echo get_post_meta( get_the_ID(), 'PLACE', 'true'); ?>
      </p>

      <p class="date">
        <svg class="icon icon-calendar">
          <use xlink:href="#icon-calendar"></use>
        </svg>
        <?php _e( 'From', 'Minimal-Artistic-Portfolio' ); ?><?php echo ' ' . date_i18n('j F Y', strtotime(get_post_meta( get_the_ID(), 'BEGINDATE', 'true') ) ); ?>
        <?php _e( 'to', 'Minimal-Artistic-Portfolio' ); ?><?php echo ' ' . date_i18n('j F Y', strtotime(get_post_meta( get_the_ID(), 'ENDDATE', 'true') ) ); ?>
      </p></br />
      <?php if(get_project(get_the_ID()) !== false) echo get_project(get_the_ID());?>
      <?php social_module(
        get_the_title(),
        get_the_permalink( get_the_ID()),
		  'laptop'
      ); ?>

    </div>
    <div class="col-8 column">
        <?php the_content(); ?>
        <?php social_module(
          get_the_title(),
          get_the_permalink( get_the_ID() ),
			 'mobile'
        ); ?>
    </div>
  </div>

<?php  ?>

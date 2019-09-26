<?php if( !is_single() ) { ?>

  <div id="project-<?php echo get_the_ID(); ?>" class="project-summary clearfix row">

    <div class="col-5 column">
      <a href="<?php echo get_permalink(); ?>" class="project-cover">
        <?php echo get_the_post_thumbnail( get_the_ID(), 'cover'); ?>
      </a>
    </div>
    <div class="col-7 column cartel">
      <div class="wrapper">

        <h4 class="project-title">
          <?php echo get_the_title(); ?>
        </h4>

        <p class="description">
          <?php $cartel =  get_post_meta( get_the_ID(), 'CARTEL', true); ?>
          <?php echo $cartel; ?>,
          <span class="date">
            <?php echo mysql2date("Y.", $post->post_date_gmt); ?>
          </span>
        </p>

        <a href="<?php echo get_permalink(); ?>" class="button">
          <?php _e('Read more', 'Minimal-Artistic-Portfolio'); ?>
        </a>

      </div>

    </div>

  </div>

<?php } if( is_single() ) { ?>
  <header class="entry-header">
    <h1 class="project-title"><?php echo get_the_title(); ?></h1>
  </header>
  <div class="entry-content">
    <?php echo get_the_post_thumbnail( get_the_ID(), 'full'); ?>
    <div class="row project-text
    <?php if( get_the_content() !== '') echo ' filled'; ?>
    <?php if( get_event(get_the_ID()) == false) echo ' no-event'; ?>">
      <div class="col-4 column">
        <p class="cartel">
          <?php
            $cartel =  get_post_meta( get_the_ID(), 'CARTEL', true);
            echo $cartel;
            ?>,
          <span class="date"><?php echo mysql2date("Y", $post->post_date_gmt); ?></span>.
        </p>
        <?php if( get_event(get_the_ID()) !== false ) echo get_event( get_the_ID() ); ?>
        <?php social_module( get_the_title(), get_the_permalink( get_the_ID() ), 'laptop' ); ?>
      </div>
      <div class="col-8 column">
        <?php the_content(); ?>
      </div>
		<?php social_module( get_the_title(), get_the_permalink( get_the_ID() ), 'mobile' ); ?>
    </div>
  </div>
<?php } ?>

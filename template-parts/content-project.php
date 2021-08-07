<?php 
/**
 * Template for displaying one event within single-event.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 */

$map_cartel = get_post_meta( $post->ID, 'CARTEL', true );

if ( ! is_single() ) { ?>

<div id="project-<?php echo get_the_ID(); ?>" class="project-summary clearfix row">

  <div class="col-5 column">
	<a href="<?php echo esc_url( get_permalink() ); ?>" class="project-cover">
	  <?php echo get_the_post_thumbnail( get_the_ID(), 'cover' ); ?>
	</a>
  </div><!-- col-5 -->

	<div class="col-7 column cartel">
	<div class="wrapper">

	  <h4 class="project-title">
		<a href="<?php echo esc_url( get_permalink() ); ?>">
		<?php echo esc_html( get_the_title() ); ?>
		</a>
	  </h4>

	  <p class="description">
		<?php echo wp_kses_post( $map_cartel, ',' ); ?>
		<?php echo esc_html( mysql2date( 'Y.', $post->post_date_gmt ) ); ?>
	  </p>

	  <a href="<?php echo esc_url( get_permalink() ); ?>" class="button">
		<?php echo esc_html( __( 'Read more', 'Minimal-Artistic-Portfolio' ) ); ?>
	  </a>

	</div><!-- .wrapper -->

  </div><!-- .col-7 -->

</div><!-- project-summary -->

	<?php 
} else {
	// $map_is_video boolean string '0' = image '1' = video
	$map_is_video         = get_post_meta( $post->ID, 'IS_VIDEO', true ); 
	$map_video_id         = get_post_meta( $post->ID, 'VIDEO_ID', true );
	$map_video_provider   = get_post_meta( $post->ID, 'VIDEO_PROVIDER', true );
	$map_first_res_url    = get_post_meta( $post->ID, '576P_VIDEO_URL', true );
	$map_second_res_url   = get_post_meta( $post->ID, '720P_VIDEO_URL', true );
	$map_third_res_url    = get_post_meta( $post->ID, '1080P_VIDEO_URL', true );
	$map_content_classes  = '';
	$map_content_classes .= '' !== get_the_content() ? 'filled ' : '';
	$map_content_classes .= false === map_get_event( get_the_ID() ) ? 'no-event ' : '';

	?>
  <header class="entry-header">
	  <h1 class="project-title"><?php echo esc_html( get_the_title() ); ?></h1>
  </header>


  <div class="entry-content">
	<?php
	if ( '1' === $map_is_video && (
	  ( isset( $map_video_id ) && in_array( $map_video_provider, array( 'vimeo', 'youtube' ), true ) )
	  ||
	  ( 'self' === $map_video_provider && isset( $map_third_res_url ) )
	)
	) {
		if ( in_array( $map_video_provider, array( 'vimeo', 'youtube' ), true ) ) {
			echo '<div class="player" 
                  data-plyr-provider="' . esc_attr( $map_video_provider ) . '" 
                  data-plyr-embed-id="' . esc_attr( $map_video_id ) . '">
                </div>';
		} elseif ( 'self' === $map_video_provider && isset( $map_third_res_url ) ) {
			echo '<video class="player selfhosted" controls crossorigin playsinline loop>';
			if ( $map_first_res_url ) {
				echo '<source src=\'' . esc_url( $map_first_res_url ) . '\' type=\'video/mp4\' size=\'576\'> '; 
			}
			if ( $map_second_res_url ) { 
				echo '<source src=\'' . esc_url( $map_second_res_url ) . '\' type=\'video/mp4\' size=\'720\'>';
			}
			if ( $map_third_res_url ) {
				echo '<source src=\'' . esc_url( $map_third_res_url ) . '\' type=\'video/mp4\' size=\'1080\'>';
	  
				echo '<p>' .
				esc_html( __( 'Your browser doesn\'t support HTML5 video, but you can read this video with the link below.', 'Minimal-Artistic-Portfolio' ) );      
				echo '<a href=\'' . esc_url( $map_third_res_url ) . '\'>' . __( 'Read the video', 'Minimal-Artistic-Portfolio' ) . '</a>';
				echo '</p>';
			}
			echo '</video>';
		}
	} else {
		echo get_the_post_thumbnail( get_the_ID(), 'full' );
	} 
	?>

	<div class="row project-text <?php echo esc_attr( $map_content_classes ); ?>">
	  <div class="col-4 column">
		<?php if ( $map_cartel ) : ?>
		  <p class='cartel'>
			<?php echo wp_kses_post( $map_cartel . ',' ); ?>
			<?php echo esc_html( mysql2date( 'Y', $post->post_date_gmt ) . '.' ); ?>
		  </p>
		<?php endif ?>
		<?php 
		if ( false !== map_get_event( $post->ID ) ) {
			echo wp_kses_post( map_get_event( $post->ID ) );
		} 
		?>
		<?php map_social_module( get_the_title(), get_the_permalink( $post->ID ), 'laptop' ); ?>
	  </div><!-- .col-4 -->

	  <div class="col-8 column">
		<?php the_content(); ?>
	  </div><!-- .col-8 -->

	  <?php map_social_module( get_the_title(), get_the_permalink( $post->ID ), 'mobile' ); ?>
	</div><!-- .row .project-text -->
  </div><!-- .entry-content -->
	<?php
}

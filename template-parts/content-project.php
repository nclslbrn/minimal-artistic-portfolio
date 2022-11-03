<?php 
/**
 * Template for displaying one event within single-event.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 */

$map_cartel = get_post_meta( $post->ID, 'CARTEL', true );
global $q_config;
$map_lang = isset( $q_config['language'] ) ? $q_config['language'] : false; 
if ( ! is_single() ) { ?>

<article id="project-<?php echo get_the_ID(); ?>" <?php post_class( 'project-summary' ); ?>>
	<a 
		href="<?php echo esc_url( get_permalink() ); ?>" 
		title="<?php echo esc_html( get_the_title() ); ?>" 
		class="project-featured-image project-<?php echo get_the_ID(); ?>-featured-image"
		<?php echo $map_lang ? 'hreflang="' . esc_attr( $map_lang ) . '"' : ''; ?>>
		<?php echo get_the_post_thumbnail( get_the_ID(), 'cover' ); ?>
	</a>
	<div class="project-cartel">
		<h2 class="project-title">
			<a href="<?php echo esc_url( get_permalink() ); ?>"	<?php echo $map_lang ? 'hreflang="' . esc_attr( $map_lang ) . '"' : ''; ?>>
				<?php echo esc_html( get_the_title() ); ?>
			</a>
		</h2>
		<p class="project-description">
			<?php echo wp_kses_post( $map_cartel ) . ','; ?>
			<?php echo esc_html( mysql2date( 'Y.', $post->post_date_gmt ) ); ?>
		</p>
	</div><!-- .cartel -->
</article><!-- project-summary -->
	<?php 
} else {
	// $map_is_video boolean string '0' = image '1' = video
	$map_is_video         = get_post_meta( $post->ID, 'IS_VIDEO', true ); 
	$map_video_id         = get_post_meta( $post->ID, 'VIDEO_ID', true );
	$map_video_provider   = get_post_meta( $post->ID, 'VIDEO_PROVIDER', true );
	$map_first_res_url    = get_post_meta( $post->ID, '576P_VIDEO_URL', true );
	$map_second_res_url   = get_post_meta( $post->ID, '720P_VIDEO_URL', true );
	$map_third_res_url    = get_post_meta( $post->ID, '1080P_VIDEO_URL', true );
	$map_related_events   = map_get_event( $post->ID );
	$map_content_classes  = '';
	$map_content_classes .= '' !== $post->post_content ? ' filled' : '';
	$map_content_classes .= false === $map_related_events ? ' no-event' : '';
	?>
	<article id="project-<?php echo get_the_ID(); ?>" <?php post_class(); ?>>

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
				if ( 'vimeo' === $map_video_provider ) {
					echo '
					<div class="player plyr__video-embed">
						<iframe
							src="https://player.vimeo.com/video/' . $map_video_id . '?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media"
							allowfullscreen
							allowtransparency
							allow="autoplay"
						></iframe>
					</div>
					';
				} elseif ( 'youtube' === $map_video_provider ) {
					echo '
					<div class="player plyr__video-embed">
						<iframe
							src="https://www.youtube.com/embed/' . $map_video_id . '?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
							allowfullscreen
							allowtransparency
							allow="autoplay"
						></iframe>
					</div>
					';
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
						echo '<a href=\'' . esc_url( $map_third_res_url ) . '\'>' . esc_html__( 'Read the video', 'Minimal-Artistic-Portfolio' ) . '</a>';
						echo '</p>';
					}
					echo '</video>';
				}
			} else {
				echo get_the_post_thumbnail( get_the_ID(), 'full' );
			}
			
			?>
			<div class="project-texts<?php echo esc_attr( $map_content_classes ); ?>">
				<div class="project-cartel">
					<?php if ( $map_cartel ) : ?>
						<p>
							<?php echo wp_kses_post( $map_cartel ) . ','; ?>
							<?php echo esc_html( mysql2date( 'Y', $post->post_date_gmt ) . '.' ); ?>
						</p>
					<?php endif ?>
					<?php 
					if ( $map_related_events ) {
						echo wp_kses_post( $map_related_events );
					} 
					?>
				</div><!-- .project-cartel -->

				<div class="project-description">
					<?php the_content(); ?>
				</div><!-- .project-description -->

			</div><!-- .project-text -->
		</div><!-- .entry-content -->
	</article>
	<?php
}

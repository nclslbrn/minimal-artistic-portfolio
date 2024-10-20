<?php
/**
 * Template for displaying one event within single-event.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 * @var Post $post the global WordPress post object
 */

$map_cartel = get_post_meta( $post->ID, 'cartel', true );
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
	$map_is_video         = get_post_meta( $post->ID, 'is_video', true );
	$map_video_id         = get_post_meta( $post->ID, 'video_id', true );
	$map_video_provider   = get_post_meta( $post->ID, 'video_provider', true );
	$map_first_res_url    = get_post_meta( $post->ID, '576p_video_url', true );
	$map_second_res_url   = get_post_meta( $post->ID, '720p_video_url', true );
	$map_third_res_url    = get_post_meta( $post->ID, '1080p_video_url', true );
	$map_related_events   = map_get_event( $post->ID );
	$map_content_classes  = '';
	$map_content_classes .= '' !== $post->post_content ? ' filled' : '';
	$map_content_classes .= false === $map_related_events ? ' no-event' : '';
	$map_ext_gallery 	  = get_post_meta( $post->ID, 'ext_gallery', true );
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
						<media-player
							title="'.$post->post_title.'"
							src="vimeo/'.$map_video_id.'">
							<media-provider>
								<media-poster
									class="vds-poster"
									src="'.get_the_post_thumbnail_url($post->ID).'"
									alt="'.$post->post_title.'">
								</media-poster>
							</media-provider>
							<media-video-layout></media-video-layout>
					</media-player>
					';
				} elseif ( 'youtube' === $map_video_provider ) {
					// class="player plyr__video-embed"
					echo '
						<media-player
							title="'.$post->post_title.'"
							src="youtube/'.$map_video_id.'">
							<media-provider>
								<media-poster
									class="vds-poster"
									src="'.get_the_post_thumbnail_url($post->ID).'"
									alt="'.$post->post_title.'">
								</media-poster>
							</media-provider>
							<media-video-layout></media-video-layout>
						</media-player>
					';
				} elseif ( 'self' === $map_video_provider && isset( $map_third_res_url ) ) {
					echo '<media-player loop="true">
									<media-provider>'.
										( $map_first_res_url
										? '<source src=\'' . esc_url( $map_first_res_url ) . '\' type=\'video/mp4\' size=\'576\'>' : '').
										( $map_second_res_url
										? '<source src=\'' . esc_url( $map_second_res_url ) . '\' type=\'video/mp4\' size=\'720\'>' : '').
										( $map_third_res_url
										? '<source src=\'' . esc_url( $map_third_res_url ) . '\' type=\'video/mp4\' size=\'1080\'>' : '').
										'<media-poster
											class="vds-poster"
											src="'.get_the_post_thumbnail_url($post->ID).'"
											alt="'.$post->post_title.'">
										</media-poster>
									</media-provider>
									<media-video-layout></media-video-layout>
								</media-player>';
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

			<?php if ( $map_ext_gallery && !empty($map_ext_gallery)) : ?>
				<div class="ext-gallery">
					<div class="scroll-wrapper">
						<?php echo wp_kses_post($map_ext_gallery); ?>
					</div>
				</div>
			<?php endif; ?>
		</div><!-- .entry-content -->
	</article>
	<?php
}

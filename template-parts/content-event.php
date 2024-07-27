<?php
/**
 * Template for displaying one event within single-event.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 * @var Post $post the global WordPress post object
 */

if ( is_single() ) :
	$map_event = array(
		'latt'             => get_post_meta( $post->ID, 'LATT', true ),
		'long'             => get_post_meta( $post->ID, 'LONG', true ),
		'place_name'       => get_post_meta( $post->ID, 'PLACE', true ),
		'begin_date'       => strtotime( get_post_meta( $post->ID, 'BEGINDATE', true ) ),
		'end_date'         => strtotime( get_post_meta( $post->ID, 'ENDDATE', true ) ),
		'related_projects' => map_get_project( $post->ID ),
		'content_classes'  => ' ',
	);

	$map_event['content_classes'] .= '' !== $post->post_content ? ' filled' : '';
	$map_event['content_classes'] .= false === $map_event['related_projects'] ? ' no-project' : '';
	?>
<article id="event-<?php echo get_the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="event-title"><?php echo esc_html( $post->post_title ); ?></h1>
	</header>
	<div class="entry-content">
		<div class="event-hero">
			<div class="event-featured-image">
				<?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>
			</div>

			<?php if ( $map_event['latt'] && $map_event['long'] ) : ?>
				<div id='map'
					class='map single-marker'
					data-latitude="<?php echo esc_attr( $map_event['latt'] ); ?>"
					data-longitude="<?php echo esc_attr( $map_event['long'] ); ?>">
				</div>
			<?php endif; ?>
		</div><!-- .event-hero -->

		<div class="event-texts<?php esc_attr( $map_event['content_classes'] ); ?>">
			<div class="event-properties">
				<?php if ( $map_event['place_name'] ) : ?>
					<p class="place">
						<svg class="icon icon-location">
							<use xlink:href="#icon-location"></use>
						</svg>
						<span><?php echo wp_kses_post( $map_event['place_name'] ); ?></span>
					</p>
				<?php endif; ?>
				<?php if ( $map_event['begin_date'] ) : ?>
					<p class="date">
						<svg class="icon icon-calendar">
						<use xlink:href="#icon-calendar"></use>
						</svg>
							<span>
								<?php
								echo esc_html(
									map_friendly_date(
										$map_event['begin_date'],
										$map_event['end_date']
									)
								);
								?>
							</span>
					</p>
				<?php endif; ?>
				<?php if ( $map_event['related_projects'] ) : ?>
					<?php echo wp_kses_post( $map_event['related_projects'] ); ?>
				<?php endif; ?>
			</div><!-- .event-properties -->
			<div class="event-description">
				<?php the_content(); ?>
			</div><!-- event-description -->
		</div><!-- .event-texts -->
	</div><!-- .entry-content -->
</article>

	<?php
else :
	global $q_config;
	$map_lang  = isset( $q_config['language'] ) ? $q_config['language'] : false;
	$map_event = array(
		'link'       => get_permalink( $post->ID ),
		'thumbnail'  => get_the_post_thumbnail( $post->ID, 'carton' ),
		'place'      => get_post_meta( $post->ID, 'PLACE', true ),
		'begin_date' => strtotime( get_post_meta( $post->ID, 'BEGINDATE', 'true' ) ),
		'end_date'   => strtotime( get_post_meta( $post->ID, 'ENDDATE', 'true' ) ),
	);

	?>
	<article id="post<?php echo esc_attr( $post->ID ); ?>" <?php post_class( 'event-summary' ); ?>>

		<?php if ( ! empty( $map_event['thumbnail'] ) ) : ?>
			<a class="event-featured-image" href="<?php echo esc_url( $map_event['link'] ); ?>">
				<?php echo wp_kses_post( $map_event['thumbnail'] ); ?>
			</a>
		<?php endif; ?>

		<div class="event-info">

			<h3 class="event-title">
				<a
					href="<?php echo esc_url( $map_event['link'] ); ?>"
					<?php echo $map_lang ? 'hreflang="' . esc_attr( $map_lang ) . '"' : ''; ?>>
					<?php echo esc_attr( $post->post_title ); ?>
				</a>
			</h3>
			<?php if ( $map_event['place'] ) : ?>
				<p class="place">
					<svg class="icon icon-location">
						<use xlink:href="#icon-location"></use>
					</svg>
					<span><?php echo esc_html( $map_event['place'] ); ?></span>
				</p>
			<?php endif; ?>

			<?php if ( $map_event['begin_date'] ) : ?>
				<p class="date">
					<svg class="icon icon-calendar">
						<use xlink:href="#icon-calendar"></use>
					</svg>
					<span>
						<?php
						echo esc_html(
							map_friendly_date(
								$map_event['begin_date'],
								$map_event['end_date']
							)
						);
						?>
					</span>
				</p>
			<?php endif; ?>


		</div><!-- .event-info -->
	</article>
	<?php
endif;

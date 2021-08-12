<?php
/**
 * Template for displaying one event within single-event.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 */

if ( is_single() ) :
	$map_event = array(
		'latt'             => get_post_meta( $post->ID, 'LATT', true ),
		'long'             => get_post_meta( $post->ID, 'LONG', true ),
		'place_name'       => get_post_meta( $post->ID, 'PLACE', true ),
		'begin_date'       => get_post_meta( $post->ID, 'BEGINDATE', true ),
		'end_date'         => get_post_meta( $post->ID, 'ENDDATE', true ),
		'related_projects' => map_get_project( $post->ID ),
		'content_classes'  => ' ',
	);

	$map_event['content_classes'] .= '' !== $post->post_content ? ' filled' : '';
	$map_event['content_classes'] .= false === $map_event['related_projects'] ? ' no-project' : '';
	?>
<div id="event-<?php echo get_the_ID(); ?>" class="event">
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
				<?php if ( $map_event['begin_date'] && $map_event['end_date'] ) : ?>
					<p class="date">
						<svg class="icon icon-calendar">
						<use xlink:href="#icon-calendar"></use>
						</svg>
							<span>
								<?php echo esc_html__( 'From', 'Minimal-Artistic-Portfolio' ); ?>
								<?php echo esc_html( ' ' . date_i18n( 'j F Y', strtotime( $map_event['begin_date'] ) ) ); ?>
								<?php echo esc_html__( 'to', 'Minimal-Artistic-Portfolio' ); ?>
								<?php echo esc_html( ' ' . date_i18n( 'j F Y', strtotime( $map_event['end_date'] ) ) ); ?>
							</span>
					</p></br />
				<?php endif; ?>
				<?php if ( $map_event['related_projects'] ) : ?>
					<?php echo wp_kses_post( $map_event['related_projects'] ); ?>
				<?php endif; ?>		
				<?php 
				map_social_module(
					get_the_title(),
					get_the_permalink( $post->ID ),
					'laptop-only'
				); 
				?>
			</div><!-- .event-properties -->
			<div class="event-description">
				<?php the_content(); ?>
			</div><!-- event-description -->
		</div><!-- .event-texts -->
	</div><!-- .entry-content -->
</div>

	<?php 
else : 
	
	$map_event = array(
		'link'      => get_permalink( $post->ID ),
		'thumbnail' => get_the_post_thumbnail( $post->ID, 'carton' ),
		'place'     => get_post_meta( $post->ID, 'PLACE', true ),
		'beginDate' => date_i18n( 'j F  Y', strtotime( get_post_meta( $post->ID, 'BEGINDATE', 'true' ) ) ),
		'endDate'   => date_i18n( 'j F Y', strtotime( get_post_meta( $post->ID, 'ENDDATE', 'true' ) ) ),
	);

	?>
	<article id="post<?php echo esc_attr( $post->ID ); ?>" class="event-summary">

		<?php if ( ! empty( $map_event['thumbnail'] ) ) : ?>
			<a class="event-featured-image" href="<?php echo esc_url( $map_event['link'] ); ?>">
				<?php echo wp_kses_post( $map_event['thumbnail'] ); ?>
			</a>
		<?php endif; ?>

		<div class="event-info">

			<h3 class="event-title">
				<a href="<?php echo esc_url( $map_event['link'] ); ?>">	
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

			<?php if ( $map_event['beginDate'] && $map_event['endDate'] ) : ?>
				<p class="date">
					<svg class="icon icon-calendar">
						<use xlink:href="#icon-calendar"></use>
					</svg>
					<span>
						<?php 
						// TODO: show month & year on first date only if they are different from endDate.
						echo esc_html( 
							sprintf(
							/* translators: %2$s: Date delimiter */
								__( 'From %1$s to %2$s', 'Minimal-Artistic-Portfolio' ),
								$map_event['beginDate'],
								$map_event['endDate'] 
							)
						); 
						?>
					</span>
				</p>
			<?php endif; ?>

			<!-- <a class="button" href="<?php echo esc_url( $map_event['link'] ); ?>">
				<?php echo esc_html( __( 'Read more', 'Minimal-Artistic-Portfolio' ) ); ?>
			</a> -->

		</div><!-- .event-info -->
	</article>
	<?php 
endif;

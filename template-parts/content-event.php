<?php
/**
 * Template for displaying one event within single-event.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 */

$map_latt             = get_post_meta( $post->ID, 'LATT', true );
$map_long             = get_post_meta( $post->ID, 'LONG', true );
$map_place_name       = get_post_meta( $post->ID, 'PLACE', true );
$map_begin_date       = get_post_meta( $post->ID, 'BEGINDATE', true );
$map_end_date         = get_post_meta( $post->ID, 'ENDDATE', true );
$map_related_projects = map_get_project( $post->ID );
$map_content_classes  = ' ';
$map_content_classes .= $post->post_content !== '' ? ' filled' : '';
$map_content_classes .= false === $map_related_projects ? ' no-project' : '';
?>
<div id="event-<?php echo get_the_ID(); ?>" class="event">
	<header class="entry-header">
		<h1 class="event-title"><?php echo esc_html( get_the_title() ); ?></h1>
	</header>
	
	<div class="entry-content">
		<div class="event-hero">
			<div class="event-featured-image">
				<?php echo get_the_post_thumbnail( get_the_ID(), 'full' ); ?>
			</div>

			<?php if ( $map_latt && $map_long ) : ?>
				<div id='map' 
					class='map single-marker' 
					data-latitude="<?php echo esc_attr( $map_latt ); ?>"
					data-longitude="<?php echo esc_attr( $map_long ); ?>">
				</div>
			<?php endif; ?>
		</div><!-- .event-hero -->

		<div class="event-texts<?php esc_attr( $map_content_classes ); ?>">
			<div class="event-properties">
				<?php if ( $map_place_name ) : ?>
					<p class="place">
						<svg class="icon icon-location">
							<use xlink:href="#icon-location"></use>
						</svg>
						<?php echo wp_kses_post( $map_place_name ); ?>
					</p>
				<?php endif; ?>
				<?php if ( $map_begin_date && $map_end_date ) : ?>
					<p class="date">
						<svg class="icon icon-calendar">
						<use xlink:href="#icon-calendar"></use>
						</svg>
						<?php echo esc_html__( 'From', 'Minimal-Artistic-Portfolio' ); ?>
						<?php echo esc_html( ' ' . date_i18n( 'j F Y', strtotime( $map_begin_date ) ) ); ?>
						<?php echo esc_html__( 'to', 'Minimal-Artistic-Portfolio' ); ?>
						<?php echo esc_html( ' ' . date_i18n( 'j F Y', strtotime( $map_end_date ) ) ); ?>
					</p></br />
				<?php endif; ?>
				<?php if ( $map_related_projects ) : ?>
					<?php echo wp_kses_post( $map_related_projects ); ?>
				<?php endif; ?>
			
				<?php map_social_module(
					get_the_title(),
					get_the_permalink( $post->ID ),
					'laptop-only'); ?>
			</div><!-- .event-properties -->
			<div class="event-description">
				<?php the_content(); ?>
			</div><!-- event-description -->
		</div><!-- .event-texts -->
	</div><!-- .entry-content -->
</div>


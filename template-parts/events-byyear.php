<?php 
/**
 * Template for displaying a year of events in events
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 */

?>

<div id="post<?php echo esc_attr( $args['id'] ); ?>" class="<?php echo esc_attr( $args['post_type'] ); ?>-year-section--list row clearfix">

	<?php if ( ! empty( $args['thumbnail'] ) ) : ?>
		<div class="thumbnail col-5 column">
			<?php echo wp_kses_post( $args['thumbnail'] ); ?>
		</div>
	<?php endif; ?>

	<div class="<?php echo esc_attr( $args['post_type'] ); ?>-info <?php echo( ! empty( $args['thumbnail'] ) ? 'col-7' : 'col-12' ); ?> column">

		<div class="wrapper">

			<h4 class="event-title"><?php echo esc_attr( $args['title'] ); ?></h4>

			<p class="place">
				<svg class="icon icon-location">
					<use xlink:href="#icon-location"></use>
				</svg>
				<?php echo esc_html( $args['place'] ); ?>
			</p>

			<?php if ( $args['beginDate'] && $args['endDate'] ) : ?>
				<p class="date">
					<svg class="icon icon-calendar">
						<use xlink:href="#icon-calendar"></use>
					</svg>
					<?php 
						echo esc_html( 
							sprintf(
							/* translators: %2$s: Date delimiter */
								__( 'From %1$s to %2$s', 'Minimal-Artistic-Portfolio' ),
								$args['beginDate'],
								$args['endDate'] 
							)
						); 
					?>
				</p>
			<?php endif; ?>

			<a class="button" href="<?php echo esc_url( $args['link'] ); ?>">
				<?php echo esc_html( __( 'Read more', 'Minimal-Artistic-Portfolio' ) ); ?>
			</a>
		</div><!-- .wrapper -->

	</div><!-- .<?php echo esc_attr( $args['post_type'] ); ?>-info -->
</div><!-- .<?php echo esc_attr( $args['post_type'] ); ?>-year-section--list -->


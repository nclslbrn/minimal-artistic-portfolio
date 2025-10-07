<?php
/** 
 * Template Name: Events
 *
 * The template for events on the event list age.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 */

get_header(); 
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				global $post;
				the_post();


				$map_school_section = get_post_meta( $post->ID, 'school', true );
				$map_experience_section = get_post_meta( $post->ID, 'experience', true );
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						
					</header><!-- .entry-header -->
					<div class="entry-content">
						<div id="change-event-display-mode" class="event-menu">
							<button data-toggle="map" class="button">
								<svg class="icon icon-location">
									<use xlink:href="#icon-location"></use>
								</svg>
								<?php esc_html_e( 'Map', 'Minimal-Artistic-Portfolio' ); ?>
							</button>
							<button data-toggle="events-list" class="button active">
								<svg class="icon icon-calendar">
									<use xlink:href="#icon-calendar"></use>
								</svg>
								<?php esc_html_e( 'List', 'Minimal-Artistic-Portfolio' ); ?>
							</button>
						</div>
						<div id="events-list">	

							<?php map_list_posts_by_years( 'event', -1 ); ?>

							<?php if( $map_school_section ) : ?>
								<section>
									<h2><?php _e('Degrees', 'Minimal-Artistic-Portfolio'); ?></h2>
									<ul>
										<?php echo wp_kses_post( $map_school_section ); ?>
									</ul>
								</section>
							<?php endif; ?>
							<?php if( $map_experience_section ) : ?>
								<section>
									<h2><?php _e('Others', 'Minimal-Artistic-Portfolio'); ?></h2>
									<ul>
										<?php echo wp_kses_post( $map_experience_section); ?>
									</ul>
								</section>
							<?php endif; ?>
						</div><!-- #event-list -->
						<!-- <div class="map-overlay" style="height: 0; overflow: hidden;"> -->
						<div id="map" class="map multiple-marker"></div>
						<!-- </div> .map-overlay -->

						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</article>
			<?php endwhile; // End of the loop.	?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

<?php
/**
 * Template Name: Gif-page
 * The template for gif page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 */
$posts_per_page = get_option( 'posts_per_page' );

$map_gif_query_args = array(
	'post_type'      => 'gif',
	'posts_per_page' => $posts_per_page,
	'post_status'    => 'publish',
	'paged'          => get_query_var( 'paged' ),
);
$map_post_content   = '';
get_header(); ?>


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php 
		while ( have_posts() ) :
			the_post(); 
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
			</article>
			<?php $map_post_content = $post->post_content; ?>
		<?php endwhile; // End of the loop. ?>

		<?php $map_gif_query = new WP_Query( $map_gif_query_args ); ?>
		<?php if ( $map_gif_query->have_posts() ) : ?>
			<div class="gif-grid">
				<?php 
				while ( $map_gif_query->have_posts() ) :
					$map_gif_query->the_post(); 
					?>

					<?php if ( get_the_post_thumbnail_url( $post, 'full' ) ) : ?>
						<article id="post-<?php echo esc_attr( $post->ID ); ?>" class="animated-gif">
							<a  class="fluidbox" 
								href="<?php echo esc_url( get_the_post_thumbnail_url( $post, 'full' ) ); ?>" 
								data-fluidbox-loader>
								<img 
									src="<?php echo esc_url( get_the_post_thumbnail_url( $post, 'medium' ) ); ?>"
									title="<?php echo esc_html( $post->post_title ); ?>" 
									class="gif-thumbnail">
							</a>
							<div class="gif-source hidden">
								<!-- preload our gif -->
								<img src="<?php echo esc_url( get_the_post_thumbnail_url( $post, 'full' ) ); ?>">
							</div>
						</article>
					<?php endif; ?>

				<?php endwhile; ?>
			</div><!-- .gif-grid -->

			<?php if ( $map_gif_query->max_num_pages > 0 ) : ?>
				<nav class="page-nav">
					<?php
			
						echo wp_kses_post(
							paginate_links(
								array( 
									'prev_next' => false,
									'current'   => max( 1, get_query_var( 'paged' ) ),
									'total'     => $map_gif_query->max_num_pages,
								)
							)
						);
					
					?>
				</nav>
			<?php endif; ?>
			<div class="row">
				<div class="column"></div>
				<div class="column">
					<p><?php echo wp_kses_post( $map_post_content ); ?></p>
				</div>
			</div>
		<?php endif; ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

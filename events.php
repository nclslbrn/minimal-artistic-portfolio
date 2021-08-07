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
				the_post();
				?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				<div class="entry-content">


				<?php	get_template_part( 'template-parts/content', 'events' ); ?>
				<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Minimal-Artistic-Portfolio' ),
							'after'  => '</div>',
						) 
					);
				?>
				</div><!-- .entry-content -->
			</article>
			<?php endwhile; // End of the loop.	?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

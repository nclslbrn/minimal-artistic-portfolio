<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php 
		if ( have_posts() ) :

			if ( (is_category() || is_tax() || is_home()) && ! is_front_page() ) : 
				?>
				<header class="entry-header">
					<h1 class="entry-title">
						<?php _e( 'Archive', 'Minimal-Artistic-Portfolio' ); ?>
					</h1>
				</header><!-- .page-header -->
				<?php 
			endif;

			?>
			<div class="entry-content">
			<?php 
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				global $post;
		
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				if ( in_array( $post->post_type, array( 'project', 'event' ) ) ) {
					get_template_part( 'template-parts/content', $post->post_type );

				} else {
					get_template_part( 'template-parts/content', get_post_format() );
				}

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; 
		?>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

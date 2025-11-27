<?php
/**
 * Template Name: Collection
 * The template for collection.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 * @var Post $post the global WordPress post object
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<div class="tokens"></div>

						<button id="load-more-tokens">
							Load More
						</button>
					</div>
				</article>
			<?php endwhile; ?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php
get_sidebar();
get_footer();

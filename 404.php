<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Minimal-Artistic-Portfolio
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<!--<h1 class="page-title"><?php echo esc_html__( 'Oops! That page can&rsquo;t be found.', 'Minimal-Artistic-Portfolio' ); ?></h1>-->
				</header><!-- .page-header -->

				<div class="page-content">

					<h1 class="legend"><small><?php echo esc_html__( 'error', 'Minimal-Artistic-Portfolio' ); ?></small> 404</h1>
					<h5 class="center">
						<?php echo esc_html__( 'Sorry, we couldn\'t find the page you were looking for!', 'Minimal-Artistic-Portfolio' ); ?>
					</h5>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

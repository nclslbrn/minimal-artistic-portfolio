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

			<article class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title">
						<?php echo esc_html__( 'Oops! That page can&rsquo;t be found.', 'Minimal-Artistic-Portfolio' ); ?></h1>
				</header><!-- .page-header -->
				
				<div class="page-content">
					<iframe src="https://gateway.fxhash2.xyz/ipfs/QmehDxu1eCsCtSx369FLRCj7AawGtRyE6GKLKHHBC2UG8L/?fxhash=ooWavzytbacXbDYms1tdbeXL3TFDCNeRZan8TmSosb2Qo1y8ZVE" width="800" height="800">

					</iframe>
					<p><small>Degenerative grid | <a href="https://www.fxhash.xyz/generative/11977">fxhash project</a></small></p>
					<p>
						<span><?php echo esc_html__( 'error', 'Minimal-Artistic-Portfolio' ); ?> 404</span>
						<small>
							<?php echo esc_html__( 'Sorry, we couldn\'t find the page you were looking for!', 'Minimal-Artistic-Portfolio' ); ?>
						</small>
					</p>
				</div><!-- .page-content -->
			</article><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

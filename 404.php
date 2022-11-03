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
				<header class="entry-header">
					<h1 class="entry-title">
						<?php echo esc_html__( 'error', 'Minimal-Artistic-Portfolio' ); ?> 404
					</h1>
				</header><!-- .page-header -->
					
				<div class="entry-content">
					<iframe src="https://gateway.fxhash2.xyz/ipfs/QmehDxu1eCsCtSx369FLRCj7AawGtRyE6GKLKHHBC2UG8L/?fxhash=ooWavzytbacXbDYms1tdbeXL3TFDCNeRZan8TmSosb2Qo1y8ZVE" width="800" height="800">			
					</iframe>
					<p><small>Degenerative grid | <a href="https://www.fxhash.xyz/generative/11977">fxhash project</a></small></p>
					<p>
						<?php echo esc_html__( 'Oops! That page can&rsquo;t be found.', 'Minimal-Artistic-Portfolio' ); ?>
					</p>
					<p>
						<?php echo esc_html__( 'Sorry, we couldn\'t find the page you were looking for!', 'Minimal-Artistic-Portfolio' ); ?>
					</p>
				</div><!-- .page-content -->
			</article><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

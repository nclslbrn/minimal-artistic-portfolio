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
					<!--<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'Minimal-Artistic-Portfolio' ); ?></h1>-->
				</header><!-- .page-header -->

				<div class="page-content">

						<h1 class="legend"><small><?php _e( 'error', 'Minimal-Artistic-Portfolio' ); ?></small> 404</h1>
					<h5 class="center">
						<?php _e( 'Sorry, we couldn\'t find the page you were looking for!', 'Minimal-Artistic-Portfolio' ); ?>
					</h5>

					<?php	//get_search_form(); ?>

						<?php /*
						the_widget( 'WP_Widget_Recent_Posts' );

						// Only show the widget if site has multiple categories.

						if ( minimal_artistic_portfolio_categorized_blog() ) :
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'Minimal-Artistic-Portfolio' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->

					<?php
						endif;

						$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'Minimal-Artistic-Portfolio' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

						the_widget( 'WP_Widget_Tag_Cloud' );
						*/
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

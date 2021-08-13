<?php
/**
 * Template Name: Homepage
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Minimal-Artistic-Portfolio
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<!-- Show future event, if event(s) is after today() -->
			<?php map_contextully_load_last_event(); ?>
			<?php wp_reset_postdata(); ?>

			<header class="entry-header">
				<h1 class="entry-title"><?php echo esc_html( $post->post_title ); ?></h1>
			</header>

			<div class="entry-content">
				<!-- List projects -->
				<?php map_list_custom_posts( 'project', 12 ); ?>		
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
?>

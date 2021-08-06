<?php
/*
Template Name: Homepage
*/

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


			<?php $pageTitle = get_the_title( get_the_ID() ); ?>

			<!-- Show future event, if event(s) is after today() -->
			<?php $actual_events = query_event_by_date(); ?>
			<?php wp_reset_postdata(); ?>

			<header class="entry-header">
				<h1 class="entry-title"><?php echo $pageTitle; ?></h1>
			</header>

			<div class="entry-content">
				<!-- List projects -->
				<?php list_custom_posts( 'project', -1 ); ?>
				<div class="clearfix"></div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
?>

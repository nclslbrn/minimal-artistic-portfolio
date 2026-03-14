<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Minimal-Artistic-Portfolio
 */

get_header();

// Pick a random project
$map_random_post = get_posts([
	"posts_per_page" => 1,
	"orderby" => "rand",
	"post_status" => "publish",
	"post_type" => "project",
]);
$map_random_cover = false;

if ($map_random_post) {
	$map_random_cover = get_the_post_thumbnail_url($map_random_post[0]->ID);
}
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<article class="error-404 not-found" style="<?php echo $article_style; ?>">
				<header class="entry-header">
					<h1 class="entry-title">
						<?php echo esc_html__("error", "Minimal-Artistic-Portfolio"); ?> 404
					</h1>
				</header><!-- .page-header -->

				<div class="entry-content">
					<?php if ($map_random_post && $map_random_cover): ?>
						<img
							src="<?php echo $map_random_cover; ?>"
							alt="<?php echo $map_random_post->title[0]; ?>"
						/>
					<?php endif; ?>
					<p>
						<?php echo esc_html__(
      	"Oops! That page can&rsquo;t be found.",
      	"Minimal-Artistic-Portfolio",
      ); ?>
					</p>
					<p>
						<?php echo esc_html__(
      	'Sorry, we couldn\'t find the page you were looking for!',
      	"Minimal-Artistic-Portfolio",
      ); ?>
					</p>
				</div><!-- .page-content -->
			</article><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();


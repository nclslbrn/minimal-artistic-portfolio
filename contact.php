<?php
/**
 * Template Name: Contact
 * The template for contact.
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

					<div class="entry-content"
					style="background:
						url(<?php echo get_the_post_thumbnail_url($post->ID); ?>),
						linear-gradient(var(--component-bg-color), var(--bg-color));
					background-blend-mode: multiply;">
						<div class="contact-links">
							<div class="link-block">
								<h2>Works</h2>
								<ul class="works">
									<li>
										<a href="https://www.fxhash.xyz/u/nclslbrn">
											<img src="https://www.fxhash.xyz/favicon-32x32.png">
											<span>Fxhash</span>
										</a>
									</li>
									<li>
										<a href="https://objkt.com/profile/tz2CbvXLY37WzHw2oDw5Du5esKwLzMZqiAJ1/collections">
											<img src="https://objkt.com/favicon.ico" width="32" height="32">
											<span>Objkt</span>
										</a>
									</li>
									<li>
										<a href="https://www.theartlinker.com/artist/nicolas-lebrun">
											<img src="https://www.theartlinker.com/assets/favicon.ico" width="32" height="32">
											<span>the Art linker</span>
										</a>
									</li>
									<li>
										<a href="https://forsaken-ideas.nicolas-lebrun.fr/">
											<img src="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📖</text></svg>" width="32" heigth="32">
											<span>Forsaken Ideas</span>
										</a>
									</li>
									<li>
										<a href="https://opensea.io/collection/kallax">
											<img src="https://opensea.io/static/images/logos/opensea-logo.svg" width="32" height="32"/>
											<span>Kallax</span>
										</a>
									</li>
									<!-- <li>
										<a href="https://maison-contemporain.com/fr/artiste/lebrun-nicolas/">
											<img src="https://maison-contemporain.com/wp-content/uploads/2022/03/cropped-icon-mc-1-32x32.png">
											<span>Maison contemporain</span>
										</a>
									</li> -->
								</ul>
							</div><!-- .link-block -->
							<div class="link-block">
								<h2>Networks</h2>
								<ul class="networks">
									<!-- Icons from https://icons.getbootstrap.com/ -->
									<li>
										<a href="https://twitter.com/nclslbrn">
											<img src="https://abs.twimg.com/favicons/twitter.3.ico" width="16" height="16"/>
											<span>X</span>
										</a>
									</li>
									<li>
										<a href="https://warpcast.com/nclslbrn">
											<img src="https://warpcast.com/logo192.png" width="16" height="16"/>
											<span>Warpcast</span>
										</a>
									</li>

									<li>
										<a rel="me" href="https://mstdn.io/@nclslbrn">
											<img src="https://mstdn.io/packs/media/icons/apple-touch-icon-57x57-c9dca808280860c51d0357f6a3350f4d.png" width="16" height="16"/>
											<span>Mastodon</span>
										</a>
									</li>

									<li>
										<a href="https://bsky.app/profile/nclslbrn.bsky.social">
											<img src="https://bsky.app/static/favicon-32x32.png" width="16" height="16"/>
											<span>Bluesky</span>
										</a>
									</li>

									<li>
										<a href="https://github.com/nclslbrn/">
											<img src="https://github.githubassets.com/favicons/favicon-dark.png" width="16" height="16"/>
											<span>Github</span>
										</a>
									</li>
									<li>
										<a href="https://discord.com/users/Nicolas%20Lebrun#9221">
											<img src="data:image/png;base64,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" width="16" height="16"/>
											<span>Discord</span>
										</a>
									</li>
									<li>
										<a href="https://www.tiktok.com/@nclslbrn">
											<img src="https://www.tiktok.com/favicon.ico" width="16" height="16"/>
											<span>Tiktok</span>
										</a>
									</li>
									<li>
										<a href="https://www.threads.net/@nclslbrn">
											<img width="16" height="16" src="data:image/png;base64,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">
											<span>Threads</span>
										</a>
									</li>
									<li>
										<a href="https://www.instagram.com/nclslbrn/">
											<img src="https://static.cdninstagram.com/rsrc.php/v3/yR/r/lam-fZmwmvn.png" width="16" height="16"/>
											<span>Instagram</span>
										</a>
									</li>
								</ul>
							</div><!-- .link-block -->
						</div>
						<?php map_get_form_markup( get_permalink() ); ?>
					</div>
				</article>
			<?php endwhile; // End of the loop. ?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php
get_sidebar();
get_footer();

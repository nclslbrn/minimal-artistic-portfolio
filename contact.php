<?php
/**
 * Template Name: Contact
 * The template for contact.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
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
										<a href="https://deca.art/nclslbrn">
											<img src="https://deca.art/icons/favicon-32x32.png" width="32" heigth="32"/>
											<span>deca</span>
										</a>
									</li>
									<li>
										<a href="https://nclslbrn.github.io/">
											<img src="https://nclslbrn.github.io/img/favicon.png" width="32" heigth="32"/>
											<span>nclslbrn.github.io</span>
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
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
												<path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
											</svg>
											<span>Twitter</span>
										</a>
									</li>
									<li>
										<a rel="me" href="https://mstdn.io/@nclslbrn">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mastodon" viewBox="0 0 16 16">
												<path d="M11.19 12.195c2.016-.24 3.77-1.475 3.99-2.603.348-1.778.32-4.339.32-4.339 0-3.47-2.286-4.488-2.286-4.488C12.062.238 10.083.017 8.027 0h-.05C5.92.017 3.942.238 2.79.765c0 0-2.285 1.017-2.285 4.488l-.002.662c-.004.64-.007 1.35.011 2.091.083 3.394.626 6.74 3.78 7.57 1.454.383 2.703.463 3.709.408 1.823-.1 2.847-.647 2.847-.647l-.06-1.317s-1.303.41-2.767.36c-1.45-.05-2.98-.156-3.215-1.928a3.614 3.614 0 0 1-.033-.496s1.424.346 3.228.428c1.103.05 2.137-.064 3.188-.189zm1.613-2.47H11.13v-4.08c0-.859-.364-1.295-1.091-1.295-.804 0-1.207.517-1.207 1.541v2.233H7.168V5.89c0-1.024-.403-1.541-1.207-1.541-.727 0-1.091.436-1.091 1.296v4.079H3.197V5.522c0-.859.22-1.541.66-2.046.456-.505 1.052-.764 1.793-.764.856 0 1.504.328 1.933.983L8 4.39l.417-.695c.429-.655 1.077-.983 1.934-.983.74 0 1.336.259 1.791.764.442.505.661 1.187.661 2.046v4.203z"></path>
											</svg>
											<span>Mastodon</span>
										</a>
									</li>

									<li>
										<a href="https://github.com/nclslbrn/">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
												<path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path>
											</svg>
											<span>Github</span>
										</a>
									</li>
									<li>
										<a href="https://discord.com/users/Nicolas%20Lebrun#9221">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-discord" viewBox="0 0 16 16">
												<path d="M13.545 2.907a13.227 13.227 0 0 0-3.257-1.011.05.05 0 0 0-.052.025c-.141.25-.297.577-.406.833a12.19 12.19 0 0 0-3.658 0 8.258 8.258 0 0 0-.412-.833.051.051 0 0 0-.052-.025c-1.125.194-2.22.534-3.257 1.011a.041.041 0 0 0-.021.018C.356 6.024-.213 9.047.066 12.032c.001.014.01.028.021.037a13.276 13.276 0 0 0 3.995 2.02.05.05 0 0 0 .056-.019c.308-.42.582-.863.818-1.329a.05.05 0 0 0-.01-.059.051.051 0 0 0-.018-.011 8.875 8.875 0 0 1-1.248-.595.05.05 0 0 1-.02-.066.051.051 0 0 1 .015-.019c.084-.063.168-.129.248-.195a.05.05 0 0 1 .051-.007c2.619 1.196 5.454 1.196 8.041 0a.052.052 0 0 1 .053.007c.08.066.164.132.248.195a.051.051 0 0 1-.004.085 8.254 8.254 0 0 1-1.249.594.05.05 0 0 0-.03.03.052.052 0 0 0 .003.041c.24.465.515.909.817 1.329a.05.05 0 0 0 .056.019 13.235 13.235 0 0 0 4.001-2.02.049.049 0 0 0 .021-.037c.334-3.451-.559-6.449-2.366-9.106a.034.034 0 0 0-.02-.019Zm-8.198 7.307c-.789 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.45.73 1.438 1.613 0 .888-.637 1.612-1.438 1.612Zm5.316 0c-.788 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.451.73 1.438 1.613 0 .888-.631 1.612-1.438 1.612Z"></path>
											</svg>
											<span>Discord</span>
										</a>
									</li>
									<li>
										<a href="https://www.tiktok.com/@nclslbrn">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
												<path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3V0Z"/>
											</svg>
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
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
												<path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
											</svg>
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

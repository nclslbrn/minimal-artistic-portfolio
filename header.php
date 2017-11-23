<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Minimal-Artistic-Portfolio
 */
$homepage = is_front_page();

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-16x16.png">
<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo get_template_directory(); ?>/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<svg style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
		<defs>
		<symbol id="icon-location" viewBox="0 0 32 32">
		<title>location</title>
		<path d="M16 0c-5.523 0-10 4.477-10 10 0 10 10 22 10 22s10-12 10-22c0-5.523-4.477-10-10-10zM16 16c-3.314 0-6-2.686-6-6s2.686-6 6-6 6 2.686 6 6-2.686 6-6 6z"></path>
		</symbol>
		<symbol id="icon-calendar" viewBox="0 0 32 32">
		<title>calendar</title>
		<path d="M27.2 4.8h-1.6v3.2h-4.8v-3.2h-9.6v3.2h-4.8v-3.2h-1.6c-1.762 0-3.2 1.44-3.2 3.2v19.2c0 1.76 1.438 3.2 3.2 3.2h22.4c1.76 0 3.2-1.44 3.2-3.2v-19.2c0-1.76-1.44-3.2-3.2-3.2zM27.2 27.2h-22.4v-12.8h22.4v12.8zM10.4 1.6h-3.2v5.6h3.2v-5.6zM24.8 1.6h-3.2v5.6h3.2v-5.6z"></path>
		</symbol>
		<symbol id="icon-google-plus" viewBox="0 0 32 32">
		<title>google-plus</title>
		<path d="M10.181 14.294v3.494h5.775c-0.231 1.5-1.744 4.394-5.775 4.394-3.475 0-6.313-2.881-6.313-6.431s2.838-6.431 6.313-6.431c1.981 0 3.3 0.844 4.056 1.569l2.762-2.662c-1.775-1.656-4.075-2.662-6.819-2.662-5.631 0.006-10.181 4.556-10.181 10.188s4.55 10.181 10.181 10.181c5.875 0 9.775-4.131 9.775-9.95 0-0.669-0.075-1.181-0.163-1.688h-9.613z"></path>
		<path d="M32 14h-3v-3h-3v3h-3v3h3v3h3v-3h3z"></path>
		</symbol>
		<symbol id="icon-facebook" viewBox="0 0 32 32">
		<title>facebook</title>
		<path d="M19 6h5v-6h-5c-3.86 0-7 3.14-7 7v3h-4v6h4v16h6v-16h5l1-6h-6v-3c0-0.542 0.458-1 1-1z"></path>
		</symbol>
		<symbol id="icon-instagram" viewBox="0 0 32 32">
		<title>instagram</title>
		<path d="M16 2.881c4.275 0 4.781 0.019 6.462 0.094 1.563 0.069 2.406 0.331 2.969 0.55 0.744 0.288 1.281 0.638 1.837 1.194 0.563 0.563 0.906 1.094 1.2 1.838 0.219 0.563 0.481 1.412 0.55 2.969 0.075 1.688 0.094 2.194 0.094 6.463s-0.019 4.781-0.094 6.463c-0.069 1.563-0.331 2.406-0.55 2.969-0.288 0.744-0.637 1.281-1.194 1.837-0.563 0.563-1.094 0.906-1.837 1.2-0.563 0.219-1.413 0.481-2.969 0.55-1.688 0.075-2.194 0.094-6.463 0.094s-4.781-0.019-6.463-0.094c-1.563-0.069-2.406-0.331-2.969-0.55-0.744-0.288-1.281-0.637-1.838-1.194-0.563-0.563-0.906-1.094-1.2-1.837-0.219-0.563-0.481-1.413-0.55-2.969-0.075-1.688-0.094-2.194-0.094-6.463s0.019-4.781 0.094-6.463c0.069-1.563 0.331-2.406 0.55-2.969 0.288-0.744 0.638-1.281 1.194-1.838 0.563-0.563 1.094-0.906 1.838-1.2 0.563-0.219 1.412-0.481 2.969-0.55 1.681-0.075 2.188-0.094 6.463-0.094zM16 0c-4.344 0-4.887 0.019-6.594 0.094-1.7 0.075-2.869 0.35-3.881 0.744-1.056 0.412-1.95 0.956-2.837 1.85-0.894 0.888-1.438 1.781-1.85 2.831-0.394 1.019-0.669 2.181-0.744 3.881-0.075 1.713-0.094 2.256-0.094 6.6s0.019 4.887 0.094 6.594c0.075 1.7 0.35 2.869 0.744 3.881 0.413 1.056 0.956 1.95 1.85 2.837 0.887 0.887 1.781 1.438 2.831 1.844 1.019 0.394 2.181 0.669 3.881 0.744 1.706 0.075 2.25 0.094 6.594 0.094s4.888-0.019 6.594-0.094c1.7-0.075 2.869-0.35 3.881-0.744 1.050-0.406 1.944-0.956 2.831-1.844s1.438-1.781 1.844-2.831c0.394-1.019 0.669-2.181 0.744-3.881 0.075-1.706 0.094-2.25 0.094-6.594s-0.019-4.887-0.094-6.594c-0.075-1.7-0.35-2.869-0.744-3.881-0.394-1.063-0.938-1.956-1.831-2.844-0.887-0.887-1.781-1.438-2.831-1.844-1.019-0.394-2.181-0.669-3.881-0.744-1.712-0.081-2.256-0.1-6.6-0.1v0z"></path>
		<path d="M16 7.781c-4.537 0-8.219 3.681-8.219 8.219s3.681 8.219 8.219 8.219 8.219-3.681 8.219-8.219c0-4.537-3.681-8.219-8.219-8.219zM16 21.331c-2.944 0-5.331-2.387-5.331-5.331s2.387-5.331 5.331-5.331c2.944 0 5.331 2.387 5.331 5.331s-2.387 5.331-5.331 5.331z"></path>
		<path d="M26.462 7.456c0 1.060-0.859 1.919-1.919 1.919s-1.919-0.859-1.919-1.919c0-1.060 0.859-1.919 1.919-1.919s1.919 0.859 1.919 1.919z"></path>
		</symbol>
		<symbol id="icon-twitter" viewBox="0 0 32 32">
		<title>twitter</title>
		<path d="M32 7.075c-1.175 0.525-2.444 0.875-3.769 1.031 1.356-0.813 2.394-2.1 2.887-3.631-1.269 0.75-2.675 1.3-4.169 1.594-1.2-1.275-2.906-2.069-4.794-2.069-3.625 0-6.563 2.938-6.563 6.563 0 0.512 0.056 1.012 0.169 1.494-5.456-0.275-10.294-2.888-13.531-6.862-0.563 0.969-0.887 2.1-0.887 3.3 0 2.275 1.156 4.287 2.919 5.463-1.075-0.031-2.087-0.331-2.975-0.819 0 0.025 0 0.056 0 0.081 0 3.181 2.263 5.838 5.269 6.437-0.55 0.15-1.131 0.231-1.731 0.231-0.425 0-0.831-0.044-1.237-0.119 0.838 2.606 3.263 4.506 6.131 4.563-2.25 1.762-5.075 2.813-8.156 2.813-0.531 0-1.050-0.031-1.569-0.094 2.913 1.869 6.362 2.95 10.069 2.95 12.075 0 18.681-10.006 18.681-18.681 0-0.287-0.006-0.569-0.019-0.85 1.281-0.919 2.394-2.075 3.275-3.394z"></path>
		</symbol>
		<symbol id="icon-flickr" viewBox="0 0 32 32">
		<title>flickr</title>
		<path d="M25 13c-2.206 0-4 1.794-4 4s1.794 4 4 4c2.206 0 4-1.794 4-4s-1.794-4-4-4zM25 10v0c3.866 0 7 3.134 7 7s-3.134 7-7 7-7-3.134-7-7c0-3.866 3.134-7 7-7zM0 17c0-3.866 3.134-7 7-7s7 3.134 7 7c0 3.866-3.134 7-7 7s-7-3.134-7-7z"></path>
		</symbol>
		<symbol id="icon-tumblr" viewBox="0 0 32 32">
		<title>tumblr</title>
		<path d="M18.001 14l-0 7.318c0 1.857-0.024 2.927 0.173 3.453 0.195 0.524 0.685 1.067 1.218 1.381 0.709 0.425 1.517 0.637 2.428 0.637 1.62 0 2.577-0.214 4.179-1.267v4.811c-1.366 0.642-2.558 1.019-3.666 1.279-1.109 0.258-2.308 0.388-3.596 0.388-1.463 0-2.327-0.184-3.45-0.552-1.124-0.371-2.083-0.9-2.876-1.579-0.795-0.685-1.344-1.413-1.652-2.182s-0.46-1.888-0.46-3.351v-11.222h-4.295v-4.531c1.256-0.408 2.661-0.993 3.556-1.755 0.899-0.764 1.618-1.678 2.16-2.748 0.543-1.067 0.917-2.429 1.121-4.079h5.159l-0 8h7.999v6h-7.999z"></path>
		</symbol>
		<symbol id="icon-pinterest" viewBox="0 0 32 32">
		<title>pinterest</title>
		<path d="M16 0c-8.825 0-16 7.175-16 16s7.175 16 16 16 16-7.175 16-16-7.175-16-16-16zM16 29.863c-1.431 0-2.806-0.219-4.106-0.619 0.563-0.919 1.412-2.431 1.725-3.631 0.169-0.65 0.863-3.294 0.863-3.294 0.45 0.863 1.775 1.594 3.175 1.594 4.181 0 7.194-3.844 7.194-8.625 0-4.581-3.738-8.006-8.544-8.006-5.981 0-9.156 4.019-9.156 8.387 0 2.031 1.081 4.563 2.813 5.369 0.262 0.125 0.4 0.069 0.463-0.188 0.044-0.194 0.281-1.131 0.387-1.575 0.031-0.137 0.019-0.262-0.094-0.4-0.575-0.694-1.031-1.975-1.031-3.162 0-3.056 2.313-6.019 6.256-6.019 3.406 0 5.788 2.319 5.788 5.637 0 3.75-1.894 6.35-4.356 6.35-1.363 0-2.381-1.125-2.050-2.506 0.394-1.65 1.15-3.425 1.15-4.613 0-1.063-0.569-1.95-1.756-1.95-1.394 0-2.506 1.438-2.506 3.369 0 1.225 0.412 2.056 0.412 2.056s-1.375 5.806-1.625 6.887c-0.281 1.2-0.169 2.881-0.050 3.975-5.156-2.012-8.813-7.025-8.813-12.9 0-7.656 6.206-13.863 13.862-13.863s13.863 6.206 13.863 13.863c0 7.656-6.206 13.863-13.863 13.863z"></path>
		</symbol>
	</defs>
</svg>
<div id="loader">
	<div class="overlay"></div><!-- .overlay -->
	<svg class="spinner" version="1.1" width="512" height="512" viewBox="0 0 512 512" fill="none" stroke="#fff" stroke-linecap="round" stroke-miterlimit="10" xmlns="http://www.w3.org/2000/svg"  xmlns:xlink="http://www.w3.org/1999/xlink">
	  <title>L-n</title>
	  <g>
	    <polyline class="path" points="27.35 176 27.35 27.35 484.65 27.35 484.65 484.65 191.7 484.65"/>
	    <polyline class="path" points="27.7 226 27.7 484.65 141.7 484.65"/>
	    <polyline class="path" points="165.7 402 165.7 110 343.7 399 343.7 110"/>
	  </g>
	</svg>
</div><!-- #loader -->
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'Minimal-Artistic-Portfolio' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="wrapper row">
			<div class="site-branding col-8">
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php // SPLIT SITE NAME
									$name = get_bloginfo( 'name' );
									$words = explode(' ', $name);
									foreach ( (array) $words as $word) :
										echo '<span>' . $word . '</span>';
									endforeach;
						?>
					</a>
				</h1>
			</div><!-- .site-branding -->

				<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
					<div id="widget-area" class="widget-area" role="complementary">
						<ul class="top-bar">
							<?php dynamic_sidebar( 'sidebar-2' ); ?>
						</ul>
					</div><!-- .widget-area -->
				<?php endif; ?>

			<button class="menu-toggle col-3" aria-controls="primary-menu" aria-expanded="false">
				<span class="menu-icon"></span>
			</button>
			<nav id="site-navigation" class="main-navigation" role="navigation">

				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->


		</div><!-- .wrapper .row -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="wrapper row">

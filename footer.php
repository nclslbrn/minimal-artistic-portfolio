<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Minimal-Artistic-Portfolio
 */

?>
</div><!-- .wrapper .row -->
<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-menu">
			<?php 
			if ( has_nav_menu( 'footer-menu' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer-menu',
							'container'      => '',
						) 
					);
			} 
			?>
		</div>
		<div class="site-info">
			<p>
				<?php echo esc_url( get_site_url() ) . ' '; ?> © <?php esc_html_e( 'All right reserved', 'Minimal-Artistic-Portfolio' ); ?>
			</p>
			<a href="https://github.com/nclslbrn/Minimal-artist-portfolio">
				<?php esc_html_e( 'Design : N.Lebrun', 'Minimal-Artistic-Portfolio' ); ?>
			</a>
		</div><!-- .site-info -->

</footer><!-- #colophon -->

</div><!-- #content -->
</div><!-- #page -->
<?php wp_footer(); ?>
<?php 
/**
 * Register js script for map with unique marker on event page */ 
?>
<?php global $map_latt; ?>
<?php global $map_long; ?>
<?php global $actual_events; ?>


</body>
</html>

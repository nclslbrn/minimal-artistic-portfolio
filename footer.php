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
	<div class="wrapper row">

		<div class="col-3 footer-menu">
			<?php 
			if ( has_nav_menu( 'footer-menu' ) ) {
					wp_nav_menu( array( 'theme_location' => 'footer-menu' ) );
			} 
			?>
		</div>
		<div class="col-9 site-info">
			<p>
				<?php echo esc_url( get_site_url() ) . ' '; ?><?php esc_html_e( 'All right reserved', 'Minimal-Artistic-Portfolio' ); ?>

				<span class="sep"> | </span>
				<a href="https://studio.nicolas-lebrun.fr">
					<?php esc_html_e( 'Designed by Nicolas Lebrun', 'Minimal-Artistic-Portfolio' ); ?>
				</a>
			</p>
		</div><!-- .site-info -->

	</div><!-- .wrapper -->
</footer><!-- #colophon -->

</div><!-- #content -->
</div><!-- #page -->
<?php wp_footer(); ?>
<?php 
/**
 * Register js script for map with unique marker on event page */ 
?>
<?php global $latt; ?>
<?php global $long; ?>
<?php global $actual_events; ?>


</body>
</html>

<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 */
$sections = get_post_meta($post->ID, 'page_section', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		
		<?php if(!empty($sections)): ?>
			<?php foreach( (array) $sections as $part): ?>
				<div class="row page-section">
					<div class="col-4 column">
						<h5><?php _e( unserialize( base64_decode( $part['title'] ) ) ); ?><h5>
					</div>
					<div class="col-6 column">
						<p><?php _e( unserialize( base64_decode( $part['text'] ) ) ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Minimal-Artistic-Portfolio' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'Minimal-Artistic-Portfolio' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

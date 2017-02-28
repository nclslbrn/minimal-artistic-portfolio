<?php
/**
 * The template for displaying all single event.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Minimal-Artistic-Portfolio
 */


get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

        <?php while ( have_posts() ) : the_post();
                $GLOBALS['latt']= get_post_meta( get_the_ID(), 'LATT', true );
                $GLOBALS['long']= get_post_meta( get_the_ID(), 'LONG', true );
        ?>

          <?php get_template_part( 'template-parts/content', 'event' ); ?>

        <?php endwhile; ?>

        </main><!-- .site-main -->
    </div><!-- .content-area -->
<?php
get_sidebar();
get_footer();

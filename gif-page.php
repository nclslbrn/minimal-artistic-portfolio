<?php
/*
Template Name: Gif-page
*/

/**
 * The template for gif page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 */
$gifQueryArgs = array(
    'post_type'      => 'gif',
    'posts_per_page' => 12,
    'post_status'    => 'publish',
    'paged'          => get_query_var('paged')
);
$post_content = '';
get_header(); ?>


<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header><!-- .entry-header -->
            </article>
            <?php $post_content = $post->post_content; ?>
        <?php endwhile; // End of the loop.?>

        <?php $gifQuery = new WP_Query($gifQueryArgs); ?>
        <?php if ($gifQuery->have_posts()): ?>
            <div class="row">
                <?php while ($gifQuery->have_posts()) : $gifQuery->the_post(); ?>

                    <?php if (get_the_post_thumbnail_url($post, 'full')): ?>
                        <article id="post-<?php echo $post->ID;?>" class="animated-gif">
                            <a  class="fluidbox" 
                                href="<?php echo get_the_post_thumbnail_url($post, 'full');?>" 
                                data-fluidbox-loader>
                                <img 
                                    src="<?php echo get_the_post_thumbnail_url($post, 'medium');?>"
                                    title="<?php echo $post->post_title; ?>" 
                                    class="gif-thumbnail">
                            </a>
                            <div class="gif-source hidden">
                                <!-- preload our gif -->
                                <img src="<?php echo get_the_post_thumbnail_url($post, 'full');?>">
                            </div>
                        </article>
                    <?php endif; ?>

                <?php endwhile; ?>
            </div><!-- .row -->

            <?php if ($gifQuery->max_num_pages > 0) : ?>
                <nav class="page-nav">
                    <?php
                        $orig_query = $wp_query; // fix for pagination to work
                        $wp_query = $gifQuery;
                        echo paginate_links(
                            array("prev_next" => false)
                        );
                        $wp_query = $orig_query; // fix for pagination to work
                        ?>
                </nav>
            <?php endif; ?>
            <div class="row">
                <div class="col-2 column"></div>
                <div class="col-8 column">
                    <p><?php echo $post_content; ?></p>
                </div>
            </div>
        <?php endif; ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

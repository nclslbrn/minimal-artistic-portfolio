 <?php 
  $gallery = get_post_gallery();
  $content = strip_shortcode_gallery( get_the_content(get_the_ID()) );
  $content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) );
  $content = preg_replace("/<img[^>]+\>/i", " ", $content);

  ?>
  <?php $count = aap_get_media( get_the_ID() ); ?>
  <div class="col-4 column project-description">
    <?php the_title( '<h3 class="project-title">', '</h3>' ); ?>
    <?php get_metabox( get_the_ID(), 'CARTEL', false); ?>
    <?php echo '<date>' . mysql2date("Y", $post->post_date_gmt). '</date>'; ?>
    <?php echo get_event("exposition/exhibition:"); ?>
    <?php //aap_entry_meta(); ?>
    <?php edit_post_link( __( 'Edit', 'Minimal-Artistic-Portfolio' ), '<span class="edit-link">', '</span>' ); ?>
  </div>
  <div class="col-8 column statement">
    <?php 
    //echo $content;
    $link = get_the_permalink();
    echo '<a href="'. $link . '"><span class="genericon genericon-external"></span></a>';
     ?>
  </div>
  <?php

    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Minimal-Artistic-Portfolio' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
        'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'Minimal-Artistic-Portfolio' ) . ' </span>%',
        'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
?>
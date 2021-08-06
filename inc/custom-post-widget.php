<?php

class CPT_list_widget extends WP_Widget
{
    function CPT_list_Widget() {

        parent::__construct(false, $name = __('Custom Post list Widget', 'wp_widget_plugin') );

    }                     // Widget Settings

    function widget( $args, $instance )
    {
        extract( $args );
        // these are the widget options
        $title = apply_filters('widget_title', $instance['title']);
        $type = $instance['type'];
        $number = $instance['number'];

        echo $before_widget;
        // Display the widget
        echo '<div class="widget-text wp_widget_plugin_box">';

        // Check if title is set
        if ( $title )
        {
           echo $before_title . $title . $after_title;
        }

        // Check if text is set
        if( $type )
        {

            map_list_post_by_year( $type, $number );
        }

        echo '</div>';
        echo $after_widget;
    }                        // display the widget

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        // Fields
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['type'] = $new_instance['type'];
        $instance['number'] = $new_instance['number'];

       return $instance;
    }                        // update the widget

    function form( $instance )
    {
        $builtin = array('post', 'page', 'attachment');
        $post_type = get_post_types( array('public' => true, '_builtin' => false) );
        // Check values
        if( $instance)
        {
             $title = esc_attr($instance['title']);
             $type = $instance['type'];
             $number = $instance['number'];

        }
        else
        {
             $title = '';
             $type = '';
             $number = '-1';
        }
        ?>

        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'Minimal-Artistic-Portfolio'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Custom post:<br>', 'Minimal-Artistic-Portfolio'); ?>
            <select class='widefat' id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" type="text">
            <?php
                foreach( $post_type as $alltype)
                {
                    //echo $type.'<br>';
                    ?>
                    <option value="<?= $alltype ?>" <?php echo ($type == $alltype)?'selected':''; ?>>
                        <?= $alltype ?>
                    </option>
                    <?php
                }
            ?>
            </select>
        </label>
        <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Number:<br>', 'Minimal-Artistic-Portfolio'); ?>
            <select class='widefat' id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text">

                <option value="-1" <?php echo ($number == '-1')?'selected':'';?>>All</option>
                <option value="5" <?php echo ($number == '5')?'selected':'';?>>5</option>
                <option value="10" <?php echo ($number == '10')?'selected':'';?>>10</option>
                <option value="15" <?php echo ($number == '15')?'selected':'';?>>15</option>
                <option value="20" <?php echo ($number == '20')?'selected':'';?>>20</option>
                <option value="25" <?php echo ($number == '25')?'selected':'';?>>25</option>
                <option value="30" <?php echo ($number == '30')?'selected':'';?>>30</option>
            </select>
        </label>
        <?php
    }// and of course the form for the widget options

}// The example widget class


add_action( 'widgets_init', create_function('', 'return register_widget("CPT_list_widget");'));

add_action( 'widgets_init', 'register_menu_sidebar' );
function register_menu_sidebar() {
    register_sidebar( array(
        'name' => __( 'Menu Sidebar', 'Minimal-Artistic-Portfolio' ),
        'id' => 'menu-sidebar',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'Minimal-Artistic-Portfolio' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
}
?>

<?php

// Creating the widget 
class Night_Mode_Widget extends WP_Widget {
 
 /**
     * Constructs the new widget.
     *
     * @see WP_Widget::__construct()
     */
    function __construct() {
        // Instantiate the parent object.
        parent::__construct( 
            'night_mode', 
            __( 'Night mode widget', 'Minimal-Artistic-Portfolio' ),
            array( 
                'description' => 
                __( 'Display button to change theme (light/dark)', 'Minimal-Artistic-Portfolio' )
            ) 
        );
    }
 
    /**
     * The widget's HTML output.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Display arguments including before_title, after_title,
     *                        before_widget, and after_widget.
     * @param array $instance The settings for the particular instance of the widget.
     */
    function widget( $args, $instance ) {
        $title = isset( $instance['title'] ) && '' !== $instance['title'] ? apply_filters('widget_title', $instance['title']) : false;
        $type = isset( $instance['type'] ) ? esc_attr($instance['type']) : 'switch';
        $curr_mode = isset( $_COOKIE['mode'] ) ? esc_attr($_COOKIE['mode']) : 'light';
	    $icon_name = 'dark' === $curr_mode ? 'moon' : 'sun';

        ?>

        <?php echo $args['before_widget']; ?>

        <?php if( $title ) echo $args['before_title'] . $title . $args['after_title']; ?>
        
        <?php if( $type === 'menu' ) : ?>
            <label data-current-theme title="<?php echo $title; ?>">
                <?php echo esc_html__('Current mode', 'Minimal-Artistic-Portfolio' ); ?>
                <svg class="icon icon-<?php echo $icon_name; ?>">
                    <use xlink:href="#icon-<?php echo $icon_name; ?>"></use>
                </svg>
            </label>
            <select name="mode-switcher">
                <option value="light" <?php echo $curr_mode === 'light' ? 'selected' : ''; ?>>
                    ☀️ 
                    <?php echo esc_html__( 'Light', 'Minimal-Artistic-Portfolio' ); ?>
                 </option>

                <option value="dark" <?php echo $curr_mode === 'dark' ? 'selected' : ''; ?>>
                    🌑 
                    <?php echo esc_html__( 'Dark', 'Minimal-Artistic-Portfolio' ); ?>   
                </option>                
        </select>
        <?php elseif( $type === 'switch'): ?>
            <fieldset>
                <svg class="icon icon-sun">
                    <use xlink:href="#icon-sun"></use>
                </svg>
                <label class="switch">
                    <input 
                        type="checkbox" 
                        name="mode-switcher" 
                        <?php echo $curr_mode === 'dark' ? 'checked' : ''; ?>/>
                    <span class="slider"></span>
                </label>
                <svg class="icon icon-moon">
                    <use xlink:href="#icon-moon"></use>
                </svg>
            </fieldset>
        <?php elseif ( $type === 'single-button') : ?>
            <fieldset class="single-button button" data-current-theme <?php echo $title ? 'title="'. $title . '"' : ''; ?>>
                <label for="theme-button">
                    <?php echo esc_html__('Current mode', 'Minimal-Artistic-Portfolio' ); ?>
                </label>
                <input id="theme-button" type="checkbox" name="mode-switcher">
                    <svg class="icon icon-<?php echo $icon_name; ?>">
                    <use xlink:href="#icon-<?php echo $icon_name; ?>"></use>
                </svg>
            </fieldset>
        <?php endif; ?>
        <?php echo $args['after_widget']; ?>
        
        <?php
    }
 
    /**
     * The widget update handler.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance The new instance of the widget.
     * @param array $old_instance The old instance of the widget.
     */
    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['type'] = ( ! empty( $new_instance['type'] ) ) ? strip_tags( $new_instance['type'] ) : '';

        return $instance;
    }
 
    /**
     * Output the admin widget options form HTML.
     *
     * @param array $instance The current widget settings.
     */
    function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'New title', 'Minimal-Artistic-Portfolio' );
        }

        if( isset( $instance['type'] ) ) {
            $type = $instance['type'];
        } else {
            $type = 'switch';
        }
        ?>

        <label for="<?php echo $this->get_field_id('title'); ?>">
            <?php _e('Title', 'Minimal-Artistic-Portfolio'); ?>
        </label>

        <input 
            class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" 
            name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" 
            value="<?php echo esc_attr( $title ); ?>" 
        />
        <br>

        <label for="<?php echo $this->get_field_id('type'); ?>">
            <?php _e('Type', 'Minimal-Artistic-Portfolio'); ?>
        </label>

        <select 
            id="<?php echo $this->get_field_id('type'); ?>" 
            class="widefat" 
            name="<?php echo $this->get_field_name( 'type' ); ?>"
        >
            <option value="switch" <?php echo $type === 'switch' ? 'selected' : '';?>>
                <?php _e('Switch', 'Minimal-Artistic-Portfolio' ); ?>
            </option>
            <option value="menu" <?php echo $type === 'menu' ? 'selected' : '';?>>
                <?php _e('Menu', 'Minimal-Artistic-Portfolio' ); ?>
            </option>
            <option value="single-button" <?php echo $type === 'single-button' ? 'selected' : '';?>>
                <?php _e('Single button', 'Minimal-Artistic-Portfolio' ); ?>
            </option>
        </select>   

        <?php
    }
     
} 

function map_load_night_theme_widget() {
    register_widget( 'Night_Mode_Widget' );
}
add_action( 'widgets_init', 'map_load_night_theme_widget' );

// deactivate new block editor
function map_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'map_theme_support' );
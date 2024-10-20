<?php
/**
 * Night / Light mode widget 
 *
 * Admin option and front display
 *
 * @package Minimal-Artistic-Portfolio
 * @version 1.0.0
 */

/**
 * Widget class
 *
 * @category Class
 * @package Minimal-Artistic-Portfolio
 * @version 1.0.0
 */
class Map_Night_Mode_Widget extends WP_Widget {
 
	/**
	 * Constructs the new widget.
	 *
	 * @see WP_Widget::__construct()
	 */
	public function __construct() {
		// Instantiate the parent object.
		parent::__construct( 
			'night_mode', 
			__( 'Night mode widget', 'Minimal-Artistic-Portfolio' ),
			array( 
				'description' => 
				__( 'Display button to change theme (light/dark)', 'Minimal-Artistic-Portfolio' ),
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
	public function widget( $args, $instance ) {
		$title     = isset( $instance['title'] ) && '' !== $instance['title'] ? apply_filters( 'widget_title', $instance['title'] ) : false;
		$type      = isset( $instance['type'] ) ? esc_attr( $instance['type'] ) : 'switch';
		$curr_mode = isset( $_COOKIE['mode'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_COOKIE['mode'] ) ) ) : 'light';
		$icon_name = 'dark' === $curr_mode ? 'moon' : 'sun';

		?>

		<?php echo wp_kses_post( $args['before_widget'] ); ?>

		<?php 
		if ( $title ) {
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		} 
		?>
		<?php if ( 'menu' === $type ) : ?>
			<label data-current-theme title="<?php echo esc_attr( $title ); ?>">
				<?php echo esc_html_e( 'Current mode', 'Minimal-Artistic-Portfolio' ); ?>
				<svg class="icon icon-<?php echo esc_attr( $icon_name ); ?>">
					<use xlink:href="#icon-<?php echo esc_attr( $icon_name ); ?>"></use>
				</svg>
			</label>
			<select name="mode-switcher">
				<option value="light" <?php echo 'light' === $curr_mode ? 'selected' : ''; ?>>
					☀️ 
					<?php echo esc_html_e( 'Light', 'Minimal-Artistic-Portfolio' ); ?>
				</option>
				<option value="dark" <?php echo 'dark' === $curr_mode ? 'selected' : ''; ?>>
					🌑 
					<?php esc_html_e( 'Dark', 'Minimal-Artistic-Portfolio' ); ?>   
				</option>                
		</select>
		<?php elseif ( 'switch' === $type ) : ?>
			<fieldset>
				<svg class="icon icon-sun">
					<use xlink:href="#icon-sun"></use>
				</svg>
				<label class="switch">
					<input 
						type="checkbox" 
						name="mode-switcher" 
						<?php echo 'dark' === $curr_mode ? 'checked' : ''; ?>/>
					<span class="slider"></span>
				</label>
				<svg class="icon icon-moon">
					<use xlink:href="#icon-moon"></use>
				</svg>
			</fieldset>
		<?php elseif ( 'single-button' === $type ) : ?>
			<fieldset 
				class="single-button" 
				<?php echo $title ? 'title="' . esc_attr( $title ) . '"' : ''; ?>
				data-current-theme>
				<label for="theme-button" aria-label="<?php echo esc_attr__( 'Current mode', 'Minimal-Artistic-Portfolio' ); ?>">
					<input id="theme-button" type="checkbox" name="mode-switcher">
					<svg class="icon icon-<?php echo esc_attr( $icon_name ); ?>">
						<use xlink:href="#icon-<?php echo esc_attr( $icon_name ); ?>"></use>
					</svg>
				</label>
			</fieldset>
		<?php endif; ?>
		<?php echo wp_kses_post( $args['after_widget'] ); ?>
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
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['type']  = ( ! empty( $new_instance['type'] ) ) ? wp_strip_all_tags( $new_instance['type'] ) : '';

		return $instance;
	}
 
	/**
	 * Output the admin widget options form HTML.
	 *
	 * @param array $instance The current widget settings.
	 */
	public function form( $instance ) {
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = __( 'New title', 'Minimal-Artistic-Portfolio' );
		}

		if ( isset( $instance['type'] ) ) {
			$type = $instance['type'];
		} else {
			$type = 'switch';
		}
		?>

		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
			<?php esc_html_e( 'Title', 'Minimal-Artistic-Portfolio' ); ?>
		</label>

		<input 
			class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
			name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" 
			value="<?php echo esc_attr( $title ); ?>" 
		/>
		<br>

		<label for="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>">
			<?php esc_html_e( 'Type', 'Minimal-Artistic-Portfolio' ); ?>
		</label>

		<select 
			id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>" 
			class="widefat" 
			name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>"
		>
			<option value="switch" <?php echo 'switch' === $type ? 'selected' : ''; ?>>
				<?php esc_html_e( 'Switch', 'Minimal-Artistic-Portfolio' ); ?>
			</option>
			<option value="menu" <?php echo 'menu' === $type ? 'selected' : ''; ?>>
				<?php esc_html_e( 'Menu', 'Minimal-Artistic-Portfolio' ); ?>
			</option>
			<option value="single-button" <?php echo 'single-button' === $type ? 'selected' : ''; ?>>
				<?php esc_html_e( 'Single button', 'Minimal-Artistic-Portfolio' ); ?>
			</option>
		</select>   

		<?php
	}
} 
/**
 * Register the mode widget
 *
 * @return void
 */
function map_load_night_theme_widget() {
	register_widget( 'Map_Night_Mode_Widget' );
}
add_action( 'widgets_init', 'map_load_night_theme_widget' );

/**
 * Deactivate new block editor
 *
 * @return void
 */
function map_theme_support() {
	remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'map_theme_support' );

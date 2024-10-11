<?php
/**
 * Functions to get and save custom metadata
 *
 * Event has a begin and end date, a place, a lattitude and a lontitude
 * Project has a cartel text, and cover options for displaying video or image
 *
 * @package Minimal-Artistic-Portfolio.
 * @version 1.0.0.
 */

/**
 * Add every metabox for project & event
 */
function map_adding_new_metabox() {
	/**
	 * Event
	 */
	add_meta_box(
		'date_section',
		'Date',
		'map_create_event_date_meta',
		'event',
		'normal',
		'high',
	);

	add_meta_box(
		'my-map',
		'Google Map',
		'map_add_event_location',
		'event',
		'normal',
		'high',
	);

	add_meta_box(
		'event',
		__( 'Event', 'Minimal-Artistic-Portfolio' ),
		'map_add_project_linked_event',
		'project',
		'side',
		'high',
	);

	/**
	 * Projects
	 */
	add_meta_box(
		'cartel_section',
		'Cartel',
		'map_add_cartel_meta',
		'project',
		'normal',
		'high'
	);

	add_meta_box(
		'cover_options',
		__( 'Cover option', 'Minimal-Artistic-Portfolio' ),
		'map_add_project_cover_options',
		'project',
		'normal',
		'high',
		);

	add_meta_box(
		'ext_gallery',
		__( 'External gallery', 'Minimal-Artistic-Portfolio' ),
		'map_add_project_ext_gallery',
		'project',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'map_adding_new_metabox' );

/**
 * Create a new text editor to add project art specs
 *
 * @param object $post the project post.
 */
function map_add_cartel_meta( $post ) {
	$cartel       = get_post_meta( $post->ID, 'CARTEL', true );
	wp_editor(
		htmlspecialchars_decode( $cartel ),
		'mettaabox_ID_stylee',
		$settings = array( 'textarea_name' => 'Cartel' )
	);
	wp_nonce_field( 'save_project_meta', 'save_project_meta_nonce', true, true );
}

/**
 * Create date selector for event post
 *
 * @param object $post the event post.
 */
function map_create_event_date_meta( $post ) {
	$begin_date = get_post_meta( $post->ID, 'BEGINDATE', true );
	$end_date   = get_post_meta( $post->ID, 'ENDDATE', true ); ?>
	<input type="date" name="InputBeginDate" id="beginDate" value="<?php echo esc_html( $begin_date ); ?>">
	<input type="date" name="InputEndDate" id="endDate" value="<?php echo esc_html( $end_date ); ?>">
	<?php
	wp_nonce_field( 'save_event_meta', 'save_event_meta_nonce', true, true );

}

/**
 * Create a multiple event selector to link with the project
 *
 * @param object $post the project post.
 */
function map_add_project_linked_event( $post ) {
	$custom             = get_post_custom( $post->ID );
	$row_saved_event_id = (array) get_post_meta( $post->ID, 'event', true );
	$saved_event_id     = array_map( 'intval', $row_saved_event_id );
	$count              = 0;
	echo '<div class="link_header">';
	$query_event_args = array(
		'post_type'      => 'event',
		'posts_per_page' => -1, // phpcs:ignore WPThemeReview.CoreFunctionality.PostsPerPage.posts_per_page_posts_per_page
	);
	$query_event      = new WP_Query( $query_event_args );

	foreach ( $query_event->posts as $event ) {
		$event_title = get_the_title( $event->ID );
		if ( is_array( $saved_event_id ) && in_array( $event->ID, $saved_event_id, true ) ) {
			echo '<input type="checkbox" name="event[]" value="' . esc_attr( $event->ID ) . '" checked>' . esc_html( $event_title ) . '<br>';
		} else {
			echo '<input type="checkbox" name="event[]" value="' . esc_attr( $event->ID ) . '">' . esc_html( $event_title ) . '<br>';
		}
		$count++;
	}
	echo '</div>';
	echo '<div class="event_count"><span>Total:</span> <b>' . esc_attr( $count ) . '</b></div>';
}

/**
 * Add place name, lattitude and longitude to event
 *
 * @param object $post the event post.
 */
function map_add_event_location( $post ) {
	$place    = get_post_meta( $post->ID, 'PLACE', true );
	$map_latt = get_post_meta( $post->ID, 'LATT', true );
	$map_long = get_post_meta( $post->ID, 'LONG', true );
	?>
	<label> <?php echo esc_html( __( 'Place', 'Minimal-Artistic-Portfolio' ) ); ?></label>
	<input type="text" name="InputPlace" id="place" value="<?php echo esc_textarea( $place ); ?>"/>
	<label>Lattitude</label>
	<input type="text" name="InputLatt" id="map_latt" value="<?php echo esc_textarea( $map_latt ); ?>"/>
	<label>Longitude</label>
	<input type="text" name="InputLong" id="map_long" value="<?php echo esc_textarea( $map_long ); ?>"/>
	<?php
}
/**
 * Add options to display featured image or video before post_content
 *
 * @param object $post the project post.
 */
function map_add_project_cover_options( $post ) {
	// $is_video boolean string '0' = image '1' = video
	$is_video       = get_post_meta( $post->ID, 'IS_VIDEO', true );
	$video_id       = get_post_meta( $post->ID, 'VIDEO_ID', true );
	$video_provider = get_post_meta( $post->ID, 'VIDEO_PROVIDER', true );
	$first_res_url  = get_post_meta( $post->ID, '576P_VIDEO_URL', true );
	$second_res_url = get_post_meta( $post->ID, '720P_VIDEO_URL', true );
	$third_res_url  = get_post_meta( $post->ID, '1080P_VIDEO_URL', true );
	?>
<label><?php echo esc_html( __( 'Cover is an image or a video ?', 'Minimal-Artistic-Portfolio' ) ); ?></label><br/>
<input id="not_a_video" type="radio" name="is_video" value="0" <?php echo '0' === $is_video ? ' checked' : ''; ?>/>
<label for="not_a_video"><?php echo esc_html( __( 'Image', 'Minimal-Artistic-Portfolio' ) ); ?></label> <br/>
<input id="its_a_video" type="radio" name="is_video" value="1" <?php echo '1' === $is_video ? ' checked' : ''; ?>/>
<label><?php echo esc_html( __( 'Video', 'Minimal-Artistic-Portfolio' ) ); ?></label><br/>

<label><?php echo esc_html( __( 'Video ID (leave empty if selfhosted)', 'Minimal-Artistic-Portfolio' ) ); ?></label><br/>
<input type="text" name="video_id" value="<?php echo esc_attr( $video_id ); ?>" /><br/>

<label><?php echo esc_html( __( 'Video provider', 'Minimal-Artistic-Portfolio' ) ); ?></label><br/>
<input id="provider_vimeo" type="radio" name="video_provider" value="vimeo" <?php echo 'vimeo' === $video_provider ? ' checked' : ''; ?>/>
<label for="provider_vimeo"><?php echo esc_html( __( 'Vimeo', 'Minimal-Artistic-Portfolio' ) ); ?></label><br/>
<input id="provider_youtube" type="radio" name="video_provider" value="youtube" <?php echo 'youtube' === $video_provider ? ' checked' : ''; ?>/>
<label for="provider_youtube"><?php echo esc_html( __( 'YouTube', 'Minimal-Artistic-Portfolio' ) ); ?></label><br/>
<input id="provider_youtube" type="radio" name="video_provider" value="self" <?php echo 'self' === $video_provider ? ' checked' : ''; ?>/>
<label for="provider_youtube"><?php echo esc_html( __( 'Self hosted', 'Minimal-Artistic-Portfolio' ) ); ?></label><br/>

<label><?php echo esc_html( __( 'Self hosting URLs', 'Minimal-Artistic-Portfolio' ) ); ?></label><br/>
<label for="576pVideoUrl">576p video URL</label><br/>
<input id="576pVideoUrl" type="url" name="576pVideoUrl" value="<?php echo isset( $first_res_url ) ? esc_url( $first_res_url ) : ''; ?>">
<br/>

<label for="720pVideoUrl">720p video URL</label><br/>
<input id="720pVideoUrl" type="url" name="720pVideoUrl" value="<?php echo isset( $second_res_url ) ? esc_url( $second_res_url ) : ''; ?>">
<br/>

<label for="1080pVideoUrl">1080p video URL</label><br/>
<input id="1080pVideoUrl" type="url" name="1080pVideoUrl" value="<?php echo isset( $third_res_url ) ? esc_url( $third_res_url ) : ''; ?>">
<br/>

	<?php
}

function map_add_project_ext_gallery( $post ) {
	$ext_gallery = get_post_meta( $post->ID, 'ext_gallery', true );
	?>
	<textarea name="ext_gallery" rows="12" style="display: block;width: 100%;"><?php echo wp_kses_post($ext_gallery); ?></textarea>
	<?php
}
/**
 * Save every post meta of event post
 *
 * @param int $post_id the id of the event.
 */
function map_save_event_postmeta( $post_id ) {

	if ( isset( $_POST['publish'] ) || isset( $_POST['save'] ) ) {
		if ( ! isset( $_POST['save_event_meta_nonce'] ) ||
			! wp_verify_nonce( sanitize_user( wp_unslash( $_POST['save_event_meta_nonce'] ) ), 'save_event_meta' )
		) {

			wp_die( 'Sorry, your nonce did not verify event.' );

		} else {

			if ( ! empty( $_POST['InputBeginDate'] ) ) {

				$begin_date = sanitize_user( wp_unslash( $_POST['InputBeginDate'] ) );
				$end_date   = sanitize_user( wp_unslash( $_POST['InputEndDate'] ) );

				update_post_meta( $post_id, 'BEGINDATE', $begin_date );
				update_post_meta( $post_id, 'ENDDATE', $end_date );

			}

			if ( ! empty( $_POST['InputLatt'] ) && ! empty( $_POST['InputLong'] ) && ! empty( $_POST['InputPlace'] ) ) {
				$place_name = sanitize_user( wp_unslash( $_POST['InputPlace'] ) );
				$lattitude  = sanitize_user( wp_unslash( $_POST['InputLatt'] ) );
				$longitude  = sanitize_user( wp_unslash( $_POST['InputLong'] ) );

				update_post_meta( $post_id, 'PLACE', $place_name );
				update_post_meta( $post_id, 'LATT', $lattitude );
				update_post_meta( $post_id, 'LONG', $longitude );
			}
		}
	}
	if ( isset( $_POST['publish'] ) ) {


		global $post;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post->ID;
		}
	}
}
add_action( 'save_post_event', 'map_save_event_postmeta' );

/**
 * Save every post meat of project
 *
 * @param int $post_id the id of the project.
 */
function map_save_project_postmeta( $post_id ) {
	if ( isset( $_POST['publish'] ) || isset( $_POST['save'] ) ) {

		if (
		! isset( $_POST['save_project_meta_nonce'] ) ||
		! wp_verify_nonce( sanitize_user( wp_unslash( $_POST['save_project_meta_nonce'] ) ), 'save_project_meta' )
		) {
			wp_die( 'Sorry, your nonce did not verify.' );

		} else {

			if ( ! empty( $_POST['Cartel'] ) ) {
				$cartel = sanitize_textarea_field( wp_unslash( $_POST['Cartel'] ) );
				update_post_meta( $post_id, 'CARTEL', $cartel );
			}
			if ( ! empty( $_POST['event'] ) ) {
				$row_events_ids       = array_map( 'wp_unslash', (array) $_POST['event'] ); //phpcs:ignore
				$sanitized_events_ids = array_map( 'sanitize_text_field', $row_events_ids );
				update_post_meta( $post_id, 'event', $sanitized_events_ids );

			}
			if ( isset( $_POST['is_video'] ) && is_numeric( $_POST['is_video'] ) ) {
				$is_video = sanitize_user( wp_unslash( $_POST['is_video'] ) );
				update_post_meta( $post_id, 'IS_VIDEO', $is_video );
			}

			if ( ! isset( $_POST['video_id'] ) || (
			isset( $_POST['video_id'] ) &&
			get_post_meta( $post_id, 'VIDEO_ID', true ) !== $_POST['video_id'] )
			) {
				$video_id = sanitize_user( wp_unslash( $_POST['video_id'] ) );
				update_post_meta( $post_id, 'VIDEO_ID', $video_id );
			}
			if ( ! isset( $_POST['576pVideoUrl'] ) || (
			isset( $_POST['576pVideoUrl'] ) &&
			get_post_meta( $post_id, '576P_VIDEO_URL', true ) !== $_POST['576pVideoUrl'] )
			) {
				update_post_meta( $post_id, '576P_VIDEO_URL', sanitize_user( wp_unslash( $_POST['576pVideoUrl'] ) ) );
			}
			if ( ! isset( $_POST['720pVideoUrl'] ) || (
			isset( $_POST['720pVideoUrl'] ) &&
			get_post_meta( $post_id, '720P_VIDEO_URL', true ) !== $_POST['720pVideoUrl'] )
			) {
				update_post_meta( $post_id, '720P_VIDEO_URL', sanitize_user( wp_unslash( $_POST['720pVideoUrl'] ) ) );
			}
			if ( ! isset( $_POST['1080pVideoUrl'] ) || isset( $_POST['1080pVideoUrl'] ) &&
			get_post_meta( $post_id, '1080P_VIDEO_URL', true ) !== $_POST['1080pVideoUrl'] ) {
				update_post_meta( $post_id, '1080P_VIDEO_URL', sanitize_user( wp_unslash( $_POST['1080pVideoUrl'] ) ) );
			}

			if (
			! empty( $_POST['video_provider'] )
			&& in_array( $_POST['video_provider'], array( 'vimeo', 'youtube', 'self' ), true )
			) {
				$video_provider = sanitize_user( wp_unslash( $_POST['video_provider'] ) );
				update_post_meta( $post_id, 'VIDEO_PROVIDER', $video_provider );
			}

			if (get_post_meta($post_id, 'ext_gallery', true) !== wp_kses_post($_POST['ext_gallery'])) {
				update_post_meta( $post_id, 'ext_gallery', wp_kses_post($_POST['ext_gallery']));
			}
		}
	}

}

add_action( 'save_post_project', 'map_save_project_postmeta' );

/**
 * Add column header to admin event list
 *
 * @param array $defaults the current columns.
 * @return array $defaults the modified columns.
 */
function map_event_table_head( $defaults ) {
	unset( $defaults['categories'] );
	unset( $defaults['date'] );
	$defaults['event_date'] = __( 'Date', 'Minimal-Artistic-Portfolio' );
	$defaults['place']      = __( 'Place', 'Minimal-Artistic-Portfolio' );
	return $defaults;
}
add_filter( 'manage_event_posts_columns', 'map_event_table_head' );

/**
 * Add column content (relative to column header above)
 *
 * @param string $column_name the id/slug of the column.
 * @param int    $post_id the event post id.
 */
function map_event_table_content( $column_name, $post_id ) {
	if ( 'event_date' === $column_name ) {
		echo esc_html( date_i18n( 'j F Y', strtotime( get_post_meta( $post_id, 'BEGINDATE', 'true' ) ) ) );
	}

	if ( 'place' === $column_name ) {
		$place = get_post_meta( $post_id, 'PLACE', true );
		echo esc_html( $place );
	}
}
add_action( 'manage_event_posts_custom_column', 'map_event_table_content', 10, 2 );


/**
 * An alias of get_post_meta
 *
 * @param int     $post_id the id of the post we want postmeta.
 * @param string  $key post meta key.
 * @param boolean $single get meta as array or not.
 */
function map_get_metabox( $post_id, $key, $single ) {
	$meta_values = get_post_meta( $post_id, $key, $single );

	if ( ! empty( $meta_values ) ) :

		if ( ! is_array( $meta_values ) ) {
			echo '<div class="' . esc_attr( strtolower( $key ) ) . '">';
			echo wp_kses_post( $meta_values );
			echo '</div>';
		} elseif ( is_array( $meta_values ) ) {
			echo '<div class="' . esc_attr( strtolower( $key ) ) . '">';
			$values = '';
			foreach ( $meta_values as $value ) {
				echo wp_kses_post( html_entity_decode( $value, ENT_COMPAT, 'UTF-8' ) );
			}
			echo '</div>';
		}
	endif;
}

?>

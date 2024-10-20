<?php

/**
 * Functions to get and save custom metadata
 *
 * Project has a cartel text, and cover options for displaying video or image
 *
 * @package Minimal-Artistic-Portfolio.
 * @version 1.0.0.
 */

/**
 * Add every metabox to project post
 */

// project cover options
add_action(
	'cmb2_admin_init',
	function () {
		$cmb = new_cmb2_box(array(
			'id'            => 'cover_options_metabox',
			'title'         => __('Cover option', 'Minimal-Artistic-Portfolio'),
			'object_types'  => array('project',),
			'context'       => 'normal',
			'priority'      => 'high',
		));

		$cmb->add_field(array(
			'name'       => __(
				'Cover is an image or a video ?',
				'Minimal-Artistic-Portfolio'
			),
			'id'         => 'is_video',
			'type'             => 'radio',
			'show_option_none' => false,
			'options'          => array(
				'0' => __('Image', 'Minimal-Artistic-Portfolio'),
				'1'   => __('Video', 'Minimal-Artistic-Portfolio'),
			),
		));
		$cmb->add_field(array(
			'name'    => __(
				'Video ID (leave empty if selfhosted)',
				'Minimal-Artistic-Portfolio'
			),
			'default' => '',
			'id'      => 'video_id',
			'type'    => 'text',
		));
		$cmb->add_field(array(
			'name'    => __('Video provider', 'Minimal-Artistic-Portfolio'),
			'id'      => 'video_provider',
			'type'    => 'radio_inline',
			'options' => array(
				'vimeo'   => __('Vimeo', 'Minimal-Artistic-Portfolio'),
				'youtube' => __('YouTube', 'Minimal-Artistic-Portfolio'),
				'self'    => __('Self hosted', 'Minimal-Artistic-Portfolio'),
			),
		));
		$cmb->add_field(array(
			'name' => __('Self hosting URLs', 'Minimal-Artistic-Portfolio'),
			'type' => 'title',
			'id'   => 'selfhosted_title'
		));
		$cmb->add_field(array(
			'name' => __('576P', 'Minimal-Artistic-Portfolio'),
			'id'   => '576p_video_url',
			'type' => 'text_url',
		));
		$cmb->add_field(array(
			'name' => __('720p', 'Minimal-Artistic-Portfolio'),
			'id'   => '720p_video_url',
			'type' => 'text_url',
		));
		$cmb->add_field(array(
			'name' => __('1080p', 'Minimal-Artistic-Portfolio'),
			'id'   => '1080p_video_url',
			'type' => 'text_url',
		));
	}
);

// External gallery
add_action(
	'cmb2_admin_init',
	function () {
		$cmb = new_cmb2_box(array(
			'id'            => 'ext_gallery_metabox',
			'title'         => __('External gallery', 'Minimal-Artistic-Portfolio'),
			'object_types'  => array('project',),
			'context'       => 'normal',
			'priority'      => 'high',
		));

		$cmb->add_field(array(
			'name'       => __('HTML markup', 'Minimal-Artistic-Portfolio'),
			'id'         => 'ext_gallery',
			'type'       => 'textarea',
			'render_row_cb' => function ($field_args, $field) {
				$id          = $field->args('id');
				$label       = $field->args('name');
				$name        = $field->args('_name');
				$value       = $field->escaped_value();
?>
		<div class="custom-field-row">
			<p><label for="<?php echo $id; ?>"><?php echo $label; ?></label></p>
			<textarea style="width: 100%;"
				rows="12"
				id="<?php echo $id; ?>"
				name="<?php echo $name; ?>"><?php echo $value; ?></textarea>
		</div>
	<?php
			}
		));
	}
);


// Cartel section
add_action(
	'cmb2_admin_init',
	function () {
		$cmb = new_cmb2_box(array(
			'id'            => 'cartel_section_metabox',
			'title'         => __('Cartel', 'Minimal-Artistic-Portfolio'),
			'object_types'  => array('project',),
			'context'       => 'side',
			'priority'      => 'high',
		));
		$cmb->add_field(array(
			'name'    => '', // __('Cartel', 'Minimal-Artistic-Portfolio'),
			'id'      => 'cartel',
			'type'    => 'textarea',
		));
	}
);


// Linked event
add_action(
	'cmb2_admin_init',
	function () {
		$cmb = new_cmb2_box(array(
			'id'            => 'shown_at_metabox',
			'title'         => __('Event', 'Minimal-Artistic-Portfolio'),
			'object_types'  => array('project',),
			'context'       => 'side',
			'priority'      => 'high',
		));
		$cmb->add_field(array(
			'name'    => __('Choose from existing event', 'Minimal-Artistic-Portfolio'),
			'id'      => 'event',
			'type'    => 'multicheck',
			'render_row_cb' => function ($field_args, $field) {
				$id          = $field->args('id');
				$label       = $field->args('name');
				$name        = $field->args('_name');
				$value       = $field->escaped_value();
				$saved_event_id     = array_map('intval', (array)$value);
				$query_event_args = array(
					'post_type'      => 'event',
					'posts_per_page' => -1, // phpcs:ignore WPThemeReview.CoreFunctionality.PostsPerPage.posts_per_page_posts_per_page
				);
				$query_event      = new WP_Query($query_event_args);
				foreach ($query_event->posts as $event) {
					$event_title = get_the_title($event->ID);
					if (is_array($saved_event_id) && in_array($event->ID, $saved_event_id, true)) {
						echo '<input type="checkbox" name="event[]" value="' . esc_attr($event->ID) . '" checked>' . esc_html($event_title) . '<br>';
					} else {
						echo '<input type="checkbox" name="event[]" value="' . esc_attr($event->ID) . '">' . esc_html($event_title) . '<br>';
					}
				}
				echo '<div class="event_count"><span>Total:</span> <b>' . esc_attr(count($saved_event_id)) . '</b></div>';
			}
		));
	}
);

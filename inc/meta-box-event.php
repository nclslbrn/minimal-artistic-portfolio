<?php

/**
 * Functions to get and save custom metadata
 *
 * Event has a begin and end date, a place, a lattitude and a lontitude
 *
 * @package Minimal-Artistic-Portfolio.
 * @version 1.0.0.
 */

/**
 * Add every metabox to project post
 */

// Date options
add_action(
	'cmb2_admin_init',
	function () {
		$cmb = new_cmb2_box(array(
			'id'            => 'event_metabox',
			'title'         => __('Event', 'Minimal-Artistic-Portfolio'),
			'object_types'  => array('event'),
			'context'       => 'normal',
			'priority'      => 'high',
		));

		$cmb->add_field(array(
			'name' 		  => __('Begin date', 'Minimal-Artistic-Portfolio'),
			'id'   		  => 'begin_date',
			'type' 		  => 'text_date',
			'date_format' => 'Y-m-d',
		));

		$cmb->add_field(array(
			'name' 		  => __('End date', 'Minimal-Artistic-Portfolio'),
			'id'   		  => 'end_date',
			'type' 		  => 'text_date',
			'date_format' => 'Y-m-d',
		));

		$cmb->add_field( array(
			'name'    => __('Place', 'Minimal-Artistic-Portfolio'),
			'default' => '',
			'id'      => 'place',
			'type'    => 'text',
		));

		$cmb->add_field( array(
			'name'    => __('Lattitude', 'Minimal-Artistic-Portfolio'),
			'default' => '',
			'id'      => 'latt',
			'type'    => 'text',
		));

		$cmb->add_field( array(
			'name'    => __('Longitude', 'Minimal-Artistic-Portfolio'),
			'default' => '',
			'id'      => 'long',
			'type'    => 'text',
		));
	}
);



/**
 * Add column header to admin event list
 *
 * @param array $defaults the current columns.
 * @return array $defaults the modified columns.
 */
function map_event_table_head($defaults)
{
	unset($defaults['categories']);
	unset($defaults['date']);
	$defaults['event_date'] = __('Date', 'Minimal-Artistic-Portfolio');
	$defaults['place']      = __('Place', 'Minimal-Artistic-Portfolio');
	return $defaults;
}
add_filter('manage_event_posts_columns', 'map_event_table_head');

/**
 * Add column content (relative to column header above)
 *
 * @param string $column_name the id/slug of the column.
 * @param int    $post_id the event post id.
 */
function map_event_table_content($column_name, $post_id)
{
	if ('event_date' === $column_name) {
		echo esc_html(date_i18n('j F Y', strtotime(get_post_meta($post_id, 'begin_date', 'true'))));
	}

	if ('place' === $column_name) {
		$place = get_post_meta($post_id, 'place', true);
		echo esc_html($place);
	}
}
add_action('manage_event_posts_custom_column', 'map_event_table_content', 10, 2);



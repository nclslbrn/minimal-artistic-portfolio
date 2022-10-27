<?php
/**
 * Add a list of project dynamicly (order by descending year) in wp_nav_menu
 *
 * @package Minimal-Artistic-Portfolio
 * @version 7.4.3
 */

add_filter( 'wp_nav_menu_objects', 'map_dynamic_project_menu', 10, 2 );

/**
 * Add custom post project list
 *
 * The nav menu has to be called with 'add_project_list' => true.
 * Example:
 * wp_nav_menu(
 *  array(
 *      'theme_location' => 'primary',
 *      'add_project_list' => TRUE
 *  )
 * );
 *
 * @param   array  $sorted_menu_items Existing menu items.
 * @param   object $args Nav menu arguments as object.
 * 
 * @return  array
 */
function map_dynamic_project_menu( $sorted_menu_items, $args ) {
	if ( ! isset( $args->add_project_list ) || ! $args->add_project_list ) {
		return $sorted_menu_items;
	}
	$projects = get_posts(
		array(
			'post_type'        => 'project',
			'orderby'          => 'date',
			'order'            => 'DESC',
			'numberposts'      => -1,
		) 
	);

	if ( empty( $projects ) ) {
		return $sorted_menu_items;
	} 
	$project_list = array();
	global $post;
	$current_post_id = $post->ID;
	foreach ( $projects as $project ) {
		$year = date( 'Y', strtotime( $project->post_date ) );
		
		$item                   = wp_setup_nav_menu_item( $project );
		$item->menu_item_parent = $project->post_parent;
		$item->db_id            = $project->ID;

		if ( ! isset( $project_list[ $year ] ) ) {
			$project_list[ $year ] = array( $item );
		} else {
			$project_list[ $year ][] = $item;
		}
	}

	$new_menu    = array();
	$menu_order  = 1;
	$year_obj_id = 999999;
	foreach ( $sorted_menu_items as $item ) {
		if ( 'Projets' === $item->title || 'Works' === $item->title ) {
			$item->menu_order = $menu_order;
			$project_entry_id = $item->db_id;
			$new_menu[]       = $item;
			$menu_order++;

			foreach ( $project_list as $year => $year_projects ) {
				if ( $args->wrap_into_year ) {
					$year_item                   = new stdClass();
					$year_item->ID               = -1;
					$year_item->db_id            = $year_obj_id;
					$year_item->title            = $year;
					$year_item->menu_order       = $menu_order;
					$year_item->menu_item_parent = $project_entry_id;
					$year_item->xfn              = '';
					$year_item->status           = '';
					$year_item->url              = '#';
					$year_item->target           = false;
					$year_item->current          = false;

					$new_menu[]      = $year_item;
					$year_menu_entry = $year_obj_id;
					$year_obj_id++;
					$menu_order++;
				}

				foreach ( $year_projects as $project ) {
					$project_item = wp_setup_nav_menu_item( $project );
				
					$project_item->menu_order       = $menu_order;
					$project_item->menu_item_parent = $args->wrap_into_year ? $year_menu_entry : $project_entry_id;
					$project_item->current          = $project->ID === $current_post_id;
					$new_menu[]                     = $project_item;
					$menu_order++;
				}           
			}
		} else {
			$item->menu_order = $menu_order;
			$new_menu[]       = $item;
			$menu_order++;
		}   
	} 

	return $new_menu;
}

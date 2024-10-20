<?php

/**
 * Main post type functions
 *
 * Create, orders, query allow three new post types (project, event & Gif)
 *
 * @package Minimal-Artistic-Portfolio
 * @version 1.0.0
 */

/**
 * Add project, event & gif custom post
 */
function map_create_post_types()
{ // phpcs:ignore
	register_post_type(  // phpcs:ignore
		'project',
		array(
			'labels'              => array(
				'name'               => _x('Projects', 'post type general name', 'Minimal-Artistic-Portfolio'),
				'singular_name'      => _x('Project', 'post type singular name', 'Minimal-Artistic-Portfolio'),
				'menu_name'          => __('Projects', 'Minimal-Artistic-Portfolio'),
				'name_admin_bar'     => __('Project', 'Minimal-Artistic-Portfolio'),
				'add_new'            => __('Add New', 'Minimal-Artistic-Portfolio'),
				'add_new_item'       => __('Add New Project', 'Minimal-Artistic-Portfolio'),
				'new_item'           => __('New Project', 'Minimal-Artistic-Portfolio'),
				'edit_item'          => __('Edit Project', 'Minimal-Artistic-Portfolio'),
				'view_item'          => __('View Project', 'Minimal-Artistic-Portfolio'),
				'all_items'          => __('All Projects', 'Minimal-Artistic-Portfolio'),
				'search_items'       => __('Search Projects', 'Minimal-Artistic-Portfolio'),
				'parent_item_colon'  => __('Parent Projects:', 'Minimal-Artistic-Portfolio'),
				'not_found'          => __('No projects found.', 'Minimal-Artistic-Portfolio'),
				'not_found_in_trash' => __('No projects found in Trash.', 'Minimal-Artistic-Portfolio'),
			),
			'can_export'          => true,
			'public'              => true,
			'exclude_from_search' => false,
			'query_var'           => true,
			'publicly_queryable'  => true,
			'_builtin'            => false,
			'capability_type'     => 'post',
			'has_archive'         => true,
			'hierarchical'        => false,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-lightbulb',
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => true,
			'supports'            => array('title', 'editor', 'revisions', 'thumbnail', 'custom-fields'),
			'taxonomies'          => array('category', 'post_tag'),
		)
	);
	// phpcs:ignore
	register_post_type(
		'event',
		array(
			'labels'              => array(
				'name'               => _x('Events', 'post type general name', 'Minimal-Artistic-Portfolio'),
				'singular_name'      => _x('Event', 'post type singular name', 'Minimal-Artistic-Portfolio'),
				'menu_name'          => __('Events', 'Minimal-Artistic-Portfolio'),
				'name_admin_bar'     => __('Event', 'Minimal-Artistic-Portfolio'),
				'add_new'            => __('Add New', 'Minimal-Artistic-Portfolio'),
				'add_new_item'       => __('Add New Event', 'Minimal-Artistic-Portfolio'),
				'new_item'           => __('New Event', 'Minimal-Artistic-Portfolio'),
				'edit_item'          => __('Edit Event', 'Minimal-Artistic-Portfolio'),
				'view_item'          => __('View Event', 'Minimal-Artistic-Portfolio'),
				'all_items'          => __('All Events', 'Minimal-Artistic-Portfolio'),
				'search_items'       => __('Search Events', 'Minimal-Artistic-Portfolio'),
				'parent_item_colon'  => __('Parent Events:', 'Minimal-Artistic-Portfolio'),
				'not_found'          => __('No events found.', 'Minimal-Artistic-Portfolio'),
				'not_found_in_trash' => __('No events found in Trash.', 'Minimal-Artistic-Portfolio'),
			),
			'can_export'          => true,
			'public'              => true,
			'exclude_from_search' => false,
			'query_var'           => true,
			'publicly_queryable'  => true,
			'_builtin'            => false,
			'capability_type'     => 'post',
			'has_archive'         => true,
			'hierarchical'        => false,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-calendar',
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => true,
			'supports'            => array('title', 'editor', 'revisions', 'thumbnail', 'custom-fields'),
			'taxonomies'          => array('category', 'post_tag'),
		)
	);
	// phpcs:ignore
	register_post_type(
		'gif',
		array(
			'labels'              => array(
				'name'               => _x('Gif', 'post type general name', 'Minimal-Artistic-Portfolio'),
				'singular_name'      => _x('Gif', 'post type singular name', 'Minimal-Artistic-Portfolio'),
				'menu_name'          => __('Gifs', 'Minimal-Artistic-Portfolio'),
				'name_admin_bar'     => __('Gif', 'Minimal-Artistic-Portfolio'),
				'add_new'            => __('Add New', 'Minimal-Artistic-Portfolio'),
				'add_new_item'       => __('Add New Gif', 'Minimal-Artistic-Portfolio'),
				'new_item'           => __('New Gif', 'Minimal-Artistic-Portfolio'),
				'edit_item'          => __('Edit Gif', 'Minimal-Artistic-Portfolio'),
				'view_item'          => __('View Gif', 'Minimal-Artistic-Portfolio'),
				'all_items'          => __('All Gifs', 'Minimal-Artistic-Portfolio'),
				'search_items'       => __('Search Gifs', 'Minimal-Artistic-Portfolio'),
				'parent_item_colon'  => __('Parent Gifs:', 'Minimal-Artistic-Portfolio'),
				'not_found'          => __('No gifs found.', 'Minimal-Artistic-Portfolio'),
				'not_found_in_trash' => __('No gifs found in Trash.', 'Minimal-Artistic-Portfolio'),
			),
			'can_export'          => true,
			'public'              => true,
			'exclude_from_search' => true,
			'query_var'           => false,
			'publicly_queryable'  => false,
			'_builtin'            => false,
			'capability_type'     => 'post',
			'rewrite'             => array(
				'slug'       => 'gif',
				'with_front' => false,
			),
			'has_archive'         => false,
			'hierarchical'        => false,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-images-alt2',
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => true,
			'supports'            => array('title', 'thumbnail'),
			'taxonomies'          => array(),
		)
	);
	// phpcs:ignore
	register_taxonomy(
		__('category', 'Minimal-Artistic-Portfolio'),
		array('post', 'page', 'project', 'event'),
		array(
			'hierarchical' => true,
			'label'        => 'Category',
			'query_var'    => true,
			'rewrite'      => true,
		)
	);
	// phpcs:ignore
	register_taxonomy('post_tag', array('post', 'page', 'project', 'event'));

}

add_action('init', 'map_create_post_types');
/**
 * List custom post types name
 *
 * @return array the list of every public post type name
 */
function map_list_content_type_name()
{
	$post_type = get_post_types(array('public' => true));
	return $post_type;
}

/**
 * Add custom post to main & tax query
 *
 * @param object $query global WP_Query.
 */
function map_add_post_types_to_queries($query)
{
	$post_types = map_list_content_type_name();

	if ((is_home() && $query->is_main_query()) || is_feed()) {
		$query->set('post_type', $post_types);
		return $query;
	}
	if (is_category() || is_tag() && empty($query->query_vars['suppress_filters'])) {
		$query->set('post_type', $post_types);
		return $query;
	}
	return $query;
}
add_filter('pre_get_posts', 'map_add_post_types_to_queries');

/**
 * Query post type loop
 *
 * @param string $type the custom post type name to query.
 */
function map_list_custom_posts($type)
{
	$posts_per_page = get_option('posts_per_page');

	$project_query_args = array(
		'post_type'      => $type,
		'post_status'    => 'publish',
		'posts_per_page' => $posts_per_page,
	);
	$paged              = 1;

	if (-1 !== $posts_per_page) {
		if (get_query_var('paged')) {
			$paged = get_query_var('paged');
		} elseif (get_query_var('page')) {
			$paged = get_query_var('page');
		}
		$project_query_args['paged']          = $paged;
		$project_query_args['posts_per_page'] = $posts_per_page;
	}
	$project_query = new WP_Query($project_query_args);

	if ($project_query->have_posts()) {
		while ($project_query->have_posts()) {
			global $post;
			$project_query->the_post();

			get_template_part('template-parts/content', 'project');
		}
		if ($project_query->max_num_pages > 1 && -1 !== $posts_per_page) {
			$current_page = max(1, get_query_var('page'));
			echo '<nav class=\'page-nav\'>';
			echo wp_kses_post(
				paginate_links(
					array(
						'prev_next' => false,
						'current'   => $paged,
						'total'     => $project_query->max_num_pages,
					)
				)
			);
			echo '</nav><!-- .page-nav -->';
		}
	}
}
/**
 * List every events related to a project
 *
 * @param int $post_id the ID of the project.
 * @return string|boolean HTML list of events links or false if no event found.
 */
function map_get_event($post_id)
{
	global $wp_query;
	$events              = get_post_meta($post_id, 'event');
	$event_module        = '';
	$event_module_result = '';

	if (! empty($events[0])) {
		$event_module .= '<p class="list-title">' . __('Events', 'Minimal-Artistic-Portfolio') . '</p>';

		foreach ((array) $events[0] as $event) {
			$title = get_the_title($event);
			$url   = get_permalink($event);

			$event_module_result .= '
                <li>
                    <a href="' . esc_url($url) . '">' . esc_html($title) . '</a>
                </li>';
			// <meta property="event" content="' . esc_attr( $title ) . '"/>.
		}
		$event_module = $event_module . '<ul class=\'related-events\'>' . $event_module_result . '</ul>';
	}
	if (empty($events[0])) {
		return false;
	} elseif (! empty($event_module_result)) {
		return $event_module;
	}
}

/**
 * Query all project related to an event
 *
 * @param int $post_id the ID of the event.
 * @return string|boolean HTML list of projects links or false if no event found.
 */
function map_get_project($post_id)
{
	$projects       = '';
	$project_module = '';
	$project_query  = new WP_Query(
		array(
			'post_type'      => 'project',
			'post_status'    => 'publish',
			'posts_per_page' => -1, //phpcs:ignore WPThemeReview.CoreFunctionality.PostsPerPage.posts_per_page_posts_per_page
			'meta_query'     => array( //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				array(
					'key'     => 'event',
					'value'   => $post_id,
					'compare' => 'LIKE',
				),
			),
		)
	);

	if (! empty($project_query->posts)) {
		$project_module .= '<p class="list-title">' . __('Projects', 'Minimal-Artistic-Portfolio') . '</p>';

		foreach ((array) $project_query->posts as $project) {
			$url       = get_permalink($project->ID);
			$projects .= '<li><a href="' . esc_url($url) . '">' . $project->post_title . '</a></li>';
		}
	}
	if (! empty($projects)) {
		$project_module = $project_module . '<ul class="related-projects">' . $projects . '</ul>';
		return $project_module;
	} else {
		return false;
	}
}

/**
 * List posts by date/year (from newer to older)
 *
 * @param string $type post type name.
 * @param int    $limit how many post query.
 */
function map_list_posts_by_years($type, $limit)
{
	$post_year       = '';
	$current_post_id = get_the_ID();
	$post_year       = date_i18n('Y', strtotime(get_post_meta($current_post_id, 'begin_date', true)));

	wp_reset_postdata();

	$args  = array(
		'post_type'      => $type,
		'posts_per_page' => $limit,
		'meta_key'       => 'begin_date', //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
		'orderby'        => 'meta_value',
		'order'          => 'DESC',
		'meta_query'     => array( //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			array(
				'key'     => 'begin_date',
				'compare' => 'LIKE',
			),
		),
	);
	$posts = new WP_Query($args);

	if ($posts->have_posts()) :
		$map_data     = array();
		$post_by_year = array();

		while ($posts->have_posts()) :

			global $post;
			$posts->the_post();
			$current_year                    = date_i18n('Y', strtotime(get_post_meta($post->ID, 'begin_date', true)));
			$post_by_year[$current_year][] = $post;

		endwhile;

		foreach ($post_by_year as $year => $posts) : ?>

			<section class="events-year">
				<h2 class="year"><?php echo esc_attr($year); ?></h2><!-- .year -->
				<ul class="year-events-list">
					<?php foreach ($posts as $post) : // phpcs:ignore
					?>
						<?php
						$map_data[] = array(
							'link'     => get_permalink($post->ID),
							'title'    => get_the_title($post->ID),
							'latt'     => get_post_meta($post->ID, 'latt', true),
							'long'     => get_post_meta($post->ID, 'long', true),
						);
						?>
						<li><?php get_template_part('template-parts/content', 'event'); ?></li>

					<?php endforeach; ?>
				</ul><!-- .year-events-list -->
			</section><!-- .events-year -->
		<?php endforeach; ?>

		<script>
			window.eventsMapData = <?php echo json_encode($map_data); //phpcs:ignore WordPress.WP.AlternativeFunctions.json_encode_json_encode
															?>;
		</script>
		<?php wp_reset_postdata(); ?>
	<?php
	endif;
}
/**
 * Add single image or gallery related to a post
 *
 * @param int $post_id the post which we will query attachement.
 * @return int the attachement count.
 */
function map_get_media($post_id)
{
	$attachments = get_posts(
		array(
			'order_by'       => 'menu_order',
			'order'          => 'ASC',
			'post_type'      => 'attachment',
			'posts_per_page' => -1, // phpcs:ignore WPThemeReview.CoreFunctionality.PostsPerPage.posts_per_page_posts_per_page,
			'post_parent'    => $post_id,
		)
	);

	if ($attachments) {
		$count = count($attachments);

		if (1 === $count) {
			$class    = 'post-attachment mime-' . sanitize_title($attachments[0]->post_mime_type);
			$thumbimg = wp_get_attachment_image($attachments[0]->ID, 'thumbnail-size');
			echo '<div class="' . esc_attr($class) . 'single-image">' . wp_kses_post($thumbimg) . '</div>';
			return $count;
		}
		if ($count > 1) {
			echo '<div class="gallery">';
			foreach ($attachments as $attachment) {
				$class    = 'post-attachment mime-' . sanitize_title($attachment->post_mime_type);
				$thumbimg = wp_get_attachment_image($attachment->ID, 'full');
				echo wp_kses_post($thumbimg);
			}
			echo '</div><!-- .aap-gallery -->';
			return $count;
		}
	}
}
/**
 * Remove gallery and html tag from content
 *
 * @param string $content the post_content to clean.
 * @return string $content the post_content cleaned.
 */
function map_strip_shortcode_gallery($content)
{
	preg_match_all('/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER);
	if (! empty($matches)) {
		foreach ($matches as $shortcode) {
			if ('gallery' === $shortcode[2]) {
				$pos = strpos($content, $shortcode[0]);
				if (false !== $pos) {
					return substr_replace($content, '', $pos, strlen($shortcode[0]));
				}
			}
		}
	}
	return $content;
}

/**
 * Add next or current events on home
 * @param $post {object} the WP global post object
 */
function map_contextully_load_last_event()
{
	$next_events = new WP_Query(
		array(
			'post_type'          => 'event',
			'post_status'        => 'publish',
			'posts_per_page'     => -1, // phpcs:ignore WPThemeReview.CoreFunctionality.PostsPerPage.posts_per_page_posts_per_page,
			'orderby'            => 'ID',
			'order'              => 'ASC',
			'meta_query'         => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				array(
					'key'     => 'end_date',
					'value'   => date('Y-m-d'),
					'compare' => '>',
				),
			),
		)
	);
	if ($next_events->have_posts()) :
	?>
		<header class="entry-header next-events">
			<h2 class="entry-title"><?php echo esc_html(__('Coming soon / Now', 'Minimal-Artistic-Portfolio')); ?></h2>
		</header>
		<div class="entry-content">
			<?php while ($next_events->have_posts()) : ?>

				<?php global $post; ?>
				<?php $next_events->the_post(); ?>
				<?php get_template_part('template-parts/content', 'event'); ?>

			<?php endwhile; ?>
		</div>
	<?php endif; ?>
<?php wp_reset_postdata();
}
/**
 * Show custom post in the at a glance admin widget
 */
function map_at_glance_content_table_end()
{
	$args     = array(
		'public'   => true,
		'_builtin' => false,
	);
	$output   = 'object';
	$operator = 'and';

	$post_types = get_post_types($args, $output, $operator);
	foreach ($post_types as $post_type) {
		$num_posts = wp_count_posts($post_type->name);
		$num       = number_format_i18n($num_posts->publish);

		$text = _n(
			$post_type->labels->singular_name, // phpcs:ignore
			$post_type->labels->name, // phpcs:ignore
			intval($num_posts->publish),
			'Minimal-Artistic-Portfolio'
		);
		if (current_user_can('edit_posts')) {
			$output  = '<a href="edit.php?post_type=' . esc_attr($post_type->name) . '">';
			$output .= esc_html($num . ' ' . $text);
			$output .= '</a>';

			echo '<li class="post-count ' . esc_attr($post_type->name) . '-count">' . wp_kses_post($output) . '</li>';
		}
	}
}
add_action('dashboard_glance_items', 'map_at_glance_content_table_end');



/**
 * Unregister the default activity widget
 */
function map_remove_dashboard_widgets()
{
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
}
add_action('wp_dashboard_setup', 'map_remove_dashboard_widgets');

/**
 * Register your custom activity widget
 */
function map_add_custom_dashboard_activity()
{
	wp_add_dashboard_widget('custom_dashboard_activity', 'Activities', 'map_dashboard_site_activity');
}
add_action('wp_dashboard_setup', 'map_add_custom_dashboard_activity');

/**
 * The new function based on wp_dashboard_recent_posts
 * (in wp-admin/includes/dashboard.php)
 *
 * @param array $args query post arguments.
 */
function map_dashboard_recent_post_types($args)
{
	if (! $args['post_type']) {
		$args['post_type'] = 'any';
	}

	$query_args = array(
		'post_type'       => $args['post_type'],
		'post_status'     => $args['status'],
		'orderby'         => 'date',
		'order'           => $args['order'],
		'posts_per_page'  => intval($args['max']), // phpcs:ignore
		'no_found_rows'   => true,
		'cache_results'   => false,
	);
	$posts      = new WP_Query($query_args);

	if ($posts->have_posts()) {
		echo '<div id="' . esc_attr($args['id']) . '" class="activity-block">';

		echo '<h4>' . esc_html($args['title']) . '</h4>';

		echo '<ul>';

		$i = 0;
		//phpcs:ignore
		$today    = date('Y-m-d', current_time('timestamp'));
		//phpcs:ignore
		$tomorrow = date('Y-m-d', strtotime('+1 day', current_time('timestamp')));

		while ($posts->have_posts()) {
			$posts->the_post();

			$time = get_the_time('U');
			if (date('Y-m-d', $time) === $today) {
				$relative = __('Today', 'Minimal-Artistic-Portfolio');
			} elseif (date('Y-m-d', $time) === $tomorrow) {
				$relative = __('Tomorrow', 'Minimal-Artistic-Portfolio');
			} else {
				/* translators: date and time format for recent posts on the dashboard, see http://php.net/date */
				$relative = date_i18n('j F Y', $time);
			}

			$text = sprintf(
				/* translators: 1: relative date, 2: time, 4: post title */
				__('<span>%1$s, %2$s</span> <a href="%3$s">%4$s</a>', 'Minimal-Artistic-Portfolio'),
				$relative,
				get_the_time(),
				get_edit_post_link(),
				_draft_or_post_title()
			);

			$hidden = $i >= $args['display'] ? ' class="hidden"' : '';
			echo wp_kses_post("<li{$hidden}>$text</li>");
			$i++;
		}

		echo '</ul>';
		echo '</div>';
	} else {
		return false;
	}

	wp_reset_postdata();

	return true;
}

/**
 * The replacement widget
 */
function map_dashboard_site_activity()
{
	echo '<div id="activity-widget">';

	$future_posts = map_dashboard_recent_post_types(
		array(
			'post_type' => 'any',
			'display'   => 3,
			'max'       => 7,
			'status'    => 'future',
			'order'     => 'ASC',
			'title'     => __('Publishing Soon', 'Minimal-Artistic-Portfolio'),
			'id'        => 'future-posts',
		)
	);

	$recent_posts = map_dashboard_recent_post_types(
		array(
			'post_type' => 'any',
			'display'   => 3,
			'max'       => 7,
			'status'    => 'publish',
			'order'     => 'DESC',
			'title'     => __('Recently Published', 'Minimal-Artistic-Portfolio'),
			'id'        => 'published-posts',
		)
	);

	$recent_comments = wp_dashboard_recent_comments(10);

	if (! $future_posts && ! $recent_posts && ! $recent_comments) {
		echo '<div class="no-activity">';
		echo '<p class="smiley"></p>';
		echo '<p>' . esc_html(__('No activity yet!', 'Minimal-Artistic-Portfolio')) . '</p>';
		echo '</div>';
	}

	echo '</div>';
}

/**
 * Show post thumbnails in feed
 *
 * @param string $content the post excerpt or post_content.
 * @return string $content with the featured image.
 */
function map_post_thumbnail_feeds($content)
{
	global $post;
	if (has_post_thumbnail($post->ID)) {
		$content = '<div>' . get_the_post_thumbnail($post->ID) . '</div>' . $content;
	}
	return $content;
}
add_filter('the_excerpt_rss', 'map_post_thumbnail_feeds');
add_filter('the_content_feed', 'map_post_thumbnail_feeds');


?>

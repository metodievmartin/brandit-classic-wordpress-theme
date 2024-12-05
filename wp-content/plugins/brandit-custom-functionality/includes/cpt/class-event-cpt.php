<?php

// Exit if this file accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Event_CPT {

	// ========== Constants ==========

	// Custom Post Types
	protected const EVENT_CPT = 'event';

	private static $instance = null;

	/**
	 * Get the singleton instance of the plugin.
	 *
	 * @return Event_CPT
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	// ========== Constructor ==========

	private function __construct() {
		//	Creates Custom Post Types
		add_action( 'init', array( $this, 'register_event_post_type' ) );

		// Adjust the 'event' main query
		add_action( 'pre_get_posts', array( $this, 'adjust_event_queries' ) );
	}

	// ========== Getters ==========

	function get_events( $query_args = array() ) {
		// Set default arguments
		$today          = date( 'Ymd' );
		$query_defaults = array(
			'post_type'      => 'event',
			'posts_per_page' => 2,
			'meta_key'       => 'event_date',
			'orderby'        => 'meta_value_num',
			'order'          => 'ASC',
			'meta_query'     => array(
				array(
					'key'     => 'event_date',
					'compare' => '>=',
					'value'   => $today,
					'type'    => 'NUMERIC'
				)
			)
		);

		$parsed_query_args = wp_parse_args( $query_args, $query_defaults );

		// default overwrite for event post type
		$parsed_query_args['post_type'] = self::EVENT_CPT;

		// Perform the query
		return new WP_Query( $parsed_query_args );
	}

	// ========== Setup Methods (Hook callbacks) ==========

	function register_event_post_type() {
		register_post_type( self::EVENT_CPT, array(
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields' ),
			'menu_icon'          => 'dashicons-calendar',
			'rewrite'            => array( 'slug' => 'events' ),
			'has_archive'        => true,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'can_export'         => true,
			'labels'             => array(
				'name'                     => __( 'Events', 'bcpt-domain' ),
				'singular_name'            => __( 'Event', 'bcpt-domain' ),
				'add_new'                  => __( 'Add New', 'bcpt-domain' ),
				'add_new_item'             => __( 'Add New Event', 'bcpt-domain' ),
				'edit_item'                => __( 'Edit Event', 'bcpt-domain' ),
				'new_item'                 => __( 'New Event', 'bcpt-domain' ),
				'view_item'                => __( 'View Event', 'bcpt-domain' ),
				'view_items'               => __( 'View Events', 'bcpt-domain' ),
				'search_items'             => __( 'Search Events', 'bcpt-domain' ),
				'not_found'                => __( 'No events found.', 'bcpt-domain' ),
				'not_found_in_trash'       => __( 'No events found in trash.', 'bcpt-domain' ),
				'all_items'                => __( 'All Events', 'bcpt-domain' ),
				'archives'                 => __( 'Event Archives', 'bcpt-domain' ),
				'insert_into_item'         => __( 'Insert into Event', 'bcpt-domain' ),
				'uploaded_to_this_item'    => __( 'Uploaded to this Event', 'bcpt-domain' ),
				'filter_items_list'        => __( 'Filter Events list', 'bcpt-domain' ),
				'items_list_navigation'    => __( 'Events list navigation', 'bcpt-domain' ),
				'items_list'               => __( 'Events list', 'bcpt-domain' ),
				'item_published'           => __( 'Event published.', 'bcpt-domain' ),
				'item_published_privately' => __( 'Event published privately.', 'bcpt-domain' ),
				'item_reverted_to_draft'   => __( 'Event reverted to draft.', 'bcpt-domain' ),
				'item_scheduled'           => __( 'Event scheduled.', 'bcpt-domain' ),
				'item_updated'             => __( 'Event updated.', 'bcpt-domain' ),
			),
		) );
	}

	function adjust_event_queries( $query ) {
		if ( ! is_admin() && is_post_type_archive( 'event' ) && $query->is_main_query() ) {
			$today = date( 'Ymd' );
			$query->set( 'meta_key', 'event_date' );
			$query->set( 'orderby', 'meta_value_num' );
			$query->set( 'order', 'ASC' );
			$query->set( 'meta_query', array(
				array(
					'key'     => 'event_date',
					'compare' => '>=',
					'value'   => $today,
					'type'    => 'NUMERIC'
				)
			) );
		}
	}

}
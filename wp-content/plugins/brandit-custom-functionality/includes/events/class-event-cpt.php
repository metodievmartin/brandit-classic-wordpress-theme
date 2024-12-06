<?php

// Exit if this file accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Event_CPT {

	private static $instance = null;
	private $cpt_slug;

	/**
	 * Initialises the functionality and makes sure it's done only once.
	 *
	 * @return Event_CPT
	 */
	public static function init( $cpt_slug ) {
		if ( null === self::$instance ) {
			self::$instance = new self( $cpt_slug );
		}

		return self::$instance;
	}

	/**
	 * Get the singleton instance of the plugin.
	 *
	 * @return Event_CPT|null
	 */
	public static function get_instance() {
		return self::$instance;
	}

	// ========== Constructor ==========

	private function __construct( $cpt_slug ) {
		$this->cpt_slug = $cpt_slug;

		// Init functionality
		$this->initialise();
	}

	private function initialise() {
		//	Creates Custom Post Types
		add_action( 'init', array( $this, 'register_event_post_type' ) );

		// Adjust the 'event' main query
		add_action( 'pre_get_posts', array( $this, 'adjust_event_queries' ) );
	}


	// ========== Setup Methods (Hook callbacks) ==========

	function register_event_post_type() {
		$labels_args = array(
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
			'filter_items_list'        => __( 'Filter Events list', 'bcpt-domain' ),
			'items_list_navigation'    => __( 'Events list navigation', 'bcpt-domain' ),
			'items_list'               => __( 'Events list', 'bcpt-domain' ),
			'item_published'           => __( 'Event published.', 'bcpt-domain' ),
			'item_published_privately' => __( 'Event published privately.', 'bcpt-domain' ),
			'item_reverted_to_draft'   => __( 'Event reverted to draft.', 'bcpt-domain' ),
			'item_scheduled'           => __( 'Event scheduled.', 'bcpt-domain' ),
			'item_updated'             => __( 'Event updated.', 'bcpt-domain' ),
		);

		$cpt_args = array(
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
			'labels'             => $labels_args,
		);

		register_post_type( $this->cpt_slug, $cpt_args );
	}

	function adjust_event_queries( $query ) {
		if ( ! is_admin() && is_post_type_archive( $this->cpt_slug ) && $query->is_main_query() ) {
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
<?php

// Exit if this file accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Service_CPT {

	private static $instance = null;
	private $cpt_slug;

	/**
	 * Initialises the functionality and makes sure it's done only once.
	 *
	 * @return Service_CPT
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
	 * @return Service_CPT
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

	// ========== Init ==========

	private function initialise() {
		//	Creates Custom Post Types
		add_action( 'init', array( $this, 'register_service_post_type' ) );
	}

	// ========== Setup Methods (Hook callbacks) ==========

	function register_service_post_type() {
		$label_args = array(
			'name'                     => __( 'Services', 'bcpt-domain' ),
			'singular_name'            => __( 'Service', 'bcpt-domain' ),
			'add_new'                  => __( 'Add New', 'bcpt-domain' ),
			'add_new_item'             => __( 'Add New Service', 'bcpt-domain' ),
			'edit_item'                => __( 'Edit Service', 'bcpt-domain' ),
			'new_item'                 => __( 'New Service', 'bcpt-domain' ),
			'view_item'                => __( 'View Service', 'bcpt-domain' ),
			'view_items'               => __( 'View Services', 'bcpt-domain' ),
			'search_items'             => __( 'Search Services', 'bcpt-domain' ),
			'not_found'                => __( 'No services found.', 'bcpt-domain' ),
			'not_found_in_trash'       => __( 'No services found in trash.', 'bcpt-domain' ),
			'all_items'                => __( 'All Services', 'bcpt-domain' ),
			'archives'                 => __( 'Service Archives', 'bcpt-domain' ),
			'filter_items_list'        => __( 'Filter Services list', 'bcpt-domain' ),
			'items_list_navigation'    => __( 'Services list navigation', 'bcpt-domain' ),
			'items_list'               => __( 'Services list', 'bcpt-domain' ),
			'item_published'           => __( 'Service published.', 'bcpt-domain' ),
			'item_published_privately' => __( 'Service published privately.', 'bcpt-domain' ),
			'item_reverted_to_draft'   => __( 'Service reverted to draft.', 'bcpt-domain' ),
			'item_scheduled'           => __( 'Service scheduled.', 'bcpt-domain' ),
			'item_updated'             => __( 'Service updated.', 'bcpt-domain' ),
		);

		$cpt_args = array(
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields' ),
			'menu_icon'          => 'dashicons-art',
			'rewrite'            => array( 'slug' => 'services' ),
			'has_archive'        => true,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_in_rest'       => true,
			'can_export'         => true,
			'labels'             => $label_args,
		);

		register_post_type( $this->cpt_slug, $cpt_args );
	}
}
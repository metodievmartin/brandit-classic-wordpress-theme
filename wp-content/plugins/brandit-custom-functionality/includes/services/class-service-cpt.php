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

		// Adjust the 'service' main query
		add_action( 'pre_get_posts', array( $this, 'adjust_services_query' ) );
	}

	// ========== Setup Methods (Hook callbacks) ==========

	function register_service_post_type() {
		$label_args = array(
			'name'                     => __( 'Services', 'bcf-domain' ),
			'singular_name'            => __( 'Service', 'bcf-domain' ),
			'add_new'                  => __( 'Add New', 'bcf-domain' ),
			'add_new_item'             => __( 'Add New Service', 'bcf-domain' ),
			'edit_item'                => __( 'Edit Service', 'bcf-domain' ),
			'new_item'                 => __( 'New Service', 'bcf-domain' ),
			'view_item'                => __( 'View Service', 'bcf-domain' ),
			'view_items'               => __( 'View Services', 'bcf-domain' ),
			'search_items'             => __( 'Search Services', 'bcf-domain' ),
			'not_found'                => __( 'No services found.', 'bcf-domain' ),
			'not_found_in_trash'       => __( 'No services found in trash.', 'bcf-domain' ),
			'all_items'                => __( 'All Services', 'bcf-domain' ),
			'archives'                 => __( 'Service Archives', 'bcf-domain' ),
			'filter_items_list'        => __( 'Filter Services list', 'bcf-domain' ),
			'items_list_navigation'    => __( 'Services list navigation', 'bcf-domain' ),
			'items_list'               => __( 'Services list', 'bcf-domain' ),
			'item_published'           => __( 'Service published.', 'bcf-domain' ),
			'item_published_privately' => __( 'Service published privately.', 'bcf-domain' ),
			'item_reverted_to_draft'   => __( 'Service reverted to draft.', 'bcf-domain' ),
			'item_scheduled'           => __( 'Service scheduled.', 'bcf-domain' ),
			'item_updated'             => __( 'Service updated.', 'bcf-domain' ),
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

	function adjust_services_query( $query ) {
		if ( ! is_admin() && is_post_type_archive( $this->cpt_slug ) && $query->is_main_query() ) {
			$query->set( 'posts_per_page', 6 ); // TODO: add this setting to the dashboard to dynamically control the number
		}
	}

}
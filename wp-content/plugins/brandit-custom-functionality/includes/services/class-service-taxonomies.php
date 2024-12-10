<?php

// Exit if this file accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Service_Taxonomies {

	// ========== Constants ==========

	const SERVICE_CATEGORY_SLUG = 'service_category';

	private static $instance = null;
	private $cpt_slug;

	/**
	 * Initialises the functionality and makes sure it's done only once.
	 *
	 * @return Service_Taxonomies
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
	 * @return Service_Taxonomies
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
		//	Creates Custom Taxonomies
		add_action( 'init', array( $this, 'create_service_taxonomies' ) );
	}

	// ========== Setup Methods (Hook callbacks) ==========

	function create_service_taxonomies() {
		$service_cat_labels = array(
			'name'              => __( 'Service Categories', 'bcf-domain' ),
			'singular_name'     => __( 'Service Category', 'bcf-domain' ),
			'search_items'      => __( 'Search Service Categories', 'bcf-domain' ),
			'all_items'         => __( 'All Service Categories', 'bcf-domain' ),
			'parent_item'       => __( 'Parent Service Category', 'bcf-domain' ),
			'parent_item_colon' => __( 'Parent Service Category:', 'bcf-domain' ),
			'edit_item'         => __( 'Edit Service Category', 'bcf-domain' ),
			'update_item'       => __( 'Update Service Category', 'bcf-domain' ),
			'add_new_item'      => __( 'Add New Service Category', 'bcf-domain' ),
			'new_item_name'     => __( 'New Service Category Name', 'bcf-domain' ),
			'menu_name'         => __( 'Service Categories', 'bcf-domain' ),
		);

		$service_cat_args = array(
			'labels'            => $service_cat_labels,
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'service-category' ),
		);

		// Register Service Categories
		register_taxonomy(
			self::SERVICE_CATEGORY_SLUG,
			$this->cpt_slug,
			$service_cat_args
		);
	}
}
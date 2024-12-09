<?php

class Service_Main {

	// ========== Constants ==========

	// Custom Post Type
	const SERVICE_CPT = 'service';

	// Database Option Names
	const OPTION_SERVICES_SHOWN_PER_PAGE = 'bcpt_services_shown_per_page';

	// Defaults
	const SERVICES_PER_PAGE_MAX = 30;
	const SERVICES_PER_PAGE_MIN = 1;
	const SERVICES_PER_PAGE_DEFAULT = 6;

	private static $instance = null;

	private $service_cpt;
	private $service_admin;

	// ========== Static Methods ==========

	/**
	 * Initialises the functionality and makes sure it's done only once.
	 *
	 * @return Service_Main
	 */
	public static function init() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Get the singleton instance of the plugin.
	 *
	 * @return Service_Main|null
	 */
	public static function get_instance() {
		return self::$instance;
	}

	// ========== Constructor ==========

	private function __construct() {
		$this->initialise();
	}

	// ========== Init ==========

	private function initialise() {
		//	Init Custom Post Types
		bcf_include( 'includes/services/class-service-cpt.php' );
		$service_cpt = Service_CPT::init( self::SERVICE_CPT );

		// Load the admin related functionality only when the dashboard is open
		if ( is_admin() ) {
			// Init the Admin Menu
			bcf_include( 'includes/services/class-service-cpt-admin.php' );
			$service_admin = Service_CPT_Admin::init( $this );
		}
	}

	// ========== Getters ==========

	function get_services_shown_per_page() {
		return get_option(
			self::OPTION_SERVICES_SHOWN_PER_PAGE,
			self::SERVICES_PER_PAGE_DEFAULT
		);
	}

	function get_services_query( $query_args = array() ) {
		// Set default arguments
		$query_defaults = array(
			'posts_per_page' => $this->get_services_shown_per_page(),
			'order'          => 'ASC',
			'orderby'        => 'menu_order',
		);

		$parsed_query_args = wp_parse_args( $query_args, $query_defaults );

		// default overwrite for service post type
		$parsed_query_args['post_type'] = self::SERVICE_CPT;

		// Perform the query
		return new WP_Query( $parsed_query_args );
	}
}
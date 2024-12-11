<?php

/*
 * Plugin Name: BrandIt Custom Functionality Plugin
 * Description: This plugin adds additional functionality and Custom Post Types like Services, etc.
 * Version: 1.0
 * Author: Martin Metodiev
 * Author URI: https://github.com/metodievmartin
 * Text Domain: bcpt-domain
 * Domain Path: /languages
 */

// Exit if this file accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class BrandIt_Custom_Functionality {

	private static $instance = null;

	private $is_plugin_initialised = false;

	public $service_main = null;
	public $event_main = null;
	public $contact_form_main = null;
	public $rest_main = null;

	/**
	 * Initialises the functionality and makes sure it's done only once.
	 *
	 * @return BrandIt_Custom_Functionality
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
	 * @return BrandIt_Custom_Functionality|null
	 */
	public static function get_instance() {
		return self::$instance;
	}

	/**
	 * Main constructor.
	 */
	private function __construct() {
		$this->initialise();
	}

	/**
	 * Initialise hooks and load dependencies.
	 */
	private function initialise() {
		// Define constants.
		$this->define( 'BRANDIT_CF', true );
		$this->define( 'BRANDIT_CF_DIR_PATH', plugin_dir_path( __FILE__ ) );
		$this->define( 'BRANDIT_CF_DIR_URL', plugin_dir_url( __FILE__ ) );
		$this->define( 'BRANDIT_CF_BASENAME', plugin_basename( __FILE__ ) );

		// Register activation hook.
		register_activation_hook( __FILE__, array( $this, 'bcf_plugin_activated' ) );

		// Include utility functions.
		include_once BRANDIT_CF_DIR_PATH . 'includes/bcf-utility-functions.php';

		// Include classes.
		// bcf_include( 'includes/core/class-base.php' );
		bcf_include( 'includes/services/class-service-main.php' );
		bcf_include( 'includes/events/class-event-main.php' );
		bcf_include( 'includes/rest/class-rest-main.php' );
		bcf_include( 'includes/contact-form/class-contact-form-main.php' );

		// Initialise Custom Post Types
		$this->init_custom_post_types();

		// Initialise Custom REST Endpoints
		$this->init_custom_rest_endpoints();

		$this->is_plugin_initialised = true;
	}

	/**
	 * Initialise Custom Post Types.
	 */
	private function init_custom_post_types() {
		$this->service_main      = Service_Main::init();
		$this->event_main        = Event_Main::init();
		$this->contact_form_main = Contact_Form_Main::init();
	}

	/**
	 * Initialise Custom REST Endpoints.
	 */
	private function init_custom_rest_endpoints() {
		$this->rest_main = Rest_Main::init();
	}

	public function is_initialised() {
		return $this->is_plugin_initialised;
	}

	/**
	 * Activation hook.
	 */
	public function bcf_plugin_activated() {
		flush_rewrite_rules();
	}

	/**
	 * Deactivation hook.
	 */
	public function bcf_plugin_deactivated() {
		flush_rewrite_rules();
	}

	/**
	 * Defines a constant if doesnt already exist.
	 *
	 * @param string $name The constant name.
	 * @param mixed $value The constant value.
	 *
	 * @return  void
	 */
	public function define( $name, $value = true ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}
}

/**
 * The main function responsible for initialising and returning the single BrandIt_Custom_Functionality Instance to functions everywhere.
 *
 * @return  BrandIt_Custom_Functionality
 */
function bcf_instance() {
	$bcf = BrandIt_Custom_Functionality::get_instance();

	if ( empty( $bcf ) ) {
		$bcf = BrandIt_Custom_Functionality::init();
	}

	return $bcf;
}

// Initialise the plugin
bcf_instance();

// Exposed functions

/**
 * Retrieves a query object with all available services.
 *
 * @param array $query_args Associative array of query arguments to customise the query.
 *
 * @return WP_Query Returns a `WP_Query` object containing the results of the query.
 */
function get_services_query( $query_args = array() ) {
	if ( ! isset( bcf_instance()->service_main ) ) {
		// returns an empty query object in case the services_cpt are not initialised
		return new WP_Query( array( 'post__in' => array( 0 ) ) );
	}

	return bcf_instance()->service_main->get_services_query( $query_args );
}

/**
 * Retrieves a query object with all available events.
 *
 * @param array $query_args Associative array of query arguments to customise the query.
 *
 * @return WP_Query Returns a `WP_Query` object containing the results of the query.
 */
function get_events_query( $query_args = array() ) {
	if ( ! isset( bcf_instance()->event_main ) ) {
		// returns an empty query object in case the services_cpt are not initialised
		return new WP_Query( array( 'post__in' => array( 0 ) ) );
	}

	return bcf_instance()->event_main->get_events_query( $query_args );
}

/**
 * Retrieves the event location name metadata for a given event ID.
 *
 * @param int $event_id The ID of the event.
 *
 * @return string The event location name, or an empty string if not found.
 */
function get_event_location_name( $event_id ) {
	if ( ! isset( bcf_instance()->event_main ) ) {
		return '';
	}

	return bcf_instance()->event_main->get_event_location_name( $event_id );
}

/**
 * Retrieves the Address URL metadata for a given event ID.
 *
 * @param int $event_id The ID of the event.
 *
 * @return string The event's Maps URL, or an empty string if not available.
 */
function get_event_address_url( $event_id ) {
	if ( ! isset( bcf_instance()->event_main ) ) {
		return '';
	}

	return bcf_instance()->event_main->get_event_address_url( $event_id );
}

/**
 * Retrieves the service category slug.
 *
 * @return string The service category slug if available; otherwise, an empty string.
 */
function get_service_category_slug() {
	if ( ! isset( bcf_instance()->service_main ) ) {
		return '';
	}

	return bcf_instance()->service_main->get_service_category_slug();
}
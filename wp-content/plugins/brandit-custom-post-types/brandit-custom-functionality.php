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

	public $service_cpt = null;

	/**
	 * Get the singleton instance of the plugin.
	 *
	 * @return BrandIt_Custom_Functionality
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Main constructor.
	 */
	private function __construct() {
		// Private to enforce singleton pattern.
	}

	/**
	 * Initialise hooks and load dependencies.
	 */
	public function initialise() {
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
		bcf_include( 'includes/cpt/class-service-cpt.php' );

		// Initialise Custom Post Types
		$this->init_custom_post_types();

		$this->is_plugin_initialised = true;
	}

	/**
	 * Initialise Custom Post Types.
	 */
	private function init_custom_post_types() {
		$this->service_cpt = new Service_CPT();
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

	if ( ! $bcf->is_initialised() ) {
		$bcf->initialise();
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
	if ( ! isset( bcf_instance()->service_cpt ) ) {
		// returns an empty query object in case the services_cpt are not initialised
		return new WP_Query( array( 'post__in' => array( 0 ) ) );
	}

	return bcf_instance()->service_cpt->get_services( $query_args );
}
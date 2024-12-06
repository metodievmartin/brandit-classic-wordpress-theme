<?php

class Rest_Main {

	// ========== Constants ==========

	const NAMESPACE = 'brandit/v1';

	// ========== Static Properties ==========

	private static $instance = null;

	// ========== Static Methods ==========

	/**
	 * Initialises the functionality and makes sure it's done only once.
	 *
	 * @return Rest_Main
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
	 * @return Rest_Main|null
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
		//	Init Custom REST Endpoints
		bcf_include( 'includes/rest/class-rest-search-endpoint.php' );
		Rest_Search_Endpoint::init( self::NAMESPACE );
	}
}
<?php

namespace BrandIt\Custom_Functionality\Core;

// Exit if this file accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use BrandIt\Custom_Functionality\CPT\Service_CPT;

class Main {

	private static $instance = null;

	/**
	 * Get the singleton instance of the plugin.
	 *
	 * @return Main
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Activation hook.
	 */
	public static function activate() {
		flush_rewrite_rules();
	}

	/**
	 * Deactivation hook.
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}

	/**
	 * Main constructor. Private to enforce singleton pattern.
	 */
	private function __construct() {
		$this->init_hooks();
	}

	/**
	 * Initialise hooks and load dependencies.
	 */
	private function init_hooks() {
		// Initialise Custom Post Types
		$this->init_custom_post_types();
	}

	/**
	 * Initialise Custom Post Types.
	 */
	private function init_custom_post_types() {
		new Service_CPT();
	}
}

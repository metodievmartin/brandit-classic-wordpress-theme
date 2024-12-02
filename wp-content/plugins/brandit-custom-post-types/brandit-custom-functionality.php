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

// Define plugin constants
define( 'BRANDIT_CF_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'BRANDIT_CF_DIR_PATH', plugin_dir_path( __FILE__ ) );

// Autoloader
require_once BRANDIT_CF_DIR_PATH . 'includes/autoloader.php';

// Activation and Deactivation Hooks
register_activation_hook( __FILE__, [ 'BrandIt\Custom_Functionality\Core\Main', 'activate' ] );
register_deactivation_hook( __FILE__, [ 'BrandIt\Custom_Functionality\Core\Main', 'deactivate' ] );

// Initialise the plugin
BrandIt\Custom_Functionality\Core\Main::get_instance();
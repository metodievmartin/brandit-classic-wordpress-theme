<?php

// Exit if this file accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Autoloader function for dynamically loading classes based on their namespace and file structure.
 *
 * Registers a custom autoloader that maps namespaces to file paths within the plugin directory.
 * It specifically handles classes under the "BrandIt\Custom_Functionality" namespace and expects the
 * file structure to match the namespace hierarchy with the following conventions:
 * - Namespace separators (`\`) are converted to directory separators (`/`).
 * - Underscores (`_`) in class names are replaced with hyphens (`-`).
 * - Class files are prefixed with "class-" and suffixed with ".php".
 *
 * Example:
 * - Class: BrandIt\Custom_Functionality\Core\Main
 * - File Path: includes/core/class-main.php
 *
 * @param string $class Fully qualified class name.
 *
 * @return void
 */
spl_autoload_register( function ( $class ) {
	// Namespace prefix
	$prefix = 'BrandIt\\Custom_Functionality\\';

	// Base directory for the namespace prefix
	$base_dir = plugin_dir_path( __FILE__ );

	// Check if the class uses the namespace prefix
	$len = strlen( $prefix );
	if ( strncmp( $prefix, $class, $len ) !== 0 ) {
		return; // Not our namespace
	}

	// Get the relative class name (excluding the namespace prefix)
	$relative_class = substr( $class, $len );

	// Replace namespace separators with directory separators
	$relative_class_path = str_replace( '\\', '/', strtolower( $relative_class ) );

	$relative_class_path = str_replace( '_', '-', $relative_class_path );

	// Add 'class-' prefix to the filename and '.php' extension
	$file = $base_dir . dirname( $relative_class_path ) . '/class-' . basename( $relative_class_path ) . '.php';

	// If the file exists, include it
	if ( file_exists( $file ) ) {
		require $file;
	}
} );




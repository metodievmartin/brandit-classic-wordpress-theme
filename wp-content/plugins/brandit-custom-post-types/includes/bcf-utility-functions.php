<?php

/**
 * Returns the plugin path to a specified file.
 *
 * @param string $filename The specified file.
 *
 * @return  string
 */
function bcf_get_path( $filename = '' ) {
	return BRANDIT_CF_DIR_PATH . ltrim( $filename, '/' );
}

/**
 * Includes a file within the ACF plugin.
 *
 * @param string $filename The specified file.
 *
 * @return  void
 */
function bcf_include( $filename = '' ) {
	$file_path = bcf_get_path( $filename );
	if ( file_exists( $file_path ) ) {
		include_once $file_path;
	}
}
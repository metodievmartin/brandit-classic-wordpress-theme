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
 * Includes a file within the BCF plugin.
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

/**
 * Removes duplicate items from an array based on a specified key.
 *
 * This function iterates over an array of associative arrays or objects
 * and removes duplicates by ensuring each key's value is unique.
 *
 * @param array $array The input array of associative arrays or objects.
 * @param string $key The key to use for identifying duplicates.
 *
 * @return array The filtered array with duplicates removed, preserving the first occurrence.
 */
function remove_duplicates_by_key( $array, $key ) {
	$unique = array();
	foreach ( $array as $item ) {
		if ( ! isset( $unique[ $item[ $key ] ] ) ) {
			$unique[ $item[ $key ] ] = $item;
		}
	}

	return array_values( $unique );
}
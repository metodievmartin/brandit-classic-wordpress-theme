<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function remove_prefix_from_category_archive_page( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	}

	return $title;
}

add_filter( 'get_the_archive_title', 'remove_prefix_from_category_archive_page' );
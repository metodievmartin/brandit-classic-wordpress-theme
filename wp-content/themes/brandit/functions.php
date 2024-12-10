<?php

// Load services cpt functionality
require_once get_template_directory() . '/includes/utils/utility-functions.php';
require_once get_template_directory() . '/includes/sections/services-section.php';
require_once get_template_directory() . '/includes/walkers/class-bootstrap-nav-walker.php';

function brandit_load_assets() {
	$js_asset  = include get_theme_file_path( 'public/js/index.asset.php' );
	$css_asset = include get_theme_file_path( 'public/css/main.asset.php' );

	wp_enqueue_script(
		'theme-main-scripts',
		get_theme_file_uri( '/public/js/index.js' ),
		$js_asset['dependencies'],
		$js_asset['version'],
		true
	);

	wp_localize_script(
		'theme-main-scripts',
		'brandit_data',
		array(
			'root_url' => get_site_url(),
			'nonce'    => wp_create_nonce( 'wp_rest' ),
		)
	);

	wp_enqueue_style(
		'theme-main-styles',
		get_theme_file_uri( 'public/css/main.css' ),
		$css_asset['dependencies'],
		$css_asset['version']
	);
}

add_action( 'wp_enqueue_scripts', 'brandit_load_assets' );

function brandit_add_support() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'hero-banner', 1200, 675, true );
	add_image_size( 'hero-banner-portrait', 900, 1120, true );
	add_image_size( 'page-banner', 1500, 350, true );

	register_nav_menus( array(
		'header-menu'            => __( 'Header Menu', 'brandit' ),
		'footer-services-menu'   => __( 'Footer Services Menu', 'brandit' ),
		'footer-page-links-menu' => __( 'Footer Page Links Menu', 'brandit' )
	) );
}

add_action( 'after_setup_theme', 'brandit_add_support' );

function remove_prefix_from_category_archive_page( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	}

	return $title;
}

add_filter( 'get_the_archive_title', 'remove_prefix_from_category_archive_page' );
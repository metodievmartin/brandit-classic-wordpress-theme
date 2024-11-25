<?php

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
}

add_action( 'after_setup_theme', 'brandit_add_support' );
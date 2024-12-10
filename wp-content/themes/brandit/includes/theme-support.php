<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function brandit_add_support() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	// Custom Image Sizes
	add_image_size( 'hero-banner', 1200, 675, true );
	add_image_size( 'hero-banner-portrait', 900, 1120, true );
	add_image_size( 'page-banner', 1500, 350, true );

	// Navigation Menus
	register_nav_menus( array(
		'header-menu'            => __( 'Header Menu', 'brandit' ),
		'footer-services-menu'   => __( 'Footer Services Menu', 'brandit' ),
		'footer-page-links-menu' => __( 'Footer Page Links Menu', 'brandit' )
	) );
}

add_action( 'after_setup_theme', 'brandit_add_support' );
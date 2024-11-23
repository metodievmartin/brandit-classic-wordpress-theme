<?php

function brandit_load_assets() {
	wp_enqueue_script( 'theme-main-js', get_theme_file_uri( '/build/index.js' ), array( 'jquery' ), '1.0', true );
	wp_enqueue_style( 'theme-main-css', get_theme_file_uri( '/build/index.css' ) );
}

add_action( 'wp_enqueue_scripts', 'brandit_load_assets' );

function brandit_add_support() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
}

add_action( 'after_setup_theme', 'brandit_add_support' );
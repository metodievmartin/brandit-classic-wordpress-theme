<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function brandit_register_sidebars() {
	register_sidebar(
		array(
			'id'            => 'footer-social-icons',
			'name'          => __( 'Footer Social Icons Sidebar', 'brandit' ),
			'description'   => __( 'A sidebar for the footer social icons.', 'brandit' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'brandit_register_sidebars' );
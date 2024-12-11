<?php

// Exit if this file accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Contact_Form_CPT {

	private static $instance = null;
	private $cpt_slug;

	/**
	 * Initialises the functionality and makes sure it's done only once.
	 *
	 * @return Contact_Form_CPT
	 */
	public static function init( $cpt_slug ) {
		if ( null === self::$instance ) {
			self::$instance = new self( $cpt_slug );
		}

		return self::$instance;
	}

	/**
	 * Get the singleton instance of the plugin.
	 *
	 * @return Contact_Form_CPT|null
	 */
	public static function get_instance() {
		return self::$instance;
	}

	// ========== Constructor ==========

	private function __construct( $cpt_slug ) {
		$this->cpt_slug = $cpt_slug;

		// Init functionality
		$this->initialise();
	}

	private function initialise() {
		//	Register Custom Post Types
		add_action( 'init', array( $this, 'register_contact_form_cpt' ) );
	}


	// ========== Setup Methods (Hook callbacks) ==========

	function register_contact_form_cpt() {
		$labels_args = array(
			'name'                     => __( 'Contact Form Submissions', 'bcf-domain' ),
			'singular_name'            => __( 'Contact Form Submission', 'bcf-domain' ),
			'add_new'                  => __( 'Add New', 'bcf-domain' ),
			'add_new_item'             => __( 'Add New Form Submission', 'bcf-domain' ),
			'edit_item'                => __( 'Edit Form Submission', 'bcf-domain' ),
			'new_item'                 => __( 'New Form Submission', 'bcf-domain' ),
			'view_item'                => __( 'View Form Submission', 'bcf-domain' ),
			'view_items'               => __( 'View Form Submissions', 'bcf-domain' ),
			'search_items'             => __( 'Search Form Submissions', 'bcf-domain' ),
			'not_found'                => __( 'No events found.', 'bcf-domain' ),
			'not_found_in_trash'       => __( 'No events found in trash.', 'bcf-domain' ),
			'all_items'                => __( 'All Form Submissions', 'bcf-domain' ),
			'archives'                 => __( 'Form Submission Archives', 'bcf-domain' ),
			'filter_items_list'        => __( 'Filter Form Submissions list', 'bcf-domain' ),
			'items_list_navigation'    => __( 'Form Submissions list navigation', 'bcf-domain' ),
			'items_list'               => __( 'Form Submissions list', 'bcf-domain' ),
			'item_published'           => __( 'Form Submission published.', 'bcf-domain' ),
			'item_published_privately' => __( 'Form Submission published privately.', 'bcf-domain' ),
			'item_reverted_to_draft'   => __( 'Form Submission reverted to draft.', 'bcf-domain' ),
			'item_scheduled'           => __( 'Form Submission scheduled.', 'bcf-domain' ),
			'item_updated'             => __( 'Form Submission updated.', 'bcf-domain' ),
		);

		$cpt_args = array(
			'labels'      => $labels_args,
			'public'      => false,
			'show_ui'     => true,
			'has_archive' => false,
			'menu_icon'   => 'dashicons-email',
			'supports'    => array( 'title', 'editor', 'custom-fields' ),
		);

		register_post_type( $this->cpt_slug, $cpt_args );
	}
}
<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Contact_Form_Rest {

	// ========== Constants ==========

	const ROUTE_NAME = 'submit-form';

	// ========== Properties ==========

	private $namespace;
	private $form_submission_slug;

	// ========== Static Properties ==========

	private static $instance = null;

	// ========== Static Methods ==========

	/**
	 * Initialises the functionality and makes sure it's done only once.
	 *
	 * @return Contact_Form_Rest
	 */
	public static function init( $namespace, $form_submission_slug ) {
		if ( null === self::$instance ) {
			self::$instance = new self( $namespace, $form_submission_slug );
		}

		return self::$instance;
	}

	/**
	 * Get the singleton instance of the plugin.
	 *
	 * @return Contact_Form_Rest|null
	 */
	public static function get_instance() {
		return self::$instance;
	}

	// ========== Constructor ==========

	private function __construct( $namespace, $form_submission_slug ) {
		$this->namespace            = $namespace;
		$this->form_submission_slug = $form_submission_slug;

		// Init functionality
		$this->initialise();
	}

	// ========== Init ==========

	private function initialise() {
		add_action( 'rest_api_init', array( $this, 'register_contact_form_rest_route' ) );
	}

	public function register_contact_form_rest_route() {
		$route_args = array(
			'methods'             => 'POST',
			'callback'            => array( $this, 'handle_contact_form_submission' ),
			'permission_callback' => array( $this, 'brandit_verify_nonce' ),  // Add nonce validation
		);

		register_rest_route( $this->namespace, self::ROUTE_NAME, $route_args );
	}

	function brandit_verify_nonce( $request ) {
		$nonce = $request->get_header( 'X-WP-Nonce' );

		if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
			return rest_ensure_response( new WP_Error(
				'request_failed',
				'You are not allowed to perform this action',
				array( 'status' => 403 )
			) );
		}

		return true;
	}

	function handle_contact_form_submission( $request ) {
		// Extract parameters
		$parameters   = $request->get_params();
		$sender_name  = sanitize_text_field( $parameters['sender_name'] ?? '' );
		$sender_email = sanitize_email( $parameters['sender_email'] ?? '' );
		$message      = sanitize_textarea_field( $parameters['message'] ?? '' );
		$subject      = sanitize_text_field( $parameters['subject'] ?? 'No Subject' );

		// TODO: implement recaptcha

		// Validate required fields
		if ( empty( $sender_name ) || empty( $sender_email ) || empty( $message ) ) {
			return rest_ensure_response( new WP_Error(
				'missing_fields',
				__( 'Required fields are missing.', 'bcf-domain' ),
				array( 'status' => 400, 'params' => $parameters )
			) );
		}

		if ( ! is_email( $sender_email ) ) {
			return rest_ensure_response( new WP_Error(
				'missing_fields',
				__( 'Please provide a valid email.', 'bcf-domain' ),
				array( 'status' => 400 )
			) );
		}

		// Validate email format
		if ( ! is_email( $sender_email ) ) {
			return new WP_Error(
				'invalid_email',
				'The provided email address is not valid.',
				array( 'status' => 400 )
			);
		}
		// Format the current date and time based on WP timezone settings
		$submission_time = current_time( 'd/m/Y H:i' ); // Example: 23/10/2024 15:44

		// Format the post content
		$formatted_message = "Name: $sender_name";
		$formatted_message .= "\n\nSubject: $subject";
		$formatted_message .= "\n\nEmail: $sender_email";
		$formatted_message .= "\n\nMessage:\n$message";
		$formatted_message .= "\n\nTime: $submission_time";


		// TODO: should form-submission objects be in a custom DB table instead of Custom Post Type and wp_posts?
		// Create a new form submission post
		$post_id = wp_insert_post( array(
			'post_type'    => $this->form_submission_slug,
			'post_title'   => $sender_email,  // Use the email as the post title
			'post_content' => $formatted_message,
			'post_status'  => 'publish',
			'meta_input'   => array(
				'submitted_email'   => $sender_email,
				'submitted_subject' => $subject,
			),
		) );

		if ( is_wp_error( $post_id ) ) {
			return rest_ensure_response( new WP_Error(
				'submission_failed',
				__( 'Form submission failed.', 'bcf-domain' ),
				array( 'status' => 500 )
			) );
		}

		// TODO: implement send mail functionality

		// Successful Response
		return rest_ensure_response( array(
			'success' => true,
			'message' => __( 'Form submitted successfully.', 'bcf-domain' ),
		) );
	}

}

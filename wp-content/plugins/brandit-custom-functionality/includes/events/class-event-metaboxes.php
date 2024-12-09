<?php

class Event_Metaboxes {

	// ========== Constants ==========

	// Metaboxes
	const ADDITIONAL_INFO_METABOX_ID = 'event_additional_info_metabox';

	// Meta
	const META_EVENT_LOCATION_NAME = 'event_location_name';
	const META_EVENT_ADDRESS_URL = 'event_address_url';

	// Nonce
	const ADDITIONAL_INFO_EVENT_NONCE_ACTION = 'save_event_location';
	const ADDITIONAL_INFO_EVENT_NONCE = 'event_location_nonce';

	private static $instance = null;

	private $event_cpt_slug;

	// ========== Static Methods ==========

	/**
	 * Initialises the functionality and makes sure it's done only once.
	 *
	 * @return Event_Metaboxes
	 */
	public static function init( $event_cpt_slug ) {
		if ( null === self::$instance ) {
			self::$instance = new self( $event_cpt_slug );
		}

		return self::$instance;
	}

	/**
	 * Get the singleton instance of the metabox.
	 *
	 * @return Event_Metaboxes|null
	 */
	public static function get_instance() {
		return self::$instance;
	}

	// ========== Constructor ==========

	protected function __construct( $event_cpt_slug ) {
		$this->event_cpt_slug = $event_cpt_slug;
		$this->initialise();
	}

	private function initialise() {
		// Hook into WordPress to add and save the metabox
		add_action( 'add_meta_boxes', array( $this, 'register_event_metaboxes' ) );
		add_action( 'save_post_event', array( $this, 'save_event_metaboxes' ) );
	}

	/**
	 * Register the metabox for the 'event' CPT.
	 */
	public function register_event_metaboxes() {
		add_meta_box(
			self::ADDITIONAL_INFO_METABOX_ID,
			__( 'Event Additional Information', 'bcf-domain' ),
			array( $this, 'render_metabox' ),
			$this->event_cpt_slug,
			'side',
			'default'
		);
	}

	/**
	 * Render the metabox field.
	 */
	public function render_metabox( $post ) {
		// Retrieve saved values
		$event_location = get_post_meta( $post->ID, self::META_EVENT_LOCATION_NAME, true );
		$event_maps_url = get_post_meta( $post->ID, self::META_EVENT_ADDRESS_URL, true );

		// Display the form fields
		wp_nonce_field(
			self::ADDITIONAL_INFO_EVENT_NONCE_ACTION,
			self::ADDITIONAL_INFO_EVENT_NONCE
		);
		?>

        <p>
            <label for="<?php echo self::META_EVENT_LOCATION_NAME ?>">
				<?php esc_html_e( 'Enter the Event Location Name:', 'bcf-domain' ); ?>
            </label>
            <input type="text"
                   id="<?php echo self::META_EVENT_LOCATION_NAME ?>"
                   name="<?php echo self::META_EVENT_LOCATION_NAME ?>"
                   value="<?php echo esc_attr( $event_location ); ?>"
                   style="width:100%;"/>
        </p>

        <p>
            <label for="<?php echo self::META_EVENT_ADDRESS_URL ?>">
				<?php esc_html_e( 'Event Address URL:', 'bcf-domain' ); ?>
            </label>
            <input type="url"
                   id="<?php echo self::META_EVENT_ADDRESS_URL ?>"
                   name="<?php echo self::META_EVENT_ADDRESS_URL ?>"
                   value="<?php echo esc_url( $event_maps_url ); ?>"
                   style="width:100%;"
                   placeholder="https://maps.google.com/..."/>
        </p>

		<?php
	}

	/**
	 * Save the metabox values when the event is saved.
	 */
	public function save_event_metaboxes( $post_id ) {
		// Verify the nonce
		if ( ! isset( $_POST[ self::ADDITIONAL_INFO_EVENT_NONCE ] ) ||
		     ! wp_verify_nonce( $_POST[ self::ADDITIONAL_INFO_EVENT_NONCE ], self::ADDITIONAL_INFO_EVENT_NONCE_ACTION ) ) {
			return;
		}

		// Prevent autosave, bulk edit, and quick edit
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check permission
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Save Event Location
		if ( isset( $_POST[ self::META_EVENT_LOCATION_NAME ] ) ) {
			$event_location = sanitize_text_field( $_POST[ self::META_EVENT_LOCATION_NAME ] );
			update_post_meta( $post_id, self::META_EVENT_LOCATION_NAME, $event_location );
		}

		// Save Maps URL
		if ( isset( $_POST[ self::META_EVENT_ADDRESS_URL ] ) ) {
			$event_maps_url = esc_url_raw( $_POST[ self::META_EVENT_ADDRESS_URL ] );
			update_post_meta( $post_id, self::META_EVENT_ADDRESS_URL, $event_maps_url );
		}
	}
}
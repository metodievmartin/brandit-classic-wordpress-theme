<?php

namespace BrandIt\Custom_Functionality\CPT;

// Exit if this file accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Service_CPT {

	// ========== Constants ==========

	// Custom Post Types
	protected const SERVICE_CPT = 'service';

	// Database Option Names
	protected const OPTION_SERVICES_SHOWN_PER_PAGE = 'bcpt_services_shown_per_page';

	// Nonce Fields
	protected const NONCE_SAVE_SERVICES_SETTINGS = 'bcpt_save_services_settings_nonce';
	protected const NONCE_SAVE_SERVICES_SETTINGS_ACTION = 'bcpt_save_services_settings_action';

	// Defaults
	protected const SERVICES_PER_PAGE_MAX = 30;
	protected const SERVICES_PER_PAGE_MIN = 1;
	protected const SERVICES_PER_PAGE_DEFAULT = 10;

	// ========== Constructor ==========

	public function __construct() {
		//	Creates Custom Post Types
		add_action( 'init', array( $this, 'register_service_post_type' ) );

		// Hook to add the submenu
		add_action( 'admin_menu', [ $this, 'add_service_submenu' ] );
	}

	// ========== Getters ==========

	function get_services_shown_per_page() {
		return get_option(
			self::OPTION_SERVICES_SHOWN_PER_PAGE,
			self::SERVICES_PER_PAGE_DEFAULT
		);
	}

	// ========== Setup Methods (Hook callbacks) ==========

	function register_service_post_type() {
		register_post_type( self::SERVICE_CPT, array(
			'labels'             => array(
				'name'                     => __( 'Services', 'bcpt-domain' ),
				'singular_name'            => __( 'Service', 'bcpt-domain' ),
				'add_new'                  => __( 'Add New', 'bcpt-domain' ),
				'add_new_item'             => __( 'Add New Service', 'bcpt-domain' ),
				'edit_item'                => __( 'Edit Service', 'bcpt-domain' ),
				'new_item'                 => __( 'New Service', 'bcpt-domain' ),
				'view_item'                => __( 'View Service', 'bcpt-domain' ),
				'view_items'               => __( 'View Services', 'bcpt-domain' ),
				'search_items'             => __( 'Search Services', 'bcpt-domain' ),
				'not_found'                => __( 'No services found.', 'bcpt-domain' ),
				'not_found_in_trash'       => __( 'No services found in trash.', 'bcpt-domain' ),
				'all_items'                => __( 'All Services', 'bcpt-domain' ),
				'archives'                 => __( 'Service Archives', 'bcpt-domain' ),
				'insert_into_item'         => __( 'Insert into Service', 'bcpt-domain' ),
				'uploaded_to_this_item'    => __( 'Uploaded to this Service', 'bcpt-domain' ),
				'filter_items_list'        => __( 'Filter Services list', 'bcpt-domain' ),
				'items_list_navigation'    => __( 'Services list navigation', 'bcpt-domain' ),
				'items_list'               => __( 'Services list', 'bcpt-domain' ),
				'item_published'           => __( 'Service published.', 'bcpt-domain' ),
				'item_published_privately' => __( 'Service published privately.', 'bcpt-domain' ),
				'item_reverted_to_draft'   => __( 'Service reverted to draft.', 'bcpt-domain' ),
				'item_scheduled'           => __( 'Service scheduled.', 'bcpt-domain' ),
				'item_updated'             => __( 'Service updated.', 'bcpt-domain' ),
			),
			'has_archive'        => true,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'revisions' ),
			'can_export'         => true,
			'menu_icon'          => 'dashicons-art',
		) );
	}

	// Add a submenu page under the 'Service' post type in the Admin Dashboard
	public function add_service_submenu() {
		$services_submenu_page_hook = add_submenu_page(
			'edit.php?post_type=service',       // Parent slug
			__( 'Service Settings', 'bcpt-domain' ),      // Page title
			__( 'Settings', 'bcpt-domain' ),              // Menu title
			'manage_options',                    // Capability
			'service-settings',                 // Menu slug
			[ $this, 'render_service_settings_page' ]    // Callback function
		);

		// loads additional styles
		add_action( "load-{$services_submenu_page_hook}", array( $this, 'load_main_menu_page_assets' ) );
	}

	function load_main_menu_page_assets() {
		wp_enqueue_style(
			'brandit-custom-post-types-admin',
			BRANDIT_CF_DIR_URL . 'assets/css/service-cpt-admin.css'
		);
	}

	// ========== Handlers & Processing Logic ==========

	protected function handle_form_submit() {
		// verifies the Nonce and also checks the current user has the necessary permissions
		if (
			! isset( $_POST[ self::NONCE_SAVE_SERVICES_SETTINGS ] )
			|| ! wp_verify_nonce( $_POST[ self::NONCE_SAVE_SERVICES_SETTINGS ], self::NONCE_SAVE_SERVICES_SETTINGS_ACTION )
			|| ! current_user_can( 'manage_options' )
		) {
			$this->render_error_message( __( 'Sorry, you are not allowed to perform this action', 'bcpt-domain' ) );

			return;
		}

		if ( isset( $_POST[ self::OPTION_SERVICES_SHOWN_PER_PAGE ] ) ) {
			$services_shown_per_page = $this->validate_positive_integer( $_POST[ self::OPTION_SERVICES_SHOWN_PER_PAGE ] );

			if (
				$services_shown_per_page == 0
				|| $services_shown_per_page < self::SERVICES_PER_PAGE_MIN
				|| $services_shown_per_page > self::SERVICES_PER_PAGE_MAX
			) {
				$this->render_error_message(
					sprintf(
						__( 'Sorry, the selected value of %d is invalid. Please, choose a value between %d and %d.', 'bcpt-domain' ),
						$services_shown_per_page,
						self::SERVICES_PER_PAGE_MIN,
						self::SERVICES_PER_PAGE_MAX
					) );

				return;
			}

			update_option( self::OPTION_SERVICES_SHOWN_PER_PAGE, $services_shown_per_page );

			$this->render_success_message( __( 'Your changes have been saved successfully.', 'bcpt-domain' ) );
		}

	}

	// ========== HTML Generators ==========

	public function render_service_settings_page() {
		?>

        <div class="wrap my-contact-info-settings">
            <h1><?php echo esc_html__( 'Services Settings', 'bcpt-domain' ); ?></h1>

			<?php

			if ( isset( $_POST['just_submitted'] ) == 'true' ) {
				$this->handle_form_submit();
			}

			?>

            <form method="post" class="my-contact-info-form">
                <input type="hidden" name="just_submitted" value="true">

				<?php wp_nonce_field( self::NONCE_SAVE_SERVICES_SETTINGS_ACTION, self::NONCE_SAVE_SERVICES_SETTINGS ) ?>

                <!-------- SERVICES PER PAGE FIELD -------->
                <div class="form-group">
                    <div class="form-floating">
                        <input type="number"
                               name="<?php echo self::OPTION_SERVICES_SHOWN_PER_PAGE ?>"
                               class="form-control" id="<?php echo self::OPTION_SERVICES_SHOWN_PER_PAGE ?>"
                               value="<?php echo esc_attr( $this->get_services_shown_per_page() ); ?>"
                               placeholder="10"
                               min="1"
                               max="30">
                        <label for="<?php echo self::OPTION_SERVICES_SHOWN_PER_PAGE ?>">
							<?php esc_html_e( 'Services shown at most', 'bcpt-domain' ); ?>
                        </label>
                    </div>
                    <p class="description">
						<?php

						echo esc_html( sprintf(
							__( 'Choose a number of services between %d and %d that will be shown at most. Default is 10.', 'bcpt-domain' ),
							self::SERVICES_PER_PAGE_MIN,
							self::SERVICES_PER_PAGE_MAX
						) );

						?>
                    </p>
                </div>

                <input type="submit" id="submit" class="button button-primary"
                       value="<?php esc_html_e( 'Save Changes', 'bcpt-domain' ) ?>">
            </form>
        </div>

		<?php
	}

	// ========== Helpers ==========

	protected function validate_positive_integer( $value ) {
		// Check if the value is numeric and a positive integer
		if ( is_numeric( $value ) && intval( $value ) > 0 ) {
			return intval( $value );
		}

		// Return a default value (e.g., 0) or false if it's not a valid positive integer
		return 0;
	}

	protected function render_success_message( $message ) {
		$this->display_admin_notice_html( 'updated', $message );
	}

	protected function render_error_message( $message ) {
		$this->display_admin_notice_html( 'error', $message );
	}

	protected function display_admin_notice_html( $type, $message ) {
		?>

        <div class="<?php echo esc_attr( $type ); ?> notice is-dismissible">
            <p><?php echo esc_html( $message ); ?></p>
        </div>

		<?php
	}
}
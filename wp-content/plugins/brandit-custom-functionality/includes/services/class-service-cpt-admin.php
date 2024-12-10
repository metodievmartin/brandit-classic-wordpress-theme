<?php

// Exit if this file accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Service_CPT_Admin {

	// ========== Constants ==========

	// Nonce Fields
	const NONCE_SAVE_SERVICES_SETTINGS = 'bcpt_save_services_settings_nonce';
	const NONCE_SAVE_SERVICES_SETTINGS_ACTION = 'bcpt_save_services_settings_action';

	private static $instance = null;
	private $main;

	// ========== Static Methods ==========

	/**
	 * Initialises the functionality and makes sure it's done only once.
	 *
	 * @return Service_CPT_Admin
	 */
	public static function init( $main ) {
		if ( null === self::$instance ) {
			self::$instance = new self( $main );
		}

		return self::$instance;
	}

	/**
	 * Get the singleton instance of the plugin.
	 *
	 * @return Service_CPT_Admin|null
	 */
	public static function get_instance() {
		return self::$instance;
	}

	// ========== Constructor ==========

	private function __construct( $main ) {
		$this->main = $main;

		// Init functionality
		$this->initialise();
	}


	// ========== Init ==========

	private function initialise() {
		// Add settings page
		add_action( 'admin_menu', [ $this, 'add_service_submenu' ] );
	}

	// Add a submenu page under the 'Service' post type in the Admin Dashboard
	public function add_service_submenu() {
		$services_submenu_page_hook = add_submenu_page(
			'edit.php?post_type=' . $this->main::SERVICE_CPT_SLUG,         // Parent slug
			__( 'Service Settings', 'bcpt-domain' ),                            // Page title
			__( 'Settings', 'bcpt-domain' ),                                    // Menu title
			'manage_options',                                          // Capability
			$this->main::SERVICE_CPT_SLUG . '-settings',                   // Menu slug
			[ $this, 'render_service_settings_page' ]                           // Callback function
		);

		// loads additional styles
		add_action( "load-{$services_submenu_page_hook}", array( $this, 'load_main_menu_page_assets' ) );
	}

	function load_main_menu_page_assets() {
		wp_enqueue_style(
			'brandit-custom-post-types-admin',
			plugin_dir_url( __FILE__ ) . 'assets/css/service-cpt-admin.css',
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

		if ( isset( $_POST[ $this->main::OPTION_SERVICES_SHOWN_PER_PAGE ] ) ) {
			$services_shown_per_page = $this->validate_positive_integer( $_POST[ $this->main::OPTION_SERVICES_SHOWN_PER_PAGE ] );

			if (
				$services_shown_per_page == 0
				|| $services_shown_per_page < $this->main::SERVICES_PER_PAGE_MIN
				|| $services_shown_per_page > $this->main::SERVICES_PER_PAGE_MAX
			) {
				$this->render_error_message(
					sprintf(
						__( 'Sorry, the selected value of %d is invalid. Please, choose a value between %d and %d.', 'bcpt-domain' ),
						$services_shown_per_page,
						$this->main::SERVICES_PER_PAGE_MIN,
						$this->main::SERVICES_PER_PAGE_MAX
					) );

				return;
			}

			update_option( $this->main::OPTION_SERVICES_SHOWN_PER_PAGE, $services_shown_per_page );

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
                               name="<?php echo $this->main::OPTION_SERVICES_SHOWN_PER_PAGE ?>"
                               class="form-control" id="<?php echo $this->main::OPTION_SERVICES_SHOWN_PER_PAGE ?>"
                               value="<?php echo esc_attr( $this->main->get_services_shown_per_page() ); ?>"
                               placeholder="10"
                               min="1"
                               max="30">
                        <label for="<?php echo $this->main::OPTION_SERVICES_SHOWN_PER_PAGE ?>">
							<?php esc_html_e( 'Services shown at most', 'bcpt-domain' ); ?>
                        </label>
                    </div>
                    <p class="description">
						<?php

						echo esc_html( sprintf(
							__( 'Choose a number of services between %d and %d that will be shown at most. Default is %d.', 'bcpt-domain' ),
							$this->main::SERVICES_PER_PAGE_MIN,
							$this->main::SERVICES_PER_PAGE_MAX,
							$this->main::SERVICES_PER_PAGE_DEFAULT
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

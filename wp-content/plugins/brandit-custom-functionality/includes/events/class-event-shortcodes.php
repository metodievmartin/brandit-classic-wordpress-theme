<?php

class Event_Shortcode {
	// ========== Constants ==========

	// Custom Post Types
	const UPCOMING_EVENTS_LIST_SHORTCODE = 'upcoming_events_list';

	private static $instance = null;

	private $main;

	// ========== Static Methods ==========

	/**
	 * Initialises the functionality and makes sure it's done only once.
	 *
	 * @return Event_Shortcode
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
	 * @return Event_Shortcode|null
	 */
	public static function get_instance() {
		return self::$instance;
	}

	// ========== Constructor ==========

	protected function __construct( $main ) {
		$this->main = $main;
		$this->initialise();
	}

	private function initialise() {
		add_shortcode( self::UPCOMING_EVENTS_LIST_SHORTCODE, array( $this, 'render_upcoming_events' ) );
	}

	public function render_upcoming_events( $atts ) {
		$query_args = array();

		// check if 'posts_per_page' argument has been passed
		if ( isset( $atts['posts_per_page'] ) ) {
			$query_args['posts_per_page'] = $atts['posts_per_page'];
		}

		$events_query = $this->main->get_events_query( $query_args );

		ob_start();

		// Add logic to allow adding a template that will overwrite the default markup
		$template_files = array(
			'template-parts/upcoming-events-listing.php',
			'template-parts/events/upcoming-events-listing.php',
			'partials/upcoming-events-listing.php',
			'template-parts/events/upcoming-events-listing.php',
		);

		$event_listing_template = locate_template( $template_files, false, false );

		// Check if the theme template exists
		if ( $event_listing_template ) {
			// Extract slug from the template file
			$template_part_slug = str_replace(
				array( get_stylesheet_directory() . '/', '.php' ),
				'',
				$event_listing_template
			);

			// Load the template from the theme if it exists
			get_template_part( $template_part_slug, null, array(
				'events_query' => $events_query
			) );
		} else {
			// Fallback to default plugin markup
			include_once plugin_dir_path( __FILE__ ) . 'partials/default-event-listing.php';
		}

		wp_reset_postdata();

		return ob_get_clean();
	}
}

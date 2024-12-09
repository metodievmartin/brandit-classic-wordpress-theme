<?php

class Event_Main {

	// ========== Constants ==========

	// Custom Post Types
	const EVENT_CPT = 'event';

	// Meta
	const EVENT_DATE_META_KEY = 'event_date';

	// Defaults
	const EVENTS_PER_PAGE_DEFAULT = 2;
	const EVENT_DATE_DEFAULT_FORMAT = 'Ymd';

	private static $instance = null;

	private $event_cpt;
	private $event_shortcodes;

	// ========== Static Methods ==========

	/**
	 * Initialises the functionality and makes sure it's done only once.
	 *
	 * @return Event_Main
	 */
	public static function init() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Get the singleton instance of the plugin.
	 *
	 * @return Event_Main|null
	 */
	public static function get_instance() {
		return self::$instance;
	}

	// ========== Constructor ==========

	private function __construct() {
		$this->initialise();
	}

	// ========== Init ==========

	private function initialise() {
		//	Init Custom Post Types
		bcf_include( 'includes/events/class-event-cpt.php' );
		$event_cpt = Event_CPT::init( self::EVENT_CPT );

		//	Init Custom Shortcodes
		bcf_include( 'includes/events/class-event-shortcodes.php' );
		$event_shortcodes = Event_Shortcode::init( $this );
	}

	// ========== Getters ==========

	function get_events_query( $query_args = array() ) {
		// Set default arguments
		$today          = date( self::EVENT_DATE_DEFAULT_FORMAT );
		$query_defaults = array(
			'posts_per_page' => self::EVENTS_PER_PAGE_DEFAULT,
			'meta_key'       => self::EVENT_DATE_META_KEY,
			'orderby'        => 'meta_value_num',
			'order'          => 'ASC',
			'meta_query'     => array(
				array(
					'key'     => self::EVENT_DATE_META_KEY,
					'compare' => '>=',
					'value'   => $today,
					'type'    => 'NUMERIC'
				)
			)
		);

		$parsed_query_args = wp_parse_args( $query_args, $query_defaults );

		// default overwrite for event post type
		$parsed_query_args['post_type'] = self::EVENT_CPT;

		// Perform the query
		return new WP_Query( $parsed_query_args );
	}
}
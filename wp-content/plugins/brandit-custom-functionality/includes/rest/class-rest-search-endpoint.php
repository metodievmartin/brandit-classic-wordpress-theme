<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rest_Search_Endpoint {

	// ========== Constants ==========

	const ROUTE_NAME = 'search';
	const EXCERPT_WORD_LENGTH = 10;

	// ========== Properties ==========

	private $namespace;

	// ========== Static Properties ==========

	private static $instance = null;

	// ========== Static Methods ==========

	/**
	 * Initialises the functionality and makes sure it's done only once.
	 *
	 * @return Rest_Search_Endpoint
	 */
	public static function init( $namespace ) {
		if ( null === self::$instance ) {
			self::$instance = new self( $namespace );
		}

		return self::$instance;
	}

	/**
	 * Get the singleton instance of the plugin.
	 *
	 * @return Rest_Search_Endpoint|null
	 */
	public static function get_instance() {
		return self::$instance;
	}

	// ========== Constructor ==========

	private function __construct( $namespace ) {
		$this->namespace = $namespace;

		// Init functionality
		$this->initialise();
	}

	// ========== Init ==========

	private function initialise() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	public function register_routes() {
		$route_args = array(
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => array( $this, 'get_search_results' ),
			'permission_callback' => '__return_true',
		);

		register_rest_route( $this->namespace, self::ROUTE_NAME, $route_args );
	}

	public function get_search_results( $data ) {
		$query_args = array(
			'post_type'      => array( 'page', 'post', 'service', 'event' ),
			's'              => sanitize_text_field( $data['q'] ),
			'posts_per_page' => - 1,
		);

		$search_results_query = new WP_Query( $query_args );

		$results = array(
			'total_results' => 0,
			'general_info'  => array(),
			'services'      => array(),
			'events'        => array(),
		);

		while ( $search_results_query->have_posts() ) {
			$search_results_query->the_post();

			$post_type = get_post_type();
			$post_data = array(
				'ID'        => get_the_ID(),
				'title'     => get_the_title(),
				'permalink' => get_permalink(),
				'post_type' => $post_type,
			);

			if ( $post_type === 'post' || $post_type === 'page' ) {
				if ( $post_type === 'post' ) {
					$post_data['author_name'] = get_the_author();
				}

				$results['general_info'][] = $post_data;
			}

			if ( $post_type === 'service' ) {
				$post_data['description'] = wp_trim_words( get_the_excerpt(), self::EXCERPT_WORD_LENGTH );
				$results['services'][]    = $post_data;
			}

			if ( $post_type === 'event' ) {
				// get the related services for each event and add them to the result array
				$related_services = get_field( 'related_services' );

				if ( ! empty( $related_services ) ) {
					foreach ( $related_services as $service ) {
						$results['services'][] = array(
							'ID'          => $service->ID,
							'title'       => get_the_title( $service ),
							'permalink'   => get_the_permalink( $service ),
							'description' => wp_trim_words( get_the_excerpt( $service ), self::EXCERPT_WORD_LENGTH ),
						);
					}
				}

				$event_date               = new DateTime( get_field( 'event_date' ) );
				$post_data['month']       = $event_date->format( 'M' );
				$post_data['day']         = $event_date->format( 'd' );
				$post_data['description'] = wp_trim_words( get_the_excerpt(), self::EXCERPT_WORD_LENGTH );
				$results['events'][]      = $post_data;
			}
		}

		wp_reset_postdata();

		// Check if there are events related to any of the services
		if ( $results['services'] ) {
			$this->query_related_events_to_services( $results );
		}

		// Remove duplicates for each relevant section
		$results['services'] = remove_duplicates_by_key( $results['services'], 'ID' );
		$results['events']   = remove_duplicates_by_key( $results['events'], 'ID' );

		// Calculate the total number of results
		$results['total_results'] =
			count( $results['events'] )
			+ count( $results['services'] )
			+ count( $results['general_info'] );

		return $results;
	}

	/**
	 * Checks for events that have a relationship with services
	 * (via the "related_services" custom field). It queries for these events
	 * and adds them to the "events" section of the search results.
	 *
	 * @param array &$results The search results array, passed by reference.
	 *                        The `events` results array will be updated with related events.
	 *
	 * @return void
	 */
	private function query_related_events_to_services( &$results ) {
		$services_meta_query = array( 'relation' => 'OR' );

		foreach ( $results['services'] as $service ) {
			$services_meta_query[] = array(
				'key'     => 'related_services',
				'compare' => 'LIKE',
				'value'   => '"' . $service['ID'] . '"',
			);
		}

		$relationship_query = new WP_Query( array(
			'post_type'  => 'event',
			'meta_query' => $services_meta_query,
		) );

		while ( $relationship_query->have_posts() ) {
			$relationship_query->the_post();

			if ( get_post_type() === 'event' ) {
				$event_date          = new DateTime( get_field( 'event_date' ) );
				$results['events'][] = array(
					'ID'          => get_the_ID(),
					'title'       => get_the_title(),
					'permalink'   => get_the_permalink(),
					'month'       => $event_date->format( 'M' ),
					'day'         => $event_date->format( 'd' ),
					'description' => wp_trim_words( get_the_excerpt(), self::EXCERPT_WORD_LENGTH ),
				);
			}
		}

		wp_reset_postdata();
	}
}

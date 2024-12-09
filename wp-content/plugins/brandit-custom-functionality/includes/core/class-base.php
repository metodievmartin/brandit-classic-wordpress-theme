<?php

// TODO: Come back later to see what can be extracted into common classes and shared through inheritance or composition.

class BCF_Base {
	protected static $instance = null;

	/**
	 * Initialises the functionality and ensures it's done only once.
	 *
	 * @param mixed ...$args Dynamic arguments for child classes.
	 *
	 * @return static The singleton instance of the child class.
	 */
	public static function init( ...$args ) {
		if ( null === static::$instance ) {
			static::$instance = new static( ...$args );
		}

		return static::$instance;
	}

	/**
	 * Get the singleton instance.
	 *
	 * @return static|null
	 */
	public static function get_instance() {
		return static::$instance;
	}

	// Protected constructor to prevent direct instantiation
	protected function __construct() {
	}
}
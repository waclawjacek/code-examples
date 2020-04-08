<?php
/**
 * Exceptions: Missing_Dependencies_Exception class
 *
 * @package Check_Plugin_Dependencies\Exception
 * @since 1.0.0
 */

namespace Check_Plugin_Dependencies\Exception;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Indicates that plugin dependencies were not met.
 *
 * Holds the names of the plugins that are our plugin depends on that are not active.
 *
 * @since 1.0.0
 *
 * @see \Check_Plugin_Dependencies\Exception\Exception
 */
class Missing_Dependencies_Exception extends Exception {

	/**
	 * Names of the plugins that are required but are inactive.
	 *
	 * @since 1.0.0
	 * @var string[]
	 */
	private $missing_plugin_names;

	/**
	 * Missing_Dependencies_Exception constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $missing_plugin_names Names of the plugins that our plugin depends on,
	 *                                       that were found to be inactive.
	 */
	public function __construct( $missing_plugin_names ) {
		parent::__construct();
		$this->missing_plugin_names = $missing_plugin_names;
	}

	/**
	 * Returns the list of names of plugins that are required but are inactive.
	 *
	 * @since 1.0.0
	 *
	 * @return string[] Names of the plugins that are required but are inactive.
	 */
	public function get_missing_plugin_names() {
		return $this->missing_plugin_names;
	}

}
<?php
/**
 * Dependency_Checker class
 *
 * @package Check_Plugin_Dependencies
 * @since 1.0.0
 */

namespace Check_Plugin_Dependencies;

use Check_Plugin_Dependencies\Exception\Missing_Dependencies_Exception;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Performs the actual check whether the required plugins are active.
 *
 * Plugins have to be both installed and active to pass the check.
 *
 * @since 1.0.0
 */
class Dependency_Checker {

	/**
	 * Define the plugins that our plugin requires to function.
	 *
	 * Example:
	 *
	 *    const REQUIRED_PLUGINS = array(
	 *        'Some Plugin'    => 'some-plugin/some-plugin.php',
	 *        'Another Plugin' => 'another-plugin/another-plugin.php',
	 *    );
	 *
	 * @since 1.0.0
	 * @var string[]
	 */
	const REQUIRED_PLUGINS = array(
		'Hello Dolly' => 'hello-dolly/hello.php',
		'WooCommerce' => 'woocommerce/woocommerce.php',
	);

	/**
	 * Check if all required plugins are active. If not, throw an exception.
	 *
	 * @since 1.0.0
	 *
	 * @throws Missing_Dependencies_Exception
	 */
	public function check() {
		$missing_plugins = $this->get_missing_plugin_list();

		if ( ! empty( $missing_plugins ) ) {
			throw new Missing_Dependencies_Exception( $missing_plugins );
		}
	}

	/**
	 * Iterates the list of required plugins and returns the names of inactive ones in array format.
	 *
	 * @since 1.0.0
	 *
	 * @return string[] Names of plugins that are required but are not active.
	 */
	private function get_missing_plugin_list() {
		$missing_plugins = array_filter( self::REQUIRED_PLUGINS, array( $this, 'is_plugin_inactive' ), ARRAY_FILTER_USE_BOTH );

		return array_keys( $missing_plugins );
	}

	/**
	 * Checks if a plugin's main file is absent from the list of active plugins' main files reported by WordPress.
	 *
	 * @since 1.0.0
	 *
	 * @param string $main_plugin_file_path Path to main plugin file, as defined in self::REQUIRED_PLUGINS.
	 * @return bool Whether a plugin is inactive.
	 */
	private function is_plugin_inactive( $main_plugin_file_path ) {
		return ! in_array( $main_plugin_file_path, $this->get_active_plugins() );
	}

	/**
	 * Gets the list of active plugins' main files from WordPress.
	 *
	 * @since 1.0.0
	 *
	 * @return string[] Returns an array of active plugins' main files.
	 */
	private function get_active_plugins() {
		return apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
	}

}
<?php
/**
 * Check_Plugin_Dependencies class
 *
 * The plugin's main class.
 *
 * @package Check_Plugin_Dependencies
 * @since 1.0.0
 */

namespace Check_Plugin_Dependencies;

use Check_Plugin_Dependencies\Admin\Missing_Dependency_Reporter;
use Check_Plugin_Dependencies\Exception\Missing_Dependencies_Exception;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * The plugin's main class that only loads the plugin logic if dependencies are met and displays a notice
 * in the admin dashboard otherwise.
 *
 * @since 1.0.0
 */
class Check_Plugin_Dependencies {

	/**
	 * Runs the plugin only if its dependencies are met. If not, displays a notice in the admin dashboard.
	 *
	 * If Missing_Dependencies_Exception is thrown inside $this->check_dependencies(), the $this->run() method
	 * that follows and does the actual plugin functionality registration will not execute - instead, control will
	 * be passed to the `catch` block below.
	 *
	 * @since 1.0.0
	 */
	public function setup() {
		try {
			$this->check_dependencies();
			$this->run();
		} catch ( Missing_Dependencies_Exception $e ) {
			$this->display_missing_dependencies_notice( $e );
		}
	}

	/**
	 * Instantiates and runs the dependency checker.
	 *
	 * @since 1.0.0
	 *
	 * @throws Missing_Dependencies_Exception
	 */
	private function check_dependencies() {
		$dependency_checker = new Dependency_Checker();
		$dependency_checker->check();
	}

	/**
	 * Executes the actual plugin logic.
	 *
	 * @since 1.0.0
	 */
	private function run() {
		// Execute the actual plugin functionality here - maybe define some hooks using add_action(), add_filter() etc.
	}

	/**
	 * Instantiates and runs the Missing_Dependency_Reporter.
	 *
	 * Gets a list of missing plugins from the exception and feeds it to Missing_Dependency_Reporter.
	 *
	 * @since 1.0.0
	 *
	 * @param Missing_Dependencies_Exception $e
	 */
	private function display_missing_dependencies_notice( Missing_Dependencies_Exception $e ) {
		$missing_dependency_reporter = new Missing_Dependency_Reporter( $e->get_missing_plugin_names() );
		$missing_dependency_reporter->init();
	}

}
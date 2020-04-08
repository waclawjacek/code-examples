<?php
/**
 * Check Plugin Dependencies
 *
 * An example plugin demonstrating how to check if another plugin is running, and if it is not, display a notice
 * and prevent the plugin's actual logic from executing.
 *
 * This example will display a notice if either Hello Dolly or WooCommerce are not active.
 *
 * @package      Check_Plugin_Dependencies
 * @author       Waclaw Jacek
 * @copyright    2020 Waclaw Jacek
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 or later
 *
 * @wordpress-plugin
 * Plugin Name:  Check Plugin Dependencies
 * Plugin URI:   https://waclawjacek.com/check-wordpress-plugin-dependencies/
 * Description:  An example plugin demonstrating how to check if another plugin is running, and if it is not, display a notice and prevent plugin from executing.
 * Version:      1.0.0
 * Requires PHP: 5.6
 * Author:       Waclaw Jacek
 * Author URI:   https://waclawjacek.com/
 * License:      GPL v2 or later
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  check-plugin-dependencies
 * Domain Path:  /languages
 */

use Check_Plugin_Dependencies\Autoloader;
use Check_Plugin_Dependencies\Check_Plugin_Dependencies;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! defined( 'CHECK_PLUGIN_DEPENDENCIES_PLUGIN_FILE' ) ) {
	/**
	 * Path to the plugin's main file.
	 *
	 * Stores the path to the plugin's main file as a constant so we can refer to this file
	 * or the plugin's root directory later using `dirname( CHECK_PLUGIN_DEPENDENCIES_PLUGIN_FILE )`.
	 *
	 * @var string
	 */
	define( 'CHECK_PLUGIN_DEPENDENCIES_PLUGIN_FILE', __FILE__ );
}

// Do not setup the plugin if a setup class with the same name was already defined.
if ( ! class_exists( 'Check_Plugin_Dependencies\Check_Plugin_Dependencies' ) ) {
	/**
	 * The file where the Autoloader class is defined.
	 */
	require_once __DIR__ . '/includes/Autoloader.php';
	spl_autoload_register( array( new Autoloader(), 'autoload' ) );

	$check_plugin_dependencies = new Check_Plugin_Dependencies();
	$check_plugin_dependencies->setup();
}
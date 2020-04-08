<?php
/**
 * Autoloader class
 *
 * @package Check_Plugin_Dependencies
 * @since 1.0.0
 */

namespace Check_Plugin_Dependencies;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Loads classes from the plugin's namespace when requested.
 *
 * Without an autoloader, we would have to `require` or `include` every class file ourselves. An autoloader takes care
 * of this for us.
 *
 * @since 1.0.0
 *
 * @link https://www.php-fig.org/psr/psr-4/examples/ The code this autoloader is based upon.
 */
class Autoloader {

	/**
	 * Namespace prefix of all classes this autoloader should handle, trailing slash included.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	const AUTOLOADED_NAMESPACE_PREFIX = 'Check_Plugin_Dependencies\\';

	/**
	 * Loads the class file if it is in the autoloaded namespace.
	 *
	 * @since 1.0.0
	 *
	 * @param string $class The class' fully-qualified class name (e.g. \Foo\Bar\Baz).
	 */
	public function autoload( $class ) {
		if ( $this->is_class_in_autoloaded_namespace( $class ) ) {
			$this->load_class( $class );
		}
	}

	/**
	 * Checks if the class' namespace prefix is within the autoloaded namespace.
	 *
	 * @since 1.0.0
	 *
	 * @param string $class The class' fully-qualified class name.
	 * @return bool
	 */
	private function is_class_in_autoloaded_namespace( $class ) {
		$prefix_length = strlen( self::AUTOLOADED_NAMESPACE_PREFIX );

		return 0 === strncmp( self::AUTOLOADED_NAMESPACE_PREFIX, $class, $prefix_length );
	}

	/**
	 * Loads the file containing the class if it exists.
	 *
	 * @since 1.0.0
	 *
	 * @param string $class The class' fully-qualified class name.
	 */
	private function load_class( $class ) {
		$file_path = $this->get_class_file_path( $class );
		if ( file_exists( $file_path ) ) {
			/**
			 * The file where the class should be defined.
			 */
			require $file_path;
		}
	}

	/**
	 * Converts a fully-qualified class name into a path to the file where the class is defined.
	 *
	 * Extracts the class' relative path within the autoloaded namespace and converts it into a path where we expect
	 * to find the file containing the class definition.
	 *
	 * E.g. converts `\Check_Plugin_Dependencies\Foo\Bar` into `<plugin root directory>/includes/Foo/Bar.php`.
	 *
	 * @since 1.0.0
	 *
	 * @param string $class The class' fully-qualified class name.
	 * @return string Path to the file where we expect to find the class definition.
	 */
	private function get_class_file_path( $class ) {
		$relative_class_path = substr( $class, strlen( self::AUTOLOADED_NAMESPACE_PREFIX ) );
		$relative_file_path = str_replace( '\\', '/', $relative_class_path ) . '.php';

		return dirname( CHECK_PLUGIN_DEPENDENCIES_PLUGIN_FILE ) . '/includes/' . $relative_file_path;
	}

}
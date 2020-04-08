<?php
/**
 * Exceptions: Exception class
 *
 * @package Check_Plugin_Dependencies\Exception
 * @since 1.0.0
 */

namespace Check_Plugin_Dependencies\Exception;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Abstract base class to group all of this plugin's exceptions.
 *
 * @since 1.0.0
 */
abstract class Exception extends \Exception {

}
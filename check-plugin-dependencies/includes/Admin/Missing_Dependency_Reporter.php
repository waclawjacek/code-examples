<?php
/**
 * Admin: Missing_Dependency_Reporter class
 *
 * @package Check_Plugin_Dependencies\Admin
 * @since 1.0.0
 */

namespace Check_Plugin_Dependencies\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Displays a notice about unmet plugin dependencies in the admin dashboard.
 *
 * @since 1.0.0
 */
class Missing_Dependency_Reporter {

	/**
	 * The capability required to see the "unmet plugin dependencies" notice.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	const CAPABILITY_REQUIRED_TO_SEE_NOTICE = 'activate_plugins';

	/**
	 * Names of the plugins that are required but are not active.
	 *
	 * @since 1.0.0
	 * @var string[]
	 */
	private $missing_plugin_names;

	/**
	 * Missing_Dependency_Reporter constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $missing_plugin_names Names of the plugins that are required but are not active.
	 */
	public function __construct( $missing_plugin_names ) {
		$this->missing_plugin_names = $missing_plugin_names;
	}

	/**
	 * Hook into the admin dashboard hook for displaying notices.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		add_action( 'admin_notices', array( $this, 'display_admin_notice' ) );
	}

	/**
	 * Render the "missing plugins" template if the current user has the required capability.
	 *
	 * @since 1.0.0
	 */
	public function display_admin_notice() {
		if ( current_user_can( self::CAPABILITY_REQUIRED_TO_SEE_NOTICE ) ) {
			$this->render_template();
		}
	}

	/**
	 * Includes the view template for display.
	 *
	 * Defines the `$missing_plugin_names` variable so the view can conveniently access it.
	 *
	 * @since 1.0.0
	 */
	private function render_template() {
		$missing_plugin_names = $this->missing_plugin_names;

		/**
		 * The notice informing of plugin dependencies not being met.
		 */
		include dirname( CHECK_PLUGIN_DEPENDENCIES_PLUGIN_FILE ) . '/views/admin/missing-dependencies-notice.php';
	}

}
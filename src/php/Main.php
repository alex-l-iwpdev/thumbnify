<?php
/**
 * Main plugin class file.
 *
 * @package iwpdev/thumbnify
 */

namespace Thumbnify;

use Thumbnify\Admin\Settings\SettingsPage;

/**
 * Main class file.
 */
class Main {
	/**
	 * Main construct.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Init hooks and actions.
	 *
	 * @return void
	 */
	private function init(): void {
		add_action( 'admin_menu', [ $this, 'add_settings_page_menu' ] );
	}

	/**
	 * Add settings page menu.
	 *
	 * @return void
	 */
	public function add_settings_page_menu(): void {
		add_options_page(
			__( 'Thumbnify settings', 'thumbnify' ),
			__( 'Thumbnify settings', 'thumbnify' ),
			'manage_options',
			'thumbnify-settring',
			[ SettingsPage::class, 'settings_page_render' ]
		);
	}
}

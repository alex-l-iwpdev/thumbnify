<?php
/**
 * Thumbnify
 *
 * @package           iwpdev/thumbnify
 * @author            iwpdev
 * @license           GPL-2.0-or-later
 * @wordpress-plugin
 *
 * Plugin Name: Thumbnify
 * Plugin URI: https://i-wp-dev.com
 * Description: Post Thumbnail Designer is a powerful WordPress plugin that automates the generation of post thumbnails
 * while offering advanced customization options. With a sleek user interface, it allows you to effortlessly create
 * eye-catching post thumbnails, complete with background images and customizable fonts. You have full control over
 * where the title and quote are displayed on the thumbnail, allowing you to design visually appealing post previews
 * that captivate your audience.
 *
 * Version: 1.0.0
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author: Alex Lavyhin
 * Author URI: https://profiles.wordpress.org/alexlavigin/
 * License: GPL2
 *
 * Text Domain: thumbnify
 * Domain Path: /languages
 */

use Thumbnify\Main;

if ( ! defined( 'ABSPATH' ) ) {
	// @codeCoverageIgnoreStart
	exit;
	// @codeCoverageIgnoreEnd
}

/**
 * Plugin version.
 */
const TN_VERSION = '1.0.0';

/**
 * Plugin path.
 */
const TN_PATH = __DIR__;

/**
 * Plugin main file
 */
const TN_FILE = __FILE__;

/**
 * Class autoload.
 */
require_once TN_PATH . '/vendor/autoload.php';

/**
 * Min ver php.
 */
const TN_PHP_REQUIRED_VERSION = '7.4';

/**
 * Plugin url.
 */
define( 'TN_URL', untrailingslashit( plugin_dir_url( TN_FILE ) ) );


/**
 * Check php version.
 *
 * @return bool
 * @noinspection ConstantCanBeUsedInspection
 */
function tn_is_php_version(): bool {
	if ( version_compare( PHP_VERSION, TN_PHP_REQUIRED_VERSION, '<' ) ) {
		return false;
	}

	return true;
}

if ( ! tn_is_php_version() ) {

	add_action(
		'admin_notices',
		[
			Thumbnify\Admin\Notification\Notification::class,
			'php_version_nope',
		]
	);

	if ( is_plugin_active( plugin_basename( TN_FILE ) ) ) {
		deactivate_plugins( plugin_basename( TN_FILE ) );
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}

	return;
}

new Main();

<?php
/**
 * Admin notification.
 *
 * @package iwpdev/thumbnify
 */

namespace Thumbnify\Admin\Notification;

/**
 * Notification class file.
 */
class Notification {

	/**
	 * Incorrect PHP Version
	 *
	 * @return void
	 */
	public static function php_version_nope(): void {
		printf(
			'<div id="tm-php-nope" class="notice notice-error is-dismissible"><p>%s</p></div>',
			wp_kses(
				sprintf(
				/* translators: 1: Required PHP version number, 2: Current PHP version number, 3: URL of PHP update help page */
					__( 'The Thumbnify plugin requires PHP version %1$s or higher. This site is running PHP version %2$s. <a href="%3$s">Learn about updating PHP</a>.', 'thumbnify' ),
					CPCM_PHP_REQUIRED_VERSION,
					PHP_VERSION,
					'https://wordpress.org/support/update-php/'
				),
				[
					'a' => [
						'href' => [],
					],
				]
			)
		);
	}
}

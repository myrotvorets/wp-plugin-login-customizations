<?php
/*
 * Plugin Name: Login Customizations
 * Description: Local customizations for the login page
 * Plugin URI: https://myrotvorets.center/
 * Version: 1.0.0
 * Author: Myrotvorets
 * Author URI: https://myrotvorets.center/
 * License: MIT
 */

use Myrotvorets\WordPress\LoginCustomization\Plugin;

// @codeCoverageIgnoreStart
if ( defined( 'ABSPATH' ) ) {
	if ( defined( 'VENDOR_PATH' ) ) {
		/** @psalm-suppress UnresolvableInclude, MixedOperand */
		require_once constant( 'VENDOR_PATH' ) . '/vendor/autoload.php'; // NOSONAR
	} elseif ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
		require_once __DIR__ . '/vendor/autoload.php';
	} elseif ( file_exists( ABSPATH . 'vendor/autoload.php' ) ) {
		require_once ABSPATH . 'vendor/autoload.php';
	}

	add_action( 'login_init', [ Plugin::class, 'instance' ] );
}
// @codeCoverageIgnoreEnd

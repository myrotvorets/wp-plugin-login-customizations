<?php

namespace Myrotvorets\WordPress\LoginCustomization;

final class Plugin {
	private static ?self $instance = null;

	public static function instance(): self {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->login_init();
		$this->fix_wp_globals();
	}

	public function login_init(): void {
		add_action( 'login_head', [ $this, 'login_head' ] );
		add_filter( 'login_headerurl', [ $this, 'login_headerurl' ] );
		add_filter( 'login_redirect', [ $this, 'login_redirect' ] );
		add_filter( 'login_title', [ $this, 'login_title' ] );
		add_filter( 'shake_error_codes', '__return_empty_array' );
	}

	private function fix_wp_globals(): void {
		global $user_login, $error;

		if ( empty( $user_login ) ) {
			// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			$user_login = '';
		}

		if ( empty( $error ) ) {
			// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			$error = '';
		}
	}

	public function login_head(): void {
		echo '<style>body.login div#login h1 a{width:180px;height:180px;background-size:180px;background-image:url(https://cdn.myrotvorets.center/m/logos/myrotvorets-180.png)}</style>';
	}

	/**
	 * Filters link URL of the header logo above login form.
	 */
	public function login_headerurl(): string {
		return site_url();
	}

	/**
	 * Filters the login redirect URL.
	 */
	public function login_redirect(): string {
		return home_url();
	}

	/**
	 * Filters the title tag content for login page.
	 */
	public function login_title(): string {
		// translators: %s: Site title
		return sprintf( __( 'Log In &lsaquo; %s' ), get_bloginfo( 'name', 'display' ) );
	}
}

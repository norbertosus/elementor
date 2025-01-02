<?php
namespace Elementor\Core\Common\Modules\Connect;

use Elementor\Core\Admin\Menu\Admin_Menu_Manager;
use Elementor\Plugin;
use Elementor\Settings;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Admin {

	const PAGE_ID = 'elementor-connect';

	public static $url = '';

	/**
	 * @since 2.3.0
	 * @access public
	 */
	public function register_admin_menu( Admin_Menu_Manager $admin_menu ) {
		$admin_menu->register( static::PAGE_ID, new Connect_Menu_Item() );
	}

	/**
	 * @since 2.3.0
	 * @access public
	 */
	public function on_load_page() {
		if ( ! $this->user_has_enough_permissions() ) {
			wp_die( 'You do not have sufficient permissions to access this page.', 'You do not have sufficient permissions to access this page.', array(
				'back_link' => true,
			) );
		}

		if ( isset( $_GET['action'], $_GET['app'] ) ) {
			$manager = Plugin::$instance->common->get_component( 'connect' );

			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$app_slug = Utils::get_super_global_value( $_GET, 'app' );
			$app = $manager->get_app( $app_slug );

			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$action = Utils::get_super_global_value( $_GET, 'action' );

			$nonce_action = $app_slug . $action;

			if ( ! $app ) {
				wp_die( 'Unknown app: ' . esc_attr( $app_slug ) );
			}

			if ( ! wp_verify_nonce( Utils::get_super_global_value( $_GET, 'nonce' ), $nonce_action ) ) {
				wp_die( 'Invalid Nonce', 'Invalid Nonce', array(
					'back_link' => true,
				) );
			}

			$method = 'action_' . $action;

			if ( method_exists( $app, $method ) ) {
				call_user_func( array( $app, $method ) );
			}
		}
	}

	private function user_has_enough_permissions() {
		if ( current_user_can( 'manage_options' ) ) {
			return true;
		}

		if ( 'library' === Utils::get_super_global_value( $_GET, 'app' ) ) {
			return current_user_can( 'edit_posts' );
		}

		return false;
	}

	/**
	 * @since 2.3.0
	 * @access public
	 */
	public function __construct() {
		self::$url = admin_url( 'admin.php?page=' . self::PAGE_ID );

		add_action( 'elementor/admin/menu/register', array( $this, 'register_admin_menu' ) );

		add_action( 'elementor/admin/menu/after_register', function ( Admin_Menu_Manager $admin_menu, array $hooks ) {
			if ( ! empty( $hooks[ static::PAGE_ID ] ) ) {
				add_action( 'load-' . $hooks[ static::PAGE_ID ], array( $this, 'on_load_page' ) );
			}
		}, 10, 2 );
	}
}

<?php
/**
 * Plugin Name: Elementor
 * Description: The Elementor Website Builder has it all: drag and drop page builder, pixel perfect design, mobile responsive editing, and more. Get started now!
 * Plugin URI: https://elementor.com/?utm_source=wp-plugins&utm_campaign=plugin-uri&utm_medium=wp-dash
 * Author: Elementor.com
 * Version: 3.28.0
 * Author URI: https://elementor.com/?utm_source=wp-plugins&utm_campaign=author-uri&utm_medium=wp-dash
 *
 * Text Domain: elementor
 *
 * @package Elementor
 * @category Core
 *
 * Elementor is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * Elementor is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'ELEMENTOR_VERSION', '3.28.0' );

define( 'ELEMENTOR__FILE__', __FILE__ );
define( 'ELEMENTOR_PLUGIN_BASE', plugin_basename( ELEMENTOR__FILE__ ) );
define( 'ELEMENTOR_PATH', plugin_dir_path( ELEMENTOR__FILE__ ) );

if ( defined( 'ELEMENTOR_TESTS' ) && ELEMENTOR_TESTS ) {
	define( 'ELEMENTOR_URL', 'file://' . ELEMENTOR_PATH );
} else {
	define( 'ELEMENTOR_URL', plugins_url( '/', ELEMENTOR__FILE__ ) );
}

define( 'ELEMENTOR_MODULES_PATH', plugin_dir_path( ELEMENTOR__FILE__ ) . '/modules' );
define( 'ELEMENTOR_ASSETS_PATH', ELEMENTOR_PATH . 'assets/' );
define( 'ELEMENTOR_ASSETS_URL', ELEMENTOR_URL . 'assets/' );

if ( file_exists( ELEMENTOR_PATH . 'vendor/autoload.php' ) ) {
	require_once ELEMENTOR_PATH . 'vendor/autoload.php';
	// We need this file because of the DI\create function that we are using.
	// Autoload classmap doesn't include this file.
	require_once ELEMENTOR_PATH . 'vendor_prefixed/php-di/php-di/src/functions.php';
}

if ( ! version_compare( PHP_VERSION, '7.4', '>=' ) ) {
	add_action( 'admin_notices', 'elementor_fail_php_version' );
} elseif ( ! version_compare( get_bloginfo( 'version' ), '6.3', '>=' ) ) {
	add_action( 'admin_notices', 'elementor_fail_wp_version' );
} else {
	require ELEMENTOR_PATH . 'includes/plugin.php';
}

/**
 * Elementor admin notice for minimum PHP version.
 *
 * Warning when the site doesn't have the minimum required PHP version.
 *
 * @since 1.0.0
 *
 * @return void
 */
function elementor_fail_php_version() {
	$html_message = sprintf(
		'<div class="error"><h3>%1$s</h3><p>%2$s <a href="https://go.elementor.com/wp-dash-update-php/" target="_blank">%3$s</a></p></div>',
		esc_html__( 'Elementor isn’t running because PHP is outdated.', 'elementor' ),
		sprintf(
			/* translators: %s: PHP version. */
			esc_html__( 'Update to version %s and get back to creating!', 'elementor' ),
			'7.4'
		),
		esc_html__( 'Show me how', 'elementor' )
	);

	echo wp_kses_post( $html_message );
}

/**
 * Elementor admin notice for minimum WordPress version.
 *
 * Warning when the site doesn't have the minimum required WordPress version.
 *
 * @since 1.5.0
 *
 * @return void
 */
function elementor_fail_wp_version() {
	$html_message = sprintf(
		'<div class="error"><h3>%1$s</h3><p>%2$s <a href="https://go.elementor.com/wp-dash-update-wordpress/" target="_blank">%3$s</a></p></div>',
		esc_html__( 'Elementor isn’t running because WordPress is outdated.', 'elementor' ),
		sprintf(
			/* translators: %s: WordPress version. */
			esc_html__( 'Update to version %s and get back to creating!', 'elementor' ),
			'6.3'
		),
		esc_html__( 'Show me how', 'elementor' )
	);

	echo wp_kses_post( $html_message );
}

// TODO: Remove when the minimum required WordPress version is 6.5 or higher.
if ( ! function_exists( 'wp_enqueue_script_module' ) ) {
	function wp_enqueue_script_module( $handle, $src = '', $dependencies = [], $version = false ): void {
		$bc_handle = '__elementor_wp_bc_' . $handle;

		if ( ! wp_script_is( $bc_handle, 'registered' ) ) {
			wp_register_script_module( $bc_handle, $src, $dependencies, $version );

		}

		wp_enqueue_script( $bc_handle );
	}
}

// TODO: Remove when the minimum required WordPress version is 6.5 or higher.
if ( ! function_exists( 'wp_register_script_module' ) ) {
	function wp_register_script_module( $handle, $src, $dependencies = [], $version = false ): void {
		$bc_handle = '__elementor_wp_bc_' . $handle;

		wp_register_script( $bc_handle, $src, $dependencies, $version, true );

		add_filter( 'script_loader_tag', function ( $tag, $script_handle ) use ( $bc_handle ) {
			if ( $script_handle === $bc_handle ) {
				$tag = str_replace( '<script ', '<script type="module" ', $tag );
			}
			return $tag;
		}, 10, 2 );
	}
}

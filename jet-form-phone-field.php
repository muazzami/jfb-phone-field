<?php
/**
 * Plugin Name: JetFormBuilder - Phone Field Enhancement
 * Plugin URI:
 * Description: Enhance phone field to have international prefix.
 * Version: 1.0.0
 * Author: Muazzam Imtiaz
 * Author URI: https://muazzam.dev
 * Text Domain: jet-form-phone-field
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

// trying to be sneaky, abort!!
if ( ! defined( 'WPINC' ) ) {
	die();
}

add_action(
	'plugins_loaded',
	function () {

		if ( ! function_exists( 'jet_form_builder' ) ) {

			add_action(
				'admin_notices',
				function() {
					$class   = 'notice notice-error';
					$message = '<b>WARNING!</b> <b>JetFormBuilder - Phone Field Enhancement</b> plugin requires <b>JetFormBuilder</b> plugin to be installed and activated.';
					printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), wp_kses_post( $message ) );
				}
			);

			return;

		}

		define( 'JFB_PHONE_FIELD_VERSION', '1.0.0' );

		define( 'JFB_PHONE_FIELD__FILE__', __FILE__ );
		define( 'JFB_PHONE_FIELD_PLUGIN_BASE', plugin_basename( __FILE__ ) );
		define( 'JFB_PHONE_FIELD_PATH', plugin_dir_path( __FILE__ ) );
		define( 'JFB_PHONE_FIELD_URL', plugins_url( '/', __FILE__ ) );

		require JFB_PHONE_FIELD_PATH . 'includes/plugin.php';

	},
	100
);

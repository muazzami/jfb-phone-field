<?php

namespace JFB_Phone_Field;

// wot wot?!
if ( ! defined( 'WPINC' ) ) {
	die();
}

/**
 * Undocumented class
 */
class Plugin {

	/**
	 * Instance.
	 *
	 * Holds the plugin instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var Plugin
	 */
	public static $instance = null;

	/**
	 * Constructor for Plugin
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 10 );
		add_filter( 'jet-form-builder/render/text-field', array( $this, 'maybe_phone_field' ) );
	}

	/**
	 * Check if its phone field, apply intl tel input
	 *
	 * @param [type] $args
	 * @return void
	 */
	public function maybe_phone_field( $args ) {
		$phone_class = 'intl-phone-field';

		// if field contains classname
		if ( strpos( strtolower( $args['class_name'] ), $phone_class ) !== false ) {

			// register scripts
			wp_enqueue_script( 'intltel-script' );
			wp_enqueue_script( 'jfp-script' );
			wp_enqueue_style( 'intltel-css' );

		}

		return $args;
	}

	/**
	 * Enqueue scripts and styles for the Plugin
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {
		// Register the 'intlTelInput' script.
		wp_register_script(
			'intltel-script',
			'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js',
			array(),
			'18.2.1',
			true
		);

		// Register the 'intlTelInput' CSS stylesheet.
		wp_register_style(
			'intltel-css',
			'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css',
			array(),
			'18.2.1'
		);

		// Register custom JavaScript.
		wp_register_script(
			'jfp-script',
			$this->plugin_url( 'assets/js/jfp-script.js' ),
			array( 'jquery' ),
			$this->get_version(),
			true
		);
	}

	/**
	 * Get the version number of the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return string the version number of the plugin.
	 */
	public function get_version() {
		return JFB_PHONE_FIELD_VERSION;
	}

	/**
	 * Get the complete URL for a give path within plugin.
	 *
	 * @since 1.0.0
	 *
	 * @param string $path Optional.
	 * @return string the complete URL of the path.
	 */
	public function plugin_url( $path = '' ) {
		return JFB_PHONE_FIELD_URL . $path;
	}

	/**
	 * Instance.
	 *
	 * Ensures only one instance of the plugin class is loaded or can be loaded.
	 *
	 * @return Plugin An instance of the class.
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

Plugin::instance();

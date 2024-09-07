<?php
/**
 * Plugin Name: Fusion White Label Branding
 * Plugin URI: http://www.theme-fusion.com
 * Description: White Label Branding plugin for ThemeFusion Products.
 * Version: 1.0
 * Author: ThemeFusion
 * Author URI: http://www.theme-fusion.com
 *
 * @package Fusion-White-Label-Branding
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Plugin version.
if ( ! defined( 'FUSION_WHITE_LABEL_BRANDING_VERSION' ) ) {
	define( 'FUSION_WHITE_LABEL_BRANDING_VERSION', '1.0' );
}
// Plugin Folder Path.
if ( ! defined( 'FUSION_WHITE_LABEL_BRANDING_PLUGIN_DIR' ) ) {
	define( 'FUSION_WHITE_LABEL_BRANDING_PLUGIN_DIR', wp_normalize_path( plugin_dir_path( __FILE__ ) ) );
}
// Plugin Folder URL.
if ( ! defined( 'FUSION_WHITE_LABEL_BRANDING_PLUGIN_URL' ) ) {
	define( 'FUSION_WHITE_LABEL_BRANDING_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
// Plugin Root File.
if ( ! defined( 'FUSION_WHITE_LABEL_BRANDING_PLUGIN_FILE' ) ) {
	define( 'FUSION_WHITE_LABEL_BRANDING_PLUGIN_FILE', __FILE__ );
}

if ( ! class_exists( 'Fusion_White_Label_Branding' ) ) {

	/**
	 * Main Fusion_White_Label_Branding Class.
	 *
	 * @since 1.0
	 */
	class Fusion_White_Label_Branding {

		/**
		 * The one, true instance of this object.
		 *
		 * @since 1.0
		 * @static
		 * @access private
		 * @var object
		 */
		private static $instance;

		/**
		 * Creates or returns an instance of this class.
		 *
		 * @since 1.0
		 * @static
		 * @access public
		 */
		public static function get_instance() {

			// If an instance hasn't been created and set to $instance create an instance and set it to $instance.
			if ( null === self::$instance ) {
				self::$instance = new Fusion_White_Label_Branding();
			}
			return self::$instance;
		}

		/**
		 * Initializes the plugin by setting localization, hooks, filters,
		 * and administrative functions.
		 *
		 * @since 1.0
		 * @access private
		 */
		private function __construct() {

			// Include required files.
			$this->includes();

		}

		/**
		 * Include required files.
		 *
		 * @access private
		 * @since 1.0
		 * @return void
		 */
		private function includes() {
			require_once FUSION_WHITE_LABEL_BRANDING_PLUGIN_DIR . 'inc/fusion-branding-admin.php';
		}
	}
} // End if().

/**
 * Instantiate Fusion_White_Label_Branding class.
 *
 * @since 1.0
 * @return void
 */
function fusion_white_label_branding_activate() {
	Fusion_White_Label_Branding::get_instance();
}
add_action( 'after_setup_theme', 'fusion_white_label_branding_activate', 11 );

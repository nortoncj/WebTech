<?php
/**
 * @package Leverage
 */

require_once ( get_template_directory() . '/inc/tgm-plugin-activation.php' );

function leverage_register_required_plugins() {
	$plugins = array(
		array(
			'name'               => 'Leverage Extra',
			'slug'               => 'leverage-extra',
			'source'             => 'https://leverage.codings.dev/plugins/2.0.7/leverage-extra.zip',
			'required'           => true,
			'version'            => '1.0.9',
			'force_activation'   => false,
			'force_deactivation' => false
		),
		array(
			'name'               => 'Advanced Custom Fields PRO',
			'slug'               => 'advanced-custom-fields-pro',
			'source'             => 'https://leverage.codings.dev/plugins/2.0.7/advanced-custom-fields-pro.zip',
			'required'           => true,
			'version'            => '5.9.5',
			'force_activation'   => false,
			'force_deactivation' => false
		),
		array(
			'name'               => 'ACF: Font Awesome',
			'slug'               => 'advanced-custom-fields-font-awesome',
			'source'             => 'https://leverage.codings.dev/plugins/2.0.7/advanced-custom-fields-font-awesome.zip',
			'required'           => true,
			'version'            => '3.1.1',
			'force_activation'   => false,
			'force_deactivation' => false
		),
		array(
			'name'               => 'One Click Demo Import',
			'slug'               => 'one-click-demo-import',
			'source'             => 'https://leverage.codings.dev/plugins/2.0.7/one-click-demo-import.zip',
			'required'           => true,
			'version'            => '3.0.1',
			'force_activation'   => false,
			'force_deactivation' => false
		),
		array(
			'name'               => 'Envato Market',
			'slug'               => 'envato-market',
			'source'             => 'https://leverage.codings.dev/plugins/2.0.7/envato-market.zip',
			'required'           => true,
			'version'            => '2.0.6',
			'force_activation'   => false,
			'force_deactivation' => false
		),
	);

	$config = array(
		'id'           => 'leverage',
		'default_path' => '',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'leverage_register_required_plugins' );
<?php
/**
 * @package Leverage
 */

require_once ( get_template_directory() . '/inc/theme-support.php' );
require_once ( get_template_directory() . '/inc/theme-settings.php' );
require_once ( get_template_directory() . '/inc/enqueue-assets.php' );
require_once ( get_template_directory() . '/inc/navwalker.php' );
require_once ( get_template_directory() . '/inc/breadcrumb.php' );
require_once ( get_template_directory() . '/inc/comment-callback.php' );
require_once ( get_template_directory() . '/inc/template-tags.php' );
require_once ( get_template_directory() . '/inc/template-functions.php' );
require_once ( get_template_directory() . '/inc/customizer.php' );
require_once ( get_template_directory() . '/inc/register-required-plugins.php' );

if ( function_exists( 'ACF' ) ) {
	require_once ( get_template_directory() . '/inc/import-demos.php' );
	require_once ( get_template_directory() . '/inc/import-fields-data.php' );
	require_once ( get_template_directory() . '/inc/admin/leverage-release-notes.php' );
}

if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

if ( defined( 'JETPACK__VERSION' ) ) {
	require_once ( get_template_directory() . '/inc/jetpack.php' );
}
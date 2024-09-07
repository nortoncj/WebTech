<?php
/**
 * @package Leverage
 */

add_filter( 'acf/settings/save_json', 'leverage_acf_json_save_point' );

function leverage_acf_json_save_point( $path ) {
	$path = get_template_directory() . '/inc/acf-json';
    return $path;
}

add_filter( 'acf/settings/load_json', 'leverage_acf_json_load_point' );

function leverage_acf_json_load_point( $paths ) {
	$paths = array( get_template_directory() . '/inc/acf-json' );    
	if ( is_child_theme() ) {
		$paths[] = get_stylesheet_directory() . '/inc/acf-json';
	}
	return $paths;    
}

if ( function_exists( 'acf_add_options_page' ) && function_exists( 'acf_add_options_sub_page' ) ) {

	acf_add_options_page(array(
		'page_title' => esc_html__( 'Theme Settings', 'leverage' ),
		'menu_title' => esc_html__( 'Theme Settings', 'leverage' ),
		'menu_slug'  => 'theme-settings',
		'capability' => 'edit_posts',
		'icon_url'   => get_template_directory_uri().'/assets/images/dash-icon.png'
	) );

	if ( ! function_exists( 'leverage_theme_settings' ) ) {
		acf_add_options_sub_page( array(
			'page_title'  => esc_html__( 'Support', 'leverage' ),
			'menu_title'  => esc_html__( 'Support', 'leverage' ),
			'menu_slug'   => 'theme-settings-support',
			'parent_slug' => 'theme-settings'
		) );
	}
}

if ( function_exists( 'ACF' ) ) {	
	if ( get_field( 'disable_acf_item', 'option' ) ) {
		add_filter('acf/settings/show_admin', '__return_false');
	}
}
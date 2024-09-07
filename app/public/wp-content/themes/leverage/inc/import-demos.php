<?php
/**
 * @package Leverage
 */

function leverage_import_demos() {

	function leverage_import_demos_item( $title, $slug, $categories ) {

		return array(
			'categories'               => $categories,
			'import_file_name'         => $title,
			'import_file_url'          => 'https://leverage.codings.dev/import-data/2.0/' . $slug . '.xml',
			'import_widget_file_url'   => 'https://leverage.codings.dev/import-data/2.0/widgets.json',
		 	'import_preview_image_url' =>  get_template_directory_uri().'/assets/images/' . str_replace( '-one-page', '', $slug ) . '.jpg',
			'preview_url'              => 'https://leverage.codings.dev/' . $slug
        );
	}

	return array(

		// Demo 1
		leverage_import_demos_item( 'Demo 1', 'demo-1', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 1 (One-Page)', 'demo-1-one-page', array( 'One-Page' ) ),

		// Demo 2
		leverage_import_demos_item( 'Demo 2', 'demo-2', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 2 (One-Page)', 'demo-2-one-page', array( 'One-Page' ) ),

		// Demo 3
		leverage_import_demos_item( 'Demo 3', 'demo-3', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 3 (One-Page)', 'demo-3-one-page', array( 'One-Page' ) ),

		// Demo 4
		leverage_import_demos_item( 'Demo 4', 'demo-4', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 4 (One-Page)', 'demo-4-one-page', array( 'One-Page' ) ),

		// Demo 5
		leverage_import_demos_item( 'Demo 5', 'demo-5', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 5 (One-Page)', 'demo-5-one-page', array( 'One-Page' ) ),

		// Demo 6
		leverage_import_demos_item( 'Demo 6', 'demo-6', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 6 (One-Page)', 'demo-6-one-page', array( 'One-Page' ) ),

		// Demo 7
		leverage_import_demos_item( 'Demo 7', 'demo-7', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 7 (One-Page)', 'demo-7-one-page', array( 'One-Page' ) ),

		// Demo 8
		leverage_import_demos_item( 'Demo 8', 'demo-8', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 8 (One-Page)', 'demo-8-one-page', array( 'One-Page' ) ),

		// Demo 9
		leverage_import_demos_item( 'Demo 9', 'demo-9', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 9 (One-Page)', 'demo-9-one-page', array( 'One-Page' ) ),

		// Demo 10
		leverage_import_demos_item( 'Demo 10', 'demo-10', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 10 (One-Page)', 'demo-10-one-page', array( 'One-Page' ) ),

		// Demo 11
		leverage_import_demos_item( 'Demo 11', 'demo-11', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 11 (One-Page)', 'demo-11-one-page', array( 'One-Page' ) ),

		// Demo 12
		leverage_import_demos_item( 'Demo 12', 'demo-12', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 12 (One-Page)', 'demo-12-one-page', array( 'One-Page' ) ),

		// Demo 13
		leverage_import_demos_item( 'Demo 13', 'demo-13', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 13 (One-Page)', 'demo-13-one-page', array( 'One-Page' ) ),

		// Demo 14
		leverage_import_demos_item( 'Demo 14', 'demo-14', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 14 (One-Page)', 'demo-14-one-page', array( 'One-Page' ) ),

		// Demo 15
		leverage_import_demos_item( 'Demo 15', 'demo-15', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 15 (One-Page)', 'demo-15-one-page', array( 'One-Page' ) ),

		// Demo 16
		leverage_import_demos_item( 'Demo 16', 'demo-16', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 16 (One-Page)', 'demo-16-one-page', array( 'One-Page' ) ),

		// Demo 17
		leverage_import_demos_item( 'Demo 17', 'demo-17', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 17 (One-Page)', 'demo-17-one-page', array( 'One-Page' ) ),

		// Demo 18
		leverage_import_demos_item( 'Demo 18', 'demo-18', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 18 (One-Page)', 'demo-18-one-page', array( 'One-Page' ) ),

		// Demo 19
		leverage_import_demos_item( 'Demo 19', 'demo-19', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 19 (One-Page)', 'demo-19-one-page', array( 'One-Page' ) ),

		// Demo 20
		leverage_import_demos_item( 'Demo 20', 'demo-20', array( 'Multi-Page' ) ),
		leverage_import_demos_item( 'Demo 20 (One-Page)', 'demo-20-one-page', array( 'One-Page' ) ),
	);
}
add_filter( 'pt-ocdi/import_files', 'leverage_import_demos' );

function leverage_after_import( $selected ) {

/* #region Options */
	
	// Set Blog Posts
	if ( strpos( $selected['import_file_name'], '(One-Page)' ) === false ) {
		$blog = get_page_by_title( 'Blog' );		
		update_option( 'page_for_posts', $blog->ID );
	}

	// Set Home Page
	$home = get_page_by_title( str_replace( 'Demo', 'Home', $selected['import_file_name'] ) );
	update_option( 'page_on_front', $home->ID );
	update_option( 'show_on_front', 'page' );

	// Set Menu
	$leverage_menu_title  = 'Leverage Menu: ' . $selected['import_file_name'];
	$leverage_menu        = get_term_by( 'name', $leverage_menu_title, 'nav_menu' );
	$locations            = get_theme_mod( 'nav_menu_locations' );
	$locations['primary'] = $leverage_menu->term_id;
	set_theme_mod( 'nav_menu_locations', $locations );

/* #endregion Options */

/* #region Fields */

	// Set Fields Data
	leverage_add_header();
	leverage_add_footer();
	leverage_add_widget();

	// Demo 1
	if ( strpos( $selected['import_file_name'], 'Demo 1' ) !== false ) {

		leverage_add_news_section( 'simple' );
		leverage_add_subscribe_form( 'simple' );
		leverage_add_simple_form( 'simple' );
		leverage_add_multi_step_form( 'featured' );

		leverage_add_theme_settings( 
			'css/theme-orange.css', // Theme Color
			'dark', // Theme Mode
			'outlined', // Button Mode
			'#111111', // Body Bg
			true,      // Body Dark Mode
			'#040402', // Header Bg
			'#f5f5f5', // Nav Item Color
			'#f5f5f5', // Top Nav Item Color
			'#040402', // Hero Bg
			true,      // Hero Dark Mode
			'#111111', // News Bg
			'#191919', // Subs Bg
			'#111111', // Form Bg
			true,      // Footer Dark Mode
			'#191919', // Footer
			'multi-step-form' // Form Mode
		); 
	}

	// Demo 2
	if ( strpos( $selected['import_file_name'], 'Demo 2' ) !== false ) {

		leverage_add_news_section( 'simple' );
		leverage_add_subscribe_form( 'simple' );
		leverage_add_simple_form( 'simple' );
		leverage_add_multi_step_form( 'featured' );

		leverage_add_theme_settings( 
			'css/theme-pink.css', // Theme Color
			'default', // Theme Mode
			'default', // Button Mode
			'#f5f5f5', // Body Bg
			0,         // Body Dark Mode
			'#111111', // Header Bg
			'#f5f5f5', // Nav Item Color
			'#f5f5f5', // Top Nav Item Color
			'#111111', // Hero Bg
			true,      // Hero Dark Mode
			'#eeeeee', // News Bg
			'#e5e5e5', // Subs Bg
			'#f5f5f5', // Form Bg
			true,      // Footer Dark Mode
			'#191919', // Footer
			'simple-form' // Form Mode
		); 
	}

	// Demo 3
	if ( strpos( $selected['import_file_name'], 'Demo 3' ) !== false ) {

		leverage_add_news_section( 'super effect-static-text' );
		leverage_add_subscribe_form( 'super effect-static-text' );
		leverage_add_simple_form( 'super effect-static-text' );
		leverage_add_multi_step_form( 'super effect-static-text' );

		leverage_add_theme_settings( 
			'css/theme-light-blue.css', // Theme Color
			'default', // Theme Mode
			'default', // Button Mode
			'#f5f5f5', // Body Bg
			 0,        // Body Dark Mode
			'#111117', // Header Bg
			'#f5f5f5', // Nav Item Color
			'#f5f5f5', // Top Nav Item Color
			'#111117', // Hero Bg
			true,      // Hero Dark Mode
			'#eeeeee', // News Bg
			'#e5e5e5', // Subs Bg
			'#f5f5f5', // Form Bg
			true,      // Footer Dark Mode
			'#16161c', // Footer
			'multi-step-form' // Form Mode
		); 
	}

	// Demo 4
	if ( strpos( $selected['import_file_name'], 'Demo 4' ) !== false ) {

		leverage_add_news_section( 'simple' );
		leverage_add_subscribe_form( 'simple' );
		leverage_add_simple_form( 'simple' );
		leverage_add_multi_step_form( 'featured' );

		leverage_add_theme_settings( 
			'css/theme-orange.css', // Theme Color
			'default', // Theme Mode
			'default', // Button Mode
			'#ffffff', // Body Bg
			 0,        // Body Dark Mode
			'#f5f5f5', // Header Bg
			'#2f323a', // Nav Item Color
			'#2f323a', // Top Nav Item Color
			'#f5f5f5', // Hero Bg
			0,         // Hero Dark Mode
			'#e5e5e5', // News Bg
			'#f5f5f5', // Subs Bg
			'#eeeeee', // Form Bg
			true,      // Footer Dark Mode
			'#191919', // Footer
			'multi-step-form' // Form Mode
		); 

		$hero_bg_image = array(	
			'opacity_control' => 90
		);
	
		update_field( 'hero_bg_image', $hero_bg_image, 'option' );
	}

	// Demo 5
	if ( strpos( $selected['import_file_name'], 'Demo 5' ) !== false ) {

		leverage_add_news_section( 'simple' );
		leverage_add_subscribe_form( 'simple' );
		leverage_add_simple_form( 'simple' );
		leverage_add_multi_step_form( 'featured' );

		leverage_add_theme_settings( 
			'css/theme-light-blue.css', // Theme Color
			'default', // Theme Mode
			'default', // Button Mode
			'#f5f5f5', // Body Bg
			0,         // Body Dark Mode
			'#111111', // Header Bg
			'#f5f5f5', // Nav Item Color
			'#f5f5f5', // Top Nav Item Color
			'#111111', // Hero Bg
			0,         // Hero Dark Mode
			'#f5f5f5', // News Bg
			'#eeeeee', // Subs Bg
			'#111111', // Form Bg
			true,      // Footer Dark Mode
			'#191919', // Footer
			'simple-form' // Form Mode
		); 
	}

	// Demo 6
	if ( strpos( $selected['import_file_name'], 'Demo 6' ) !== false ) {

		leverage_add_news_section( 'simple' );
		leverage_add_subscribe_form( 'simple' );
		leverage_add_simple_form( 'simple' );
		leverage_add_multi_step_form( 'featured' );

		leverage_add_theme_settings( 
			'css/theme-indigo.css', // Theme Color
			'default', // Theme Mode
			'default', // Button Mode
			'#ffffff', // Body Bg
			0,     // Body Dark Mode
			'#f5f5f5', // Header Bg
			'#2f323a', // Nav Item Color
			'#2f323a', // Top Nav Item Color
			'#f5f5f5', // Hero Bg
			0,     // Hero Dark Mode
			'#f5f5f5', // News Bg
			'#f5f5f5', // Subs Bg
			'#f5f5f5', // Form Bg
			0,     // Footer Dark Mode
			'#eeeeee', // Footer
			'multi-step-form' // Form Mode
		); 

		$hero_bg_image = array(	
			'opacity_control' => 90
		);
	
		update_field( 'hero_bg_image', $hero_bg_image, 'option' );
	}

	// Demo 7
	if ( strpos( $selected['import_file_name'], 'Demo 7' ) !== false ) {

		leverage_add_news_section( 'simple' );
		leverage_add_subscribe_form( 'simple' );
		leverage_add_simple_form( 'simple' );
		leverage_add_multi_step_form( 'featured' );

		leverage_add_theme_settings( 
			'css/theme-pink.css', // Theme Color
			'dark', // Theme Mode
			'outlined', // Button Mode
			'#111111', // Body Bg
			true,      // Body Dark Mode
			'#040402', // Header Bg
			'#f5f5f5', // Nav Item Color
			'#f5f5f5', // Top Nav Item Color
			'#040402', // Hero Bg
			true,      // Hero Dark Mode
			'#040402', // News Bg
			'#111111', // Subs Bg
			'#040402', // Form Bg
			true,      // Footer Dark Mode
			'#191919', // Footer
			'multi-step-form' // Form Mode
		); 
	}

	// Demo 8
	if ( strpos( $selected['import_file_name'], 'Demo 8' ) !== false ) {

		leverage_add_news_section( 'simple' );
		leverage_add_subscribe_form( 'simple' );
		leverage_add_simple_form( 'simple' );
		leverage_add_multi_step_form( 'featured' );

		leverage_add_theme_settings( 
			'css/theme-yellow.css', // Theme Color
			'dark', // Theme Mode
			'outlined', // Button Mode
			'#111111', // Body Bg
			true,      // Body Dark Mode
			'#111111', // Header Bg
			'#f5f5f5', // Nav Item Color
			'#f5f5f5', // Top Nav Item Color
			'#040402', // Hero Bg
			true,      // Hero Dark Mode
			'#eeeeee', // News Bg
			'#e5e5e5', // Subs Bg
			'#f5f5f5', // Form Bg
			true,      // Footer Dark Mode
			'#191919', // Footer
			'simple-form' // Form Mode
		); 
	}

	// Demo 9
	if ( strpos( $selected['import_file_name'], 'Demo 9' ) !== false ) {

		leverage_add_news_section( 'super effect-static-text' );
		leverage_add_subscribe_form( 'super effect-static-text' );
		leverage_add_simple_form( 'super effect-static-text' );
		leverage_add_multi_step_form( 'super effect-static-text' );

		leverage_add_theme_settings( 
			'css/theme-indigo.css', // Theme Color
			'default', // Theme Mode
			'default', // Button Mode
			'#f5f5f5', // Body Bg
			0,         // Body Dark Mode
			'#111111', // Header Bg
			'#f5f5f5', // Nav Item Color
			'#f5f5f5', // Top Nav Item Color
			'#111111', // Hero Bg
			true,      // Hero Dark Mode
			'#eeeeee', // News Bg
			'#e5e5e5', // Subs Bg
			'#111111', // Form Bg
			true,      // Footer Dark Mode
			'#191919', // Footer
			'multi-step-form' // Form Mode
		); 
	}

	// Demo 10
	if ( strpos( $selected['import_file_name'], 'Demo 10' ) !== false ) {

		leverage_add_news_section( 'simple' );
		leverage_add_subscribe_form( 'simple' );
		leverage_add_simple_form( 'simple' );
		leverage_add_multi_step_form( 'featured' );

		leverage_add_theme_settings( 
			'css/theme-white-blue.css', // Theme Color
			'default', // Theme Mode
			'default', // Button Mode
			'#f5f5f5', // Body Bg
			0,         // Body Dark Mode
			'#1e50bc', // Header Bg
			'#f5f5f5', // Nav Item Color
			'#f5f5f5', // Top Nav Item Color
			'#1e50bc', // Hero Bg
			true,      // Hero Dark Mode
			'#eeeeee', // News Bg
			'#1e50bc', // Subs Bg
			'#f5f5f5', // Form Bg
			true,      // Footer Dark Mode
			'#16161c', // Footer
			'simple-form' // Form Mode
		); 
	}

	// Demo 11
	if ( strpos( $selected['import_file_name'], 'Demo 11' ) !== false ) {

		leverage_add_news_section( 'simple' );
		leverage_add_subscribe_form( 'simple' );
		leverage_add_simple_form( 'simple' );
		leverage_add_multi_step_form( 'featured' );

		leverage_add_theme_settings( 
			'css/theme-light-green.css', // Theme Color
			'dark', // Theme Mode
			'outlined', // Button Mode
			'#111111', // Body Bg
			true,      // Body Dark Mode
			'#040402', // Header Bg
			'#f5f5f5', // Nav Item Color
			'#f5f5f5', // Top Nav Item Color
			'#040402', // Hero Bg
			true,      // Hero Dark Mode
			'#040402', // News Bg
			'#111111', // Subs Bg
			'#040402', // Form Bg
			true,      // Footer Dark Mode
			'#191919', // Footer
			'multi-step-form' // Form Mode
		);  
	}

	// Demo 12
	if ( strpos( $selected['import_file_name'], 'Demo 12' ) !== false ) {

		leverage_add_news_section( 'simple' );
		leverage_add_subscribe_form( 'simple' );
		leverage_add_simple_form( 'simple' );
		leverage_add_multi_step_form( 'featured' );

		leverage_add_theme_settings( 
			'css/theme-indigo.css', // Theme Color
			'default', // Theme Mode
			'default', // Button Mode
			'#ffffff', // Body Bg
			0,        // Body Dark Mode
			'#f5f5f5', // Header Bg
			'#2f323a', // Nav Item Color
			'#2f323a', // Top Nav Item Color
			'#f5f5f5', // Hero Bg
			0,         // Hero Dark Mode
			'#eeeeee', // News Bg
			'#e5e5e5', // Subs Bg
			'#f5f5f5', // Form Bg
			0,      // Footer Dark Mode
			'#eeeeee', // Footer
			'simple-form' // Form Mode
		);  

		$hero_bg_image = array(	
			'opacity_control' => 90
		);
	
		update_field( 'hero_bg_image', $hero_bg_image, 'option' );
	}

	// Demo 13
	if ( strpos( $selected['import_file_name'], 'Demo 13' ) !== false ) {

		leverage_add_news_section( 'simple' );
		leverage_add_subscribe_form( 'simple' );
		leverage_add_simple_form( 'simple' );
		leverage_add_multi_step_form( 'featured' );

		leverage_add_theme_settings( 
			'css/theme-blue.css', // Theme Color
			'default', // Theme Mode
			'default', // Button Mode
			'#ffffff', // Body Bg
			0,         // Body Dark Mode
			'#f5f5f5', // Header Bg
			'#2f323a', // Nav Item Color
			'#2f323a', // Top Nav Item Color
			'#f5f5f5', // Hero Bg
			0,         // Hero Dark Mode
			'#f5f5f5', // News Bg
			'#eeeeee', // Subs Bg
			'#111111', // Form Bg
			true,      // Footer Dark Mode
			'#191919', // Footer
			'multi-step-form' // Form Mode
		);  

		$hero_bg_image = array(	
			'opacity_control' => 90
		);
	
		update_field( 'hero_bg_image', $hero_bg_image, 'option' );
	}

	// Demo 14
	if ( strpos( $selected['import_file_name'], 'Demo 14' ) !== false ) {

		leverage_add_news_section( 'super effect-static-text' );
		leverage_add_subscribe_form( 'super effect-static-text' );
		leverage_add_simple_form( 'super effect-static-text' );
		leverage_add_multi_step_form( 'super effect-static-text' );

		leverage_add_theme_settings( 
			'css/theme-yellow.css', // Theme Color
			'default', // Theme Mode
			'outlined', // Button Mode
			'#0a131a', // Body Bg
			true,      // Body Dark Mode
			'#121a21', // Header Bg
			'#f5f5f5', // Nav Item Color
			'#f5f5f5', // Top Nav Item Color
			'#0a131a', // Hero Bg
			true,      // Hero Dark Mode
			'#121a21', // News Bg
			'#192931', // Subs Bg
			'#0a131a', // Form Bg
			true,      // Footer Dark Mode
			'#121a21', // Footer
			'simple-form' // Form Mode
		);
	}

	// Demo 15
	if ( strpos( $selected['import_file_name'], 'Demo 15' ) !== false ) {

		leverage_add_news_section( 'super effect-static-text' );
		leverage_add_subscribe_form( 'super effect-static-text' );
		leverage_add_simple_form( 'super effect-static-text' );
		leverage_add_multi_step_form( 'super effect-static-text' );

		leverage_add_theme_settings( 
			'css/theme-pink.css', // Theme Color
			'default', // Theme Mode
			'default', // Button Mode
			'#f5f5f5', // Body Bg
			0,         // Body Dark Mode
			'rgba(221, 30, 75, 0.75)', // Header Bg
			'#f5f5f5', // Nav Item Color
			'#f5f5f5', // Top Nav Item Color
			'#000000', // Hero Bg
			true,      // Hero Dark Mode
			'#eeeeee', // News Bg
			'#e5e5e5', // Subs Bg
			'#f5f5f5', // Form Bg
			0,      // Footer Dark Mode
			'#f9d9e0', // Footer
			'simple-form' // Form Mode
		); 
	}

	// Demo 16
	if ( strpos( $selected['import_file_name'], 'Demo 16' ) !== false ) {

		leverage_add_news_section( 'super effect-static-text' );
		leverage_add_subscribe_form( 'super effect-static-text' );
		leverage_add_simple_form( 'super effect-static-text' );
		leverage_add_multi_step_form( 'super effect-static-text' );

		leverage_add_theme_settings( 
			'css/theme-orange.css', // Theme Color
			'dark', // Theme Mode
			'outlined', // Button Mode
			'#111117', // Body Bg
			true,      // Body Dark Mode
			'#16161c', // Header Bg
			'#f5f5f5', // Nav Item Color
			'#f5f5f5', // Top Nav Item Color
			'#16161c', // Hero Bg
			true,      // Hero Dark Mode
			'#111117', // News Bg
			'#16161c', // Subs Bg
			'#111117', // Form Bg
			true,      // Footer Dark Mode
			'#16161c', // Footer
			'multi-step-form' // Form Mode
		); 
	}

	// Demo 17
	if ( strpos( $selected['import_file_name'], 'Demo 17' ) !== false ) {
		
		leverage_add_news_section( 'super effect-static-text' );
		leverage_add_subscribe_form( 'super effect-static-text' );
		leverage_add_simple_form( 'super effect-static-text' );
		leverage_add_multi_step_form( 'super effect-static-text' );

		leverage_add_theme_settings( 
			'css/theme-light-blue.css', // Theme Color
			'default', // Theme Mode
			'outlined', // Button Mode
			'#f5f5f5', // Body Bg
			0,      // Body Dark Mode
			'#251f37', // Header Bg
			'#f5f5f5', // Nav Item Color
			'#f5f5f5', // Top Nav Item Color
			'#160f29', // Hero Bg
			true,      // Hero Dark Mode
			'#160f29', // News Bg
			'#251f37', // Subs Bg
			'#1d1730', // Form Bg
			true,      // Footer Dark Mode
			'#251f37', // Footer
			'simple-form' // Form Mode
		); 
	}

	// Demo 18
	if ( strpos( $selected['import_file_name'], 'Demo 18' ) !== false ) {

		leverage_add_news_section( 'super effect-static-text' );
		leverage_add_subscribe_form( 'super effect-static-text' );
		leverage_add_simple_form( 'super effect-static-text' );
		leverage_add_multi_step_form( 'super effect-static-text' );

		leverage_add_theme_settings( 
			'css/theme-light-green.css', // Theme Color
			'default', // Theme Mode
			'outlined', // Button Mode
			'#f5f5f5', // Body Bg
			0,      // Body Dark Mode
			'#0a2e36', // Header Bg
			'#f5f5f5', // Nav Item Color
			'#f5f5f5', // Top Nav Item Color
			'#08181c', // Hero Bg
			true,      // Hero Dark Mode
			'#0a2e36', // News Bg
			'#08181c', // Subs Bg
			'#0a2e36', // Form Bg
			true,      // Footer Dark Mode
			'#08181c', // Footer
			'simple-form' // Form Mode
		); 
	}

	// Demo 19
	if ( strpos( $selected['import_file_name'], 'Demo 19' ) !== false ) {

		leverage_add_news_section( 'super effect-static-text' );
		leverage_add_subscribe_form( 'super effect-static-text' );
		leverage_add_simple_form( 'super effect-static-text' );
		leverage_add_multi_step_form( 'super effect-static-text' );

		leverage_add_theme_settings( 
			'css/theme-blue.css', // Theme Color
			'default', // Theme Mode
			'default', // Button Mode
			'#ffffff', // Body Bg
			0,        // Body Dark Mode
			'#f5f5f5', // Header Bg
			'#2f323a', // Nav Item Color
			'#2f323a', // Top Nav Item Color
			'#f5f5f5', // Hero Bg
			0,         // Hero Dark Mode
			'#e5e5e5', // News Bg
			'#eeeeee', // Subs Bg
			'#f5f5f5', // Form Bg
			0,      // Footer Dark Mode
			'#e5e5e5', // Footer
			'multi-step-form' // Form Mode
		); 

		$hero_bg_image = array(	
			'opacity_control' => 90
		);
	
		update_field( 'hero_bg_image', $hero_bg_image, 'option' );
	}

	// Demo 20
	if ( strpos( $selected['import_file_name'], 'Demo 20' ) !== false ) {

		leverage_add_news_section( 'simple' );
		leverage_add_subscribe_form( 'simple' );
		leverage_add_simple_form( 'simple' );
		leverage_add_multi_step_form( 'featured' );

		leverage_add_theme_settings( 
			'css/theme-white.css', // Theme Color
			'dark',    // Theme Mode
			'outline', // Button Mode
			'#191919', // Body Bg
			true,     // Body Dark Mode
			'#111111', // Header Bg
			'#f5f5f5', // Nav Item Color
			'#f5f5f5', // Top Nav Item Color
			'#111111', // Hero Bg
			true,      // Hero Dark Mode
			'#111111', // News Bg
			'#191919', // Subs Bg
			'#111111', // Form Bg
			true,      // Footer Dark Mode
			'#191919', // Footer
			'multi-step-form' // Form Mode
		); 
	}

/* #endregion Fields */	
}
add_action( 'pt-ocdi/after_import', 'leverage_after_import' );
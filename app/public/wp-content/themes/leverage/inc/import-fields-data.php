<?php
/**
 * @package Leverage
 */

function leverage_add_news_section( $heading_style ) {

    // Heading
    update_field( 'news_text_align', 'text-md-center', 'option' );
    update_field( 'news_heading_style', $heading_style, 'option' );

    if ( ! get_field( 'news_title', 'option' ) ) {
        update_field( 'news_title', 'Latest News', 'option' );        
    }

    if ( ! get_field( 'news_description', 'option' ) ) {
        update_field( 'news_description', 'Every week we publish exclusive content on various topics.', 'option' );
    }
}

function leverage_add_subscribe_form( $heading_style ) {

    // Heading
    update_field( 'subscribe_text_align', 'text-md-center', 'option' );
    update_field( 'subscribe_heading_style', $heading_style, 'option' );

    if ( ! get_field( 'subscribe_title', 'option' ) ) {
        update_field( 'subscribe_title', 'Newsletter', 'option' );        
    }

    if ( ! get_field( 'subscribe_description', 'option' ) ) {
        update_field( "subscribe_description', 'Subscribe to our newsletter and follow our content closely.\nReceive news based on what has to do with you. We promise not to send promotions you don't like.", 'option' );    
    }    

    // Layout    
    update_field( 'subscribe_container', 'smaller', 'option' );

    // Sending
    if ( ! get_field( 'subscribe_sending_options', 'option' ) ) {
        update_field( 'subscribe_sending_options', 'Email Recipient', 'option' );
    }
    if ( ! get_field( 'subscribe_email_recipient', 'option' ) ) {
        update_field( 'subscribe_email_recipient', get_option('admin_email'), 'option' );
    }
}

function leverage_add_simple_form( $heading_style ) {

    // Heading
    update_field( 'simple_form_text_align', 'text-md-center', 'option' );
    update_field( 'simple_form_heading_style', $heading_style, 'option' );

    if ( ! get_field( 'simple_form_title', 'option' ) ) {
        update_field( 'simple_form_title', 'Let\'s Talk?', 'option' );
    }

    if ( ! get_field( 'simple_form_description', 'option' ) ) {
        update_field( 'simple_form_description', 'Talk to one of our consultants today and learn how to start leveraging your business.', 'option' );
    }

    if ( ! get_field( 'simple_form_button_label', 'option' ) ) {
        update_field( 'simple_form_button_label', 'SEND', 'option' );
    }

    // Fields [simple_form_fields]
    if ( ! get_field( 'simple_form_fields', 'option' ) ) {
        add_row( 'field_5f56ce97f1c65', array( 'acf_fc_layout' => 'text_field', 'field'      => 'Name' ), 'option' );
        add_row( 'field_5f56ce97f1c65', array( 'acf_fc_layout' => 'email_field', 'field'     => 'Email' ), 'option' );
        add_row( 'field_5f56ce97f1c65', array( 'acf_fc_layout' => 'number_field', 'field'    => 'Phone' ), 'option' );
        add_row( 'field_5f56ce97f1c65', array( 'acf_fc_layout' => 'select_field', 'field'    => "Less than $2.000\n$2.000 — $5.000\n$5.000 — $10.000\n$10,000+" ), 'option' );
        add_row( 'field_5f56ce97f1c65', array( 'acf_fc_layout' => 'text_area_field', 'field' => 'Message' ), 'option' );
    }

    // Sending
    if ( ! get_field( 'form_sending_options', 'option' ) ) {
        update_field( 'form_sending_options', 'Email Recipient', 'option' );        
    }

    if ( ! get_field( 'form_email_recipient', 'option' ) ) {
        update_field( 'form_email_recipient', get_option('admin_email'), 'option' );        
    }

    if ( ! get_field( 'form_success_message', 'option' ) ) {
        update_field( 'form_success_message', 'Your message was sent successful. Thanks.', 'option' );        
    }

    if ( ! get_field( 'form_validation_message', 'option' ) ) {
        update_field( 'form_validation_message', 'Validation errors occurred. Please confirm the fields and submit it again.', 'option' );        
    }

    if ( ! get_field( 'form_error_message', 'option' ) ) {
        update_field( 'form_error_message', 'Sorry. We were unable to send your message.', 'option' );        
    }
}

function leverage_add_multi_step_form( $heading_style ) {

    // Heading
    if ( ! get_field( 'success_message', 'option' ) ) {
        update_field( 'success_message', "Your message was sent successful. Thanks.", 'option' );        
    }

    // Sending
    if ( ! get_field( 'form_sending_options', 'option' ) ) {
        update_field( 'form_sending_options', 'Email Recipient', 'option' );        
    }

    if ( ! get_field( 'form_email_recipient', 'option' ) ) {
        update_field( 'form_email_recipient', get_option('admin_email'), 'option' );        
    }

    if ( ! get_field( 'form_success_message', 'option' ) ) {
        update_field( 'form_success_message', 'Your message was sent successful. Thanks.', 'option' );        
    }

    if ( ! get_field( 'form_validation_message', 'option' ) ) {
        update_field( 'form_validation_message', 'Validation errors occurred. Please confirm the fields and submit it again.', 'option' );        
    }

    if ( ! get_field( 'form_error_message', 'option' ) ) {
        update_field( 'form_error_message', 'Sorry. We were unable to send your message.', 'option' );        
    }
    
    // Steps [steps]
    if ( ! get_field( 'steps', 'option' ) ) {

        add_row( 'field_5f56ce97f3fed', array( 
            'heading_style'          => $heading_style,
            'step_title'             => 'Let\'s Talk?',
            'step_progressbar_title' => 'Personal Details',
            'step_description'       => 'Don\'t wait until tomorrow. Talk to one of our consultants today and learn how to start leveraging your business.',
            'button_label_prev_step' => 'PREV',
            'button_label_next_step' => 'NEXT'
        ), 'option' );
    
        add_row( 'field_5f56ce97f3fed', array( 
            'heading_style'          => $heading_style,
            'step_title'             => 'Almost There',
            'step_progressbar_title' => 'Company Budget',
            'step_description'       => 'We need some more important information to better understand how we can help you in the best possible way.',
            'button_label_prev_step' => 'PREV',
            'button_label_next_step' => 'NEXT'
        ), 'option' );
    
        add_row( 'field_5f56ce97f3fed', array( 
            'heading_style'          => $heading_style,
            'step_title'             => 'Are you Ready?',
            'step_progressbar_title' => 'Service Setup',
            'step_description'       => 'Tell us a little about the project you need to create. This is valuable so that we can direct you to the ideal team.',
            'button_label_prev_step' => 'PREV',
            'button_label_next_step' => 'SEND'
        ), 'option' );
    
        // Rows
        if ( have_rows('steps', 'option') ) {
            while ( have_rows('steps', 'option') ) {
                the_row();
    
                if ( get_row_index() == 1 ) {
                    add_sub_row( 'step_fields', array( 'acf_fc_layout' => 'email_field', 'field'  => 'Email' ), 'option' );
                    add_sub_row( 'step_fields', array( 'acf_fc_layout' => 'text_field', 'field'   => 'Name' ), 'option' );
                    add_sub_row( 'step_fields', array( 'acf_fc_layout' => 'number_field', 'field' => 'Phone' ), 'option' );
                }
    
                if ( get_row_index() == 2 ) {
                    add_sub_row( 'step_fields', array( 'acf_fc_layout' => 'text_field', 'field'  => 'Company' ), 'option' );
                    add_sub_row( 'step_fields', array( 'acf_fc_layout' => 'text_field', 'field'   => 'Manager' ), 'option' );
                    add_sub_row( 'step_fields', array( 'acf_fc_layout' => 'select_field', 'field' => "Less than $2.000\n$2.000 — $5.000\n$5.000 — $10.000\n$10,000+" ), 'option' );
                }
    
                if ( get_row_index() == 3 ) {
                    add_sub_row( 'step_fields', array( 'acf_fc_layout' => 'text_area_field', 'field'  => 'Message' ), 'option' );
                }
            }
        }
    }
}

function leverage_add_header() {

    // Search
    if ( ! get_field( 'search_title', 'option' ) ) {
        update_field( 'search_title', 'What are you looking for?', 'option' );
    }

    if ( ! get_field( 'search_description', 'option' ) ) {
        update_field( 'search_description', 'Search for services and news about the best that happens in the world.', 'option');
    }

    if ( ! get_field( 'search_button_label', 'option' ) ) {
        update_field( 'search_button_label', 'SEARCH', 'option');
    }

    // Social Networks [social_networks]
    if ( ! get_field( 'social_networks', 'option' ) ) {
        add_row( 'field_5e9fcfb4bdd86', array( 'acf_fc_layout' => 'twitter', 'url'   => 'https://www.twitter.com' ), 'option' );
        add_row( 'field_5e9fcfb4bdd86', array( 'acf_fc_layout' => 'instagram', 'url' => 'https://www.instagram.com' ), 'option' );   
    }

    // Call to Action
    if ( ! get_field( 'button_label', 'option' ) ) {
        update_field( 'button_label', 'CONTACT US', 'option');
    }

    if ( ! get_field( 'button_icon_style', 'option' ) ) {
        update_field( 'button_icon_style', 'Line Icon', 'option');
    }

    if ( ! get_field( 'button_icon', 'option' ) ) {
        update_field( 'button_icon', 'rocket', 'option');
    }

    if ( ! get_field( 'button_target', 'option' ) ) {
        update_field( 'button_target', 'Anchor Link', 'option');
    }

    if ( ! get_field( 'button_url', 'option' ) ) {
        update_field( 'button_url', '#contact', 'option');
    }

    // Header Default
    $header_default = array(	
        'search_icon'     => true,
        'social_networks' => true,
        'call_to_action'  => true,
        'shop_cart'       => true
    );   

    update_field( 'header_default', $header_default, 'option' );

    // Header Responsive
    $header_responsive = array(	
        'search_icon'     => true,
        'call_to_action'  => true
    );    

    update_field( 'header_responsive', $header_responsive, 'option' );
}

function leverage_add_footer() {

    // Branding
    if ( ! get_field( 'brand_type', 'option' ) ) {
        update_field( 'brand_type', 'Text', 'option' );
    }

    if ( ! get_field( 'text', 'option' ) ) {
        update_field( 'text', get_bloginfo( 'name' ), 'option');
    }

    if ( ! get_field( 'description', 'option' ) ) {
        update_field( 'description', get_bloginfo( 'description', 'display' ), 'option');
    }

    // Social Networks [footer_social_networks]
    if ( ! get_field( 'footer_social_networks', 'option' ) ) {
        add_row( 'field_5ea8b1924aec4', array( 'acf_fc_layout' => 'instagram', 'url' => 'https://www.instagram.com' ), 'option' );
        add_row( 'field_5ea8b1924aec4', array( 'acf_fc_layout' => 'facebook', 'url'  => 'https://www.facebook.com' ), 'option' );
        add_row( 'field_5ea8b1924aec4', array( 'acf_fc_layout' => 'linkedin', 'url'  => 'https://www.linkedin.com' ), 'option' );
        add_row( 'field_5ea8b1924aec4', array( 'acf_fc_layout' => 'twitter', 'url'   => 'https://www.twitter.com' ), 'option' );        
    }

    // Copyright	
    if ( ! get_field( 'copyright_left_text', 'option' ) ) {
        update_field( 'copyright_left_text', 'Built with the latest version of WordPress.', 'option' );
    }
    
    if ( ! get_field( 'copyright_right_text', 'option' ) ) {
        update_field( 'copyright_right_text', '© 2021 Leverage is Proudly Powered by <a href="https://codings.dev" target="_blank" rel="nofollow">Codings</a>.', 'option' );
    }

    // Columns [columns]
    if ( ! get_field( 'columns', 'option' ) ) {
        add_row( 'field_5ea72ee2fefaa', array(
            'acf_fc_layout'     => 'items',
            'title'             => 'Get in Touch',
            'enable_button'     => true,
            'button_icon_style' => 'Line Icon',
            'button_icon'       => 'speech',
            'button_label'      => 'SEND A MESSAGE',
            'button_target'     => 'Anchor Link',
            'button_url'        => '#contact'
        ), 'option' );
        
        add_row( 'field_5ea72ee2fefaa', array(
            'acf_fc_layout'     => 'items',
            'title'             => 'Our Services'
        ), 'option' );
        
        add_row( 'field_5ea72ee2fefaa', array(
            'acf_fc_layout'     => 'pinned_tags',
            'title'             => 'Popular Tags'
        ), 'option' );

        // Rows
        if ( have_rows('columns', 'option') ) {
            while ( have_rows('columns', 'option') ) {
                the_row();

                if ( get_row_index() == 1 ) {

                    add_sub_row( 'links', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => 'phone',
                        'label'         => '+1 123 98765 4321',
                        'target'        => 'External Link',
                        'url'           => 'tel:+1 123 98765 4321'
                    ), 'option' );

                    add_sub_row( 'links', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => 'envelope',
                        'label'         => 'helo@business.com',
                        'target'        => 'External Link',
                        'url'           => 'mailto:helo@business.com'
                    ), 'option' );

                    add_sub_row( 'links', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => 'location-pin',
                        'label'         => 'Office Street, 123',
                        'target'        => 'External Link',
                        'url'           => 'https://www.google.com/maps?q=Office Street, 123'
                    ), 'option' );
                }

                if ( get_row_index() == 2 ) {

                    add_sub_row( 'links', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => '',
                        'label'         => 'Website Development',
                        'target'        => 'Anchor Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'links', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => '',
                        'label'         => 'Building Applications',
                        'target'        => 'Anchor Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'links', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => '',
                        'label'         => 'SEO & Digital Marketing',
                        'target'        => 'Anchor Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'links', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => '',
                        'label'         => 'Branding and Identity',
                        'target'        => 'Anchor Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'links', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => '',
                        'label'         => 'Digital Images & Videos',
                        'target'        => 'Anchor Link',
                        'url'           => '#'
                    ), 'option' );
                }

                if ( get_row_index() == 3 ) {

                    add_sub_row( 'tags', array(
                        'label'         => 'Mobile',
                        'target'        => 'Anchor Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'tags', array(
                        'label'         => 'Development',
                        'target'        => 'Anchor Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'tags', array(
                        'label'         => 'Technology',
                        'target'        => 'Anchor Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'tags', array(
                        'label'         => 'App',
                        'target'        => 'Anchor Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'tags', array(
                        'label'         => 'Education',
                        'target'        => 'Anchor Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'tags', array(
                        'label'         => 'Business',
                        'target'        => 'Anchor Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'tags', array(
                        'label'         => 'Health',
                        'target'        => 'Anchor Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'tags', array(
                        'label'         => 'Industry',
                        'target'        => 'Anchor Link',
                        'url'           => '#'
                    ), 'option' );
                }
            }
        }
    }

    // Footer Default
    $footer_default = array(	
        'enable_footer'	                => true,
        'enable_footer_branding'	    => true,
        'enable_footer_social_networks'	=> true,
        'enable_copyright'		        => true
    );   

    update_field( 'footer_default', $footer_default, 'option' );
}

function leverage_add_widget() {

    if ( ! get_field( 'widgets', 'option' ) ) {
        // Carousel [widgets]
        add_row( 'field_5f52a1bd966a7', array( 
            'acf_fc_layout' => 'carousel'
        ), 'option' );

        // Services [widgets]
        add_row( 'field_5f52a1bd966a7', array( 
            'acf_fc_layout' => 'services'
        ), 'option' );

        // Social Networks [widgets]
        add_row( 'field_5f52a1bd966a7', array( 
            'acf_fc_layout' => 'social_networks',
            'title'         => 'Share This'
        ), 'option' );

        // Author [widgets]
        add_row( 'field_5f52a1bd966a7', array( 
            'acf_fc_layout' => 'author',
            'pre_title'     => 'By'
        ), 'option' );

        // Rows
        if ( have_rows('widgets', 'option') ) {
            while ( have_rows('widgets', 'option') ) {
                the_row();

                // Carousel
                if ( get_row_layout() == 'carousel' ) {

                    add_sub_row( 'item', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => 'user',
                        'text'          => "<h4>Adams Baker</h4>\nMy website looks amazing with the Leverage Theme.",
                        'target'        => 'External Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'item', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => 'user',
                        'text'          => "<h4>Mary Evans</h4>\nThis company created an exclusive form. Fantastic.",
                        'target'        => 'External Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'item', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => 'user',
                        'text'          => "<h4>Sarah Lopez</h4>\nI'm loving the partnership. The support deserves 5 stars.",
                        'target'        => 'External Link',
                        'url'           => '#'
                    ), 'option' );
                }

                // Services
                if ( get_row_layout() == 'services' ) {

                    add_sub_row( 'item', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => 'globe',
                        'title'         => 'Website Pro',
                        'target'        => 'External Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'item', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => 'basket',
                        'title'         => 'E-Commerce',
                        'target'        => 'External Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'item', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => 'screen-smartphone',
                        'title'         => 'Mobile Apps',
                        'target'        => 'External Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'item', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => 'layers',
                        'title'         => 'Web Application',
                        'target'        => 'External Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'item', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => 'chart',
                        'title'         => 'Digital Marketing',
                        'target'        => 'External Link',
                        'url'           => '#'
                    ), 'option' );

                    add_sub_row( 'item', array(
                        'icon_style'    => 'Line Icon',
                        'icon'          => 'bulb',
                        'title'         => 'Brand Creation',
                        'target'        => 'External Link',
                        'url'           => '#'
                    ), 'option' );
                }

                // Social Networks
                if ( get_row_layout() == 'social_networks' ) {

                    add_sub_row( 'item', array( 'acf_fc_layout' => 'instagram', 'url' => 'https://www.instagram.com' ), 'option' );
                    add_sub_row( 'item', array( 'acf_fc_layout' => 'facebook', 'url'  => 'https://www.facebook.com' ), 'option' );
                    add_sub_row( 'item', array( 'acf_fc_layout' => 'linkedin', 'url'  => 'https://www.linkedin.com' ), 'option' );
                    add_sub_row( 'item', array( 'acf_fc_layout' => 'twitter', 'url'   => 'https://www.twitter.com' ), 'option' );
                }
            }
        }
    }
}

function leverage_add_theme_settings( $theme_color, $theme_mode, $button_mode, $body_bg_color, $body_mode, $header_bg_color, $nav_item_color, $top_nav_item_color, $hero_bg_color, $hero_mode, $news_background_color, $subscribe_background_color, $form_background_color, $footer_mode, $footer_bg, $form_mode ) {

    // Theme
    update_field( 'theme_color', $theme_color, 'option' );
    update_field( 'theme_mode', $theme_mode, 'option' );
    update_field( 'button_mode', $button_mode, 'option' );
    update_field( 'body_bg_color', $body_bg_color, 'option' );
    update_field( 'body_enable_dark_mode', $body_mode, 'option' );
    update_field( 'header_bg_color', $header_bg_color, 'option' );
    update_field( 'nav_item_color', $nav_item_color, 'option' );
    update_field( 'top_nav_item_color', $top_nav_item_color, 'option' );
    update_field( 'hero_bg_color', $hero_bg_color, 'option' );
    update_field( 'enable_dark_mode', $hero_mode, 'option' );

    // Section
    update_field( 'news_background_color', $news_background_color, 'option' );
    update_field( 'subscribe_background_color', $subscribe_background_color, 'option' );
    update_field( 'form_background_color', $form_background_color, 'option' );

    // Footer
    update_field( 'footer_enable_dark_mode', $footer_mode, 'option' );
    update_field( 'footer_background_color', $footer_bg, 'option' );

    // Form
    update_field( 'form_mode', $form_mode, 'option' );

    if ( $form_mode == 'simple-form' ) {
        update_field( 'form_container', 'smaller', 'option' );
    }

    // Hero
    $hero_bg_image = array(	
        'opacity_control' => 50
    );

    update_field( 'hero_bg_image', $hero_bg_image, 'option' );

    // Blog
    $blog_layout = array(	
        'disable_excerpt' => true
    );

    update_field( 'blog_layout', $blog_layout, 'option' );
}
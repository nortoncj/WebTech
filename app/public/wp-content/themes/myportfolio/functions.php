<?php
    function mytheme_post_thumbnails() {
        add_theme_support( 'post-thumbnails');
        add_post_type_support( 'page','excerpt', 'post-thumbnails');
    }
    add_action('after_setup_theme', 'mytheme_post_thumbnails');

    function myportfolio_widgets_init() {
        // RIGHT SIDEBAR
        register_sidebar( array(
            'name'          =>__('right-sidebar', 'myportfolio'),
            'id'            => 'sidebar-1',
            'before_widget' => '<div id="%1$s" class="widget-box %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => 'h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));

        // LEFT SIDEBAR
        register_sidebar( array(
            'name'          =>__('left-sidebar', 'myportfolio'),
            'id'            => 'left-sidebar-1',
            'before_widget' => '<div id="%1$s" class="widget-box %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => 'h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }

    

    add_action('widgets_init','myportfolio_widgets_init');
?>
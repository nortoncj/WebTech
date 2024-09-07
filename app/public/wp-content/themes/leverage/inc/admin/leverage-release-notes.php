<?php
/**
 * @package Leverage
 */

if ( is_admin() && ! get_option( 'leverage_release_207' ) ) {
    add_option( 'leverage_release_207', true );
    wp_redirect( get_admin_url() . 'admin.php?page=leverage-release-notes' );
    exit;
}

function leverage_release_notes() {
	add_menu_page( 
		'Leverage Release Notes', 
		'Leverage Release Notes', 
		'manage_options', 
		'leverage-release-notes', 
		'leverage_release_notes_page'
	);
}
add_action( 'admin_menu', 'leverage_release_notes' );

add_action( 'admin_head', function() {
	remove_menu_page( 'leverage-release-notes', 'leverage-release-notes' );
});

function leverage_release_notes_page() { ?>

    <div id="leverage-release-notes" class="leverage-release-notes">
        <div class="wrap about__container">
            <div class="about__header">
                <div class="about__header-inner">
                    <div class="about__header-text"><?php echo __( 'Release Notes', 'leverage' ); ?></div>
                    <div class="about__header-title">
                        <p class="notranslate"> Leverage <span>2.0</span> </p>
                    </div>
                </div>
                <nav class="about__header-navigation nav-tab-wrapper wp-clearfix" aria-label="Secondary menu"> 
                    <a href="about.php" class="nav-tab nav-tab-active" aria-current="page"><?php echo __( 'What\'s New', 'leverage' ); ?></a> 
                    <a href="https://leverage.codings.dev/docs.php?v=wordpress" target="_blank" class="nav-tab"><?php echo __( 'Online Docs', 'leverage' ); ?></a> 
                    <a href="https://codings.dev" target="_blank" class="nav-tab"><?php echo __( 'Get Support', 'leverage' ); ?></a> 
                    <a href="https://leverage.codings.dev/buy-at-themeforest" target="_blank" class="nav-tab"><?php echo __( 'Buy Now', 'leverage' ); ?></a>
                </nav>
            </div>
            <div class="about__section has-subtle-background-color">
                <span class="version has-absolute-right"><?php echo __( '', 'leverage' ); ?>Version 2.0.7 / Mar 22, 2021</span>
                <div class="column">
                    <h2><?php echo __( 'Welcome to', 'leverage' ); ?> Leverage 2.0.7</h2>
                    <p><?php echo __( 'This version has general improvements to the theme and many new features for displaying the portfolio.', 'leverage' ); ?></p>
                </div>
            </div>
            <div class="about__section has-subtle-background-color has-2-columns">
                <a href="https://themeforest.net/item/leverage-agency-portfolio-creative-theme/26643749#item-description__changelog" target="_blank" class="has-absolute-right"><?php echo __( 'View full changelog', 'leverage' ); ?></a>
                <div class="column">
                    <h3><?php echo __( 'Issues that have been fixed', 'leverage' ); ?></h3>
                    <p><?php echo __( 'Better compatibility with the Admin Color Scheme.', 'leverage' ); ?></p>
                    <p><?php echo __( 'Unreadable text in the multi-step form\'s success message.', 'leverage' ); ?></p>
                    <p><?php echo __( 'Portfolio section breaking the layout when using different targets.', 'leverage' ); ?></p>
                </div>
                <div class="column">
                    <h3><?php echo __( 'New features in settings', 'leverage' ); ?></h3>
                    <p><?php echo __( 'News Section displayed on the Blog if enable on posts.', 'leverage' ); ?></p>
                    <p><?php echo __( 'Subscribe Form displayed on the Blog if enable on posts.', 'leverage' ); ?></p>
                    <p><?php echo __( 'Contact Form displayed on the Blog if enable on posts.', 'leverage' ); ?></p>
                    <p><?php echo __( 'Custom Feature displayed on the Blog if enable on posts.', 'leverage' ); ?></p>
                </div>
                <div class="column pt-0">
                    <h3><?php echo __( 'What\'s new in build content', 'leverage' ); ?></h3>
                    <p><?php echo __( 'Carousel transition speed adjustment in the Carousel section.', 'leverage' ); ?></p>
                    <p><?php echo __( 'Carousel transition speed adjustment in the Team section.', 'leverage' ); ?></p>
                    <p><?php echo __( 'Carousel transition speed adjustment in the Testimonial section.', 'leverage' ); ?></p>
                    <p><?php echo __( 'Carousel transition speed adjustment in the Partners section.', 'leverage' ); ?></p>
                    <p><?php echo __( 'Full clickable link in the Services section.', 'leverage' ); ?></p>
                    <p><?php echo __( 'Full clickable link in the Pricing section.', 'leverage' ); ?></p>
                </div>
                <div class="column pt-0">
                    <h3><?php echo __( 'Portfolio improvements', 'leverage' ); ?></h3>
                    <p><?php echo __( 'Customizable "all" button in the Portfolio Grid section.', 'leverage' ); ?></p>
                    <p><?php echo __( 'Archive Portfolio with pagination links.', 'leverage' ); ?></p>
                    <p><?php echo __( 'Option to select posts per page in the Archive Portfolio.', 'leverage' ); ?></p>
                    <p><?php echo __( 'Option to select the display order in the Archive Portfolio.', 'leverage' ); ?></p>
                    <p><?php echo __( 'Option to select the type of sorting in the Archive portfolio.', 'leverage' ); ?></p>
                    <p><?php echo __( 'Option to hide posts by id in the Archive Portfolio.', 'leverage' ); ?></p>
                </div>
            </div>
            <hr>
            <div class="return-to-dashboard"> <a href="index.php"><?php echo __( 'Go to Dashboard → Home', 'leverage' ); ?></a> </div>
        </div>
    </div>

<?php 
}
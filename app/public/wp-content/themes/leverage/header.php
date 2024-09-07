<?php
/**
 * @package Leverage
 */

// Theme Mode
$theme_mode        = 'default';
$body_bg_color     = false;
$header_vs         = '20';
$header_container  = 'default';
$navbar_mode       = false;
$button_mode       = 'filled';

// Navbar
$navbar_search_icon     = false;
$navbar_social_networks = false;
$navbar_call_to_action  = false;
$navbar_custom_action   = false;
$navbar_shop_cart       = false;

if ( function_exists( 'ACF' ) ) {

	// Theme Mode
	$theme_mode       = get_field( 'theme_mode', 'option' );
	$body_bg_color    = get_field( 'body_bg_color', 'option' );
	$button_mode      = get_field( 'button_mode', 'option' );

	// Header Options
	$header_default    = get_field( 'header_default', 'option' );
	$header_responsive = get_field( 'header_responsive', 'option' );

	if ( $header_default && $header_responsive ) {

		// Search Icon
		if ( $header_default['search_icon'] )    { $navbar_search_icon = 'd-sm-inline-block'; } else { $navbar_search_icon = 'd-sm-none'; }
		if ( $header_responsive['search_icon'] ) { $navbar_search_icon .= ' d-inline-block';  } else { $navbar_search_icon .= ' d-none';  }

		// Social Networks
		if ( $header_default['social_networks'] )    { $navbar_social_networks = 'd-sm-inline-block'; } else { $navbar_social_networks = 'd-sm-none'; }
		if ( $header_responsive['social_networks'] ) { $navbar_social_networks .= ' d-inline-block';  } else { $navbar_social_networks .= ' d-none';  }

		// Call to Action
		if ( $header_default['call_to_action'] )    { $navbar_call_to_action = 'd-sm-inline-block'; } else { $navbar_call_to_action = 'd-sm-none'; }
		if ( $header_responsive['call_to_action'] ) { $navbar_call_to_action .= ' d-inline-block';  } else { $navbar_call_to_action .= ' d-none';  }

		// Custom Action
		if ( $header_default['custom_action'] )    { $navbar_custom_action = 'd-sm-inline-block'; } else { $navbar_custom_action = 'd-sm-none'; }
		if ( $header_responsive['custom_action'] ) { $navbar_custom_action .= ' d-inline-block';  } else { $navbar_custom_action .= ' d-none';  }

		// Shop Cart
		if ( $header_default['shop_cart'] )    { $navbar_shop_cart = 'd-sm-inline-block'; } else { $navbar_shop_cart = 'd-sm-none'; }
		if ( $header_responsive['shop_cart'] ) { $navbar_shop_cart .= ' d-inline-block';  } else { $navbar_shop_cart .= ' d-none';  }
	}
}

if ( class_exists( 'WooCommerce' ) ) {
	$is_woocommerce = is_woocommerce();
	$is_cart        = is_cart();
	$is_checkout    = is_checkout();
} else {
	$is_woocommerce = false;
	$is_cart        = false;
	$is_checkout    = false;
}
?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

	<!-- ==============================================
	Basic Page Needs
	=============================================== -->
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->	
	
	<?php wp_head(); ?>
</head>

<?php if ( $theme_mode === 'dark' ) { $theme_mode_class = 'theme-mode-dark'; } else { $theme_mode_class = 'theme-mode-default'; } ?>

<body <?php body_class( $theme_mode_class ); ?> <?php if ( $body_bg_color ) { echo 'style="background-color:'.esc_attr( $body_bg_color ).'"'; } ?>>

<?php if ( function_exists( 'ACF' ) ) {
	get_template_part( 'template-parts/feature', 'preloader' );
	get_template_part( 'template-parts/feature', 'cookie-notice' );
	get_template_part( 'template-parts/feature', 'recaptcha' );

	$navbar_mode      = get_field('navbar_mode', 'option');
	$header_vs        = 'navbar-vs-' . get_field( 'header_vertical_spacing', 'option' );
	$header_container = get_field('header_container', 'option');
} ?>

<header id="header">
	<nav data-aos="zoom-out" data-aos-delay="800" class="navbar navbar-expand <?php echo esc_attr( $header_vs ); ?> <?php if ( $navbar_mode ) { echo esc_attr( $navbar_mode ); } ?>" style="<?php if ( is_admin_bar_showing() ) { echo esc_attr( 'margin-top: 32px;' ); } ?> <?php if ( $is_woocommerce || $is_cart || $is_checkout ) { echo esc_attr( 'background-color: var(--header-bg-color)' ); } ?>">
		<div class="container header <?php if ( $header_container ) { echo esc_attr( $header_container ); } ?>">

			<?php
			if ( has_custom_logo() ) {
				
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$logo           = wp_get_attachment_image_src( $custom_logo_id , 'full' );

				if ( function_exists( 'ACF' ) ) {
					if ( get_field( 'override_general_settings' ) ) {
						$logo_filter = get_field( 'logo_filter' );

					} else {
						$logo_filter = get_field( 'logo_filter', 'option' );
					}

					$invert = $logo_filter;
					if ( $invert ) {
						$invert = 'invert';
					} else {
						$invert = '';
					}

					if ( get_field( 'logo_responsive', 'option' ) ) {

						$logo_default_class = 'd-none d-sm-block';
						$logo_responsive    = '<img src="'.esc_url( get_field( 'logo_responsive', 'option' ) ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'" class="d-block d-sm-none ' . esc_attr( $invert) . '"/>';

					} else {
						$logo_default_class = '';
						$logo_responsive    = '';
					}
				
				} else {
					$logo_default_class = '';
					$logo_responsive = '';
					$invert = '';
				}

				echo '<a class="navbar-brand" href="'.esc_url( home_url( '/' ) ).'"><img src="'.esc_url( $logo[0] ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'" class="' . esc_attr( $logo_default_class . ' ' . $invert) . '"/>'.$logo_responsive.'</a>';

			} else {
				echo '<a class="navbar-brand" href="'.esc_url( home_url( '/' ) ).'">'. esc_attr( get_bloginfo( 'name' ) ) .'</a>';
			} ?>

			<div class="ml-auto"></div>

			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary',
					'container'      => false,
					'menu_class'     => 'navbar-nav items',
					'fallback_cb'    => 'navwalker::fallback',
					'walker'         => new navwalker()
				) );
			}
			?>

			<ul class="navbar-nav icons <?php echo esc_attr( $navbar_search_icon ); ?>">
				<li class="nav-item">
					<a href="#" class="nav-link" data-toggle="modal" data-target="#search">
						<i class="icon-magnifier"></i>
					</a>
				</li>
			</ul>

			<?php 
			// Social Networks
			if ( function_exists( 'ACF' ) ) : ?>
				
				<?php 
				if ( isset( $header_default['social_networks'] ) || isset( $header_responsive['social_networks'] ) ) : ?>

				<ul class="navbar-nav icons <?php echo esc_attr( $navbar_social_networks ); ?>">

					<?php
					if ( have_rows( 'social_networks', 'option' ) ) :
						while( have_rows( 'social_networks', 'option' ) ) :
							the_row();

							// Facebook
							if ( get_row_layout() == 'facebook' ) : ?>

							<li class="nav-item">
								<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-facebook"></i>
								</a>
							</li>

							<?php 
							// Instagram
							elseif ( get_row_layout() == 'instagram' ) : ?>

							<li class="nav-item">
								<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-instagram"></i>
								</a>
							</li>

							<?php 
							// Twitter
							elseif ( get_row_layout() == 'twitter' ) : ?>

							<li class="nav-item">
								<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-twitter"></i>
								</a>
							</li>

							<?php 
							// Youtube
							elseif ( get_row_layout() == 'youtube' ) : ?>

							<li class="nav-item">
								<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-youtube"></i>
								</a>
							</li>

							<?php 
							// Linkedin
							elseif ( get_row_layout() == 'linkedin' ) : ?>

							<li class="nav-item">
								<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-linkedin"></i>
								</a>
							</li>

							<?php 
							// Pinterest
							elseif ( get_row_layout() == 'pinterest' ) : ?>

							<li class="nav-item">
								<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-pinterest"></i>
								</a>
							</li>

							<?php 
							// Tumblr
							elseif ( get_row_layout() == 'tumblr' ) : ?>

							<li class="nav-item">
								<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-tumblr"></i>
								</a>
							</li>

							<?php 
							// Dribbble
							elseif ( get_row_layout() == 'dribbble' ) : ?>

							<li class="nav-item">
								<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
									<i class="icon-social-dribbble"></i>
								</a>
							</li>

							<?php 
							// Custom
							elseif ( get_row_layout() == 'custom' ) : ?>

							<li class="nav-item">
								<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">

									<?php if ( get_sub_field( 'icon_style' ) == 'Line Icon' && get_sub_field( 'icon' ) ) : ?>
										<i class="icon-<?php the_sub_field( 'icon' ); ?>"></i>

									<?php elseif ( get_sub_field( 'icon_style' ) == 'Awesome Icon' && get_sub_field( 'icon' ) ) : ?>
										<i class="<?php echo esc_attr( get_sub_field( 'icon_fa' ) ); ?>"></i>

									<?php endif; ?>
								</a>
							</li>

							<?php 
							endif;
						endwhile;
					endif; ?>

				</ul>
				
				<?php 
				endif; 
			endif;

			// Custom Action
			if ( function_exists( 'ACF' ) ) :
				if ( isset( $header_default['custom_action'] ) || isset( $header_responsive['custom_action'] ) ) :

					$target = get_field( 'custom_target', 'option' );
					$url    = null;
				
					switch ( $target ) {
						case 'Anchor Link':
							$url = get_field( 'custom_url', 'option' );
						break;

						case 'External Link':
							$url = get_field( 'custom_url', 'option' );
						break;

						case 'Inner Page':
							$url = get_field( 'custom_page', 'option' );
						break;

						case 'Inner Post';
							$url = get_field( 'custom_post', 'option' );
						break;
					}		
				?>

				<ul class="navbar-nav custom <?php echo esc_attr( $navbar_custom_action ); ?>">
					<li class="nav-item">
						<a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="nav-link <?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?>">
							
							<?php if ( get_field( 'custom_icon_style', 'option' ) == 'Line Icon' && get_field( 'custom_icon', 'option' ) ) : ?>
								<i class="icon-<?php the_field( 'custom_icon', 'option' ); ?>"></i>

							<?php elseif ( get_field( 'custom_icon_style', 'option' ) == 'Awesome Icon' && get_field( 'custom_icon_fa', 'option' ) ) : ?>
								<i class="<?php the_field( 'custom_icon_fa', 'option' ); ?>"></i>

							<?php endif; ?>
						</a>
					</li>
				</ul>

				<?php 
				endif; 
			endif;
			
			// Shop Cart
			if ( class_exists( 'WooCommerce' ) ) : 
				if ( function_exists( 'leverage_woocommerce_header_cart' ) ) {
					leverage_woocommerce_header_cart( $navbar_shop_cart );
				}
			endif;
			
			// Toogle
			if ( has_nav_menu( 'primary' ) ) : 
			
				$padding_holder = '';
				if ( function_exists( 'ACF' ) ) {
					if ( isset( $header_default['call_to_action'] ) ) {
						$padding_holder = 'pr-sm-4';
					}
					if ( ! isset( $header_responsive['call_to_action'] ) ) {
						$padding_holder .= ' pr-0';
					}
				}			
			?>

			<ul class="navbar-nav toggle">
				<li class="nav-item">
					<a href="#" class="nav-link <?php echo esc_attr( $padding_holder ); ?>" data-toggle="modal" data-target="#menu">
						<i class="icon-menu m-0"></i>
					</a>
				</li>
			</ul>

			<?php endif; ?>

			<?php
			// Call to Action
			if ( function_exists( 'ACF' ) ) :
				if ( isset( $header_default['call_to_action'] ) || isset( $header_responsive['call_to_action'] ) ) :

					$target = get_field( 'button_target', 'option' );
					$url    = null;
				
					switch ( $target ) {
						case 'Anchor Link':
							$url = get_field( 'button_url', 'option' );
						break;

						case 'External Link':
							$url = get_field( 'button_url', 'option' );
						break;

						case 'Inner Page':
							$url = get_field( 'button_page', 'option' );
						break;

						case 'Inner Post';
							$url = get_field( 'button_post', 'option' );
						break;
					}
				?>

				<ul class="navbar-nav action <?php echo esc_attr( $navbar_call_to_action ); ?>">
					<li class="nav-item ml-3">
						<a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="<?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?> btn ml-lg-auto <?php if ( $button_mode === 'outlined' ) { echo 'dark-button'; } else { echo 'primary-button'; } ?>" <?php if ( $button_mode === 'outlined' ) { echo 'style="background-color: var(--hero-bg-color)"'; } ?>>
						
							<?php if ( get_field( 'button_icon_style', 'option' ) == 'Line Icon' && get_field( 'button_icon', 'option' ) ) : ?>
								<i class="icon-<?php the_field( 'button_icon', 'option' ); ?>"></i>

							<?php elseif ( get_field( 'button_icon_style', 'option' ) == 'Awesome Icon' && get_field( 'button_icon_fa', 'option' ) ) : ?>
								<i class="<?php the_field( 'button_icon_fa', 'option' ); ?>"></i>

							<?php endif; ?>

							<?php the_field( 'button_label', 'option' ); ?>
						</a>
					</li>
				</ul>

				<?php 
				endif;
			endif;
			?>

		</div>
	</nav>
</header>

<?php if ( $is_woocommerce || $is_cart || $is_checkout ) : ?><div class="navbar-holder"></div><?php endif; ?>
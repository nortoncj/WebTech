<?php
/**
 * @package Leverage
 */

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
add_filter('woocommerce_show_page_title', '__return_false');
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

function leverage_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 1080,
			'gallery_thumbnail_image_width' => 300,
			'single_image_width'    => 1080,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'leverage_woocommerce_setup' );

function leverage_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'leverage_woocommerce_active_body_class' );

function leverage_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'leverage_woocommerce_related_products_args' );

if ( ! function_exists( 'leverage_woocommerce_wrapper_before' ) ) {

	function leverage_woocommerce_wrapper_before() {

	$body_enable_dark_mode = false;

	if ( function_exists( 'ACF' ) ) {
		$body_enable_dark_mode = get_field( 'body_enable_dark_mode', 'option' );
	}

	if ( $body_enable_dark_mode ) {
		$body_mode_class = 'body-mode-dark';
	} else {
		$body_mode_class = 'body-mode-default';
	}
	?>

	<section id="post-<?php the_ID(); ?>" <?php post_class( $body_mode_class ); ?>>
		<div class="container">
			<div class="row content">
				<?php 
				if ( function_exists( 'ACF' ) ) {
					$disable_sidebar = get_field( 'disable_sidebar' );
				} else {
					$disable_sidebar = '';
				}

				if ( ! is_shop() && is_active_sidebar( 'product-sidebar' ) ) {
					$col = 'col-lg-8';
				} else {
					$col = '';
				}
				?>
				<main class="col-12 <?php echo esc_attr( $col ); ?> p-0">
					<div class="row">
						<div class="col-12 align-self-center">

							<div class="nav-shop">
								<?php woocommerce_breadcrumb(); ?>						
								<?php woocommerce_catalog_ordering(); ?>
							</div>
	<?php
	}
}
add_action( 'woocommerce_before_main_content', 'leverage_woocommerce_wrapper_before' );

if ( ! function_exists( 'leverage_woocommerce_wrapper_after' ) ) {
	function leverage_woocommerce_wrapper_after() { ?>
						</div>
					</div>
        		</main>
				<?php get_sidebar(); ?>
    		</div>
		</div>
	</section>
	<?php
	}
}
add_action( 'woocommerce_after_main_content', 'leverage_woocommerce_wrapper_after' );

if ( ! function_exists( 'leverage_woocommerce_cart_link_fragment' ) ) {	
	function leverage_woocommerce_cart_link_fragment( $fragments ) {
		global $woocommerce;
		$fragments['span.cart-counter'] = '<span class="cart-counter">' . esc_attr($woocommerce->cart->cart_contents_count) . '</span>';
		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'leverage_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'leverage_woocommerce_cart_link' ) ) {	
	function leverage_woocommerce_cart_link() { 	
		if ( is_cart() || is_checkout() ) : ?>
		<a href="<?php echo wc_get_cart_url(); ?>" class="nav-link">
		<?php else : ?>
		<a href="#" class="nav-link" data-toggle="modal" data-target="#cart">
		<?php endif; ?>
			<i class="icon-handbag"></i>
			<?php
				global $woocommerce;
				echo '<span class="cart-counter">' . $woocommerce->cart->cart_contents_count . '</span>';
			?>
		</a>
	<?php
	}
}

if ( ! function_exists( 'leverage_woocommerce_header_cart' ) ) {	
	function leverage_woocommerce_header_cart( $class ) { ?>
		<ul class="navbar-nav icons <?php echo esc_attr( $class ); ?>">
			<li class="nav-item">
				<?php leverage_woocommerce_cart_link(); ?>
			</li>
		</ul>
	<?php
	}
}
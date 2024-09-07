<?php
/**
 * @package Leverage
 */

if ( function_exists( 'ACF' ) ) {
	$disable_sidebar = get_field( 'disable_sidebar' );
} else {
	$disable_sidebar = false;
}

if ( class_exists( 'WooCommerce' ) ) {
	$is_product  = is_product();
	$is_cart     = is_cart();
	$is_checkout = is_checkout();
} else {
	$is_product = false;
	$is_cart     = false;
	$is_checkout = false;
}

if ( $is_product && is_active_sidebar( 'product-sidebar' ) ) : ?>

	<aside class="col-12 col-lg-4 pl-lg-5 float-right sidebar">
		<?php dynamic_sidebar( 'product-sidebar' ); ?>
	</aside>

<?php endif; 

if ( ! $is_product && is_single() && is_active_sidebar( 'blog-sidebar' ) && ! $disable_sidebar ) : ?>

<aside class="col-12 col-lg-4 pl-lg-5 float-right sidebar">
	<?php dynamic_sidebar( 'blog-sidebar' ); ?>
</aside>

<?php endif; 

if ( ! $is_cart && ! $is_checkout && is_page() && is_active_sidebar( 'page-sidebar' ) && ! $disable_sidebar ) : ?>

<aside class="col-12 col-lg-4 pl-lg-5 float-right sidebar">
	<?php dynamic_sidebar( 'page-sidebar' ); ?>
</aside>

<?php endif; ?>
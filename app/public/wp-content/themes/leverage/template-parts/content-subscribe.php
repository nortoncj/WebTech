<?php
/**
 * @package Leverage
 */

$subscribe_enable_dark_mode      = false;
$subscribe_enable_separator_line = false;
$subscribe_background_color      = false;

if ( get_field( 'subscribe_enable_dark_mode', 'option' ) ) {
	$suggested_color = '#111111';
} else {
	$suggested_color = '#F5F5F5';
}

if ( get_field( 'override_general_settings' ) ) {

    if ( get_field( 'subscribe_background_color' ) ) {
		$subscribe_background_color = get_field( 'subscribe_background_color' );
		
    } else {

        if ( get_field( 'subscribe_background_color', 'option' ) ) {
            $subscribe_background_color = get_field( 'subscribe_background_color', 'option' );
        } else {
            $subscribe_background_color = $suggested_color;
        }
    }

    $subscribe_enable_dark_mode      = get_field( 'subscribe_enable_dark_mode' );
    $subscribe_enable_separator_line = get_field( 'subscribe_enable_separator_line' );

} else {
	
    if ( get_field( 'subscribe_background_color', 'option' ) ) {
        $subscribe_background_color = get_field( 'subscribe_background_color', 'option' );
    } else {
        $subscribe_background_color = $suggested_color;
    }

    $subscribe_enable_dark_mode      = get_field( 'subscribe_enable_dark_mode', 'option' );
    $subscribe_enable_separator_line = get_field( 'subscribe_enable_separator_line', 'option' );
} 

$recaptcha = get_field( 'recaptcha', 'option' ); 

if ( get_field( 'subscribe_custom_id', 'option' ) ) {
    $subscribe_id = get_field( 'subscribe_custom_id', 'option' );

} else {
    $subscribe_id = 'subscribe';
}

if ( get_field( 'subscribe_custom_class', 'option' ) ) {
    $subscribe_class = get_field( 'subscribe_custom_class', 'option' );

} else {
    $subscribe_class = 'subscribe';
}

$subscribe_vs  = 'section-vs-' . get_field( 'subscribe_vertical_spacing', 'option' );
$subscribe_vsr = 'section-vsr-' . get_field( 'subscribe_vertical_spacing_responsive', 'option' );

?>

<section id="<?php echo esc_attr( $subscribe_id ); ?>" class="<?php echo esc_attr( $subscribe_class ); ?> <?php echo esc_attr( $subscribe_vs.' '.$subscribe_vsr ); ?> <?php if ( $subscribe_enable_dark_mode ) { echo esc_attr( 'odd' ); } ?> <?php if ( $subscribe_enable_separator_line ) { echo esc_attr( 'featured' ); } ?> subscription" <?php echo 'style="background-color:'.esc_attr( $subscribe_background_color ).'"'; ?>>
    <div class="container <?php the_field( 'subscribe_container', 'option' ); ?>">

		<?php if ( get_field( 'subscribe_title', 'option' ) || get_field( 'subscribe_description', 'option' ) ) : ?>

		<div class="row intro">
            <div class="col-12 <?php the_field( 'subscribe_text_align', 'option' ); ?> text-center">

				<?php if ( get_field( 'subscribe_title', 'option' ) ) : ?>
				<h2 class="<?php if ( ! get_field( 'subscribe_description', 'option' ) ) { echo 'mb-0 '; } the_field( 'subscribe_heading_style', 'option' ); ?>"><?php the_field( 'subscribe_title', 'option' ); ?></h2>
				<?php endif; ?>

				<?php if ( get_field( 'subscribe_description', 'option' ) ) { the_field( 'subscribe_description', 'option' ); } ?>
            </div>            
        </div>

		<?php endif; ?>

		<div class="row">
			<div class="col-12 p-0">
				<form action="<?php echo admin_url( 'admin-ajax.php' ) ; ?>" id="leverage-subscribe" class="row m-auto items">

					<?php wp_nonce_field( 'leverage_subscribe', 'leverage_subscribe_wpnonce' ); ?>
					<input type="hidden" name="action" value="leverage_contact_form">
					<input type="hidden" name="section" value="leverage_subscribe">

					<?php if ( isset( $recaptcha['enable_recaptcha'] ) && $recaptcha['enable_recaptcha'] ) : ?>
					<input type="hidden" name="reCAPTCHA">
					<?php endif; ?>

					<div class="col-12 col-lg-5 m-lg-0 input-group align-self-center item">
						<input type="text" name="name" class="form-control field-name" placeholder="<?php esc_attr_e( 'Name', 'leverage' ); ?>">
					</div>
					<div class="col-12 col-lg-5 m-lg-0 input-group align-self-center item">
						<input type="email" name="email" class="form-control field-email" placeholder="<?php esc_attr_e( 'Email', 'leverage' ); ?>">
					</div>
					<div class="col-12 col-lg-2 m-lg-0 input-group align-self-center item">
						<a class="btn primary-button w-100">
							<?php if ( get_field( 'subscribe_button_label', 'option' ) ) { the_field( 'subscribe_button_label', 'option' ); } else { echo esc_html( 'SUBSCRIBE', 'leverage' ); } ?>
						</a>
					</div>
					<div class="col-12 text-center">
						<span class="form-alert mt-5 mb-0"></span>
					</div>										
				</form>
			</div>
		</div>
	</div>
</section>
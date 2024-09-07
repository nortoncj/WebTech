<?php
/**
 * @package Leverage
 */
?>

<?php 
$enable_dark_mode = true;
$preloader        = get_field( 'preloader', 'option' ); 

if ( get_field( 'override_general_settings' ) ) {
    $enable_dark_mode = get_field( 'enable_dark_mode' );

} else {
    $enable_dark_mode = get_field( 'enable_dark_mode', 'option' );
}

if ( is_search() ) {
    $enable_dark_mode = get_field( 'enable_dark_mode', 'option' );
} 

if ( $preloader && $preloader['enable_preloader'] ) : 
    $preloader_timeout = ( $preloader['preloader_timeout'] * 1000 ); ?>

    <div data-timeout="<?php echo esc_html( $preloader_timeout ); ?>" class="preloader counter <?php if ( $enable_dark_mode === true ) { echo esc_attr( 'odd' ); } ?>">
        <div data-aos="fade-up" data-aos-delay="200" class="row justify-content-center text-center items">
            <div data-percent="100" class="radial">
                <span></span>
            </div>
        </div>
    </div>

<?php endif; ?>
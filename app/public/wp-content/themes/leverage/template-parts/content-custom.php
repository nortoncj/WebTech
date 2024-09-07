<?php
/**
 * @package Leverage
 */

$custom_enable_dark_mode      = false;
$custom_enable_separator_line = false;
$custom_background_color      = false;

if ( get_field( 'custom_enable_dark_mode', 'option' ) ) {
	$suggested_color = '#111111';
} else {
	$suggested_color = '#F5F5F5';
}

if ( get_field( 'override_general_settings' ) ) {
    if ( get_field( 'custom_background_color' ) ) {
        $custom_background_color = get_field( 'custom_background_color' );
    } else {
        $custom_background_color = $suggested_color;
    }

    $custom_enable_dark_mode      = get_field( 'custom_enable_dark_mode' );
    $custom_enable_separator_line = get_field( 'custom_enable_separator_line' );

} else {
    if ( get_field( 'custom_background_color', 'option' ) ) {
        $custom_background_color = get_field( 'custom_background_color', 'option' );
    } else {
        $custom_background_color = $suggested_color;
    }

    $custom_enable_dark_mode      = get_field( 'custom_enable_dark_mode', 'option' );
    $custom_enable_separator_line = get_field( 'custom_enable_separator_line', 'option' );
} 
if ( get_field( 'custom', 'option' ) ) : 
    if ( get_field( 'custom_custom_id', 'option' ) ) {
        $custom_id = get_field( 'custom_custom_id', 'option' );
    
    } else {
        $custom_id = 'custom';
    }
    
    if ( get_field( 'custom_custom_class', 'option' ) ) {
        $custom_class = get_field( 'custom_custom_class', 'option' );
    
    } else {
        $custom_class = 'custom';
    }

    $custom_vs  = 'section-vs-' . get_field( 'custom_vertical_spacing', 'option' );
    $custom_vsr = 'section-vsr-' . get_field( 'custom_vertical_spacing_responsive', 'option' );
?>

<section id="<?php echo esc_attr( $custom_id ); ?>" class="<?php echo esc_attr( $custom_class ); ?> <?php echo esc_attr( $custom_vs.' '.$custom_vsr ); ?> <?php if ( $custom_enable_dark_mode ) { echo esc_attr( 'odd' ); } ?> <?php if ( $custom_enable_separator_line ) { echo esc_attr( 'featured' ); } ?> custom" <?php echo 'style="background-color:'.esc_attr( $custom_background_color ).'"'; ?>>
    <div class="container <?php the_field( 'form_container', 'option' ); ?>">

        <?php if ( get_field( 'custom_title', 'option' ) || get_field( 'custom_description', 'option' ) ) : ?>

        <div class="row intro">
            <div class="col-12 <?php the_field( 'custom_text_align', 'option' ); ?> text-center">

                <?php if ( get_field( 'custom_title', 'option' ) ) : ?>
                <h2 class="<?php if ( ! get_field( 'custom_description', 'option' ) ) { echo 'mb-0 '; } the_field( 'custom_heading_style', 'option' ); ?>"><?php the_field( 'custom_title', 'option' ); ?></h2>
                <?php endif; ?>

                <?php if ( get_field( 'custom_description', 'option' ) ) { the_field( 'custom_description', 'option' ); } ?>
            </div>            
        </div>

		<?php endif; ?>

		<div class="row">
			<div class="col-12">
				<?php the_field( 'custom', 'option' ); ?>
			</div>

		</div>
	</div>
</section>

<?php endif; ?>
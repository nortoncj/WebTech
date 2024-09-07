<?php
/**
 * @package Leverage
 */

if ( get_sub_field( 'enable_button' ) ) :

    $target = get_sub_field( 'button_target' );

    switch ( $target ) {
        case 'Anchor Link':
            $url = get_sub_field( 'button_url' );
        break;

        case 'Internal Link':
            $url = get_sub_field( 'button_url' );
        break;

        case 'External Link':
            $url = get_sub_field( 'button_url' );
        break;

        case 'Inner Page':
            $url = get_sub_field( 'button_page' );
        break;

        case 'Inner Post';
            $url = get_sub_field( 'button_post' );
        break;
    }

endif; 

if ( get_sub_field( 'title' ) || get_sub_field( 'description' ) ) : ?>

<div class="row intro">
    <div class="col-12 <?php if ( get_sub_field( 'enable_button' ) != false ) { echo esc_attr( 'col-md-9 align-self-center text-md-left' ); } else { the_sub_field( 'text_align' ); } ?> text-center">

        <?php if ( get_sub_field( 'title' ) ) : ?>
        <h2 class="<?php if ( ! get_sub_field( 'description' ) ) { echo 'mb-0 '; } the_sub_field( 'heading_style' ); ?>"><?php the_sub_field( 'title' ); ?></h2>
        <?php endif; ?>

        <?php if ( get_sub_field( 'description' ) ) { the_sub_field( 'description' ); } ?>
    </div>

    <?php
    if ( get_sub_field( 'enable_button' ) ) : ?>

    <div class="col-12 col-md-3 align-self-end">

        <a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="<?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?> btn mx-auto mr-md-0 ml-md-auto primary-button">

            <?php if ( get_sub_field( 'button_icon_style' ) == 'Line Icon' && get_sub_field( 'button_icon' ) ) : ?>
            <i class="icon-<?php echo esc_attr( get_sub_field( 'button_icon' ) ); ?>"></i>
            <?php elseif ( get_sub_field( 'button_icon_style' ) == 'Awesome Icon' && get_sub_field( 'button_icon_fa' ) ) : ?>
            <i class="<?php echo esc_attr( get_sub_field( 'button_icon_fa' ) ); ?>"></i>
            <?php endif; ?>

            <?php the_sub_field( 'button_label' ); ?>
        </a>
    </div>

    <?php endif; ?>
    
</div>

<?php endif; ?>
<?php
/**
 * @package Leverage
 */

get_header();
get_template_part( 'template-parts/content', 'no-slider' );

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

<section id="protected" class="<?php echo esc_attr( $body_mode_class ); ?>">
	<div class="container">
		<div class="row items justify-content-center">
            <div class="col-8 text-left">
			    <?php the_content(); ?>
            </div>
		</div>
	</div>
</section>

<?php get_footer();
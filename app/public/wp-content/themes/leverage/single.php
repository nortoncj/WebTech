<?php
/**
 * @package Leverage
 */

if ( get_post_type() == 'leverage-portfolio' ) {
	require_once( 'page.php' );

} else {
	get_header();
	get_template_part( 'template-parts/content', 'no-slider' ); 

	$body_bg_color         = '#F5F5F5';
	$body_enable_dark_mode = false;
	$content_container     = 'default';
	$content_vs            = 'section-vs-130';
	$content_vsr           = 'section-vsr-90';

	if ( function_exists( 'ACF' ) ) {
		$body_enable_dark_mode = get_field( 'body_enable_dark_mode', 'option' );
		$content_container     = get_field( 'content_container' );
		$content_vs            = 'section-vs-' . get_field( 'content_vertical_spacing');
		$content_vsr           = 'section-vsr-' . get_field( 'content_vertical_spacing_responsive');

		if ( $body_enable_dark_mode ) {
			$body_bg_color = '#111111';		
		}

		if ( get_field( 'body_bg_color', 'option' ) ) {
			$body_bg_color = get_field( 'body_bg_color', 'option' );
		}
	}

	if ( $body_enable_dark_mode ) {
		$body_mode_class = 'body-mode-dark';
	} else {
		$body_mode_class = 'body-mode-default';
	}
	?>

	<section id="post-<?php the_ID(); ?>" <?php post_class( 'content-section '.$body_mode_class ); ?> <?php echo 'style="background-color:'.esc_attr( $body_bg_color ).'"'; ?>>
		<div class="container">
			<div class="row content">

				<?php
				if ( function_exists( 'ACF' ) ) {
					$disable_sidebar = get_field( 'disable_sidebar' );
				} else {
					$disable_sidebar = '';
				}

				if ( is_active_sidebar( 'blog-sidebar' ) && ! $disable_sidebar ) {
					$col = 'col-lg-8';
				} else {
					$col = 'col-lg-12';
				}
				?>

				<main class="col-12 <?php echo esc_attr( $col ); ?>">

					<?php
					get_template_part( 'template-parts/content', 'single' ); 

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif; ?>

				</main>

				<?php get_sidebar(); ?>
				
			</div>
		</div>
	</section>

	<?php get_footer();

}
<?php
/**
 * @package Leverage
 */

$disable_hero_section = false;
$enable_dark_mode     = true;
$hero_bg_image        = false;
$single_page          = false;

if ( function_exists( 'ACF' ) ) {
	$single_page   = get_field( 'single_page', 'option' ); 
	$hero_bg_image = get_field( 'hero_bg_image', 'option' );
} 

if ( ! $single_page ) {

	$single_page = array(
		'cover_height'        => false,
		'disable_breadcrumbs' => false
	);
}

if ( function_exists( 'ACF' ) ) {
	if ( get_field( 'override_general_settings' ) ) {
		$disable_hero_section = get_field( 'disable_hero_section' );

		if ( get_field( 'enable_dark_mode' ) ) {
			$enable_dark_mode = get_field( 'enable_dark_mode' );
		} else {
			$enable_dark_mode = get_field( 'enable_dark_mode', 'option' );
		}
		

	} else {
		$disable_hero_section = false;
		$enable_dark_mode     = get_field( 'enable_dark_mode', 'option' );
	}

	$blog_layout = get_field( 'blog_layout', 'option' ); 

	if ( ! $blog_layout ) {
		$blog_layout = array(
			'disable_hero_section' => false
		);		
		$disable_hero_section = false;

	} else {

		if ( ! is_page() && ! is_single() && ! is_category() && ! is_tag() && ! is_archive() && ! is_author() && get_post_type() == 'post' ) {
			$disable_hero_section = $blog_layout['disable_hero_section'];
		}
	}

	if ( is_search() ) {
		$disable_hero_section = false;
		$enable_dark_mode     = get_field( 'enable_dark_mode', 'option' );
	} 
}

if ( $disable_hero_section ) : ?>

<div class="navbar-holder"></div>

<?php else : ?>

<section id="slider" class="hero p-0 featured <?php if ( $enable_dark_mode === true ) { echo esc_attr( 'odd' ); } ?>">
	<div class="swiper-container slider-container no-slider <?php if ( $single_page['cover_height'] ) { echo 'slider-h-' . $single_page['cover_height']; } else { echo 'slider-h-auto'; } ?>">
		<div class="swiper-wrapper">
			<div class="swiper-slide slide-center slider-item">

				<?php
				// Pages and Posts
				if ( isset( $hero_bg_image['opacity_control'] ) ) {
					$image_featured_opacity = $hero_bg_image['opacity_control'];
				} else {
					$image_featured_opacity = null;
				}

				if ( is_page() || is_single() ) {
					echo get_the_post_thumbnail( $post->ID, 'full-image', array( 'class' => 'full-image', 'data-mask' => $image_featured_opacity ) );
				}  
				
				// Taxonomy
				elseif ( is_category() || is_tag() || is_author() || is_archive() ) {

					if ( isset( $hero_bg_image['taxonomy']['sizes']['leverage-full-image'] ) && isset( $hero_bg_image['taxonomy']['alt'] ) && isset( $hero_bg_image['opacity_control'] ) ) {
						
						$image_taxonomy         = $hero_bg_image['taxonomy']['sizes']['leverage-full-image'];
						$image_taxonomy_alt     = $hero_bg_image['taxonomy']['alt'];
						$image_taxonomy_opacity = $hero_bg_image['opacity_control'];

						echo leverage_lazy_load_image( $image_taxonomy, $image_taxonomy_alt, 'full-image', $image_taxonomy_opacity );

					} else {
						$image_taxonomy = null;
					}
				} 
				
				// Search results
				elseif ( is_search() ) {

					if ( isset( $hero_bg_image['search_results']['sizes']['leverage-full-image'] ) && isset( $hero_bg_image['search_results']['alt'] ) && isset( $hero_bg_image['opacity_control'] ) ) {
						$image_search_results         = $hero_bg_image['search_results']['sizes']['leverage-full-image'];
						$image_search_results_alt     = $hero_bg_image['taxonomy']['alt'];
						$image_search_results_opacity = $hero_bg_image['opacity_control'];	

						echo leverage_lazy_load_image( $image_search_results, $image_search_results_alt, 'full-image', $image_search_results_opacity );
					}
				} 
				
				// 404 Page
				elseif ( is_404() ) {

					if ( isset( $hero_bg_image['404_page']['sizes']['leverage-full-image'] ) && isset( $hero_bg_image['404_page']['alt'] ) && isset( $hero_bg_image['opacity_control'] ) ) {
						$image_404_page         = $hero_bg_image['404_page']['sizes']['leverage-full-image'];
						$image_404_page_alt     = $hero_bg_image['taxonomy']['alt'];
						$image_404_page_opacity = $hero_bg_image['opacity_control'];	

						echo leverage_lazy_load_image( $image_404_page, $image_404_page_alt, 'full-image', $image_404_page_opacity );
					}	
				} 
				
				// Posts Page
				else {
					
					if ( isset( $hero_bg_image['posts_page']['sizes']['leverage-full-image'] ) && isset( $hero_bg_image['posts_page']['alt'] ) && isset( $hero_bg_image['opacity_control'] ) ) {
						$image_posts_page         = $hero_bg_image['posts_page']['sizes']['leverage-full-image'];
						$image_posts_page_alt     = $hero_bg_image['taxonomy']['alt'];
						$image_posts_page_opacity = $hero_bg_image['opacity_control'];	

						echo leverage_lazy_load_image( $image_posts_page, $image_posts_page_alt, 'full-image', $image_posts_page_opacity );
					}			
				}
				?>

				<div class="slide-content row text-center">
					<div class="col-12 mx-auto inner">
						<h1 data-aos="zoom-out-up" data-aos-delay="400" class="title effect-static-text">

							<?php if ( is_sticky() && is_single() ) : ?>
							<i class="icon icon-pin"></i>
							<?php endif;

							// Protected
							if ( is_page() && post_password_required() ) {
								echo str_replace( 'Protected:', '', get_the_title() );
								echo '<em>'.esc_html__( 'Protected Page', 'leverage' ).'</em>';							
							} 

							// Page and Posts
							elseif ( is_page() || is_single() ) {
								the_title();
							} 
							
							// Front Page
							elseif ( is_front_page() ) {
								echo get_bloginfo( 'name' );								
							} 
							
							// Taxonomy
							elseif ( is_category() || is_tag() || is_author() || is_archive() ) {
								the_archive_title();
							}
							
							// Search results
							elseif ( is_search() ) {
								printf( esc_html__( 'Searching for: %s', 'leverage' ), '<em>' . get_search_query() . '</em>' );							
							} 
							
							// 404 Page
							elseif ( is_404() ) {
								printf( esc_html__( '404 %s', 'leverage' ), '<em>'.esc_html__( 'Nothing Found', 'leverage' ).'</em>' );							
							} 
							
							// Posts Page
							else {
								echo get_the_title( get_option('page_for_posts', true) );
							}
							?>
						</h1>

						<?php if ( ! is_front_page() && ! $single_page['disable_breadcrumbs'] ) : ?>

						<nav data-aos="zoom-out-up" data-aos-delay="800" aria-label="breadcrumb">
							<ol class="breadcrumb"><?php get_breadcrumb(); ?></ol>
						</nav>
						
						<?php endif; ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>
<?php
/**
 * @package Leverage
 */

get_query_var('hero_section');
$button_mode = 'filled';

if ( function_exists( 'ACF' ) ) {
	$button_mode = get_field( 'button_mode', 'option' );
}

$slides = get_sub_field( 'slides' );

if ( $slides ) :
	$object = get_sub_field_object( 'slides' );
	$count  = ( count( $object['value'] ) ); 

	if ( $object['name'] == 'hero_section_0_slides' ) {
		$slider_section = 'slider';

	} else {
		$slider_section = 'get';
	}

	if ( get_sub_field( 'custom_id' ) ) {
		$slider_id = get_sub_field( 'custom_id' );

	} else {
		$slider_id = $slider_section . '-' . $hero_section;
	}

	if ( get_sub_field( 'custom_class' ) ) {
		$slider_class = get_sub_field( 'custom_class' );

	} else {
		$slider_class = $slider_section . '-' . $hero_section;
	}
?>

<section id="<?php echo esc_attr( $slider_id ); ?>" class="<?php echo esc_attr( $slider_class ); ?> hero p-0 <?php if ( get_sub_field( 'enable_block_style' ) ) { echo esc_attr( 'slider-block' ); } ?><?php if ( $hero_section == 1 && get_sub_field( 'enable_parallax_scrolling' ) ) { echo esc_attr( 'slider-parallax' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?>">
	<div data-speed="<?php the_sub_field( 'rotation_speed' ); ?>" class="swiper-container slider-container <?php the_sub_field( 'container' ); ?> <?php if ( $count == 1 ) { echo esc_attr( 'no-slider' ); } else { echo esc_attr( 'full-slider' ); } ?> <?php if ( get_sub_field( 'enable_outline' ) ) { echo esc_attr( 'featured' ); } ?> animation slider-h-<?php if ( get_sub_field( 'height' ) ) { echo get_sub_field( 'height' ); } else { echo '100'; } ?>">
		<div class="swiper-wrapper">

		<?php
		$slides = get_sub_field( 'slides' );
		
		if ( $slides ) :

			$slide_count = 0;

			foreach( $slides as $slide ) :

			$slide_count++;

			if ( isset( $slide['image'] ) && isset( $slide['image']['sizes'] ) ) {					
				
				if ( isset( $slide['original_image_size'] ) && $slide['original_image_size'] == true ) {
					$image = $slide['image']['url'];

				} else {

					if ( $slide['media_type'] == 'full-image' ) {
						$image = $slide['image']['sizes']['leverage-full-image'];
	
					} elseif ( $slide['media_type'] == 'hero-image' || $slide['media_type'] == 'hero-image-left' ) {
						$image = $slide['image']['sizes']['leverage-hero-image'];
					}
				}
				
			} else {
				$image = null;
			}
			
			if ( $slide['enable_dark_mode'] ) {
				$suggested_color = '#111111';
			} else {
				$suggested_color = '#F5F5F5';
			} 
			
			if ( isset( $slide['image']['alt'] ) ) {
				$slide_image_alt = $slide['image']['alt'];
			} else {
				$slide_image_alt = $slide['title'];
			} 
			
			?>

			<div class="swiper-slide slide-center slider-item <?php if ( $slide['enable_dark_mode'] ) { echo esc_attr( 'odd' ); } ?>" <?php if ( $slide['background_color'] ) { echo 'style="background-color:'.esc_attr( $slide['background_color'] ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>

				<?php if ( $slide['enable_image'] ) : ?>

					<?php if ( $slide['media_type'] == 'full-video' ) : 

						$video_extension = pathinfo( $slide['video'], PATHINFO_EXTENSION ); ?>

                        <video class="full-image" data-mask="<?php echo esc_attr( $slide['opacity_control'] ); ?>" playsinline autoplay muted loop>
                            <source src="<?php echo esc_url( $slide['video'] ); ?>" type="video/<?php echo esc_attr( $video_extension ); ?>" />
                        </video> 

						<?php elseif ( $slide['media_type'] == 'particles' ) : ?>

						<div id="particles-<?php echo esc_attr( $slide_count ); ?>" class="particles full-image" data-particle="<?php echo esc_attr( $slide['particle'] ); ?>" data-mask="<?php echo esc_attr( $slide['opacity_control'] ); ?>"></div>
						
					<?php else : ?>

					<img data-aos="<?php if ( $slide['media_type'] == 'hero-image' || $slide['media_type'] == 'hero-image-left' ) { echo esc_attr( 'zoom-out-up' ); } ?>" data-aos-delay="800" src="<?php echo esc_url( $image ); ?>" class="<?php echo esc_attr( $slide['media_type'] ); ?>" alt="<?php echo esc_attr( $slide_image_alt ); ?>" data-mask="<?php echo esc_attr( $slide['opacity_control'] ); ?>" data-mask-768="<?php if ( $slide['media_type'] == 'hero-image' || $slide['media_type'] == 'hero-image-left' ) { echo esc_attr( $slide['opacity_control_responsive'] ); } ?>">

					<?php endif; ?>
				<?php endif; ?>

				<div class="slide-content row">
					<div class="col-12 d-flex <?php if ( $slide['slide_align'] == 'Right' ) { echo esc_attr( 'justify-content-end' ); } ?> inner">
						<div class="<?php if ( $slide['slide_align'] == 'Left' ) { echo esc_attr( 'left text-center text-md-left' ); } elseif ( $slide['slide_align'] == 'Right' ) { echo esc_attr( 'right text-center text-md-left' ); } else { echo esc_attr( 'center text-center' ); } ?>">

							<?php 
							$enable_title = $slide['enable_title'];

							if ( $enable_title ) :

								if ( $slider_section == 'slider' && $slide_count == 1 ) : ?>
									
									<h1 data-aos="zoom-out-up" data-aos-delay="400" class="title effect-static-text"><?php echo strip_tags( $slide['title'], '<br><br /><i><em><u><del>' ); ?></h1>

								<?php else : ?>

									<h2 data-aos="zoom-out-up" data-aos-delay="400" class="title effect-static-text"><?php echo strip_tags( $slide['title'], '<br><br /><i><em><u><del>' ); ?></h2>

								<?php 
								endif;
							endif; ?>				

							<?php if ( $slide['enable_description'] ) : ?>
							<div data-aos="zoom-out-up" data-aos-delay="800" class="description <?php if ( $slide['slide_align'] == 'Center' ) { echo esc_attr( 'ml-auto mr-auto' ); } ?>"><?php echo strip_tags( $slide['description'], '<p><p><br><br /><a><span><b><strong><i><em><u><del><blockquote><q><ul><ol><ins><code><pre><img>' ); ?></div>
							<?php endif; ?>

							<div class="d-sm-inline-flex mt-3">

							<?php
							if ( $slide['enable_button'] ) :

								$target = $slide['button_target'];
							
								switch ( $target ) {
									case 'Anchor Link':
										$url = $slide['button_url'];
									break;

									case 'External Link':
										$url = $slide['button_url'];
									break;

									case 'Inner Page':
										$url = $slide['button_page'];
									break;

									case 'Inner Post';
										$url = $slide['button_post'];
									break;
								}
							?>

							<a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> data-aos="zoom-out-up" data-aos-delay="1200" class="<?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?> ml-auto mr-auto <?php if ( $slide['slide_align'] == 'Left' ) { echo esc_attr( 'ml-md-0' ); } elseif ( $slide['slide_align'] == 'Right' ) { echo esc_attr( 'mr-md-0' ); } ?> mt-4 mt-sm-0 btn <?php if ( $button_mode === 'outlined' ) { echo 'dark-button'; } else { echo 'primary-button'; } ?>" <?php if ( $button_mode === 'outlined' ) { echo 'style="background-color: '.esc_attr( $slide['background_color'] ).'"'; } ?>><?php if ( $slide['button_icon_style'] == 'Line Icon' && $slide['button_icon'] ) : ?><i class="icon-<?php echo esc_attr( $slide['button_icon'] ); ?>"></i><?php elseif ( $slide['button_icon_style'] == 'Awesome Icon' && $slide['button_icon_fa'] ) : ?><i class="<?php echo esc_attr( $slide['button_icon_fa'] ); ?>"></i><?php endif; ?><?php echo esc_html( $slide['button_label'] ); ?></a>

							<?php endif; ?>

							<?php
							if ( $slide['enable_secondary_button'] ) :

								$secondary_target = $slide['secondary_button_target'];

								switch ( $target ) {
									case 'Anchor Link':
										$secondary_url = $slide['secondary_button_url'];
									break;

									case 'External Link':
										$secondary_url = $slide['secondary_button_url'];
									break;

									case 'Inner Page':
										$secondary_url = $slide['secondary_button_page'];
									break;

									case 'Inner Post';
										$secondary_url = $slide['secondary_button_post'];
									break;
								}
							?>

							<a href="<?php echo esc_url( $secondary_url ); ?>" <?php if ( $secondary_target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> data-aos="zoom-out-up" data-aos-delay="1200" class="<?php if ( $secondary_target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?> mr-auto ml-auto ml-sm-4 mt-4 mt-sm-0 btn <?php if ( $button_mode === 'outlined' ) { echo 'dark-button'; } else { echo 'primary-button'; } ?>" <?php if ( $button_mode === 'outlined' ) { echo 'style="background-color: '.esc_attr( $slide['background_color'] ).'"'; } ?>><?php if ( $slide['secondary_button_icon_style'] == 'Line Icon' && $slide['secondary_button_icon'] ) : ?><i class="icon-<?php echo esc_attr( $slide['secondary_button_icon'] ); ?>"></i><?php elseif ( $slide['secondary_button_icon_style'] == 'Awesome Icon' && $slide['secondary_button_icon_fa'] ) : ?><i class="<?php echo esc_attr( $slide['secondary_button_icon_fa'] ); ?>"></i><?php endif; ?><?php echo esc_html( $slide['secondary_button_label'] ); ?></a>

							<?php endif; ?>
							</div>
						</div>
					</div>
				</div> 
			</div>

			<?php
			endforeach;
		endif; ?>

		</div>
		<div class="swiper-pagination"></div>		
	</div>
</section>

<?php if ( $hero_section == 1 && get_sub_field( 'enable_parallax_scrolling' ) ) : ?>
<div class="slider-parallax-holder"></div>
<?php endif; ?>

<?php else : get_template_part( 'template-parts/content', 'no-slider' ); endif; ?>
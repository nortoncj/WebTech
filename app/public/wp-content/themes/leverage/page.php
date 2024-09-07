<?php
/**
 * @package Leverage
 */

if ( post_password_required() ) {
	get_template_part( 'template-parts/content', 'protected' );
	exit;
}

get_header();

if ( class_exists( 'WooCommerce' ) ) {
	$is_woocommerce = is_woocommerce();
	$is_cart        = is_cart();
	$is_checkout    = is_checkout();
} else {
	$is_woocommerce = false;
	$is_cart        = false;
	$is_checkout    = false;
}

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

	if ( have_rows( 'hero_section' ) ) {
		$hero_sections = 1;
		while( have_rows( 'hero_section' ) ) {
			the_row();

			if ( get_row_layout() == 'slider' ) {
				$hero_section = $hero_sections++;
				set_query_var( 'hero_section', $hero_section );
				get_template_part( 'template-parts/content', 'full-slider' );
			}
		}

	} else {
		if ( ! $is_woocommerce && ! $is_cart && ! $is_checkout ) {
			get_template_part( 'template-parts/content', 'no-slider' );
		}
	} 

} else {
	if ( ! $is_woocommerce && ! $is_cart && ! $is_checkout ) {
		get_template_part( 'template-parts/content', 'no-slider' );
	}
} ?>

<?php
global $post;
$content = $post->post_content;

if ( ! empty( $content ) || leverage_check_is_elementor() ) : 

	if ( $body_enable_dark_mode ) {
		$body_mode_class = 'body-mode-dark';
	} else {
		$body_mode_class = 'body-mode-default';
	}
?>

<section id="post-<?php the_ID(); ?>" <?php post_class( 'content-section '.$body_mode_class.' '.$content_vs.' '.$content_vsr ); ?> <?php echo 'style="background-color:'.esc_attr( $body_bg_color ).'"'; ?>>
	<div class="container <?php echo esc_attr( $content_container ); ?>">
		<div class="row content">

			<?php
				if ( function_exists( 'ACF' ) ) {
					$disable_sidebar = get_field( 'disable_sidebar' );
				} else {
					$disable_sidebar = '';
				}

				if ( is_active_sidebar( 'page-sidebar' ) && ! $disable_sidebar && ! $is_cart && ! $is_checkout ) {
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
					endif; 
				?>

			</main>

			<?php get_sidebar(); ?>
			
		</div>
	</div>
</section>

<?php endif; ?>

<?php
if ( function_exists( 'ACF' ) ) :
	if ( have_rows( 'content_section' ) ) :

		$hero_sections        = 1;
		$carousel_count       = 0;
		$about_count          = 0;
		$video_count          = 0;
		$funfacts_count       = 0;
		$skills_count         = 0;
		$features_count       = 0;
		$services_count       = 0;
		$portfolio_count      = 0;
		$portfolio_grid_count = 0;
		$team_count           = 0;
		$testimonials_count   = 0;
		$partners_count       = 0;
		$pricing_count        = 0;
		$custom_count         = 0;
		
		while( have_rows( 'content_section' ) ) : the_row();

			if ( get_row_layout() == 'slider' ) :

				$hero_section = $hero_sections++;	

				set_query_var( 'hero_section', $hero_section );
				get_template_part( 'template-parts/content', 'full-slider' );
			
			?>

			<?php
			$carousel_count = 0;
			elseif ( get_row_layout() == 'carousel' ) : 

				$carousel_count++;
			
				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} 
				
				if ( get_sub_field( 'custom_id' ) ) {
					$carousel_id = get_sub_field( 'custom_id' );
			
				} else {
					$carousel_id = 'carousel-' . $carousel_count;
				}
			
				if ( get_sub_field( 'custom_class' ) ) {
					$carousel_class = get_sub_field( 'custom_class' );
			
				} else {
					$carousel_class = 'carousel-' . $carousel_count;
				}

				$carousel_vs  = 'section-vs-' . get_sub_field( 'vertical_spacing');
				$carousel_vsr = 'section-vsr-' . get_sub_field( 'vertical_spacing_responsive'); ?>

				<section id="<?php echo esc_attr( $carousel_id ); ?>" class="<?php echo esc_attr( $carousel_class ); ?> <?php echo esc_attr( $carousel_vs.' '.$carousel_vsr ); ?> <?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> carousel showcase" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr(get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>

					<div class="overflow-holder">
						<div class="container <?php the_sub_field( 'container' ); ?>">

							<?php
							get_template_part( 'template-parts/content', 'section-intro' ); ?>
							
							<div class="swiper-container <?php the_sub_field( 'carousel_layout' ); ?> items" data-autoplay="<?php the_sub_field( 'carousel_autoplay' ); ?>" data-speed="<?php the_sub_field( 'rotation_speed' ); ?>" data-perview="<?php the_sub_field( 'columns' ); ?>">
								<div class="swiper-wrapper">

									<?php
									$items = get_sub_field( 'item' );

									if ( $items ) :
										foreach( $items as $item ) : 
										
											$target = $item['target'];

											switch ( $target ) {
												case 'Anchor Link':
													$url = $item['url'];
												break;
										
												case 'Internal Link':
													$url = $item['url'];
												break;
										
												case 'External Link':
													$url = $item['url'];
												break;
										
												case 'Inner Page':
													$url = $item['page'];
												break;
										
												case 'Inner Post';
													$url = $item['post'];
												break;
										
												case 'This Image';
													$url = $item['image']['url'] ?? '';
												break;
										
												case 'Video URL';
													$url = $item['video_url'];
												break;
											}
										
											if ( isset( $item['image'] ) && isset( $item['image']['sizes'] ) ) {
												$image     = $item['image']['sizes']['leverage-grid-image'];
												$image_alt = $item['image']['alt'];
											} else {
												$image     = false;
												$image_alt = '';
											}
										?>

										<div class="swiper-slide slide-center slider-item item">

											<div class="row card p-0 text-center">
												<?php if ( $target === 'This Image' || $target === 'Video URL' ) : ?>
												<div class="gallery">
												<?php else : ?>
												<div class="no-gallery">												
												<?php endif; ?>

													<a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="image-over <?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?>">
														
														<?php if ( $target === 'Video URL' ) : ?>

														<div class="media-block grid">
															<i class="play-video-full icon-control-play"></i>
														</div>

														<?php endif; ?>
														
														<?php echo leverage_lazy_load_image( $image, $image_alt, '' ); ?>
													
														<div class="card-caption col-12 p-0">
															<div class="card-body">
																<h4 class="m-0"><?php echo esc_html( $item['title'] ); ?></h4>
															</div>
															<div class="card-footer d-lg-flex align-items-center justify-content-center">
																<?php echo strip_tags( $item['description'], '<p><br><br /><a><span><b><strong><i><em><u><del><blockquote><q><ul><ol><ins><code><pre><img>' ); ?>
															</div>
														</div>

													</a>

													<?php 
													// Clones
													if ( $target === 'This Image' || $target === 'Video URL' ) :
														foreach( $items as $item_hide ) : 
														
															$target = $item_hide['target'];

															switch ( $target ) {
																case 'Anchor Link':
																	$child_url = $item_hide['url'];
																break;
														
																case 'Internal Link':
																	$child_url = $item_hide['url'];
																break;
														
																case 'External Link':
																	$child_url = $item_hide['url'];
																break;
														
																case 'Inner Page':
																	$child_url = $item_hide['page'];
																break;
														
																case 'Inner Post';
																	$child_url = $item_hide['post'];
																break;
														
																case 'This Image';
																	$child_url = $item_hide['image']['url'] ?? '';
																break;
														
																case 'Video URL';
																	$child_url = $item_hide['video_url'];
																break;
															}

															if ( isset( $item_hide['image'] ) && isset( $item_hide['image']['sizes'] ) ) {
																$image_hide     = $item_hide['image']['sizes']['leverage-portfolio-image'];
																$image_hide_alt = $item_hide['image']['alt'];
															} else {
																$image_hide     = false;
																$image_hide_alt = '';
															}

															if ( $target === 'This Image' || $target === 'Video URL' ) :
																if ( $url !== $child_url ) : ?>

																	<a href="<?php echo esc_url( $child_url ); ?>" style="display:none">
																		<?php echo leverage_lazy_load_image( $image_hide, $image_hide_alt, '' ); ?>
																	</a>	

																<?php 
																endif;
															endif;
														endforeach; 
													endif;
													?>

												</div> <!-- Gallery -->

											</div>

										</div>

										<?php 
										endforeach; 
									endif; ?>

								</div>
								<div class="swiper-pagination"></div>
							</div>
							
						</div>
					</div>

				</section>	

			<?php
			$about_count = 0;
			elseif ( get_row_layout() == 'about' ) : 

				$about_count++;

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} 
				
				if ( get_sub_field( 'custom_id' ) ) {
					$about_id = get_sub_field( 'custom_id' );
			
				} else {
					$about_id = 'about-' . $about_count;
				}
			
				if ( get_sub_field( 'custom_class' ) ) {
					$about_class = get_sub_field( 'custom_class' );
			
				} else {
					$about_class = 'about-' . $about_count;
				}		
				
				$about_vs  = 'section-vs-' . get_sub_field( 'vertical_spacing');
				$about_vsr = 'section-vsr-' . get_sub_field( 'vertical_spacing_responsive');
				
				$column_format = get_sub_field( 'column_format' );

				switch ( $column_format ) {
					case '3-9': 
						$col_1 = 'col-md-3';
						$col_2 = 'col-md-9'; 
					break;
					case '4-8': 
						$col_1 = 'col-md-4';
						$col_2 = 'col-md-8'; 
					break;
					case '5-7': 
						$col_1 = 'col-md-5';
						$col_2 = 'col-md-7'; 
					break;
					case '6-6': 
						$col_1 = 'col-md-6';
						$col_2 = 'col-md-6'; 
					break;
					case '7-5': 
						$col_1 = 'col-md-7';
						$col_2 = 'col-md-5'; 
					break;
					case '8-4': 
						$col_1 = 'col-md-8';
						$col_2 = 'col-md-4'; 
					break;
					case '9-3': 
						$col_1 = 'col-md-9';
						$col_2 = 'col-md-3'; 
					break;
					default:
					$col_1 = 'col-md-6';
					$col_2 = 'col-md-6'; 
				}
				?>

				<section id="<?php echo esc_attr( $about_id ); ?>" class="<?php echo esc_attr( $about_class ); ?> <?php echo esc_attr( $about_vs.' '.$about_vsr ); ?> <?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> highlights <?php if ( get_sub_field( 'image_position' ) == 'Left' ) { echo esc_attr( 'image-left' ); } else { echo esc_attr( 'image-right' ); } ?>" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container <?php the_sub_field( 'container' ); ?>">
						<div class="row">
							<div class="col-12 <?php echo esc_attr( $col_1 ); ?> align-self-center text-center text-md-left <?php if ( get_sub_field( 'image_position' ) == 'Left' ) { echo esc_attr( 'pl-md-5 order-2' ); } ?>">
								
								<div class="row intro mb-4">
									<div class="col-12 p-0">

										<?php if ( get_sub_field( 'title' ) ) : ?>
										<h2 class="<?php the_sub_field( 'heading_style' ); ?>"><?php the_sub_field( 'title' ); ?></h2>
										<?php endif; ?>

										<?php if ( get_sub_field( 'description' ) ) { the_sub_field( 'description' ); } ?>
									</div>
								</div>

								<?php
								$items = get_sub_field( 'item' ); 
								
								if ( $items ) : ?>

								<div class="row items">
									<div class="col-12 p-0">

									<?php
									if ( $items ) :
										foreach( $items as $item ) :
											if ( $item['title'] || $item['description'] ) : ?>

											<div class="row item">										
												<?php if ( $item['icon'] ) : ?>
												<div class="col-12 col-md-2 pl-0 align-self-center">

													<?php if ( $item['icon_style'] == 'Line Icon' && $item['icon'] ) : ?>
													<i class="icon icon-<?php echo esc_attr( $item['icon'] ); ?>"></i>
													<?php elseif ( $item['icon_style'] == 'Awesome Icon' && $item['icon_fa'] ) : ?>
													<i class="icon <?php echo esc_attr( $item['icon_fa'] ); ?>"></i>
													<?php endif; ?>
													
												</div>
												<?php endif; ?>
												<div class="col-12 col-md-9 pl-0 align-self-center">
													<?php if ( $item['title'] ) : ?>
													<h4><?php echo esc_html( $item['title'] ); ?></h4>
													<?php endif; ?>
													<?php if ( $item['description'] ) : ?>
													<?php echo strip_tags( $item['description'], '<p><br><br /><a><span><b><strong><i><em><u><del><blockquote><q><ul><ol><ins><code><pre><img>' ); ?>
													<?php endif; ?>
												</div>
											</div>

											<?php
											endif;
										endforeach;
									endif;

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

									?>

									<div class="row item">
										<div class="col-12 pl-0 align-self-center">
											<a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="<?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?> mt-2 mt-md-4 mr-auto ml-auto ml-md-0 btn primary-button">
												<?php if ( get_sub_field( 'button_icon_style' ) == 'Line Icon' && get_sub_field( 'button_icon' ) ) : ?>
												<i class="icon-<?php echo esc_attr( get_sub_field( 'button_icon' ) ); ?>"></i>
												<?php elseif ( get_sub_field( 'button_icon_style' ) == 'Awesome Icon' && get_sub_field( 'button_icon_fa' ) ) : ?>
												<i class="<?php echo esc_attr( get_sub_field( 'button_icon_fa' ) ); ?>"></i>
												<?php endif; ?>
												<?php the_sub_field( 'button_label' ); ?>
											</a>
										</div>
									</div>

									<?php endif; ?>

									</div>
								</div>
								<?php endif; ?>
							</div>

							<div class="<?php if ( get_sub_field( 'enable_video' ) || ! get_sub_field( 'disable_click' ) ) { echo 'gallery'; } ?> col-12 <?php echo esc_attr( $col_2 ); ?>">

								<?php
								$image = get_sub_field( 'image' );
								if ( isset( $image['sizes'] ) ) : ?>

								<?php if ( get_sub_field( 'enable_video' ) || ! get_sub_field( 'disable_click' ) ) : ?>

								<a href="<?php if ( get_sub_field( 'enable_video' ) ) { echo esc_url( get_sub_field( 'video_url' ) ); } else { echo esc_url( $image['url'] ); } ?>">

								<?php endif; ?>

									<?php if ( get_sub_field( 'enable_video' ) ) : ?>

									<i class="play-video icon-control-play"></i>
									<div class="mask-radius"></div>

									<?php endif;

									if ( get_sub_field( 'original_image_size' ) ) {
										$image_about = $image['url'];
										$image_about_class = '';

									} else {
										$image_about = $image['sizes']['leverage-about-image'];
										$image_about_class = 'fit-image';
									}

									echo leverage_lazy_load_image( $image_about, $image["alt"], $image_about_class );
									
									?>

								<?php if ( get_sub_field( 'enable_video' ) || ! get_sub_field( 'disable_click' ) ) : ?>

								</a>

								<?php endif; ?>

								<?php endif; ?>

							</div>
						</div>
					</div>
				</section>

			<?php
			$video_count = 0;
			elseif ( get_row_layout() == 'video' ) :

				$video_count++;

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} 
				
				if ( get_sub_field( 'custom_id' ) ) {
					$video_id = get_sub_field( 'custom_id' );
			
				} else {
					$video_id = 'video-' . $video_count;
				}
			
				if ( get_sub_field( 'custom_class' ) ) {
					$video_class = get_sub_field( 'custom_class' );
			
				} else {
					$video_class = 'video-' . $video_count;
				}

				$video_vs  = 'section-vs-' . get_sub_field( 'vertical_spacing');
				$video_vsr = 'section-vsr-' . get_sub_field( 'vertical_spacing_responsive');

				?>

				<section id="<?php echo esc_attr( $video_id ); ?>" class="<?php echo esc_attr( $video_class ); ?> <?php echo esc_attr( $video_vs.' '.$video_vsr ); ?> <?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> highlights image-center" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container <?php the_sub_field( 'container' ); ?>">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>

						<div class="row text-center">
							<div class="col-12 gallery">

								<?php
								$image = get_sub_field( 'image' );
								if ( isset( $image['sizes'] ) ) : ?>

								<a href="<?php echo esc_url( get_sub_field( 'video_url' ) ); ?>" class="square-image d-flex justify-content-center align-items-center">
									<i class="icon bigger icon-control-play"></i>
									<?php echo leverage_lazy_load_image( $image['sizes']['leverage-video-image'], $image['alt'], 'fit-image' ); ?>
								</a>

								<?php endif; ?>
							</div>
						</div>
					</div>
				</section>

			<?php
			$funfacts_count = 0;
			elseif ( get_row_layout() == 'fun_facts' ) :

				$funfacts_count++;

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} 
				
				if ( get_sub_field( 'custom_id' ) ) {
					$funfacts_id = get_sub_field( 'custom_id' );
			
				} else {
					$funfacts_id = 'funfacts-' . $funfacts_count;
				}
			
				if ( get_sub_field( 'custom_class' ) ) {
					$funfacts_class = get_sub_field( 'custom_class' );
			
				} else {
					$funfacts_class = 'funfacts-' . $funfacts_count;
				}
				
				$funfacts_vs  = 'section-vs-' . get_sub_field( 'vertical_spacing');
				$funfacts_vsr = 'section-vsr-' . get_sub_field( 'vertical_spacing_responsive');

				?>

				<section id="<?php echo esc_attr( $funfacts_id ); ?>" class="<?php echo esc_attr( $funfacts_class ); ?> <?php echo esc_attr( $funfacts_vs.' '.$funfacts_vsr ); ?> <?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> counter funfacts <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> offers" <?php if ( get_sub_field( 'background_image' ) ) { echo 'style="background-image:url('.esc_attr( get_sub_field( 'background_image' ) ).')"'; } elseif ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container <?php the_sub_field( 'container' ); ?>">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>

						<div data-aos-id="counter" data-aos="fade-up" data-aos-delay="200" class="row justify-content-center text-center items">

							<?php
							$columns = get_sub_field( 'columns' );

							switch ( $columns ) {
								case '1': $col = 'col-12'; break;
								case '2': $col = 'col-12 col-md-6'; break;
								case '3': $col = 'col-12 col-md-6 col-lg-4'; break;
								case '4': $col = 'col-12 col-md-6 col-lg-3'; break;
								case '5': $col = 'col-12 col-md-6 col-lg'; break;
								case '6': $col = 'col-12 col-md-6 col-lg-2'; break;
							}

							$items = get_sub_field( 'item' );
							
							if ( $items ) :
								foreach( $items as $item ) : ?>

								<div class="<?php echo esc_attr( $col ); ?> item">
									<div data-percent="<?php echo esc_attr( $item['value'] ); ?>" data-symbol="<?php echo esc_attr( $item['symbol'] ); ?>" class="radial">
										<span></span>
									</div>
									<h4><?php echo esc_html( $item['title'] ); ?></h4>									
								</div>

								<?php 
								endforeach; 
							endif; ?>

						</div>
					</div>
				</section>

			<?php
			$skills_count = 0;
			elseif ( get_row_layout() == 'skills' ) :

				$skills_count++;

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} 
				
				if ( get_sub_field( 'custom_id' ) ) {
					$skills_id = get_sub_field( 'custom_id' );
			
				} else {
					$skills_id = 'skills-' . $skills_count;
				}
			
				if ( get_sub_field( 'custom_class' ) ) {
					$skills_class = get_sub_field( 'custom_class' );
			
				} else {
					$skills_class = 'skills-' . $skills_count;
				}

				$skills_vs  = 'section-vs-' . get_sub_field( 'vertical_spacing');
				$skills_vsr = 'section-vsr-' . get_sub_field( 'vertical_spacing_responsive');

				?>

				<section id="<?php echo esc_attr( $skills_id ); ?>" class="<?php echo esc_attr( $skills_class ); ?> <?php echo esc_attr( $skills_vs.' '.$skills_vsr ); ?> <?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> counter skills <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> offers" <?php if ( get_sub_field( 'background_image' ) ) { echo 'style="background-image:url('.esc_attr( get_sub_field( 'background_image' ) ).')"'; } elseif ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container <?php the_sub_field( 'container' ); ?>">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>

						<div data-aos-id="counter" data-aos="fade-up" data-aos-delay="200" class="row justify-content-center text-center items">

							<?php
							$columns = get_sub_field( 'columns' );

							switch ( $columns ) {
								case '1': $col = 'col-12'; break;
								case '2': $col = 'col-12 col-md-6'; break;
								case '3': $col = 'col-12 col-md-6 col-lg-4'; break;
								case '4': $col = 'col-12 col-md-6 col-lg-3'; break;
								case '5': $col = 'col-12 col-md-6 col-lg'; break;
								case '6': $col = 'col-12 col-md-6 col-lg-2'; break;
							}

							$items = get_sub_field( 'item' );
							
							if ( $items ) :
								foreach( $items as $item ) : ?>

								<div class="<?php echo esc_attr( $col ); ?> item">
									<div data-percent="<?php echo esc_attr( $item['value'] ); ?>" data-symbol="<?php echo esc_attr( $item['symbol'] ); ?>" class="radial">
										<span></span>
									</div>
									<h4><?php echo esc_html( $item['title'] ); ?></h4>									
								</div>

								<?php 
								endforeach; 
							endif; ?>

						</div>
					</div>
				</section>

			<?php
			$features_count = 0;
			elseif ( get_row_layout() == 'features' ) :

				$features_count++;

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} 
				
				if ( get_sub_field( 'custom_id' ) ) {
					$features_id = get_sub_field( 'custom_id' );
			
				} else {
					$features_id = 'features-' . $features_count;
				}
			
				if ( get_sub_field( 'custom_class' ) ) {
					$features_class = get_sub_field( 'custom_class' );
			
				} else {
					$features_class = 'features-' . $features_count;
				}

				$features_vs  = 'section-vs-' . get_sub_field( 'vertical_spacing');
				$features_vsr = 'section-vsr-' . get_sub_field( 'vertical_spacing_responsive');

				?>

				<section id="<?php echo esc_attr( $features_id ); ?>" class="<?php echo esc_attr( $features_class ); ?> <?php echo esc_attr( $features_vs.' '.$features_vsr ); ?> <?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> offers" <?php if ( get_sub_field( 'background_image' ) ) { echo 'style="background-image:url('.esc_attr( get_sub_field( 'background_image' ) ).')"'; } elseif ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container <?php the_sub_field( 'container' ); ?>">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>

						<div class="row justify-content-center text-center items">

						<?php
						$columns = get_sub_field( 'columns' );

						switch ( $columns ) {
							case '1': $col = 'col-12'; break;
							case '2': $col = 'col-12 col-md-6'; break;
							case '3': $col = 'col-12 col-md-6 col-lg-4'; break;
							case '4': $col = 'col-12 col-md-6 col-lg-3'; break;
							case '5': $col = 'col-12 col-md-6 col-lg'; break;
							case '6': $col = 'col-12 col-md-6 col-lg-2'; break;
						}

						$items = get_sub_field( 'item' );
						
						if ( $items ) :
							foreach( $items as $item ) : ?>

							<div class="<?php echo esc_attr( $col ); ?> item">
								<div class="card no-hover">

									<?php if ( $item['icon_style'] == 'Line Icon' && $item['icon'] ) : ?>
									<i class="icon icon-<?php echo esc_attr( $item['icon'] ); ?>"></i>
									<?php elseif ( $item['icon_style'] == 'Awesome Icon' && $item['icon_fa'] ) : ?>
									<i class="icon <?php echo esc_attr( $item['icon_fa'] ); ?>"></i>
									<?php elseif ( $item['icon_style'] == 'Image Icon' && $item['icon_img'] ) : ?>
									<img src="<?php echo esc_url( $item['icon_img'] ); ?>" class="icon" alt="<?php echo esc_attr( $item['title'] ); ?>" />
									<?php endif; ?>

									<h4><?php echo esc_html( $item['title'] ); ?></h4>
									<?php echo strip_tags( $item['description'], '<p><br><br /><a><span><b><strong><i><em><u><del><blockquote><q><ul><ol><ins><code><pre><img>' ); ?>

								</div>
							</div>

							<?php
							endforeach;
						endif; ?>

						</div>
					</div>
				</section>		

			<?php
			$services_count = 0;
			elseif ( get_row_layout() == 'services' ) :

				$services_count++;

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} 
				
				if ( get_sub_field( 'custom_id' ) ) {
					$services_id = get_sub_field( 'custom_id' );
			
				} else {
					$services_id = 'services-' . $services_count;
				}
			
				if ( get_sub_field( 'custom_class' ) ) {
					$services_class = get_sub_field( 'custom_class' );
			
				} else {
					$services_class = 'services-' . $services_count;
				}

				$services_vs  = 'section-vs-' . get_sub_field( 'vertical_spacing');
				$services_vsr = 'section-vsr-' . get_sub_field( 'vertical_spacing_responsive');

				?>

				<section id="<?php echo esc_attr( $services_id ); ?>" class="<?php echo esc_attr( $services_class ); ?> <?php echo esc_attr( $services_vs.' '.$services_vsr ); ?> <?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> offers" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container <?php the_sub_field( 'container' ); ?>">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>

						<div class="row justify-content-center text-center items">

							<?php
							$columns = get_sub_field( 'columns' );

							switch ( $columns ) {
								case '1': $col = 'col-12'; break;
								case '2': $col = 'col-12 col-md-6'; break;
								case '3': $col = 'col-12 col-md-6 col-lg-4'; break;
								case '4': $col = 'col-12 col-md-6 col-lg-3'; break;
								case '5': $col = 'col-12 col-md-6 col-lg'; break;
								case '6': $col = 'col-12 col-md-6 col-lg-2'; break;
							}

							$items = get_sub_field( 'item' );
							
							if ( $items ) :
								foreach( $items as $item ) :
									
									$target = $item['target'];

									switch ( $target ) {
										case 'Anchor Link':
											$url = $item['url'];
										break;
								
										case 'Internal Link':
											$url = $item['url'];
										break;
								
										case 'External Link':
											$url = $item['url'];
										break;
								
										case 'Inner Page':
											$url = $item['page'];
										break;
								
										case 'Inner Post';
											$url = $item['post'];
										break;
									}
								?>

								<div class="<?php echo esc_attr( $col ); ?> item">
									<div class="card featured" <?php if ( $item['card_bg_color'] ) { echo 'style="background-color:'.esc_attr( $item['card_bg_color'] ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>

										<?php if ( $item['icon_style'] == 'Line Icon' && $item['icon'] ) : ?>
										<i class="icon icon-<?php echo esc_attr( $item['icon'] ); ?>"></i>
										<?php elseif ( $item['icon_style'] == 'Awesome Icon' && $item['icon_fa'] ) : ?>
										<i class="icon <?php echo esc_attr( $item['icon_fa'] ); ?>"></i>
										<?php elseif ( $item['icon_style'] == 'Image Icon' && $item['icon_img'] ) : ?>
										<img src="<?php echo esc_url( $item['icon_img'] ); ?>" class="icon" alt="<?php echo esc_attr( $item['title'] ); ?>" />
										<?php endif; ?>

										<h4><?php echo esc_html( $item['title'] ); ?></h4>
										<?php echo strip_tags( $item['description'], '<p><br><br /><a><span><b><strong><i><em><u><del><blockquote><q><ul><ol><ins><code><pre><img>' ); ?>

										<?php if ( ! $item['disable_link'] ) : ?>

										<a href="<?php echo esc_url( $url ); ?>" <?php if ( $item['target'] == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="full-link <?php if ( $item['target'] == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?>"></a>
										<i class="btn-icon icon-arrow-right-circle"></i>

										<?php endif; ?>

									</div>
								</div>

								<?php 
								endforeach; 
							endif; ?>

						</div>
					</div>
				</section>

			<?php
			$portfolio_count = 0;
			elseif ( get_row_layout() == 'portfolio' ) : 

				$portfolio_count++;

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} 
				
				if ( get_sub_field( 'custom_id' ) ) {
					$portfolio_id = get_sub_field( 'custom_id' );
			
				} else {
					$portfolio_id = 'portfolio-' . $portfolio_count;
				}
			
				if ( get_sub_field( 'custom_class' ) ) {
					$portfolio_class = get_sub_field( 'custom_class' );
			
				} else {
					$portfolio_class = 'portfolio-' . $portfolio_count;
				}

				$portfolio_vs  = 'section-vs-' . get_sub_field( 'vertical_spacing');
				$portfolio_vsr = 'section-vsr-' . get_sub_field( 'vertical_spacing_responsive');

				?>

				<section id="<?php echo esc_attr( $portfolio_id ); ?>" class="<?php echo esc_attr( $portfolio_class ); ?> <?php echo esc_attr( $portfolio_vs.' '.$portfolio_vsr ); ?> <?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> portfolio-featured offers secondary" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
				
					<div class="container <?php the_sub_field( 'container' ); ?>">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>
						
						<div class="row justify-content-center text-center items">
							
							<?php
							$columns = get_sub_field( 'columns' );

							switch ( $columns ) {
								case '1': $col = 'col-12'; break;
								case '2': $col = 'col-12 col-md-6'; break;
								case '3': $col = 'col-12 col-md-6 col-lg-4'; break;
								case '4': $col = 'col-12 col-md-6 col-lg-3'; break;
								case '5': $col = 'col-12 col-md-6 col-lg'; break;
								case '6': $col = 'col-12 col-md-6 col-lg-2'; break;
							}

							$items = get_sub_field( 'item' );
							
							if ( $items ) :
								foreach( $items as $item ) : 
								
									$target = $item['target'];

									switch ( $target ) {
										case 'Anchor Link':
											$url = $item['url'];
										break;
								
										case 'Internal Link':
											$url = $item['url'];
										break;
								
										case 'External Link':
											$url = $item['url'];
										break;
								
										case 'Inner Page':
											$url = $item['page'];
										break;
								
										case 'Inner Post';
											$url = $item['post'];
										break;
								
										case 'This Image';
											$url = $item['image']['url'] ?? '';
										break;
								
										case 'Video URL';
											$url = $item['video_url'];
										break;
									}

									if ( isset( $item['image'] ) && isset( $item['image']['sizes'] ) ) {

										if ( isset( $item['original_image_size'] ) && $item['original_image_size'] == true ) {
											$image = $item['image']['url'] ?? '';
										} else {
											$image = $item['image']['sizes']['leverage-portfolio-image'];
										}

										$image_alt = $item['image']['alt'];
										
									} else {
										$image     = false;
										$image_alt = '';
									}
								?>

								<div class="<?php echo esc_attr( $col ); ?> item">
									<div class="card featured" <?php if ( $item['card_bg_color'] ) { echo 'style="background-color:'.esc_attr( $item['card_bg_color'] ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>					
										
										<?php if ( $target === 'This Image' || $target === 'Video URL' ) : ?>
										<div class="gallery">
										<?php else : ?>
										<div class="no-gallery">
										<?php endif; ?>

											<a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="<?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?>">

												<h4><?php echo esc_html( $item['title'] ); ?></h4>
												<?php echo strip_tags( $item['description'], '<p><br><br /><a><span><b><strong><i><em><u><del><blockquote><q><ul><ol><ins><code><pre><img>' ); ?>		

												<div class="media-block">
													<?php if ( $target === 'Video URL' ) : ?>
													<i class="play-video-full icon-control-play"></i>
													<?php endif; ?>
													<?php echo leverage_lazy_load_image( $image, $image_alt, '' ); ?>
												</div>
												
											</a>	

											<?php 
											if ( $target === 'This Image' || $target === 'Video URL' ) :
												foreach( $items as $item_hide ) : 
												
													$target = $item_hide['target'];

													switch ( $target ) {
														case 'Anchor Link':
															$child_url = $item_hide['url'];
														break;
												
														case 'Internal Link':
															$child_url = $item_hide['url'];
														break;
												
														case 'External Link':
															$child_url = $item_hide['url'];
														break;
												
														case 'Inner Page':
															$child_url = $item_hide['page'];
														break;
												
														case 'Inner Post';
															$child_url = $item_hide['post'];
														break;
												
														case 'This Image';
															$child_url = $item_hide['image']['url'] ?? '';
														break;
												
														case 'Video URL';
															$child_url = $item_hide['video_url'];
														break;
													}

													if ( isset( $item_hide['image'] ) && isset( $item_hide['image']['sizes'] ) ) {
														$image_hide     = $item_hide['image']['sizes']['leverage-portfolio-image'];
														$image_hide_alt = $item_hide['image']['alt'];
													} else {
														$image_hide     = false;
														$image_hide_alt = '';
													}

													if ( $target === 'This Image' || $target === 'Video URL' ) :
														if ( $url !== $child_url ) : ?>

															<a href="<?php echo esc_url( $child_url ); ?>" style="display:none">
																<?php echo leverage_lazy_load_image( $image_hide, $image_hide_alt, '' ); ?>
															</a>	

														<?php 
														endif;
													endif;
												endforeach; 
											endif;
											?>

										</div>
									</div>
								</div>

								<?php
								endforeach;
							endif; ?>

						</div>
					</div>
				</section>

			<?php
			$portfolio_grid_count = 0;
			elseif ( get_row_layout() == 'portfolio_grid' ) : 

				$portfolio_grid_count++;

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} 
				
				if ( get_sub_field( 'custom_id' ) ) {
					$portfolio_grid_id = get_sub_field( 'custom_id' );
			
				} else {
					$portfolio_grid_id = 'portfolio-grid-' . $portfolio_grid_count;
				}
			
				if ( get_sub_field( 'custom_class' ) ) {
					$portfolio_grid_class = get_sub_field( 'custom_class' );
			
				} else {
					$portfolio_grid_class = 'portfolio-grid-' . $portfolio_grid_count;
				}

				$portfolio_grid_vs  = 'section-vs-' . get_sub_field( 'vertical_spacing');
				$portfolio_grid_vsr = 'section-vsr-' . get_sub_field( 'vertical_spacing_responsive');

				?>

				<section id="<?php echo esc_attr( $portfolio_grid_id ); ?>" class="<?php echo esc_attr( $portfolio_grid_class ); ?> <?php echo esc_attr( $portfolio_grid_vs.' '.$portfolio_grid_vsr ); ?> <?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd body-mode-dark' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> <?php if ( get_sub_field( 'enable_filter' ) ) { echo esc_attr( 'filter-section' ); } ?> showcase portfolio blog-grid" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					
					<div class="container <?php the_sub_field( 'container' ); ?>">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>

						<?php 
						$filter_all_button = get_sub_field( 'filter_all_button' );

						if ( $filter_all_button ) {
							$filter_all_button = get_sub_field( 'filter_all_button' );

						}	else {
							$filter_all_button =  false;
						}							
					
						if ( get_sub_field( 'enable_filter' ) ) : ?>

						<div class="row justify-content-center text-center">
							<div class="col-12">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">

										<?php if ( $filter_all_button ) : ?>
											<label class="btn active">
												<input type="radio" value="all" checked class="btn-filter-item">
												<span><?php echo esc_html( $filter_all_button ); ?></span>
											</label>
										<?php endif; ?>

									<?php 
									if ( get_sub_field( 'enable_portfolio_archive' ) ) :

										$filter_categories = get_sub_field( 'filter_portfolio_categories' ); 

									else :

										$filter_categories = get_sub_field( 'filter_categories' ); 

									endif;

									$filter_categories_list = null;
									if ( $filter_categories ) :
										foreach( $filter_categories as $category ) : 
										
										$filter_categories_list[] = $category->term_id;

										?>

										<label class="btn">
											<input type="radio" value="<?php echo esc_html( $category->term_id ); ?>" class="btn-filter-item">
											<span><?php echo esc_html( $category->name ); ?></span>
										</label>

										<?php endforeach; 
									endif; 
									?>
								</div>
							</div>
						</div>

						<?php endif; ?>

						<?php 
							$columns = get_sub_field( 'columns' );

							switch ( $columns ) {
								case '1': $col = 'col-12'; break;
								case '2': $col = 'col-12 col-md-6'; break;
								case '3': $col = 'col-12 col-md-6 col-lg-4'; break;
								case '4': $col = 'col-12 col-md-6 col-lg-3'; break;
								case '5': $col = 'col-12 col-md-6 col-lg'; break;
								case '6': $col = 'col-12 col-md-6 col-lg-2'; break;
							}

							if ( get_sub_field( 'enable_portfolio_archive' ) ) :

								if ( get_sub_field( 'enable_filter' ) ) {

									$tax_query = array(
										array( 
											'taxonomy' => 'leverage_portfolio_category', 
											'field'    => 'id', 
											'terms'    => $filter_categories_list
										) 
									);
			
								} else {
									$tax_query = null;
								}

								$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

								$exclude_posts_id      = get_sub_field( 'exclude_posts_id' );
								$exclude_posts_id_list = explode( ',', $exclude_posts_id );

								$args = array(
									'post_type'      => 'leverage-portfolio',
									'tax_query'      => $tax_query,
									'post_status'    => 'publish',
									'order'          => get_sub_field( 'order' ),
									'orderby'        => get_sub_field( 'order_by' ),
									'posts_per_page' => get_sub_field( 'posts_per_page' ),
									'post__not_in'   => $exclude_posts_id_list,
									'paged'          => $paged
								);
				
								$query = new WP_Query( $args );

								if ( $query->have_posts() ) :

									$items = null;

									while( $query->have_posts() ) :
										$query->the_post();

										$item_terms = get_the_terms( get_the_ID(), 'leverage_portfolio_category' );
										
										$item_categories = null;

										if ( isset( $item_terms ) ) {

											foreach( $item_terms as $item_term ) {
												$item_categories[] = $item_term->term_id;
											}
										}

										$items[] = array(
											'image' => array(
												'ID'    => get_the_ID(),
												'title' => get_the_title(),
												'alt'   => get_the_title(),
												'url'   => get_the_post_thumbnail_url(),
												'sizes' => array(
													'leverage-grid-image'      => get_the_post_thumbnail_url( get_the_ID(), 'leverage-grid-image' ),
													'leverage-portfolio-image' => get_the_post_thumbnail_url( get_the_ID(), 'leverage-portfolio-image' )
												),
											),
											'original_image_size' => '',
											'title'               => get_the_title(),
											'description'         => get_the_excerpt(),
											'target'              => 'Internal Link',
											'url'                 => get_the_permalink(),
											'video_url'           => '',
											'page'                => '',
											'post'                => '',
											'categories'          => $item_categories
										);

									endwhile;

									wp_reset_postdata();
								endif;

							else :

								$items = get_sub_field( 'item' );

							endif;
						?>
						
						<div class="row items justify-content-center <?php if ( get_sub_field( 'enable_filter' ) ) { echo esc_attr( 'filter-items' ); } ?>">
							
							<?php
							if ( $items ) :

								foreach( $items as $item ) : 
								
									$target = $item['target'];

									switch ( $target ) {
										case 'Anchor Link':
											$url = $item['url'];
										break;
								
										case 'Internal Link':
											$url = $item['url'];
										break;
								
										case 'External Link':
											$url = $item['url'];
										break;
								
										case 'Inner Page':
											$url = $item['page'];
										break;
								
										case 'Inner Post';
											$url = $item['post'];
										break;
								
										case 'This Image';
											$url = $item['image']['url'] ?? '';
										break;
								
										case 'Video URL';
											$url = $item['video_url'];
										break;
									}

									if ( $item['categories'] ) {									
										$categories_list = implode( '","', $item['categories'] );									
										$categories      = "[\"$categories_list\"]";
									} else {
										$categories = "[\"0\"]";
									}

									if ( isset( $item['image'] ) && isset( $item['image']['sizes'] ) ) {

										if ( isset( $item['original_image_size'] ) && $item['original_image_size'] == true ) {
											$image = $item['image']['url'] ?? '';
										} else {
											$image = $item['image']['sizes']['leverage-grid-image'];
										}

										$image_alt = $item['image']['alt'];

									} else {
										$image     = false;
										$image_alt = '';
									}
								?>

								<div class="<?php echo esc_attr( $col ); ?> item <?php if ( get_sub_field( 'enable_filter' ) ) { echo esc_attr( 'filter-item' ); } ?>" <?php if ( get_sub_field( 'enable_filter' ) ) { echo 'data-groups=' . esc_attr ( $categories ); } ?> <?php if ( get_sub_field( 'enable_filter' ) ) { } ?>>
									<div class="row card p-0 text-center">
										<?php if ( $target === 'This Image' || $target === 'Video URL' ) : ?>
										<div class="gallery">
										<?php else : ?>
										<div class="no-gallery">												
										<?php endif; ?>

											<a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="image-over <?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?>">
												
												<?php if ( $target === 'Video URL' ) : ?>

												<div class="media-block grid">
													<i class="play-video-full icon-control-play"></i>
												</div>

												<?php endif; ?>
												
												<?php echo leverage_lazy_load_image( $image, $image_alt, '' ); ?>
											
												<div class="card-caption col-12 p-0">
													<div class="card-body">
														<h4 class="m-0"><?php echo esc_html( $item['title'] ); ?></h4>
													</div>
													<div class="card-footer d-lg-flex align-items-center justify-content-center">
														<?php echo strip_tags( $item['description'], '<p><br><br /><a><span><b><strong><i><em><u><del><blockquote><q><ul><ol><ins><code><pre><img>' ); ?>
													</div>
												</div>

											</a>

											<?php 
											// Clones
											if ( $target === 'This Image' || $target === 'Video URL' ) :
												foreach( $items as $item_hide ) : 
												
													$target = $item_hide['target'];

													switch ( $target ) {
														case 'Anchor Link':
															$child_url = $item_hide['url'];
														break;
												
														case 'Internal Link':
															$child_url = $item_hide['url'];
														break;
												
														case 'External Link':
															$child_url = $item_hide['url'];
														break;
												
														case 'Inner Page':
															$child_url = $item_hide['page'];
														break;
												
														case 'Inner Post';
															$child_url = $item_hide['post'];
														break;
												
														case 'This Image';
															$child_url = $item_hide['image']['url'] ?? '';
														break;
												
														case 'Video URL';
															$child_url = $item_hide['video_url'];
														break;
													}

													if ( isset( $item_hide['image'] ) && isset( $item_hide['image']['sizes'] ) ) {
														$image_hide     = $item_hide['image']['sizes']['leverage-portfolio-image'];
														$image_hide_alt = $item_hide['image']['alt'];
													} else {
														$image_hide     = false;
														$image_hide_alt = '';
													}

													if ( $target === 'This Image' || $target === 'Video URL' ) :
														if ( $url !== $child_url ) : ?>

															<a href="<?php echo esc_url( $child_url ); ?>" style="display:none">
																<?php echo leverage_lazy_load_image( $image_hide, $image_hide_alt, '' ); ?>
															</a>	

														<?php 
														endif;
													endif;
												endforeach; 
											endif;
											?>

										</div> <!-- Gallery -->

									</div>
								</div>

								<?php
								endforeach;
							endif; ?>

							<?php if ( get_sub_field( 'enable_filter' ) ) : ?>
							<div class="col-1 filter-sizer"></div>
							<?php endif; ?>

						</div>

						<?php if ( get_sub_field( 'enable_portfolio_archive' ) ) : ?>
						<div class="row">
							<div class="col-12">
								<nav>
									<?php
									echo paginate_links(
										array(
											'total' => $query->max_num_pages,
											'end_size'  => 1,
											'mid_size'  => 2,
											'prev_text' => '<i class="icon-arrow-left"></i>',
											'next_text' => '<i class="icon-arrow-right"></i>',
											'type'      => 'list'
										)
									);
									?>
								</nav>
							</div>
						</div>
						<?php endif; ?>

					</div>
				</section>

			<?php
			$team_count = 0;
			elseif ( get_row_layout() == 'team' ) : 

				$team_count++;

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} 
				
				if ( get_sub_field( 'custom_id' ) ) {
					$team_id = get_sub_field( 'custom_id' );
			
				} else {
					$team_id = 'team-' . $team_count;
				}
			
				if ( get_sub_field( 'custom_class' ) ) {
					$team_class = get_sub_field( 'custom_class' );
			
				} else {
					$team_class = 'team-' . $team_count;
				}

				$team_vs  = 'section-vs-' . get_sub_field( 'vertical_spacing');
				$team_vsr = 'section-vsr-' . get_sub_field( 'vertical_spacing_responsive');

				?>

				<section id="<?php echo esc_attr( $team_id ); ?>" class="<?php echo esc_attr( $team_class ); ?> <?php echo esc_attr( $team_vs.' '.$team_vsr ); ?> <?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> carousel" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>

					<div class="overflow-holder">
						<div class="container <?php the_sub_field( 'container' ); ?>">

							<?php
							get_template_part( 'template-parts/content', 'section-intro' ); ?>
							
							<div class="swiper-container <?php the_sub_field( 'carousel_layout' ); ?> items" data-autoplay="<?php the_sub_field( 'carousel_autoplay' ); ?>" data-speed="<?php the_sub_field( 'rotation_speed' ); ?>" data-perview="<?php the_sub_field( 'columns' ); ?>">
								<div class="swiper-wrapper">
								
								<?php
								$items = get_sub_field( 'item' );
								
								if ( $items ) :
									foreach( $items as $item ) : ?>

									<div class="swiper-slide slide-center slider-item text-center item">
										<div class="row card" <?php if ( $item['card_bg_color'] ) { echo 'style="background-color:'.esc_attr( $item['card_bg_color'] ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
											<div class="col-12">
											
												<?php echo leverage_lazy_load_image( $item['photo']['sizes']['thumbnail'], $item['photo']['alt'], 'person' ); ?>

												<h4><?php echo esc_html( $item['name'] ); ?></h4>
												<p><?php echo strip_tags( $item['role'], '<br><br /><a><span><b><strong><i><em><u><del><blockquote><q><ul><ol><ins><code><pre><img>' ); ?></p>
												<?php echo strip_tags( $item['biography'], '<p><br><br /><a><span><b><strong><i><em><u><del><blockquote><q><ul><ol><ins><code><pre><img>' ); ?>

												<ul class="navbar-nav social share-list ml-auto">

												<?php 
												$social_networks = $item['social_networks'];

												if ( $social_networks ) :
													foreach( $social_networks as $social_network) : 
													
														if ( $social_network['acf_fc_layout'] == 'custom' ) :
															if ( $social_network['icon_style'] == 'Line Icon' ) :
																$item_price_icon = 'icon-' . $social_network['icon'];

															elseif ( $social_network['icon_style'] == 'Awesome Icon' ) :
																$item_price_icon = $social_network['icon_fa'];

															endif;

														else :
															$item_price_icon = 'icon-social-' . $social_network['acf_fc_layout']; 

														endif; ?>

														<li class="nav-item">
															<a href="<?php echo esc_url( $social_network['url'] ); ?>" target="_blank" class="nav-link">
																<i class="<?php echo esc_attr( $item_price_icon ); ?>"></i>
															</a>
														</li>

													<?php
													endforeach;
												endif; ?>

												</ul>
											</div>
										</div>
									</div>

									<?php
									endforeach;
								endif; ?>

								</div>
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>

				</section>

			<?php
			$testimonials_count = 0;
			elseif ( get_row_layout() == 'testimonials' ) :
				
				$testimonials_count++;

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} 
				
				if ( get_sub_field( 'custom_id' ) ) {
					$testimonials_id = get_sub_field( 'custom_id' );
			
				} else {
					$testimonials_id = 'testimonials-' . $testimonials_count;
				}
			
				if ( get_sub_field( 'custom_class' ) ) {
					$testimonials_class = get_sub_field( 'custom_class' );
			
				} else {
					$testimonials_class = 'testimonials-' . $testimonials_count;
				}

				$testimonials_vs  = 'section-vs-' . get_sub_field( 'vertical_spacing');
				$testimonials_vsr = 'section-vsr-' . get_sub_field( 'vertical_spacing_responsive');

				?>

				<section id="<?php echo esc_attr( $testimonials_id ); ?>" class="<?php echo esc_attr( $testimonials_class ); ?> <?php echo esc_attr( $testimonials_vs.' '.$testimonials_vsr ); ?> <?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> carousel" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>

					<div class="overflow-holder">
						<div class="container <?php the_sub_field( 'container' ); ?>">

							<?php
							get_template_part( 'template-parts/content', 'section-intro' ); ?>
							
							<div class="swiper-container <?php the_sub_field( 'carousel_layout' ); ?> items" data-autoplay="<?php the_sub_field( 'carousel_autoplay' ); ?>" data-speed="<?php the_sub_field( 'rotation_speed' ); ?>" data-perview="<?php the_sub_field( 'columns' ); ?>">
								<div class="swiper-wrapper">
								
								<?php
								$items = get_sub_field( 'item' );
								
								if ( $items ) :
									foreach( $items as $item ) : ?>

									<div class="swiper-slide slide-center slider-item text-center item">
										<div class="row card" <?php if ( $item['card_bg_color'] ) { echo 'style="background-color:'.esc_attr( $item['card_bg_color'] ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
											<div class="col-12">
											
												<?php echo leverage_lazy_load_image( $item['photo']['sizes']['thumbnail'] ?? '', $item['photo']['alt'] ?? '', 'person' ); ?>

												<h4><?php echo esc_html( $item['name'] ); ?></h4>
												<?php echo strip_tags( $item['testimonial'], '<p><br><br /><a><span><b><strong><i><em><u><del><blockquote><q><ul><ol><ins><code><pre><img>' ); ?>

												<ul class="navbar-nav social share-list star-rating ml-auto">

												<?php 
												for( $x = 1; $x <= $item['rating']; $x++) : ?>
													<li class="nav-item">
														<a href="#" class="nav-link"><i class="filled">★</i></a>
													</li>
												<?php 
												endfor; 
												?>

												<?php
												for( $x = 1; $x <= 5 - $item['rating']; $x++) : ?>
													<li class="nav-item">
														<a href="#" class="nav-link"><i>★</i></a>
													</li>
												<?php 
												endfor; 
												?>

												</ul>
											</div>
										</div>
									</div>

									<?php
									endforeach;
								endif; ?>

								</div>
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>

				</section>

			<?php
			$partners_count = 0;
			elseif ( get_row_layout() == 'partners' ) : 

				$partners_count++;

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} 
				
				if ( get_sub_field( 'custom_id' ) ) {
					$partners_id = get_sub_field( 'custom_id' );
			
				} else {
					$partners_id = 'partners-' . $partners_count;
				}
			
				if ( get_sub_field( 'custom_class' ) ) {
					$partners_class = get_sub_field( 'custom_class' );
			
				} else {
					$partners_class = 'partners-' . $partners_count;
				}

				$partners_vs  = 'section-vs-' . get_sub_field( 'vertical_spacing');
				$partners_vsr = 'section-vsr-' . get_sub_field( 'vertical_spacing_responsive');

				?>

				<section id="<?php echo esc_attr( $partners_id ); ?>" class="<?php echo esc_attr( $partners_class ); ?> <?php echo esc_attr( $partners_vs.' '.$partners_vsr ); ?> <?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> logos" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					
					<div class="overflow-holder">	
						<div class="container <?php the_sub_field( 'container' ); ?>">

							<?php
							get_template_part( 'template-parts/content', 'section-intro' ); ?>

							<div data-autoplay="<?php the_sub_field( 'carousel_autoplay' ); ?>" data-speed="<?php the_sub_field( 'rotation_speed' ); ?>" class="swiper-container min-slider">
								<div class="swiper-wrapper">

									<?php
									$items = get_sub_field( 'item' );
									
									if ( $items ) :
										foreach( $items as $item ) : ?>

										<div class="swiper-slide slide-center slider-item item">
											<a <?php if ( $item['enable_url'] ) { echo 'href="' . esc_url( $item['url'] ) . '" target="_blank"'; } ?>>
												<?php echo leverage_lazy_load_image( $item['logo']['url'], $item['logo']['alt'], 'fit-image' ); ?>
											</a>
										</div>

										<?php
										endforeach;
									endif; ?>

								</div>
							</div>
						</div>
					</div>

				</section>

			<?php
			$pricing_count = 0;
			elseif ( get_row_layout() == 'pricing' ) :

				$pricing_count++;

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				}
				
				if ( get_sub_field( 'custom_id' ) ) {
					$pricing_id = get_sub_field( 'custom_id' );
			
				} else {
					$pricing_id = 'pricing-' . $pricing_count;
				}
			
				if ( get_sub_field( 'custom_class' ) ) {
					$pricing_class = get_sub_field( 'custom_class' );
			
				} else {
					$pricing_class = 'pricing-' . $pricing_count;
				}

				$pricing_vs  = 'section-vs-' . get_sub_field( 'vertical_spacing');
				$pricing_vsr = 'section-vsr-' . get_sub_field( 'vertical_spacing_responsive');

				?>

				<section id="<?php echo esc_attr( $pricing_id ); ?>" class="<?php echo esc_attr( $pricing_class ); ?> <?php echo esc_attr( $pricing_vs.' '.$pricing_vsr ); ?> <?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> plans" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container <?php the_sub_field( 'container' ); ?>">

						<?php
						get_template_part( 'template-parts/content', 'section-intro' ); ?>

						<div class="row justify-content-center text-center items">

							<?php
							$columns = get_sub_field( 'columns' );

							switch ( $columns ) {
								case '1': $col = 'col-12'; break;
								case '2': $col = 'col-12 col-md-6'; break;
								case '3': $col = 'col-12 col-md-6 col-lg-4'; break;
								case '4': $col = 'col-12 col-md-6 col-lg-3'; break;
								case '5': $col = 'col-12 col-md-6 col-lg'; break;
								case '6': $col = 'col-12 col-md-6 col-lg-2'; break;
							}

							$items = get_sub_field( 'item' );
							
							if ( $items ) :
								foreach( $items as $item ) : 
								
									$target = $item['button_target'];

									switch ( $target ) {
										case 'Anchor Link':
											$url = $item['button_url'];
										break;
								
										case 'Internal Link':
											$url = $item['button_url'];
										break;
								
										case 'External Link':
											$url = $item['button_url'];
										break;
								
										case 'Inner Page':
											$url = $item['button_page'];
										break;
								
										case 'Inner Post';
											$url = $item['button_post'];
										break;
									}								
								?>

								<div class="<?php echo esc_attr( $col ); ?> align-self-center text-center item">
									<div class="card" <?php if ( $item['card_bg_color'] ) { echo 'style="background-color:'.esc_attr( $item['card_bg_color'] ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>

										<?php if ( $item['icon_style'] == 'Line Icon' && $item['icon'] ) : ?>
										<i class="icon icon-<?php echo esc_attr( $item['icon'] ); ?>"></i>
										<?php elseif ( $item['icon_style'] == 'Awesome Icon' && $item['icon_fa'] ) : ?>
										<i class="icon <?php echo esc_attr( $item['icon_fa'] ); ?>"></i>
										<?php elseif ( $item['icon_style'] == 'Image Icon' && $item['icon_img'] ) : ?>
										<img src="<?php echo esc_url( $item['icon_img'] ); ?>" class="icon" alt="<?php echo esc_attr( $item['title'] ); ?>" />
										<?php endif; ?>

										<h4><?php echo esc_html( $item['title'] ); ?></h4>

										<span class="price"><i><?php echo esc_html( $item['currency'] ); ?></i><?php echo esc_html( $item['price'] ); ?></span>

										<ul class="list-group list-group-flush">

										<?php
										$features = $item['features'];
										
										if ( $features ) :
											foreach( $features as $feature ) : ?>

											<li class="list-group-item d-flex justify-content-between align-items-center text-left">
												<span><?php echo esc_html( $feature['feature'] ); ?></span>
												<i class="icon-min m-0 icon-<?php echo esc_html( $feature['icon'] ); ?> text-right"></i>
											</li>

											<?php 
											endforeach; 
										endif; ?>

										</ul>

										<?php if ( ! $item['disable_button'] ) : ?>

										<a href="<?php echo esc_url( $url ); ?>" <?php if ( $item['button_target'] == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?>class="full-link <?php if ( $item['button_target'] == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?>"></a>
										<a class="btn mx-auto primary-button">
											<i class="icon-arrow-right-circle"></i><?php echo esc_html( $item['button_label'] ); ?>
										</a>

										<?php endif; ?>

									</div>
								</div>

								<?php 
								endforeach; 
							endif; ?>

						</div>
					</div>
				</section>

			<?php
			$custom_count = 0;
			elseif ( get_row_layout() == 'custom_feature' ) :

				$custom_count++;

				if ( get_sub_field( 'enable_dark_mode' ) ) {
					$suggested_color = '#111111';
				} else {
					$suggested_color = '#F5F5F5';
				} 
				
				if ( get_sub_field( 'custom_id' ) ) {
					$custom_id = get_sub_field( 'custom_id' );
			
				} else {
					$custom_id = 'custom-' . $custom_count;
				}
			
				if ( get_sub_field( 'custom_class' ) ) {
					$custom_class = get_sub_field( 'custom_class' );
			
				} else {
					$custom_class = 'custom-' . $custom_count;
				}

				$custom_vs  = 'section-vs-' . get_sub_field( 'vertical_spacing');
				$custom_vsr = 'section-vsr-' . get_sub_field( 'vertical_spacing_responsive');

				?>

				<section id="<?php echo esc_attr( $custom_id ); ?>" class="<?php echo esc_attr( $custom_class ); ?> <?php echo esc_attr( $custom_vs.' '.$custom_vsr ); ?> <?php if ( get_sub_field( 'enable_dark_mode' ) ) { echo esc_attr( 'odd' ); } ?> <?php if ( get_sub_field( 'enable_separator_line' ) ) { echo esc_attr( 'featured' ); } ?> <?php if ( get_sub_field( 'enable_dotted_line' ) ) { the_sub_field( 'enable_dotted_line' ); } ?> custom" <?php if ( get_sub_field( 'background_color' ) ) { echo 'style="background-color:'.esc_attr( get_sub_field( 'background_color' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>
					<div class="container <?php the_sub_field( 'container' ); ?>">

						<?php
						// Intro
						get_template_part( 'template-parts/content', 'section-intro' );
						
						// Custom Content Grid
						if ( get_sub_field( 'content_layout' ) == 'grid' ) : 						
							while( have_rows( 'custom_content_grid' ) ) : the_row();

								// Row 1
								if ( get_row_layout() == 'row_1' ) : ?>

									<div class="row">
										<div class="col-12">
											<?php the_sub_field( 'column_1' ); ?>
										</div>
									</div>

								<?php
								// Row 2
								elseif ( get_row_layout() == 'row_2' ) : ?>

									<div class="row">
										<div class="col-12 col-md-6">
											<?php the_sub_field( 'column_1' ); ?>
										</div>
										<div class="col-12 col-md-6">
											<?php the_sub_field( 'column_2' ); ?>
										</div>
									</div>

								<?php
								// Row 3
								elseif ( get_row_layout() == 'row_3' ) : ?>

									<div class="row">
										<div class="col-12 col-md-6 col-lg-4">
											<?php the_sub_field( 'column_1' ); ?>
										</div>
										<div class="col-12 col-md-6 col-lg-4">
											<?php the_sub_field( 'column_2' ); ?>
										</div>
										<div class="col-12 col-md-6 col-lg-4">
											<?php the_sub_field( 'column_3' ); ?>
										</div>
									</div>

								<?php
								// Row 4
								elseif ( get_row_layout() == 'row_4' ) : ?>

									<div class="row">
										<div class="col-12 col-md-6 col-lg-3">
											<?php the_sub_field( 'column_1' ); ?>
										</div>
										<div class="col-12 col-md-6 col-lg-3">
											<?php the_sub_field( 'column_2' ); ?>
										</div>
										<div class="col-12 col-md-6 col-lg-3">
											<?php the_sub_field( 'column_3' ); ?>
										</div>
										<div class="col-12 col-md-6 col-lg-3">
											<?php the_sub_field( 'column_4' ); ?>
										</div>
									</div>
									
								<?php
								endif;
							endwhile;

						// Custom Content	
						else : ?>

						<div class="row">
							<div class="col-12">
								<?php the_sub_field( 'custom' ); ?>
							</div>
						</div>

						<?php endif; ?>
					</div>
				</section>

			<?php
			endif;
		endwhile; 
	endif;
endif; ?>		

<?php get_footer();
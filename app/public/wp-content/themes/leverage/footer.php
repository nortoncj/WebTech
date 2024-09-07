<?php
/**
 * @package Leverage
 */
?>

<?php
$button_mode         = 'filled';
$search_button_label = esc_html__( 'SEARCH', 'leverage' );
$footer_col          = 'col-lg-3';
$footer_default      = false;

if ( function_exists( 'ACF' ) ) {
	$button_mode         = get_field( 'button_mode', 'option' );
	$search_button_label = get_field( 'search_button_label', 'option' );
	$footer_columns      = get_field( 'footer_columns', 'option' );
	$footer_default      = get_field( 'footer_default', 'option' );

	switch ( $footer_columns ) {
		case '1': $footer_col = 'col-lg-12'; break;
		case '2': $footer_col = 'col-lg-6'; break;
		case '3': $footer_col = 'col-lg-4'; break;
		case '4': $footer_col = 'col-lg-3'; break;
		case '5': $footer_col = 'col-lg-2-4'; break;
		case '6': $footer_col = 'col-lg-2'; break;
	}

	if ( get_field( 'override_general_settings' ) ) {
		
		// News
		$enable_news_front_page = get_field( 'enable_news' );
		$enable_news_pages      = get_field( 'enable_news' );
		$enable_news_posts      = get_field( 'enable_news' );
		
		// Subscribe
		$enable_subscribe_front_page = get_field( 'enable_subscribe' );
		$enable_subscribe_pages      = get_field( 'enable_subscribe' );
		$enable_subscribe_posts      = get_field( 'enable_subscribe' );
		
		// Form
		$enable_form_front_page = get_field( 'enable_form' );
		$enable_form_pages      = get_field( 'enable_form' );
		$enable_form_posts      = get_field( 'enable_form' );
		
		// Custom
		$enable_custom_front_page = get_field( 'enable_custom' );
		$enable_custom_pages      = get_field( 'enable_custom' );
		$enable_custom_posts      = get_field( 'enable_custom' );

	} else {
		
		// News
		$enable_news_front_page = get_field( 'enable_news_on_front_page', 'option' );
		$enable_news_pages      = get_field( 'enable_news_on_pages', 'option' );
		$enable_news_posts      = get_field( 'enable_news_on_posts', 'option' );
		
		// Subscribe
		$enable_subscribe_front_page = get_field( 'enable_subscribe_on_front_page', 'option' );
		$enable_subscribe_pages      = get_field( 'enable_subscribe_on_pages', 'option' );
		$enable_subscribe_posts      = get_field( 'enable_subscribe_on_posts', 'option' );
		
		// Form
		$enable_form_front_page = get_field( 'enable_form_on_front_page', 'option' );
		$enable_form_pages      = get_field( 'enable_form_on_pages', 'option' );
		$enable_form_posts      = get_field( 'enable_form_on_posts', 'option' );
		
		// Custom
		$enable_custom_front_page = get_field( 'enable_custom_on_front_page', 'option' );
		$enable_custom_pages      = get_field( 'enable_custom_on_pages', 'option' );
		$enable_custom_posts      = get_field( 'enable_custom_on_posts', 'option' );
	}

	// Enable News
	if ( $enable_news_front_page && is_front_page() ) {
		get_template_part( 'template-parts/content', 'news' );

	} elseif ( $enable_news_pages && is_page() ) {
		get_template_part( 'template-parts/content', 'news' );

	} elseif ( $enable_news_posts && is_single() || is_archive() ) {
		get_template_part( 'template-parts/content', 'news' );

	} elseif ( get_field( 'enable_news_on_posts', 'option' ) && ! is_page() ) {
		get_template_part( 'template-parts/content', 'news' );
	} 


	// Enable Subscribe
	if ( $enable_subscribe_front_page && is_front_page() ) {
		get_template_part( 'template-parts/content', 'subscribe' );

	} elseif ( $enable_subscribe_pages && is_page() ) {
		get_template_part( 'template-parts/content', 'subscribe' );

	} elseif ( $enable_subscribe_posts && is_single() || is_archive() ) {
		get_template_part( 'template-parts/content', 'subscribe' );

	} elseif ( get_field( 'enable_subscribe_on_posts', 'option' ) && ! is_page() ) {
		get_template_part( 'template-parts/content', 'subscribe' );
	} 

	// Enable Form
	if ( $enable_form_front_page && is_front_page() ) {
		get_template_part( 'template-parts/content', 'form' );

	} elseif ( $enable_form_pages && is_page() ) {
		get_template_part( 'template-parts/content', 'form' );

	} elseif ( $enable_form_posts && is_single() || is_archive() ) {
		get_template_part( 'template-parts/content', 'form' );

	} elseif ( get_field( 'enable_form_on_posts', 'option' ) && ! is_page() ) {
		get_template_part( 'template-parts/content', 'form' );
	} 

	// Enable Custom
	if ( $enable_custom_front_page && is_front_page() ) {
		get_template_part( 'template-parts/content', 'custom' );

	} elseif ( $enable_custom_pages && is_page() ) {
		get_template_part( 'template-parts/content', 'custom' );

	} elseif ( $enable_custom_posts && is_single() || is_archive() ) {
		get_template_part( 'template-parts/content', 'custom' );

	} elseif ( get_field( 'enable_custom_on_posts', 'option' ) && ! is_page() ) {
		get_template_part( 'template-parts/content', 'custom' );
	} 

	// Enable Dark Mode
	if ( get_field( 'footer_enable_dark_mode', 'option' ) ) {
		$suggested_color = '#111111';
	} else {
		$suggested_color = '#111111';
	}

	$footer_vs  = 'section-vs-' . get_field( 'footer_vertical_spacing', 'option' );
	$footer_vsr = 'section-vsr-' . get_field( 'footer_vertical_spacing_responsive', 'option' );
}

if ( function_exists( 'ACF' ) && function_exists( 'leverage_theme_settings' ) ) : ?>

<footer class="<?php if ( get_field( 'footer_enable_dark_mode', 'option' ) ) { echo esc_attr( 'odd' ); } ?>" <?php if ( get_field( 'footer_background_color', 'option' ) ) { echo 'style="background-color:'.esc_attr( get_field( 'footer_background_color', 'option' ) ).'"'; } else { echo 'style="background-color:'.esc_attr( $suggested_color ).'"'; } ?>>

	<?php 
	if ( isset( $footer_default[ 'enable_footer' ] ) ) {
		$enable_footer = $footer_default[ 'enable_footer' ];
	} else {
		$enable_footer = false;
	}

	if ( isset( $enable_footer ) && $enable_footer ) : ?>

	<section id="footer" class="footer <?php echo esc_attr( $footer_vs.' '.$footer_vsr ); ?>">
		<div class="container <?php the_field( 'footer_container', 'option' ); ?>">

			<div class="row footer-widget">

				<?php 
				$enable_footer_branding = $footer_default[ 'enable_footer_branding' ];

				if ( isset( $enable_footer_branding ) && $enable_footer_branding ) : ?>

				<div class="branding col-12 <?php echo esc_attr( $footer_col ); ?> pt-4 pr-3 pb-4 pl-3 text-center text-lg-left">
					<div class="brand">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">

							<?php 
							if ( get_field( 'brand_type', 'option' ) == 'Text' ) {
								echo strip_tags( get_field( 'text', 'option' ) );

							} else {
								$image = get_field( 'logo', 'option' );
								$invert = get_field( 'footer_logo_filter', 'option' );

								if ( $invert ) {
									$invert = 'invert';
								} else {
									$invert = '';
								}

								echo '<img src="' . esc_url( $image['url'] ) . '" alt="'.esc_attr( $image['alt'] ).'" class="'.esc_attr( $invert ).'"/>';

							} ?>
						</a>
					</div>
					
					<?php the_field( 'description', 'option' );

					$enable_footer_social_networks = $footer_default[ 'enable_footer_social_networks' ];
					
					if ( isset( $enable_footer_social_networks ) && $enable_footer_social_networks ) :
						if ( have_rows( 'footer_social_networks', 'option' ) ) : ?>

							<ul class="navbar-nav social share-list mt-0 ml-auto">

							<?php
							while( have_rows( 'footer_social_networks', 'option' ) ) :
								the_row();

								// Facebook
								if ( get_row_layout() == 'facebook' ) : ?>

								<li class="nav-item social">
									<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
										<i class="icon-social-facebook"></i>
									</a>
								</li>

								<?php 
								// Instagram
								elseif ( get_row_layout() == 'instagram' ) : ?>

								<li class="nav-item social">
									<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
										<i class="icon-social-instagram"></i>
									</a>
								</li>

								<?php 
								// Twitter
								elseif ( get_row_layout() == 'twitter' ) : ?>

								<li class="nav-item social">
									<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
										<i class="icon-social-twitter"></i>
									</a>
								</li>

								<?php 
								// Youtube
								elseif ( get_row_layout() == 'youtube' ) : ?>

								<li class="nav-item social">
									<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
										<i class="icon-social-youtube"></i>
									</a>
								</li>

								<?php 
								// Linkedin
								elseif ( get_row_layout() == 'linkedin' ) : ?>

								<li class="nav-item social">
									<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
										<i class="icon-social-linkedin"></i>
									</a>
								</li>

								<?php 
								// Pinterest
								elseif ( get_row_layout() == 'pinterest' ) : ?>

								<li class="nav-item social">
									<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
										<i class="icon-social-pinterest"></i>
									</a>
								</li>

								<?php 
								// Tumblr
								elseif ( get_row_layout() == 'tumblr' ) : ?>

								<li class="nav-item social">
									<a href="<?php the_field( 'url' ); ?>" target="_blank" class="nav-link">
										<i class="icon-social-tumblr"></i>
									</a>
								</li>

								<?php 
								// Dribbble
								elseif ( get_row_layout() == 'dribbble' ) : ?>

								<li class="nav-item social">
									<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">
										<i class="icon-social-dribbble"></i>
									</a>
								</li>

								<?php 
								// Custom
								elseif ( get_row_layout() == 'custom' ) : ?>

								<li class="nav-item">
									<a href="<?php the_sub_field( 'url' ); ?>" target="_blank" class="nav-link">

										<?php if ( get_sub_field( 'icon_style' ) == 'Line Icon' && get_sub_field( 'icon' ) ) : ?>
											<i class="icon-<?php the_sub_field( 'icon' ); ?>"></i>

										<?php elseif ( get_sub_field( 'icon_style' ) == 'Awesome Icon' && get_sub_field( 'icon' ) ) : ?>
											<i class="<?php echo esc_attr( get_sub_field( 'icon_fa' ) ); ?>"></i>

										<?php endif; ?>
									</a>
								</li>

								<?php 
								endif;
							endwhile; ?>

							</ul>

						<?php 
						endif;
					endif; ?>
				</div>

				<?php endif; ?>
						
				<?php
				if ( have_rows( 'columns', 'option' ) ) :
					while( have_rows( 'columns', 'option' ) ) : the_row(); ?>

						<?php
						if ( get_row_layout() == 'items' ) : ?>

							<div class="col-12 <?php echo esc_attr( $footer_col ); ?> pt-4 pr-3 pb-4 pl-3 text-center text-lg-left">

								<h4 class="title"><?php the_sub_field( 'title', 'option' ); ?></h4>

								<ul class="navbar-nav">

									<?php	
									$links = get_sub_field( 'links', 'option' );

									if ( $links ) :
										foreach( $links as $link ) :

											$target = $link['target'];
										
											switch ( $target ) {
												case 'Anchor Link':
													$url = $link['url'];
												break;

												case 'External Link':
													$url = $link['url'];
												break;

												case 'Inner Page':
													$url = $link['page'];
												break;

												case 'Inner Post';
													$url = $link['post'];
												break;
											}	
										?>

										<li class="nav-item">
											<a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="nav-link <?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?>">

												<?php if ( $link['icon_style'] == 'Line Icon' && $link['icon'] ) : ?>
													<i class="icon-<?php echo esc_attr( $link['icon'] ); ?> mr-2"></i>
												<?php elseif ( $link['icon_style'] == 'Awesome Icon' && $link['icon_fa'] ) : ?>
													<i class="<?php echo esc_attr( $link['icon_fa'] ); ?> mr-2"></i>
												<?php endif; ?>
												
												<?php echo esc_html( $link['label'] ); ?>
											</a>
										</li>

										<?php
										endforeach;
									endif;
									
									if ( get_sub_field( 'enable_button', 'option' ) ) :

										$target = get_sub_field( 'button_target', 'option' );
									
										switch ( $target ) {
											case 'Anchor Link':
												$url = get_sub_field( 'button_url', 'option' );
											break;
					
											case 'External Link':
												$url = get_sub_field( 'button_url', 'option' );
											break;
					
											case 'Inner Page':
												$url = get_sub_field( 'button_page', 'option' );
											break;
					
											case 'Inner Post';
												$url = get_sub_field( 'button_post', 'option' );
											break;
										}
									?>
									
									<li class="nav-item">
										<a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="<?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?> mt-4 btn mr-auto ml-auto ml-lg-0 <?php if ( $button_mode === 'outlined' ) { echo 'dark-button'; } else { echo 'primary-button'; } ?>" <?php if ( $button_mode === 'outlined' ) { echo 'style="background-color: '.esc_attr( get_field( 'footer_background_color', 'option' ) ).'"'; } ?>>
											
											<?php if ( get_sub_field( 'button_icon_style', 'option' ) == 'Line Icon' && get_sub_field( 'button_icon', 'option' ) ) : ?>
												<i class="icon-<?php the_sub_field( 'button_icon', 'option' ); ?>"></i>

											<?php elseif ( get_sub_field( 'button_icon_style', 'option' ) == 'Awesome Icon' && get_sub_field( 'button_icon_fa', 'option' ) ) : ?>
												<i class="<?php the_sub_field( 'button_icon_fa', 'option' ); ?>"></i>

											<?php endif; ?>

											<?php the_sub_field( 'button_label', 'option' ); ?>
										</a>
									</li>				

									<?php endif; ?>

								</ul>
							</div>

						<?php
						elseif ( get_row_layout() == 'pinned_tags' ) : ?>

							<div class="col-12 <?php echo esc_attr( $footer_col ); ?> pt-4 pr-3 pb-4 pl-3 text-center text-lg-left">

								<h4 class="title"><?php the_sub_field( 'title', 'option' ); ?></h4>

									<?php	
									$tags = get_sub_field( 'tags', 'option' );

									if ( $tags ) :
										foreach( $tags as $tag ) :

											$target = $tag['target'];
										
											switch ( $target ) {
												case 'Anchor Link':
													$url = $tag['url'];
												break;

												case 'External Link':
													$url = $tag['url'];
												break;

												case 'Inner Page':
													$url = $tag['page'];
												break;

												case 'Inner Post';
													$url = $tag['post'];
												break;
											}	
										?>

										<a href="<?php echo esc_url( $url ); ?>" <?php if ( $target == 'External Link' ) { echo esc_attr( 'target="_blank"' ); } ?> class="badge tag <?php if ( $target == 'Anchor Link' ) { echo esc_attr( 'smooth-anchor' ); } ?>">
											<?php echo esc_html( $tag['label'] ); ?>
										</a>

										<?php
										endforeach;
									endif; ?>

							</div>

						<?php
						elseif ( get_row_layout() == 'custom' ) : ?>

							<div class="col-12 <?php echo esc_attr( $footer_col ); ?> pt-4 pr-3 pb-4 pl-3 text-center text-lg-left">
								<h4 class="title"><?php the_sub_field( 'title', 'option' ); ?></h4>
								<?php the_sub_field( 'custom', 'option' ); ?>				
							</div>

						<?php 
						endif; ?>
						
					<?php
					endwhile;
				endif; 

				footer_widget( $footer_col );
				if ( is_active_sidebar( 'footer-widget' ) ) {
					dynamic_sidebar( 'footer-widget' );
				} ?>
			</div>
		</div>
	</section>

	<?php endif;

	if ( isset( $footer_default[ 'enable_copyright' ] ) ) {
		$enable_copyright = $footer_default[ 'enable_copyright' ];
	} else {
		$enable_copyright = false;
	}
	
	if ( isset( $footer_default[ 'enable_copyright' ] ) && $enable_copyright ) : ?>

	<section id="copyright" class="p-3 copyright">
		<div class="container <?php the_field( 'footer_container', 'option' ); ?>">
			<div class="row">
				<div class="col-12 col-md-6 p-3 text-center text-lg-left">
					<?php the_field( 'copyright_left_text', 'option' ); ?>
				</div>
				<div class="col-12 col-md-6 p-3 text-center text-lg-right">
					<?php the_field( 'copyright_right_text', 'option' ); ?>
				</div>
			</div>
		</div>
	</section>

	<?php elseif( ! isset( $footer_default[ 'enable_copyright' ] ) ) : ?>

	<section id="copyright" class="p-3 copyright default odd">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<p><?php echo esc_html( get_bloginfo( 'name' ) ).' - '.esc_html( get_bloginfo( 'description', 'display' ) ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<?php endif; ?>

</footer>

<?php else : ?>

<footer class="odd">
	<section id="copyright" class="p-3 copyright default odd">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<p><?php echo esc_html( get_bloginfo( 'name' ) ).' - '.esc_html( get_bloginfo( 'description', 'display' ) ); ?></p>
				</div>
			</div>
		</div>
	</section>
</footer>

<?php endif; ?>

<?php 
if ( class_exists( 'WooCommerce' ) ) : if ( ! is_cart() && ! is_checkout() ) : ?>

<div id="cart" class="p-0 modal fade" role="dialog" aria-labelledby="cart" aria-hidden="true" style="<?php if ( is_admin_bar_showing() ) { echo esc_attr( 'margin-top: 32px' ); } ?>">
	<div class="modal-dialog modal-dialog-slideout" role="document">
		<div class="modal-content full">
			<div class="modal-header" data-dismiss="modal">
				<?php esc_html_e( 'Cart Review', 'leverage' ); ?> <i class="icon-close"></i>
			</div>
			<div class="modal-body">
				
				<?php
					$instance = array(
						'title' => '',
					);
					the_widget( 'WC_Widget_Cart', $instance );
				?>

			</div>
		</div>
	</div>
</div>

<?php endif; endif; ?>

<div id="search" class="p-0 modal fade" role="dialog" aria-labelledby="search" aria-hidden="true" style="<?php if ( is_admin_bar_showing() ) { echo esc_attr( 'margin-top: 32px' ); } ?>">
	<div class="modal-dialog modal-dialog-slideout" role="document">
		<div class="modal-content full">
			<div class="modal-header" data-dismiss="modal">
				<?php esc_html_e( 'Search', 'leverage' ); ?> <i class="icon-close"></i>
			</div>
			<div class="modal-body">
				<form role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="GET" class="row">
					<div class="col-12 p-0 align-self-center">
						<div class="row">
							<div class="col-12 p-0 pb-3">

								<?php if ( function_exists( 'ACF' ) ) : ?>

								<h2><?php 
									if(get_field( 'search_title', 'option' )) { 
										the_field( 'search_title', 'option' ); 
									} else { 
										echo esc_html__( 'Search', 'leverage' );
									} 
									?>
								</h2>

								<p><?php the_field( 'search_description', 'option' ); ?></p>

								<?php else : ?>

								<h2><?php echo esc_html__( 'Search', 'leverage' ); ?></h2>

								<?php endif; ?>

							</div>
						</div>
						<div class="row">
							<div class="col-12 p-0 input-group">
								<input type="text" name="s" class="form-control" placeholder="<?php esc_attr_e( 'Enter Keywords', 'leverage' ); ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-12 p-0 input-group align-self-center">
								<button class="btn primary-button"><i class="icon-magnifier"></i><?php if ( $search_button_label ) { echo esc_html( $search_button_label ); } else { esc_html_e( 'SEARCH', 'leverage' ); } ?></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="menu" class="p-0 modal fade" role="dialog" aria-labelledby="menu" aria-hidden="true">
	<div class="modal-dialog modal-dialog-slideout" role="document">
		<div class="modal-content full">
			<div class="modal-header" data-dismiss="modal">
				<?php esc_html_e( 'Menu', 'leverage' ); ?> <i class="icon-close"></i>
			</div>
			<div class="menu modal-body">
				<div class="row w-100">
					<div class="items p-0 col-12 text-center">
						<!-- Append [navbar] -->
					</div>
					<div class="contacts p-0 col-12 text-center">
						<!-- Append [navbar] -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="scroll-to-top" class="scroll-to-top">
	<a href="#header" class="smooth-anchor">
		<i class="icon-arrow-up"></i>
	</a>
</div>

<?php wp_footer(); ?>
</body>
</html>
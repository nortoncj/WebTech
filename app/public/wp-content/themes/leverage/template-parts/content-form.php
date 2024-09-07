<?php
/**
 * @package Leverage
 */

$form_enable_dark_mode      = false;
$form_enable_separator_line = false;
$form_background_color      = false;

if (get_field( 'form_enable_dark_mode', 'option' ) ) {
	$suggested_color = '#111111';
} else {
	$suggested_color = '#F5F5F5';
}

if ( get_field( 'override_general_settings' ) ) {

    if ( get_field( 'form_background_color' ) ) {
		$form_background_color = get_field( 'form_background_color' );
		
    } else {

        if ( get_field( 'form_background_color', 'option' ) ) {
            $form_background_color = get_field( 'form_background_color', 'option' );
        } else {
            $form_background_color = $suggested_color;
        }
    }

    $form_enable_dark_mode      = get_field( 'form_enable_dark_mode' );
    $form_enable_separator_line = get_field( 'form_enable_separator_line' );

} else {
	
    if ( get_field( 'form_background_color', 'option' ) ) {
        $form_background_color = get_field( 'form_background_color', 'option' );
    } else {
        $form_background_color = $suggested_color;
    }

    $form_enable_dark_mode      = get_field( 'form_enable_dark_mode', 'option' );
    $form_enable_separator_line = get_field( 'form_enable_separator_line', 'option' );
} 

$recaptcha = get_field( 'recaptcha', 'option' );

if ( get_field( 'form_custom_id', 'option' ) ) {
	$form_id = get_field( 'form_custom_id', 'option' );

} else {
	$form_id = 'contact';
}

if ( get_field( 'form_custom_class', 'option' ) ) {
	$form_class = get_field( 'form_custom_class', 'option' );

} else {
	$form_class = 'contact';
}

$form_vs  = 'section-vs-' . get_field( 'form_vertical_spacing', 'option' );
$form_vsr = 'section-vsr-' . get_field( 'form_vertical_spacing_responsive', 'option' );
?>

<?php
$form_mode = get_field('form_mode', 'option');
if ( $form_mode && $form_mode == 'simple-form' && have_rows( 'simple_form_fields', 'option' ) ) : ?>

<section id="<?php echo esc_attr( $form_id ); ?>" class="<?php echo esc_attr( $form_class ); ?> <?php echo esc_attr( $form_vs.' '.$form_vsr ); ?> <?php if ( $form_enable_dark_mode ) { echo esc_attr( 'odd' ); } ?> <?php if ( $form_enable_separator_line ) { echo esc_attr( 'featured' ); } ?> form" <?php echo 'style="background-color:'.esc_attr( $form_background_color ).'"'; ?>>
    <div class="container <?php the_field( 'form_container', 'option' ); ?>">

		<?php if ( get_field( 'simple_form_title', 'option' ) || get_field( 'simple_form_description', 'option' ) ) : ?>

		<div class="row intro">
            <div class="col-12 <?php the_field( 'simple_form_text_align', 'option' ); ?> text-center">

				<?php if ( get_field( 'simple_form_title', 'option' ) ) : ?>
				<h2 class="<?php if ( ! get_field( 'simple_form_description', 'option' ) ) { echo 'mb-0 '; } the_field( 'simple_form_heading_style', 'option' ); ?>"><?php the_field( 'simple_form_title', 'option' ); ?></h2>
				<?php endif; ?>

				<?php if ( get_field( 'simple_form_description', 'option' ) ) { the_field( 'simple_form_description', 'option' ); } ?>
            </div>            
        </div>

		<?php endif; ?>

		<form action="<?php echo admin_url( 'admin-ajax.php' ) ; ?>" id="leverage-simple-form" class="leverage-simple-form">

			<?php wp_nonce_field( 'leverage_form', 'leverage_form_wpnonce' ); ?>
			<input type="hidden" name="action" value="leverage_contact_form">
			<input type="hidden" name="section" value="leverage_form">

			<?php if ( isset( $recaptcha['enable_recaptcha'] ) && $recaptcha['enable_recaptcha'] ) : ?>
			<input type="hidden" name="reCAPTCHA">
			<?php endif; ?>
			
			<div class="row form-group-margin">
				<?php
				if ( have_rows( 'simple_form_fields', 'option' ) ) :
					while( have_rows( 'simple_form_fields', 'option' ) ) : the_row();

						if ( get_row_layout() == 'text_field' ) : 												
						$field = sanitize_title( get_sub_field( 'field' ) ); ?>

							<div class="col-12 col-md-6 input-group m-0 p-2">
								<input type="text" name="<?php echo esc_attr( $field ); ?>" class="form-control field-<?php echo esc_attr( $field ); ?>" placeholder="<?php the_sub_field( 'field' ); ?>">
							</div>

						<?php
						elseif ( get_row_layout() == 'text_area_field' ) : 										
						$field = sanitize_title( get_sub_field( 'field' ) ); ?>

							<div class="col-12 input-group m-0 p-2">
								<textarea name="<?php echo esc_attr( $field ); ?>" class="form-control field-<?php echo esc_attr( $field ); ?>" placeholder="<?php the_sub_field( 'field' ); ?>"></textarea>
							</div>

						<?php
						elseif ( get_row_layout() == 'email_field' ) : 											
						$field = sanitize_title( get_sub_field( 'field' ) ); ?>

							<div class="col-12 col-md-6 input-group m-0 p-2">
								<input type="email" name="email" class="form-control field-email" placeholder="<?php the_sub_field( 'field' ); ?>">
							</div>

						<?php
						elseif ( get_row_layout() == 'number_field' ) : 										
						$field = sanitize_title( get_sub_field( 'field' ) ); ?>

							<div class="col-12 col-md-6 input-group m-0 p-2">
								<input type="number" name="<?php echo esc_attr( $field ); ?>" class="form-control field-<?php echo esc_attr( $field ); ?>" placeholder="<?php the_sub_field( 'field' ); ?>">
							</div>

						<?php
						elseif ( get_row_layout() == 'select_field' ) : 										
						$field = sanitize_title( get_sub_field( 'info_option' ) ); ?>

							<div class="col-12 col-md-6 input-group m-0 p-2">
								<i class="icon-arrow-down"></i>
								<select name="<?php echo esc_attr( $field ); ?>" data-minlength="1" class="form-control field-<?php echo esc_attr( $field ); ?>">
								
									<option value="" selected disabled><?php the_sub_field( 'info_option' ); ?></option>

									<?php
									$options = preg_split( '/\r\n|\r|\n/', get_sub_field( 'field' ) );

									foreach( $options as $option ) : ?>
										<option><?php echo esc_html( $option ); ?></option>
									<?php
									endforeach;
									?>

								</select>
							</div>

						<?php
						endif;
					endwhile;
				endif;
				?>

				<div class="col-12 col-12 m-0 pl-md-2">
					<span class="form-alert"></span>
				</div>
				<div class="col-12 input-group m-0 p-2">
					<a class="btn primary-button">
						<i class="icon-arrow-right-circle"></i>
						<?php if ( get_field( 'simple_form_button_label', 'option' ) ) { the_field( 'simple_form_button_label', 'option' ); } else { echo esc_html( 'SEND', 'leverage' ); } ?>
					</a>
				</div>
			</div>
		</form>
	</div>
</section>

<?php 
elseif( $form_mode && $form_mode == 'multi-step-form' && have_rows( 'steps', 'option' ) || ! $form_mode && have_rows( 'steps', 'option' ) ) : 

	$enable_form_redirect = get_field( 'enable_form_redirect', 'option' );

	$form_redirect_target = get_field( 'form_redirect_target', 'option' );
				
	switch ( $form_redirect_target ) {
		case 'URL':
			$form_redirect = get_field( 'form_redirect_url', 'option' );
		break;

		case 'Inner Page':
			$form_redirect = get_field( 'form_redirect_page', 'option' );
		break;

		case 'Inner Post';
			$form_redirect = get_field( 'form_redirect_post', 'option' );
		break;
	}
?>

<section id="<?php echo esc_attr( $form_id ); ?>" class="<?php echo esc_attr( $form_class ); ?> <?php echo esc_attr( $form_vs.' '.$form_vsr ); ?> <?php if ( $form_enable_dark_mode ) { echo esc_attr( 'odd' ); } ?> <?php if ( $form_enable_separator_line ) { echo esc_attr( 'featured' ); } ?> form" <?php echo 'style="background-color:'.esc_attr( $form_background_color ).'"'; ?>>
    <div class="container <?php the_field( 'form_container', 'option' ); ?>">
		<form action="<?php echo admin_url( 'admin-ajax.php' ) ; ?>" id="leverage-form" class="multi-step-form <?php if ( $enable_form_redirect ) { echo esc_attr( 'redirect-sending' ); } ?>" <?php if ( $enable_form_redirect ) { echo 'data-redirect="'.esc_attr( $form_redirect ).'"'; } ?>>

			<?php wp_nonce_field( 'leverage_form', 'leverage_form_wpnonce' ); ?>
			<input type="hidden" name="action" value="leverage_contact_form">
			<input type="hidden" name="section" value="leverage_form">

			<?php if ( isset( $recaptcha['enable_recaptcha'] ) && $recaptcha['enable_recaptcha'] ) : ?>
			<input type="hidden" name="reCAPTCHA">
			<?php endif; ?>

			<div class="row">
				<div class="col-12 col-md-6 align-self-start text-center text-md-left">

					<div class="row success message">
						<div class="col-12 p-0">
							<div class="wait">
								<div class="spinner-grow" role="status">
									<span class="sr-only"><?php esc_html_e( 'Loading', 'leverage' ); ?></span>
								</div>
								<h4 class="sending"><?php if ( get_field( 'form_loading_text', 'option' ) ) { the_field( 'form_loading_text', 'option' ); } else { esc_html_e( 'SENDING', 'leverage' ); } ?></h4>
							</div>
							<div class="done">
								<i class="icon bigger icon-check"></i>
								<h4><?php the_field( 'success_message', 'option' ); ?></h4>						
								<a href="" class="btn mx-auto primary-button">
									<i class="icon-refresh"></i>
									<?php esc_html_e( 'REFRESH', 'leverage' ); ?>
								</a>
							</div>
						</div>
					</div>

					<div class="row intro form-content">
						<div class="col-12 p-0">

							<?php
							if ( have_rows( 'steps', 'option' ) ) :
								while( have_rows( 'steps', 'option' ) ) : the_row(); ?>

								<div class="step-title">
									<h2 class="<?php if ( ! get_sub_field( 'step_description' ) ) { echo 'mb-0 '; } the_sub_field( 'heading_style' ); ?>"><?php the_sub_field( 'step_title' ); ?></h2>
									<?php the_sub_field( 'step_description' ); ?>
								</div>

								<?php 
								endwhile;
							endif;
							?>

						</div>
					</div>

					<div class="row text-center form-content">
						<div class="col-12 p-0">

								<ul class="progressbar">

									<?php
									if ( have_rows( 'steps', 'option' ) ) :
										while( have_rows( 'steps', 'option' ) ) : the_row(); ?>

										<li><?php the_sub_field( 'step_progressbar_title' ); ?></li>

										<?php 
										endwhile;
									endif;
									?>
									
								</ul>							

								<?php
								if ( have_rows( 'steps', 'option' ) ) : $step = 1;
									while( have_rows( 'steps', 'option' ) ) : the_row(); $step++; ?>

									<fieldset class="step-group">

										<?php
										if ( have_rows( 'step_fields' ) ) :
											while( have_rows( 'step_fields' ) ) : the_row();

												if ( get_row_layout() == 'text_field' ) : 												
												$field = sanitize_title( get_sub_field( 'field' ) ); ?>

												<div class="row">
													<div class="col-12 input-group p-0">
														<input type="text" name="<?php echo esc_attr( $field ); ?>" data-minlength="3" class="form-control field-<?php echo esc_attr( $field ); ?>" placeholder="<?php the_sub_field( 'field' ); ?>">
													</div>
												</div>

												<?php
												elseif ( get_row_layout() == 'text_area_field' ) : 										
												$field = sanitize_title( get_sub_field( 'field' ) ); ?>

												<div class="row">
													<div class="col-12 input-group p-0">
														<textarea name="<?php echo esc_attr( $field ); ?>" data-minlength="3" class="form-control field-<?php echo esc_attr( $field ); ?>" placeholder="<?php the_sub_field( 'field' ); ?>"></textarea>
													</div>
												</div>

												<?php
												elseif ( get_row_layout() == 'email_field' ) : 											
												$field = sanitize_title( get_sub_field( 'field' ) ); ?>

												<div class="row">
													<div class="col-12 input-group p-0">
														<input type="email" name="email" data-minlength="3" class="form-control field-email" placeholder="<?php the_sub_field( 'field' ); ?>">
													</div>
												</div>

												<?php
												elseif ( get_row_layout() == 'number_field' ) : 										
												$field = sanitize_title( get_sub_field( 'field' ) ); ?>

												<div class="row">
													<div class="col-12 input-group p-0">
														<input type="number" name="<?php echo esc_attr( $field ); ?>" data-minlength="3" class="form-control field-<?php echo esc_attr( $field ); ?>" placeholder="<?php the_sub_field( 'field' ); ?>">
													</div>
												</div>

												<?php
												elseif ( get_row_layout() == 'select_field' ) : 										
												$field = sanitize_title( get_sub_field( 'info_option' ) ); ?>

												<div class="row">
													<div class="col-12 input-group p-0">
														<i class="icon-arrow-down"></i>
														<select name="<?php echo esc_attr( $field ); ?>" data-minlength="1" class="form-control field-<?php echo esc_attr( $field ); ?>">
														
															<option value="" selected disabled><?php the_sub_field( 'info_option' ); ?></option>

															<?php
															$options = preg_split( '/\r\n|\r|\n/', get_sub_field( 'field' ) );

															foreach( $options as $option ) : ?>
																<option><?php echo esc_html( $option ); ?></option>
															<?php
															endforeach;
															?>

														</select>
													</div>
												</div>

												<?php
												elseif ( get_row_layout() == 'checkbox_field' ) : 										
												$field = sanitize_title( get_sub_field( 'field' ) ); ?>

												<div class="row">
													<div class="col-12 input-group p-0">
														<div class="checkbox-row">
																<input type="checkbox" name="<?php echo esc_attr( $field ); ?>" class="form-control field-<?php echo esc_attr( $field ); ?>">
																<p><?php the_sub_field( 'text' ); ?></p>
														</div>
													</div>
												</div>

												<?php
												endif;
											endwhile;
										endif;
										?>

										<div class="col-12 input-group p-0 d-flex justify-content-center justify-content-md-start">

											<?php if ( $step > 2 ) : ?>
											<a class="step-prev btn primary-button mr-4">
												<i class="icon-arrow-left-circle"></i>
												<?php if ( get_sub_field( 'button_label_prev_step', 'option' ) ) { the_sub_field( 'button_label_prev_step', 'option' ); } else { echo esc_html( 'PREV', 'leverage' ); } ?>
											</a>
											<?php endif; ?>

											<a class="step-next btn primary-button">
												<?php if ( get_sub_field( 'button_label_next_step', 'option' ) ) { the_sub_field( 'button_label_next_step', 'option' ); } else { echo esc_html( 'NEXT', 'leverage' ); } ?>
												<i class="icon-arrow-right-circle left"></i>
											</a>
										</div>

									</fieldset>

									<?php 
									endwhile;
								endif;
								?>

						</div>
					</div>
				</div>

				<div class="content-images col-12 col-md-6 pl-md-5 d-none d-md-block">

					<?php
					if ( have_rows( 'steps', 'option' ) ) :
						while( have_rows( 'steps', 'option' ) ) : the_row(); ?>
								
							<div class="gallery">

							<?php
							$image = get_sub_field( 'step_image' );
							if ( $image ) : ?>

								<a href="<?php if ( get_sub_field( 'enable_video' ) ) { echo esc_url( get_sub_field( 'video_url' ) ); } else { echo esc_url( $image['url'] ); } ?>" class="step-image">

									<?php if ( get_sub_field( 'enable_video' ) ) : ?>

									<i class="play-video icon-control-play"></i>
									<div class="mask-radius"></div>

									<?php endif; ?>

									<?php 
									if ( isset( $image['sizes']['leverage-about-image'] ) ) {
										echo leverage_lazy_load_image( $image['sizes']['leverage-about-image'], $image['alt'], 'fit-image' ); 
									}
									
									?>
								</a>

							<?php else : ?>

								<a href="<?php echo get_template_directory_uri().'/assets/images/leverage.jpg'; ?>" class="step-image">
									<img src="<?php echo get_template_directory_uri().'/assets/images/leverage.jpg'; ?>" alt="Leverage" class="fit-image"/>
								</a>

							<?php 
							endif; ?>

							</div>

							<?php
						endwhile;
					endif;
					?>

					<div class="gallery">

						<?php
						$image = get_field( 'success_image', 'option' );
						if ( $image ) : ?>

							<a href="<?php echo esc_url( $image['sizes']['leverage-about-image'] ); ?>" class="step-image">
								<?php echo leverage_lazy_load_image( $image['sizes']['leverage-about-image'], $image['alt'], 'fit-image' ); ?>
							</a>

						<?php else : ?>

							<a href="<?php echo get_template_directory_uri().'/assets/images/leverage.jpg'; ?>" class="step-image">
								<img src="<?php echo get_template_directory_uri().'/assets/images/leverage.jpg'; ?>" alt="Leverage" class="fit-image"/>
							</a>
						
						<?php endif; ?>

					</div>
				</div>
			</div>
		</form>
	</div>
</section>

<?php endif;
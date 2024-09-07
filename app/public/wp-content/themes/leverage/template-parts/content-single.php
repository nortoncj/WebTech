<?php
/**
 * @package Leverage
 */

$single_post = false;

if ( function_exists( 'ACF' ) ) {
	$single_post = get_field( 'single_post', 'option' );
} 

if ( ! $single_post ) {
    $single_post = array(
        'disable_posted_date'  => false,
        'disable_tags'         => false,
        'disable_social_share' => false
    );
}
?>

<div class="row">
	<div class="col-12 p-0 align-self-center content-inner">

		<?php
		if ( have_posts() ) :
			while( have_posts() ) :
				the_post(); the_content();	
				
				wp_link_pages( array(
					'before' => '<div class="clearfix"></div><div class="ml-0 page-links">',
					'after'  => '</div>',
				) );

			endwhile; 
		endif; 
		?>

		<?php if( is_single() ) : ?>

			<div class="clearfix"></div>

			<?php 
			$post_holder = true;

			if ( $single_post['disable_posted_date'] && $single_post['disable_tags'] ) {
				$post_holder = false;
			} elseif ( $single_post['disable_posted_date'] && ! get_the_tags() ) {
				$post_holder = false;
			}		

			if ( $post_holder && get_post_type() !== 'leverage-portfolio' ) : ?>

				<div class="post-holder">

					<?php if ( ! $single_post['disable_posted_date'] ) : ?>
					<div class="post-meta-item publication-date">
						<time class="date"><?php echo leverage_posted_on(); ?>.</time>
					</div>
					<?php endif; ?>

					<?php if ( get_the_tags() && ! $single_post['disable_tags'] ) : ?>
						<div class="row d-flex align-items-center post-holder-tags <?php if ( $single_post['disable_posted_date'] ) { echo 'm-0'; } ?>">
							<?php the_tags( '', '', '' ); ?>
						</div>
					<?php endif; ?>

				</div>
				
			<?php 
			endif; 
			
			if ( function_exists( 'ACF' ) && isset( $single_post['disable_social_share'] ) && ! $single_post['disable_social_share'] ) : ?>

				<div class="post-holder">
					<ul class="navbar-nav social share-list social-share">

						<?php
						if ( have_rows( 'single_post_share_links', 'option' ) ) :
							while( have_rows( 'single_post_share_links', 'option' ) ) :
								the_row();
	
								// Facebook
								if ( get_row_layout() == 'facebook' ) :
								
									$url = get_sub_field( 'url' );									
									$url = str_replace( '{link}', get_the_permalink(), $url);
									$url = str_replace( '{title}', get_the_title(), $url);
									?>

									<li class="nav-item">
										<a href="<?php echo esc_attr( $url ); ?>" target="_blank" class="nav-link">
											<i class="icon-social-facebook"></i>
											<?php the_sub_field( 'label' ); ?>
										</a>
									</li>

								<?php 
								// Twitter
								elseif ( get_row_layout() == 'twitter' ) :
								
									$url = get_sub_field( 'url' );									
									$url = str_replace( '{link}', get_the_permalink(), $url);
									$url = str_replace( '{title}', get_the_title(), $url);
									?>

									<li class="nav-item">
										<a href="<?php echo esc_attr( $url ); ?>" target="_blank" class="nav-link">
											<i class="icon-social-twitter"></i>
											<?php the_sub_field( 'label' ); ?>
										</a>
									</li>

								<?php 
								// Linkedin
								elseif ( get_row_layout() == 'linkedin' ) :
								
									$url = get_sub_field( 'url' );									
									$url = str_replace( '{link}', get_the_permalink(), $url);
									$url = str_replace( '{title}', get_the_title(), $url);
									?>

									<li class="nav-item">
										<a href="<?php echo esc_attr( $url ); ?>" target="_blank" class="nav-link">
											<i class="icon-social-linkedin"></i>
											<?php the_sub_field( 'label' ); ?>
										</a>
									</li>

								<?php 
								// Custom
								elseif ( get_row_layout() == 'custom' ) :
								
									$url = get_sub_field( 'url' );									
									$url = str_replace( '{link}', get_the_permalink(), $url);
									$url = str_replace( '{title}', get_the_title(), $url);
									?>

									<li class="nav-item">
										<a href="<?php echo esc_attr( $url ); ?>" target="_blank" class="nav-link">

											<?php if ( get_sub_field( 'icon_style' ) == 'Line Icon' && get_sub_field( 'icon' ) ) : ?>
												<i class="icon-<?php the_sub_field( 'icon' ); ?>"></i>

											<?php elseif ( get_sub_field( 'icon_style' ) == 'Awesome Icon' && get_sub_field( 'icon' ) ) : ?>
												<i class="<?php echo esc_attr( get_sub_field( 'icon_fa' ) ); ?>"></i>

											<?php endif; ?>

											<?php the_sub_field( 'label' ); ?>
										</a>
									</li>

								<?php 
								endif;
							endwhile;
						endif; 
						?>
						


					</ul>
				</div>

			<?php 
			endif;
		endif;
		?>
	</div>
</div>
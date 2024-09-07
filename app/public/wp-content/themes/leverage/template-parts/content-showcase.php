<?php
/**
 * @package Leverage
 */

$blog_layout = array(
	'vertical_spacing'            => false,
	'vertical_spacing_responsive' => false,
	'container'                   => false,
	'columns'                     => false
);

$body_enable_dark_mode = false;
$blog_vs               = 'section-vs-130';
$blog_vsr              = 'section-vsr-90';

if ( function_exists( 'ACF' ) ) {
	$blog_layout = get_field( 'blog_layout', 'option' ); 

	if ( ! $blog_layout ) {

		$blog_layout = array(
			'vertical_spacing'            => false,
			'vertical_spacing_responsive' => false,
			'container'                   => false,
			'columns'                     => 3
		);
	}

	$body_enable_dark_mode = get_field( 'body_enable_dark_mode', 'option' );
	$blog_vs               = 'section-vs-' . $blog_layout['vertical_spacing'];
	$blog_vsr              = 'section-vsr-' . $blog_layout['vertical_spacing_responsive'];
}

if ( $body_enable_dark_mode ) {
	$body_mode_class = 'body-mode-dark';
} else {
	$body_mode_class = 'body-mode-default';
}
?>

<section id="showcase" class="<?php echo esc_attr( $body_mode_class.' '.$blog_vs.' '.$blog_vsr ); ?> showcase news blog-grid masonry">
	<div data-aos="zoom-in" data-aos-delay="200" data-aos-anchor="body" class="container <?php if ( $blog_layout['container'] ) { echo esc_attr( $blog_layout['container'] ); } ?>">
		<div class="row content blog-grid masonry">
			<main class="col-12 p-0">
				<div class="<?php if( ! have_posts() ) { echo 'row items justify-content-center'; } else { echo 'bricklayer items columns-' . $blog_layout['columns']; } ?>">

					<?php
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();                            
							get_template_part( 'template-parts/content', 'post' );
                        endwhile;
                        wp_reset_postdata();
					else :
						get_template_part( 'template-parts/content', 'none' );
					endif;
					?>
		
				</div>
                
                <?php
                $pagination = paginate_links( array() );                         
                
                if ( $pagination ) : ?>

				<div class="row">
					<div class="col-12">
						<nav>
							<?php 
								echo paginate_links( array(
									'end_size'  => 1,
									'mid_size'  => 2,
									'prev_text' => '<i class="icon-arrow-left"></i>',
									'next_text' => '<i class="icon-arrow-right"></i>',
									'type'      => 'list'
								) );  
							?>
						</nav>
					</div>
                </div>
                
				<?php endif; ?>
				
			</main>			
		</div>
	</div>
</section>
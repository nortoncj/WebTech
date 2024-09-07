<?php
/**
 * @package Leverage
 */

get_header(); 
get_template_part( 'template-parts/content', 'no-slider' ); ?>

<section id="image">
	<div class="container">
		<div class="row content">
			<div class="col-12 p-0 text-center">
				<?php echo wp_get_attachment_image( get_the_ID(), 'leverage-about-image' ); ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer();
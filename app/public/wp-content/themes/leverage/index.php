<?php
/**
 * @package Leverage
 */

get_header();

if ( ! is_page() ) {
	get_template_part( 'template-parts/content', 'no-slider' );
}

get_template_part( 'template-parts/content', 'showcase' );
get_footer();
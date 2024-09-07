<?php
/**
 * @package Leverage
 */

function get_breadcrumb() {

	$frontpage_id    = get_option( 'page_on_front' );
	$frontpage_title = get_the_title( $frontpage_id );

	echo '<li class="breadcrumb-item"><a href="'.home_url().'" rel="nofollow">'.$frontpage_title.'</a></li>';
	
    if ( is_category() || is_tag() || is_author() ) {
		the_archive_title( '<li class="breadcrumb-item active">', '</li>' );

	} elseif ( is_single() && !is_attachment() ) {

		if ( get_post_type() == 'leverage-portfolio' ) {

			global $post;
			$terms = get_the_terms( $post->ID, 'leverage_portfolio_category' );
			
			if ( $terms ) {

			echo '<li class="breadcrumb-item">';

				$terms_item = null;
				foreach( $terms as $term ) {
					$term_link    = get_term_link( $term->slug, 'leverage_portfolio_category' );
					$term_elem    = '<a href="'.$term_link.'" rel="nofollow">'.$term->name.'</a>';				
					$terms_item[] = $term_elem;
				}

				echo implode (', ', $terms_item).'</li>';
			}

		} else {
			echo '<li class="breadcrumb-item">';
			the_category( ', ' );
			echo '</li>';
		}

		echo '<li class="breadcrumb-item active">'.get_the_title().'</li>';

	} elseif ( is_page() || is_attachment() ) {

		global $post;
		$parent_title = get_the_title( $post->post_parent );
		$parent_link  = get_the_permalink( $post->post_parent );

		if ( $post->post_parent ) {
			echo '<li class="breadcrumb-item"><a href="'.$parent_link.'" rel="nofollow">'.$parent_title.'</a></li>';
		}

		echo '<li class="breadcrumb-item active">'.get_the_title().'</li>';

    } elseif ( is_search() ) {
		
		echo '<li class="breadcrumb-item active">'.get_search_query().'</li>';
    }
}
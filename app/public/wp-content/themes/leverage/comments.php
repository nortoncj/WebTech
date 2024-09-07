<?php
/**
 * @package Leverage
 */

if ( post_password_required() ) {
	return;
} ?>

<?php
if ( have_comments() ) : ?>

<div class="row comments">
	<div class="col-12 p-0 align-self-center">

		<?php
		if ( '1' === get_comments_number() ) {

			echo '<h3>1 ' . esc_html__( 'Comment', 'leverage' ) . ' </h3>';

		} else {

			echo '<h3>' . get_comments_number() . ' ' . esc_html__( 'Comments', 'leverage' ) . ' </h3>';
		}
		?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'avatar_size' => 60, 
				'style'       => 'ul', 
				'callback'    => 'leverage_comments', 
				'type'        => 'all'
			) );
			?>
		</ol>

		<?php
		the_comments_pagination( array(
			'prev_text' => 'PREV',
			'next_text' => 'NEXT'
		) );

		if ( ! comments_open() ) : ?>
		<p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'leverage' ); ?></p>
		<?php endif; ?>
		
	</div>
</div>

<?php endif; ?>

<div class="row comments">
	<div class="col-12 p-0 align-self-center">
		<?php comment_form(); ?>
	</div>
</div>
<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package simplemd
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments-card" class="mdui-card">
	<div id="comments" class="mdui-card-content comments-area mdui-card-content mdui-typo">
	
		<?php
		// You can start editing here -- including this comment!
		if ( have_comments() ) :
			?>
			<h2 class="comments-title">
				<?php
				$simplemd_comment_count = get_comments_number();
				if ( '1' === $simplemd_comment_count ) {
					printf(
						/* translators: 1: title. */
						esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'simplemd' ),
						'<span>' . wp_kses_post( get_the_title() ) . '</span>'
					);
				} else {
					printf( 
						/* translators: 1: comment count number, 2: title. */
						esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $simplemd_comment_count, 'comments title', 'simplemd' ) ),
						number_format_i18n( $simplemd_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'<span>' . wp_kses_post( get_the_title() ) . '</span>'
					);
				}
				?>
			</h2><!-- .comments-title -->
	
			<?php the_comments_navigation(); ?>
	
			<div class="comment-list">
				<?php
				wp_list_comments(
					array(
						'style'       => 'ol',
						'format'      => 'html5',
						'short_ping'  => true,
						'callback'    => function($comment, $args, $depth) { ?>
<li <?php comment_class( 'comment-li' ); ?> id="comment-<?php comment_ID() ?>">
	<div class="comment-intro">
		<?php echo get_avatar( get_comment_author_email(), 48 ); ?>
		<div class="comment-intro-details">
			<div class="comment-author-link">
				<?php echo get_comment_author_link(); ?>
			</div>
			<div class="comment-permalink"><?php echo get_comment_date() . ' ' . get_comment_time() ?></div>
		</div>
	</div>

	<?php if ($comment->comment_approved == '0') : ?>
		<em><?php _e('Your comment is awaiting moderation.') ?></em><br />
	<?php endif; ?>

	<?php comment_text(); ?>

	<div class="reply">
		<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
</li> <?php } 
					)
				);
?>
			</div><!-- .comment-list -->

<?php
				the_comments_navigation();

				// If comments are closed and there are comments, let's leave a little note, shall we?
				if ( ! comments_open() ) :
?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'simplemd' ); ?></p>
<?php
					endif;

				endif; // Check for have_comments().

				comment_form( array( 
					"comment_field" => '
					<div class="mdui-textfield mdui-textfield-floating-label">
					<i class="mdui-icon material-icons">message</i>
					<label class="mdui-textfield-label">Comment</label>
					<textarea id="comment" name="comment" class="mdui-textfield-input"></textarea>
					</div>',
					"submit_button" => '<input name="%1$s" type="submit" id="%2$s" class="%3$s mdui-btn mdui-btn-block mdui-ripple" value="%4$s" />'
				) );
?>

	</div><!-- #comments -->
</div>

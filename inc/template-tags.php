<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package besimple
 */

if ( ! function_exists( 'besimple_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function besimple_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on =  $time_string;

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'besimple_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function besimple_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'besimple' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'besimple_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function besimple_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			echo '<div class="content-categories-list">';
			$categories_list = get_the_terms( 0, 'category' );
			foreach( $categories_list as $category ) { ?>
				<span href="<?php echo get_category_link( $category ); ?>" class="mdui-chip">
					<span class="mdui-chip-icon mdui-color-theme"><i class="mdui-icon material-icons">class</i></span>
					<span class="mdui-chip-title">
						<a class="cat-href" href="<?php echo get_category_link( $category ); ?>"><?php echo $category -> name; ?></a>
					</span>
				</span>
			<?php }

			echo '</div>';

			$tags_list = get_the_terms( 0, 'post_tag' );
			echo '<div class="content-tags-list">';
			if( ! empty( $tags_list ) ) {
				foreach( $tags_list as $tag ) { ?>
					<span href="<?php echo get_tag_link( $tag ); ?>" class="mdui-chip">
						<span class="mdui-chip-icon mdui-color-theme"><i class="mdui-icon material-icons">local_offer</i></span>
						<span class="mdui-chip-title">
							<a class="cat-href" href="<?php echo get_tag_link( $tag ); ?>"><?php echo $tag -> name; ?></a>
						</span>
					</span>
				<?php }
			}

			echo '</div>';
		}

		comments_popup_link(
			false,
			false,
			false,
			"mdui-btn mdui-btn-dense mdui-ripple"
		);
		
		if( NULL !== get_edit_post_link() ) {
?>
			<a href="<?php echo get_edit_post_link(); ?>" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple"><i class="mdui-icon material-icons">edit</i></a>
<?php
		}
	}
endif;

if ( ! function_exists( 'besimple_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function besimple_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

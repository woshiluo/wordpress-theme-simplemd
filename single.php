<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package simplemd
 */

get_header();
?>

	<div id="top-block" class="top-block mdui-container">
		<main id="primary" class="site-main">
			<div class="mdui-container-fluid">
	
				<?php
				while ( have_posts() ) :
					the_post();
		
					get_template_part( 'template-parts/content', get_post_type() );

					echo '<div class="mdui-typo mdui-container">';
		
					the_post_navigation(
						array(
							'prev_text' => '<span class="mdui-btn nav-subtitle mdui-text-truncate"><i class="mdui-icon material-icons">keyboard_arrow_left</i>' . esc_html__( 'Previous:', 'simplemd' ) . '%title</span>',
							'next_text' => '<span class="mdui-btn nav-subtitle mdui-text-truncate">' . esc_html__( 'Next:', 'simplemd' ) . '%title<i class="mdui-icon material-icons">keyboard_arrow_right</i></span>',
						)
					);

					echo '</div>';
		
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
		
				endwhile; // End of the loop.
				?>
	
			</div>
		</main><!-- #main -->
	
	<?php get_sidebar(); ?>
	</div>

<?php get_footer();

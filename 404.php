<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package simplemd
 */

get_header();
?>

	<div id="top-block" class="top-block mdui-container">
		<main id="primary" class="site-main">
			<div class="mdui-card">
				<div class="mdui-card-content">
					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'simplemd' ); ?></h1>
						</header><!-- .page-header -->
			
						<div class="page-content mdui-typo">
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'simplemd' ); ?></p>
			
								<?php
									get_search_form();
									the_widget( 'WP_Widget_Recent_Posts' );
									the_widget( 'WP_Widget_Tag_Cloud' );
								?>
			
						</div><!-- .page-content -->
					</section><!-- .error-404 -->
				</div>
			</div>
	
		</main><!-- #main -->
	</div>

<?php
get_footer();

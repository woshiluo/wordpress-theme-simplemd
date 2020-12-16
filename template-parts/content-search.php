<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package simplemd
 */

?>

<div class="mdui-card content-card">
	<div class="mdui-card-content">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header mdui-typo">
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		
				<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php
					simplemd_posted_on();
					simplemd_posted_by();
					?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->
		
			<?php simplemd_post_thumbnail(); ?>
		
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		
			<footer class="entry-footer">
				<?php simplemd_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</article><!-- #post-<?php the_ID(); ?> -->
	</div>
</div>

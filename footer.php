<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package simplemd
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info mdui-typo">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'simplemd' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'simplemd' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				echo 'Theme: SimpleMD by woshiluo based on <a href="http://underscores.me/">Underscores.me</a>';
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
	Prism.plugins.autoloader.languages_path = '<?php echo get_template_directory_uri() . '/libs/prism/'; ?>components/'

	const $ = mdui.$;
	$('.entry-content > p').each( ( idx, elem ) => { 
		const text = elem.textContent; 
		if( text[0] === text[1] && text[0] === '$' ) {
			$(elem).find('br').replaceWith('');
		}
	});
	renderMathInElement(document.body, {
		delimiters: [
			{left: "$$", right: "$$", display: true},
			{left: "$", right: "$", display: false}
		],
		macros: {
			"\\ge": "\\geqslant",
			"\\le": "\\leqslant",
			"\\geq": "\\geqslant",
			"\\leq": "\\leqslant"
		 }
	 }); 
});
</script>


</body>
</html>

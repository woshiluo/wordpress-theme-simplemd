<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package besimple
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'besimple' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'besimple' ), 'WordPress' );
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
MathJax = {
  tex: {inlineMath: [['$', '$'], ['\\(', '\\)']]},
  svg: {fontCache: 'global'}
};
</script>

<script>Prism.plugins.autoloader.languages_path = 'https://cdn.jsdelivr.net/npm/prismjs/components/'</script>
<script>
// Add Highlight
jQuery("pre:not([class*='language'])").addClass('language-cpp').addClass('line-numbers');

jQuery("[class*='language']").addClass('line-numbers');
jQuery("pre[class*='language']").addClass('remove-code-backgroud');
jQuery("[class*='language']").removeClass('wp-block-code');
// Add Hitokoto
jQuery("#site-header").after("<div class=\"hitokoto-card\"><div class=\"hitokoto\"><div class='hitokoto-content'></div><br/><div class='hitokoto-from'><\/div><\/div><\/div>");
			// Hitokoto
	jQuery.get('https://hitokoto.woshiluo.com/', function (data) {
		if (typeof data === 'string') data = JSON.parse(data);
		jQuery('.hitokoto').css('display', 'block');
		jQuery('.hitokoto-content').css('display', '').text(data.hitokoto);
		if (data.source) {
			jQuery('.hitokoto-from').css('display', '').text('—— ' + data.source);
		}
	});

</script>


</body>
</html>

<?php
/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/*
 * Generate a unique ID for each form and a string containing an aria-label
 * if one was passed to get_search_form() in the args array.
 */
// $twentytwenty_unique_id = twentytwenty_unique_id( 'search-form-' );
// 
// $twentytwenty_aria_label = ! empty( $args['label'] ) ? 'aria-label="' . esc_attr( $args['label'] ) . '"' : '';
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="mdui-textfield mdui-textfield-floating-label">
		<label class="mdui-textfield-label">Search what?</label>
		<input type="search" id="srach-from" class="search-field mdui-textfield-input" value="<?php echo get_search_query(); ?>" name="s"/>
	</div>
	<input type="submit" style="display:none" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple" value=""/>
</form>


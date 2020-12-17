/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

var lg_ar = Array(), images = Array(), subtit = Array();
jQuery(document).ready( function(){
// Light Gallery
	jQuery(".entry-content img").each( function() {
		jQuery(this).css('cursor', 'pointer');
		var element = jQuery(this).siblings("figcaption");
        var img_alt = jQuery(element).text();
		lg_ar[ lg_ar.length ] = { "src": this.src, "thumb": this.src, "subHtml": img_alt + "<br/>By Woshiluo"}
	});

	images = jQuery(".entry-content img");
	for( var i = 0; i < images.length; i ++ ) {
		images[i].now = i;
		jQuery(images[i]).click( function() {
			var tmp = this.now;
			console.log( tmp );
			jQuery("body").lightGallery({
				autoplay: false,
				autoplayControls: false,
				share: false,
				counter: true,
				dynamic: true,
				download: false,
				dynamicEl: lg_ar
			});
			jQuery("body").data('lightGallery').index = tmp;
		});
	}
});

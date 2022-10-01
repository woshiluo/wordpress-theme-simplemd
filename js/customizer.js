/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

jQuery(document).ready( function(){
	// Light Gallery
	let lightgallery_list = Array(), images = Array();
	jQuery(".entry-content img").each( function() {
		jQuery(this).css('cursor', 'pointer');
		let element = jQuery(this).siblings("figcaption");
		let img_alt = jQuery(element).text();
		lightgallery_list.push({ "src": this.src, "thumb": this.src, "subHtml": img_alt + "<br/>By Woshiluo"});
	});

	images = jQuery(".entry-content img");
	for( let i = 0; i < images.length; i ++ ) {
		images[i].now = i;
		jQuery(images[i]).click( function() {
			let idx = this.now;
			console.log( idx );
			jQuery("body").lightGallery({
				autoplay: false,
				autoplayControls: false,
				share: false,
				counter: true,
				dynamic: true,
				download: false,
				dynamicEl: lightgallery_list
			});
			jQuery("body").data('lightGallery').index = idx;
		});
	}
});

/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

if ('serviceWorker' in navigator) {
	navigator.serviceWorker.register('/wp-content/themes/wordpress-theme-simplemd/js/sw.js', {scope: '/'}).then(function(reg) {
		// registration worked
		console.log('Registration succeeded. Scope is ' + reg.scope);
	}).catch(function(error) {
		// registration failed
		console.log('Registration failed with ' + error);
	});
}

jQuery(document).ready( function(){
	// Light Gallery
	let lightgallery_list = Array(), images = Array();
	jQuery(".entry-content img").each( function() {
		jQuery(this).css('cursor', 'pointer');
		let element = jQuery(this).siblings("figcaption");
		let img_alt = jQuery(element).text();
		lightgallery_list.push({ "src": this.srcset.split(' ').reverse()[1], "thumb": this.src, "subHtml": img_alt + "<br/>By Woshiluo"});
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

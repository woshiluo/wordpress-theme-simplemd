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
	const lightgallery_list = [];
	// Light Gallery
	jQuery(".entry-content img").each( function() {
		jQuery(this).css('cursor', 'pointer');
		const element = jQuery(this).siblings("figcaption");
		const img_alt = jQuery(element).text();
		const origin_source = this.srcset? this.srcset.split(' ').reverse()[1]: undefined;
		lightgallery_list.push({ "src": ( origin_source === undefined? this.src: origin_source ) , "thumb": this.src, "subHtml": img_alt + "<br/>By Woshiluo"});
	});

	const images = jQuery(".entry-content img");
	for( let i = 0; i < images.length; i ++ ) {
		images[i].now = i;
		jQuery(images[i]).click( function() {
			const idx = this.now;
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

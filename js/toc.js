var lg_ar = Array(), images = Array(), subtit = Array();
var max_title = 4, subtit_cnt = 0;
jQuery(document).ready(function(){
	function init_toc() {
		var a = Array();
		for( var i = 1; i <= max_title; i ++ ) {
			a[i] = jQuery( ".entry-content > h" + i );
			for( var j = 0; j < a[i].length; j ++ ) {
				a[i][j].id = subtit.length;
				var tmp = subtit.length;
				subtit[ tmp ] = a[i][j];
				subtit[ tmp ].height = jQuery( a[i][j] ).offset().top;
				subtit[ tmp ].dep = i;
			}
		}
	}

	function cmp( a, b ) {
		return a.height - b.height;
	}

	function show_toc() {
		subtit.sort( cmp );
		var text = "<div class='toc toc-open'><button id='toggle_toc'><p class='toggle-toc-rotate'>&lt;</p></button><div class='toc-main'>";
		var cur_dep = 0, base_dep;
		var flag_has_toc = false;
		for( var i = 0; i < subtit.length; i ++ ) {
			flag_has_toc = true;
			if( subtit[i].dep != cur_dep ) {
				if( cur_dep != 0 )
					text += "</div>\n";
				if( cur_dep == 0 )
					base_dep = subtit[i].dep;
				text += "<div class='toc-" + ( subtit[i].dep - base_dep ) + "'>\n";
				cur_dep = subtit[i].dep;
			}
			text += "<div id = '" + subtit[i].id + "-div' class='toc-item'><a href='#'>" + jQuery( subtit[i] ).text() + "</a></div>\n";
		}
		text += "</div></div></div>";
		return flag_has_toc? text: "";
	}

	init_toc();
	jQuery( "body" ).append( show_toc() );
	jQuery( ".toc-main" ).niceScroll({
		cursorcolor: "#fff",
		cursoropacitymin: 0.5,
		cursorborder: "0",
		cursorborderradius: "2px",
	});

	for( var i = 0; i < subtit.length; i ++ ) {
		jQuery("#" + subtit[i].id + "-div").click( function(){
			jQuery('html').animate({
				scrollTop: jQuery( '#' + this.id.split('-')[0] ).offset().top + 5
			},500);
		});
	}

});

var cur_act = 0;
jQuery( window ).scroll( function() {
	var height = jQuery(window).scrollTop(), i;
	for( i = 0; i < subtit.length; i ++ ) {
		if( i != subtit.length - 1 && jQuery(subtit[i]).offset().top < height && jQuery(subtit[i + 1]).offset().top > height )
			break;
	}

	if( i >= subtit.length )
		i --;
	if( height <= jQuery( subtit[0] ).offset().top )
		i = 0;

	jQuery("#" + cur_act + "-div").removeClass("toc-item-act");
	jQuery("#" + subtit[i].id + "-div").addClass("toc-item-act");

	cur_act = subtit[i].id;
	let will_scrolled = jQuery( '#' + cur_act + '-div' ).offset().top 
	- jQuery( '#0-div').offset().top;
	jQuery('.toc-main').getNiceScroll(0).doScrollTop( will_scrolled - 10 );
});

var open = true;
jQuery(document).ready(function(){
	jQuery('#toggle_toc').click( function(){
// 		console.log( open );
		if( open ) {
			jQuery('.toc').addClass('toc-close');
			jQuery('#toggle_toc >p').addClass('toggle-toc-rotate360');
			jQuery('.toc').removeClass('toc-open');
			jQuery('#toggle_toc >p').removeClass('toggle-toc-rotate');
			open = false;
		}
		else {
			jQuery('.toc').addClass('toc-open');
			jQuery('#toggle_toc >p').addClass('toggle-toc-rotate');
			jQuery('.toc').removeClass('toc-close');
			jQuery('#toggle_toc >p').removeClass('toggle-toc-rotate360');
			open = true;
		}
	});
});

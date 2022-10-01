jQuery(document).ready(function(){
	let subtit = Array();
	let max_title = 4, subtit_cnt = 0;
	function init_toc() {
		let titles = Array();
		for( let i = 1; i <= max_title; i ++ ) {
			titles[i] = jQuery( ".entry-content > h" + i );
			for( let j = 0; j < titles[i].length; j ++ ) {
				titles[i][j].id = subtit.length;
				titles[i][j].height = jQuery( titles[i][j] ).offset().top;
				titles[i][j].dep = i;
				subtit.push(titles[i][j]);
			}
		}
	}

	function cmp( a, b ) {
		return a.height - b.height;
	}

	function show_toc() {
		subtit.sort( cmp );
		let text = "<div class='toc toc-open'><button id='toggle_toc'><p class='toggle-toc-rotate'>&lt;</p></button><div class='toc-main'>";
		let cur_dep = 0, base_dep;
		let flag_has_toc = false;
		for( let i = 0; i < subtit.length; i ++ ) {
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

	let cur_act = 0;
	function refresh_current_title() {
		let height = jQuery(window).scrollTop(), i;
		for( i = 0; i < subtit.length; i ++ ) {
			if( i != subtit.length - 1 && jQuery(subtit[i]).offset().top < height && jQuery(subtit[i + 1]).offset().top > height )
				break;
		}
	
		if( i >= subtit.length )
			i --;
		if( height <= subtit[0].height )
			i = 0;
	
		jQuery("#" + cur_act + "-div").removeClass("toc-item-act");
		jQuery("#" + subtit[i].id + "-div").addClass("toc-item-act");
	
		cur_act = subtit[i].id;
		let will_scrolled = jQuery( '#' + cur_act + '-div' ).offset().top - jQuery( '#0-div').offset().top;
		jQuery('.toc-main').getNiceScroll(0).doScrollTop( will_scrolled - 10 );
	}

	init_toc();
	jQuery( "body" ).append( show_toc() );
	jQuery( ".toc-main" ).niceScroll({
		cursorcolor: "#fff",
		cursoropacitymin: 0.5,
		cursorborder: "0",
		cursorborderradius: "2px",
	});

	for( let i = 0; i < subtit.length; i ++ ) {
		jQuery("#" + subtit[i].id + "-div").click( function(){
			jQuery('html').animate({
				scrollTop: jQuery( '#' + this.id.split('-')[0] ).offset().top + 5
			},500);
		});
	}

	refresh_current_title();

	jQuery( window ).scroll( function() {
		refresh_current_title();
	});
});


jQuery(document).ready(function(){
	let open = true;
	jQuery('#toggle_toc').click( function(){
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

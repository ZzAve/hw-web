// JavaScript Document

// Link events to a function
window.onload = replaceFooter;
window.onresize = replaceFooter;


// ensure HORIZONTAL scrolling of header and footer
$(window).scroll(function(){
  $('#menu').css('left',-$(window).scrollLeft());
  $('#logo').css('left',-$(window).scrollLeft());
  $('#tapsplash').css('left',-$(window).scrollLeft());
  $('#copyright').css('left',-$(window).scrollLeft());
  $('#social-media-icons').css('left',-$(window).scrollLeft());

  $('#footer').css('right',-$(window).scrollLeft());
});


function replaceFooter(){
	var bodie = document.body;
	var footer = document.getElementById("footer");
	var contentbar = document.getElementById("content-bar");
	
	var minHeight=700;
	if ( bodie.clientHeight < minHeight ){
		var footerStart = contentbar.clientHeight;
		var footerHeight = footer.clientHeight;
		var footerTop = footerStart - footerHeight;
		footer.style.position = "absolute";
		footer.style.top = footerStart + "px";

	} else {
		footer.removeAttribute("style");
	}			
}

$(document).ready( function() {
	
	/*****************
	*  MENU FUNCTIONS 
	******************/
	// nice scrolling of submenus on hovering menu item
	$('#menu').find('> li').hover(function(){
        	$(this).find('ul').removeClass('noJS').stop(true,true).slideDown('fast');
    	}, function () {
        	$(this).find('ul').stop(true,true).slideUp('fast');	
		});
	
	// ensure highlighting of menu entry of current page
	var str=location.href.toLowerCase();
	$("#menu li a").each(function() {
		if (str.indexOf(this.href.toLowerCase()) > -1) {
			$("li.highlight").removeClass("highlight");
			$(this).parent().addClass("highlight");
		}
  	});

	// if subpage is highlighted, also highlight the parent of it
	$("#menu li ul").each(function() {
		if ($(this).has('li.highlight').length != 0 ){
			$(this).parent().addClass("highlight");
		}
	});
	/* END OF MENU FUNCTIONS */

	
	/***********************************
	* REPLACE IFRAME LINKS WITH IFRAMES
	************************************/
	
    // create xhtml strict friendly iframe for all Soundcloud embed players
    $('a.iframeSC').each(
        function (i) {
            $(this).replaceWith("<iframe src='" + this.getAttribute("href") + "'  frameborder='0' scrolling='no'></iframe>");
        }
    );
	
	// create xhtml strict friendly iframe for all Youtube embed players
	$('a.iframeYT').each(
        function (i) {
            $(this).replaceWith("<iframe src='" + this.getAttribute("href") + "'  frameborder='0' scrolling='no' title='Youtube video player' wmode='Opaque'></iframe>");
        }
    );
	
	// BAD change of link to iframe due to inline styling!
	$('a.iframe').each(
        function (i) {
            $(this).replaceWith("<iframe src='" + this.getAttribute("href") + "' width='80%' height='600px' wmode='Opaque'></iframe>");
        }
    );
	/* END REPLACING IFRAME LINKS WITH IFRAMES */
});


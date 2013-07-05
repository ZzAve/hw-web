// JavaScript Document

// Link events to a function
//window.onload = replaceFooter;
window.onresize = sizeContentbar;


// ensure HORIZONTAL scrolling of header and footer
/*$(window).scroll(function(){
  $('#menu').css('left',-$(window).scrollLeft());
  $('#logo').css('left',-$(window).scrollLeft());
  $('#tapsplash').css('left',-$(window).scrollLeft());
  $('#copyright').css('left',-$(window).scrollLeft());
  $('#social-media-icons').css('left',-$(window).scrollLeft());

  $('#footer').css('right',-$(window).scrollLeft());
});*/


/*function replaceFooter(){
	var bodie = document.body;
	var footer = document.getElementById("footer");
	var wrapper = document.getElementById("wrapper");
	var contentbar = document.getElementById("content-bar");
	contentbar.removeAttribute("style");
	contentbar.style.height = wrapper.clientHeight-20+"px";
	
	var minHeight=700;
	if ( bodie.clientHeight < minHeight ){
		var footerEnd = wrapper.clientHeight;
		var footerHeight = footer.clientHeight;
		var footerTop = footerEnd - footerHeight;
		footer.style.top = footerTop + 75 + "px";

	} else {
		footer.removeAttribute("style");
	}			
}
*/

function sizeContentbar(){
	var wrapper = document.getElementById("wrapper");
	var header = document.getElementById("header");
	var pusha = document.getElementById("push");
	var contentbar = document.getElementById("content-bar");
	contentbar.removeAttribute("style");
	contentbar.style.height = wrapper.clientHeight - header.clientHeight - pusha.clientHeight +"px";
}
	
$(document).ready( function() {
	sizeContentbar();
	
	
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
            $(this).replaceWith("<iframe src='" + this.getAttribute("href") + "' width='100%' height='600px' wmode='Opaque'></iframe>");
        }
    );
	/* END REPLACING IFRAME LINKS WITH IFRAMES */
});


// JavaScript Document

// Link events to a function
window.onload = replaceFooter;
window.onresize = replaceFooter;


// ensure HORIZONTAL scrolling of header and footer
$(window).scroll(function(){
  $('#menu').css('left',-$(window).scrollLeft());
  $('#logo').css('left',-$(window).scrollLeft());
  $('#golfbeweging').css('left',-$(window).scrollLeft());
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
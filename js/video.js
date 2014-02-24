// JavaScript Document
$(document).ready(function() {
	$("#videoList img").each(function() {
		// when clicked on a video (in the videolist) execute a function
		$(this).bind('click', changeVideo);
	});
});

function changeVideo(event) {
	var source = $(this);
	while (source.prop("tagName") != 'LI'){
	   source = source.parent();
	}
	var tarDiv = "#showVideo";
	
	// get all information from source
	var span =source.children('span').html();
	var h4 = source.children('h4').html();
	var p = source.children('p').html();
	var date = source.children('div.date').html();

	// get targets (iframe h3 and p)
	var target = $(tarDiv+' iframe')[0];
	var h3tar = $(tarDiv+' h3');
	var ptar = $(tarDiv+' p');
	var datetar = $(tarDiv+' div.date');
	
	
	// change targetinfo with sourceinfo
	h3tar.html(h4);
	ptar.html(p);
	datetar.html(date);
	target.src= "http://www.youtube.com/embed/"+span+"?wmode=transparent&autoplay=1";
  	
	var offset = $(tarDiv).offset();

	$('html, body').animate({
   	 scrollTop: offset.top,
   	 scrollLeft: offset.left
	});
}

// JavaScript Document
$(document).ready(function() {
	$(".video img").each(function() {
		// when clicked on a video (in the videolist) execute a function
		$(this).bind('click', changeVideo);
	});
});

function changeVideo(event) {
	var source = $(this);
	// get all information from source
	var a =	source.next('a').attr('href');
	var h4 = source.parent().children('h4').html();
	var p = source.parent().children('p').html();

	// get targets (iframe h3 and p)
	var target = $('#showVideo iframe')[0];
	var h3tar = $('#showVideo h3');
	var ptar = $('#showVideo p');

	// change h3 and p	
	h3tar.html(h4);
	ptar.html(p);
	
	// change the src of the iframe
	var char = "?";
	if(a.indexOf("?") != -1){
		  var char = "&";
	}
	target.src = a+char+"wmode=transparent&autoplay=1";
	
}

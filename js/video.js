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
	var h2 = source.parent().children('h2').html();
	var p = source.parent().children('p').html();

	// get targets (iframe h2 and p)
	var target = $('#showVideo iframe')[0];
	var h2tar = $('#showVideo h2');
	var ptar = $('#showVideo p');

	// change h2 and p	
	h2tar.html(h2);
	ptar.html(p);
	
	// change the src of the iframe
	var char = "?";
	if(a.indexOf("?") != -1){
		  var char = "&";
	}
	target.src = a+char+"wmode=transparent&autoplay=1";
	
}

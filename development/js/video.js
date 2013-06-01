// JavaScript Document
function playVideo(source){
	var target = $('#showVideo iframe');
	target.attr('src',source);
	var url = $(this).attr("src");
	var char = "?";
	if(url.indexOf("?") != -1){
		  var char = "&";
	}
	$(this).attr("src",url+char+"wmode=transparent");
};
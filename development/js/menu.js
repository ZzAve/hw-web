window.onload = function() { 
	$('#menu').find('> li').hover(function(){
        	$(this).find('ul')
        	.removeClass('noJS')
        	.stop(true,true).slideDown('fast');
    	}, function () {
        	$(this).find('ul').stop(true,true).slideUp('fast');	
		});
};

$('#nav li').hover(function(){
  $(this).children('ul').slideDown();
}, function() {
  $(this).children('ul').slideUp();
});

$(document).ready(function(){
	var str=location.href.toLowerCase();
	$("#menu li a").each(function() {
		if (str.indexOf(this.href.toLowerCase()) > -1) {
			$("li.highlight").removeClass("highlight");
			$(this).parent().addClass("highlight");
		}
  	});

	$("#menu li ul").each(function() {
		if ($(this).has('li.highlight').length != 0 ){
			$(this).parent().addClass("highlight");
		}
	});
});


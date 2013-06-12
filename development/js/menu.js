$(document).ready(function() { 
	// nice scrolling of submenus on hovering menu item
	$('#menu').find('> li').hover(function(){
        	$(this).find('ul')
        	.removeClass('noJS')
        	.stop(true,true).slideDown('fast');
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

	// if subpage is highlighted, also highlight the father of it
	$("#menu li ul").each(function() {
		if ($(this).has('li.highlight').length != 0 ){
			$(this).parent().addClass("highlight");
		}
	});
});


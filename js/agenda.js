// JavaScript Document



$(document).ready( function() {
	$(document).find('span.noJS').addClass('hiddenWell');
	$(document).find('span.noJS').removeClass('noJS');
	$(document).find('li.noJS').removeClass('noJS');
	
	
	var last = null;
	$(".agenda li span.title").click(function(){
	
		//alert($(this).html());
		var parent = $(this).siblings([0]);
		//alert(parent.html());
		if (parent.hasClass("hiddenWell")){
			parent.hide();
			parent.removeClass("hiddenWell");
	
		}
		parent.toggle(100);
		if (last != null && !parent.is(last)){
			last.toggle(100);
		}
		if (parent.is(last)){
			last = null;
		} else {
			last = parent;
		}
	
	})
	
	if(window.location.hash) {		
		$(window.location.hash+" span.title").trigger("click");
	}
});
// JavaScript Document
//window.onresize = setPhotoViewMargin;

var previous = null;
$(document).ready(function(){
	$("ul.previews li").click(function(){		
		//get the big image
		bigImg = $(this).parent().parent().children([0]);
		
		//chance big image
		imgNewsrc  = $(this).children([0]).attr('src');
		bigImg.attr('src',imgNewsrc);
	
	});
	
	$("#leden > div div.col-20 a").click(function(){
		id = $(this).attr('href');
		event.preventDefault();
		//alert($(id).hasClass("hiddenWell"));
		if ($(id).hasClass("hiddenWell")){
			$(id).removeClass("hiddenWell");
		} else {
			$(id).addClass("hiddenWell");
			
		}
		if (previous !== null && previous != id){
			$(previous).addClass("hiddenWell");
		}
		previous = id;
	});
});



// JavaScript Document
//window.onresize = setPhotoViewMargin;

var previous = null;
function openMember(id){
	if ($(id).hasClass("JS-hide")){
		$(id).removeClass("JS-hide");
	} else {
		$(id).addClass("JS-hide");
		
	}
	
	if (previous !== null && previous != id){
		$(previous).addClass("JS-hide");
	}
	previous = id;
}

$(document).ready(function(){
	//$(document).find('.JS').addClass('hiddenWell');
	//$(document).find('.JS').removeClass('JS');
	
	if(window.location.hash) {		
		openMember(window.location.hash);
	}
	
	$("ul.previews li").click(function(){		
		//get the big image
		bigImg = $(this).parent().parent().children([0]);
		
		//chance big image
		imgNewsrc  = $(this).children([0]).attr('src');
		bigImg.attr('src',imgNewsrc);
	
	});
	
	$("#leden > div div.col-20 a").click(function(){
		var id = $(this).attr('href');
		event.preventDefault();
		openMember(id);
	});
});

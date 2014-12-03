// JavaScript Document
//window.onresize = setPhotoViewMargin;

var previous = null;
var member = null;
var active = false;
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
	
	// check if anything is open, otherwise remove previous and next
	if ($("#leden > div.member").not(".JS-hide").length === 0){
		$("#prevMember").hide();
		$("#nextMember").hide();
		active= false;
	} else if (active === false) {
		$("#prevMember").show();
		$("#nextMember").show();
		active = true;
	}
}

$(document).ready(function(){
	$("#prevMember").hide();
	$("#nextMember").hide();
	
	if(window.location.hash) {		
		openMember(window.location.hash);
	}
	
	$("ul.previews li").click(function(){		
		//get the big image
		bigImg = $(this).parent().parent().children([0]).children([0]);
		
		//chance big image
		imgNewsrc  = $(this).children([0]).attr('src');
		bigImg.attr('src',imgNewsrc);
	
	});
	
	$("#leden > div div.col-20 a").click(function(){
		var id = $(this).attr('href');
		event.preventDefault();
		openMember(id);
	});
	$("#prevMember").click(function(){
		//open the previous member
		member = $("#leden > div.member").not(".JS-hide");
		openMember("#"+member.prevAll(".member").attr("id"));
	});
	$("#nextMember").click(function(){
		//open the next member
		member = $("#leden > div.member").not(".JS-hide");
		openMember("#"+member.nextAll(".member").attr("id"));
		
	});
});

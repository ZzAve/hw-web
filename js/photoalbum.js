//window.onresize = setPhotoViewMargin;

window.onload = function(){
	$('#thumblist li img').each(function(index){
			//check height of father element
			var imgHeight = $(this).height();
			var parentHeight = $(this).parent().parent().height();
			
			// if height of father element is smaller then height of img, shift image up
			if (parentHeight < imgHeight){
				
				shiftUp = (imgHeight - parentHeight)/2;
				shiftValue = (-shiftUp) + "px";
				$(this).css('position','relative');
				$(this).css('top',shiftValue);
			}
			$(this).parent().parent().css('opacity',0.8);
		});
};

$(document).ready(function() {
	//setPhotoViewMargin();	
	//window.onkeyup = checkKey;
	//var c=0;
	
	/*
	$("#thumblist li img").click(function() {
		var src = this.src.replace("_thumb","");
		$("#showPhoto img.show").attr("src",src);
		$("#showPhoto").removeClass("hidden");
		preloadImg(src);

	});
	
	$("#closePhotoAlbum").click(function() {
		$("#showPhoto").addClass("hidden");
	});
	
	$('#photosite img.show').click(function(){
		$('#nextPhoto').click();
	});
	
	
	/*
	* This function is used to determine the next and previous photo.
	*
	$('#previousPhoto, #nextPhoto').click(function() {
		event.preventDefault();
		var liId = $(this).parent().parent().children("img").attr("src");
		path = liId.substring(0,liId.lastIndexOf("/")+1);
		liId = liId.substring(liId.lastIndexOf("/")+1,liId.length);
		liId = liId.replace(".jpg","");
		
		if(this.id == "nextPhoto"){
			liId = liId.concat(" .nextImage");
		} else{
			liId = liId.concat(" .prevImage");
		}

		var newPhoto = $('#'+liId).html().replace("_thumb","");
		if (newPhoto == ""){
			$('#showPhoto').addClass('hidden');
		} else {
			$("#photosite img.show").attr('src',path.concat(newPhoto));
			preloadImg(path.concat(newPhoto));
		}
		
		//alert("$(\"#\" " + next + "\" .nextImage\") : " +  	$("#" + next + " .nextImage"));
		//alert("$('#'" + next + "' .nextImage').html() : " +  	$('#' + next + ' .nextImage').html())
		//var nextPhoto = document.getElementById(next);
		
		//var src = "text of span";
		//$("#showPhoto img.show").attr("src",src);
		
	});
	*/
	
	/**
	if($('#thumbs-one-album') != null){		
		heightdiv = $('#photolist').height(); // get height of showing div
		imgN = $('#thumbs-one-album li').length; // get total number of photos in album
	}
	
	$("#up, #down").click(function() {
		var heightTot = $('#thumbs-one-album').height(); // get total height of list with photo's
		(this.id=="down") ? c++ : c--;  // if click on prev or next, change c
		var relShift = 0.9;
		var cmax = Math.ceil((1/relShift * heightTot/heightdiv ));	
		(c === -1) ? c=cmax-1 : c=c%cmax;
		$("#thumbs-one-album").animate({top: -c*relShift*heightdiv},200);
	});
	
	$("#thumbs-one-album img").click(function() {
		var newImg = new Image();
		newImg.src = this.src.replace("_thumb","");	
		$('#showPhoto img').fadeTo('slow',0.3,function(){
			newImg.onload = replaceImage(newImg);
		});
		$('#showPhoto span.hidden').removeClass('hidden');
	});	
	*/
	
});
/*
function replaceImage(image){
	var photo = $('#showPhoto img');
	photo.attr('src',image.src);
	photo.fadeTo('fast',1,function() { $('#showPhoto span').addClass('hidden')});
}


function setPhotoViewMargin(){
	var photodiv = document.getElementById("photosite");
	var winheight = window.innerHeight;
	var newMargin = 0.03 * winheight;
	photodiv.style.marginTop = newMargin + "px";

}

function checkKey(){
	if ( !$('#showPhoto').hasClass('hidden')){
	   	if (event.keyCode == 39){ //right
			$('#nextPhoto').click();
		} else if (event.keyCode == 37) { // left
			$('#previousPhoto').click();
		} else if (event.keyCode == 27) { // esc
			$('#closePhotoAlbum').click();
		}
	}
}

function preloadImg(liID){
	path = liID.substring(0,liID.lastIndexOf("/")+1);
	liID = liID.substring(liID.lastIndexOf("/")+1,liID.length);
	liID = liID.replace(".jpg","");
	prevstr = liID.concat(" .prevImage");
	prev = $('#'+prevstr).html().replace("_thumb","");
	nextstr = liID.concat(" .nextImage");
	next = $('#'+nextstr).html().replace("_thumb","");

	prvImg = new Image();
	nxtImg = new Image();
	nxtImg.src=path+next;
	nxtImg.onload = function() {
		prvImg.src = path + prev;
	}
	
}
*/

$(document).ready(function() {
	var c=0;

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
});

function replaceImage(image){
	var photo = $('#showPhoto img');
	photo.attr('src',image.src);
	photo.fadeTo('fast',1,function() { $('#showPhoto span').addClass('hidden')});
}

	




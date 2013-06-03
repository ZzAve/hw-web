$(function() {
var c=0;

	if($('#thumbs-one-album') != null){
		heightdiv = $('#photolist').height(); // get height of showing div
		heightTot = $('#thumbs-one-album').height(); // get total height of list with photo's
		imgN = $('#thumbs-one-album li').length; // get total number of photos in album
	}
	
	
	$("#prev, #next").click(function() {
		(this.id=="next") ? c++ : c--;  // if click on prev or next, change c
		var relShift = 0.7;
		var cmax = (relShift*heightTot/heightdiv );		
		c = (c === -1) ? 0 : c%cmax;
		$("#thumbs-one-album").stop(true,true).animate({top: -c*relShift*heightdiv},500);

	});
	
});

function imageClick(source) {

	var path = source.src.replace("_thumb","");
	var photo = $('#showPhoto img');
	photo.attr('src',path);

	var pos = photo.position();
	//scrollTo(pos.top, pos.left);
}
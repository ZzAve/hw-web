$(function() {
	
	var tb_width = $('#thumbs-box').width();
	var imgN = $('#thumbs li').length;
	var c = 0;

	$("#prev, #next").click(function() {
		var myID = this.id=="next" ? c++ : c--;
		
		if (c===-1){
			c=0;
		}else if (c>= imgN/5 + 2) {
			c--;
		} else { 
		$("#thumbs").stop(true,true).animate({left: -c*0.5*tb_width},500);
		}
		$('#add').html("c= "+c);
	});


});

function imageClick(source) {
	alert(source);
	path = source.src.replace("_thumb","")
	alert(path);
	photo = $('#showPhoto img');
	photo.html("hallo!");
	
	photo.src=path;
	alert(photo.src);
	var pos = photo.position();
	scrollTo(pos.top, pos.left);
}
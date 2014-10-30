// JavaScript Document
//window.onresize = setPhotoViewMargin;
$(document).ready(function(){
	$("ul.previews li").click(function(){		
		//get the big image
		bigImg = $(this).parent().parent().children([0]);
		
		//chance big image
		imgNewsrc  = $(this).children([0]).attr('src');
		bigImg.attr('src',imgNewsrc);
	
	});
});

$(window).load(function(){
	var nrOfImgs = $('ul.previews li.loading').length;
	$('ul.previews li.loading').each(function(index){
		var count=index+1;		
		var deze = $(this);
		var time = count*100;
		setTimeout(function(){
			curImg = new Image();
			curImg.src = deze.html()
			curImg.onload = adaptImg(deze,curImg,count,count==nrOfImgs);
		},time);
	})
});

function adaptImg(element,image,count,last){
	// Create new element ('img' element)
	var img = document.createElement('img');
	img.src = element.html();
	img.alt = 'Foto #'+count;
	
	//Change the inside of the <a> element
	element.html('');
	element.append(img);
	var newEl = element.children('img');
	
	// At this point, the image is inserted!
	newEl.load(function(){
		//alert(newEl.attr('src'));
		//Get height of both image and father element
		var imgHeight = newEl.height();
		var imgWidth  = newEl.width();
		var parentHeight = element.height();
		var parentWidth  = element.width();
	
		// if height of father element is smaller then height of img, shift image up
		if (parentHeight < imgHeight + 10){
			shiftUp = (imgHeight - parentHeight)/2;
			shiftValue = (-shiftUp) + "px";
			newEl.css('position','relative');
			newEl.css('top',shiftValue);
		}
		if (parentWidth < imgWidth + 10){
			shiftLeft = (imgWidth - parentWidth)/2;
			shiftValue = (-shiftLeft) + "px";
			newEl.css('position','relative');
			newEl.css('left',shiftValue);
		}
		
		// change class to data lightbox

		//aElement.attr('data-lightbox', "photo-album");
		newEl.hide();
		element.removeClass('loading');
		element.removeClass('hidden');
		newEl.fadeIn(1000);
	});
	
}



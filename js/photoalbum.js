//window.onresize = setPhotoViewMargin;
$(window).load(function(){
	var nrOfImgs = $('#thumblist li a').length;
	$('#thumblist li a').each(function(index){
		count=index+1;		
		//alert($(this).html());
		var time = count*75;
		var deze = $(this);
		setTimeout(function(){
			curImg = new Image();
			curImg.src = $(this).html();
			curImg.onload = adaptImg(deze,curImg,count,count==nrOfImgs);
		},time);
	})
});

function adaptImg(aElement,image,count,last){
	// Create new element ('img' element)
	var img = document.createElement('img');
	img.src = aElement.html();
	img.alt = 'Foto #'+count;

	//Change the inside of the <a> element
	aElement.html('');
	aElement.append(img);
	var newEl = aElement.children('img');
	
	// At this point, the image is inserted!
	newEl.load(function(){
		//alert(newEl.attr('src'));
		//Get height of both image and father element
		var imgHeight = newEl.height();
		var imgWidth  = newEl.width();
		var parentHeight = aElement.parent().height();
		var parentWidth  = aElement.parent().width();
		//alert('imgHeight :'+ imgHeight + '\nparentHeight :' + parentHeight);
		//alert('imgWidth :' + imgWidth  + '\nparentWidth :'  + parentWidth);
	
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

		aElement.attr('data-lightbox', "photo-album");
		aElement.parent().removeClass('loading');
		aElement.removeClass('hidden');
		newEl.hide();
		newEl.fadeIn(1000);
		//alert('count ' + count +'\nnrOfImgs ' + nrOfImgs);
		if(last){
			$('#thumblist').removeClass('notLoaded');
		}
	});
	
}



// JavaScript Document

// Link events to a function
window.onresize = sizeContentbar;
window.onload = sizeContentbar;

function sizeContentbar(){
	if( !(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) ) { 
		var wrapper = document.getElementById("wrapper");
		var footer = document.getElementById("footer");
		var contentbar = document.getElementById("content-bar");
		
		var ieversion = 100;
		if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)){ 
		   ieversion=new Number(RegExp.$1);
		}	
		totalHeight = wrapper.clientHeight;
		if (ieversion<8){
			 totalHeight += footer.clientHeight;
		}
		
		
		if (totalHeight < window.innerHeight) {
			diff = window.innerHeight - totalHeight;
			newHeight = contentbar.clientHeight + diff;
			contentbar.style.height = newHeight + "px";
 		}
	}
}

	
$(document).ready( function() {
	sizeContentbar();
	$(document).find('.noJS-hide').removeClass('noJS-hide'); // there is JS, so no hiding needed anymore
	$(document).find('.noJS-show').addClass('JS-hide');   	  // there is JS, hence no need to show directly
	$(document).find('.noJS-show').removeClass('noJS-show'); //       ""         ""         ""  
	

	/*****************
	*  MENU FUNCTIONS 
	******************/
	// ensure highlighting of menu entry of current page
	var str=location.href.toLowerCase();
	$("#menu li a").each(function() {
		if (str.indexOf(this.href.toLowerCase()) > -1) {
			$("li.highlight").removeClass("highlight");
			$(this).parent().addClass("highlight");
		}
  	});
	/* END OF MENU FUNCTIONS */

	
	/***********************************
	* REPLACE IFRAME LINKS WITH IFRAMES
	************************************/
	
    // create xhtml strict friendly iframe for all Soundcloud embed players
    $('a.iframeSC').each(
        function (i) {
            $(this).replaceWith("<iframe src='" + this.getAttribute("href") + "'  frameborder='0' scrolling='no'></iframe>");
        }
    );
	
	// create xhtml strict friendly iframe for all Youtube embed players
	$('a.iframeYT').each(
        function (i) {
            $(this).replaceWith("<iframe src='" + this.getAttribute("href") + "'  frameborder='0' scrolling='no' title='Youtube video player' wmode='Opaque'></iframe>");
        }
    );
	
	// BAD change of link to iframe due to inline styling!
	$('a.iframe').each(
        function (i) {
            $(this).replaceWith("<iframe src='" + this.getAttribute("href") + "' width='100%' height='600px' wmode='Opaque'></iframe>");
        }
    );
	/* END REPLACING IFRAME LINKS WITH IFRAMES */
});


$(window).load(function(){
	shareDiv = $("#sharediv");
	setTimeout(function(){
		shareDiv.hide();
		shareDiv.removeClass("hiddenWell"); 
		shareDiv.css('overflow','');
		shareDiv.fadeIn('fast');
		},1000);

	var nrOfImgs = $('li.loading.img').length;
	$('li.loading.img').each(function(index){
		var count=index+1;		
		var listitem = $(this);
		var depth=1;
		while (listitem.children().length > 0)
		{
			listitem = listitem.children();
			depth++;
		}
		var time = count*100;
		setTimeout(function(){
			curImg = new Image();
			curImg.src = listitem.html()
			curImg.onload = adaptImg(listitem,curImg,count,count==nrOfImgs,depth);
		},time);
	})
});

function adaptImg(element,image,count,last,elementDepth){
	// Create new element ('img' element)
	var img = document.createElement('img');
	img.src = element.html();
	img.alt = 'Foto #'+count;
	
	//Change the inside of the <a> element
	element.html('');
	element.append(img);
	var newEl = element.children('img');
	var parent = element;

	for(i=1;i<elementDepth;i++){
		parent = parent.parent();
	}
	
	// At this point, the image is inserted!
	newEl.load(function(){
		//alert(newEl.attr('src'));
		//Get height of both image and father element
		var imgHeight = newEl.height();
		var imgWidth  = newEl.width();
		var parentHeight = parent.height();
		var parentWidth  = parent.width();
	
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
		
		newEl.hide();
		newEl.fadeIn(1000);
		parent.removeClass('loading');
		parent.children().removeClass('hidden');
		
	});
	
}
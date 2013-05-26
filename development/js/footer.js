$(document).ready(function(){
	footer();
});
	function footer(){
		
		var header = document.getElementById("header");
		var footer = document.getElementById("footer");
		var middle = document.getElementById("middle");
		var totalHeight = header.clientHeight + middle.clientHeight + footer.clientHeight;
		
		if(totalHeight < window.innerHeight){
			var difference = (window.innerHeight - totalHeight) - 60; /*padding is 60*/
			var newHeight = middle.clientHeight + difference;
			middle.style.height =  newHeight + "px";
		}
	}


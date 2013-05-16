$(document).ready(function(){ 
	$('#menu').find('> li').hover(function(){
        	$(this).find('ul')
        	.removeClass('noJS')
        	.stop(true, true).slideToggle('fast');
    	});
});

$(document).ready(function(){
	var str=location.href.toLowerCase();
	$("#menu li a").each(function() {
	if (str.indexOf(this.href.toLowerCase()) > -1) {
	    $("li.highlight").removeClass("highlight");
	$(this).parent().addClass("highlight");
	}
  });
})
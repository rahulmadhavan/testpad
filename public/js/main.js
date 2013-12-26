jQuery(function($) {
	
	
	$(".resultItem img").lazyload({
    effect : "fadeIn"
	});

});

function mason(){
	$('.showResults').masonry({
		itemSelector : '.resultItem',
    	isAnimated: true
	});
	}
jQuery(function($, type) {
	$(".stockContainer").each(function() {
		$(this).stockTicker();
	});
	setTimeout(function() { 
		$(".stockContainer").each(function() {
			var scroller = $(this).children("#scroller");
			var type = $(this).data('display');
			(type === 'fade') ? scroller.stockFade() : scroller.simplyScroll();
		});
	}, 3000);
});
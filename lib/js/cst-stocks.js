//Stock ticker handler using the Google Finance API and a simple JSON/AJAX request
//Author: Cameron Huntington
//Date: 3/3/2014

jQuery(function($) {

$.fn.stockTicker = function(options) {
    return $(this).each(function() {
        new $.stockTicker($(this),options);
    });
};

$.stockTicker = function(el,options) {

	var stockList = el.data('array').split(' '), //creates JS array
		stockLength = stockList.length;

	for (i = 0; i < stockLength; i++) { //retrieves JSON data and creates elements
		$.getJSON('https://finance.google.com/finance/info?client=ig&q=' + stockList[i] + '&callback=?', function(response) {
		    var stock = response[0], //sets JSON response to local variable
		    	stockString ='<li class="stockWrapper">\
		    	<span class="sSymbol">'+stock.t+'</span><br>\
		    	<span class="sPrice">'+stock.l+' | </span>\
		    	<span class="sDiscrep">'+stock.c+'</span><br>\
		    	<span class="sTime">'+stock.lt+'</span>\
		    	</li>';
		    el.children('.stockTick').append(stockString); //write to div.stockTick

		    if (stock.c.indexOf('-') === 0) { //if negative turn red
				$('.sDiscrep:contains(' + stock.c + ')').css({'color': 'red'});
			} else if (stock.c.indexOf('+') === 0) { //if positive turn green
				$('.sDiscrep:contains(' + stock.c + ')').css({'color': 'green'});
			}
		}) // end get
	} //end for

	function stockUpdate() {
		for (i = 0; i < stockLength; i++) {
			$.getJSON('https://finance.google.com/finance/info?client=ig&q=' + stockList[i] + '&callback=?', function(response) {
			    var stock = response[0], //sets JSON response to local variable
			    	sPrice = $('.sSymbol:contains(' + stock.t + ') ~ .sPrice'),
			    	sDiscrep = $('.sSymbol:contains(' + stock.t + ') ~ .sDiscrep'),
			    	sTime = $('.sSymbol:contains(' + stock.t + ') ~ .sTime');

			    if (sPrice.text() != stock.l) { //if prices differ, change
			    	sPrice.fadeOut(200, function() {
			    		sPrice.text(stock.l + ' | ');
			    	}).fadeIn(200);
			    }

				sDiscrep.text(stock.c);
				sTime.text(stock.lt);

				if (stock.c.indexOf('-') === 0) { //if a minus prefixes the price, turn red
					$('.sDiscrep:contains(' + stock.c + ')').css({'color': 'red'});
				} else if (stock.c.indexOf('+') === 0){ //if a plus prefixes the price, turn green
					$('.sDiscrep:contains(' + stock.c + ')').css({'color': 'green'});
				}
			}) //end get
		} //end for
		console.log('i\'m doing it man'); //legacy code
	} //end stockUpdate

	// give it 3s to call up Google, fade in once everything is (hopefully) ready
	setTimeout(function() { $('.stockContainer').fadeIn(); }, 3000);
	
	setInterval(function() {stockUpdate()}, 15000); //updates stock prices and discrepancies every 15s
}

});
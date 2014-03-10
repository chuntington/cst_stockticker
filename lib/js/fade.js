(function($) {

	$.fn.stockFade = function(options) {
		return this.each(function() {
			new $.stockFade(this, options);
		});
	}
	
	//this isn't done yet I'm still coding it omg

})
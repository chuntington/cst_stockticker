(function($) {

	$.fn.stockFade = function(options) {
		return this.each(function() {
			new $.stockFade(this, options);
		});
	}
	
	

})
(function ($) {
 "use strict";

/*---------------------
countdown
--------------------- */
$('[data-countdown]').each(function() {
	
	var $this = $(this), finalDate = $(this).data('countdown');
	
	$this.countdown(finalDate, function(event) {
	$this.html(event.strftime('<span class="cdown days"><span class="time-count">%-D</span><p>/Days</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>/Hour</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>/Min</p></span> <span class="cdown second"> <span><span class="time-count">%S</span> <p>/Sec</p></span>'));
	});
	
});

})(jQuery); 
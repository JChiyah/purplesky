/** JChiyah **/
$(function() {

	$(window).scroll(function() {
		scroll_top();
	});

	function scroll_top() {
		$('#scroll-up').css({'position': 'fixed', 'left': '0.5em', 'bottom': '1em'});
 
        if(($('#scroll-up').offset().top + $('#scroll-up').outerHeight() + 100) > $('#footer-center').offset().top) {
  			$('#scroll-up').css({'position': 'absolute', 'left': '0.5em', 'bottom': '3em'});
        }
	}
	
	$('#scroll-up').click(function() {
		$('html, body').animate({
		    scrollTop: $("nav").offset().top
		}, 500);
	})

});

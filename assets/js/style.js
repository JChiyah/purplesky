$(function() {

	$('#search-toggle').on('click', function() {
    	$('#advanced-search').slideToggle(500, function() {
	        if ($('#advanced-search').is(':visible')) {
	            $('#search-toggle').html('<i class="fa fa-caret-up fa-2x" aria-hidden="true"></i>');
	        } else {
	            $('#search-toggle').html('<i class="fa fa-caret-down fa-2x" aria-hidden="true"></i>');
        	}
    	});
	});

});
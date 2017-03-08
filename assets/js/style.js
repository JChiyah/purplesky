$(function() {

	$('#password-edit').on('click', function() {
    	$('#password-form').slideToggle().css({'visibility': 'visible', 'display': 'block'});
	});

	$('#skill-edit').on('click', function() {
    	$('#skill-add').slideToggle().css({'visibility': 'visible', 'display': 'block'});
    	$('.delete-tag').toggle();
	});

	$('#experience-edit').on('click', function() {
    	$('#experience-add').slideToggle().css({'visibility': 'visible', 'display': 'block'});
    	$('.delete-experience-tag').toggle();    	
	});

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
$(function() {

	var create_project_flag = 1;

	$('#password-edit').on('click', function() {
    	$('#password-form').slideToggle().css({'visibility': 'visible', 'display': 'block'});
	});

	$('#skill-edit').on('click', function() {
    	$('#skill-add').slideToggle().css({'visibility': 'visible', 'display': 'block'});
    	$('.delete-tag').toggle();
	});

	$('#experience-edit').on('click', function() {
    	$('#experience-add').slideToggle().css({'visibility': 'visible', 'display': 'block'});
	});

	$('#search-toggle').on('click', function() {
    	$('#advanced-search').slideToggle(500, function() {
	        if ($('#advanced-search').is(':visible')) {
	            $('#search-toggle').text('Close advanced search');                
	        } else {
	            $('#search-toggle').text('Open advanced search');                
        	}
    	});
	});

	$('#project-continue').on('click', function() {
		if(create_project_flag == 1) {
			$('#create-1').hide();
			$('#create-3').show();
			create_project_flag = 3;
			window.scrollTo(0, 0);
		} else if(create_project_flag == 2) {
			$('#create-2').hide();
			$('#create-3').show();
			create_project_flag = 3;
			window.scrollTo(0, 0);
			$('#project-continue').html('Back');
		} else if(create_project_flag == 3) {
			$('#create-3').hide();
			$('#create-1').show();
			create_project_flag = 1;
			window.scrollTo(0, 0);
			$('#project-continue').html('Continue');
		}
	});

});
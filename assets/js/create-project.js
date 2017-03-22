$(function() {

	/* Restrict input date pickers */
	var tomorrow = new Date();
	tomorrow.setDate(tomorrow.getDate() + 1);

	// Button to continue 
	$('.project-continue').on('click', function() {

		$('.error-msg').hide();
		$('.error-field').removeClass('error-field');
		// Check if all fields are done and show error where needed
		if($('#title').val().length > 2) {

			if($('#description').val().length > 5) {
				var now = new Date();
				var start = new Date($('#start_date').val());
				var end = new Date($('#end_date').val());

				if(!isNaN(start)) {

					if(now.getTime() <= start.getTime()) {

						if(!isNaN(end)) {

							if(start.getTime() <= end.getTime()) {
								if($('#location').val() != 0) {
									if($('#budget').val() >= 0) {
										// All okay, continue
										load_summary();
										$('#project-details').hide();
										$('#project-summary').show();
										$('html, body').animate({ scrollTop: $('#project-summary').offset().top });
									} else {
										$('#budget').after('<span class="error-msg">The budget cannot be smaller than zero<span>');
										scroll_to_error('#budget');
									}
								} else {
									$('#location').after('<span class="error-msg">Select a location<span>');
									scroll_to_error('#location');
								}
							} else {
								$('#end_date').after('<span class="error-msg">The end date cannot be before the start date<span>');
								scroll_to_error('#end_date');
							}
						} else {
							$('#end_date').after('<span class="error-msg">Select a valid date<span>');
							scroll_to_error('#end_date');
						}
					} else {
						$('#start_date').after('<span class="error-msg">The start date must be in the future<span>');
						scroll_to_error('#start_date');
					}
				} else {
					$('#start_date').after('<span class="error-msg">Select a valid date<span>');
					scroll_to_error('#start_date');
				}
			} else {
				$('#description').after('<span class="error-msg">The project description must contain at least 5 characters<span>');
				scroll_to_error('#description');
			}
		} else {
			$('#title').after('<span class="error-msg">The project title must contain at least 3 characters<span>');
			scroll_to_error('#title');
		}
	});

	$('.project-back').on('click', function() {
		$('#project-summary').hide();
		$('#project-details').show();
		$('html, body').animate({ scrollTop: $('#project-details').offset().top });
	});

	function scroll_to_error($element_id) {
		$($element_id).addClass('error-field');
		$('html, body').animate({
		    scrollTop: $($element_id).offset().top - 100
		}, 500);
	}

	function load_summary() {
		$('#title_summary').text($('#title').val());
		$('#description_summary').text($('#description').val());
		$('#start_date_summary').text($('#start_date').val());
		$('#end_date_summary').text($('#end_date').val());
		$('#location_summary').text(locations[$('#location').val()]);
		var budget = $('#budget').val();
		if(!budget || budget.length == 0) {
			$('#budget_summary').text('£0');
		} else {
			$('#budget_summary').text('£' + budget);
		}
	}

	$('#start_date').on('change keyup paste click', function(){
		var d = new Date($(this).val());
		d.setDate(d.getDate() + 1);
		$('#end_date').attr({'min' : d.getFullYear() + '-' + ("0" + (d.getMonth() + 1)).slice(-2) + '-' + ("0" + d.getDate()).slice(-2) });
	});

	$('#normal').on('change keyup paste click', function(){
		$('#priority_summary').text('Normal');
	});

	$('#high').on('change keyup paste click', function(){
		$('#priority_summary').text('High');
	});

	$('#confidential').on('change keyup paste click', function(){
		$('#priority_summary').text('Confidential');
	});

	$('#budget').on('change keyup paste keydown', function(e) {
	    if(!((e.keyCode > 95 && e.keyCode < 106)
	      || (e.keyCode > 47 && e.keyCode < 58) 
	      || e.keyCode == 8 || e.keyCode == 17 || e.keyCode == 46) || e.keyCode == 189) {
	       	return false;
	    }
	});
	
});
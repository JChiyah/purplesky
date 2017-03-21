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
									// All okay, continue
									$('#project-details').hide();
									$('#project-summary').show();
									$('html, body').animate({ scrollTop: $('#project-summary').offset().top });
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

	$('#title').on('change keyup paste click', function(){
		$('#title_summary').text($(this).val());
	});

	$('#description').on('change keyup paste click', function(){
		$('#description_summary').text($(this).val());
	});

	// first initialise
	/*$('#end_date').datepicker({
	     MinDate: tomorrow
	});*/
	$('#start_date').on('change keyup paste click', function(){
		$('#start_date_summary').text($(this).val());

		var d = new Date($(this).val());
		d.setDate(d.getDate() + 1);
		$('#end_date').attr({'min' : d.getFullYear() + '-' + ("0" + (d.getMonth() + 1)).slice(-2) + '-' + ("0" + d.getDate()).slice(-2) });
	});

	$('#end_date').on('change keyup paste click', function(){
		$('#end_date_summary').text($(this).val());
	});

	$('#location').on('change keyup paste click', function(){
		// getting the location from a json value
		$('#location_summary').text(locations[$(this).val()]);
	});

	$('#normal').on('change keyup paste click', function(){
		$('#priority_summary').text('Normal');
	});

	$('#high').on('change keyup paste click', function(){
		$('#priority_summary').text('High');
	});

	$('#budget').on('change keyup paste click', function(){
		$('#budget_summary').text('£' + $(this).val());
	});
	
});
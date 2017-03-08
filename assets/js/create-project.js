$(function() {

	// Skills selected
	var skills = [];
	var current_query = [];

	// Staff selected
	var staff = [];
	var staff_ids = [];

	function create_hidden_inputs() {

		// Empty html
		$('#hidden-inputs').html();
		// New hidden values
		for(var i = 0; i < staff.length; i++) {
			$('#hidden-inputs').append('<input type="hidden" name="allocated_staff[]" value="' + staff[i].join(',') + '">');
		}
	}

	function validate_dates(start_date, end_date) {
		var now = new Date();
		var d1 = new Date(start_date);
		var d2 = new Date(end_date);

		return d2.getTime() >= d1.getTime() && (d1.getTime() >= now.getTime());
	}

	// Project step
	var create_project_flag = 2;
	// Button to change steps
	$('.project-continue').on('click', function() {
		if(create_project_flag == 1) {

			$('.error-msg').hide();
			// Check if all fields are done and show error where needed
			if($('#title').val()) {
				if(validate_dates($('#start_date').val(), $('#end_date').val())) {
					if($('#location').val() != 0) {
						// All okay, continue
						$('#create-1').hide();
						$('#create-2').show();
						create_project_flag = 2;
						$('html, body').animate({ scrollTop: "0px" });
					} else {
						$('#location').after('<span class="error-msg">Please select a location<span>');
					}
				} else {
					$('#project-dates').after('<span class="error-msg">Please select valid dates<span>');
				}
			} else {
				$('#title').after('<span class="error-msg">Please give a project title<span>');
			}
		} else if(create_project_flag == 2) {
			$('#create-2').hide();
			$('#create-3').show();
			create_project_flag = 3;
			$('html, body').animate({ scrollTop: "0px" });
			create_hidden_inputs();
		} else if(create_project_flag == 3) {
			
		}
	});

	$('.project-back').on('click', function() {
		if(create_project_flag == 1) {

		} else if(create_project_flag == 2) {
			$('#create-2').hide();
			$('#create-1').show();
			create_project_flag = 1;
			$('html, body').animate({ scrollTop: "0px" });
		} else if(create_project_flag == 3) {
			$('#create-3').hide();
			$('#create-2').show();
			create_project_flag = 2;
			$('html, body').animate({ scrollTop: "0px" });
		}
	});

	function search_staff() {
		event.preventDefault();
		var staff_name = $('#staff_name').val();
		var location = 1;//$('#location').val();
		
		if(skills.length > 0 || staff_name) {
			var start_date = $('#staff_start_date').val();
			var end_date = $('#staff_end_date').val();

			if(start_date && end_date) {

				if(validate_dates(start_date, end_date) && validate_dates($('#start_date').val(), end_date) 
					&& validate_dates(end_date, $('#end_date').val())) {

					$.ajax({
						type: "POST",
						url: baseurl + "User/search_staff",
						data: { 
							'skill' : skills,
							'start_date' : start_date,
							'end_date' : end_date,
							'staff_name' : staff_name,
							'staff_ids' : staff_ids,
							'location' : location,
							'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
						},
						success: function(data) {
							if (data) {
								$("#results").html(data);
								current_query = [start_date, end_date, skills.join('|')];
							} else {
								$("#results").html('<p>No staff available.</p>');
								current_query = [];
							}
						},
					    /*error: function(req, textStatus, errorThrown) {
					        // To debug when an error happens (possibly a code 500 error)
					        console.error('Ooops, something happened: ' + textStatus + ' ' +errorThrown);
					    }*/
					});
				} else {
					$("#results").html('<p>Start date must be before end date and within the project dates.</p>');
				}
			} else {
				$("#results").html('<p>Select valid dates.</p>');
			}
		} else {
			// No skills added
			$("#results").html('<p>Select skills to start the search or enter a name.</p>');
		}
	}

	// Calls the search staff when the button is clicked
	$("#staff-allocation-search").click(search_staff);

	$('#skill_select').on('change', function() {
		var e = document.getElementById("skill_select");
		var skill = e.options[e.selectedIndex].text;
		if(this.value != 0) {
			if(!skills.includes(this.value)) {
				$("#selected-skills").append('<span class="skill-span">' + 
					skill + '</span>');

				skills.push(this.value);
			}
			// else repeated element 
		}
	})

	$('#clear-skills').click(function(event) {
		skills = [];
		$('#skill_select').val(0);
		$("#selected-skills").html('');
	});

	// $body instead of click for better support of dynamic content
	$('body').on('click', '.allocate-staff-button', function() {
		// Get staff id from parsing the button's parent id
		var id = (($(this).parent().parent().attr('id')).split("-"))[1];

		// User is adding staff
		if($('#results').find('#staff-' + id).length) {
			$('#staff-' + id).appendTo($('#staff-added'));
			$(this).html('Remove');
			// Add staff id and other info to the queue
			var staff_info = current_query.slice();
			staff_info.unshift(id);
			staff.push(staff_info);
			staff_ids.push(id);

			// Show staff in summary
			// clone div -> change id -> append to summary -> remove the button
			$('#staff-' + id).clone().attr('id', 'allocated-staff-' + id).appendTo('#allocated-staff');
			$('#allocated-staff-' + id + ' > button').remove();
			$('#allocated-staff-' + id).append( /*** Add here more info if needed ***/ );
		}
		// User is removing staff
		else if($('#staff-added').find('#staff-' + id).length) {
			// Delete from array
			staff = $.grep(staff, function(value) {
				return value[0] != id;
			});
			staff_ids = $.grep(staff_ids, function(value) {
				return value != id;
			});
			// Refresh search results
			$('#staff-' + id).remove();
			search_staff();

			// Remove from summary
			$('#allocated-staff-' + id).remove();			
		}
		// else something is not right...
	});

	// Show search by name
	$('#search-name-toggle').on('click', function() {
    	$('#search-name').slideToggle(500, function() {
	        if ($('#search-name').is(':visible')) {
	            $('#search-name-toggle').text('Hide');
	        } else {
	            $('#search-name-toggle').text('Search by name');
	            $('#staff_name').val('');
        	}
    	});
	});

	$('#title').on('change keyup paste click', function(){
		$('#title_summary').text($(this).val());
	});

	$('#description').on('change keyup paste click', function(){
		$('#description_summary').text($(this).val());
	});

	$('#start_date').on('change keyup paste click', function(){
		$('#staff_start_date').val($(this).val());
		$('#start_date_summary').text($(this).val());
	});

	$('#end_date').on('change keyup paste click', function(){
		$('#staff_end_date').val($(this).val());
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

	/* Remember: add js to stop users from continuing before the first part is done */
	
});
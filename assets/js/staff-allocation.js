$(function() {

	// Skills selected
	var skills = [];
	var current_query = [];

	function validate_search() {

		$('.error-msg').hide();
		$('.error-field').removeClass('error-field');

		if(skills.length > 0 || $('#staff_name').val()) {
			var now = new Date();
			var start = new Date($('#staff_start_date').val());
			var end = new Date($('#staff_end_date').val());

			if(!isNaN(start)) {

				if(now.getTime() <= start.getTime()) {

					if(!isNaN(end)) {

						if(start.getTime() <= end.getTime()) {
							// All okay, continue
							return true;

						} else {
							$('#staff_end_date').after('<span class="error-msg">The end date cannot be before the start date<span>');
							$('#staff_end_date').addClass('error-field');
						}
					} else {
						$('#staff_end_date').after('<span class="error-msg">Select a valid date<span>');
						$('#staff_end_date').addClass('error-field');
					}
				} else {
					$('#staff_start_date').after('<span class="error-msg">The start date must be in the future<span>');
					$('#staff_start_date').addClass('error-field');
				}
			} else {
				$('#staff_start_date').after('<span class="error-msg">Select a valid date<span>');
				$('#staff_start_date').addClass('error-field');
			}
		} else {
			// No skills added
			$('#skill_select').after('<span class="error-msg">Select a skill to start the search<span>');
			$('#skill_select').addClass('error-field');
		}
	}

	function search_staff() {
		event.preventDefault();
		
		if(validate_search()) {

			$.ajax({
				type: "POST",
				url: baseurl + "User/search_staff",
				data: { 
					'skill' : skills,
					'start_date' : start_date,
					'end_date' : end_date,
					'staff_name' : staff_name,
					'location' : $('#search-staff-location').val(),
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
				}/*,
			    error: function(req, textStatus, errorThrown) {
			        // To debug when an error happens (possibly a code 500 error)
			        console.error('Ooops, something happened: ' + textStatus + ' ' +errorThrown);
			    }*/
			});
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
			$('#allocated-staff').append('<hr id="hr-' + id + '"">');
			$('#allocated-staff-' + id + ' > div > button').remove();
			$('#allocated-staff-' + id).append('');
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
			$('#hr-' + id).remove();

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

	function reset_forms() {

		$('.tab').hide();

	}

	$('#left-bar > ul > li > button').click(function() {

		reset_forms();

		switch($(this).attr('id')) {
			case 'add':
				$('#add-staff').show();
				break;
			case 'edit':
				$('#edit-staff').show();
				break;
			case 'status':
				$('#project-status').show();
				break;
			default:

		}
	});



});

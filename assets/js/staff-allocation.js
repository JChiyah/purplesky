$(function() {

	// Skills selected
	var skills = [];
	var current_query = [];

	function format_date(date) {
		var d = new Date(date);
		return d.getDate() + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
	}

	function validate_search() {

		$('.error-msg').hide();
		$('.error-field').removeClass('error-field');

		if(skills.length > 0 || $('#staff_name').val()) {
			var now = new Date();
			var start = new Date($('#staff_start_date').val());
			var end = new Date($('#staff_end_date').val());

			if(!isNaN(start)) {

				//if(now.getTime() <= start.getTime()) {

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
				/*} else {
					$('#staff_start_date').after('<span class="error-msg">The start date must be in the future<span>');
					$('#staff_start_date').addClass('error-field');
				}*/
			} else {
				$('#staff_start_date').after('<span class="error-msg">Select a valid date<span>');
				$('#staff_start_date').addClass('error-field');
			}
		} else {
			// No skills added
			$('#clear-skills').after('<span class="error-msg">Select a skill to start the search<span>');
			$('#skill_select').addClass('error-field');
		}
		$("#results").html('');
	}

	function search_staff() {
		event.preventDefault();
		
		current_query = [];
		if(validate_search()) {

			$.ajax({
				type: "POST",
				url: baseurl + "User/search_staff",
				data: { 
					'skill' : skills,
					'start_date' : $('#staff_start_date').val(),
					'end_date' : $('#staff_end_date').val(),
					'staff_name' : $('#staff_name').val(),
					'location' : $('#staff-location').val(),
					'project_id' : $('#project_id').val(),
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(data) {
					if (data) {
						$("#results").html(data);
						current_query = [$('#staff_start_date').val(), $('#staff_end_date').val(), skills];
						//alert(current_query);
					} else {
						$("#results").html('<p>No staff available</p>');
					}
					$("#search-results").show();
				},
			    error: function(req, textStatus, errorThrown) {
			        // To debug when an error happens (possibly a code 500 error)
			        console.error('Ooops, something happened: ' + textStatus + ' ' +errorThrown);
			    }
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
				$("#selected-skills").append('<span class="skill-span-b">' + 
					skill + '</span>');

				skills.push(this.value);
			}
			// else repeated element 
		}
	});

	$('#clear-skills').click(function(event) {
		skills = [];
		$('#skill_select').val(0);
		$("#selected-skills").html('');
	});

	// $body instead of click for better support of dynamic content
	$('body').on('click', '.allocate-staff-button', function() {
		// Get staff id from parsing the button's parent id
		var id = (($(this).parent().parent().attr('id')).split("-"))[1];

		if(!id) {
			alert(id);
			return ;
		}
		$('#search-results').hide();
		$('#search-staff-form').parent().hide();
		$('#allocate-staff-form').parent().show();

		// Put values
		$('#staff_name_summary').text($('#staff-' + id + ' > h5').text());

		$('#staff_start_date_summary').text(format_date(current_query[0]));
		$('#staff_end_date_summary').text(format_date(current_query[1]));

		$('#skills_summary').html('');
		$('#staff-' + id + ' > div > #skill-set').clone().appendTo($('#skills_summary'));

		$('#skill-set > .skill-span').addClass('skill-span-b');
		$('#skill-set > .skill-span').removeClass('skill-span');

		$('#staff_id').val(id);
	});

	$("#staff-allocation-submit").click(function(e) {
		e.preventDefault();

		$.ajax({
			type: "POST",
			url: baseurl + "Project/add_project_staff",
			data: { 
				'project_id' : $('#project_id').val(),
				'staff_id' : $('#staff_id').val(),
				'skills' : current_query[2],
				'start_date' : $('#staff_start_date').val(),
				'end_date' : $('#staff_end_date').val(),
				'role' : $('#staff_role').val(),
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function(data) {
				if (data == 'success') {
					$("#allocate-staff-form").parent().hide();
					$("#staff-added-confirm").show();
				} else {
					$("#allocate-staff-form").after('<p>Something went wrong:' + data + '</p>');
				}
			}
		});
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

	$('#back-add').click(function() {
		$('#allocate-staff-form').parent().hide();
		$('#search-results').show();
		$('#search-staff-form').parent().show();
	});

	/*$("#profile-popup").dialog({
	    autoOpen : false, modal : true, show : "blind", hide : "blind", width : "500"
	});*/

	$('body').on('click', '.staff-profile', function() {
		var id = (($(this).parent().parent().attr('id')).split("-"))[1];

		load_profile(id);

		var name = $('#staff-' + id + ' > .staff-name').text();

		$('#profile-popup').dialog({ title : name, width: '900' });
		return false;
	});

	/* Loads a user profile */
	function load_profile(id) {
		$.ajax({
			type: "POST",
			url: baseurl + "User/show_profile",
			data: { 
				'user_id' : id,
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function(data) {
				if (data) {
					$("#profile-popup").html(data);
				} else {
					alert("h");
				}
			}
		});
	}

});

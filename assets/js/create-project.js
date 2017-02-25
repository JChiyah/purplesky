$(function() {

	// Project step
	var create_project_flag = 2;
	// Button to change steps
	$('#project-continue').on('click', function() {
		if(create_project_flag == 1) {
			$('#create-1').hide();
			$('#create-2').show();
			create_project_flag = 2;
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

	// Skills selected
	var skills = [];

	// Staff selected
	var staff = [];

	function search_staff() {
		event.preventDefault();
		var staff_name = $('#staff_name').val();
		
		//if(skills.length > 0 || staff_name) {
			var start_date = $('#staff_start_date').val();
			var end_date = $('#staff_end_date').val();

			//if(start_date && end_date) {
				$.ajax({
					type: "POST",
					url: baseurl + "User/search_staff",
					data: { 
						'skill' : skills,
						'start_date' : start_date,
						'end_date' : end_date,
						'staff_name' : staff_name,
						'staff_ids' : staff,
						'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
					},
					success: function(data) {
						if (data) {
							$("#results").html(data);
						} else {
							$("#results").html('<p>No staff available.</p>');
						}
					},
				    error: function(req, textStatus, errorThrown) {
				        // To debug when an error happens (possibly a code 500 error)
				        console.error('Ooops, something happened: ' + textStatus + ' ' +errorThrown);
				    }
				});/*
			} else {
				$("#results").html('<p>Select valid dates.</p>');
			}
		} else {
			// No skills added
			$("#results").html('<p>Select skills to start the search or enter a name.</p>');
		}*/
	}

	// Calls the search staff when the button is clicked
	$("#staff-allocation-search").click(search_staff);

	$('#skill_select').on('change', function() {
		var e = document.getElementById("skill_select");
		var skill = e.options[e.selectedIndex].text;
		if(this.value != 0) {
			$("div#selected-skills").append('<span class="skill-span">' + 
				skill + '<i class="fa fa-times fa-lg delete-tag" aria-hidden="true"></i></span>');

			skills.push(this.value);
		}
	})

	$('#clear-skills').click(function(event) {
		skills = [];
		$('#skill_select').val(0);
		$("div#selected-skills").html('');
	});

	// $body instead of click for better support of dynamic content
	$('body').on('click', '.allocate-staff-button', function() {
		// Get staff id from parsing the button id
		var id = ((this.id).split("-"))[2];

		// User is adding staff
		if($('#results').find('#staff-' + id).length) {
			$('#staff-' + id).appendTo($('#staff-added'));
			$('#staff-button-' + id).html('Remove');
			staff.push(id);
		}
		// User is removing staff
		else if($('#staff-added').find('#staff-' + id).length) {
			// Delete from array
			staff = jQuery.grep(staff, function(value) {
				return value != id;
			});
			// Refresh search results
			$('#staff-' + id).remove();
			search_staff();
		}
		// else something is not right...
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
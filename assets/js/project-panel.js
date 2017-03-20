$(function() {

	function get_project_staff() {
		$.ajax({
			type: "POST",
			url: baseurl + "Project/get_project_staff",
			data: { 
				'project_id' : $('#project_id').val(),
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function(data) {
				if (data) {
					$("#project-staff").html(data);
				}
			}
		});
	}
	get_project_staff();

	$("#dashboard-entry-submit").click(function(event) {
		event.preventDefault();
		//$('.error-msg').remove();
		//$('#skill_select').removeClass('error-field');
		$.ajax({
			type: "POST",
			url: baseurl + "Project/add_dashboard_entry",
			data: {
				'project_id' : $('#project_id').val(),
				'description' : $('#entry-description').val(),
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function(res) {
				if(res) {
					$('#new-entry').hide();
					$('#another-entry').show();
				}
			}, error: function(req, textStatus, errorThrown) {
		        // To debug when an error happens (possibly a code 500 error)
		        console.error('Ooops, something happened: ' + textStatus + ' ' +errorThrown);
		    }
		});
	});

	function validate_project() {
		$('.error-msg').hide();
		$('.error-field').removeClass('error-field');
		// Check if all fields are done and show error where needed
		if($('#title').val().length > 2) {
			var now = new Date();
			var start = new Date($('#start_date').val());
			var end = new Date($('#end_date').val());

			if(!isNaN(start)) {

				if(now.getTime() <= start.getTime()) {

					if(!isNaN(end)) {

						if(start.getTime() <= end.getTime()) {
							// All okay, continue
							return true;

						} else {
							$('#end_date').after('<span class="error-msg">The end date cannot be before the start date<span>');
							$('#end_date').addClass('error-field');
						}
					} else {
						$('#end_date').after('<span class="error-msg">Select a valid date<span>');
						$('#end_date').addClass('error-field');
					}
				} else {
					$('#start_date').after('<span class="error-msg">The start date must be in the future<span>');
					$('#start_date').addClass('error-field');
				}
			} else {
				$('#start_date').after('<span class="error-msg">Select a valid date<span>');
				$('#start_date').addClass('error-field');
			}
		} else {
			$('#title').after('<span class="error-msg">The project title must contain at least 3 characters<span>');
			$('#title').addClass('error-field');
		}
		return false;
	}

	// Button to continue 
	$('.project-continue').on('click', function() {
		if(validate_project()) {
			// All okay, continue
			$('#edit-details').hide();
			$('#project-summary').show();

			$.ajax({
				type: "POST",
				url: baseurl + "Project/update_project_changes",
				data: {
					'project_id' : $('#project_id').val(),
					'title' : $('#title').val(),
					'description' : $('#description').val(),
					'start_date' : $('#start_date').val(),
					'end_date' : $('#end_date').val(),
					'location' : $('#location').val(),
					'priority' : $('input[name=priority]:checked').val(),
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(res) {
					if(res) {
						$('#title_summary').before(res);
					}
				}/*, error: function(req, textStatus, errorThrown) {
			        // To debug when an error happens (possibly a code 500 error)
			        console.error('Ooops, something happened: ' + textStatus + ' ' +errorThrown);
			    }*/
			});
		}
	});

	$('.project-back').on('click', function() {
		$('#project-summary').hide();
		$('#edit-details').show();
	});

	$("#edit-project-submit").click(function(event) {
		event.preventDefault();			

		if(!validate_project()) {
			// Extra security
			$('#edit-details').show();
			$('#project-summary').hide();

		} else {
			var project_id = $('#project_id').val();

			$.ajax({
				type: "POST",
				url: baseurl + "Project/update_project",
				data: {
					'project_id' : project_id,
					'title' : $('#title').val(),
					'description' : $('#description').val(),
					'start_date' : $('#start_date').val(),
					'end_date' : $('#end_date').val(),
					'location' : $('#location').val(),
					'priority' : $('input[name=priority]:checked').val(),
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(res) {
					if(res === 'success') {
						window.location.replace(baseurl + 'project-management/' + project_id + '/action-edit');
					}
				}/*, error: function(req, textStatus, errorThrown) {
			        // To debug when an error happens (possibly a code 500 error)
			        console.error('Ooops, something happened: ' + textStatus + ' ' +errorThrown);
			    }*/
			});
		}
	});

	function reset_forms() {

		if($('#project-confirmation').is(':visible')) {
			$('#project-confirmation').hide();
			$('#edit-details').show();
		} else if('#staff-added-confirm:visible') {
			$('#search-results').hide();
			$('#allocate-staff-form').hide();
			$('#staff-added-confirm').hide();
			$('#search-staff-form').show();
		}
		$('.tab').hide();
		$('.active').removeClass('active');

	}

	$('#left-bar > ul > li > button').click(function() {

		reset_forms();

		switch($(this).attr('id')) {
			case 'staff':
				$('#see-staff').show();
				$('#staff').addClass('active');
				break;
			case 'tasks':
				$('#see-tasks').show();
				$('#tasks').addClass('active');
				break;
			case 'notification':
				$('#dashboard-entry').show();
				$('#notification').addClass('active');
				break;
			case 'edit':
				$('#edit-project').show();
				$('#edit-details').show();
				$('#edit').addClass('active');
				break;
			case 'status':
				$('#project-status').show();
				$('#status').addClass('active');
				break;
			case 'task':
				$('#add-task').show();
				$('#task').addClass('active');
				break;
			case 'add':
				$('#add-staff').show();
				$('#add').addClass('active');
				break;
			case 'edit-s':
				$('#edit-staff').show();
				$('#edit-s').addClass('active');
				break;
			case 'remove':
				$('#remove-staff').show();
				$('#remove').addClass('active');
				break;
			default:

		}
	});

	$('#another-entry > button').click(function() {
		$('#new-entry').show();
		$('#another-entry').hide();
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

});

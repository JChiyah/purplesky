$(document).ready(function() {

	$("#profile-popup").dialog({
		bgiframe: true,
		autoOpen: false,
		resizable: false,
        draggable: false,
		width: "auto",
	    dialogClass : "profile-popup",
	    modal: true,
        open: function(){
            jQuery('.ui-widget-overlay').bind('click',function(){
                jQuery('#profile-popup').dialog('close');
            })
        }
	});

	$("#confirmation-popup").dialog({
		bgiframe: true,
		autoOpen: false,
		resizable: false,
        draggable: false,
        title: 'Confirm Action',
		width: '350px',
	    dialogClass : "profile-popup",
	    modal: true,
        open: function(){
            jQuery('.ui-widget-overlay').bind('click',function(){
                jQuery('#confirmation-popup').dialog('close');
            })
        }
	});

});

$(function() {

	/** Get staff working at the current project and display it on the staff tab **/
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


	/** Get applications sent to the current project and display them in the applications tab **/
	function get_project_applications() {
		$.ajax({
			type: "POST",
			url: baseurl + "Project/get_project_applications",
			data: { 
				'project_id' : $('#project_id').val(),
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function(data) {
				if (data) {
					$("#project-applications").html(data);
				}
			}
		});
	}
	get_project_applications();

	/** Get staff working at the current project and display it on the remove staff tab **/
	function get_remove_project_staff() {
		$.ajax({
			type: "POST",
			url: baseurl + "Project/get_remove_project_staff",
			data: { 
				'project_id' : $('#project_id').val(),
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function(data) {
				if (data) {
					$("#project-remove-staff").html(data);
				}
			}
		});
	}
	get_remove_project_staff();

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
					$('#new-entry').parent().hide();
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

				if($('#start_date').is('[disabled=disabled]') || (now.getTime() <= start.getTime())) {

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
						window.location.replace(baseurl + 'project-management/' + project_id + '/edit');
					}
				}/*, error: function(req, textStatus, errorThrown) {
			        // To debug when an error happens (possibly a code 500 error)
			        console.error('Ooops, something happened: ' + textStatus + ' ' +errorThrown);
			    }*/
			});
		}
	});

	$("#edit-application-status-submit").click(function(event) {
		event.preventDefault();
		
		var project_id = $('#project_id').val();
		$.ajax({
			type: "POST",
			url: baseurl + "Project/update_project_applications",
			data: {
				'project_id' : project_id,
				'status' : $('#application_status option:selected').text(),
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function(res) {
				if(res === 'success') {
					window.location.replace(baseurl + 'project-management/' + project_id + '/application-status');
				}
			}, error: function(req, textStatus, errorThrown) {
		        // To debug when an error happens (possibly a code 500 error)
		        console.error('Ooops, something happened: ' + textStatus + ' ' +errorThrown);
		    }
		});
	});

	$("#edit-status-submit").click(function(event) {
		event.preventDefault();
		
		var project_id = $('#project_id').val();
		$.ajax({
			type: "POST",
			url: baseurl + "Project/update_project_status",
			data: {
				'project_id' : project_id,
				'status' : $('#project_status option:selected').text(),
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function(res) {
				if(res === 'success') {
					window.location.replace(baseurl + 'project-management/' + project_id + '/status');
				}
			}, error: function(req, textStatus, errorThrown) {
		        // To debug when an error happens (possibly a code 500 error)
		        console.error('Ooops, something happened: ' + textStatus + ' ' +errorThrown);
		    }
		});
	});

	$('body').on('click', '.staff-profile', function() {
		var e = ($(this).parent().attr('id')).split("-");

		load_profile(e[1]);
		
		$('#profile-popup').dialog({title : e[2]});

		$('#profile-popup').dialog("open");

		$('#profile-popup').dialog("option", "position", {
			my: "center",
			at: "center",
			of: window
		});

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

					$('#profile-popup').dialog("option", "position", {
						my: "center",
						at: "center",
						of: window
					});
				}
			}
		});
	}

	function reset_forms() {

		if($('#project-confirmation').is(':visible')) {
			$('#project-confirmation').hide();
			$('#edit-details').parent().parent().show();
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
				get_project_staff();
				$('#see-staff').show();
				$('#staff').addClass('active');
				window.location.replace(baseurl + 'project-management/' + $('#project_id').val());
				break;
			case 'applications':
				get_project_applications();
				$('#see-applications').show();
				$('#applications').addClass('active');
				break;
			case 'application-status':
				$('#project-application-status').show();
				$('#application-status').addClass('active');
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
			case 'add':
				$('#add-staff').show();
				$('#add').addClass('active');
				window.location.replace(baseurl + 'project-management/' + $('#project_id').val() + '/add-staff');
				break;
			case 'remove':
				$('#remove-staff').show();
				$('#remove').addClass('active');
				break;
			default:

		}
	});

	$('#another-entry > button').click(function() {
		$('#new-entry').parent().show();
		$('#another-entry').hide();
		$('#entry-description').val('');
	});

	$('#another-status > button').click(function() {
		$('#edit-status').parent().show();
		$('#another-status').hide();
	});

	$('#another-application-status > button').click(function() {
		$('#application-status-form').parent().show();
		$('#another-application-status').hide();
	});

	$('#confirm-see-staff').click(function() {
		reset_forms();
		get_project_staff();
		$('#see-staff').show();
		$('#staff').addClass('active');
		window.location.replace(baseurl + 'project-management/' + $('#project_id').val());
	});

	$('#confirm-add-staff').click(function() {
		$('#search-results').hide();
		$('#allocate-staff-form').parent().hide();
		$('#staff-added-confirm').hide();
		$('#search-staff-form').parent().show();
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

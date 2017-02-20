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

	$("#staff-allocation-search").click(function(event) {
		event.preventDefault();

		if(skills.length > 0) {
			$.ajax({
				type: "POST",
				url: baseurl + "User/search_staff",
				data: { 
					'skill' : skills,
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(data) {
					if (data) {
						$("#results").html(data);
					} else {
						$("#results").html('<p>No staff available.</p>');
					}
				}
			});
		} else {
			// No skills added
			$("#results").html('<p>Select skills to start the search.</p>');
		}
	});

	$('#skill_select').on('change', function() {
		var e = document.getElementById("skill_select");
		var skill = e.options[e.selectedIndex].text;
		$("div#selected-skills").append('<span class="skill-span">' + 
			skill + '<i class="fa fa-times fa-lg delete-tag" aria-hidden="true"></i></span>');

		skills.push(this.value);
	})

	$('#clear-skills').click(function(event) {
		skills = [];
		$("div#selected-skills").html('');
	});

	$('#title').on('change keyup paste click', function(){
		$('#title_summary').text($(this).val());
	});

	$('#description').on('change keyup paste click', function(){
		$('#description_summary').text($(this).val());
	});

	$('#start_date').on('change keyup paste click', function(){
		$('#start_date_summary').text($(this).val());
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

	/* Remember: add js to stop users from continuing before the first part is done */
	
});
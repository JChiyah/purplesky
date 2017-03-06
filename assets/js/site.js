$(function() {

	$('body').on('click', '.delete-tag', function() {
		var e = $(this).parent();
		var skill = e.text();
		$.ajax({
			type: "POST",
			url: baseurl + "User/delete_user_skill",
			data: {
				'delete_skill' : skill,
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function(res) {
				if (res) {
					$("#user-skills").html(res);
					$('.delete-tag').toggle();
				}
			}
		});
	});

	$("#skill-submit").click(function(event) {
		event.preventDefault();
		var e = document.getElementById("skill_select");
		var skill = e.options[e.selectedIndex].text;
		$.ajax({
			type: "POST",
			url: baseurl + "User/add_user_skill",
			data: {
				'skill' : skill,
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function(res) {
				if (res) {
					$('.delete-tag').toggle();
					$("#user-skills").html(res);
					$('.delete-tag').toggle();
				}
			}
		});
	});

	$("#experience-submit").click(function(event) {
		event.preventDefault();
		// form validation
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		var title = $('#title').val();
		var description = $('#description').val();
		var role = $('#role').val();

		if(start_date && end_date && title && description && role) {
			$.ajax({
				type: "POST",
				url: baseurl + "User/add_user_experience",
				data: {
					'start_date' : start_date,
					'end_date' : end_date,
					'title' : title,
					'description' : description,
					'role' : role,
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(res) {
					if (res) {
						$('#experiences').html(res);
						$('#experience-add').slideToggle().css({'visibility': 'visible', 'display': 'block'});
						$('#experience-add')[0].reset();
					}
				}
			});
		} else {
			$('#experience-msg').text('Please fill out all fields');
		}
	});

	$('body').on('click', '.delete-experience-tag', function() {
		var id = $(this).parent().parent().attr('id');
		id = id.split("-");
		id = id[1];
		if(!isNaN(id)) {

			// call AJAX
			$.ajax({
				type: "POST",
				url: baseurl + "User/delete_user_experience",
				data: {
					'delete_experience' : id,
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(res) {
					if (res) {
						$('#experiences').html(res);
					}
				}
			});
		}
	});

	$("#search-submit").click(function(event) {
		event.preventDefault();
		// form validation
		var keyword = $('#keyword').val();
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		var location = $('#location').val();

		// flag to control search options
		if ($('#advanced-search').is(':visible')) {
			var filter = true;
		} else {
			var filter = false;
		}

		// Check whether the user entered a keyword or is filtering projects
		if(keyword || filter) {

			$.ajax({
				type: "POST",
				url: baseurl + "Project/search_projects",
				data: {
					'keyword' : keyword,
					'start_date' : start_date,
					'end_date' : end_date,
					'location' : location,
					'filter' : filter,
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(data) {
					if (data) {
						$('#search-results').css({'display': 'block'});
						$("#results").html(data);
					} else {
						$("#results").html('<p>Nothing matches your search. Try to broaden your criteria.</p>');
					}
				}
			});
		} else {
			// User did not enter anything
			$("#results").html('<p>Please, fill out some fields to search</p>');
		}
	});

});

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
					e.remove();
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
					jQuery("div#skill-set").append(res);
					$('.delete-tag').toggle();
				}
			}
		});
	});

	$("#experience-submit").click(function(event) {
		event.preventDefault();
		// form validation
		var start_date = $('#start_date').value;
		var end_date = $('#end_date').value;
		var title = $('#title').value;
		var description = $('#description').value;
		var role = $('#role').value;

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
						alert(res);
					} else {
						alert(res);
					}
				}
			});
		} else {
			$('#experience-msg').text('Please fill out all fields');
		}
	});

	$('body').on('click', '.delete-experience', function() {
		//var id = $(this).attr('id');
		var id = "experience-6";
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
					if (res == 'success') {
						// Experience successfully deleted

					}
				}
			});
		}
	});

});
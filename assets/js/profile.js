$(function() {

	$("#skill-submit").click(function(event) {
		event.preventDefault();
		var e = document.getElementById("skill_select");
		var skill = e.options[e.selectedIndex].text;

		$('.error-msg').remove();
		$('#skill_select').removeClass('error-field');
		$.ajax({
			type: "POST",
			url: baseurl + "User/add_user_skill",
			data: {
				'skill' : skill,
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function(res) {
				if (res === 'duplicated') {
					$('#skill-submit').after('<span class="error-msg">Duplicated skill<span>');
					$('#skill_select').addClass('error-field');
				} else if(res) {
					$('.delete-tag').toggle();
					$("#user-skills").html(res);
					$('.delete-tag').toggle();
				}
			}
		});
	});

	var undo_skills = false;

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
					$('#user-skills').html(res);
					if(!undo_skills) {
						$('#user-undo-skills').html('<h3>Skills deleted:</h3><hr>');
						$('#user-undo-skills').append('<p>Click on the skill again to add it back</p>');
						undo_skills = true;
					}
					$('#user-undo-skills').append('<span class="undo-skill-span">' + skill + ' <i class="fa fa-undo fa-lg" aria-hidden="true"></i></span>');
					$('.delete-tag').toggle();
				}
			}
		});
	});

	$('body').on('click', '.undo-skill-span', function() {
		var e = $(this);
		var skill = e.text();

		$.ajax({
			type: "POST",
			url: baseurl + "User/add_user_skill",
			data: {
				'skill' : skill,
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function(res) {
				if(res !== 'duplicated') {
					$('.delete-tag').toggle();
					$("#user-skills").html(res);
					$('.delete-tag').toggle();
				}
				e.remove();
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

			if(validate_dates(start_date, end_date)) {
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
				$('#experience-msg').text('The dates are not valid');
			}
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
						$('.delete-experience-tag').toggle();
					}
				}
			});
		}
	});

	$('#password-edit').on('click', function() {
    	$('#password-form').slideToggle().css({'visibility': 'visible', 'display': 'block'});
	});

	$('#skill-edit').on('click', function() {
    	$('#skill-add').slideToggle().css({'visibility': 'visible', 'display': 'block'});
    	$('.delete-tag').toggle();
    	$('#user-undo-skills').html('');
    	undo_skills = false;
	});

	$('#experience-edit').on('click', function() {
    	$('#experience-add').slideToggle().css({'visibility': 'visible', 'display': 'block'});
    	$('.delete-experience-tag').toggle();    	
	});

	$('body').on('mouseenter mouseleave', '.delete-tag', function() {
	    $(this).parent().toggleClass('delete-hover');
	});

});
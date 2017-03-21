$(function() {

	var skills_flag = false;
	var exp_flag = false;

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
					$('#skill-submit').after('<span class="error-msg">You have already added this skill<span>');
					$('#skill_select').addClass('error-field');
				} else if(res) {
					$("#user-skills").html(res);
					if(skills_flag) {
						$('.delete-tag').toggle();
					}
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

	function validate_experience() {
		$('.error-msg').hide();
		$('.error-field').removeClass('error-field');
		// Check if all fields are done and show error where needed
		if($('#role').val().length > 4) {

			if($('#title').val().length > 4) {
				var start = new Date($('#start_date').val());
				var end = new Date($('#end_date').val());

				if(!isNaN(start)) {

					if(!isNaN(end)) {

						if(start.getTime() <= end.getTime()) {

							if($('#description').val().length > 4) {
								
								return true;

							} else {
								$('#description').after('<span class="error-msg">The description must contain at least 5 characters<span>');
								scroll_to_error('#description');
							}
						} else {
							$('#end_date').after('<span class="error-msg">The end date cannot be before the start date<span>');
							scroll_to_error('#end_date');
						}
					} else {
						$('#end_date').after('<span class="error-msg">Enter a valid date dd/mm/yyyy<span>');
						scroll_to_error('#end_date');
					}
				} else {
					$('#start_date').after('<span class="error-msg">Enter a valid date dd/mm/yyyy<span>');
					scroll_to_error('#start_date');
				}
			} else {
				$('#title').after('<span class="error-msg">The institution/company name must contain at least 5 characters<span>');
				scroll_to_error('#title');
			}
		} else {
			$('#role').after('<span class="error-msg">The role must contain at least 5 characters<span>');
			scroll_to_error('#role');
		}
	}

	function scroll_to_error($element_id) {
		$($element_id).addClass('error-field');
		$('html, body').animate({
		    scrollTop: $($element_id).offset().top - 100
		}, 500);
	}

	$("#experience-submit").click(function(event) {
		event.preventDefault();

		if(validate_experience()) {

			$.ajax({
				type: "POST",
				url: baseurl + "User/add_user_experience",
				data: {
					'start_date' : $('#start_date').val(),
					'end_date' : $('#end_date').val(),
					'title' : $('#title').val(),
					'description' : $('#description').val(),
					'role' : $('#role').val(),
					'skills' : skills,
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(res) {
					if (res) {
						$('#experiences').html(res);
						$('#add-experience-form').hide();
						$('#add-experience-form')[0].reset();
						$('#selected-skills').html('');
						skills = [];
						if(exp_flag) {
    						$('.delete-experience-tag').toggle();
						}
					}
				}
			});
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

	skills = [];

	$('#experience-skills').on('change', function() {
		var e = document.getElementById("experience-skills");
		var skill = e.options[e.selectedIndex].text;
		var id = this.value;
		if(id != 0) {
			if(!skills.includes(id)) {
				$("#selected-skills").append('<span class="skill-span-b" id="' + id + '">' + 
					skill + ' <i class="fa fa-times fa-lg experience-skills-delete" aria-hidden="true"></i></span>');

				skills.push(id);
			}
			// else repeated element 
		}
	});

	$('body').on('click', '.experience-skills-delete', function() {
		var id = $(this).parent().attr('id');
		$(this).parent().remove();

		skills.splice($.inArray(id, skills),1);
	});

	$('#clear-skills').click(function(event) {
		skills = [];
		$('#experience-skills').val(0);
		$("#selected-skills").html('');
	});

	$('#password-edit').on('click', function() {
    	$('#password-form').slideToggle().css({'visibility': 'visible', 'display': 'block'});
	});

	$('#skill-edit').on('click', function() {
    	$('.delete-tag').toggle();
    	$('#user-undo-skills').html('');
    	undo_skills = false;
    	skills_flag = !skills_flag;
	});

	$('#add-skill').on('click', function() {
	   	$('#add-skill-form').slideToggle().css({'display': 'block'});
	});

	$('#add-experience').on('click', function() {
    	$('#add-experience-form').slideToggle().css({'display': 'block'});
	});

	$('#experience-edit').on('click', function() {
    	$('.delete-experience-tag').toggle();
    	exp_flag = !exp_flag;
	});

	$('body').on('mouseenter mouseleave', '.delete-tag', function() {
	    $(this).parent().toggleClass('delete-hover');
	});

});
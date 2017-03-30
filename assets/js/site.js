$(function() {
	
	$('body').on('click', '#submit-application', function(e) {
		e.preventDefault();
			
		$('#apply-form').hide();
		$('#application').append('<i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>');

		$.ajax({
			type: "POST",
			url: baseurl + "Project/apply_to_project",
			data: {
				'project_id' : $('#project_id').val(),
				'message' : $('#message').val(),
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function(data) {
				if (data) {
					$('#application').html(data);
				} else {
					$('#application > i').remove();
					$('#apply-form').show();
				}
			}
		});
	});


});

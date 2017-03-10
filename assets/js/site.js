$(function() {

	/** Project dashboard **/
	$("#dashboard-entry-submit").click(function(event) {
		event.preventDefault();
		//$('.error-msg').remove();
		//$('#skill_select').removeClass('error-field');
		$.ajax({
			type: "POST",
			url: baseurl + "Project/add_dashboard_entry",
			data: {
				'project_id' : $('#project_id').val(),
				'description' : $('#description').val(),
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function(res) {
				if(res) {
					$("#dashboard_entries").html(res);
				}
			}, error: function(req, textStatus, errorThrown) {
		        // To debug when an error happens (possibly a code 500 error)
		        console.error('Ooops, something happened: ' + textStatus + ' ' +errorThrown);
		    }
		});
	});



});

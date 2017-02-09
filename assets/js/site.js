$(function() {

	$('#password-edit').on('click', function() {
    	$('#password-form').slideToggle().css({'visibility': 'visible', 'display': 'block'});
	});

	$('#skill-edit').on('click', function() {
    	$('#skill-add').slideToggle().css({'visibility': 'visible', 'display': 'block'});
    	$('.delete-tag').toggle();
	});

	$('body').on('click', '.delete-tag', function() {
		var e = $(this).parent();
		var skill = e.text();
		$.ajax({
			type: "POST",
			url: baseurl + "Main/delete_user_skill",
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

	$(".submit").click(function(event) {
		event.preventDefault();
		var e = document.getElementById("skill_select");
		var skill = e.options[e.selectedIndex].text;
		$.ajax({
			type: "POST",
			url: baseurl + "Main/add_user_skill",
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

	$('#search-toggle').on('click', function() {
    	$('#advanced-search').slideToggle(500, function() {
	        if ($('#advanced-search').is(':visible')) {
	            $('#search-toggle').text('Close advanced search');                
	        } else {
	            $('#search-toggle').text('Open advanced search');                
        	}
    	});
	});

});
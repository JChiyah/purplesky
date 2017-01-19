$(function() {

	$('#skill-edit').on('click', function() {
    	$('#skill-add').slideToggle().css({'visibility': 'visible', 'display': 'block'});
    	$('.delete-tag').toggle();
    });

	$('body').on('click', '.delete-tag', function() {
		var e = $(this).parent();
		var skill = e.text();
		$.ajax({
			type: "POST",
			url: baseurl + "/Main/delete_skill",
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

    	//
    });

	$(".submit").click(function(event) {
		event.preventDefault();
		var e = document.getElementById("skill_select");
		var skill = e.options[e.selectedIndex].text;
		$.ajax({
			type: "POST",
			url: baseurl + "/Main/add_user_skill",
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

});
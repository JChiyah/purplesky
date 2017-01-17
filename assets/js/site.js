$(function() {

	$('#skill-edit').on('click', function() {
    	$('#skill-add').slideToggle().css({'visibility': 'visible', 'display': 'block'});
    });

	$(".submit").click(function(event) {
		event.preventDefault();
		var skill_selected = $("input#skill_select").val();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>/Main/data_submit",
			data: { 
				skill: skill_selected,
				'<?php echo $this->security->get_csrf_token_name(); ?>' : 
                '<?php echo $this->security->get_csrf_hash(); ?>' },
			success: function(res) {
				if (res) {
					// Show Entered Value
					/*jQuery("div#result").show();
					jQuery("div#value").html(res.username);
					jQuery("div#value_pwd").html(res.pwd);*/
					alert("good");
				}
			}
		});
	});

});
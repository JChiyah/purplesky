$(function() {

	function validate_dates(start_date, end_date) {
		var now = new Date();
		var d1 = new Date(start_date);
		var d2 = new Date(end_date);

		return d2.getTime() >= d1.getTime() && (d1.getTime() <= now.getTime());
	}

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
						$('#results').html(data);
					} else {
						$('#results').html('<p>Nothing matches your search. Try to broaden your criteria.</p>');
					}
					$('html, body').animate({
					    scrollTop: $("#search-results").offset().top - 100
					}, 1000);
				}
			});
		} else {
			// User did not enter anything
			$("#results").html('<p>Please, fill out some fields to search</p>');
		}
	});

});

$(document).ready(function() {

	$("#project-popup").dialog({
		bgiframe: true,
		autoOpen: false,
		resizable: false,
        draggable: false,
		width: "auto",
	    dialogClass : "project-popup",
	    modal: true,
        open: function(){
            jQuery('.ui-widget-overlay').bind('click',function(){
                jQuery('#project-popup').dialog('close');
            })
        }
	});

});

$(function() {
	scroll_top();

	$('#search-toggle').on('click', function() {
    	$('#advanced-search').slideToggle(500, function() {
	        if ($('#advanced-search').is(':visible')) {
	            $('#search-toggle').html('<i class="fa fa-caret-up fa-2x" aria-hidden="true"></i>');
	        } else {
	            $('#search-toggle').html('<i class="fa fa-caret-down fa-2x" aria-hidden="true"></i>');
        	}
    	});
	});

	$(window).scroll(function() {
		scroll_top();
	});

	function scroll_top() {

        if ($('#search-toggle').offset().top < $(window).scrollTop() + $('#quick-search').height()) {
            $('#scroll-up:hidden').stop(true, true).fadeIn();
  			$('#scroll-up').css({'position': 'fixed', 'left': '0.5em'});
        } else {
            $('#scroll-up').stop(true, true).fadeOut();
  			$('#scroll-up').css({'position': 'fixed', 'left': '0.5em'});
        }
        if(($('#scroll-up').offset().top + $('#scroll-up').outerHeight() + 100) > $('#footer-center').offset().top
        	&& ($(window).scrollTop() > $('#search-results').offset().top)) {
  			$('#scroll-up').css({'position': 'absolute', 'left': '-1.3em'});
        }
	}
	
	$('#scroll-up').click(function() {
		$('html, body').animate({
		    scrollTop: $("#search").offset().top
		}, 500);
	})

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
			
			$('#search-results').css({'display': 'block'});
			$('#results').html('<i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>');

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

	$('body').on('click', '.project-quick-view', function() {
		var id = (($(this).parent().parent().parent().attr('id')).split("-"))[1];

		load_project(id);

		var ptitle = $('#project-' + id + ' > .row > h3').text();
		
		$('#project-popup').dialog({title : ptitle});

		$("#project-popup").dialog({width: function() {
		    if ($(window).width() > 1000) {
		        // Wide.
		        return $(window).width() - 100;
		    }
		    // Not wide.
		    return $(window).width();
		}});

		$('#project-popup').dialog("open");

		$('#project-popup').dialog("option", "position", {
			my: "center",
			at: "center",
			of: window
		});

	});

	/* Loads a project */
	function load_project(id) {
		$.ajax({
			type: "POST",
			url: baseurl + "Project/show_project",
			data: { 
				'project_id' : id,
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			success: function(data) {
				if (data) {
					$("#project-popup").html(data);

					$('#project-popup').dialog("option", "position", {
						my: "center",
						at: "center",
						of: window
					});
				}
			}
		});
	}

});
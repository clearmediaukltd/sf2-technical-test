/**
 * When the user presses the submit button we prevent the form being submitted
 * get the search string and generate a URL for our ajax request (
 *
 */
$( document ).ready(function() {

	$('#submit').bind('click', function(e) {
		e.preventDefault();
		
		var username = $('#search').val();
		var search_url = $("#search_form").attr("action") + '/' + username;

		$.ajax({
			type: "GET",
			url: search_url,
			dataType: "json",
			cache: false
		}).done(function(results) {

			// Write out list of results
			$('#results').empty();

			var result_list = '';
			for(var i = 0; i < results.length; i++) {
				result_list += '<li class="result"><a href="" class="alert" data-id="' + results[i].id + '" data-created="' + results[i].created_at + '">' + results[i].name + ' (' + results[i].watchers + ')</a></li>';
			}

			$('#results').html(result_list);

		}).fail(function( jqXHR, textStatus ) {
			alert( "Request failed: " + textStatus );
		});
	});

	$(document).on('click', '.alert', function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		var created = $(this).attr('data-created');
		alert('id: ' + id + ' created: ' + created);
	})

});
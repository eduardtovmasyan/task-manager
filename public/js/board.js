$(document).on('click', '.addBoard', function() {
	var token = $('#token').val()
	let boardName = $('.boardName').val()

	$.ajax({
        type: 'post',
        url: '/board',
        data: { 'title': boardName, '_token': token },
        success: function(r) {
        	$('#boardHr').before(`
    			<button class="dropdown-item" type="button">
    				${boardName}
    			</button>
    		`)
        }
    });
});


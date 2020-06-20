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
            $('#boardCards').after(`
                <div class="col boardCards">
            <div class="card">
                <div class="card-header text-center">${boardName}</div>

                <div class="card-body">
                   <button class="btn btn-primary" aria-hidden="true">Open Board</button>
                   <button class="fa fa-user-plus float-right" aria-hidden="true"></button>
                </div>
            </div>
        </div>
            `)
        }
    });
});

$(document).on('click', '.deleteBoard', function() {
    var token = $('#token').val()
    let boardId = $(this).attr('data-id')

    $.ajax({
        type: 'delete',
        url: '/board/' + boardId,
        data: {'_token': token },
        success: function(r) {
            // $(this).parent().parent().parent().remove()
        }
    });
});


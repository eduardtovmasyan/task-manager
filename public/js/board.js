$(document).on('click', '.addBoard', function() {
    var token = $('#token').val()
    let boardName = $('.boardName').val()

    $.ajax({
        type: 'post',
        url: '/board',
        data: { 'title': boardName, '_token': token },
        success: function(r) {
            console.log(r)
            $('#boardHr').before(`
                <button class="dropdown-item" type="button">
                    ${boardName}
                </button>
            `)
            $('#boardCards').after(`
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <strong> ${boardName} </strong>
                            <div class="dropdown float-right">
                                <button type="button" class="fa fa-ellipsis-h boardButton" aria-hidden="true" data-toggle="dropdown">
                                
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item fa fa-pencil-square-o boardButton updateBoard" data-id="${r.data.id}" aria-hidden="true"> Rename</button>
                                    <button class="dropdown-item fa fa-minus-circle boardButton deleteBoard" data-id="${r.data.d}" aria-hidden="true"> Delete</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="myboard/${r.data.id}" class="btn btn-outline-info btn-sm" aria-hidden="true">Open Board</a>
                            <button class="fa fa-user-plus boardButton float-right" aria-hidden="true"></button>
                        </div>
                    </div>
                </div>
            `)
        }
    });
});

$(document).on('click', '.deleteBoard', function() {
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var token = $('#token').val()
                let boardId = $(this).attr('data-id')
                let t = $(this)
                $.ajax({
                    type: 'delete',
                    url: '/board/' + boardId,
                    data: { '_token': token },
                    success: function(r) {
                        t.parent().parent().parent().parent().parent().remove()
                        $('#board-' + boardId).remove()
                    }
                });
            }
        });
});

$(document).on('click', '.renameBoard', function() {
    let boardId = $(this).attr('data-id')
    let content = $(this).parent().parent().prev().html()
    $(this).parent().parent().prev().empty().append(`
        <div class="input-group mb-3">
          <input type="text" class="form-control" value="${content}">
          <div class="input-group-prepend">
            <button class="fa fa-check btn-success updateBoard" aria-hidden="true" data-id="${boardId}" type="button"></button>
          </div>
        </div>
        `)
});

$(document).on('click', '.updateBoard', function() {
    var token = $('#token').val()
    let boardId = $(this).attr('data-id')
    let content = $(this).parent().prev().val()
    let t = $(this)
    $.ajax({
        type: 'patch',
        url: '/board/' + boardId,
        data: { '_token': token, 'title': content },
        success: function(r) {
            t.parent().parent().parent().empty().html(content)
            $('#board-' + boardId).empty().html(content)
        }
    });
});

$(document).on('click', '.invitation', function() {
    var token = $('#token').val();
    var email = prompt('Enter email.');
    var boardId = $(this).data('id')

    if (email) {
        $.ajax({
            type: 'post',
            url: `/boards/${boardId}/invitation`,
            data: { 'email': email, '_token': token },
            success: function(r) {
                swal("Good job!", "You already sent invitation!", "success");
            }
        });
    }
});

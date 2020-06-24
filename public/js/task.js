let token = $('#token').val()
let boardId = $('#current-board-id').val()

$.ajax({
    type: 'get',
    url: `/board/${ boardId }/tasks`,
    headers: { '_token': token },
    success: function(r) {
        for (task of r.data) {
            let taskElm = `<div class="card removable editable" data-toggle="modal" data-id="${ task.id }">${ task.title }</div>`;
            $(`.list[data-id="${ task.list_id }"] .content`).append(taskElm);
        }
    }
});

// drop & drag
var main = document.querySelector('#main');

var list = Sortable.create(main, {
    group: 'list',
    sort: true,
    filter: '.add-card',
    draggable: '.list',
    ghostClass: "ghost",
    dragoverBubble: true,
});

function initContent() {
    var dropzones = document.querySelectorAll('.content');

    for (item of dropzones) {
        Sortable.create(item, {
            group: 'card',
            sort: true,
            draggable: '.card',
            ghostClass: "ghost",
            onMove: function(evt, originalEvent) {
                const taskId = $(evt.dragged).data('id');
                const listId = $(evt.related).parents('.list').data('id');

                $.ajax({
                    type: 'patch',
                    url: `/boards/${ boardId }/tasks/${ taskId }`,
                    data: { '_token': token, 'list_id': listId },
                    success: function(r) {}
                });
            },
        });
    }
}

initContent();

$(document).on('click', '.add-list', function() {
    var result = prompt('Enter a title for this list.');
    var t = $(this)
    if (result) {
    $.ajax({
        type: 'post',
        url: '/list',
        data: { 'title': result, 'board_id': boardId, '_token': token },
        success: function(r) {
            t.before(`
              <div class="list" data-id="${ r.data.id }">
                <div class="title removable listName" data-id="${ r.data.id }">${ r.data.title } <span class="foat-right listDelete" data-id="${ r.data.id }" >x</span></div>
                <div class="content"></div>
                <div class="add-card editable">Add another card</div>
              </div>
            `)
            initContent();
        }
    });
    }
});
$(document).on('click', '.listDelete', function() {
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                let listId = $(this).attr('data-id')
                var t = $(this)
                $.ajax({
                    type: 'delete',
                    url: `/list/${ listId }`,
                    data: { '_token': token },
                    success: function(r) {
                        t.parent().parent().remove()
                    }
                });
            }
        });
});

$(document).on('click', '.add-card', function() {
    var list_id = $(this).parent().data('id')
    var title = prompt('Enter a title for this task.');
    var t = $(this)
    if (title) {
    $.ajax({
        type: 'post',
        url: '/task',
        data: { '_token': token, title, list_id },
        success: function(r) {
            var taskElm = `<div class="card removable editable" data-toggle="modal" data-id="${ r.data.id }">${ r.data.title }</div>`
            $(`.list[data-id="${ r.data.list_id }"] .content`).append(taskElm);
        }
    });
}
});

$(document).on('click', '.card', function() {
    var taskId = $(this).data('id')
    $(this).attr('data-target', "#mytasks")
    $.ajax({
        type: 'get',
        url: `/boards/${ boardId }/tasks/${ taskId }`,
        headers: { '_token': token, },
        success: function(r) {
            var assignee;
            var decs;
            let userName = '';

            if (r.data.assigned_to) {
                $('.current-board-user').each(function() {
                    let user_id = $(this).val();
                    let user_name = $(this).attr('data-id');

                    if (user_id == r.data.assigned_to) {
                        userName = user_name
                    }
                });
                assignee = `<div class="float-right" data-id="${ r.data.assigned_to }">Assigned To: ${ userName }</div>`
            } else {
                var select = $('<select class="assignee assigneSelect custom-select" name="sellist1"><option value="" selected disabled hidden>Assigne To</option></select>')
                $('.current-board-user').each(function() {
                    let user_id = $(this).val();
                    let user_name = $(this).attr('data-id');
                    select.append(`<option value="${user_id}">${user_name}</option>`);
                });

                assignee = select[0].outerHTML
            }
            if (r.data.desc) {
                desc = `<div class="text-center">${ r.data.desc }</div>`
            } else {
                desc = `<div class="m-5">Click here to add description</div>`
            }

            $('#mytasks').empty()
            $('#mytasks').append(`
            <div class="modal-dialog">
                <div class="modal-content" data-id="${ r.data.id }">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" >${ r.data.title }</h4>
                        <button type="button" class="fa fa-minus-circle deleteTask" aria-hidden="true"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                    <div>${ assignee }</div>
                        
                        <div class="my-5"></div>
                        <div class="form-group px-2 py-2 text-center newDesc" role="button" style="background:#dfe1e6;">
                        ${ desc }
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        `)
        }
    });
});

$(document).on('click', '.newDesc', function() {
    var content = $(this).children().html()
    $(this).after(`<button type="button" class="btn btn-success float-right submitDesc">Submite</button>`)
    $(this).removeClass('newDesc')
    $(this).empty().append(`
        <label for="">Description:</label>
        <textarea class="form-control addDesc" rows="5">${ content }</textarea>
    `)
});
$(document).on('change', '.assigneSelect', function() {
    var t = $(this)
    var assignee = $(this).val()
    var taskId = $(this).closest('.modal-content').data('id')
    let userName = '';

    $('.current-board-user').each(function() {
        let user_id = $(this).val();
        let user_name = $(this).attr('data-id');

        if (user_id == assignee) {
            userName = user_name
        }
    });

    $.ajax({
        type: 'patch',
        url: `/boards/${ boardId }/tasks/${ taskId }`,
        data: { '_token': token, 'assigned_to': assignee },
        success: function(r) {
            t.parent().empty().append(`<div class="float-right" data-id="${ r.data.assigned_to }">Assigned To: ${ userName }</div>`)
        }
    });
});

$(document).on('click', '.submitDesc', function() {
    var content = $(this).prev().children('textarea').val()
    var t = $(this)
    var taskId = $(this).closest('.modal-content').data('id')

    $.ajax({
        type: 'patch',
        url: `/boards/${ boardId }/tasks/${ taskId }`,
        data: { '_token': token, 'desc': content },
        success: function(r) {
            t.prev().addClass('newDesc')
            t.prev().empty().append(`<div class="text-center">${ content }</div>`)
            t.remove()
        }
    });
});

$(document).on('click', '.deleteTask', function() {
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                let taskId = $(this).closest('.modal-content').data('id')
                $.ajax({
                    type: 'delete',
                    url: `/task/${ taskId }`,
                    data: { '_token': token },
                    success: function(r) {
                        location.reload()
                    }
                });
            }
        });
});

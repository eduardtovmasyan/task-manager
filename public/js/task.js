let token = $('#token').val()
let boardId = $('#current-board-id').val()

$.ajax({
    type: 'get',
    url: `/board/${boardId}/tasks`,
    headers: { '_token': token },
    success: function(r) {
        for (task of r.data) {
            let taskElm = `<div class="card removable editable" data-toggle="modal" data-id="${task.id}">${task.title}</div>`;
            $(`.list[data-id="${task.list_id}"] .content`).append(taskElm);
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
                    url: `/boards/${boardId}/tasks/${taskId}`,
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

    $.ajax({
        type: 'post',
        url: '/list',
        data: { 'title': result, 'board_id': boardId, '_token': token },
        success: function(r) {
            t.before(`
            <div class="list" data-id="${r.data.id}">
                <div class="title removable editable" data-id="${r.data.id}">${r.data.title}</div>
                <div class="content"></div>
                <div class="add-card editable">Add another card</div>
            </div>
            `)
        }

    });
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
                    url: `/list/${listId}`,
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
    $.ajax({
        type: 'post',
        url: '/task',
        data: { '_token': token, title, list_id },
        success: function(r) {
            var taskElm = `<div class="card removable editable" data-id="${r.data.id}">${r.data.title}</div>`
            $(`.list[data-id="${r.data.list_id}"] .content`).append(taskElm);
        }
    });
});

// task modal
$(document).on('click', '.card', function() {
    var taskId = $(this).data('id')
    // $(this).attr('data-target', "#mytasks")

    $.ajax({
        type: 'get',
        url: `/boards/${boardId}/tasks/${taskId}`,
        headers: { '_token': token, },
        success: function(r) {
            var assignee;
            var decs;
            // if (r.data.assigned_to) {
            //     assignee = `<div class="card removable editable" data-id="">${r.data.assigned_to}</div>`
            // } else{
            //     prompt()
            // }
            // if (r.data.desc) {
            //     desc = `<div class="">${r.data.desc}</div>`
            // } else{
            //     prompt()
            // }


            $('#mytasks').empty()
            $('#mytasks').append(`
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">${r.data.title}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        Modal body..
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


// delete task
// swal({
//         title: "Are you sure?",
//         text: "Once deleted, you will not be able to recover this imaginary file!",
//         icon: "warning",
//         buttons: true,
//         dangerMode: true,
//     })
//     .then((willDelete) => {
//         if (willDelete) {

//             let taskId = $(this).attr('data-id')
//             $.ajax({
//                 type: 'delete',
//                 url: '/task/' + taskId,
//                 data: { '_token': token },
//                 success: function(r) {}
//             });
//         } 
//     });

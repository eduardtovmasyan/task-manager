$(document).on('click', '.addTask', function() {
    $(this).toggle()
    var select = $('<select class="form-control assignee" name="sellist1"></select>')
    $('.thisBoardUser').each(function() {
        let user_id = $(this).val();
        let user_name = $(this).attr('data-id');
        select.append(`<option value="${user_id}">${user_name}</option>`);
    });
    select = select[0].outerHTML

    $(this).before(`
        <div>
            <div class="form-group">
            <label for="">Assingnee To:</label>
             ${select}
                <label for="" class="mt-3">Task Title:</label>
                <input class="form-control mb-3 taskTitle" type="text" placeholder="Enter a title for this task."/>
                <label for="">Task Description:</label>
                <textarea class="form-control taskDesc" rows="5" placeholder="Enter a description for this task."></textarea>
            </div>
            <button type="button" class="btn btn-primary addCard">Create Task</button>
            <button type="button" class="fa fa-times float-right cardAddCancel" aria-hidden="true"></button>
        </div>
    `)
});

$(document).on('click', '.cardAddCancel', function() {
    $(this).parent().next().toggle()
    $(this).parent().remove()
});

$('.addListName').click(function(event) {
    $(this).next().empty()
    $(this).next().toggle().append(`
        <div>
            <div class="form-group">
                <textarea class="form-control listTittle" rows="5" placeholder="Enter a title for this list."></textarea>
            </div>
            <button type="button" class="btn btn-primary addList">Add List</button>
            <button type="button" class="fa fa-times float-right listAddCancel" aria-hidden="true"></button>
        </div>
    `)
    
});

$(document).on('click', '.addList', function() {
    let name = $(this).prev().children().val()
    let token = $('#token').val()
    let boardId = $('.boardId').val()
    let t = $(this)
    $.ajax({
        type: 'post',
        url: '/list',
        data: { 'title': name, 'board_id': boardId, '_token': token },
        success: function(r) {
            t.parent().parent().parent().parent().before(`
                <div class="col">
                    <div class="card">
                        <div class="card-header">${name}</div>
                        <div class="card-body">
                            <button class="btn btn-primary btn-block fa fa-plus addCard" aria-hidden="true"> Add Card</button>
                        </div>
                    </div>
                </div>
             `)
            t.closest('.card-body').empty().toggle()
        }
            
    });
});

$(document).on('click', '.listAddCancel', function() {
    $(this).closest('.card-body').empty().toggle()
});

$(document).on('click', '.addCard', function() {
 
    let token = $('#token').val()
    let assigned_to = $(document).find('.assignee').val()
    let title = $(this).prev().children('.taskTitle').val()
    let desc = $(this).prev().children('.taskDesc').val()
    let list_id = $(this).closest('.card-body').attr('data-id')
    let t = $(this)
    $.ajax({
        type: 'post',
        url: '/task',
        data: { '_token': token, assigned_to, title, desc, list_id },
        success: function(r) {
            t.closest('.card-body').empty()
            console.log(r.data)
        }
            
    });
});

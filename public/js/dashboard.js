$(document).on('click', '.addCard', function() {
    $(this).toggle()
    $(this).before(`
        <div>
        <div class="form-group">
            <textarea class="form-control" rows="5" placeholder="Enter a title for this card."></textarea>
        </div>
        <button type="button" class="btn btn-primary addCard">Add Card</button>
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
    $(this).parent().parent().parent().parent().before(`
        <div class="col">
            <div class="card">
                <div class="card-header">${name}</div>

                <div class="card-body">
                 <button class="btn btn-primary btn-block fa fa-plus addCard" aria-hidden="true"> Add Card</button>
                </div>
            </div>
        </div>
        `)
    $(this).closest('.card-body').empty().toggle()
});

$(document).on('click', '.listAddCancel', function() {
    $(this).closest('.card-body').empty().toggle()
});
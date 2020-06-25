$(document).on('click', '.invitationButton', function() {
    var token = $('#token').val()
    var status = $(this).data('id')
    var invation_id = $(this).parent().data('id')
    var t = $(this)
    $.ajax({
        type: 'patch',
        url: `/invites/${ invation_id }`,
        data: { status, '_token': token },
        success: function(r) {
            t.parent().parent().parent().remove()
        }
    });

});
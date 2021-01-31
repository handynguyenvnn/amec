$(document).ready(function () {
    $('#modal-delete').on('show.bs.modal', function (event) {
        // Button that triggered the modal
        var action = $(event.relatedTarget).data('action');
        $('#delete-form').attr('action', action);
    });

    validateConfig.rules = {
        subject: {
            required: true,
            maxlength: 100
        },
        description: {
            required: true
        }
    };
    $("#form").validate(validateConfig);
});

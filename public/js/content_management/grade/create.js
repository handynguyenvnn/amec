$("#createForm").validate({
    errorClass:'has-error',
    validClass:'has-success',
    highlight: function (element, errorClass, validClass) {
        $(element).parents("div.form-group")
            .addClass(errorClass)
            .removeClass(validClass);
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).parents(".has-error")
            .removeClass(errorClass)
            .addClass(validClass);
    },
    rules: {
        ja_name: {
            required: true
        }
    },
    messages: {
        ja_name: {
            required: "グレード名入力欄必要とされている"
        }
    }
});


$(document).ready(function () {
    $('#modal-delete').on('show.bs.modal', function (event) {
        // Button that triggered the modal
        var action = $(event.relatedTarget).data('action');
        $('#delete-form').attr('action', action);
    })
});
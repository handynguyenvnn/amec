$(document).ready(function () {
    $('#modal-delete').on('show.bs.modal', function (event) {
        var action = $(event.relatedTarget).data('action');
        $('#delete-form').attr('action', action);
    });
    $('#edit-language').on('show.bs.modal', function (event) {
        var action = $(event.relatedTarget).data('action');
        $('#edit-form').attr('action', action);
        var id = $(event.relatedTarget).data('id');
        var url = '/collection-info/' + id;
        $.get(url, function (response) {
            $("#edit_name").val(response.lang);
            $("#edit_language").val(response.lang_code);
        });
    });
});

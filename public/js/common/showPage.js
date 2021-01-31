$(document).ready(function () {
    $('#modal-delete').on('show.bs.modal', function (event) {
        // Button that triggered the modal
        var action = $(event.relatedTarget).data('action');
        $('#delete-form').attr('action', action);
    });
    dataTableGenerate($('.dataTable'), $('#form-search'));
});

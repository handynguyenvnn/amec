$(document).ready(function () {
    $('#modal-preview').on('show.bs.modal', function (event) {
        // Button that triggered the modal
        var id = $(event.relatedTarget).data('id');
        var url = '/collection-info/' + id;
        $.get(url, function (response) {
            console.log(response);
            $('#content-preview img').attr("src",response.image_path);
            $('#collection-name').html( response.name );
            $('#collection-maker-name').html( response.maker_name );
            $('#collection-description').html( response.description );
            // $('#language-name').html( response.lang );
        });
    });
});

$(document).ready(function () {
    $('.table').on('click', '#select_delete_coma', function() {
        var id = $(this).attr("data-id");
        $('#modal_submit_delete').attr('data-id', id);
    });
    $('#modal_submit_delete').click( function () {
        var deleteId = $(this).attr("data-id");
        var pageId = $(this).attr("page-id");
        var url = '/chapter/delete-comas/' + deleteId;
        $.get(url, function (response) {
            window.location="/chapters/"+pageId+"/edit";
        });
    });
});
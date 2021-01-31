$(document).ready(function () {
    $("#select").change(function () {
        var id = $(this).val();
        var url = '/certificate_settings/' + id;
        $.get(url, function (response) {
            $("#id").val(response.certificate.id);
            $("#image_path").attr("src",response.certificate.image_path);
        });
    });
});
$(document).ready(function () {
    $("#select").change(function () {
        var languageId = $(this).val();
        var url = '/certificate_settings/' + languageId;
        $.get(url, function (response) {
            $("#image_path").attr("src",response.image_path);
        });
    });
});
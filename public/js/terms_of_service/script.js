$(document).ready(function () {
    $("#select").change(function () {
        var languageId = $(this).val();
        var url = '/terms_of_service/' + languageId;
        $.get(url, function (response) {
            tinyMCE.activeEditor.setContent("<span>" + response.terms_of_use + "</span>");
        });
    });
});
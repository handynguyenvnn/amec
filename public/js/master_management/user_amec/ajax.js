$(document).ready(function () {
    $("#select").change(function () {
        var languageId = $(this).val();
        var url = '/guides/' + languageId;
        $.get(url, function (response) {
            tinyMCE.activeEditor.setContent("<span>" + response.html_code + "</span>");
        });
    });
});
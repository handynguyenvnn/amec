/**
 * Created by QUE on 6/15/2017.
 */

$(function () {

//set japanese for bootstrap file-input


    initial();
    addMore();
    removeRow();
    function initial() {
        var imgLink = '../img/content_management/demo.jpg';
        $("#file_upload_ja").fileinput({
            language: "ja",
            showUpload: false,
            initialPreview: [
                imgLink
            ],
            initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
            initialPreviewFileType: 'image', // image is the default and can be overridden in config below
            initialPreviewConfig: [
                {caption: 'image.jpg', width: "120px", url: imgLink, key: 1}
            ]
        });

        $(".file-caption-name").first().text('image.jpg');

//remove trash image mini button
        $(".kv-file-remove.btn.btn-xs.btn-default").remove();

    }

    function addMore(id) {
        // var data = {id: id};
        $('.addMore').on('click', function () {
            var template = $('#template').html();
            var html = Mustache.to_html(template);
            $(this).closest('.card-baai').children('.card-baai-round').append(html);
        });
    }

    function removeRow() {
        $('.card-baai-round').on('click', '.remove-row', function () {
            $(this).closest('.margin-card').remove();
        })
    }

});
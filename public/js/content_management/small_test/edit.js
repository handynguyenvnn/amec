//set japanese for bootstrap file-input
var imgLink = '../img/content_management/demo.jpg';
$("input[type=file]").fileinput({
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

$(".file-caption-name").text('image.jpg');

//remove trash image mini button
$(".kv-file-remove.btn.btn-xs.btn-default").remove();

$("#avatar-1").fileinput({
    uploadAsync: false,
    overwriteInitial: false,
    initialPreview: [
        "http://thongtinhanquoc.com/wp-content/uploads/2015/05/tthq-no-photo.jpg",
    ],
    initialPreviewAsData: true, // defaults markup
    initialPreviewFileType: 'image', // image is the default and can be overridden in config below
    initialPreviewConfig: [
        {type: "image", caption: "No-image.jpg", size: 847000, url: "/site/file-delete", key: 1},
    ],
    uploadExtraData: {
        img_key: "1000",
        img_keywords: "happy, nature"
    }
}).on('filesorted', function(e, params) {
    console.log('File sorted params', params);
}).on('fileuploaded', function(e, params) {
    console.log('File uploaded params', params);
});
$("#avatar-21").fileinput({
    uploadUrl: "/file-upload-batch/1",
    uploadAsync: false,
    minFileCount: 2,
    maxFileCount: 5,
    overwriteInitial: false,
    initialPreview: [
        "http://kartik-v.github.io/bootstrap-fileinput-samples/samples/small.mp4"
    ],
    initialPreviewAsData: true, // defaults markup
    initialPreviewFileType: 'image', // image is the default and can be overridden in config below
    initialPreviewConfig: [
        {type: "video", size: 375000, filetype: "video/mp4", caption: "KrajeeSample.mp4", url: "/file-upload-batch/2", key: 11}
    ],
    uploadExtraData: {
        img_key: "1000",
        img_keywords: "happy, nature"
    }
}).on('filesorted', function(e, params) {
    console.log('File sorted params', params);
}).on('fileuploaded', function(e, params) {
    console.log('File uploaded params', params);
});
$("#avatar-2").fileinput({
    uploadUrl: "/file-upload-batch/1",
    uploadAsync: false,
    minFileCount: 2,
    maxFileCount: 5,
    overwriteInitial: false,
    initialPreview: [
        "http://thongtinhanquoc.com/wp-content/uploads/2015/05/tthq-no-photo.jpg",
    ],
    initialPreviewAsData: true, // defaults markup
    initialPreviewFileType: 'image', // image is the default and can be overridden in config below
    initialPreviewConfig: [
        {type: "image", caption: "No-image.jpg", size: 847000, url: "/site/file-delete", key: 1},
    ],
    uploadExtraData: {
        img_key: "1000",
        img_keywords: "happy, nature"
    }
}).on('filesorted', function(e, params) {
    console.log('File sorted params', params);
}).on('fileuploaded', function(e, params) {
    console.log('File uploaded params', params);
});
$("#avatar-22").fileinput({
    uploadUrl: "/file-upload-batch/1",
    uploadAsync: false,
    minFileCount: 2,
    maxFileCount: 5,
    overwriteInitial: false,
    initialPreview: [
        "http://kartik-v.github.io/bootstrap-fileinput-samples/samples/small.mp4"
    ],
    initialPreviewAsData: true, // defaults markup
    initialPreviewFileType: 'image', // image is the default and can be overridden in config below
    initialPreviewConfig: [
        {type: "video", size: 375000, filetype: "video/mp4", caption: "KrajeeSample.mp4", url: "/file-upload-batch/2", key: 11}
    ],
    uploadExtraData: {
        img_key: "1000",
        img_keywords: "happy, nature"
    }
}).on('filesorted', function(e, params) {
    console.log('File sorted params', params);
}).on('fileuploaded', function(e, params) {
    console.log('File uploaded params', params);
});
$("#avatar-3").fileinput({
    uploadUrl: "/file-upload-batch/1",
    uploadAsync: false,
    minFileCount: 2,
    maxFileCount: 5,
    overwriteInitial: false,
    initialPreview: [
        "http://thongtinhanquoc.com/wp-content/uploads/2015/05/tthq-no-photo.jpg",
    ],
    initialPreviewAsData: true, // defaults markup
    initialPreviewFileType: 'image', // image is the default and can be overridden in config below
    initialPreviewConfig: [
        {type: "image", caption: "No-image.jpg", size: 847000, url: "/site/file-delete", key: 1},
    ],
    uploadExtraData: {
        img_key: "1000",
        img_keywords: "happy, nature"
    }
}).on('filesorted', function(e, params) {
    console.log('File sorted params', params);
}).on('fileuploaded', function(e, params) {
    console.log('File uploaded params', params);
});
$("#avatar-23").fileinput({
    uploadUrl: "/file-upload-batch/1",
    uploadAsync: false,
    minFileCount: 2,
    maxFileCount: 5,
    overwriteInitial: false,
    initialPreview: [
        "http://kartik-v.github.io/bootstrap-fileinput-samples/samples/small.mp4"
    ],
    initialPreviewAsData: true, // defaults markup
    initialPreviewFileType: 'image', // image is the default and can be overridden in config below
    initialPreviewConfig: [
        {type: "video", size: 375000, filetype: "video/mp4", caption: "KrajeeSample.mp4", url: "/file-upload-batch/2", key: 11}
    ],
    uploadExtraData: {
        img_key: "1000",
        img_keywords: "happy, nature"
    }
}).on('filesorted', function(e, params) {
    console.log('File sorted params', params);
}).on('fileuploaded', function(e, params) {
    console.log('File uploaded params', params);
});
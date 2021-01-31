tinymce.init({
    autoresize_on_init: true,
    selector: "textarea",theme: "modern",
    plugins: [
        "autoresize advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons paste textcolor filemanager code"
    ],

    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
    toolbar2: "| filemanager | link unlink anchor | image media | forecolor backcolor  | print preview code | fontsizeselect",
    image_advtab: true ,
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
    external_filemanager_path:"/filemanager/",
    filemanager_title:"Filemanager" ,
    external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
});
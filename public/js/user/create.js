$('input[type="checkbox"], input[type="radio"]').iCheck({
    checkboxClass: 'icheckbox_flat-red',
    radioClass: 'iradio_minimal-blue'
});

$("#createForm").validate({
    errorClass:'has-error',
    validClass:'has-success',
    highlight: function (element, errorClass, validClass) {
        $(element).parents("div.form-group")
            .addClass(errorClass)
            .removeClass(validClass);
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).parents(".has-error")
            .removeClass(errorClass)
            .addClass(validClass);
    },
    rules: {
        username: {
            required: true
        },
        account: {
            required: true
        },
        device_id: {
            required: true
        }
    },
    messages: {
        username: {
            required: "ユーザー名 必要とされている"
        },
        category: {
            required: "カテゴリー 必要とされている"
        },
        account: {
            required: "アカウント 必要とされている"
        },
        device_id: {
            required: "認定証発行日時 必要とされている"
        }
    }
});

var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' +
    'onclick="alert(\'Call your custom code here.\')">' +
    '<i class="glyphicon glyphicon-tag"></i>' +
    '</button>';
$("#avatar-1").fileinput({
    overwriteInitial: true,
    maxFileSize: 1500,
    showClose: false,
    showCaption: false,
    browseLabel: '',
    removeLabel: '',
    removeTitle: 'Cancel or reset changes',
    elErrorContainer: '#kv-avatar-errors-1',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: '<img src="../../img/no-image.png" id="preview-avatar-1" alt="Your Avatar" style="width:160px">',
    initialPreviewAsData: true,
    layoutTemplates: {main2: '{preview} ' +  ' {remove} {browse}'},
    allowedFileExtensions: ["jpg", "png", "gif"]
});
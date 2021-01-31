$('input[type="checkbox"], input[type="radio"]').iCheck({
    checkboxClass: 'icheckbox_flat-red',
    radioClass: 'iradio_minimal-blue'
});

$("#updatUser").validate({
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
        email: {
            required: true
        }

    },
    messages: {
        username: {
            required: "氏名を入力してください。"
        },
        email: {
            required: "メールアドレスを入力してください。"
        },
        category: {
            required: "カテゴリー 必要とされている"
        },
        account: {
            required: "アカウント 必要とされている"
        }
    }
});

var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' +
    'onclick="alert(\'Call your custom code here.\')">' +
    '<i class="glyphicon glyphicon-tag"></i>' +
    '</button>';
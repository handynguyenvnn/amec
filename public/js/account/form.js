jQuery(document).ready(function($) {
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
        // errorPlacement: function(error, element){
        //     var parentDiv = element.parents('.acc-roles');
        //     if (parentDiv.length) {
        //         parentDiv.addClass("has-error");
        //         parentDiv.append(error);
        //     }
        //     else {
        //         element.parents("div.col-md-6").append(error);
        //     }
        // },
        rules: {
            name: {
                required: true
            },
            login_id: {
                required: true
            },
            password: {
                required: passRequired
            }
            // 'roles[]': {
            //     required: true
            // }

        },
        messages: {
            name: {
                required: "管理者名を入力してください。"
            },
            login_id: {
                required: "アカウントIDを入力してください。"
            },
            password: {
                required: "パスワードを入力してください。"
            }
            // 'roles[]': {
            //     required: "権限を選択してください。"
            // }
        }
    });

});
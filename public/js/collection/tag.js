$(document).ready(function () {
   $(".delTag").click(function(){
        var id = $(this).attr("data-id");
        $.ajax({
            url: "/tags/tags/checkuse",
            data: {'id':id},
            success: function (mess) {
                console.log(mess);
                if (mess == "yes"){
                    $("#modal-dismiss").modal("show");
                }else{
                    var urlDel = "/tags/tags/"+id;
                    $("#modal-delete").modal("show");
                    $("#modal-delete #delete-form").attr("action",urlDel);
                }
            },
            error: function (mess) {
                console.log('Error:', mess);
            }
        });
    });
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
        name: {
            required: true
        }
    },
    messages: {
        name: {
            required: "の入力内容をタグ名に追加する。"
        }
    }
});
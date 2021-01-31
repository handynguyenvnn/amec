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
        title_small_test_question: {
            required: true
        },
        pass_score_rate:{
            required: true
        }
    },
    messages: {
        title_small_test_question: {
            required: "タイトルを入力してください。"
        },
        pass_score_rate:{
            required: "合格正答率を入力してください。"
        }
    }

});
$("#chapterForm").validate({
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
        name_chapter_coma: {
            required: true
        }
    },
    messages: {
        name_chapter_coma: {
            required: "コマ名を入力してください。"
        }
    }
});
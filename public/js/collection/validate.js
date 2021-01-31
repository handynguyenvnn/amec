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
        ja_name: {
            required: true
        },
        collection_no: {
            required: true
        }
    },
    messages: {
        ja_name: {
            required: "コレクション名入力欄必要とされている"
        },
        collection_no: {
            required: "コレクションNo入力欄必要とされている"
        }
    }
});
function validateForm() {

    $('.tab-pane').removeClass('active');
    $('.tab-pane').hide();

    tabId = $(this).attr('href');
    var collection_no = $('#collection_no').val();
    if (collection_no == '') {
        $('#common-v').show();
        $('.tabs-right li').removeClass('active');
        $('.tabs-right li').first().addClass('active');
    }
    var name = $('#inputCollectionNameja').val();
    if (name == '') {
        $('#ja-v').show();
        $('.tabs-right li').removeClass('active');
        $('.tabs-right li').first().addClass('active');
    }
}
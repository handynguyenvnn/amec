
jQuery(document).ready(function($) {

    $('ul.nav-tabs li a').each(function() {
        if ($(this).attr('href') == location.hash)
        {
            $(this).click();
            $("html, body").animate({ scrollTop: 0 }, "slow");
        }
    })

    $('#modal-delete').on('show.bs.modal', function (event) {
        // Button that triggered the modal
        var action = $(event.relatedTarget).data('action');
        $('#delete-form').attr('action', action);
    })

    $('.version-copy').click(function(e){
        e.preventDefault();
        $.ajax({
            url: copyVersionURL,
            type:'GET',
            dataType: 'json',
            data: {id: $(this).attr('version-id')},
            success: function(data) {
                location.reload();
            }
        });

    });

    $('#modal-publish').on('show.bs.modal', function (event) {
        // Button that triggered the modal
        var action = $(event.relatedTarget).data('action');
        $('#publish-form').attr('action', action);
    })
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
        ja_name: {
            required: true
        }
    },
    messages: {
        ja_name: {
            required: "グレード名を入力してください."
        }
    }
});
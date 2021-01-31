$(document).ready(function(){
    $('input[type=checkbox]').change(function(){
        $.each($('input[type=checkbox]'), function(){
            if($(this).is(':checked')){
                $(this).parent().next().next().next().children().prop('disabled', true);
                $(this).parent().next().next().next().next().children().attr('disabled', true).bind('click', function () {
                    return false;
                });
                $(this).parent().next().next().next().next().next().children().prop('disabled', true);
            } else {
                $(this).parent().next().next().next().children().prop('disabled', false);
                $(this).parent().next().next().next().next().children().attr('disabled', false).unbind('click');
                $(this).parent().next().next().next().next().next().children().prop('disabled', false);
            }
        });
    });
});
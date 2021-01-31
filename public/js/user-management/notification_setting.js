$(document).ready(function(){
    $("input[type='checkbox']").on('change', function(){
        $(this).val(this.checked ? 1 : 0);
    })
});
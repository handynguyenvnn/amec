$(function () {
    $('#toggle-active').change(function () {
        if($(this).is(':checked')){
            $('#change-active').modal('show');
            $('.ui-sortable').each(function() { $(this).sortable('enable'); });
            // $('.ui-sortable button').attr("disabled",false);
            // $('.ui-sortable #edit-button').attr("disabled",false);
            // $('.ui-sortable #edit-button').unbind('click',false);
            SettingToggle = 1;
        }else{
            $('.ui-sortable').each(function() { $(this).sortable('disable'); });
            // $('.ui-sortable button').attr("disabled",true);
            // $('.ui-sortable #edit-button').attr("disabled",true);
            // $('.ui-sortable #edit-button').bind('click',false);
            SettingToggle = 0;
        }
        localStorage.setItem('SettingToggle',SettingToggle);
    });
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_flat'
    });
    $('#change-active .btn-close').click(function () {
        var checkbox = $('#toggle-active');
        checkbox.prop('checked', (checkbox.prop('checked') ? false : true)).change();
    });
    $('#change-active').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
    });
    $('#grade_create').click(function () {
        var dataNo = 0;
        $('tr.ui-sortable-handle').each(function(indx, element) {
            var _no =  parseInt($(this).attr('data-no'));
            dataNo = dataNo > _no ? dataNo : _no;
        });
        dataNo += 1;

        var html = $('#dv-grade').html();
        //html = html.replaceAll('GRAD_ID', 0);
        html = html.replaceAll('GRAD_NO', dataNo);

        html = '<tr id="tr-' + dataNo + '" data-id="0" data-no="' + dataNo + '" class="ui-sortable-handle">' + html + '</tr>';
        $(html).insertBefore('#dv-grade');
    });
});
function saveGrade(name, id, no) {
    if (name == '') return;

    var baseUrl = $('#grade-save').val();
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: baseUrl,
        type: 'POST',
        data: {
            id: id,
            no: no,
            name: name,
            _token: _token
        },
        success: function( _id ) {

            if (_id > 0) {
                clearId('#dv-grade-ed-' + no, _id, 'href');
                clearId('#dv-grade-rv-' + no, _id, 'data-action');
                clearId('#dv-grade-rv-' + no, _id, 'data-id');
                $('#dv-grade-ed-' + no).removeAttr("disabled");
            }
        }
    });
}
function clearId(id, _id, attr) {
    var _attr = $(id).attr(attr);
    _attr = _attr.replaceAll('GRAD_ID', _id);
    $(id).attr(attr, _attr);
}
String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};
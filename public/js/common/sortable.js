$(document).ready(function() {
    var idTable = $('#idTable').val();
    $("#" + idTable + " tbody").sortable({
        axis: 'y',
        group: 'serialization',
        delay: 100,
        helper: fixHelper,
        update: handleUpdate,
        stop: handleStop
    }).disableSelection();
});
var fixHelper = function (e, ui) {
    ui.children().each(function () {
        $(this).width($(this).width());
    });
    return ui;
};
var handleUpdate = function (event, ui) {
    // reset the values of sortnum --> update DB
    // resetSortNum();
    var sortableDataId = new Array();
    var minNo = null;
    var idTable = $('#idTable').val();
    $('#' + idTable + ' .ui-sortable-handle').each(function (indx) {
        sortableDataId.push($(this).attr('data-id'));
        var dataNo = parseInt($(this).attr('data-no'));
        if (minNo == null) {
            minNo = dataNo
        } else {
            minNo = dataNo > minNo ? minNo : dataNo;
        }
    });

    minNo = isNaN(minNo) ? 0 : minNo;
    var sortableData = new Array();
    var indx = minNo;
    sortableDataId.forEach(function (entry) {
        sortableData.push({'id': entry, "no": indx});
        indx++;
    });
    var idTable = $('#idTable').val();
    //console.log($('#' + idTable).attr('base-url'));
    $.ajax({
        url: $('#' + idTable).attr('base-url'),
        type: 'POST',
        data: {"minNo": minNo, "data": sortableData, "_token": $('input[name="_token"]').val()},
        success: function(rs) {

        }
    });
    //console.log(sortableData);
};

var handleStop = function (event, ui) {
    // reset the values of column "No"
    // resetNoColumn();
};
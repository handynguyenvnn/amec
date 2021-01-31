function pagination(table) {
    var settings = {
        "columnDefs": [{
            "searchable": false,
            "orderable": true,
            "targets": 0
        }, {
            "searchable": false,
            "orderable": true,
            "targets": 1
        }, {
            "searchable": false,
            "orderable": false,
            "targets": 2
        }, {
            "searchable": false,
            "orderable": false,
            "targets": 3
        }, {
            "searchable": false,
            "orderable": false,
            "targets": 4
        },
        ]
    };
    jQuery.extend(settings, dataTableSettings);
    table.DataTable(settings);
}

$(function () {
    var table = pagination($("#data-table"));
    $("#data-table_filter").remove();
});
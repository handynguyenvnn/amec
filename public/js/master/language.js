$(document).ready(function () {
    //initial data table
    pagination($("#dataTable"));
});
function pagination(table) {
    var settings = {
        "columnDefs": [{
            "searchable": false,
            "orderable": true,
            "targets": 0
        }, {
            "searchable": false,
            "orderable": false,
            "targets": 2
        }]
    };
    jQuery.extend(settings, dataTableSettings);
    table.DataTable(settings);
}
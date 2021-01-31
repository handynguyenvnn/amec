$(document).ready(function () {
    //initial data table
    pagination($("#dataTable"));
});
$(document).on('click', '.deleteBtn', function(){
    $("#modal-delete").modal('show');
    var id = $(this).attr("data-id");
    var url = "/users/"+id;
    $("#modal-delete form#delete-form").attr("action", url);
});
dataTableSettings.language.search = "クイック検索";
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
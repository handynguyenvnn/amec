// HTML document is ready
$(document).ready(function () {
    var th = $('#dataTable th');
    var sortBy = $('#sort_by');
    var orderBy = $('#order_by');
    var form = $('#form-search');
    var select = $('#data-table_length select');
    var perPage = $('#per_page');

    changePerPage(select, perPage, form);

    sort(th, form, sortBy, orderBy);

    generateDataTable(th, sortBy, orderBy, select, perPage);
});

function sort(th, form, sortBy, orderBy) {
    th.bind('click', function () {
        if($(this).data('field')){
            if (sortBy.val() !== $(this).data('field')) {
                sortBy.val($(this).data('field'));
                orderBy.val('asc');
            } else {
                orderBy.val(orderBy.val() === 'asc' ? 'desc' : 'asc');
            }
            form.trigger('submit');
        }
    });
}

function changePerPage(select, perPage, form) {
    select.bind('change', function(){
        perPage.val($(this).val());
        form.trigger('submit');
    });
}

function generateDataTable(th, sortBy, orderBy, select, perPage) {
    th.each(function () {
        var column = $(this);
        if (column.data('field')) {
            column.attr('class', 'sorting');
        }
    });

    switch (sortBy.val()) {
        case 'id':
            th.eq(0).attr('class', orderBy.val() === 'desc' ? 'sorting_desc' : 'sorting_asc');
            break;
        case 'name':
            th.eq(1).attr('class', orderBy.val() === 'desc' ? 'sorting_desc' : 'sorting_asc');
            break;
        case 'login_id':
            th.eq(2).attr('class', orderBy.val() === 'desc' ? 'sorting_desc' : 'sorting_asc');
            break;
        default:
            th.eq(0).attr('class', orderBy.val() === 'desc' ? 'sorting_desc' : 'sorting_asc');
            break;
    }

    select.val(perPage.val());
}



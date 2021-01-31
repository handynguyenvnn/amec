function sort(th, form, sortBy, orderBy) {
    th.bind('click', function () {
        if ($(this).data('field')) {
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
    select.bind('change', function () {
        perPage.val($(this).val());
        form.trigger('submit');
    });
}

function generateDataTable(th, sortBy, orderBy, select, perPage) {
    th.each(function () {
        var column = $(this);
        if (column.data('field')) {
            column.attr('class', 'sorting');
            if (sortBy.val() == column.data('field')) {
                column.attr('class', orderBy.val() === 'desc' ? 'sorting_desc' : 'sorting_asc')
            }
        }
    });
    select.val(perPage.val());
}

function dataTableGenerate(table, searchForm) {
    var th = table.find('th');
    var sortBy = $('#sort_by');
    var orderBy = $('#order_by');
    var selectChangePerPage = $('#data-table_length select');
    var perPage = $('#per_page');

    changePerPage(selectChangePerPage, perPage, searchForm);

    sort(th, searchForm, sortBy, orderBy);

    generateDataTable(th, sortBy, orderBy, selectChangePerPage, perPage);
}

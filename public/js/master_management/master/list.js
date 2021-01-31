function pagination(table){
    table.DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,"language": {
            "lengthMenu": "_MENU_ 件表示",
            "zeroRecords": "何も見つかりません",
            "info": "見せる _START_ に _END_ の _MAX_ エントリー",
            "infoEmpty": "レコードがありません",
            "infoFiltered": "(フィルタリングされた _MAX_ 総記録)",
            "paginate": {
                "previous": "前",
                "next": "次",
            },
            "search": "検索"
        },
        "order": [[ 1, 'asc' ]],
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        },{
            "searchable": false,
            "orderable": false,
            "targets": 3
        }, {
            "searchable": false,
            "orderable": false,
            "targets": 4
        }],
    });
}
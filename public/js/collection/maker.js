$(document).ready(function () {
    $('#modal-delete').on('show.bs.modal', function (event) {
        // Button that triggered the modal
        var action = $(event.relatedTarget).data('action');
        $('#delete-form').attr('action', action);
    });

    $(".delMaker").click(function(){
        var id = $(this).attr("data-id");
        $.ajax({
            url: "/makers/makers/checkuse",
            data: {'id':id},
            success: function (mess) {
                console.log(mess);
                if (mess == "yes"){
                    $("#modal-dismiss").modal("show");
                }else{
                    var urlDel = "/makers/makers/"+id;
                    $("#modal-delete").modal("show");
                    $("#modal-delete #delete-form").attr("action",urlDel);
                }
            },
            error: function (mess) {
                console.log('Error:', mess);
            }
        });
    });
});

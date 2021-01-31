<div class="modal fade bs-example-modal-xs" id="modal-delete" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form id="delete-form" action="" method="post">
                <input type="hidden" name="_method" value="delete"/>
                {{ csrf_field() }}
                <div class="modal-body">
                    <h4 class="text-center">データを削除します。</h4>
                    <h4 class="text-center">本当によろしいですか。</h4>
                </div>
                <div class="modal-footer button-delete">
                    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-primary">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#modal-delete').on('show.bs.modal', function (event) {
            // Button that triggered the modal
            var action = $(event.relatedTarget).data('action');
            $('#delete-form').attr('action', action);
        })
    });
</script>
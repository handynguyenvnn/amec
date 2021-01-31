<div class="modal fade bs-example-modal-xs" id="modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">言語を 入力してください</h4>
            </div>
            <form id="formEditLanguage" action="" method="post" class="form-horizontal">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="lang" class="control-label col-md-3">言語</label>
                                <div class="col-md-6">
                                    <input maxlength="32" type="text" class="form-control" name="lang" id="lang">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="lang_code" class="control-label col-md-3">言語コード</label>
                                <div class="col-md-6">
                                    <input maxlength="32" type="text" class="form-control" name="lang_code" id="lang_code">
                                </div>
                            </div>
                        </div>
                    </div>
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
        $('#modal-edit').on('show.bs.modal', function (event) {
            // Button that triggered the modal
            var input = $(event.relatedTarget);
            var action = input.data('action');
            $('#formEditLanguage #lang').val(input.data('lang'));
            $('#formEditLanguage #lang_code').val(input.data('code'));
            $('#formEditLanguage').attr('action', action);
        })
    });
</script>
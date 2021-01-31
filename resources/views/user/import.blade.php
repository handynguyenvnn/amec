@extends('layouts.app')

@section('title', 'EXCELをインポート')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/content_management/collection/list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/list.css') }}">
@endsection

@section('content-header')
    <h1>EXCELをインポート</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">ユーザー</a></li>
        <li class="active">ユーザー管理</li>
    </ol>
@endsection

@section('content')
    <div class="row user-module">
        <div class="col-xs-12">
            <div class="box box-info">
                <form method="post" enctype="multipart/form-data" id="form-search" class="form-horizontal"
                      action="{{ route('users.import') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">

                        <div class="form-group">
                            <label for="search" class="col-sm-2 control-label text-one text-bold">EXCELをインポート</label>
                            <div class="col-md-4">
                                <input type="file" class="form-control" name="userfile" id="userfile" >
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success btn-item ">インポート</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </form>

            </div>
            <!-- /.box-body -->
        </div>
    </div>
    </div>
    <!-- delete modal -->
    <div class="modal fade bs-example-modal-xs" id="modal-uploadcsv" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">CSV登録</h4>
                </div>
                <form id="store-form" action="{!! route("users.store") !!}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>
                            <input type="file" name="csv_file" accept=".xml" >
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-primary">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end delete modal -->
    <!-- delete modal -->
    <div class="modal fade bs-example-modal-xs" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form id="delete-form" action="" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="delete"/>
                    <div class="modal-body">
                        <h4 class="text-center">データを削除します。</h4>
                        <h4 class="text-center">本当によろしいですか？</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-primary">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end delete modal -->
@endsection

@section('javascript')
    <script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
    <script src="{{ asset('js/common/showPage.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dataTable.config.js') }}"></script>
    <script src="{{ asset('js/user/list.js') }}"></script>
    <script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
    <script src="{{ asset('js/common/showPage.js') }}"></script>
    <script>
        $("#userfile").fileinput({
            showUpload: false,
            uploadAsync: false,
            overwriteInitial: true,
            maxFileCount:1,
            language: "ja",
            showRemove: false,
            showClose: false,
            initialPreviewFileType: 'image',
            {{--initialPreview: [--}}
                    {{--"{{asset('img/default/no-xml.png') }}",--}}
                    {{--],--}}
            initialPreviewAsData: true,
            initialPreviewConfig: [
                { caption: "File", size: 847000},
            ],
            allowedFileExtensions: ["xls", "xlsx"]
        });
    </script>
@endsection
@extends('layouts.app')

@section('title', 'ユーザー管理')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/content_management/collection/list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/list.css') }}">
@endsection

@section('content-header')
    <h1>ユーザー管理</h1>
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
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-sm-2">
                            <a href="{{route('users-csv.download')}}" class="btn btn-block btn-info  btn-item">EXCEL出力</a>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{route('users-csv.import-excel')}}" class="btn btn-block btn-info  btn-item">EXCEL登録</a>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{route("certificate-settings.index")}}" class="btn btn-block btn-info  btn-item">認定証</a>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{route("notification_settings.index")}}" class="btn btn-block btn-info  btn-item">通知設定</a>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{route("users.action")}}" class="btn btn-block btn-info  btn-item">新規追加</a>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('messages'))
                    <div class="alert alert-success">
                        {{session('messages')}}
                    </div>
                @endif
                <form id="form-search" class="form-horizontal" method="get"
                      action="{{ route('users.index') }}">
                    <input type="hidden" name="sort_by" id="sort_by"
                           value="{{ isset($params['sort_by']) ? $params['sort_by'] : 'id' }}"/>
                    <input type="hidden" name="order_by" id="order_by"
                           value="{{ isset($params['order_by']) ? $params['order_by'] : 'desc' }}"/>
                    <input type="hidden" name="per_page" id="per_page"
                           value="{{ isset($params['per_page']) ? $params['per_page'] : 10 }}"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="search" class="col-sm-2 control-label text-one text-bold">クイック検索</label>
                            <div class="col-sm-4">
                                <input type="text" name="username" class="form-control " id="search" value="{{ isset($params['username']) ? $params['username'] : '' }}">
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success btn-item ">検索</button>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <table id="example1" class="table table-bordered table-striped dataTable">
                        <thead>
                        <tr>
                            <th data-field="id">ID</th>
                            <th>氏名</th>
                            <th>メールアドレス</th>
                            <th>エリア</th>
                            <th>認定証</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($data) > 0)
                            @foreach($data as $item)
                                <tr>
                                    <td>{!! $item->id !!}</td>
                                    <td>{!! $item->username !!}</td>
                                    <td>{!! $item->email !!}</td>
                                    <td>
                                            {!! $item->area !!}
                                    </td>
                                    <td>
                                        @if($item->user_id)
                                            有
                                        @else
                                            無
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('user-history.chapters', $item->id) }}" class="btn btn-xs btn-info">
                                            <i class="fa fa-history" aria-hidden="true"></i>
                                        </a>
                                        <a href="{!! route("users.action",$item->id) !!}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                        <button data-action="{{ route('users.destroy', $item->id) }}" type="button"
                                                class="btn btn-xs btn-danger"
                                                data-toggle="modal" data-target="#modal-delete"
                                                data-id="{!! $item->id !!}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="100%" class="text-center">
                            <span class="pull-left">{{ $data->total() }} 件中 {{ $data->firstItem()}}
                                から {{ $data->lastItem() }}</span>
                                {{ $data->appends($params)->links() }}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
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
                            <input type="file" name="csv_file" accept=".csv" >
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
            overwriteInitial: false,
            maxFileCount:1,
            language: "ja",
            showRemove: false,
            showClose: false,
            initialPreviewFileType: 'image',
            {{--initialPreview: [--}}
                    {{--"{{asset('img/default/no-xml.png') }}",--}}
                    {{--],--}}
            initialPreviewAsData: false,
            initialPreviewConfig: [
                { caption: "File", size: 847000},
            ],
            allowedFileExtensions: ["xls", "xlsx"]
        });
    </script>
@endsection
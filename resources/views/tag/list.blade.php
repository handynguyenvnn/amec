@extends('layouts.app')

@section('title', 'タグ一覧')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/collection/tag.css') }}">
@endsection

@section('content-header')
    <h1>タグ一覧</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:void(0)">ユーザー</a></li>
        <li class="active">ユーザー管理</li>
    </ol>
@endsection

@section('content')
    <!-- Default box -->
    <!-- InstanceBeginEditable name="content" -->
    <div class="box box-primary">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="box-header with-border">
            <div class="box-body">
                <div id="add-maker">
                    <form method="post" class="form-horizontal" action="{{ route("tags.store") }}" id="createForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputMakerName" class="col-sm-2 col-sm-offset-4 control-label">タグ名入力欄</label>

                                <div class="col-sm-4">
                                    <input type="text" name="name" maxlength="64" class="form-control" id="inputMakerName" >
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-success pull-right">追加</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
                <div id="search-maker">
                    <form class="form-horizontal" action="{!! route("makers.index") !!}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputMakerSearch" class="col-sm-2 col-sm-offset-4 control-label">タグ名</label>

                                <div class="col-sm-4">
                                    <input type="text" name="keyword" value="{!! $keyword !!}" class="form-control" id="inputMakerSearch">
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary pull-right">検索</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>メーカー名</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($data))
                        @foreach($data as $items)
                            <tr>
                                <td>{!! $items->id !!}</td>
                                <td>{!! $items->name !!}</td>
                                <td>
                                    <button data-action="{{ route('tags.destroy', $items->id) }}" type="button"
                                            class="btn btn-xs btn-danger"
                                            data-toggle="modal" data-target="#modal-delete"
                                            data-id="{!! $items->id !!}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                    @endforeach
                    @else
                    @endif
                </table>

                <div id="back-btn">
                    <a href="{!! route("collections.index") !!}" class="btn btn-default">
                        戻る
                    </a>
                </div>
            </div>
        </div>
        <!-- /.box-footer-->
    </div>

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
                        <button type="submit" class="btn btn-primary btn-submit">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/collection/tag.js') }}"></script>
@endsection
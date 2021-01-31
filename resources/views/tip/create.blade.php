@extends('layouts.app')
@section('title', 'チャプター編集')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/content_management/chapter/edit.css') }}">
@endsection
@section('content-header')
    <h1> チャプター編集</h1>
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">チャプター編集</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form id="form" class="form-horizontal" method="post" action="{{route('tips.store')}}">
                {{ csrf_field() }}
                <!-- /.box-header -->
                    <div class="box-body">
                        <div class="tool-bar">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="" class="col-sm-3 control-label text-right">チャプター名（日本語）</label>
                                    <div class="col-md-4 col-sm-9">
                                        <input type="text" class="form-control" id="" name="ja_name"
                                               placeholder="チャプター名（日本語)">
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="" class="col-sm-3 control-label text-right">チャプター名（英語）</label>
                                    <div class="col-md-4 col-sm-9">
                                        <input type="text" class="form-control" id="" name="en_name"
                                               placeholder="チャプター名（英語)">
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="" class="col-sm-3 control-label text-right">チャプター名（ベトナム）</label>
                                    <div class="col-md-4 col-sm-9">
                                        <input type="text" class="form-control" id="" name="vn_name"
                                               placeholder="チャプター名（ベトナム)">
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="" class="col-sm-3 control-label text-right">プロジェクト</label>
                                    <div class="col-md-4 col-sm-9">
                                        <select class="form-control" name="project_id">
                                            @foreach($optionProject as $op)
                                                <option value="{{$op->id}}">{{$op->id}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="" class="col-sm-3 control-label text-right">パーツ 名</label>
                                    <div class="col-md-4 col-sm-9">
                                        <input type="text" class="form-control" id="" name="version_name"
                                               placeholder="パーツ 名">
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="" class="col-sm-3 control-label text-right">コレクション</label>
                                    <div class="col-md-4 col-sm-9">
                                        <select class="form-control" name="collection_id">
                                            @foreach($optionCollection as $oc)
                                                <option value="{{$oc->id}}">{{$oc->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="" class="col-sm-3 control-label text-right">小テスト</label>
                                    <div class="col-md-4 col-sm-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="has_small_test" checked="" value="1"> はい
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="has_small_test" value="0"> いいえ<br>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="" class="col-sm-3 control-label text-right">管理番号</label>
                                    <div class="col-md-4 col-sm-9">
                                        <input type="number" class="form-control" id="" name="control_no"
                                               placeholder="管理番号">
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="" class="col-sm-3 control-label text-right">ファイルID</label>
                                    <div class="col-md-4 col-sm-9">
                                        <input type="text" class="form-control" id="" name="file_id"
                                               placeholder="ファイルID">
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="" class="col-sm-3 control-label text-right">フォルダID</label>
                                    <div class="col-md-4 col-sm-9">
                                        <input type="text" class="form-control" id="" name="folder_id"
                                               placeholder="フォルダID">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('chapters.index', $params) }}" class="btn btn-default">戻る</a>
                                <button type="submit" class="btn btn-info pull-right btn-submit">登録</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="../plugins/bootstrap-fileinput/js/fileinput.min.js"></script>
    <script src="../plugins/bootstrap-fileinput/js/locales/ja.js"></script>
    <script src="../plugins/AdminLTE/app.min.js"></script>
    <script src="{{ asset('js/content_management/chapter/edit.js') }}"></script>
@endsection

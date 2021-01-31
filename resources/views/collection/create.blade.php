@extends('layouts.app')

@section('title')
    コレクション編集
@endsection

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/collection/edit.css') }}">
@endsection

@section('content-header')
    <h1> コレクション編集 </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> ホーム</a></li>
        <li class="active">コレクション管理</li>
        <li class="active">コレクション編集</li>
    </ol>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <div class="col-xs-8 col-md-offset-2">
                <form id="createForm" class="form-horizontal" method="post" action="{{route("collections.store")}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputId" class="col-sm-3 control-label">コレクションNo</label>
                            <div class="col-sm-9">
                                <input type="text" name="collection_no" class="form-control"
                                       id="inputId" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputCollectionName"
                                   class="col-sm-3 control-label"><span style="color:red;">*</span>コレクション名</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control"
                                       id="inputCollectionName" name="name" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputCollectionName"
                                   class="col-sm-3 control-label">言語</label>

                            <div class="col-sm-9">
                                <select class="form-control" id="inputSelectShorui" name="language_id">
                                    @foreach($languages as $language)
                                        <option value="{{$language->id}}"
                                        >{{$language->lang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSelectReality"
                                   class="col-sm-3 control-label">レベル</label>

                            <div class="col-sm-9">
                                <select class="form-control" id="inputSelectShorui" name="level_id">
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id }}"
                                        >{{ $level->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSetsumeiJapanese"
                                   class="col-sm-3 control-label">説明
                            </label>

                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4" placeholder="" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file_upload_ja"
                                   class="col-sm-3 control-label">画像</label>

                            <div class="col-sm-9">
                                <div class="kv-avatar" style="width:200px">
                                    <input id="avatar-1" name="image_path" type="file" class="file-loading" required >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSetsumeiVietnamese"
                                   class="col-sm-3 control-label">Youtubeリンク
                            </label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="youtube_link">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSelectShorui"
                                   class="col-sm-3 control-label">メーカー(ローマ字)</label>

                            <div class="col-sm-9">
                                <select class="form-control" id="inputSelectShorui" name="maker_id">
                                    @foreach($makers as $maker)
                                        <option value="{{$maker->id}}">{{$maker->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="back-btn">
                                    <a href="{{route("collections.index")}}" class="btn btn-default">戻る</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="save-btn">
                                    <button type="submit" class="btn btn-info pull-right">更新
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/locales/ja.js') }}"></script>
    <script src="{{ asset('js/collection/edit.js') }}"></script>
    <script>
        $("#avatar-1").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            browseLabel: '',
            removeLabel: '',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',
            defaultPreviewContent: '<img src="../../img/no-image.png" alt="Your Avatar" style="width:160px">',
            layoutTemplates: {main2: '{preview} ' +  ' {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif"]
        });
    </script>
@endsection
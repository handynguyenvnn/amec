@extends('layouts.app')

@section('title', 'ユーザー管理')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/collection/edit.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/themes/explorer/theme.css') }}">
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

    <!-- Default box -->
    <!-- InstanceBeginEditable name="content" -->
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">登録・削除</h3>
                </div>
                <!-- /.box-header -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
            <!-- form start -->
                <form class="form-horizontal" id="createForm" method="post" action="{!! route("users.store") !!}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">言語</label>
                            <div class="col-md-6 col-sm-9">
                                <select name="language_id" id="language_id" class="form-control">
                                    @if(count($lang)>0)
                                        @foreach($lang as $ln)
                                            <option value="{!! $ln->id !!}">
                                                {!! $ln->lang !!}
                                            </option>
                                        @endforeach
                                    @else
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label"><span class="text-red">※</span>&nbsp;氏名</label>
                            <div class="col-md-6 col-sm-9">
                                <input type="text" class="form-control" name="username" id="username" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label"><span class="text-red">※</span>&nbsp;メールアドレス</label>
                            <div class="col-md-6 col-sm-9">
                                <input type="email" class="form-control" name="email" id="email" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label"><span class="text-red">※</span>&nbsp;パスワード</label>
                            <div class="col-md-6 col-sm-9">
                                <input type="password" class="form-control" name="password" id="password" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="text-red">※</span>&nbsp; 性別</label>
                            <div class="col-md-6 col-sm-9">
                                <label>
                                    <input type="radio" name="gender" value="1" class="minimal" checked>
                                    男
                                </label>
                                &nbsp;&nbsp;
                                <label>
                                    <input type="radio" name="gender" value="0" class="minimal">
                                    女
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label"><span class="text-red">※</span>&nbsp;エリア</label>
                            <div class="col-md-4 col-sm-9">
                                <select name="area_id" id="area_id" class="form-control">
                                    @if(count($areas))
                                        @foreach($areas as $area)
                                            <option value="{!! $area->id !!}">
                                                {!! $area->area !!}
                                            </option>
                                        @endforeach
                                    @else
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">職業</label>
                            <div class="col-md-4 col-sm-9">
                                <select name="profession_id" id="profession_id" class="form-control">
                                    @if(count($professions))
                                        @foreach($professions as $profession)
                                            <option value="{!! $profession->id !!}">
                                                {!! $profession->profession !!}
                                            </option>
                                        @endforeach
                                    @else
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">電話番号</label>
                            <div class="col-md-6 col-sm-9">
                                <input type="text" class="form-control" name="phone" id="phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">ユーザ登録日</label>
                            <div class="col-md-6 col-sm-9">
                                <input type="text" class="form-control" name="registration_date"
                                       id="registration_date" disabled >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">最終ログイン日</label>
                            <div class="col-md-6 col-sm-9">
                                <input type="text" class="form-control" name="last_login_date" id="last_login_date" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">認定証</label>
                            <div class="col-md-1 col-sm-3">
                                <input type="text" class="form-control text-center" name="" id="" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">ユーザ写真</label>
                            <div class="col-md-6 col-sm-9">
                                <div class="kv-avatar">
                                    <input id="avatar-1" name="image_path" type="file" class="file-loading">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">内容</label>
                            <div class="col-md-6 col-sm-9">
                                <textarea name="contents" id="contents" cols="30" rows="10" class="form-control">
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-6 col-sm-9 col-sm-offset-3">
                                <a href="{!! route("collections.index") !!}" class="btn btn-info">戻る</a>
                                <button type="submit" class="btn btn-success pull-right">更新</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
    <!-- InstanceEndEditable -->
    <!-- /.box -->

@endsection

@section('javascript')
    <script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/locales/ja.js') }}"></script>
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/user/edit.js') }}"></script>
    <script>
        $("#avatar-1").fileinput({
            showUpload: false,
            uploadAsync: false,
            overwriteInitial: true,
            maxFileCount:1,
            initialPreviewFileType: 'image',
            initialPreview: [
                "{{$data->image_path ? $data->image_path : asset('img/default/no-image.jpg') }}",
            ],
            initialPreviewAsData: true,
            initialPreviewConfig: [
                { caption: "Image", size: 847000},
            ],
            allowedFileExtensions: ["jpg", "png", "gif"]
        });
    </script>
@endsection
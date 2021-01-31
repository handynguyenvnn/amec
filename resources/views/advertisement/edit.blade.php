@extends('layouts.app')
@section('title', 'グレード編集')
@section('content-header')
    <h1> 広告管理
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">広告管理 </li>
    </ol>
@endsection
@section('content')
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" id="form" class="form-horizontal" action="{{route('advertisements.update', $data['id'])}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="box-header with-border">
                                <div class="form-group">
                                    <label for="content" class="col-sm-2 control-label">コンテンツ広告</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="content" name="content_ad">
                                            @foreach($onOff as $key => $oo)
                                                <option value="{{$key}}"
                                                @if ($key == $data['content_ad'])
                                                    {{'selected'}}
                                                    @endif
                                                >{{$oo}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gacha" class="col-sm-2 control-label">ガチャ広告</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="gacha" name="gacha_ad">
                                            @foreach($onOff as $key => $oo)
                                                <option value="{{$key}}"
                                                @if ($key == $data['gacha_ad'])
                                                    {{'selected'}}
                                                        @endif
                                                >{{$oo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="banner" class="col-sm-2 control-label">バナー広告</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="banner" name="banner_ad">
                                            @foreach($onOff as $key => $oo)
                                                <option value="{{$key}}"
                                                @if ($key == $data['banner_ad'])
                                                    {{'selected'}}
                                                        @endif
                                                >{{$oo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <!-- end box-header -->
                        <div class="box-body with-border ">
                                <div class="card-baai">
                                    <div class="card-baai-round">
                                        @foreach($data['image'] as $key => $image)
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">広告動画</label>
                                            <div class="col-sm-5">
                                                <img src="" height="120" width="200">
                                                <input id="file_upload_ja" type="file" name="img" class="file" accept=".gif,.jpg,.png,.mp4" />
                                            </div>
                                        </div>
                                    @endforeach
                                        <!--//Template for row add last-->
                                        <script id="template" type="x-tmpl-mustache">
                                        <iframe src="template.html" frameborder="0" width="100%" height="300"></iframe>
                                    </script>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5 col-sm-offset-2">
                                            <div class="error color-error">対応しているフォーマットのmp4を入れてください。</div>
                                            <button type="button" class="btn btn-success addMore" style="width: 100%;" >
                                                <i class="fa fa-fw fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-9">
                                    <a href ="{{route('advertisements.index')}}" class="btn btn-default btn-back">戻る</a>
                                    <button type="submit" class="btn btn-info pull-right btn-submit">登録</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection
@section('javascript')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ asset('js/content_management/grade/edit.js') }}"></script>
<script src="{{ asset('js/content_management/grade/list.js') }}"></script>
<script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
<script src="{{ asset('js/common/showPage.js') }}"></script>
@endsection

@extends('layouts.app')
@section('title', 'お知らせ編集')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/announcements/list.css') }}">
@endsection
<!-- Content Header (Page header) --><!-- InstanceBeginEditable name="title" -->
@section('content-header')
    <h1> お知らせ編集
        <!--<small>it all starts here</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="../index.html"><i class="fa fa-dashboard"></i> ホーム</a></li>
        <li><a href="{{ route('announcements.index', $params) }}"> コンテンツ管理</a></li>
        <li class="active"> お知らせ編集</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <form id="form" class="form-horizontal" method="post" action="{{route('announcements.store')}}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        @include('partials.error')
                        <div class="form-group">
                            <label for="inputTitle" class="col-sm-2 control-label">ID</label>
                            <div class="col-sm-8">
                                <p class="form-control-static"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTitle" class="col-sm-2 control-label"><span class="text-red">※</span>件名</label>

                            <div class="col-sm-8">
                                <input maxlength="100" type="text" class="form-control" id="subject" name="subject" placeholder="件名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">言語</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="language_id" id="language_id">
                                    @foreach($languages as $language)
                                        <option value="{{$language->id}}">{{$language->lang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">エリア</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="area_id" id="area_id">
                                    @foreach($areas as $area)
                                        <option value="{{$area->id}}">{{$area->area}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-red">※</span>内容</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="7" placeholder="" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <a href="{{ route('announcements.index', $params) }}" class="btn btn-default">戻る</a>
                                <button type="submit" class="btn btn-info pull-right btn-submit">登録</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/validate.config.js') }}"></script>
    <script src="{{ asset('js/collection/announcement.js') }}"></script>
@endsection
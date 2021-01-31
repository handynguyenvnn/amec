@extends('layouts.app')
@section('title', 'お知らせ編集')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/announcements/list.css') }}">
@endsection

@section('content-header')
    <h1> お知らせ編集</h1>
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
                <!-- form start -->
                <form id="form" class="form-horizontal" method="post" action="{{ (empty($data))? route('announcements.store') : route('announcements.update', $data->id) }}">
                    {{ csrf_field() }}
                    @if(!empty($data))
                    {{ method_field('PUT') }}
                    @endif
                    <div class="box-body">
                        @include('partials.error')
                        <div class="form-group">
                            <label for="inputId" class="col-sm-2 control-label">ID</label>
                            <div class="col-sm-8">
                                <p class="form-control-static">{{ $data->id }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTitle" class="col-sm-2 control-label"><span class="text-red">※</span>件名</label>

                            <div class="col-sm-8">
                                <input maxlength="100" type="text" class="form-control" name="subject" id="inputTitle" value="{!! $data->subject !!}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">言語</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="language_id" id="language_id">
                                    @foreach($languages as $language)
                                        <option @if($data->language->id == $language->id) {{"selected"}} @endif value="{{$language->id}}">
                                            {{$language->lang}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">エリア</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="area_id"  id="area_id">
                                    @foreach($areas as $area)
                                        <option @if($data->area->id == $area->id) {{"selected"}} @endif value="{{$area->id}}">
                                            {{$area->area}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="text-red">※</span>内容</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="7" placeholder="" name="description">{!! $data->description !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <a href="{{ route('announcements.index', $params) }}" class="btn btn-default">戻る</a>
                                <button type="submit" class="btn btn-warning pull-right btn-submit">更新</button>
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
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/validate.config.js') }}"></script>
    <script src="{{ asset('js/collection/announcement.js') }}"></script>
    <script>
        $(document).ready( function(){
            $("#language_id").change( function(){
                var language_id = $(this).val();
                $.get("/announcement/area/"+language_id,function (data){
                    $("#area_id").html(data);
                });
            });
        });


    </script>
@endsection
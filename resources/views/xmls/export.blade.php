@extends('layouts.app')

@section('title', 'エクスポート管理')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/list.css') }}">
@endsection

@section('content-header')
    <h1>エクスポート管理</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">データ管理</a></li>
        <li class="active">エクスポート管理</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-info">
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
                <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="box-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ method_field('POST') }}
                        <br />
                        <div class="box-body">
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">言語</label>
                                <div class="col-sm-3">
                                    <select name="language_id" id="language_id" class="form-control">
                                        @if(count($languages)>0)
                                            @foreach($languages as $ln)
                                                <option value="{!! $ln->id !!}">{!! $ln->lang !!}</option>
                                            @endforeach
                                        @else
                                        @endif
                                    </select>
                                </div>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<label for="" class="col-sm-3 control-label">内容タイプ</label>--}}
                                {{--<div class="col-sm-3">--}}
                                    {{--<select name="content_type" id="content_type" class="form-control">--}}
                                        {{--@foreach($contentType as $key=>$label)--}}
                                            {{--<option value="{!! $key !!}">{!! $label !!}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        {{--<a href="{{ route('master.index' ) }}" class="btn btn-default">戻る</a>--}}
                                        <button type="submit" class="btn btn-info pull-right">エクスポート</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

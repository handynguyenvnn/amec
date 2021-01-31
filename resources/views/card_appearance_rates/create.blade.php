@extends('layouts.app')
@section('title', 'カード出現率')
@section('content-header')
    <h1> カード出現率
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">カード出現率</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="post" id="form" class="form-horizontal"
                  action="{{route('card-appearance-rates.store')}}">
                {{ csrf_field() }}
                <div class="box-header with-border">
                    <div class="form-group">
                        <label for="content" class="col-sm-2 control-label">コレクション</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="content" name="collection_id">
                                <option value> ---------- </option>
                                @foreach( $collections as $collection)
                                    <option value="{{$collection->id}}"
                                    > {{$collection->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gacha" class="col-sm-2 control-label">ユーザ</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="gacha" name="user_id">
                                <option value> ---------- </option>
                                @foreach( $users as $user)
                                    <option value="{{$user->id}}"
                                    > {{$user->username}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="banner" class="col-sm-2 control-label"> レベル</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="banner" name="level_id">
                                <option value> ---------- </option>
                                @foreach( $levels as $level)
                                    <option value="{{$level->id}}"
                                    > {{$level->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="banner" class="col-sm-2 control-label"> 出現率</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="occurrence_rate" placeholder="出現率"
                                   >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="banner" class="col-sm-2 control-label"> ガチャ</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="banner" name="has_gacha">
                                <option value> ---------- </option>
                                @foreach( $onOff as $key => $oo)
                                    <option value="{{$key}}"
                                    > {{$oo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-9">
                                <a href="{{route('card-appearance-rates.index')}}"
                                   class="btn btn-default btn-back">戻る</a>
                                <button type="submit" class="btn btn-info pull-right btn-submit">登録</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ asset('js/content_management/grade/edit.js') }}"></script>
<script src="{{ asset('js/content_management/grade/list.js') }}"></script>
<script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
<script src="{{ asset('js/common/showPage.js') }}"></script>

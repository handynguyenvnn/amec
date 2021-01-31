@extends('layouts.app')

@section('title', 'メインナビゲーション')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/form.css')}}">
    <link rel="stylesheet" href="{{ asset('css/user/list.css')}}">
@endsection

@section('content-header')
    <h1> メインナビゲーション</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('accounts.index', $params) }}">ユーザー管理</a></li>
        <li class="active">メインナビゲーション</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">登録・削除</h3>
                </div>
                <form class="form-horizontal" id="createForm" method="post" action="{{ route('accounts.store') }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        @include('partials.error')
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">ID</label>
                            <div class="col-md-6 col-sm-9">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label"><span class="text-red">※</span>&nbsp;管理者名</label>
                            <div class="col-md-6 col-sm-9">
                                <input maxlength="64" type="text" class="form-control" id="name" name="name" value="{{ old('name'?:'') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login_id" class="col-sm-3 control-label"><span class="text-red">※</span>&nbsp;アカウントID</label>
                            <div class="col-md-6 col-sm-9">
                                <input maxlength="64" type="text" class="form-control" name="login_id" id="login_id" value="{{ old('login_id'?:'') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label"><span class="text-red">※</span>パスワード</label>
                            <div class="col-md-6 col-sm-9">
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="roles" class="col-sm-3 control-label"><span class="text-red">※</span>権限</label>
                            <div class="col-md-6 col-sm-9 acc-roles">
                                <div class="row">
                                    @foreach($roles as $role)
                                    <div class="col-sm-6">
                                        <label>
                                            <input type="checkbox" name="roles[]" value="{{ $role->slug }}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">ロック</label>
                            <div class="col-md-6 col-sm-9" style="margin-top:7px">
                                <label>
                                    <input type="radio" name="lock" class="minimal form-control" value="0" checked>
                                    無
                                </label>
                                &nbsp;&nbsp;
                                <label>
                                    <input type="radio" name="lock" class="minimal form-control" value="1">
                                    有
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-6 col-sm-9 col-sm-offset-3">
                                <a href="{{ route('accounts.index', $params) }}" class="btn btn-default">戻る</a>
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
    <script type="text/javascript">
        var passRequired = true;
    </script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/locales/ja.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/AdminLTE/app.min.js')}}"></script>
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/validate.config.js') }}"></script>
    <script src="{{ asset('js/account/form.js') }}"></script>
@endsection
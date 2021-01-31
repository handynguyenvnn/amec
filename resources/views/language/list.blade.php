@extends('layouts.app')

@section('title', 'マスター管理')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content-header')
    <h1> マスター管理 </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">マスター管理</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('partials.error')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">リスト</h3>
                    <div class="box-tools">
                        <button class="btn btn-info">広告</button>
                        <button class="btn btn-info">コマカテゴリ</button>
                        <button class="btn btn-info">使い方編集</button>
                        <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modal-add">新規言語</button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="dataTable" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>管理者名</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->lang }}</td>
                                <td>
                                    <button data-action="{{ route('languages.update', $row->id) }}" type="button"
                                            class="btn btn-xs btn-warning" data-toggle="modal"
                                            data-target="#modal-edit" data-lang="{{ $row->lang }}" data-code="{{ $row->lang_code }}">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button data-action="{{ route('languages.destroy', $row->id) }}" type="button"
                                            class="btn btn-xs btn-danger" data-toggle="modal"
                                            data-target="#modal-delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('partials.modals.delete')
    @include('language.modals.create_language')
    @include('language.modals.edit_language')
@endsection

@section('javascript')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dataTable.config.js') }}"></script>
    <script src="{{ asset('js//validate.config.js') }}"></script>
    <script src="{{ asset('js/master/language.js') }}"></script>
    <script src="{{ asset('js/master/add_language.js') }}"></script>
@endsection
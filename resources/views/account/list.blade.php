@extends('layouts.app')

@section('title', 'アカウント管理')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content-header')
    <h1> アカウント管理</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ユーザー管理</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">サーチ</h3>
                </div>
                <div class="col-sm-10 text-right">
                    <a class="btn btn-success" href="{{ route('accounts.create') }}">新規登録</a>
                </div>
                <div class="box-body">
                    <form action="{{ route('accounts.index') }}" method="get" id="form-search" class="form-horizontal">
                        <input type="hidden" name="sort_by" id="sort_by" value="{{ isset($params['sort_by']) ? $params['sort_by'] : 'id' }}"/>
                        <input type="hidden" name="order_by" id="order_by" value="{{ isset($params['order_by']) ? $params['order_by'] : 'asc' }}"/>
                        <input type="hidden" name="per_page" id="per_page" value="{{ isset($params['per_page']) ? $params['per_page'] : 10 }}"/>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">管理者名</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="name" name="name" class="form-control" value="{{ isset($params['name']) ? $params['name'] : '' }}"/>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary">検索</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">リスト</h3>
                    <div class="box-tools">
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="dataTables_length" id="data-table_length">
                                <label>
                                    <select name="data-table_length" aria-controls="data-table" class="form-control input-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    件表示
                                </label>
                            </div>
                        </div>
                    </div>
                    <table id="dataTable" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr>
                            <th data-field="id">ID</th>
                            <th data-field="name">管理者名</th>
                            <th data-field="login_id">アカウントID</th>
                            <th>ロック</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->login_id }}</td>
                            <td>無</td>
                            <td>
                                <a href="{{ route('accounts.edit', $row->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                <button data-action="{{ route('accounts.destroy', $row->id) }}" type="button"
                                        class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="100%" class="text-center">
                                <span class="pull-left page-info">{{ $data->total() }} 件中 {{ $data->firstItem()}} から {{ $data->lastItem() }}</span>
                                {{ $data->appends($params)->links() }}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('partials.modals.delete')
@endsection

@section('javascript')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/account/list.js') }}"></script>
@endsection
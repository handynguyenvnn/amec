@extends('layouts.app')
@section('title', 'カード出現率')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/master_management/advertisement/list.css') }}">
@endsection
@section('content-header')
    <h1> カード出現率
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">カード出現率 </li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="nav-tabs-custom">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_2">
                                    <a href="{{ route('card-appearance-rates.create')}}" class="btn btn-success pull-right btn-submit">新規登録</a>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="dataTables_length" id="data-table_length">
                                                <label>
                                                    <select name="data-table_length" aria-controls="data-table"
                                                            class="form-control input-sm">
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
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form method="get" id="form-search" class="form-horizontal"
                                                  action="{{ route('card-appearance-rates.index') }}">
                                                <input type="hidden" name="sort_by" id="sort_by"
                                                       value="{{ isset($params['sort_by']) ? $params['sort_by'] : 'id' }}"/>
                                                <input type="hidden" name="order_by" id="order_by"
                                                       value="{{ isset($params['order_by']) ? $params['order_by'] : 'asc' }}"/>
                                                <input type="hidden" name="per_page" id="per_page"
                                                       value="{{ isset($params['per_page']) ? $params['per_page'] : 10 }}"/>

                                                <div class="box-body">
                                                    <div class="form-group">
                                                            <div class="row">
                                                                <label for="inputMakerSearch" class="col-sm-1 control-label">コレクション</label>
                                                                <div class="col-lg-2">
                                                                    <input type="text" class="form-control" name="collection_name" id="collection_name"
                                                                           placeholder="コレクション"
                                                                           value="{{ isset($params['collection_name']) ? $params['collection_name'] : '' }}">
                                                                </div>
                                                                <label for="inputMakerSearch" class="col-sm-1 control-label">ユーザ</label>
                                                                <div class="col-lg-2">
                                                                    <input type="text" class="form-control" name="username" id="username"
                                                                           placeholder="ユーザ"
                                                                           value="{{ isset($params['username']) ? $params['username'] : '' }}">
                                                                </div>
                                                                <label for="inputMakerSearch" class="col-sm-1 control-label">レベル</label>
                                                                <div class="col-lg-2">
                                                                    <input type="text" class="form-control" name="level_name" id="level_name"
                                                                           placeholder="レベル"
                                                                           value="{{ isset($params['level_name']) ? $params['level_name'] : '' }}">
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <button type="submit" class="btn btn-primary pull-right btn-submit">検索
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                        <table class="table table-bordered table-hover dataTable">
                                            <thead>
                                            <tr>
                                                <th data-field="id">ID</th>
                                                <th> コレクション </th>
                                                <th>ユーザ</th>
                                                <th>レベル</th>
                                                <th>出現率</th>
                                                <th>ガチャ</th>
                                                <th colspan="3">操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($data))
                                                @foreach($data as $items)
                                                    <tr>
                                                        <td>{{$items->id}}</td>
                                                        <td>{{$items->collection_name}}</td>

                                                        <td>
                                                            {{$items->username}}
                                                        </td>
                                                        <td>
                                                           {{$items->level_name}}
                                                        </td>
                                                        <td>
                                                            {{$items->occurrence_rate}}%
                                                        </td>
                                                        <td>
                                                            @if($items->has_gacha ==0)
                                                                {{'OFF'}}
                                                            @else
                                                                {{'ON'}}
                                                            @endif
                                                        </td>
                                                        <td width="50"><button class=" btn btn-default btn-sm"><i class="fa fa-copy"></i></button></td>
                                                        <td width="50"><a href="{{route('card-appearance-rates.edit', $items->id)}}" class="  btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a></td>
                                                        <td>
                                                            <button data-action="{{route('card-appearance-rates.destroy', $items->id)}}" type="button"
                                                                    class="  btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td colspan="100%" class="text-center">
                            <span class="pull-left">{{ $data->total() }} 件中 {{ $data->firstItem()}}
                                から {{ $data->lastItem() }}</span>
                                                    {{ $data->appends($params)->links() }}
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade bs-example-modal-xs" id="modal-delete" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <form id="delete-form" action="" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete"/>
                                        <div class="modal-body">
                                            <h4 class="text-center">データを削除します。</h4>
                                            <h4 class="text-center">本当によろしいですか？</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                                            <button type="submit" class="btn btn-primary">OK</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#" class="btn btn-info">戻る</a>
                        </div>
                    </div>
                </div>
            </div>
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

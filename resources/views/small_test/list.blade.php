@extends('layouts.app')
@section('title', '小テスト問題編集')
@section('stylesheet')
    {{--<link rel="stylesheet" href="{{ asset('css/master_management/advertisement/list.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/content_management/small_test/action.css') }}">
    <link rel="stylesheet" href="{{ asset('css/content_management/small_test/edit.css') }}">
@endsection
@section('content-header')
    <h1> 小テスト問題
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">広告管理 </li>
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
                                    <form method="get" id="form-search" class="form-horizontal"
                                          action="{{ route('advertisements.index') }}">
                                        <input type="hidden" name="sort_by" id="sort_by"
                                               value="{{ isset($params['sort_by']) ? $params['sort_by'] : 'id' }}"/>
                                        <input type="hidden" name="order_by" id="order_by"
                                               value="{{ isset($params['order_by']) ? $params['order_by'] : 'asc' }}"/>
                                        <input type="hidden" name="per_page" id="per_page"
                                               value="{{ isset($params['per_page']) ? $params['per_page'] : 10 }}"/>

                                        <table class="table table-bordered table-hover dataTable">
                                            <thead>
                                            <tr>
                                                <th data-field="id">ID</th>
                                                <th> 合格点正答率 </th>
                                                <th>タイトル</th>
                                                <th>問題数</th>
                                                <th>配点</th>
                                                <th colspan="3">操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($data))
                                                @foreach($data as $items)
                                                    <tr>
                                                        <td>{{$items->id}}</td>

                                                        <td>
                                                            {{$items->pass_score_rate }} %
                                                        </td>
                                                        <td>
                                                            {{$items->title}}
                                                        </td>
                                                        <td>
                                                           {{$items->num_issues}}
                                                        </td>
                                                        <td>
                                                            {{$items->score}}
                                                        </td>
                                                        <td width="50"><a href="{{route('small_tests.edit', $items->id)}}" class="  btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a></td>
                                                        <td>
                                                            <button data-action="{{route('small_tests.destroy', $items->id)}}" type="button"
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

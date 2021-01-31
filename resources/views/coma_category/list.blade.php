@extends('layouts.app')
@section('title', 'コマカテゴリ管理')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/user-management/announcements.css') }}">
@endsection
@section('content-header')
    <h1> コマカテゴリ管理
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> ホーム</a></li>
        <li><a href="javascript:void(0)">マスター管理 </a></li>
        <li class="active">コマカテゴリ管理</li>
    </ol>
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="box-body">
                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#myModal">新規
                </button>
                <div class="row">
                    <div class="col-lg-3">
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
                    <div class="col-lg-9">
                        <form method="get" id="form-search" class="form-horizontal"
                              action="{{ route('coma-categories.index') }}">
                            <input type="hidden" name="sort_by" id="sort_by"
                                   value="{{ isset($params['sort_by']) ? $params['sort_by'] : 'id' }}"/>
                            <input type="hidden" name="order_by" id="order_by"
                                   value="{{ isset($params['order_by']) ? $params['order_by'] : 'asc' }}"/>
                            <input type="hidden" name="per_page" id="per_page"
                                   value="{{ isset($params['per_page']) ? $params['per_page'] : 10 }}"/>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputMakerSearch" class="col-sm-2 control-label">カテゴリ名</label>

                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="frame_category_name"
                                                       id="subject"
                                                       placeholder="カテゴリ名"
                                                       value="{{ isset($params['subject']) ? $params['subject'] : '' }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-primary pull-right btn-submit">検索
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table id="example1" class="table table-bordered table-striped dataTable">
                <thead>
                <tr>
                    <th data-field="id">No</th>
                    <th>カテゴリ名</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @if(count($data))
                    @foreach($data as $items)
                        <tr>
                            <td>{!! $items-> coma_category_no !!}</td>
                            <td>{!! $items->frame_category_name !!}</td>
                            <td>
                                <button data-action="{{ route('coma-categories.update', $items->coma_category_no) }}" type="button"
                                        class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-edit"
                                        id="show_value_edit"
                                        data-id="{!! $items->coma_category_no !!}">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button data-action="{{ route('coma-categories.destroy', $items->coma_category_no) }}" type="button"
                                        class="btn btn-xs btn-danger"
                                        data-toggle="modal" data-target="#modal-delete"
                                        data-id="{!! $items->coma_category_no !!}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
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
        </div>
    </div>
    </div>
    <div class="modal fade bs-example-modal-xs" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form id="delete-form" action="" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
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
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header block">
                    <button type="button" class="close btn-one" data-dismiss="modal">&times;</button>
                    <h4 class="text-center">カテゴリ名を</h4>
                    <h4 class="text-center">入力してください</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{route("coma-categories.store")}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        @foreach( $languages as $key => $language)
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="name">{{$language->lang}}</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="" maxlength="62" placeholder=""
                                       name="{{$language->lang_code}}_frame_category_name">
                            </div>
                        </div>
                        @endforeach
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-update">更新</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header block">
                    <button type="button" class="close btn-one" data-dismiss="modal">&times;</button>
                    <h4 class="text-center">カテゴリ名を</h4>
                    <h4 class="text-center">入力してください</h4>
                </div>
                <div class="modal-body">
                    <form id="edit-form" class="form-horizontal" action="{{route("coma-categories.store")}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" class="form-control" id="coma_category_no" placeholder=""
                               name="coma_category_no" value="">
                        @foreach( $languages as $key => $language)
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="name">{{$language->lang}}</label>
                            <div class="col-sm-7">

                                <input type="hidden" class="form-control" id="{{$language->lang_code}}_id" placeholder=""
                                       name="{{$language->lang_code}}_id" value="">
                                <input type="text" class="form-control" id="{{$language->lang_code}}_input_value_edit" placeholder=""
                                       name="{{$language->lang_code}}_frame_category_name" value="">
                            </div>

                        </div>
                        @endforeach
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-update btn-submit">更新</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
    <script src="{{ asset('js/common/showPage.js') }}"></script>
    <script>
    $(document).ready(function() {
        $('.table').on('click', '#show_value_edit', function () {
            var no = $(this).attr('data-id');
            var url = '/coma-category-get-by-no/' + no;
            $.get(url, function (response) {
               @foreach ($languages as $key => $language)
                       $('#{{$language->lang_code}}_id').val(response.{{$language->lang_code}}_id);
                       $('#coma_category_no').val(response.coma_category_no);
                       $('#{{$language->lang_code}}_input_value_edit').val(response.{{$language->lang_code}}_frame_category_name);
                @endforeach
            });
        });
    });
    </script>
@endsection

@extends('layouts.app')
@section('title', 'お知らせ')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/user-management/announcements.css') }}">
@endsection
@section('content-header')
    <h1> お知らせ
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> ホーム</a></li>
        <li><a href="javascript:void(0)"> コンテンツ管理</a></li>
        <li class="active"> お知らせ</li>
    </ol>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="box-body">
                <a href="{{ route('announcements.action')}}" class="btn btn-success pull-right btn-submit">新規登録</a>
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
                    <div class="col-sm-9">
                        <form method="get" id="form-search" class="form-horizontal"
                              action="{{ route('announcements.index') }}">
                            <input type="hidden" name="sort_by" id="sort_by"
                                   value="{{ isset($params['sort_by']) ? $params['sort_by'] : 'id' }}"/>
                            <input type="hidden" name="order_by" id="order_by"
                                   value="{{ isset($params['order_by']) ? $params['order_by'] : 'asc' }}"/>
                            <input type="hidden" name="per_page" id="per_page"
                                   value="{{ isset($params['per_page']) ? $params['per_page'] : 10 }}"/>

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputMakerSearch" class="col-sm-1 control-label">件名</label>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="subject" id="subject"
                                                       placeholder="件名"
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
                <table id="example1" class="table table-bordered table-striped dataTable">
                    <thead>
                    <tr>
                        <th data-field="id">ID</th>
                        <th>件名</th>
                        <th>言語</th>
                        <th>エリア</th>
                        <th>更新日</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($data))
                        @foreach($data as $items)
                            <tr>
                                <td>{!! $items->id !!}</td>
                                <td>{!! $items->subject !!}</td>
                                <td>{!! $items->language->lang !!}</td>
                                <td>{!! $items->area->area !!}</td>
                                <td>{!! date('Y/m/d',strtotime($items->updated_at)) !!}</td>
                                <td>
                                    <a href="{{ route('announcements.action', $items->id) }}"
                                       class="btn btn-xs btn-warning "><i class="fa fa-pencil"></i></a>
                                    <button data-action="{{ route('announcements.destroy', $items->id) }}" type="button"
                                            class="btn btn-xs btn-danger"
                                            data-toggle="modal" data-target="#modal-delete"
                                            data-id="{!! $items->id !!}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
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
                        <button type="submit" class="btn btn-primary btn-submit">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
    <script src="{{ asset('js/user-management/announcement.js') }}"></script>
@endsection

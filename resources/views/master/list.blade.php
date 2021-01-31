@extends('layouts.app')
@section('title', 'マスター管理')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/master_management/master/list.css') }}">
@endsection
@section('content-header')
    <h1> マスター管理
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> ホーム</a></li>
        <li class="active">マスター管理 </li>
    </ol>
@endsection
@section('content')
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-info">
                        <!-- end box-header -->
                        <div class="box-header with-border">
                            <div class="row">
                                <div class="col-sm-3">
                                    <a href="{{route("advertisements.action")}}" class="btn btn-block btn-info  btn-item">広告</a>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{route("coma-categories.index")}}" class="btn btn-block btn-info  btn-item">コマカテゴリ</a>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{route("guides.index")}}" class="btn btn-block btn-info  btn-item">使い方編集</a>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-block btn-info  btn-item" data-toggle="modal" data-target="#add-language">新規言語</button>
                                </div>
                            </div>
                        </div>
                        <form method="get" id="form-search" class="form-horizontal"
                              action="{{ route('master.index') }}">
                            <input type="hidden" name="sort_by" id="sort_by"
                                   value="{{ isset($params['sort_by']) ? $params['sort_by'] : 'id' }}"/>
                            <input type="hidden" name="order_by" id="order_by"
                                   value="{{ isset($params['order_by']) ? $params['order_by'] : 'asc' }}"/>
                            <input type="hidden" name="per_page" id="per_page"
                                   value="{{ isset($params['per_page']) ? $params['per_page'] : 10 }}"/>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="search" class="col-sm-2 col-sm-offset-3 control-label text-one text-bold">言語</label>

                                    <div class="col-sm-2">
                                        <input type="text" name="lang" class="form-control " id="search" value="{{ isset($params['lang']) ? $params['lang'] : '' }}">
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success btn-item ">検索</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </form>
                        <table id="data-table" class="table table-bordered table-hover dataTable">
                            <thead>
                            <tr>
                                <th data-field="id">ID</th>
                                <th>言語</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $items)
                            <tr>
                                <td>{{$items->id }}</td>
                                <td>{{$items->lang }}</td>
                                <td>
                                    <button id="button_edit" data-action="{{route('master.update', $items->id)}}" data-id="{{$items->id}}" type="button"
                                            class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-language">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button data-action="{{ route('master.destroy', $items->id) }}" type="button"
                                            class="btn btn-sm btn-danger"
                                            data-toggle="modal" data-target="#modal-delete"
                                            data-id="{!! $items->id !!}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                                @endforeach
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
            <div class="modal fade" id="edit-language" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header block">
                            <button type="button" class="close btn-one" data-dismiss="modal">&times;</button>
                            <h4 class="text-center">言語を</h4>
                            <h4 class="text-center">入力してください</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="edit-form" class="form-horizontal"
                                  action="">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="name">言語</label>
                                    <div class="col-sm-7">
                                        <input type="text" maxlength="32" class="form-control" id="edit_name" placeholder="例.英語" name="lang">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="language">言語コード</label>
                                    <div class="col-sm-7">
                                        <input type="text" maxlength="32" class="form-control" id="edit_language" placeholder="例.EN" name="lang_code">
                                    </div>
                                </div>
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
            <div class="modal fade" id="add-language" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header block">
                            <button type="button" class="close btn-one" data-dismiss="modal">&times;</button>
                            <h4 class="text-center">言語を</h4>
                            <h4 class="text-center">入力してください</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" class="form-horizontal"
                                  action="{{ route('master.store') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="name">言語</label>
                                    <div class="col-sm-7">
                                        <input type="text" maxlength="32" class="form-control" id="name" placeholder="例.英語" name="lang">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="language">言語コード</label>
                                    <div class="col-sm-7">
                                        <input type="text" maxlength="32" class="form-control" id="language" placeholder="例.EN" name="lang_code">
                                    </div>
                                </div>
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
            <div class="modal fade" id="modal-video" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header block">
                            <button type="button" class="close btn-one" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body modal-video">
                            <div class="table-responsive">
                                <table >
                                    <thead>
                                    <tr>
                                        <td>広告</td>
                                        <td>
                                            <select class="form-control">
                                                <option>ON</option>
                                                <option>OFF</option>
                                            </select>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="highlighted">
                                        <td></td>
                                        <td>
                                            <div class="content-video">
                                                <div class="video">
                                                    <video width="348" height="198" src="#" controls="controls">Trình duyệt bạn đang dùng không hỗ trợ tag video.</video>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="add-video">
                                        <td>広告動画</td>
                                        <td>
                                            <div class="content-video">
                                                <div class="brow-video text-right">
                                                    <input type="file" name="file" accept="video/mp4" id="upload-video" class="video" />
                                                    <label for="upload-video" class="border-left">参照</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="text-red">
                                            対応しているフォーマットのmp4を入れてください。
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
@endsection
@section('javascript')
    <script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
    <script src="{{ asset('js/common/showPage.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{ asset('plugins/jQuery/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('js/user/form.js')}}"></script>
    <script src="{{ asset('js/master_management/master/list.js') }}"></script>
    <script src="{{ asset('js/master_management/master/modal.js') }}"></script>

@endsection
@extends('layouts.app')
@section('title', 'アカウント管理')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/content_management/small_test/edit.css') }}">
@endsection
@section('content-header')
     <h1> TIPS一覧
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="javascript:void(0)">コンテンツ管理</a></li>
                <li class="active">TIPS一覧</li>
            </ol>
@endsection

@section('content')
            <div class="row">

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">リスト</h3>
                                <form id="form-search" class="form-horizontal" action="{{ route('tips.index') }}" method="get" style="margin-top: 20px;">
                                    <input type="hidden" name="sort_by" id="sort_by"
                                           value="{{ isset($params['sort_by']) ? $params['sort_by'] : 'id' }}"/>
                                    <input type="hidden" name="order_by" id="order_by"
                                           value="{{ isset($params['order_by']) ? $params['order_by'] : 'asc' }}"/>
                                    <input type="hidden" name="per_page" id="per_page"
                                           value="{{ isset($params['per_page']) ? $params['per_page'] : 10 }}"/>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="chapterName" class="col-sm-4 control-label">チャプタ</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="chapterName"
                                                       placeholder="チャプタ" name="name"
                                                       value="{{ isset($params['name']) ? $params['name'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="chapterName" class="col-sm-4 control-label">バージョン名</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="chapterName"
                                                       placeholder="バージョン" name="version"
                                                       value="{{ isset($params['version']) ? $params['version'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="area"
                                                   class="col-sm-4 control-label">エリア</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="language_id">
                                                    @if(count($lang))
                                                        <option value> ---- </option>
                                                        @foreach($lang as $lg)
                                                            <option value="{{ $lg->id }}"
                                                            @if (isset($params['language_id']) && ($params['language_id'] == $lg->id))
                                                                {{'selected'}}
                                                                    @endif >
                                                                {{ $lg->lang }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-default btn-submit">検索</button>
                                        <a href="{{route('tips.create')}}" class="btn btn-success pull-right btn-submit">新規登録</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="data-table" class="table table-bordered table-hover dataTable">
                                <thead>
                                <tr>
                                    <th style="width: 5%" ></th>
                                    <th data-field="id">ID</th>
                                    <th>チャプター</th>
                                    <th>言語</th>
                                    <th>バージョン名</th>
                                    <th>テスト有無</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($data))
                                    @foreach($data as $items)
                                <tr>
                                    <td style="width: 5%">||</td>
                                    <td>{{$items->id}}</td>
                                    <td>{{$items->name}}</td>
                                    <td>{{$items->lang}}</td>
                                    <td>{{$items->version_name}}</td>
                                    <td>
                                        @if($items->has_small_test == 0)
                                        {{'無'}}
                                        @else
                                        {{'有'}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('chapters.edit', $items->id)}}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                        <a href="#" class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal-preview"><i class="fa fa-eye"></i></a>
                                        <button data-action="{{route('tips.destroy', $items->id)}}" type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-delete">
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
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{route('home')}}" class="btn btn-info">戻る</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                </div>
            </div>

            <!-- delete modal -->
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
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#modal-delete').on('show.bs.modal', function (event) {
                        // Button that triggered the modal
                        var action = $(event.relatedTarget).data('action');
                        $('#delete-form').attr('action', action);
                    })
                });
            </script>
            <!-- end delete modal -->

            <!-- InstanceEndEditable -->
            <!-- /.box -->
            <!-- preview modal -->
            <div id="modal-preview" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">プレビュー(コンテンツ)</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div>
                                    <div class="col-xs-3">
                                        <!-- required for floating -->
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs tabs-left">
                                            <li class="active"><a href="#home" data-toggle="tab">日本語</a></li>
                                            <li><a href="#profile" data-toggle="tab">英語</a></li>
                                            <li><a href="#messages" data-toggle="tab">ベトナム語</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-xs-9">
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="home">
                                                <div class="phone view_2" id="phone_1">
                                                    <div class="content-preview">
                                                        <img src="{{asset('img/content_management/demo.jpg')}}" style="width: 100%;">
                                                    </div>
                                                    <div class="content-description">説明</div>
                                                    <div class="media-controls text-center">
                                                        <button class="pull-left"><span class="glyphicon glyphicon-arrow-left"></span></button>
                                                        <button><span class="glyphicon glyphicon-pause"></span></button>
                                                        <button class="pull-right"><span class="glyphicon glyphicon-arrow-right"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="profile">
                                                <div class="phone view_2" id="phone_1">
                                                    <div class="content-preview">
                                                        <img src="{{asset('img/content_management/demo.jpg')}}" style="width: 100%;">
                                                    </div>
                                                    <div class="content-description">English description</div>
                                                    <div class="media-controls text-center">
                                                        <button class="pull-left"><span class="glyphicon glyphicon-arrow-left"></span></button>
                                                        <button><span class="glyphicon glyphicon-pause"></span></button>
                                                        <button class="pull-right"><span class="glyphicon glyphicon-arrow-right"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="messages">
                                                <div class="phone view_2" id="phone_1">
                                                    <div class="content-preview">
                                                        <img src="{{asset('img/content_management/demo.jpg')}}" style="width: 100%;">
                                                    </div>
                                                    <div class="content-description">miêu tả Tiếng Việt</div>
                                                    <div class="media-controls text-center">
                                                        <button class="pull-left"><span class="glyphicon glyphicon-arrow-left"></span></button>
                                                        <button><span class="glyphicon glyphicon-pause"></span></button>
                                                        <button class="pull-right"><span class="glyphicon glyphicon-arrow-right"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">閉じる</button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end preview modal -->
@endsection
@section('javascript')
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/AdminLTE/app.min.js')}}"></script>
    <script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
    <script src="{{ asset('js/common/showPage.js') }}"></script>
@endsection
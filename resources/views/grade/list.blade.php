@extends('layouts.app')
@section('title', 'グレード編集')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/content_management/grade/edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/content_management/grade/action.css') }}">
@endsection
@section('content-header')
            <h1> グレード編集
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">グレード編集 </li>
            </ol>
@endsection
@section('content')
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_2" data-toggle="tab">授業</a></li>
                                        <li><a href="#tab_1" data-toggle="tab">基本設定</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_2">
                                            <form method="get" id="form-search" class="form-horizontal"
                                                  action="{{ route('grades.index') }}">
                                                <input type="hidden" name="sort_by" id="sort_by"
                                                       value="{{ isset($params['sort_by']) ? $params['sort_by'] : 'id' }}"/>
                                                <input type="hidden" name="order_by" id="order_by"
                                                       value="{{ isset($params['order_by']) ? $params['order_by'] : 'asc' }}"/>
                                                <input type="hidden" name="per_page" id="per_page"
                                                       value="{{ isset($params['per_page']) ? $params['per_page'] : 10 }}"/>
                                            <div class="row header-box">
                                                <div class="col-md-6">
                                                    <span class="pull-left">バージョン</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-md-2 pull-right">
                                                        <a href="{{route('grades.create')}}" type="button" class="btn btn-block btn-success" >新規</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-bordered table-hover dataTable">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th data-field="id">ID</th>
                                                    <th>バージョン名</th>
                                                    <th colspan="3">操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(count($data))
                                                    @foreach($data as $items)
                                                        <tr>
                                                            <td><input type="checkbox" ></td>
                                                            <td>{{$items->id}}</td>
                                                            <td>{{$items->name}}</td>
                                                            <td width="50"><button class=" btn btn-default btn-sm"><i class="fa fa-copy"></i></button></td>
                                                            <td width="50"><a href="{{route('grades.edit', $items->id)}}" class="  btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a></td>
                                                            <td width="50">
                                                                <button data-action="{{ route('grades.destroy', $items->id) }}" type="button"
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
                                        <div class="tab-pane " id="tab_1">
                                            <form id="form" class="form-horizontal" method="post" action="{{route('grades.store')}}">
                                                {{ csrf_field() }}
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="project" class="col-sm-3 control-label">プロジェクト</label>
                                                        <div class="col-md-4 col-sm-9">
                                                            <select name="project_id" id="grade-type" class="form-control">
                                                                @foreach ( $project as $pr)
                                                                    <option value="{{$pr->id}}">{{$pr->id}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="grade-type" class="col-sm-3 control-label">コンテンツタイプ</label>
                                                        <div class="col-md-4 col-sm-9">
                                                            <select name="content_type" id="grade-type" class="form-control">
                                                                @foreach ( $contentType as $key => $ct)
                                                                    <option value="{{$key}}">{{$ct}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jp-name" class="col-sm-3 control-label">グレード名（日本語）</label>
                                                        <div class="col-md-4 col-sm-9">
                                                            <input type="text" class="form-control" id="jp_name" name="jp_name" placeholder="グレード名1">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="en-name" class="col-sm-3 control-label">（英語）</label>
                                                        <div class="col-md-4 col-sm-9">
                                                            <input type="text" class="form-control" name="en_name" id="en_name" placeholder="Grade name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="vi-name" class="col-sm-3 control-label">（ベトナム語）</label>
                                                        <div class="col-md-4 col-sm-9">
                                                            <input type="text" class="form-control" name="vn_name" id="vn_name" placeholder="Tên Grade">
                                                        </div>
                                                    </div>

                                                    <div class="form-group text-center">
                                                        <div class="col-md-9 col-sm-9">小テスト設定</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="passed-jp" class="col-sm-3 control-label">合格メッセージ（日本語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="ja_small_passing_message" id="passed-jp" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="passed-en" class="col-sm-3 control-label">（英語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="en_small_passing_message" id="passed-en" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="passed-vi" class="col-sm-3 control-label">（ベトナム語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="vn_small_passing_message" id="passed-vi" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fail-jp" class="col-sm-3 control-label">不合格メッセージ（日本語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="ja_small_failed_message" id="fail-jp" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fail-en" class="col-sm-3 control-label">（英語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="en_small_failed_message" id="fail-en" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fail-vi" class="col-sm-3 control-label">（ベトナム語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="vn_small_failed_message" id="fail-vi" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="correct-jp" class="col-sm-3 control-label">正解メッセージ（日本語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="ja_small_correct_message" id="correct-jp" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="correct-en" class="col-sm-3 control-label">（英語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="en_small_correct_message" id="correct-en" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="correct-vi" class="col-sm-3 control-label">（ベトナム語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="vn_small_correct_message" id="correct-vi" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="incorrect-jp" class="col-sm-3 control-label">不正解メッセージ（日本語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="ja_small_incorrect_message" id="incorrect-jp" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="incorrect-en" class="col-sm-3 control-label">（英語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="en_small_incorrect_message" id="incorrect-en" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="correct-vi" class="col-sm-3 control-label">（ベトナム語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="vn_small_incorrect_message" id="incorrect-vi" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-3 control-label">合格点正答率</label>
                                                        <div class="col-md-3 col-sm-9">
                                                            <input type="number" class="form-control" name="" id="" >
                                                            <span> %</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group text-center">
                                                        <div class="col-md-9 col-sm-9">大テスト設定</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="passed-jp" class="col-sm-3 control-label">合格メッセージ（日本語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="ja_big_passing_message" id="passed-jp" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="passed-en" class="col-sm-3 control-label">（英語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="en_big_passing_message" id="passed-en" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="passed-vi" class="col-sm-3 control-label">（ベトナム語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="vn_big_passing_message" id="passed-vi" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fail-jp" class="col-sm-3 control-label">不合格メッセージ（日本語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="ja_big_failed_message" id="fail-jp" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fail-en" class="col-sm-3 control-label">（英語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="en_big_failed_message" id="fail-en" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fail-vi" class="col-sm-3 control-label">（ベトナム語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="vn_big_failed_message" id="fail-vi" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="correct-jp" class="col-sm-3 control-label">正解メッセージ（日本語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="ja_big_correct_message" id="correct-jp" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="correct-en" class="col-sm-3 control-label">（英語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="en_big_correct_message" id="correct-en" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="correct-vi" class="col-sm-3 control-label">（ベトナム語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="vn_big_correct_message" id="correct-vi" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="incorrect-jp" class="col-sm-3 control-label">不正解メッセージ（日本語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="ja_big_incorrect_message" id="incorrect-jp" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="incorrect-en" class="col-sm-3 control-label">（英語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="en_big_incorrect_message" id="incorrect-en" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="correct-vi" class="col-sm-3 control-label">（ベトナム語）</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input type="text" class="form-control" name="vn_big_incorrect_message" id="incorrect-vi" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-3 control-label">合格点正答率</label>
                                                        <div class="col-md-3 col-sm-9">
                                                            <input type="number" class="form-control" name="" id="" >
                                                            <span> %</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="grade-trophy" class="col-sm-3 control-label">トロフィー</label>
                                                        <div class="col-md-4 col-sm-9">
                                                            <select name="grade_trophy" id="grade_trophy" class="form-control">
                                                                @foreach ($trophy as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-3 control-label">マイページ背景</label>
                                                        <div class="col-md-6 col-sm-9">
                                                            <input id="input-1" type="file" class="file">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                                <div class="box-footer">
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-9 col-sm-offset-3">
                                                            <button type="submit" class="btn btn-success pull-right">保存</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-footer -->
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

@endsection
@section('javascript')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('js/content_management/grade/edit.js') }}"></script>
    <script src="{{ asset('js/content_management/grade/list.js') }}"></script>
    <script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
    <script src="{{ asset('js/common/showPage.js') }}"></script>
@endsection

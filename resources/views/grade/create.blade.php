@extends('layouts.app')
@section('title', 'グレード編集')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/content_management/grade/edit.css') }}">
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
                                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">基本設定</a></li>
                            </ul>
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <p class="text-center">チュートリアルは既に存在します。</p>
                                            <p class="text-center"> コンテンツタイプをノーマルに変更してください。</p>
                                        </div>
                                        <div class="modal-body text-center">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @if ($errors->any())
                                <script>
                                $(document).ready(function(){
                                $("#myModal").modal();
                                });
                                </script>
                            @endif
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <form class="form-horizontal" method="post" action="{{route('grades.store')}}" id="createForm" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="box-body">
                                            <div class="col-xs-10">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="common-v">
                                                        <div class="form-group">
                                                            <label for="grade-type" class="col-sm-3 control-label">コンテンツタイプ</label>
                                                            <div class="col-md-4 col-sm-9">
                                                                <select name="content_type" id="grade-type" class="form-control">
                                                                    @foreach($contentType as $key=>$ct)
                                                                        <option value="{{$key}}">{{$ct}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label  class="col-sm-3 control-label">合格点正答率</label>
                                                            <div class="col-md-4 col-sm-9"><input type="text" class="form-control" name="pass_score_rate" value=""/></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label  class="col-sm-3 control-label">マイページ背景</label>
                                                            <div class="col-md-6 col-sm-6"><input type="file" class="form-control" name="my_page_background" id="my_page_background" value=""/></div>
                                                        </div>
                                                    </div>
                                                    @if(count($languages))
                                                        @foreach($languages as $items)
                                                            <div class="tab-pane" id="{{ $items['lang_code']}}-v">
                                                                <div class="form-group text-center">
                                                                    <div class="col-md-9 col-sm-9">大テスト設定</div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="{{ $items['lang_code']}}-name" class="col-sm-3 control-label">グレード名</label>
                                                                    <div class="col-md-4 col-sm-9">
                                                                        <input type="text" class="form-control" id="{{ $items['lang_code']}}_name" name="{{ $items['lang_code']}}_name" >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="passed-{{ $items['lang_code']}}" class="col-sm-3 control-label">合格メッセージ</label>
                                                                    <div class="col-md-6 col-sm-9">
                                                                        <input type="text" class="form-control" name="{{ $items['lang_code']}}_passing_message" id="{{ $items['lang_code']}}_passing_message">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="fail-{{ $items['lang_code']}}" class="col-sm-3 control-label">不合格メッセージ</label>
                                                                    <div class="col-md-6 col-sm-9">
                                                                        <input type="text" class="form-control" name="{{ $items['lang_code']}}_failed_message" id="{{ $items['lang_code']}}_failed_message">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="correct-{{ $items['lang_code']}}" class="col-sm-3 control-label">正解メッセージ</label>
                                                                    <div class="col-md-6 col-sm-9">
                                                                        <input type="text" class="form-control" name="{{ $items['lang_code']}}_correct_message" id="{{ $items['lang_code']}}_correct_message">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="incorrect-{{ $items['lang_code']}}" class="col-sm-3 control-label">不正解メッセージ</label>
                                                                    <div class="col-md-6 col-sm-9">
                                                                        <input type="text" class="form-control" name="{{ $items['lang_code']}}_incorrect_message" id="{{ $items['lang_code']}}_incorrect_message">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <ul class="nav nav-tabs tabs-right sideways">
                                                    <li class="active"><a href="#common-v" data-toggle="tab">共通</a></li>
                                                    @if(count($languages))
                                                        @foreach($languages as $items)
                                                            <li><a href="#{{ $items['lang_code']}}-v" data-toggle="tab">{{ $items['lang']}}</a></li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="clearfix"></div>
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
                            <!-- /.tab-content -->
                        </div>
                    </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{url('contents')}}" class="btn btn-info">戻る</a>
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
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
@endsection
@section('javascript')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ asset('js/content_management/grade/create.js') }}"></script>
<script src="{{ asset('js/content_management/grade/list.js') }}"></script>
@endsection

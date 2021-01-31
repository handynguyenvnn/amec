@extends('layouts.app')
@section('title', 'チャプター一覧')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/content_management/chapter/list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/content_management/chapter/edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/content_management/small_test/edit.css') }}">
@endsection
@section('content-header')
    <h1> チャプター一覧
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> ホーム</a></li>
        <li><a href="javascript:void(0)"> コンテンツ管理</a></li>
        <li class="active">チャプター一覧</li>
    </ol>
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <div>
                <ul class="nav nav-tabs" role="tablist">
                    {{--@if($versionId)--}}
                    <li role="presentation" class="active"><a href="#listChapter" aria-controls="listChapter" role="tab"
                                                              data-toggle="tab">一覧</a></li>
                    {{--@endif--}}
                    <li role="presentation"><a href="#smallTestSetting" aria-controls="smallTestSetting" role="tab"
                                               data-toggle="tab">小テスト設定</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="listChapter">
                        <div class="header-table">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4>
                                        チャプター一覧
                                    </h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-2 pull-right">
                                        <a href="{{route("chapters.action", [$gradeId, $versionId]) }}" class="btn btn-block btn-success" id="btn-create-new">
                                            新規
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <input type="hidden" id="idTable" value="mytable">
                        <table id="mytable" class="table table-bordered table-hover dataTable" base-url="{{ asset('sortable/chapters/chapter_no') }}/version_id={{$versionId}}">
                            <thead>
                            <tr>
                                <th></th>
                                <th data-field="id">ID</th>
                                <th>チャプター名</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($data)>0 )
                                    @foreach($data as $key => $items)
                                        <tr data-id="{{$items->id}}" data-no="{{$items->chapter_no}}">
                                            <td width="50" class="move"><i class="fa fa-arrows"></i></td>
                                            <td>{{$items->id}}</td>
                                            <td>{{$items->name}}</td>
                                            <td>
                                                <a href="{{ route('chapters.action', [$gradeId, $versionId, $items->id]) }}"
                                                   class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('small_tests.action', [$gradeId, $versionId, $items->small_test_id]) }}" class="btn btn-xs btn-info"><i class="fa fa-sticky-note-o"></i></a>

                                                <button data-action="{{ route('chapters.remove', [$gradeId, $versionId, $items->id]) }}" type="button"
                                                        class="btn btn-xs btn-danger" data-toggle="modal"
                                                        data-target="#modal-delete"
                                                        data-id="{!! $items->id !!}">
                                                    <i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    @if(count($data)>0 )
                                        <td colspan="100%" class="text-center">
                                                    <span class="pull-left">
                                                        {{ $data->total() }} 件中 {{ $data->firstItem()}}
                                                        から {{ $data->lastItem() }}
                                                    </span>
                                            {{ $data->appends($params)->links() }}
                                        </td>
                                    @endif
                                </tr>
                            </tfoot>
                        </table>

                        <div id="back-btn">
                            <a href="{{route('grades.edit', $gradeId)}}#tab_2" class="btn btn-default">戻る</a>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="smallTestSetting">

                        <!-- Horizontal Form -->
                        <div class="">
                            <div class="">
                                <div class="">
                                    <!-- form start -->
                                    <form id="createForm" class="form-horizontal" method="post" action="{{  route('small-test-questions.store') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="gradeId" value="{{$gradeId}}">
                                        <input type="hidden" name="versionId" value="{{$versionId}}">
                                        <input type="hidden" name="category_message" value="0">
                                        <div class="box-body">
                                            <div class="col-xs-9">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="common-v">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">バージョン名</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" maxlength="62" name="version_name" class="form-control" id="version_name" value="{{$versionName}}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(count($languages))
                                                        @foreach($languages as $items)
                                                            <div class="tab-pane" id="{{ $items->lang_code}}-v">
                                                                <input type="hidden" name="{{ $items->lang_code}}_id" value="{{ isset($messages_small_tests[$items->lang_code.'_id']) ? $messages_small_tests[$items->lang_code.'_id'] : ''}}">
                                                                <div class="form-group">
                                                                    <label for="inputPassJapanese"
                                                                           class="col-sm-3 control-label">合格メッセージ</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="form-control" name="{{ $items->lang_code}}_passing_message" >{{ isset($messages_small_tests[$items->lang_code.'_passing_message']) ? $messages_small_tests[$items->lang_code.'_passing_message'] : ''}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPassJapanese"
                                                                           class="col-sm-3 control-label">不合格メッセージ</label>

                                                                    <div class="col-sm-9">
                                                                        <textarea class="form-control" name = "{{ $items->lang_code}}_failed_message">{{ isset($messages_small_tests[$items->lang_code.'_failed_message']) ? $messages_small_tests[$items->lang_code.'_failed_message'] : ''}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPassJapanese"
                                                                           class="col-sm-3 control-label">正解メッセージ</label>

                                                                    <div class="col-sm-9">
                                                                        <textarea class="form-control" name="{{ $items->lang_code}}_correct_message">{{ isset($messages_small_tests[$items->lang_code.'_correct_message']) ? $messages_small_tests[$items->lang_code.'_correct_message'] : ''}}</textarea>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPassJapanese"
                                                                           class="col-sm-3 control-label">不正解メッセージ</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="form-control" name="{{ $items->lang_code}}_incorrect_message">{{isset($messages_small_tests[$items->lang_code.'_incorrect_message']) ? $messages_small_tests[$items->lang_code.'_incorrect_message'] : ''}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="col-xs-3">
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
                                            <div class="box-footer box-footer-margin">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-9 col-sm-offset-3">
                                                        <button type="submit" class="btn btn-info pull-right">保存</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="box-footer">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="{{route('grades.edit', $gradeId)}}#tab_2" class="btn btn-default">戻る</a>
                                            </div>
                                        </div>
                                    </div>

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


        <div class="modal fade bs-example-modal-md" id="modal-exist-tutorial" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <input type="hidden" name="_method" value="delete"/>
                    <div class="modal-body">
                        <h4 class="text-center">チュートリアルは既に存在します。</h4>
                        <h4 class="text-center">コンテンツタイプをノーマルに変更してください。</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('#modal-delete').on('show.bs.modal', function (event) {
                // Button that triggered the modal
                var action = $(event.relatedTarget).data('action');
                $('#delete-form').attr('action', action);
            })
        });
    </script>
    <script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{ asset('js/common/sortable.js') }}"></script>
    <script src="{{ asset('js/common/showPage.js') }}"></script>
    <script src="{{ asset('js/content_management/chapter/list.js') }}"></script>
    <script src="{{ asset('plugins/AdminLTE/app.min.js')}}"></script>
    <script src="{{ asset('plugins/AdminLTE/demo.js')}}"></script>
    <script src="{{ asset('plugins/bootbox/bootbox.min.js')}}"></script>
    <script src="{{ asset('plugins/jQueryUI/jquery-ui.js')}}"></script>

@endsection
@extends('layouts.app')
@section('title', '小テスト問題編集')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/content_management/chapter/edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/content_management/small_test/edit.css') }}">
@endsection
@section('content-header')
    <h1> 小テスト問題編集
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:void(0)">コンテンツ管理</a></li>
        <li class="active">小テスト問題編集</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form id="createForm" class="form-horizontal" method="post"
                      action="{{ route('small_tests.update', $data['id'] ) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-header">
                    </div>
                    <div class="box-body">
                        <div class="col-xs-10">
                            <div class="tab-content">
                                <div class="tab-pane active" id="common-v">
                                    <div class="tool-bar">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="label-tool">合格正答率</label>
                                                <input type="number" class="form-control" name="pass_score_rate" value = "{{$data['pass_score_rate']}}"><span>&nbsp;%</span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="label-tool">問題総数</label>
                                                <input type="number" class="form-control" name="num_issues" value="{{$data['num_issues']}}" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="label-tool">出題形式</label>
                                                <select class="form-control" name = "question_format">
                                                    @foreach( $questionFormat as $key => $value)
                                                        <option value="{{$key}}"
                                                        @if ($key == $data['question_format'])
                                                            {{'selected'}}
                                                                @endif
                                                        >{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="label-tool">選択肢表示形式</label>
                                                <select class="form-control" name="option_display_format">
                                                    @foreach( $optionDisplayFormat as $key => $value)
                                                        <option value="{{$key}}"
                                                        @if ($key == $data['option_display_format'])
                                                            {{'selected'}}
                                                                @endif
                                                        >{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="" class="col-md-4 col-sm-3 control-label text-right">タイトル</label>
                                            <div class="col-md-2 col-sm-6">
                                                <input type="text" class="form-control" id="value_search_small_test_questions">
                                            </div>
                                            <div class="col-md-2 col-sm-3">
                                                <a type="button" id="search_small_test_questions" class="btn btn-info" data-id="{{$data['id']}}">検索</a>
                                            </div>
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                    </div>
                                </div>
                                <div id="question-answer-body" style="display: none; margin-top: -30px; margin-left: -30px;">
                                    <div class="side-tools col-md-4" style="padding-top: 16px;">
                                        <table class="table list-test" id ="select_small_test_questions">
                                            @foreach ($smallTestQuestions as $key => $value)
                                                <tr id="tr_select_small_test_question" data-id="{{$value->id}}" title="{{$value->title}}">
                                                    <td>||</td>
                                                    <td>{{\Illuminate\Support\Str::words($value->title, 2,'')}}</td>
                                                    <td>
                                                        <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal-preview"><i class="fa fa-eye"></i></a>
                                                        <a id="select_delete_small_test" type="button"
                                                           class="btn btn-xs btn-danger" data-toggle="modal"
                                                           data-target="#modal-delete"
                                                           data-id="{!! $value->id !!}">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        <a id="add_small_test_question" class="btn btn-success" style="width: 100%"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="action-view col-md-8">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        {{ method_field('PUT') }}
                                        <div class="form-group" style="padding-top: 16px;">
                                            <label for="id" class="col-md-2">ID</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" id="id_small_test_question" name="id_small_test_question"  readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-md-2"><span class="text-red">※</span>&nbsp;タイトル</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="title_small_test_question" id="title_small_test_question">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-md-2">問題形式</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="question_fomat" id = "question_fomat">
                                                    @foreach( $questionFormat as $key => $value)
                                                        <option value="{{$key}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="score" class="col-md-2"><span class="text-red">※</span>&nbsp;配点</label>
                                            <div class="col-md-10">
                                                <input type="number" class="form-control" name="score" id="score">
                                                <input type="hidden" id="arrLang" value="{{$arrLang}}">
                                            </div>
                                        </div>
                                        @if(count($languages))
                                            @foreach($languages as $indx=>$items)
                                                <div class="tab-pane" id="{{ $items->lang_code}}-v" style="padding-top: 16px;">
                                                    <div class="form-group">
                                                        <input type="hidden" name="{{ $items->lang_code}}_small_test_problem_id" id="{{ $items->lang_code}}_small_test_problem_id" />
                                                        <input type="hidden" name="{{ $items->lang_code}}_small_test_choice_first_id" id="{{ $items->lang_code}}_small_test_choice_first_id" />
                                                        <input type="hidden" name="{{ $items->lang_code}}_small_test_choice_second_id" id="{{ $items->lang_code}}_small_test_choice_second_id" />
                                                        <input type="hidden" name="{{ $items->lang_code}}_small_test_choice_third_id" id="{{ $items->lang_code}}_small_test_choice_third_id" />
                                                        <input type="hidden" name="{{ $items->lang_code}}_small_test_choice_fourth_id" id="{{ $items->lang_code}}_small_test_choice_fourth_id" />
                                                        <label for="title" class="col-md-3">（{{ $items->lang}}）</label>
                                                        <div class="col-md-9">
                                                            <input id="{{ $items->lang_code}}_image_path" name="{{ $items->lang_code}}_image_path" type="file" class="file-loading">
                                                            <input id="{{ $items->lang_code}}_video_path" name="{{ $items->lang_code}}_video_path" type="file" class="file-loading">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="title" class="col-md-2">問題文</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" rows="5" id ="{{ $items->lang_code}}_problem_statement" name="{{ $items->lang_code}}_problem_statement"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="title" class="col-md-2">選択肢1</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" rows="5" id ="{{ $items->lang_code}}_description_first" name="{{ $items->lang_code}}_description_first"></textarea>
                                                            <input id="{{ $items->lang_code}}_choices_image_path_first" name="{{ $items->lang_code}}_image_path_first" type="file" class="avatarSmallTests file-loading">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="title" class="col-md-2">選択肢2</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" rows="5" id ="ja_description_second" name="{{ $items->lang_code}}_description_second"></textarea>
                                                            <input id="{{ $items->lang_code}}_choices_image_path_second" name="{{ $items->lang_code}}_image_path_second" type="file" class="avatarSmallTests file-loading">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="title" class="col-md-2">選択肢3</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" rows="5" id ="{{ $items->lang_code}}_description_third" name="{{ $items->lang_code}}_description_third"></textarea>
                                                            <input id="{{ $items->lang_code}}_choices_image_path_third" name="{{ $items->lang_code}}_image_path_third" type="file" class="avatarSmallTests file-loading">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="title" class="col-md-2">選択肢4</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" rows="5" id ="{{ $items->lang_code}}_description_fourth" name="{{ $items->lang_code}}_description_fourth"></textarea>
                                                            <input id="{{ $items->lang_code}}_choices_image_path_fourth" name="{{ $items->lang_code}}_image_path_fourth" type="file" class="avatarSmallTests file-loading">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('partials.language')
                        <div class="clearfix"></div>
                    </div>
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
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('chapters.index' ) }}" class="btn btn-default">戻る</a>
                                <button type="submit" class="btn btn-info pull-right">登録</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
    <!-- end preview modal -->
    <div class="modal fade bs-example-modal-xs" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="_method" value="delete"/>
                    <div class="modal-body">
                        <h4 class="text-center">データを削除します。</h4>
                        <h4 class="text-center">本当によろしいですか？</h4>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-default" data-dismiss="modal">キャンセル</a>
                        <a id="modal_submit_delete" type="submit" class="btn btn-primary" page-id="{{$data['id']}}">OK</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end delete modal -->
@endsection
@section('javascript')
    <script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/locales/ja.js') }}"></script>
    <script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>
    <script src="{{ asset('js/content_management/small_test/search_small_test_questions.js') }}"></script>
    <script src="{{ asset('js/content_management/small_test/select_small_test_questions.js') }}"></script>
    <script src="{{ asset('js/content_management/small_test/add_small_test_questions.js') }}"></script>
    <script src="{{ asset('js/content_management/small_test/delete_small_test_questions.js') }}"></script>
    <script src="{{ asset('js/content_management/small_test/validate.js') }}"></script>
    <script src="{{ asset('js/content_management/small_test/default_image.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/content_management/small_test/common.js') }}"></script>
    @if(count($languages))
        @foreach($languages as $indx=>$items)
            <script>

                $("#{{ $items->lang_code}}_image_path").fileinput({
                    showUpload: false,
                    uploadAsync: false,
                    overwriteInitial: true,
                    maxFileCount:1,
                    initialPreviewFileType: 'image',
                    defaultPreviewContent: '<img src="{{ asset('img/default/no-image.jpg') }}" id="preview-avatar-{{ $items->lang_code}}_image_path" alt="Your Avatar" style="width:300px">',
                    initialPreviewAsData: true,
                    initialPreviewConfig: [
                        { caption: "Image", size: 847000},
                    ],
                    allowedFileExtensions: ["jpg", "png", "gif"]
                });


                $("#{{ $items->lang_code}}_video_path").fileinput({
                    showUpload: false,
                    uploadAsync: true,
                    overwriteInitial: true,
                    maxFileCount:1,
                    initialPreview: [
                        "{{ asset('img/default/no-video.jpg') }}",
                    ],
                    initialPreviewAsData: true,
                    initialPreviewFileType: 'video', // image is the default and can be overridden in config below
                    initialPreviewConfig: [
                        { caption: "Video", size: 847000},
                    ],
                    allowedFileExtensions: ["mp4"]
                });

                $("#{{ $items->lang_code}}_choices_image_path_first").fileinput({
                    showUpload: false,
                    uploadAsync: false,
                    overwriteInitial: true,
                    maxFileCount:1,
                    initialPreviewFileType: 'image',
                    defaultPreviewContent: '<img src="{{ asset('img/default/no-image.jpg') }}" id="preview-avatar-{{ $items->lang_code}}_choices_image_path_first" alt="Your Avatar" style="width:300px">',
                    initialPreviewAsData: true,
                    initialPreviewConfig: [
                        { caption: "Image", size: 847000},
                    ],
                    allowedFileExtensions: ["jpg", "png", "gif"]
                });
                $("#{{ $items->lang_code}}_choices_image_path_second").fileinput({
                    showUpload: false,
                    uploadAsync: false,
                    overwriteInitial: true,
                    maxFileCount:1,
                    initialPreviewFileType: 'image',
                    defaultPreviewContent: '<img src="{{ asset('img/default/no-image.jpg') }}" id="preview-avatar-{{ $items->lang_code}}_choices_image_path_second" alt="Your Avatar" style="width:300px">',
                    initialPreviewAsData: true,
                    initialPreviewConfig: [
                        { caption: "Image", size: 847000},
                    ],
                    allowedFileExtensions: ["jpg", "png", "gif"]
                });
                $("#{{ $items->lang_code}}_choices_image_path_third").fileinput({
                    showUpload: false,
                    uploadAsync: false,
                    overwriteInitial: true,
                    maxFileCount:1,
                    initialPreviewFileType: 'image',
                    defaultPreviewContent: '<img src="{{ asset('img/default/no-image.jpg') }}" id="preview-avatar-{{ $items->lang_code}}_choices_image_path_third" alt="Your Avatar" style="width:300px">',
                    initialPreviewAsData: true,
                    initialPreviewConfig: [
                        { caption: "Image", size: 847000},
                    ],
                    allowedFileExtensions: ["jpg", "png", "gif"]
                });
                $("#{{ $items->lang_code}}_choices_image_path_fourth").fileinput({
                    showUpload: false,
                    uploadAsync: false,
                    overwriteInitial: true,
                    maxFileCount:1,
                    initialPreviewFileType: 'image',
                    defaultPreviewContent: '<img src="{{ asset('img/default/no-image.jpg') }}" id="preview-avatar-{{ $items->lang_code}}_choices_image_path_fourth" alt="Your Avatar" style="width:300px">',
                    initialPreviewAsData: true,
                    initialPreviewConfig: [
                        { caption: "Image", size: 847000},
                    ],
                    allowedFileExtensions: ["jpg", "png", "gif"]
                });
            </script>
        @endforeach
    @endif
@endsection
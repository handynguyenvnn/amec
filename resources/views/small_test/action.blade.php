@extends('layouts.app')
@section('title', '小テスト問題編集')
@section('stylesheet')

    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/themes/explorer/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/phone-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/content_management/small_test/edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/content_management/small_test/action.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                <div class="form-group" style="padding-top: 16px;">
                    <div class="row">
                        <form action="{{ route('small_tests.action',[$gradeId , $versionId, $data['id']]) }}" method="get">
                            <label for="" class="col-md-4 col-sm-3 control-label text-right">タイトル</label>
                            <div class="col-md-2 col-sm-6">
                                <input type="text" class="form-control" maxlength="64" name="small_test_question_title" id="" value="{{isset($_GET['small_test_question_title']) ? $_GET['small_test_question_title'] : ''}}">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" id="" class="btn btn-success btn-block" data-id="">検索</button>
                            </div>
                        </form>
                    </div>

                </div>
                <form id="createForm" class="form-horizontal" method="post" onsubmit="return validateForm()"
                      action="{{ route('small_tests.update', [$gradeId . '-' . $versionId . '-' . $data['id']] ) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-header">
                    </div>
                    <div class="box-body">
                        <div class="col-xs-12">
                            <div class="tab-content">
                                <div>
                                    <div class="tool-bar" style="border: none;">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label class="col-sm-3 label-tool">合格正答率 (%)</label>
                                                <div class="col-md-6 col-sm-9">
                                                <input type="number" class="form-control" id="pass_score_rate" name="pass_score_rate" min="1" max="100" value = "{{$data['pass_score_rate']}}" >
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-sm-3 label-tool">問題総数</label>
                                                <div class="col-md-6 col-sm-9">
                                                    <input type="text" class="form-control" name="num_issues" value="{{ count($smallTestQuestions) -1}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-sm-3 label-tool">出題形式</label>
                                                <div class="col-md-6 col-sm-9">
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
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-sm-3 label-tool">選択肢表示形式</label>
                                                <div class="col-md-6 col-sm-9">
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
                                        </div>

                                        <div class="clearfix">&nbsp;</div>
                                    </div>
                                </div>
                                <div id="question-answer-body" style=" margin-top: -30px; margin-left: -25px;">
                                <div class="side-tools col-md-4" style="padding-top: 16px;">
                                        <input type="hidden" id="idTable" value="select_small_test_questions">
                                        <ul class="nav nav-tabs tabs-left sideways" id="select_small_test_questions" base-url="{{ asset('sortable/small_test_questions/question_no') }}/small_test_id={{$data['id']}}">
                                            @if(count($smallTestQuestions))
                                                @foreach($smallTestQuestions as $key => $value)
                                                    @if($key == count($smallTestQuestions)-1)
                                                        <li data-no="{{$key}}" data-id="{{$value['id']}}"><a href="#-tab" data-toggle="tab" style="color:white;background-color: #00a65a;border-color: #008d4c;text-align: center;"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
                                                        @else
                                                        <li style="display: flex;" data-no="{{$key}}" data-id="{{$value['id']}}">
                                                            <a href="#{{$value['id']}}-tab" data-toggle="tab" style="flex-grow: 1; margin-right: 5px; border-radius: 5px;"><i class="fa fa-arrows"></i>  {{ $value['title']}}</a>
                                                            <a href="#{{$value['id']}}-tab" class="btn btn-xs btn-info" data-toggle="modal" data-id="{{$value['id']}}" style="margin-right: 5px; border-radius: 5px;" data-target="#{{$value['id']}}-modal-preview"><i class="fa fa-eye"></i></a>
                                                            <button style="width: 44px;" data-action="{{ route('chapters.removeSmallTestQuestion', [$gradeId, $versionId, $data['id'], $value['id']]) }}" type="button"
                                                        class="btn btn-xs btn-danger" data-toggle="modal"
                                                        data-target="#modal-delete"
                                                        data-id="{!! $value['id'] !!}">
                                                        <i class="fa fa-trash"></i></button></li>
                                            @endif
                                                        <div id="{{$value['id']}}-modal-preview" class="modal fade" role="dialog">
                                                            <div class="modal-dialog modal-lg">

                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title"><b style="font-size: 24px">プレビュー(コンテンツ)</b>※言語を選択してください</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div>
                                                                                <div class="col-xs-3">
                                                                                    <!-- required for floating -->
                                                                                    <!-- Nav tabs -->
                                                                                    <ul class="nav nav-tabs tabs-left-preview">
                                                                                        @if(count($languages))
                                                                                            @foreach($languages as $items)
                                                                                                <li
                                                                                                        {{--@if($items->lang_code == 'ja') class="active" @endif--}}
                                                                                                ><a href="#{{$value['id']}}-{{ $items->lang_code}}-preview" data-toggle="tab">{{ $items->lang}}</a></li>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="col-xs-9">
                                                                                    <!-- Tab panes -->
                                                                                    <div class="tab-content">
                                                                                        @if(count($languages))
                                                                                            @foreach($languages as $language)
                                                                                                <div class="tab-pane-preview"
                                                                                                     id="{{$value['id']}}-{{ $language->lang_code}}-preview">
                                                                                                    <div class="phone view_2" id="phone_1">
                                                                                                        <div class="content-preview" id="{{ $language->lang_code}}-content-preview" style="margin-top: 30px; text-align: center;">
                                                                                                            @if(isset($value['small_test_question_problems'][$language->id]['video_path']) && $value['small_test_question_problems'][$language->id]['video_path'] != '')
                                                                                                            <video id="{{ $language->lang_code}}-video-preview" style="max-width: 105%;height: auto;" controls >
                                                                                                                <source
                                                                                                                        src="{{$path_media.$value['small_test_question_problems'][$language->id]['video_path']}}"
                                                                                                                        type="video/mp4">
                                                                                                            </video>
                                                                                                            @else
                                                                                                            <img
                                                                                                                    src="{{isset($value['small_test_question_problems'][$language->id]['image_path']) ? ($path_media.$value['small_test_question_problems'][$language->id]['image_path']) : asset('img/default/no-image.jpg') }}"

                                                                                                                 id="{{ $language->lang_code}}-img-preview" style="max-width: 100%;height: 150px; object-fit: scale-down;width: 236px;background: #9df4ff;" >
                                                                                                                @endif
                                                                                                        </div>
                                                                                                        <div class="content-description" id="{{ $language->lang_code}}-content-description" style="background-color: #fddeff; margin-top:5px">
                                                                                                            {{isset($value['small_test_question_problems'][$language->id]['problem_statement']) ? $value['small_test_question_problems'][$language->id]['problem_statement'] : '' }}
                                                                                                        </div>
                                                                                                        @if(isset($value['small_test_question_choices'][$language->id]))
                                                                                                            @foreach ($value['small_test_question_choices'][$language->id] as $answer)
                                                                                                        <div class="answer-description">{{$answer['option_description']}}</div>
                                                                                                            @endforeach
                                                                                                            @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        @endif
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
                                                @endforeach
                                            @endif
                                        </ul>


                                    <div class="clearfix"></div>
                                </div>

                                <div class="action-view col-md-6" style="padding-top: 16px;">
                                    @if(count($smallTestQuestions))
                                        @foreach($smallTestQuestions as $indx=>$smallTestQuestion)
                                            <div class="tab-pane" id="{{$smallTestQuestion['id']}}-tab" style="padding-top: 16px;">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                {{ method_field('PUT') }}
                                                <div class="form-group">
                                                    <label for="title" class="col-md-2"><span class="text-red">※</span>&nbsp;タイトル</label>
                                                    <div class="col-md-10">
                                                        <input type="text" maxlength="64" class="form-control"
                                                               @if(isset($smallTestQuestion['id']))
                                                               name="small_test_questions[{{$smallTestQuestion['id']}}][title]"
                                                               @else
                                                               name="add_small_test_questions[title]"
                                                               @endif
                                                               id="title_small_test_question" value="{{$smallTestQuestion['title']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title" class="col-md-2">ID</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" id="id_small_test_question"
                                                               @if(isset($smallTestQuestion['id']))
                                                               name="small_test_questions[{{$smallTestQuestion['id']}}][id]"
                                                               @else
                                                               name="add_small_test_questions[id]"
                                                               @endif
                                                               value="{{$smallTestQuestion['id']}}"  readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title" class="col-md-2">問題形式</label>
                                                    <div class="col-md-10">
                                                        <select class="form-control"
                                                                @if(isset($smallTestQuestion['id']))
                                                                name="small_test_questions[{{$smallTestQuestion['id']}}][question_fomat]"
                                                                @else
                                                                name="add_small_test_questions[question_fomat]"
                                                                @endif
                                                                id = "question_fomat_questions">
                                                            @foreach( $questionFormatQuestions as $key => $value)
                                                                <option value="{{$key}}"
                                                                @if($smallTestQuestion['question_format'] == $key)
                                                                    {{'selected'}}
                                                                @endif
                                                                >{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title" class="col-md-2">配点</label>
                                                    <div class="col-md-10">
                                                        <input type="number" class="form-control"
                                                               @if(isset($smallTestQuestion['id']))
                                                               name="small_test_questions[{{$smallTestQuestion['id']}}][score]"
                                                               @else
                                                               name="add_small_test_questions[score]"
                                                               @endif
                                                               id="score" min="1" max="100" value="{{$smallTestQuestion['score']}}">
                                                        <input type="hidden" id="arrLang" value="{{$arrLang}}">
                                                    </div>
                                                </div>
                                                @if(count($languages))
                                                    @foreach($languages as $indx_lang=>$items)
                                                        <div class="tab-pane-lang" id="{{$smallTestQuestion['id']}}-{{ $items->lang_code}}-v" style="@if ($items['lang_code'] == 'ja') display: block @endif;padding-top: 16px;">
                                                            <div class="form-group">
                                                                <input type="hidden"
                                                                       @if(isset($smallTestQuestion['id']))
                                                                       name="small_test_questions[{{$smallTestQuestion['id']}}][problems][{{$items->id}}][id]"
                                                                       @else
                                                                       name="add_small_test_questions[problems][{{$items->id}}][id]"
                                                                       @endif
                                                                       id="{{ $items->lang_code}}_small_test_problem_id"
                                                                       value="{{isset($smallTestQuestion['small_test_question_problems'][$items->id]['id']) ? $smallTestQuestion['small_test_question_problems'][$items->id]['id'] : ''}}" />
                                                                <label for="title" class="col-md-2">
                                                                    画像または動画<br>（{{ $items->lang}}）
                                                                    <input id="{{$smallTestQuestion['id']}}_{{ $items->lang_code}}_priority_check"
                                                                           @if(isset($smallTestQuestion['id']))
                                                                           name="small_test_questions[{{$smallTestQuestion['id']}}][problems][{{$items->id}}][priority_check]"
                                                                           @else
                                                                           name="add_small_test_questions[problems][{{$items->id}}][priority_check]"
                                                                           @endif
                                                                           class="pull-right priority_check"  type="checkbox"
                                                                    @if(isset($smallTestQuestion['small_test_question_problems'][$items->id]['priority_check']) && $smallTestQuestion['small_test_question_problems'][$items->id]['priority_check'] == 1 )
                                                                    {{'checked'}}
                                                                            @endif
                                                                        >
                                                                </label>

                                                                <div class="col-md-10">
                                                                    <div id="{{$smallTestQuestion['id']}}_{{ $items->lang_code}}_show_message_duplicate" style="color:red; display:none"> 優先表示は一つのみ選択してください。
                                                                    </div>
                                                                    <script>
                                                                        $(document).ready(function () {
                                                                            $('#{{$smallTestQuestion['id']}}_{{ $items->lang_code}}_priority_check').click(function() {
                                                                                var isMsg = false;
                                                                                @foreach( $languages as $language)
                                                                                        @if ($items->lang_code != $language->lang_code)
                                                                                            if ($('#{{$smallTestQuestion['id']}}_{{$language->lang_code}}_priority_check').is(':checked')) {
                                                                                                isMsg = true;
                                                                                            }
                                                                                        @endif
                                                                                                @endforeach
                                                                                if (isMsg) {
                                                                                    $('#{{$smallTestQuestion['id']}}_{{ $items->lang_code}}_show_message_duplicate').css('display', 'block');
                                                                                    $('#{{$smallTestQuestion['id']}}_{{ $items->lang_code}}_priority_check').prop('checked', false);
                                                                                }
                                                                            });
                                                                        });
                                                                    </script>

                                                                    <div class="kv-avatar" id="{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_image_question">
                                                                        <input id="{{$smallTestQuestion['id']}}_{{ $items->lang_code}}_image_path"
                                                                               @if(isset($smallTestQuestion['id']))
                                                                               name="small_test_questions[{{$smallTestQuestion['id']}}][problems][{{$items->id}}][image_path]"
                                                                               @else
                                                                               name="add_small_test_questions[problems][{{$items->id}}][image_path]"
                                                                               @endif
                                                                               type="file" class="file-loading">
                                                                    </div>
                                                                    <script>
                                                                        $("#{{$smallTestQuestion['id']}}_{{ $items->lang_code}}_image_path").fileinput({
                                                                            showUpload: false,
                                                                            uploadAsync: false,
                                                                            overwriteInitial: true,
                                                                            maxFileCount:1,
                                                                            language: "ja",
                                                                            showClose: false,
                                                                            showRemove: false,
                                                                            initialPreviewFileType: 'image',
                                                                            initialPreview: [
                                                                                "{{ (isset($smallTestQuestion['small_test_question_problems'][$items->id]['image_path']) && $smallTestQuestion['small_test_question_problems'][$items->id]['image_path']!='') ? ($path_media.$smallTestQuestion['small_test_question_problems'][$items->id]['image_path']) : asset('img/default/no-image.jpg') }}",
                                                                            ],
                                                                            initialPreviewAsData: true,
                                                                            initialPreviewConfig: [
                                                                                { caption: "Image", size: 847000},
                                                                            ],
                                                                            allowedFileExtensions: ["jpg", "png", "gif", "jpeg"]
                                                                        });

                                                                    </script>
                                                                    <a href="javascript:void(0)" class="btn btn-sx btn-danger adv_delete" id="{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_delete_image_question"
                                                                       data-id="{{$smallTestQuestion['small_test_question_problems'][$items->id]['id']}}" data-type="">
                                                                        <i class="fa fa-trash"></i> 削除 </a>
                                                                    <script>
                                                                        $('#{{$smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_delete_image_question').bind( "click", function() {
                                                                            var fld = document.getElementById("{{$smallTestQuestion['id']}}_{{ $items->lang_code}}_image_path");
                                                                            fld.form.reset();
                                                                            var id = $(this).attr('data-id');
                                                                            var url = '/small_test_question/delete_image/' + id;
                                                                            $.get(url, function (response) {
                                                                                console.log(response);
                                                                                $('#{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_image_question').children().addClass('{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_image_question_1');
                                                                                $('.{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_image_question_1').children().addClass('{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_image_question_2');
                                                                                $('.{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_image_question_2').children().addClass('{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_image_question_3');
                                                                                $('.{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_image_question_3').children().addClass('{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_image_question_4');
                                                                                $('.{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_image_question_4').children().addClass('{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_image_question_5');
                                                                                $('.{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_image_question_5').children().addClass('{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_image_question_6');
                                                                                $('.{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_image_question_6 img').attr('src', '{{ asset('img/default/no-image.jpg') }}');
                                                                            });
                                                                        });
                                                                        </script>

                                                                </div>
                                                            </div>
                                                            <div class="form-group">

                                                                <div class="col-md-10 col-md-offset-2">
                                                                    <div class="kv-avatar" id="{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_video_question">
                                                                        <input id="{{$smallTestQuestion['id']}}_{{ $items->lang_code}}_video_path"
                                                                               @if(isset($smallTestQuestion['id']))
                                                                               name="small_test_questions[{{$smallTestQuestion['id']}}][problems][{{$items->id}}][video_path]"
                                                                               @else
                                                                               name="add_small_test_questions[problems][{{$items->id}}][video_path]"
                                                                               @endif
                                                                               type="file" class="file-loading">
                                                                    </div>
                                                                    <script>
                                                                        $("#{{$smallTestQuestion['id']}}_{{ $items->lang_code}}_video_path").fileinput({
                                                                            showUpload: false,
                                                                            uploadAsync: true,
                                                                            overwriteInitial: true,
                                                                            showRemove : false,
                                                                            showClose: false,
                                                                            language: "ja",
                                                                            maxFileCount:1,
                                                                            initialPreview: [
                                                                                "{{(isset($smallTestQuestion['small_test_question_problems'][$items->id]['video_path'])&&$smallTestQuestion['small_test_question_problems'][$items->id]['video_path']!='')?($path_media.$smallTestQuestion['small_test_question_problems'][$items->id]['video_path']): asset('img/default/no-video.jpg')}} ",
                                                                            ],
                                                                            initialPreviewAsData: true,
//                                                                            initialPreviewFileType: 'video', // image is the default and can be overridden in config below
                                                                            initialPreviewConfig: [
                                                                                {  type: "video", filetype: "video/mp4", caption: "Video", size: 847000},
                                                                            ],
                                                                            allowedFileExtensions: ["mp4"]
                                                                        });
                                                                        </script>
                                                                    <a href="javascript:void(0)" class="btn btn-sx btn-danger adv_delete" id="{{$smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_delete_video_question"
                                                                       data-id="{{$smallTestQuestion['small_test_question_problems'][$items->id]['id']}}" data-type="">
                                                                        <i class="fa fa-trash"></i> 削除 </a>
                                                                    <script>
                                                                        $('#{{$smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_delete_video_question').bind( "click", function() {
                                                                            var fld = document.getElementById("{{$smallTestQuestion['id']}}_{{ $items->lang_code}}_video_path");
                                                                            fld.form.reset();
                                                                            var id = $(this).attr('data-id');
                                                                            var url = '/small_test_question/delete_video/' + id;
                                                                            $.get(url, function (response) {
                                                                                console.log(response);
                                                                                $('#{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_video_question').children().addClass('{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_video_question_1');
                                                                                $('.{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_video_question_1').children().addClass('{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_video_question_2');
                                                                                $('.{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_video_question_2').children().addClass('{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_video_question_3');
                                                                                $('.{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_video_question_3').children().addClass('{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_video_question_4');
                                                                                $('.{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_video_question_4').children().addClass('{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_video_question_5');
                                                                                $('.{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_video_question_5').children().addClass('{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_video_question_6');
                                                                                $('.{{ $smallTestQuestion['small_test_question_problems'][$items->id]['id']}}_preview_video_question_6 video').attr('src', '');
                                                                            });
                                                                        });
                                                                        </script>

                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="title" class="col-md-2">問題文</label>
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control" rows="5"
                                                                              @if(isset($smallTestQuestion['id']))
                                                                              name="small_test_questions[{{$smallTestQuestion['id']}}][problems][{{$items->id}}][problem_statement]"
                                                                              @else
                                                                              name="add_small_test_questions[problems][{{$items->id}}][problem_statement]"
                                                                              @endif

                                                                    >{{ isset($smallTestQuestion['small_test_question_problems'][$items->id]['problem_statement']) ? $smallTestQuestion['small_test_question_problems'][$items->id]['problem_statement']: ''}}</textarea>
                                                                </div>
                                                            </div>
                                                            <div id="dv-choice-{{$smallTestQuestion['id']}}-{{ $items->lang_code}}">
                                                                @if(isset($smallTestQuestion['small_test_question_choices']) && count($smallTestQuestion['small_test_question_choices'])>0)
                                                                    @if(isset($smallTestQuestion['small_test_question_choices'][$items->id]) && count($smallTestQuestion['small_test_question_choices'][$items->id])>0)
                                                                        @foreach($smallTestQuestion['small_test_question_choices'][$items->id] AS $indChoice=>$small_test_question_choice)
                                                                        <div class="form-group" id="choice-{{$small_test_question_choice['id']}}">
                                                                            <label for="title" class="col-md-2">
                                                                                {{--<input type="hidden" id="{{ $items->lang_code}}_choice_no_{{$indChoice}}_id" name="choice_no[{{ $items->lang_code}}][{{$indChoice}}]" />--}}
                                                                                <input type="hidden" id="{{ $items->lang_code}}_small_test_choice_{{$indChoice}}_id" name="small_test_questions[{{$smallTestQuestion['id']}}][choices][{{$small_test_question_choice['language_id']}}][{{$small_test_question_choice['option_value']}}][id]" value="{{ isset($small_test_question_choice['id']) ? $small_test_question_choice['id'] : ''}}" />
                                                                                <input type="checkbox" id="{{ $items->lang_code}}_true_false_{{$indChoice}}"
                                                                                       @if(isset($smallTestQuestion['id']))
                                                                                       name="small_test_questions[{{$smallTestQuestion['id']}}][choices][{{$items->id}}][{{$small_test_question_choice['option_value']}}][true_or_false]"
                                                                                       @endif
                                                                                       class="pull-right"
                                                                                @if(isset($small_test_question_choice['true_or_false']) && $small_test_question_choice['true_or_false'] == 1)
                                                                                    {{'checked'}}
                                                                                    @endif
                                                                                >
                                                                                &nbsp;選択肢<span class="span-{{ $items->lang_code}}-indx-choice">{{$indChoice}}</span>&nbsp;
                                                                                @if($indChoice > 1)
                                                                                    <a href="javascript:void(0)" id="{{$small_test_question_choice['id']}}_remove_choice" data-id="{{$small_test_question_choice['id']}}">
                                                                                        <i class="fa fa-remove"> </i>
                                                                                    </a>
                                                                                    <script>
                                                                                        $('#{{$small_test_question_choice['id']}}_remove_choice').click(function() {
                                                                                            var id = $(this).data('id');
                                                                                            console.log(id);
                                                                                            $.get("{{ asset('small_test_question/remove') }}/" + id, function (data) {
                                                                                                $('#choice-{{$small_test_question_choice['id']}}').remove();
                                                                                                console.log(data);
                                                                                                location.reload();
                                                                                            })
                                                                                        });

                                                                                        </script>
                                                                                @endif
                                                                            </label>
                                                                            <div class="col-md-10">
                                                                                <textarea class="form-control" rows="5" id ="{{ $items->lang_code}}_description_{{$indChoice}}" name="small_test_questions[{{$smallTestQuestion['id']}}][choices][{{$small_test_question_choice['language_id']}}][{{$small_test_question_choice['option_value']}}][option_description]">{{ isset($small_test_question_choice['option_description']) ? $small_test_question_choice['option_description'] : ''}}</textarea>
                                                                                <div class="kv-avatar" id="{{$small_test_question_choice['id']}}_preview_image_choice">
                                                                                    <input id="{{$smallTestQuestion['id']}}_{{$items->lang_code}}_{{$indChoice}}_choices_image_path" name="small_test_questions[{{$smallTestQuestion['id']}}][choices][{{$small_test_question_choice['language_id']}}][{{$small_test_question_choice['option_value']}}][image_path]" onchange="{{ $items->lang_code}}_{{$indChoice}}_loadFile(event)" type="file" class="avatarSmallTests file-loading">
                                                                                </div>
                                                                                <script>
                                                                                    $("#{{$smallTestQuestion['id']}}_{{$items->lang_code}}_{{$indChoice}}_choices_image_path").fileinput({
                                                                                        showUpload: false,
                                                                                        uploadAsync: false,
                                                                                        overwriteInitial: true,
                                                                                        maxFileCount:1,
                                                                                        language: "ja",
                                                                                        showClose: false,
                                                                                        showRemove: false,
                                                                                        initialPreviewFileType: 'image',
                                                                                        initialPreview: [
                                                                                            "{{ (isset($small_test_question_choice['image_path']) && $small_test_question_choice['image_path'] != '') ? ($path_media.$small_test_question_choice['image_path']): asset('img/default/no-image.jpg') }}",
                                                                                        ],
                                                                                        initialPreviewAsData: true,
                                                                                        initialPreviewConfig: [
                                                                                            { caption: "Image", size: 847000},
                                                                                        ],
                                                                                        allowedFileExtensions: ["jpg", "png", "gif", "jpeg"]
                                                                                    });

                                                                                </script>


                                                                                <a href="javascript:void(0)" class="btn btn-sx btn-danger adv_delete" id="{{$small_test_question_choice['id']}}_delete_image_choice_{{$indChoice}}"
                                                                                   data-id="{{$small_test_question_choice['id']}}" data-type="">
                                                                                    <i class="fa fa-trash"></i> 削除 </a>
                                                                                <script>
                                                                                    $('#{{$small_test_question_choice['id']}}_delete_image_choice_{{$indChoice}}').bind( "click", function() {
                                                                                        var fld_{{$smallTestQuestion['id']}}_{{$items->lang_code}}_{{$indChoice}} = document.getElementById("{{$smallTestQuestion['id']}}_{{$items->lang_code}}_{{$indChoice}}_choices_image_path");
                                                                                        fld_{{$smallTestQuestion['id']}}_{{$items->lang_code}}_{{$indChoice}}.form.reset();
                                                                                        var id = $(this).attr('data-id');
                                                                                        var url = '/small_test_question/delete_image_choice/' + id;
                                                                                        $.get(url, function (response) {
                                                                                            console.log(response);
                                                                                            $('#{{$small_test_question_choice['id']}}_preview_image_choice').children().addClass('{{$small_test_question_choice['id']}}_preview_image_choice_1');
                                                                                            $('.{{$small_test_question_choice['id']}}_preview_image_choice_1').children().addClass('{{$small_test_question_choice['id']}}_preview_image_choice_2');
                                                                                            $('.{{$small_test_question_choice['id']}}_preview_image_choice_2').children().addClass('{{$small_test_question_choice['id']}}_preview_image_choice_3');
                                                                                            $('.{{$small_test_question_choice['id']}}_preview_image_choice_3').children().addClass('{{$small_test_question_choice['id']}}_preview_image_choice_4');
                                                                                            $('.{{$small_test_question_choice['id']}}_preview_image_choice_4').children().addClass('{{$small_test_question_choice['id']}}_preview_image_choice_5');
                                                                                            $('.{{$small_test_question_choice['id']}}_preview_image_choice_5').children().addClass('{{$small_test_question_choice['id']}}_preview_image_choice_6');
                                                                                            $('.{{$small_test_question_choice['id']}}_preview_image_choice_6 img').attr('src', '{{ asset('img/default/no-image.jpg') }}');

                                                                                        });
                                                                                    });

                                                                                </script>
                                                                            </div>
                                                                        </div>

                                                                        @endforeach
                                                                    @else
                                                                        @for($indChoice = 1;$indChoice <3;$indChoice++)
                                                                                <div class="form-group" id="choice-{{$small_test_question_choice['id']}}">
                                                                                    <label for="title" class="col-md-2">
                                                                                        {{--<input type="hidden" id="{{ $items->lang_code}}_choice_no_{{$indChoice}}_id" name="choice_no[{{ $items->lang_code}}][{{$indChoice}}]" />--}}
                                                                                        <input type="hidden" id="{{ $items->lang_code}}_small_test_choice_{{$indChoice}}_id" name="small_test_questions[{{$smallTestQuestion['id']}}][choices][{{$small_test_question_choice['language_id']}}][{{$small_test_question_choice['option_value']}}][id]" value="{{ isset($small_test_question_choice['id']) ? $small_test_question_choice['id'] : ''}}" />
                                                                                        <input type="checkbox" id="{{ $items->lang_code}}_true_false_{{$indChoice}}"
                                                                                               @if(isset($smallTestQuestion['id']))
                                                                                               name="small_test_questions[{{$smallTestQuestion['id']}}][choices][{{$items->id}}][{{$indChoice}}][true_or_false]"
                                                                                               @else
                                                                                               name="add_small_test_questions[choices][{{$items->id}}][{{$indChoice}}][true_or_false]"

                                                                                               @endif
                                                                                               class="pull-right"
                                                                                        @if(isset($smallTestQuestion['id']))
                                                                                        @if(isset($small_test_question_choice['true_or_false']) && $small_test_question_choice['true_or_false'] == 1)
                                                                                            {{'checked'}}
                                                                                                @endif
                                                                                        @endif
                                                                                        >
                                                                                        &nbsp;選択肢<span class="span-{{ $items->lang_code}}-indx-choice">{{$indChoice}}</span>&nbsp;
                                                                                        @if($indChoice > 1)
                                                                                            <a href="javascript:void(0)" id="{{$small_test_question_choice['id']}}_remove_choice" data-id="{{$small_test_question_choice['id']}}">
                                                                                                <i class="fa fa-remove"> </i>
                                                                                            </a>
                                                                                            <script>
                                                                                                $('#{{$small_test_question_choice['id']}}_remove_choice').click(function() {
                                                                                                    var id = $(this).data('id');
                                                                                                    console.log(id);
                                                                                                    $.get("{{ asset('small_test_question/remove') }}/" + id, function (data) {
                                                                                                        $('#choice-{{$small_test_question_choice['id']}}').remove();
                                                                                                        console.log(data);
                                                                                                        location.reload();
                                                                                                    })
                                                                                                });

                                                                                            </script>
                                                                                        @endif
                                                                                    </label>
                                                                                    <div class="col-md-10">
                                                                                        <textarea class="form-control" rows="5" id ="{{ $items->lang_code}}_description_{{$indChoice}}"
                                                                                                  @if(isset($smallTestQuestion['id']))
                                                                                                  name="small_test_questions[{{$smallTestQuestion['id']}}][choices][{{$items->id}}][{{$indChoice}}][option_description]"
                                                                                                  @else
                                                                                                  name="add_small_test_questions[choices][{{$items->id}}][{{$indChoice}}][option_description]"
                                                                                                  @endif
                                                                                        ></textarea>
                                                                                        <div class="kv-avatar" id="{{$small_test_question_choice['id']}}_preview_image_choice">
                                                                                            <input id="{{$smallTestQuestion['id']}}_{{$items->lang_code}}_{{$indChoice}}_choices_image_path"
                                                                                                   @if(isset($smallTestQuestion['id']))
                                                                                                   name="small_test_questions[{{$smallTestQuestion['id']}}][choices][{{$items->id}}][{{$indChoice}}][image_path]"
                                                                                                   @else
                                                                                                   name="add_small_test_questions[choices][{{$items->id}}][{{$indChoice}}][image_path]"
                                                                                                   @endif
                                                                                                   onchange="{{ $items->lang_code}}_{{$indChoice}}_loadFile(event)" type="file" class="avatarSmallTests file-loading">
                                                                                        </div>
                                                                                        <script>
                                                                                            $("#{{$smallTestQuestion['id']}}_{{$items->lang_code}}_{{$indChoice}}_choices_image_path").fileinput({
                                                                                                showUpload: false,
                                                                                                uploadAsync: false,
                                                                                                overwriteInitial: true,
                                                                                                maxFileCount:1,
                                                                                                language: "ja",
                                                                                                showClose: true,
                                                                                                showRemove: false,
                                                                                                initialPreviewFileType: 'image',
                                                                                                initialPreview: [
                                                                                                    "{{ (isset($small_test_question_choice['image_path']) && $small_test_question_choice['image_path'] != '') ? ($path_media.$small_test_question_choice['image_path']): asset('img/default/no-image.jpg') }}",
                                                                                                ],
                                                                                                initialPreviewAsData: true,
                                                                                                initialPreviewConfig: [
                                                                                                    { caption: "Image", size: 847000},
                                                                                                ],
                                                                                                allowedFileExtensions: ["jpg", "png", "gif", "jpeg"]
                                                                                            });

                                                                                        </script>


                                                                                        <a href="javascript:void(0)" class="btn btn-sx btn-danger adv_delete" id="{{$small_test_question_choice['id']}}_delete_image_choice"
                                                                                           data-id="{{$small_test_question_choice['id']}}" data-type="">
                                                                                            <i class="fa fa-trash"></i> 削除 </a>
                                                                                        <script>
                                                                                            $('#{{$small_test_question_choice['id']}}_delete_image_choice').bind( "click", function() {
                                                                                                var id = $(this).attr('data-id');
                                                                                                var url = '/small_test_question/delete_image_choice/' + id;
                                                                                                $.get(url, function (response) {
                                                                                                    console.log(response);
                                                                                                    $('#{{$small_test_question_choice['id']}}_preview_image_choice').children().addClass('{{$small_test_question_choice['id']}}_preview_image_choice_1');
                                                                                                    $('.{{$small_test_question_choice['id']}}_preview_image_choice_1').children().addClass('{{$small_test_question_choice['id']}}_preview_image_choice_2');
                                                                                                    $('.{{$small_test_question_choice['id']}}_preview_image_choice_2').children().addClass('{{$small_test_question_choice['id']}}_preview_image_choice_3');
                                                                                                    $('.{{$small_test_question_choice['id']}}_preview_image_choice_3').children().addClass('{{$small_test_question_choice['id']}}_preview_image_choice_4');
                                                                                                    $('.{{$small_test_question_choice['id']}}_preview_image_choice_4').children().addClass('{{$small_test_question_choice['id']}}_preview_image_choice_5');
                                                                                                    $('.{{$small_test_question_choice['id']}}_preview_image_choice_5').children().addClass('{{$small_test_question_choice['id']}}_preview_image_choice_6');
                                                                                                    $('.{{$small_test_question_choice['id']}}_preview_image_choice_6 img').attr('src', '{{ asset('img/default/no-image.jpg') }}');

                                                                                                });
                                                                                            });

                                                                                        </script>
                                                                                    </div>
                                                                                </div>
                                                                            @endfor
                                                                    @endif
                                                                @endif
                                                                <div class="form-group" id="dvAddNewChoice-{{$smallTestQuestion['id']}}_{{$items->lang_code}}"></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <input type="hidden"
                                                                           id="{{$smallTestQuestion['id']}}_{{$items->lang_code}}_total_choice"
                                                                           name=""
                                                                           value="{{(count($smallTestQuestion['small_test_question_choices'][$items->id])>0) ? count($smallTestQuestion['small_test_question_choices'][$items->id]): 2}}">
                                                                    <a href="javascript:void(0)" id="{{$smallTestQuestion['id']}}_{{$items->lang_code}}_add_choice" data-id="{{$smallTestQuestion['id']}}" class="btn btn-block btn-sm btn-default">
                                                                        <i class="fa fa-plus"></i>
                                                                    </a>
                                                                    <script>
                                                                        $('#{{$smallTestQuestion['id']}}_{{$items->lang_code}}_add_choice').click(function(){
                                                                             var total_choice = $('#{{$smallTestQuestion['id']}}_{{$items->lang_code}}_total_choice').val();
                                                                            var total = parseInt(total_choice)+1;
                                                                            var html = $('#{{$smallTestQuestion['id']}}_{{$items->lang_code}}_dv_choice').html();
                                                                            html = html.replaceAll('CHOICE_INDX', total);
                                                                            html  = '<div class="form-group" id="dv_choice_'+total+'">' + html + '</div>';
                                                                            $( '#dvAddNewChoice-{{$smallTestQuestion['id']}}_{{$items->lang_code}}').before( html);
                                                                            $('#{{$smallTestQuestion['id']}}_{{$items->lang_code}}_total_choice').val(total);
                                                                            $("#{{$smallTestQuestion['id']}}_{{$items->lang_code}}_choices_image_path_" + total).fileinput({
                                                                                showUpload: false,
                                                                                uploadAsync: false,
                                                                                overwriteInitial: true,
                                                                                maxFileCount:1,
                                                                                language: "ja",
                                                                                showClose: false,
                                                                                showRemove: false,
                                                                                initialPreviewFileType: 'image',
                                                                                initialPreview: [
                                                                                    "{{ asset('img/default/no-image.jpg') }}",
                                                                                ],
                                                                                initialPreviewAsData: true,
                                                                                initialPreviewConfig: [
                                                                                    { caption: "Image", size: 847000},
                                                                                ],
                                                                                allowedFileExtensions: ["jpg", "png", "gif", "jpeg"]
                                                                            });
                                                                        });
                                                                    </script>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="{{$smallTestQuestion['id']}}_{{$items->lang_code}}_dv_choice" style="display: none">
                                                                <label for="title" class="col-md-2">
                                                                    <input type="checkbox" id="LANG_CODE_true_false_CHOICE_INDX"
                                                                           @if (isset($smallTestQuestion['id']))
                                                                           name="small_test_questions[{{$smallTestQuestion['id']}}][choices][{{$items->id}}][CHOICE_INDX][true_or_false]"
                                                                           @else
                                                                           name="add_small_test_questions[choices][{{$items->id}}][CHOICE_INDX][true_or_false]"
                                                                           @endif
                                                                           class="pull-right" value="1" />
                                                                    &nbsp;選択肢CHOICE_INDX
                                                                    <a href="javascript:void(0)" id="CHOICE_INDX_remove_choice" data-id="{{$small_test_question_choice['id']}}">
                                                                        <i class="fa fa-remove"> </i>
                                                                    </a>
                                                                    <script>
                                                                        $('#CHOICE_INDX_remove_choice').click(function(){
                                                                                $('#dv_choice_CHOICE_INDX').remove();
                                                                                var total_value = $('#{{$smallTestQuestion['id']}}_{{$items->lang_code}}_total_choice').val()-1;
                                                                                $('#{{$smallTestQuestion['id']}}_{{$items->lang_code}}_total_choice').val(total_value);
//                                                                                resetChoiceNum();
                                                                        });

                                                                    </script>
                                                                </label>
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control" rows="5" id ="{{$items->lang_code}}_description_CHOICE_INDX"
                                                                              @if (isset($smallTestQuestion['id']))
                                                                              name="small_test_questions[{{$smallTestQuestion['id']}}][choices][{{$items->id}}][CHOICE_INDX][option_description]"
                                                                                @else
                                                                                name="add_small_test_questions[choices][{{$items->id}}][CHOICE_INDX][option_description]"
                                                                                @endif
                                                                    ></textarea>
                                                                    <div class="kv-avatar" id="preview_CHOICE_INDX_{{$items->lang_code}}_choices_image_path">
                                                                        <input id="{{$smallTestQuestion['id']}}_{{$items->lang_code}}_choices_image_path_CHOICE_INDX"
                                                                               @if (isset($smallTestQuestion['id']))
                                                                               name="small_test_questions[{{$smallTestQuestion['id']}}][choices][{{$items->id}}][CHOICE_INDX][image_path]"
                                                                               @else
                                                                               name="add_small_test_questions[choices][{{$items->id}}][CHOICE_INDX][image_path]"
                                                                               @endif
                                                                               type="file" class="avatarSmallTests file-loading">
                                                                    </div>
                                                                    <a href="javascript:void(0)" class="btn btn-sx btn-danger adv_delete" id="{{$smallTestQuestion['id']}}_delete_image_choice_CHOICE_INDX"
                                                                       data-id="" data-type="">
                                                                        <i class="fa fa-trash"></i> 削除</a>
                                                                    <script>
                                                                        $('#{{$smallTestQuestion['id']}}_delete_image_choice_CHOICE_INDX').bind( "click", function() {
                                                                            var fld = document.getElementById("{{$smallTestQuestion['id']}}_{{$items->lang_code}}_choices_image_path_CHOICE_INDX");
                                                                            fld.form.reset();
                                                                        });

                                                                    </script>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                            </div>
                                    <div class="side-tools col-md-2" style="padding-top: 16px;">
                                    @if(count($smallTestQuestions))
                                        @foreach($smallTestQuestions as $key => $value)
                                            <ul class="nav nav-tabs tabs-right sideways" id="{{$value['id']}}-tab-lang" data-id="{{$value['id']}}" style="margin-top: 16px;">
                                                @if(count($languages))
                                                    @foreach($languages as $items)
                                                        <li @if ($items['lang_code'] == 'ja') class="active" @endif><a href="#{{$value['id']}}-{{ $items['lang_code']}}-v" data-toggle="tab">{{ $items['lang']}}</a></li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                            <script>
                                                $(document).ready(function () {
                                                    $('#{{$value['id']}}-tab-lang li.active').removeClass('active');
                                                    $("#{{$value['id']}}-tab-lang li:first").addClass("active");
                                                });
                                            </script>
                                        @endforeach
                                    @endif
                                    </div>
                        </div>
                    </div>
            </div>

            <!-- /.box-body -->
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('chapters.list', [$gradeId, $versionId]) }}" class="btn btn-default">戻る</a>
                        <button type="submit" class="btn btn-info pull-right" id="submit-button">登録</button>
                    </div>
                </div>
            </div>
            <!-- /.box-footer -->
                    </div>
            </form>
        </div>
    </div>
    </div>

    <!-- end preview modal -->
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
                        <button type="submit" id="delete-form-question" class="btn btn-primary">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" id="no-image" value="{{ asset('img/default/no-image.jpg') }}">
    <input type="hidden" id="no-video" value="{{ asset('img/default/no-video.jpg') }}">
    <input type="hidden" id="tr_select_small_test_question_hd" value="0">
    <script>
        String.prototype.replaceAll = function(search, replacement) {
            var target = this;
            return target.replace(new RegExp(search, 'g'), replacement);
        };
        $(document).ready(function() {
            $(".tabs-left ").sortable({
                axis: 'y',
                group: 'serialization',
                delay: 100,
                helper: fixHelper,
                update: handleUpdate,
                stop: handleStop
            }).disableSelection();
        });
        $(document).ready(function () {
            $('.tab-pane').hide();
            $('.tabs-right').hide();
            $(".tabs-left li a").bind( "click", function() {
                $('.tab-pane').hide();
                $('.tabs-right').hide();
                tabId = $(this).attr('href');
                var tabId2 = tabId.replace('#', '');
                var tabIdLangRandom = tabId2.replace('-tab', '')+'-ja-v';
                console.log(tabIdLangRandom);
                localStorage.setItem('SELECT_SMALL_TEST_QUESTION',tabId2);
                localStorage.setItem('SELECT_SMALL_TEST_QUESTION_LANG',tabIdLangRandom);
                console.log(tabId);
                $('#' + tabId.replace('#', '')).show();
                $('#' + tabId.replace('#', '')+'-lang').show();
                $('#' + tabId.replace('#', '')+'-lang li').removeClass('active');
                $('#' + tabId.replace('#', '')+'-lang li:first').addClass('active');
                $('#' + tabId.replace('#', '').replace('tab', '')+'ja-v').show();
            });
        });
        $(document).ready(function () {
            $('.tab-pane-lang').hide();
            $(".tabs-right li a").bind("click", function () {
                $('.tab-pane-lang').hide();
                tabLangId = $(this).attr('href');
                var tabLangId2 = tabLangId.replace('#', '');
                console.log(tabLangId);
                localStorage.setItem('SELECT_SMALL_TEST_QUESTION_LANG', tabLangId2);
                $('#' + tabLangId.replace('#', '')).show();
            });
            $(document).ready(function () {
                $('.tab-pane-preview').hide();
                $(".tabs-left-preview li a").bind("click", function () {
                    $('.tab-pane-preview').hide();
                    tabIdPreview = $(this).attr('href');
                    $('#' + tabIdPreview.replace('#', '')).show();
                });
                $('#ja-preview').show();
            });

            $(document).ready(function () {
                $(".tabs-left li:last-child").click(function() {
                    localStorage.setItem('SELECT_SMALL_TEST_QUESTION','{{$value_last_small_test_question}}-tab');
                    localStorage.setItem('SELECT_SMALL_TEST_QUESTION_LANG', '{{$value_last_small_test_question}}-ja-v' );
                });
            });


            $(document).ready(function () {
                var SELECT_SMALL_TEST_QUESTION = localStorage.getItem('SELECT_SMALL_TEST_QUESTION');
                if (!!SELECT_SMALL_TEST_QUESTION) {
                    $('#' + SELECT_SMALL_TEST_QUESTION).show();
                    $('#' + SELECT_SMALL_TEST_QUESTION + '-lang').show();
                    $('.tabs-left li').removeClass('active');
                    $('.tabs-left li a[href="#' + SELECT_SMALL_TEST_QUESTION + '"]').parent().addClass('active');
                    $('#' + SELECT_SMALL_TEST_QUESTION + '-lang li:first').addClass('active');
                    var SELECT_SMALL_TEST_QUESTION_LANG = localStorage.getItem('SELECT_SMALL_TEST_QUESTION_LANG');
                    if (!!SELECT_SMALL_TEST_QUESTION_LANG) {
                        $('#' + SELECT_SMALL_TEST_QUESTION_LANG).show();
                        $('#' + SELECT_SMALL_TEST_QUESTION + '-lang li').removeClass('active');
                        $('.tabs-right li a[href="#' + SELECT_SMALL_TEST_QUESTION_LANG + '"]').parent().addClass('active');
                    }
                }
            });

            $(document).ready(function () {
                $('#modal-delete').on('show.bs.modal', function (event) {
                    var action = $(event.relatedTarget).data('action');
                    $('#delete-form').attr('action', action);
                });
            });
            function resetChoiceNum() {
                $('.span-' + langCode + '-indx-choice').each(function (indx, element) {
                    $(this).html(indx + 1);
                });
                if ($('#' + langCode + '_RemoveChoice_0').length > 0) {
                    $('#' + langCode + '_RemoveChoice_0').remove();
                }
                if ($('#' + langCode + '_RemoveChoice_1').length > 0) {
                    $('#' + langCode + '_RemoveChoice_1').remove();
                }
            }
        });
    </script>
    <!-- end delete modal -->
@endsection
@section('javascript')
    <script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>
    <script src="{{ asset('js/common/sortable.js') }}"></script>
    <script src="{{ asset('js/content_management/small_test/common.js') }}"></script>
    <script src="{{ asset('js/content_management/small_test/validate.js') }}"></script>
    @if(count($languages))
        @foreach($languages as $indx=>$items)
            <script>
                $('#{{ $items->lang_code}}_delete_image_question').bind( "click", function() {
                    var id = $(this).attr('data-id');
                    var url = '/small_test_question/delete_image/' + id;
                    $.get(url, function (response) {
                        console.log(response);
                        $('.{{ $items->lang_code}}_image_path6 img').attr('src', '{{ asset('img/default/no-image.jpg') }}');
                    });
                });
                $('#{{ $items->lang_code}}_delete_video_question').bind( "click", function() {
                    var id = $(this).attr('data-id');
                    var url = '/small_test_question/delete_video/' + id;
                    $.get(url, function (response) {
                        console.log(response);
                        $('.{{ $items->lang_code}}_video_path6 video').attr('src', '');
                    });
                });
            </script>
            <script>
                @if(isset($rsChoice[$items->lang_code]))
                    @foreach($rsChoice[$items->lang_code] AS $indChoice=>$elChoice)
                    $('#{{ $items->lang_code}}_delete_image_choice_{{$indChoice}}').bind( "click", function() {
                        var id = $(this).attr('data-id');
                        var url = '/small_test_question/delete_image_choice/' + id;
                        $.get(url, function (response) {
                            console.log(response);
                            @foreach($languages as $language)
                            $('.{{ $language->lang_code}}{{$indChoice}}_preview_image_path6 img').attr('src', '');
                            @endforeach
                        });
                    });
                    @endforeach
                @endif
            </script>

            <script>
                @for($i=0; $i < 10 ; $i++)
                var {{ $items->lang_code}}_{{$i}}_loadFile = function(event) {
                            @foreach($languages as $key=>$language)
                            var control = $("#{{ $items->lang_code}}_choices_image_path_{{$i}}");
                                control.replaceWith( control = control.clone( true ) );
                            @endforeach
                            @foreach($languages as $key=>$language)
                                 var {{ $language->lang_code}}_{{$i}}_output = document.getElementById('{{ $language->lang_code}}{{$i}}_preview_image_path7');
                                 {{ $language->lang_code}}_{{$i}}_output.src = URL.createObjectURL(event.target.files[0]);
                            @endforeach
                };
                @endfor
            </script>
        @endforeach
    @endif
    @endsection
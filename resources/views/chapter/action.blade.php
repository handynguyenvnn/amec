@extends('layouts.app')
@section('title', 'チャプター編集')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/content_management/chapter/edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/content_management/small_test/edit.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/themes/explorer/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/phone-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/content_management/chapter/action.css') }}">
@endsection
@section('content-header')
    <h1> チャプター編集</h1>
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">チャプター編集</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="box">
                    <div class="search-coma col-sm-12">
                        <form action="{{ route('chapters.action',[$gradeId , $versionId, $id]) }}" method="get">
                            <div class="col-md-12 form-group">
                                <label class="col-sm-4 control-label text-right">コマ名</label>
                                <div class="col-sm-3">
                                    <input type="text" id="value_search_coma" name ="coma_name"
                                           value="{{isset($_GET['coma_name']) ? $_GET['coma_name'] : ''}}"
                                           class="form-control">
                                </div>
                                <div class="col-sm-1">
                                    <button id="" type="submit" class="btn btn-success btn-block" data-id="{{$id}}">検索</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <form id="chapterForm" class="form-horizontal" method="post"
                          action="{{ route('chapters.update',[$gradeId . '-' . $versionId . '-' . $id]) }}" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" id="arrLang" value="{{$arrLang}}">
                        <input type="hidden" name="version_id" value="{{$versionId}}">
                        <input type="hidden" name="grade_id" value="{{$gradeId}}">
                        <input type="hidden" id="chapter_id" value="{{$id}}">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div style="padding-top: 10px;">
                                <div class="col-xs-10">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="common-v">
                                            <div class="tool-bar">
                                                <div class="row">

                                                    @foreach($languages as $language)
                                                        <div class="col-md-12 form-group">
                                                            <label class="col-sm-3 control-label text-right">
                                                                @if($language->lang_code == 'ja')
                                                                    {{'チャプター名'}}
                                                                @endif {{$language->lang}}</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control"
                                                                       maxlength="62"
                                                                       name="chapter_names[{{$language->id}}]"
                                                                       value="{{isset($chapter_names[$language->id]['name']) ? $chapter_names[$language->id]['name'] : ''}}"
                                                                >
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <!--begin main content-->
                                            <div id="question-answer-body" style="display: none;">
                                                <div class="row box-content">
                                                    <div class="side-tools col-md-4" style="padding-top: 20px;">
                                                        <input type="hidden" id="idTable" value="select_small_test_questions">
                                                        <ul class="nav nav-tabs tabs-left sideways" id="select_small_test_questions" base-url="{{ asset('sortable/comas/frame_no/') }}/chapter_id={{$id}}">
                                                            @if(count($comas))


                                                                @foreach($comas as $key => $value)
                                                                    @if($key == count($comas)-1)
                                                                        <li data-no="{{$key}}" data-id="{{$value['id']}}"><a href="#-tab" data-toggle="tab" style="color:white;background-color: #00a65a;border-color: #008d4c;text-align: center;"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
                                                                    @else
                                                                        <li style="display: flex;" data-no="{{$value['frame_no']}}" data-id="{{$value['id']}}">
                                                                            <a href="#{{$value['id']}}-tab" data-toggle="tab" style="flex-grow: 1; margin-right: 5px; border-radius: 5px;"><i class="fa fa-arrows"></i>  {{ $value['frame_name']}}</a>
                                                                            <a href="#{{$value['id']}}-tab" class="btn btn-xs btn-info" data-toggle="modal" data-id="{{$value['id']}}" style="margin-right: 5px; border-radius: 5px;" data-target="#{{$value['id']}}-modal-preview"><i class="fa fa-eye"></i></a>
                                                                            <button style="width: 44px;" data-action="{{ route('chapters.removeComa', [$gradeId, $versionId, $id, $value['id']]) }}" type="button"
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
                                                                                                    @foreach($languages as $key => $language)
                                                                                                        <li
                                                                                                        ><a href="#{{$value['id']}}-{{$language->lang_code}}-preview" data-toggle="tab">{{$language->lang}}</a>
                                                                                                        </li>
                                                                                                    @endforeach
                                                                                                </ul>
                                                                                            </div>
                                                                                            <div class="col-xs-9">
                                                                                                <!-- Tab panes -->
                                                                                                <div class="tab-content">
                                                                                                    @if(count($languages))
                                                                                                        @foreach($languages as $language)
                                                                                                            <div class="tab-pane-preview"
                                                                                                                 id="{{$value['id']}}-{{$language->lang_code}}-preview">
                                                                                                                <div class="phone view_2" id="phone_1">
                                                                                                                    <div class="content-preview" id="{{ $language->lang_code}}-content-preview" style="margin-top: 30px; text-align: center;">
                                                                                                                        @if(isset($value['coma_languages'][$language->id]['video_path']) && $value['coma_languages'][$language->id]['video_path'] != '')
                                                                                                                            <video id="{{ $language->lang_code}}-video-preview" style="max-width: 105%;height: auto;" controls >
                                                                                                                                <source src="
                                                                                                                                {{ $path_media.$value['coma_languages'][$language->id]['video_path'] }}
                                                                                                                                        " type="video/mp4">
                                                                                                                            </video>
                                                                                                                        @else
                                                                                                                            <img src="
                                                                                                                                {{ isset($value['coma_languages'][$language->id]['image_path']) ? ($path_media.$value['coma_languages'][$language->id]['image_path']) : asset('img/default/no-image.jpg') }}
                                                                                                                                    " id="{{ $language->lang_code}}-img-preview" style="max-width: 100%;height: 150px; object-fit: scale-down;width: 236px;background: #9df4ff;" >
                                                                                                                        @endif
                                                                                                                    </div>
                                                                                                                    <div class="content-description" id="{{ $language->lang_code}}-content-description">{{ isset($value['coma_languages'][$language->id]['description']) ? $value['coma_languages'][$language->id]['description'] : '' }}</div>
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
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    {{ method_field('PUT') }}
                                                    <div class ="side-tools col-md-6" style="padding-top: 16px;">
                                                        @if(count($comas))
                                                            @foreach($comas as $indx=>$coma)
                                                                <div class="tab-pane-coma" id="{{$coma['id']}}-tab-coma" style="padding-top: 16px;">
                                                                    <div class="form-group">
                                                                        <label for="id" class="col-md-3">ID</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" id="id_chapter_coma"
                                                                                   @if(isset($coma['id']))
                                                                                   name="comas[{{$coma['id']}}][id]"
                                                                                   @else
                                                                                   name="addcomas[id]"
                                                                                   @endif
                                                                                   value="{{isset($coma['id']) ? $coma['id'] : ''}}"
                                                                                   readonly formnovalidate />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="title" class="col-md-3"><span
                                                                                    class="text-red">※</span>&nbsp;コマ名</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" maxlength="62" class="form-control" id='name_chapter_coma'
                                                                                   @if(isset($coma['id']))
                                                                                   name="comas[{{$coma['id']}}][name]"
                                                                                   @else
                                                                                   name="addcomas[name]"
                                                                                   @endif
                                                                                   value ="{{isset ($coma['frame_name']) ? $coma['frame_name'] : ''}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="title" class="col-md-3">&nbsp;コマカテゴリ</label>
                                                                        <div class="col-md-9">
                                                                            <select
                                                                                    @if(isset($coma['id']))
                                                                                    name="comas[{{$coma['id']}}][category_id]"
                                                                                    @else
                                                                                    name="addcomas[category_id]"
                                                                                    @endif
                                                                                    id="coma_category_id" class="form-control">
                                                                                @if(count($optionComaCategory))
                                                                                    @foreach($optionComaCategory as $occ)
                                                                                        <option value="{{$occ->id}}"
                                                                                        @if($occ->id == $coma['category_id'])
                                                                                            {{'selected'}}
                                                                                                @endif

                                                                                        >{{$occ->frame_category_name}}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="col-md-3">&nbsp;画像または動画</label>
                                                                    </div>
                                                                    @if(count($languages))
                                                                        @foreach($languages as $items)
                                                                            <div class="tab-pane-lang" id="{{$coma['id']}}-{{$items->lang_code}}-v">
                                                                                <div class="form-group">

                                                                                    <input type="hidden"
                                                                                           @if(isset($coma['id']))
                                                                                           name="comas[{{$coma['id']}}][coma_languages][{{$items->id}}][id]"
                                                                                           @else
                                                                                           name="addcomas[coma_languages][{{$items->id}}][id]"
                                                                                           @endif
                                                                                           id="{{ $items->lang_code}}_coma_language_id"
                                                                                           value="{{isset($coma['coma_languages'][$items->id]['id'])? $coma['coma_languages'][$items->id]['id'] : ''}}"/>

                                                                                    <label for="title" class="col-md-3 {{ $items->lang_code}}_label" data-preview-image="">
                                                                                        画像ファイル<br>{{ $items->lang}}
                                                                                        <input type="checkbox"
                                                                                               @if(isset($coma['id']))
                                                                                               name="comas[{{$coma['id']}}][coma_languages][{{$items->id}}][priority_check]"
                                                                                               @else
                                                                                               name="addcomas[coma_languages][{{$items->id}}][priority_check]"
                                                                                               @endif
                                                                                               @if(isset($coma['coma_languages'][$items->id]['priority_check']) && $coma['coma_languages'][$items->id]['priority_check']==1))
                                                                                               {{'checked'}}
                                                                                               @endif

                                                                                               id="{{$coma['id']}}_{{$items->lang_code}}_checkbox" class="pull-right"></label>
                                                                                    <script>
                                                                                        $(document).ready(function() {
                                                                                            $('#{{$coma['id']}}_{{$items->lang_code}}_checkbox').click(function(){
                                                                                                var isMsg = false;
                                                                                                @foreach ($languages as $language)
                                                                                                    if('{{$items->lang_code}}' !== '{{$language->lang_code}}')
                                                                                                    {
                                                                                                        if ($('#{{$coma['id']}}_{{$language->lang_code}}_checkbox').is(':checked')) {
                                                                                                            isMsg = true;
                                                                                                        }
                                                                                                }
                                                                                                @endforeach
                                                                                                if (isMsg) {
                                                                                                    $('#{{$coma['id']}}_{{$items->lang_code}}_priority_check').css('display', 'block');
                                                                                                    $('#{{$coma['id']}}_{{$items->lang_code}}_checkbox').prop('checked', false);
                                                                                                }
                                                                                            });
                                                                                        });
                                                                                    </script>
                                                                                    <div class="col-sm-9">
                                                                                        <div id="{{$coma['id']}}_{{ $items->lang_code}}_priority_check" class="error color-error" style="color:red; display:none;">優先表示は一つのみ選択してください。</div>
                                                                                        <div class="kv-avatar" id="{{$coma['id']}}_{{ $items->lang_code}}_image_preview" data-lang="{{ $items->lang_code}}_image_preview">
                                                                                            <input id="{{$coma['id']}}_{{ $items->lang_code}}_image_path"
                                                                                                   @if(isset($coma['id']))
                                                                                                   name="comas[{{$coma['id']}}][coma_languages][{{$items->id}}][image_path]"
                                                                                                   @else
                                                                                                   name="addcomas[coma_languages][{{$items->id}}][image_path]"
                                                                                                   @endif
                                                                                                   type="file" class="file-loading">
                                                                                        </div>
                                                                                        <a href="javascript:void(0)" class="btn btn-sx btn-danger adv_delete" id="{{ $coma['id']}}_{{ $items->lang_code}}_delete_image"
                                                                                           data-id="{{(isset($coma['coma_languages'][$items->id]['id']) && $coma['coma_languages'][$items->id]['id']!='') ? $coma['coma_languages'][$items->id]['id'] : '' }}" data-type="image">
                                                                                            <i class="fa fa-trash"></i> 削除 </a>
                                                                                    </div>
                                                                                    <script>
                                                                                        $('#{{ $coma['id']}}_{{ $items->lang_code}}_delete_image').bind( "click", function() {
                                                                                            var fld = document.getElementById("{{$coma['id']}}_{{ $items->lang_code}}_image_path");
                                                                                            fld.form.reset();
                                                                                            var id = $(this).attr('data-id');
                                                                                            var url = '/chapter/delete_image/' + id;
                                                                                            $.get(url, function (response) {
                                                                                                console.log(response);
                                                                                                $('#{{$coma['id']}}_{{ $items->lang_code}}_image_preview').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_image_1');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_image_1').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_image_2');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_image_2').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_image_3');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_image_3').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_image_4');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_image_4').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_image_5');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_image_5').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_image_6');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_image_6 img').attr('src', '{{ asset('img/default/no-image.jpg') }}');
                                                                                            });
                                                                                        });
                                                                                    </script>
                                                                                    <script>
                                                                                        $("#{{$coma['id']}}_{{ $items->lang_code}}_image_path").fileinput({
                                                                                            showUpload: false,
                                                                                            uploadAsync: false,
                                                                                            overwriteInitial: true,
                                                                                            showRemove : false,
                                                                                            showClose: false,
                                                                                            language: "ja",
                                                                                            maxFileCount:1,
                                                                                            initialPreviewFileType: 'image',
                                                                                            initialPreview: [
                                                                                                "{{(isset($coma['coma_languages'][$items->id]['image_path']) && $coma['coma_languages'][$items->id]['image_path']!='') ? ($path_media.$coma['coma_languages'][$items->id]['image_path']) : asset('img/default/no-image.jpg') }}",
                                                                                            ],
                                                                                            initialPreviewAsData: true,
                                                                                            initialPreviewConfig: [
                                                                                                { caption: "Image", size: 847000},
                                                                                            ],
                                                                                            allowedFileExtensions: ["jpg", "png", "gif", "jpeg"]
                                                                                        });
                                                                                    </script>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="title" class="col-md-3 {{ $items->lang_code}}_label" data-preview-audio="">音声ファイル</label>
                                                                                    <div class="col-sm-9">
                                                                                        <div class="kv-avatar" id="{{$coma['id']}}_{{ $items->lang_code}}_audio_preview">
                                                                                            <input id="{{$coma['id']}}_{{ $items->lang_code}}_audio_path"
                                                                                                   @if(isset($coma['id']))
                                                                                                   name="comas[{{$coma['id']}}][coma_languages][{{$items->id}}][audio_path]"
                                                                                                   @else
                                                                                                   name="addcomas[coma_languages][{{$items->id}}][audio_path]"
                                                                                                   @endif
                                                                                                   type="file" class="file-loading">
                                                                                        </div>
                                                                                        <a href="javascript:void(0)" class="btn btn-sx btn-danger adv_delete" id="{{$coma['id']}}_{{ $items->lang_code}}_delete_audio"
                                                                                           data-id="{{(isset($coma['coma_languages'][$items->id]['id']) && $coma['coma_languages'][$items->id]['id']!='') ? $coma['coma_languages'][$items->id]['id'] : '' }}" data-type="music">
                                                                                            <i class="fa fa-trash"></i> 削除 </a>
                                                                                    </div>

                                                                                    <script>
                                                                                        $('#{{$coma['id']}}_{{ $items->lang_code}}_delete_audio').bind( "click", function() {
                                                                                            var fld = document.getElementById("{{$coma['id']}}_{{ $items->lang_code}}_audio_path");
                                                                                            fld.form.reset();
                                                                                            var id = $(this).attr('data-id');
                                                                                            var url = '/chapter/delete_audio/' + id;
                                                                                            $.get(url, function (response) {
                                                                                                console.log(response);
                                                                                                $('#{{$coma['id']}}_{{ $items->lang_code}}_audio_preview').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_audio_1');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_audio_1').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_audio_2');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_audio_2').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_audio_3');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_audio_3').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_audio_4');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_audio_4').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_audio_5');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_audio_5').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_audio_6');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_audio_6 audio').attr('src', '');
                                                                                            });
                                                                                        });
                                                                                        $("#{{$coma['id']}}_{{ $items->lang_code}}_audio_path").fileinput({
                                                                                            showUpload: false,
                                                                                            uploadAsync: true,
                                                                                            overwriteInitial: true,
                                                                                            showRemove : false,
                                                                                            showClose: false,
                                                                                            language: "ja",
                                                                                            maxFileCount:1,
                                                                                            initialPreviewFileType: 'audio',
                                                                                            initialPreview: [
                                                                                                "{{(isset($coma['coma_languages'][$items->id]['music_path']) && $coma['coma_languages'][$items->id]['music_path']!='') ? ($path_media.$coma['coma_languages'][$items->id]['music_path']) : asset('img/default/no-audio.jpg') }}",
                                                                                            ],
                                                                                            initialPreviewAsData: true,
                                                                                            initialPreviewConfig: [
                                                                                                {  type: "audio", filetype: "audio/mp3",  caption: "Audio", size: 847000},
                                                                                            ],
                                                                                            allowedFileExtensions: ["mp3"]

                                                                                        });

                                                                                    </script>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="title" class="col-md-3 {{ $items->lang_code}}_label" data-preview-video="">音声ビデオ</label>
                                                                                    <div class="col-sm-9">
                                                                                        <div class="kv-avatar" id="{{$coma['id']}}_{{ $items->lang_code}}_video_preview">
                                                                                            <input id="{{$coma['id']}}_{{ $items->lang_code}}_video_path"
                                                                                                   @if(isset($coma['id']))
                                                                                                   name="comas[{{$coma['id']}}][coma_languages][{{$items->id}}][video_path]"
                                                                                                   @else
                                                                                                   name="addcomas[coma_languages][{{$items->id}}][video_path]"
                                                                                                   @endif
                                                                                                   type="file" class="file-loading">
                                                                                        </div>
                                                                                        <a href="javascript:void(0)" class="btn btn-sx btn-danger adv_delete" id="{{$coma['id']}}_{{ $items->lang_code}}_delete_video"
                                                                                           data-id="{{(isset($coma['coma_languages'][$items->id]['id']) && $coma['coma_languages'][$items->id]['id']!='') ? $coma['coma_languages'][$items->id]['id'] : '' }}" data-type="video">
                                                                                            <i class="fa fa-trash"></i> 削除 </a>
                                                                                    </div>

                                                                                    <script>
                                                                                        $('#{{$coma['id']}}_{{ $items->lang_code}}_delete_video').bind( "click", function() {
                                                                                            var fld = document.getElementById("{{$coma['id']}}_{{ $items->lang_code}}_video_path");
                                                                                            fld.form.reset();
                                                                                            var id = $(this).attr('data-id');
                                                                                            var url = '/chapter/delete_video/' + id;
                                                                                            $.get(url, function (response) {
                                                                                                console.log(response);
                                                                                                $('#{{$coma['id']}}_{{ $items->lang_code}}_video_preview').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_video_1');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_video_1').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_video_2');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_video_2').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_video_3');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_video_3').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_video_4');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_video_4').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_video_5');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_video_5').children().addClass('{{$coma['id']}}_{{ $items->lang_code}}_preview_video_6');
                                                                                                $('.{{$coma['id']}}_{{ $items->lang_code}}_preview_video_6 video').attr('src', '');
                                                                                            });
                                                                                        });
                                                                                        $("#{{$coma['id']}}_{{ $items->lang_code}}_video_path").fileinput({
                                                                                            showUpload: false,
                                                                                            uploadAsync: true,
                                                                                            overwriteInitial: true,
                                                                                            showRemove : false,
                                                                                            showClose: false,
                                                                                            language: "ja",
                                                                                            maxFileCount:1,
                                                                                            initialPreview: [
                                                                                                "{{(isset($coma['coma_languages'][$items->id]['video_path']) && $coma['coma_languages'][$items->id]['video_path']!='') ? ($path_media.$coma['coma_languages'][$items->id]['video_path']) : asset('img/default/no-video.jpg') }}",
                                                                                            ],
                                                                                            initialPreviewAsData: true,
//                                                                            initialPreviewFileType: 'video', // image is the default and can be overridden in config below
                                                                                            initialPreviewConfig: [
                                                                                                {  type: "video", filetype: "video/mp4", caption: "Video", size: 847000},
                                                                                            ],
                                                                                            allowedFileExtensions: ["mp4"]
                                                                                        });
                                                                                    </script>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="" class="col-sm-3 control-label text-right">説明</label>
                                                                                    <div class="col-sm-9">
                                                                                                                                                <textarea rows="4" class="form-control" id="{{ $items->lang_code}}_description"
                                                                                                                                                          @if(isset($coma['id']))
                                                                                                                                                          name="comas[{{$coma['id']}}][coma_languages][{{$items->id}}][description]"
                                                                                                                                                          @else
                                                                                                                                                          name="addcomas[coma_languages][{{$items->id}}][description]"
                                                                                                                                                        @endif

                                                                                                                                                >{{$coma['coma_languages'][$items->id]['description']}}</textarea>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                        @endforeach

                                                                    @endif

                                                                </div>

                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class=" col-md-2 " style="padding-top: 20px;">
                                                        @if(count($comas)>0)
                                                            @foreach($comas as $indx=>$coma)
                                                                <ul class="nav nav-tabs tabs-right sideways" id="{{isset($coma['id']) ? $coma['id']: ''}}-tab-lang" data-id="{{isset($coma['id']) ? $coma['id']: ''}}">
                                                                    @if(count($languages))
                                                                        @foreach($languages as $items)
                                                                            <li ><a href="#{{isset($coma['id']) ? $coma['id']: ''}}-{{$items->lang_code}}-v" data-toggle="tab">{{ $items->lang}}</a></li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            @endforeach
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{ route('chapters.list', [$gradeId, $versionId]) }}" class="btn btn-default">戻る</a>
                                            <button type="submit" class="btn btn-info pull-right">登録</button>
                                        </div>
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
                    <input type="hidden" name="_method" value="delete"/>
                    <div class="modal-body">
                        <h4 class="text-center">データを削除します。</h4>
                        <h4 class="text-center">本当によろしいですか。</h4>
                    </div>
                    <div class="modal-footer button-delete">
                        <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-primary">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
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
            $('.tab-pane-coma').hide();
            $('.tab-pane-lang').hide();
            $('.tabs-right').hide();
            $(".tabs-left li a").bind( "click", function() {
                $('.tab-pane-coma').hide();
                $('.tabs-right').hide();
                tabId = $(this).attr('href');
                var tabId2 = tabId.replace('#', '');
                var tabIdLangRandom = tabId2.replace('-tab', '')+'-ja-v';
                localStorage.setItem('SELECT_COMA',tabId2);
                localStorage.setItem('SELECT_COMA_LANG',tabIdLangRandom);
                console.log(tabId);
                $('#' + tabId.replace('#', '')+'-coma').show();
                $('#' + tabId.replace('#', '')+'-lang').show();
                $('#' + tabId.replace('#', '')+'-lang li').removeClass('active');
                $('#' + tabId.replace('#', '')+'-lang li:first').addClass('active');
                $('#' + tabId.replace('#', '').replace('tab', '')+'ja-v').show();
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".tabs-right li a").bind( "click", function() {
                $('.tab-pane-lang').hide();
                tabIdLang = $(this).attr('href');
                var tabLangId2 = tabIdLang.replace('#', '');
                localStorage.setItem('SELECT_COMA_LANG', tabLangId2);
                $('#' + tabIdLang.replace('#', '')).show();
            });
            $('#ja-v').show();
            $('#tool-bar-ja-v').show();
            $('#question-answer-body').show();
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
            var SELECT_COMA = localStorage.getItem('SELECT_COMA');
            if (!!SELECT_COMA) {
                $('#' + SELECT_COMA+ '-coma').show();
                $('#' + SELECT_COMA + '-lang').show();
                $('.tabs-left li').removeClass('active');
                $('.tabs-left li a[href="#' + SELECT_COMA + '"]').parent().addClass('active');
                $('#' + SELECT_COMA_LANG + '-lang li:first').addClass('active');
                var SELECT_COMA_LANG = localStorage.getItem('SELECT_COMA_LANG');
                if (!!SELECT_COMA_LANG) {
                    $('#' + SELECT_COMA_LANG).show();
                    $('#' + SELECT_COMA_LANG + '-lang li').removeClass('active');
                    $('.tabs-right li a[href="#' + SELECT_COMA_LANG + '"]').parent().addClass('active');
                }
            }
        });
        $(document).ready(function () {
            $(".tabs-left li:last-child").click(function() {
                localStorage.setItem('SELECT_COMA','{{$value_last_coma}}-tab');
                localStorage.setItem('SELECT_COMA_LANG', '{{$value_last_coma}}-ja-v' );
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#modal-delete').on('show.bs.modal', function (event) {
                // Button that triggered the modal
                var action = $(event.relatedTarget).data('action');
                $('#delete-form').attr('action', action);
            });
        });
    </script>
    <script src="{{asset('plugins/AdminLTE/app.min.js')}}"></script>
    <script src="{{ asset('js/common/sortable.js') }}?t=<?php echo time() ?>"></script>
    <script src="{{asset('plugins/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-fileinput/js/locales/ja.js')}}"></script>
    <script src="{{ asset('js/content_management/chapter/edit.js') }}"></script>
    <script src="{{ asset('js/content_management/chapter/delete_coma.js') }}"></script>
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/content_management/chapter/validate.js') }}"></script>
@endsection

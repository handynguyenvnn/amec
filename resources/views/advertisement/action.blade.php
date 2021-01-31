@extends('layouts.app')
@section('title', '広告管理')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/themes/explorer/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/phone-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master_management/advertisement/action.css') }}">
@endsection
@section('content-header')
    <h1> 広告管理
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">広告管理 </li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="post" id="form" class="form-horizontal" enctype="multipart/form-data" action="{{isset($data['id']) ? route('advertisements.update', $data['id']) : route('advertisements.store')}}">
                {{ csrf_field() }}
                @if(isset($data['id']))
                {{ method_field('PUT') }}
                @endif
                <div class="box-header with-border">
                    <div class="form-group">
                        <label for="content" class="col-sm-2 control-label">コンテンツ広告</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="content" name="content_ad">
                                @foreach($onOff as $key => $oo)
                                    <option value="{{$key}}"
                                    @if ($key == $data['content_ad'])
                                        {{'selected'}}
                                            @endif
                                    >{{$oo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gacha" class="col-sm-2 control-label">ガチャ広告</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="gacha" name="gacha_ad">
                                @foreach($onOff as $key => $oo)
                                    <option value="{{$key}}"
                                    @if ($key == $data['gacha_ad'])
                                        {{'selected'}}
                                            @endif
                                    >{{$oo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="banner" class="col-sm-2 control-label">バナー広告</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="banner" name="banner_ad">
                                @foreach($onOff as $key => $oo)
                                    <option value="{{$key}}"
                                    @if ($key == $data['banner_ad'])
                                        {{'selected'}}
                                            @endif
                                    >{{$oo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- end box-header -->
                <div class="box-body with-border ">
                    <div class="card-baai">
                        <div class="card-baai-round">
                            @if(count($data['collection']))
                                @foreach($data['collection'] as $key => $collection)
                                    <input type="hidden" name="ad_video_{{$key}}" value="{{$collection['id']}}">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">広告動画</label>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <div class="col-sm-9">
                                                    <div class="kv-avatar" id="preview_{{$key}}">
                                                        <input id="image_path_{{$key}}" name="image_path_{{$key}}" type="file" class="file-loading">
                                                    </div>
                                                    <button data-action="{{route('advertisements.delete', $collection['id'])}}" type="button"
                                                            class="btn btn-sx btn-danger adv_delete" data-toggle="modal"
                                                            id="adv_delete"
                                                            data-target="#modal-delete"
                                                            data-id="{{$collection['id']}}">
                                                        <i class="fa fa-trash"> 削除</i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                                <div class="form-group" id="add-more" style="display: none">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">広告動画</label>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <div class="col-sm-9">
                                                    <div class="kv-avatar">
                                                        <input id="image_path_KEY" name="image_path_KEY" type="file" class="file-loading">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="form-group" id="dvAddNew"></div>
                        <div class="row">
                            <div class="col-sm-5 col-sm-offset-2">
                                <div id="show-error" class="error color-error" style="display:none; color:red">対応しているフォーマットを入れてください。(png,jpg,gif,mp4)</div>
                                <input type="hidden" id="totalAds" name="totalAds" value="{{count($data['collection'])-1}}">
                                <a href="javascript:void(0)" onclick="AddNewMore();" class="btn btn-block btn-sm btn-default">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-9">
                            <a href ="{{route('master.index')}}" class="btn btn-default btn-back">戻る</a>
                            <button type="submit" class="btn btn-info pull-right btn-submit">登録</button>
                        </div>
                    </div>
                </div>
            </form>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('#modal-delete').on('show.bs.modal', function (event) {
                // Button that triggered the modal
                var action = $(event.relatedTarget).data('action');
                $('#delete-form').attr('action', action);
            })
        });
    </script>
    <script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>
    <script src="{{asset('plugins/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-fileinput/js/locales/ja.js')}}"></script>
    <script src="{{ asset('js/content_management/chapter/edit.js') }}"></script>

    <script>
        @if(isset($data['collection']))
            @foreach($data['collection'] as $key => $collection)
                @if($collection['extension'] == 'mp4')
                    $("#image_path_{{$key}}").fileinput({
                        showUpload: false,
                        uploadAsync: false,
                        overwriteInitial: true,
                        showRemove: false,
                        maxFileCount:1,
                        showClose: false,
                        language: "ja",
                        msgInvalidFileExtension: '対応しているフォーマットを入れてください。(png,jpg,gif,mp4)',
                        initialPreviewFileType: 'video',
                        initialPreview: [
                            "{{isset($collection['path']) ? ($path_media.$collection['path']): asset('img/default/no-image.jpg')}}",
                        ],
                        initialPreviewAsData: true,
                        initialPreviewConfig: [
                            { caption: "Video", size: 847000},
                        ],
                        allowedFileExtensions: ["jpg", "png", "gif", "jpeg",'mp4']
                    });
            $('#preview_{{$key}}').children().addClass('preview_{{$key}}_1');
            $('.preview_{{$key}}_1').children().addClass('preview_{{$key}}_2');
            $('.preview_{{$key}}_2').children().addClass('preview_{{$key}}_3');
            $('.preview_{{$key}}_3').children().addClass('preview_{{$key}}_4');
            $('.preview_{{$key}}_4').children().addClass('preview_{{$key}}_5');
            $('.preview_{{$key}}_5').children().addClass('preview_{{$key}}_6');
            $('.preview_{{$key}}_6 video').attr("src", "{{isset($collection['path']) ? ($path_media.$collection['path']): asset('img/default/no-video.jpg')}}");
                @else
                    $("#image_path_{{$key}}").fileinput({
                        showUpload: false,
                        uploadAsync: false,
                        overwriteInitial: true,
                        showRemove: false,
                        showClose: false,
                        maxFileCount:1,
                        language: "ja",
                        msgInvalidFileExtension: '対応しているフォーマットを入れてください。(png,jpg,gif,mp4)',
                        initialPreviewFileType: 'image',
                        initialPreview: [
                            "{{isset($collection['path']) ? ($path_media.$collection['path']):asset('img/default/no-image.jpg')}}",
                        ],
                        initialPreviewAsData: true,
                        initialPreviewConfig: [
                            { caption: "Image", size: 847000},
                        ],
                        allowedFileExtensions: ["jpg", "png", "gif", "jpeg",'mp4']
                    });
             @endif
            @endforeach
        @endif
        </script>
    <script>
        function AddNewMore() {

            var html = $('#add-more').html();
            var indx = $('#totalAds').val();
            indx = parseInt(indx)+1;
            html = html.replaceAll('KEY', indx);
            $( '#dvAddNew').before( html);
            console.log(indx);
            $("#image_path_"+indx).fileinput({
                showUpload: false,
                uploadAsync: false,
                showRemove: false,
                showClose: true,
                overwriteInitial: true,
                maxFileCount:1,
                msgInvalidFileExtension: '対応しているフォーマットを入れてください。(png,jpg,gif,mp4)',
                language: "ja",
                initialPreviewFileType: 'image',
                initialPreview: [
                    "{{asset('img/default/no-image.jpg')}}",
                ],
                initialPreviewAsData: true,
                initialPreviewConfig: [
                    { caption: "Image", size: 847000 },
                ],
                allowedFileExtensions: ["jpg", "png", "gif", "jpeg",'mp4']
            });
            $('#totalAds').val(indx);

        }
        String.prototype.replaceAll = function(search, replacement) {
            var target = this;
            return target.replace(new RegExp(search, 'g'), replacement);
        };

    </script>
@endsection

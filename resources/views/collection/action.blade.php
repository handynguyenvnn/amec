@extends('layouts.app')

@section('title')
    コレクション編集
@endsection

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/themes/explorer/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/collection/edit.css') }}">
    {{--<link rel="stylesheet" href="{{ asset('css/collection/input.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/content_management/collection/action.css') }}">
@endsection

@section('content-header')
    <h1> コレクション編集 </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> ホーム</a></li>
        <li class="active">コレクション管理</li>
        <li class="active">コレクション編集</li>
    </ol>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <div class="col-xs-8">
                <form id="createForm" class="form-horizontal" method="post" onsubmit="return validateForm()"
                      action="{{ ($collection_no)? route('collections.update', $collection_no) : route('collections.store')}}"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if($data != null)
                        {{ method_field('PUT') }}
                    @endif
                    <div class="tab-pane active" id="common-v">
                        <div class="form-group">
                            <label for="inputId" class="col-sm-3 control-label">コレクションNo
                            </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" maxlength="10"
                                       id="collection_no" name="collection_no"
                                       value="{{isset($data['collection_no']) ? $data['collection_no'] : null}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSelectReality"
                                   class="col-sm-3 control-label">レアリティ</label>

                            <div class="col-sm-9">
                                <select class="form-control" id="inputSelectShorui" name="level_id">
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id }}"
                                        @if((isset($data['level_id'])) && $data['level_id'] == $level->id)
                                            {{'selected'}}
                                                @endif
                                        >{{ $level->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file_upload_ja"
                                   class="col-sm-3 control-label">画像</label>

                            <div class="col-sm-9">
                                <div class="kv-avatar">
                                    <input id="image_path" name="image_path" type="file" class="file-loading">
                                </div>
                                @if($data && isset($data['collection_no']))
                                <button data-action="{{($data && isset($data['collection_no'])) ? route('collections.deleteImage', $data['collection_no']) : ''}}"
                                        type="button"
                                        class="btn btn-sx btn-danger adv_delete" data-toggle="modal"
                                        id="adv_delete"
                                        data-target="#modal-delete"
                                        data-id="{{($data && isset($data['collection_no'])) ? route('collections.deleteImage', $data['collection_no']) : ''}}">
                                    <i class="fa fa-trash"> 削除</i></button>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSetsumeiVietnamese"
                                   class="col-sm-3 control-label">Youtubeリンク
                            </label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" maxlength="250" name='youtube_link'
                                       value="{{isset($data['youtube_link']) ? $data['youtube_link'] : ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSelectShorui"
                                   class="col-sm-3 control-label">メーカー(ローマ字)</label>

                            <div class="col-sm-9">
                                <select class="form-control" name="maker_id">
                                    @foreach($makers as $maker)
                                        <option value="{{$maker->id}}"
                                        @if((isset($data['maker_id'])) && $data['maker_id'] == $maker->id)
                                            {{'selected'}}
                                                @endif
                                        >{{$maker->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    @if(count($languages))
                        @foreach($languages as $items)
                            <div class="tab-pane" id="{{ $items->lang_code}}-v">
                                <div class="form-group">
                                    <label for="inputId" class="col-sm-3 control-label">ID
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control"
                                               id="inputId" name="{{$items->lang_code.'_id'}}"
                                               value="{{isset($data[$items->lang_code.'_id']) ? $data[$items->lang_code.'_id'] : null}}"
                                               readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputCollectionName"
                                           class="col-sm-3 control-label"><span
                                                style="color:red;">*</span>コレクション名</label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" maxlength="62"
                                               id="inputCollectionName{{$items->lang_code}}"
                                               name="{{$items->lang_code.'_name'}}"
                                               value="{{isset($data[$items->lang_code.'_name'])  ? $data[$items->lang_code.'_name'] : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSetsumeiJapanese"
                                           class="col-sm-3 control-label">説明
                                    </label>

                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="4" placeholder=""
                                                  name="{{$items->lang_code.'_description'}}">{{isset($data[$items->lang_code.'_description']) ? $data[$items->lang_code.'_description'] : ''}}</textarea>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="back-btn">
                                <a href="{{route("collections.index")}}" class="btn btn-default">戻る</a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="save-btn">
                                <button type="submit" class="btn btn-info pull-right">更新
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </form>
            </div>
            <div class="col-xs-2">
                <ul class="nav nav-tabs tabs-right sideways">
                    <li class="active"><a class="active" href="#common-v" data-toggle="tab">共通</a></li>
                    @if(count($languages))
                        @foreach($languages as $items)
                            <li
                            ><a href="#{{ $items['lang_code']}}-v" data-toggle="tab">{{ $items['lang']}}</a></li>
                        @endforeach
                    @endif
                </ul>
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
    <script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/locales/ja.js') }}"></script>
    <script src="{{ asset('js/collection/edit.js') }}"></script>
    <script src="{{ asset('js/collection/validate.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".tabs-right li a").bind("click", function () {
                $('.tab-pane').hide();
                tabId = $(this).attr('href');
                $('#' + tabId.replace('#', '')).show();
            });
            $('#common-v').show();
        });
        $(document).ready(function () {
            $('#modal-delete').on('show.bs.modal', function (event) {
                // Button that triggered the modal
                var action = $(event.relatedTarget).data('action');
                $('#delete-form').attr('action', action);
            })
        });
    </script>
    <script>
        $("#image_path").fileinput({
            showUpload: false,
            uploadAsync: false,
            showRemove: false,
            showClose: true,
            overwriteInitial: true,
            maxFileCount: 1,
            msgInvalidFileExtension: '対応しているフォーマットを入れてください。(png,jpg,gif,mp4)',
            language: "ja",
            initialPreviewFileType: 'image',
            initialPreview: [
                "{{(isset($data['image_path']) && $data['image_path'] != '') ? ($path_media.$data['image_path']) : asset('img/default/no-image.jpg') }}",
            ],
            initialPreviewAsData: true,
            initialPreviewConfig: [
                {caption: "Image", size: 847000},
            ],
            allowedFileExtensions: ["jpg", "png", "gif", "jpeg"]

        });
    </script>
@endsection
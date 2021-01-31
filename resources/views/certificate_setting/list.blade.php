@extends('layouts.app')
@section('title', '認定証設定')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/themes/explorer/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/phone-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user-management/setting_certification.css') }}">
@endsection
        @section('content-header')
            <h1>認定証設定</h1>
            <ol class="breadcrumb">
                <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">認定証設定</li>
            </ol>
        @endsection
        @section('content')
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <form action="{{route('certificate-settings.update')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-10">
                                    @if(count($languages))
                                        @foreach($languages as $items)
                                            <div class="tab-pane" id="{{ $items->lang_code}}-v">
                                                <input type="hidden" name="{{ $items->lang_code}}_id" id="{{ $items->lang_code}}_id" value="{{isset($data[$items->lang_code . '_id']) ? $data[$items->lang_code . '_id']: ''}}"/>
                                                <div class="bg-mobile">
                                                    <div class="main-content-mobile">
                                                        <div class="content-mobile">
                                                                <img id = "{{$items->lang_code}}_image_path" width="100%" src="{{isset($data[$items->lang_code . '_image_path'])?$data[$items->lang_code . '_image_path']: ''}}">
                                                        </div>
                                                    </div>
                                                    <div class="input-group text-right">
                                                        <div class="col-md-6 col-sm-9">
                                                            <div class="kv-avatar" style="width:330px">
                                                                <input id="{{ $items->lang_code}}_avatar" name="{{ $items->lang_code}}_image_path" type="file" class="file-loading" onchange="{{ $items->lang_code}}loadFile(event)">
                                                            </div>
                                                            <button data-action="{{route('certificate-settings.delete',$data[$items->lang_code . '_id'] )}}" type="button"
                                                                    class="btn btn-sx btn-danger" data-toggle="modal"
                                                                    id="adv_delete"
                                                                    data-target="#{{ $items->lang_code}}modal-delete"
                                                                    data-id="{{ $data[$items->lang_code . '_id']}}">
                                                                <i class="fa fa-trash"></i> 削除 </button>
                                                        </div>
                                                        <span class="input-group-btn">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                 </div>
                                <div class="col-xs-2">
                                    <ul class="nav nav-tabs tabs-left sideways">
                                        @if(count($languages))
                                            @foreach($languages as $items)
                                                <li
                                                        @if($items['lang_code'] == 'ja')
                                                        class="active"
                                                        @endif
                                                ><a href="#{{ $items['lang_code']}}-v" data-toggle="tab">{{ $items['lang']}}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-9 col-sm-offset-3">
                                </div>
                                <div class="col-md-6 col-sm-9 col-sm-offset-2">
                                    <div class="back-btn">
                                        <a href="{{route("users.index")}}" class="btn btn-default">戻る</a>
                                        <button type="submit" class="btn btn-info pull-right">更新</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </form>
            </div>
            @if(count($languages))
                @foreach($languages as $items)
                    <div class="modal fade bs-example-modal-xs" id="{{ $items->lang_code}}modal-delete" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <form id="{{ $items->lang_code}}delete-form" action="" method="post">
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
                @endforeach
            @endif
    @endsection
@section('javascript')
    @if(count($languages))
        @foreach($languages as $indx=>$items)
            <script>
                var {{ $items->lang_code}}loadFile = function(event) {
                    var {{ $items->lang_code}}output = document.getElementById('{{ $items->lang_code}}_image_path');
                    {{ $items->lang_code}}output.src = URL.createObjectURL(event.target.files[0]);
                };
            </script>
        @endforeach
    @endif
    <script>
        @if(count($languages))
            @foreach($languages as $indx=>$items)
                $(document).ready(function () {
                    $('#{{ $items->lang_code}}modal-delete').on('show.bs.modal', function (event) {
                        // Button that triggered the modal
                        var action = $(event.relatedTarget).data('action');
                        $('#{{ $items->lang_code}}delete-form').attr('action', action);
                    });
                });
            @endforeach
        @endif
    </script>
    <script>
        $(document).ready(function () {
//            $('.tab-pane').hide();
            $(".tabs-left li a").bind( "click", function() {
                $('.tab-pane').hide();
                tabId = $(this).attr('href');
                $('#' + tabId.replace('#', '')).show();
            });
            $('#ja-v').show();
        });
    </script>
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/locales/ja.js') }}"></script>
    <script src="{{ asset('js/user-management/setting_certification.js') }}"></script>
    <script src="{{ asset('js/user-management/setting_certification_ajax.js') }}"></script>
    <script>
        @if(count($languages))
            @foreach($languages as $indx=>$items)
            $("#{{ $items->lang_code}}_avatar").fileinput({
                showUpload: false,
                showRemove: false,
                uploadAsync: false,
                overwriteInitial: true,
                language : 'ja',
                maxFileCount:1,
                showPreview: false,
                allowedFileExtensions: ["jpg", "png", "gif", "jpeg"]
            });
        @endforeach
    @endif
    </script>
@endsection

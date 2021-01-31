@extends('layouts.app')
@section('title', '通知設定')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/user-management/notification_setting.css') }}">
@endsection
<!-- Content Header (Page header) --><!-- InstanceBeginEditable name="title" -->
@section('content-header')
    <h1>通知設定</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">通知設定</li>
    </ol>
@endsection
<!-- InstanceEndEditable --><!-- Main content -->
@section('content')
    <!-- Default box -->
    <!-- InstanceBeginEditable name="content" -->
    <div class="box-body" style="background-color:#fff">
        <div class="form-group">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove"><i class="fa fa-times"></i></button>
                </div>
                <div class="box box-info">
                    <div class="col-sm-12">
                        <form class="form-horizontal" method="post"
                              action="{{ route('notification_settings.update') }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-10">
                                        @if(count($languages))
                                            @foreach($languages as $items)
                                                <div class="tab_content tab-pane" id="{{ $items->lang_code}}-v">
                                                    <div class="form-group">
                                                        <input type="hidden"
                                                               value="{{isset($data[$items->lang_code.'_id']) ? $data[$items->lang_code.'_id'] : ''}}"
                                                               name="{{ $items->lang_code}}_id">
                                                    <div class="col-sm-8 col-sm-offset-2">
                                                                    <span class="form-control-static">
                                                                        最終ログイン年月日から
                                                                        <input type="number"
                                                                               id="{{$items->lang_code}}notification_1_term"
                                                                               class="input-day"
                                                                               value="{{isset($data['notification_1_term']) ? $data['notification_1_term'] : 0}}"
                                                                               name="notification_1_term">
                                                                        日が経過したユーザIDを検出して通知
                                                                    </span>
                                                                </div>
                                                    </div>
                                                    <div class="form-group">
                                                                <label for="" class="col-sm-2 control-label">
                                                                    <input type="checkbox" id="{{$items->lang_code}}checkbox_1"
                                                                           @if(isset($data['notification_1_setting']) && $data['notification_1_setting']== 1)
                                                                           {{"checked"}}
                                                                           @endif
                                                                           name="notification_1_setting"
                                                                           value="{{isset($data['notification_1_setting']) ? $data['notification_1_setting'] : 0}}">
                                                                    {{ $items['lang']}}</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"
                                                                           name="{{$items->lang_code}}_notification_1_description"
                                                                           value="{{isset($data[$items->lang_code.'_notification_1_description']) ? $data[$items->lang_code.'_notification_1_description']: ''}}">
                                                                </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <hr>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-8 col-sm-offset-2">
                                                                        <span class="form-control-static">
                                                                            最終ログイン年月日から
                                                                            <input type="number"
                                                                                   id="{{$items->lang_code}}notification_2_term"
                                                                                   class="input-day"
                                                                                   value="{{isset($data['notification_2_term']) ? $data['notification_2_term'] : 0}}"
                                                                                   name="notification_2_term">
                                                                            日が経過したユーザIDを検出して通知
                                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-2 control-label">
                                                            <input type="checkbox" id="{{$items->lang_code}}checkbox_2"
                                                                   @if(isset($data['notification_2_setting']) && $data['notification_2_setting']== 1)
                                                                   {{"checked"}}
                                                                   @endif
                                                                   name="notification_2_setting"
                                                                   value="{{isset($data['notification_2_setting']) ? $data['notification_2_setting']: ''}}">
                                                            {{ $items['lang']}}</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control"
                                                                   name="{{$items->lang_code}}_notification_2_description"
                                                                   value="{{isset($data[$items->lang_code.'_notification_2_description']) ? $data[$items->lang_code.'_notification_2_description']: ''}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <hr>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-8 col-sm-offset-2">
                                            <span class="form-control-static">
                                                最終ログイン年月日から
                                                <input type="number"
                                                       id="{{$items->lang_code}}notification_3_term"
                                                       class="input-day"
                                                       value="{{isset($data['notification_3_term']) ? $data['notification_3_term'] : 0}}"
                                                       name="notification_3_term">
                                                日が経過したユーザIDを検出して通知
                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-2 control-label">
                                                            <input type="checkbox" id="{{$items->lang_code}}checkbox_3"
                                                                   @if(isset($data['notification_3_setting']) && $data['notification_3_setting']== 1)
                                                                   {{"checked"}}
                                                                   @endif
                                                                   name="notification_3_setting"
                                                                   value="{{isset($data['notification_3_setting']) ? $data['notification_3_setting']: ''}}">
                                                            {{ $items['lang']}}</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control"
                                                                   name="{{$items->lang_code}}_notification_3_description"
                                                                   value="{{isset($data[$items->lang_code.'_notification_3_description']) ? $data[$items->lang_code.'_notification_3_description']: ''}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <hr>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-8 col-sm-offset-2">
                                            <span class="form-control-static">
                                                最終ログイン年月日から
                                                <input type="number"
                                                       id="{{$items->lang_code}}notification_4_term"
                                                       class="input-day"
                                                       value="{{isset($data['notification_4_term']) ? $data['notification_4_term'] : 0}}"
                                                       name="notification_4_term">
                                                日が経過したユーザIDを検出して通知
                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-2 control-label">
                                                            <input type="checkbox" id="{{$items->lang_code}}checkbox_4"
                                                                   @if(isset($data['notification_4_setting']) && $data['notification_4_setting']== 1)
                                                                   {{"checked"}}
                                                                   @endif
                                                                   name="notification_4_setting"
                                                                   value="{{isset($data['notification_4_setting']) ? $data['notification_4_setting']: ''}}">
                                                            {{ $items['lang']}}</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control"
                                                                   name="{{$items->lang_code}}_notification_4_description"
                                                                   value="{{isset($data[$items->lang_code.'_notification_4_description']) ? $data[$items->lang_code.'_notification_4_description']: ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                    <div class="col-xs-2">
                                            <ul class="nav nav-tabs tabs-right sideways">
                                                @if(count($languages))
                                                    @foreach($languages as $items)
                                                        <li
                                                                @if($items['lang_code'] == 'ja')
                                                                class="active"
                                                                @endif
                                                        >
                                                            <a href="#{{ $items['lang_code']}}-v" data-toggle="tab"
                                                               style=" float: left; width: 80%;">{{ $items['lang']}}</a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <a href="{{ route('users.index') }}" class="btn btn-default">戻る</a>
                                            <button class="btn btn-info btn-submit pull-right">更新</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!-- /.box-body -->
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- InstanceEndEditable -->
    <!-- /.box -->

@endsection
@section('javascript')

    <script src="{{ asset('js/user-management/notification_setting.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".tabs-right li a").bind( "click", function() {
                $('.tab-pane').hide();
                tabId = $(this).attr('href');
                $('#' + tabId.replace('#', '')).show();
            });
            $('#ja-v').show();
        });
    </script>
    <script>
        @if(count($languages))
            @foreach($languages as $items)
                @for($i=0; $i <= 4 ; $i ++)
                $('#{{ $items->lang_code}}checkbox_{{$i}}').change(function() {
                    if($(this).is(":checked")) {
                        @foreach($languages as $key=>$language)
                        $('#{{ $language->lang_code}}checkbox_{{$i}}').prop( "checked", true);
                        @endforeach
                    }else{
                        @foreach($languages as $key=>$language)
                        $('#{{ $language->lang_code}}checkbox_{{$i}}').prop( "checked", false );
                        @endforeach
                    }
                });
                $('#{{ $items->lang_code}}notification_{{$i}}_term').change(function() {
                    var value = $(this).val();
                    @foreach($languages as $key=>$language)
                    $('#{{ $language->lang_code}}notification_{{$i}}_term').val(value);
                    @endforeach
                });
                @endfor
            @endforeach
        @endif
    </script>
@endsection

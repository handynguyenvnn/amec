@extends('layouts.app')

@section('title', '利用規約')

@section('stylesheet')

    <link rel="stylesheet" href="{{ asset('css/master_management/use_amec.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/themes/explorer/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/phone-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user-management/terms_of_service.css') }}">
@endsection

@section('content-header')
    <h1> 利用規約
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> ホーム</a></li>
        <li class="active"> 利用規約</li>
    </ol>
@endsection

@section('content')
    <div class="">
        <div class="box box-info">
            <form class="form-horizontal" method="post" action = "{{ route('terms_of_service.update') }}" style="margin-top: 20px">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-sm-8">
                            @if(count($languages))
                                @foreach($languages as $items)
                                    <div class="tab_content tab-pane"  id="{{ $items->lang_code}}-v">
                                        <input type="hidden" name="{{ $items->lang_code}}_id" value="{{isset($data[$items->lang_code.'_id']) ? $data[$items->lang_code.'_id'] : ''}}">
                                        <textarea id="content_text" class="form-control" name = "{{ $items->lang_code}}_terms_of_use" rows="30" placeholder="">{{isset($data[$items->lang_code.'_terms_of_use']) ? $data[$items->lang_code.'_terms_of_use'] : ''}}</textarea>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-xs-4">
                            <ul class="nav nav-tabs tabs-right sideways">
                                @if(count($languages))
                                    @foreach($languages as $items)
                                        <li
                                                @if($items['lang_code'] == 'ja')
                                                class="active"
                                                @endif
                                        >
                                            <a href="#{{ $items['lang_code']}}-v" data-toggle="tab" style=" float: left; width: 80%;">{{ $items['lang']}}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="box-footer" style="margin-right: 20%;">
                    <button type="submit" class="btn btn-info pull-right">更新</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
//            $('.tab-pane').hide();
            $(".tabs-right li a").bind( "click", function() {
                $('.tab-pane').hide();
                tabId = $(this).attr('href');
                $('#' + tabId.replace('#', '')).show();
            });
            $('#ja-v').show();
        });
    </script>
    <script src="{{ asset('plugins/bootbox/bootbox.min.js')}}"></script>
    {{--<script src="{{ asset('js/master_management/user_amec/ajax.js')}}"></script>--}}
    <script src="{{ asset('plugins/tinymce/tinymce.min.js')}}"></script>
    <script src="{{ asset('plugins/tinymce/langs/ja.js')}}"></script>
    <script src="{{ asset('js/common/config_tinymce.js')}}"></script>
    {{--<script src="{{ asset('js/terms_of_service/script.js') }}"></script>--}}
@endsection
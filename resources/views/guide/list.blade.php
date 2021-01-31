@extends('layouts.app')
@section('title', 'AMECの使い方')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/master_management/use_amec.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/themes/explorer/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/phone-preview.css') }}">


@endsection
@section('content-header')
    <div class="row">
        <div class="col-lg-12">
            <form class="form-horizontal" method="post" action="{{ route('guides.update') }}" style="margin-top: 20px">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="box box-info block">
                    <div class="row">
                        <div class="col-sm-8">

                            <div class="edit-tiny-mce tab_container">
                                @if(count($languages))
                                    @foreach($languages as $items)
                                        <div class="tab_content tab-pane"  id="{{ $items->lang_code}}-v">
                                            <input type="hidden" name="{{ $items->lang_code}}_id" value="{{isset($data[$items->lang_code.'_id']) ? $data[$items->lang_code.'_id']: ''}}">
                                            <textarea class="form-control" name="{{ $items->lang_code}}_html_code" id="content_text" rows="20"
                                                      maxlength="65535">{{isset($data[$items->lang_code.'_html_code']) ? $data[$items->lang_code.'_html_code']: ''}}</textarea>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="btn-item text-right">
                                    <div class="error-message">
                                        <p>
                                            ※プレビューを見る前に保存するようにしてください。
                                        </p>
                                    </div>
                                    <button class="btn-success btn-customer btn-submit">
                                        保存
                                    </button>
                                </div>

                                <div class="clr"></div>
                                <div class="return-error">
                                    <div class="return">
                                        <a href="{{route('master.index')}}" class="btn btn-default btn-customer-two">
                                            戻る
                                        </a>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-sm-4">
                            <ul class="nav nav-tabs tabs-right sideways">
                                @if(count($languages))
                                    @foreach($languages as $items)
                                        <li
                                                @if($items['lang_code'] == 'ja')
                                                class="active"
                                                @endif
                                        >
                                            <a href="#{{ $items['lang_code']}}-v" data-toggle="tab" style=" float: left; width: 80%;">{{ $items['lang']}}<img onclick="showPreview({{isset($data[$items->lang_code.'_id']) ? $data[$items->lang_code.'_id']: ''}});" id="preview" src="../img/master_management/eye-button.png" style="float:right;"></a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="modal-preview" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">プレビュー(コンテンツ)</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane-preview"
                                 id="preview">
                                <div class="phone view_2" id="phone_1" style="width: 250px;height: 445px;overflow-: scroll;overflow-y: scroll;">
                                    <div class="content-description" id="content-description" style="width: 230px;height: 340px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
@section('javascript')
    <script>
        function showPreview(id) {
            $('#modal-preview').modal('show');
            var url = '/guides/' + id;
            $.get(url, function (response) {
                $('#content-description').html(response.html_code);
            });
        }
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

@endsection

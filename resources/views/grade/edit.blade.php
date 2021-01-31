@extends('layouts.app')
@section('title', 'グレード編集')

@section('stylesheet')

    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/themes/explorer/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/phone-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/content_management/grade/edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/content_management/grade/action.css') }}">
@endsection
@section('content-header')
    <h1> グレード編集
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">グレード編集 </li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="nav-tabs-custom" id="tabs">
                            <ul class="nav nav-tabs">
                                <li class="active" id="select_tab_1"><a href="#tab_1" data-toggle="tab" aria-expanded="true">基本設定</a></li>
                                <li class="" id="select_tab_2"><a href="#tab_2" data-toggle="tab" aria-expanded="false">バージョン</a></li>
                            </ul>
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <p class="text-center">チュートリアルは既に存在します。</p>
                                            <p class="text-center"> コンテンツタイプをノーマルに変更してください。</p>
                                        </div>
                                        <div class="modal-body text-center">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @if ($errors->any())
                                <script>
                                    $(document).ready(function(){
                                        $("#myModal").modal();
                                    });
                                </script>
                            @endif
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <form class="form-horizontal" method="post" action="{{route('grades.update', $grades['id'] ? $grades['id'] : '')}}" id="createForm" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('POST') }}
                                        <div class="box-body">
                                            <div class="col-xs-10">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="common-v">
                                                        <div class="form-group">
                                                            <label for="grade-type" class="col-sm-3 control-label">コンテンツタイプ</label>
                                                            <div class="col-md-4 col-sm-9">
                                                                <select name="content_type" id="grade-type" class="form-control">
                                                                    @foreach($contentType as $key=>$ct)
                                                                        <option value="{{$key}}"
                                                                        @if($grades['content_type']== $key)
                                                                            {{'selected'}}
                                                                                @endif
                                                                        >{{$ct}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label  class="col-sm-3 control-label">合格点正答率</label>
                                                            <div class="col-md-4 col-sm-9">
                                                                <input type="text" class="form-control" name="pass_score_rate" value="{{$passScoreRate}}"/>
                                                            </div>
                                                            <div class="col-md-1 form-group">%</div>

                                                        </div>
                                                        <div class="form-group">
                                                            <label  class="col-sm-3 control-label">マイページ背景</label>
                                                            <div class="col-md-6 col-sm-6">
                                                                <input type="hidden" name="my_back_ground_id" value="{{isset($myPageBg['id']) ? $myPageBg['id'] : ''}}">
                                                                    <div class="kv-avatar" id="image_preview">
                                                                        <input id="image_path" name="my_page_background" type="file" class="file-loading">
                                                                    </div>
                                                                    <button data-action="{{($grades && isset($grades['id'])) ? route('grades.deleteImage', $grades['id']) : ''}}" type="button"
                                                                        class="btn btn-sx btn-danger adv_delete" data-toggle="modal"
                                                                        id="adv_delete"
                                                                        data-target="#modal-delete"
                                                                        data-id="{{(($grades && isset($grades['id'])) ? $grades['id'] : '')}}">
                                                                    <i class="fa fa-trash"> 削除</i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(count($languages))
                                                        @foreach($languages as $items)
                                                            <div class="tab-pane" id="{{ $items['lang_code']}}-v">
                                                                <input type="hidden" name="{{ $items['lang_code']}}_small_test_id" value="{{isset($small_test_id) ? $small_test_id : 0}}">
                                                                <input type="hidden" name="{{ $items['lang_code']}}_big_test_id" value="{{isset($small_big_id) ? $small_big_id : 0}}">
                                                                <input type="hidden" name="{{ $items['lang_code']}}_messages_big_test_id" value="{{isset($bigTests[$items['lang_code']]->messages_big_test_id) ? $bigTests[$items['lang_code']]->messages_big_test_id: 0}}">
                                                                <input type="hidden" name="{{ $items['lang_code']}}_messages_small_test_id" value="{{isset($bigTests[$items['lang_code']]->messages_small_test_id) ? $bigTests[$items['lang_code']]->messages_small_test_id: 0}}">

                                                                <div class="form-group text-center">
                                                                    <div class="col-md-9 col-sm-9">大テスト設定</div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="{{ $items['lang_code']}}_grade_id" class="col-sm-3 control-label">グレード名</label>
                                                                    <div class="col-md-4 col-sm-9">
                                                                        <input type="hidden" name="{{ $items['lang_code']}}_grade_id" value="{{$grades['id']}}"/>
                                                                        <input type="hidden" name="{{ $items['lang_code']}}_name_grade_id" value="{{isset($grades[$items['lang_code'] . '_name_grade_id']) ? $grades[$items['lang_code'] . '_name_grade_id']: ''}}"/>
                                                                        <input type="text" maxlength="62" class="form-control" id="{{ $items['lang_code']}}_name" name="{{ $items['lang_code']}}_name" value="{{isset($grades[$items['lang_code'] . '_name'])?$grades[$items['lang_code'] . '_name']:''}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="{{ $items['lang_code']}}_passing_message" class="col-sm-3 control-label">合格メッセージ</label>
                                                                    <div class="col-md-6 col-sm-9">
                                                                        <textarea class="form-control" name="{{ $items['lang_code']}}_passing_message" id="{{ $items['lang_code']}}_passing_message">{{isset($bigTests[$items['lang_code']]->passing_message)?$bigTests[$items['lang_code']]->passing_message:''}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="{{ $items['lang_code']}}_failed_message" class="col-sm-3 control-label">不合格メッセージ</label>
                                                                    <div class="col-md-6 col-sm-9">
                                                                        <textarea class="form-control" name="{{ $items['lang_code']}}_failed_message" id="{{ $items['lang_code']}}_failed_message">{{isset($bigTests[$items['lang_code']]->failed_message)?$bigTests[$items['lang_code']]->failed_message:''}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="{{ $items['lang_code']}}_correct_message" class="col-sm-3 control-label">正解メッセージ</label>
                                                                    <div class="col-md-6 col-sm-9">
                                                                        <textarea class="form-control" name="{{ $items['lang_code']}}_correct_message" id="{{ $items['lang_code']}}_correct_message">{{isset($bigTests[$items['lang_code']]->correct_message)?$bigTests[$items['lang_code']]->correct_message:''}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="incorrect-jp" class="col-sm-3 control-label">不正解メッセージ</label>
                                                                    <div class="col-md-6 col-sm-9">
                                                                        <textarea class="form-control" class="form-control" name="{{ $items['lang_code']}}_incorrect_message" id="{{ $items['lang_code']}}_incorrect_message" >{{isset($bigTests[$items['lang_code']]->incorrect_message)?$bigTests[$items['lang_code']]->incorrect_message:''}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            @include('partials.language')
                                            <div class="clearfix"></div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-9 col-sm-offset-3">
                                                    <button type="submit" class="btn btn-info pull-right">保存</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-footer -->
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="row header-box">
                                        <div class="col-md-6">
                                            <span class="pull-left">バージョン</span>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-2 pull-right">
                                                <a href="{{route('chapters.list', $grades['id'])}}#smallTestSetting" class="btn btn-block btn-success">新規</a>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="idTable" value="tbl-version">
                                    <table class="table table-bordered table-hover" id="tbl-version" base-url="{{ asset('sortable/versions/version_no/grade_id=' . ($grades['id'] ? $grades['id'] : '0')) }}">
                                        <thead>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>ID</td>
                                            <td>バージョン名</td>
                                            <td colspan="3">操作</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $items)
                                            <tr id="tr-{{$items->version_no}}" data-id="{{$items->id}}" data-no="{{$items->version_no}}" >
                                                <td width="50" class="move"><i class="fa fa-arrows"></i></td>
                                                <td>
                                                    <input type="radio" name="version-public" data-toggle="modal"
                                                           @if($items->version_published == 1) checked="checked" @endif
                                                           @if($items->version_published == 0) data-target="#modal-publish" @endif
                                                           data-action="{{ route('grade.publish_version', $items->id) }}" data-id="{!! $items->id !!}"/>
                                                </td>
                                                <td>{{$items->id}}</td>
                                                <td>{{$items->version_name}}</td>
                                                {{--@if($items->version_published == 0)--}}
                                                    <td width="50"><button class="btn btn-default btn-sm version-copy" version-id="{{$items->id}}"><i class="fa fa-copy"></i></button></td>
                                                    <td width="50"><a href="{{ route('chapters.list',[$grades['id'], $items->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a></td>
                                                    <td width="50">
                                                        <button data-action="{{ route('grade.delete_version', $items->id) }}" type="button"
                                                                class="btn btn-sm btn-danger"
                                                                data-toggle="modal" data-target="#modal-delete"
                                                                data-id="{!! $items->id !!}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                {{--@endif--}}

                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="100%" class="text-center">
                            <span class="pull-left">{{ $data->total() }} 件中 {{ $data->firstItem()}}
                                から {{ $data->lastItem() }}</span>
                                                {{ $data->appends($params)->links() }}
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer grade-edit-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{url('contents')}}" class="btn btn-default">戻る</a>
                        </div>
                    </div>
                </div>
                <div class="modal fade bs-example-modal-xs" id="modal-delete" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <form id="delete-form" action="" method="post">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="modal-body">
                                    <h4 class="text-center">データを削除します。</h4>
                                    <h4 class="text-center">本当によろしいですか？</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                                    <button type="submit" class="btn btn-primary btn-submit">OK</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade bs-example-modal-xs" id="modal-publish" tabindex="1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <form id="publish-form" action="" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$currentPublished}}" name="current_published" />
                                <div class="modal-body">
                                    <h4 class="text-center">公開するバージョンを変更すると、アプリはデータの再ダウンロードを要求します。</h4>
                                    <h4 class="text-center">当システムは、バージョンの切り替えを頻繁に行うことを推奨しません。</h4>
                                    <h4 class="text-center">公開するバージョンを変更しますか？</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">いいえ</button>
                                    <button type="submit" class="btn btn-primary btn-submit">はい</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        var copyVersionURL = '{{ url('/grade/version/copy') }}';
        var myPageBg = '{{isset($myPageBg['image_path']) ? $myPageBg['image_path'] : asset('img/default/no-image.jpg')}}';
    </script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{ asset('js/common/sortable.js') }}"></script>
    <script src="{{asset('plugins/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-fileinput/js/locales/ja.js')}}"></script>

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>
    <script src="{{ asset('js/content_management/grade/edit.js') }}"></script>
    <script src="{{ asset('js/content_management/grade/list.js') }}"></script>
    <script src="{{ asset('plugins/jQueryUI/jquery-ui.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#modal-delete').on('show.bs.modal', function (event) {
                // Button that triggered the modal
                var action = $(event.relatedTarget).data('action');
                $('#delete-form').attr('action', action);
            })
        });
        $("#image_path").fileinput({
            showUpload: false,
            uploadAsync: false,
            overwriteInitial: true,
            showRemove: false,
            showClose: false,
            maxFileCount:1,
            language: "ja",
            initialPreviewFileType: 'image',
            initialPreview: [
                "{{(($myPageBg) && (isset($myPageBg['image_path']) && $myPageBg['image_path']!='')) ? ($path_media.$myPageBg['image_path']) : (asset('img/default/no-image.jpg'))}}",
            ],
            initialPreviewAsData: true,
            initialPreviewConfig: [
                { caption: "Image", size: 847000},
            ],
            allowedFileExtensions: ["jpg", "png", "gif", "jpeg"]
        });

    </script>
    <script>
        @if (($_SERVER['QUERY_STRING'])!='')
            $(document).ready(function () {
            $('#select_tab_1').removeClass('active');
            $('#select_tab_2').addClass('active');
              $("#tabs").tabs({
                  active: 1
              });
                });
        @endif
    </script>
@endsection

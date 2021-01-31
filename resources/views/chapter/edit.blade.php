@extends('layouts.app')
@section('title', 'チャプター編集')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/content_management/chapter/edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/content_management/small_test/edit.css') }}">
    {{--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">--}}
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>--}}
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/themes/explorer/theme.css') }}">
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
            <div class="box">
                <form id="createForm" class="form-horizontal" method="post"
                      action="{{ route('chapters.update',[$gradeId, $versionId] ) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <!-- /.box-header -->
                    <div class="box-body">
                        <div class="tool-bar">

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="col-xs-10">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="common-v">
                                            </div>
                                            @if(count($languages))
                                                @foreach($languages as $items)
                                                    <div class="tab-pane" id="{{$items->lang_code}}-v">
                                                        <div class="form-group">
                                                            <label for="" class="col-sm-3 control-label text-right">{{$items->lang_code}}チャプター名</label>
                                                            <div class="col-md-4 col-sm-9">
                                                                <input type="hidden" name="{{$items->lang_code}}_chapter_name_id" id="{{$items->lang_code}}_chapter_name_id" value="{{isset($data[$items->lang_code.'_chapter_name_id']) ? $data[$items->lang_code.'_chapter_name_id']: ''}}"/>
                                                                <input type="text" class="form-control" id="" name="{{$items->lang_code}}_name"
                                                                       value="{{isset($data[$items->lang_code.'_name']) ? $data[$items->lang_code.'_name']: ''}}">
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="row search-box">
                                                            <label for="" class="col-md-4 col-sm-3 control-label text-right">コマ名</label>
                                                            <div class="col-md-2 col-sm-6">
                                                                <input type="text" class="form-control" id="">
                                                            </div>
                                                            <div class="col-md-2 col-sm-3">
                                                                <button id="search_coma" type="button" class="btn btn-default btn-block" data-id="{{$id}}">検索</button>
                                                            </div>
                                                        </div>
                                                        <div class="row box-content">
                                                            <div class="side-tools col-md-3">
                                                                <table class="table list-test" id="select_coma">
                                                                    @foreach($comas as $cm)
                                                                        <tr id="tr_select_coma" data-id="{{$cm->id}}">
                                                                            <td>||</td>
                                                                            <td>{{$cm->frame_name}}</td>
                                                                            <td><a href="#" class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal-preview"><i class="fa fa-eye"></i></a>

                                                                                <button id="select_delete_coma" type="button"
                                                                                        class="btn btn-xs btn-danger" data-toggle="modal"
                                                                                        data-target="#modal-delete"
                                                                                        data-id="{!! $cm->id !!}">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </button>
                                                                            </td>

                                                                        </tr>
                                                                    @endforeach
                                                                </table>
                                                                <a id="add_comas" data-chapter-id = "{{$id}}" class="btn btn-success" style="width: 100%"><i class="fa fa-plus"
                                                                                                                                                             aria-hidden="true"></i></a>
                                                            </div>
                                                            <div class="action-view col-md-9">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                {{ method_field('PUT') }}
                                                                <div class="form-group">
                                                                    <label for="id" class="col-md-3">ID</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="id_chapter_coma" name="id_chapter_coma" value=""
                                                                               readonly >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="title" class="col-md-3"><span
                                                                                class="text-red">※</span>&nbsp;コマ名</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id='name_chapter_coma' name ="name_chapter_coma">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="title" class="col-md-3">&nbsp;コマカテゴリ</label>
                                                                    <div class="col-md-9">
                                                                        <select name="coma_category_id" id="coma_category_id" class="form-control">
                                                                            @foreach($optionComaCategory as $occ)
                                                                                <option value="{{$occ->id}}">{{$occ->frame_category_name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="col-md-3">&nbsp;画像また動画</label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="hidden" name="ja_coma_language_id" id="ja_coma_language_id" />
                                                                    <label for="title" class="col-md-3 ja_label" data-preview-image="">（日本語）<input type="checkbox"
                                                                                                                                                   class="pull-right"></label>
                                                                    <div class="col-sm-9">
                                                                        <div class="kv-avatar" style="width:400px">
                                                                            {{--<input id="avatar-1" name="ja_image_path" type="file" class="file-loading" >--}}
                                                                        </div>
                                                                    </div>
                                                                    <label for="title" class="col-md-3 ja_label" data-preview-image=""></label>
                                                                    <div class="col-sm-9">
                                                                        <div class="kv-avatar" style="width:400px">
                                                                            {{--<input id="avatar-21" name="ja_video_path" type="file" class="file-loading" >--}}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">

                                                                    <label for="title" class="col-md-3">説明</label>
                                                                    <div class="col-md-12 form-group">
                                                                        <label for="" class="col-sm-3 control-label text-right">（日本語）</label>
                                                                        <div class="col-md-4 col-sm-9">
                                                                            <input type="text" class="form-control" id="ja_description" name="ja_description"
                                                                                   value="{{isset($data['ja_description'])?$data['ja_description']: ''}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endforeach
                                            @endif

                                        </div>
                                    </div>
                                    @include('partials.language')
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('chapters.index') }}" class="btn btn-default">戻る</a>
                                <button type="submit" class="btn btn-info pull-right btn-submit">登録</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
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
                        <a id="modal_submit_delete" type="submit" class="btn btn-primary" page-id="{{$id}}">OK</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- preview modal -->
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
    <!-- end preview modal -->
@endsection
@section('javascript')
    <script src="{{asset('plugins/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-fileinput/js/locales/ja.js')}}"></script>
    <script src="{{asset('plugins/AdminLTE/app.min.js')}}"></script>
    <script src="{{ asset('js/content_management/chapter/edit.js') }}"></script>
    <script src="{{ asset('js/content_management/chapter/select_coma.js?t='.time()) }}"></script>
    <script src="{{ asset('js/content_management/chapter/search_coma.js') }}"></script>
    <script src="{{ asset('js/content_management/chapter/delete_coma.js') }}"></script>
    <script src="{{ asset('js/content_management/chapter/add_coma.js') }}"></script>
    <script src="{{ asset('js/content_management/chapter/validate.js') }}"></script>
    <script src="{{ asset('js/collection/edit.js') }}"></script>
    <script src="{{ asset('js/content_management/chapter/default_image.js') }}"></script>
@endsection

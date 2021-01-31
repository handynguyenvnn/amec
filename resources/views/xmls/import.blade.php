@extends('layouts.app')

@section('title', 'インポート管理')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/list.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/themes/explorer/theme.css') }}">
@endsection
@section('content-header')
        <h1>インポート管理</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">データ管理</a></li>
            <li class="active">インポート管理</li>
        </ol>
@endsection

@section('content')
<style>.file-preview{display: none}</style>
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-info">
                <!-- /.box-header -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('messages'))
                    <div class="alert alert-danger">
                        {{session('messages')}}
                    </div>
            @endif
                <!-- form start -->
                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{route('xmls.import')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <br />
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">XMLフィルタ</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="xmlfile" id="xmlfile" accept="text/xml">
                                <p style="color:red"> ※次のグレードNOは {{ ++$grade_last_id }} です。 </p>
                            </div>
                            <div class="col-md-3">
                                <input type="submit" class="btn btn-success btn-item" name="submit" value="インポート">
                            </div>
                        </div>
                    </div>
                    <hr />
                </form>
                <form class="form-horizontal" method="get" action="{{route('xmls.input')}}">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">フィルタ名</label>
                        <div class="col-sm-2">
                            <input type="text" size="20" class="form-control" name="xml_name">
                        </div>
                        <label for="" class="col-sm-1 control-label">言語</label>
                        <div class="col-sm-2">
                            <select name="language" id="language_id" class="form-control">
                                @if(count($languages)>0)
                                    @foreach($languages as $language)
                                        <option value="{!! $language->id !!}">{!! $language->lang !!}</option>
                                    @endforeach
                                @else
                                @endif
                            </select>
                        </div>
                        {{--<label for="" class="col-sm-2 control-label">内容タイプ</label>--}}
                        {{--<div class="col-sm-2">--}}
                            {{--<select name="content_type" id="content_type" class="form-control">--}}
                                {{--@foreach($contentType as $key => $label)--}}
                                    {{--<option value="{!! $key !!}">{!! $label !!}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-success btn-item ">検索</button>
                        </div>
                    </div>
                </form>
                    <table id="data-table" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>フィルタ名</th>
                            <th>言語</th>
                            <th>作成日</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($listXML as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->lang}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <a href="{{route('xmls.download', $item->name)}}" class="btn btn-xs btn-warning "><i class="fa fa-download"></i></a>
                                        <a href="{{ route('xmls.delete', $item->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="100%" class="text-center">
                                    <span class="pull-left">
                                        {{ $listXML->total() }} 件中 {{ $listXML->firstItem()}}
                                        から {{ $listXML->lastItem() }}
                                    </span>
                                {{ $listXML->appends($params)->links() }}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/locales/ja.js') }}"></script>
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/user/edit.js') }}"></script>
    <script>
        $("#xmlfile").fileinput({
            showUpload: false,
            uploadAsync: false,
            overwriteInitial: false,
            maxFileCount:1,
            language: "ja",
            showRemove: false,
            initialPreviewFileType: 'text',
            {{--initialPreview: [--}}
                {{--"{{asset('img/default/no-xml.png') }}",--}}
            {{--],--}}
            initialPreviewAsData: false,
            initialPreviewConfig: [
                { caption: "File", size: 847000},
            ],
            allowedFileExtensions: ["xml"]
        });
    </script>
@endsection
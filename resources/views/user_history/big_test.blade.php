@extends('layouts.app')
@section('title', 'ユーザー履歴（' . $fullname . '）')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/report-access/report-access.css') }}">
@endsection
@section('content-header')
    <h1> ユーザー履歴（{{$fullname}}）
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> ホーム</a></li>
        <li class="active">ユーザー履歴（{{$fullname}}）</li>
    </ol>
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <div>
                <!-- Nav tabs -->
                @include('user_history.tabs')

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" >
                        <div class="">
                            <div class="box-header">
                                <form id="form-search" class="form-horizontal" method="get"
                                      style="margin-top: 20px;">
                                    <div class="row">
                                        <input type="hidden" name="sort_by" id="sort_by"
                                               value="{{ isset($params['sort_by']) ? $params['sort_by'] : 'id' }}"/>
                                        <input type="hidden" name="order_by" id="order_by"
                                               value="{{ isset($params['order_by']) ? $params['order_by'] : 'asc' }}"/>
                                        <input type="hidden" name="per_page" id="per_page"
                                               value="{{ isset($params['per_page']) ? $params['per_page'] : 10 }}"/>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="chapterName" class="col-sm-4 control-label">チャプター名</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="chapterName" name="name"
                                                           value="{{isset($params['name']) ? $params['name'] : ''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <button class="btn btn-info btn-submit">検索</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="table-user" class="table table-bordered table-hover dataTable">
                                    <thead>
                                    <tr>
                                        <th>グレード名</th>
                                        <th>受講日</th>
                                        <th>点数</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $items)
                                        <tr>
                                            <td>{{$items->grade_name}}</td>
                                            <td>{{date('Y/m/d', strtotime($items->updated_at))}}</td>
                                            <td>{{$items->point}}</td>
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

                            <div class="box-footer" style="border: none">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <a href="{!! route("users.index") !!}" class="btn btn-info">戻る</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-footer -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
    <script src="{{ asset('js/common/showPage.js') }}"></script>
    <script src="{{ asset('js/report-access/list.js') }}"></script>
    <script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>
    <script src="{{ asset('plugins/AdminLTE/demo.js') }}"></script>
    <script src="{{ asset('plugins/bootbox/bootbox.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
@endsection
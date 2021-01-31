@extends('layouts.app')
@section('title', 'アクセス解析')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/report-access/report-access.css') }}">
@endsection
@section('content-header')
    <h1> アクセス解析
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> ホーム</a></li>
        <li class="active">アクセス解析</li>
    </ol>
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="{{ route('access-analysis.index') }}"
                                                              aria-controls="juukousha"
                                                              role="tab">チャプター別<br/>受講者数</a></li>
                    <li role="presentation"><a href="{{ route('access-analysis.big-tests') }}" aria-controls="juukensha"
                                               role="tab">大テスト別<br/>
                            受講者数</a></li>
                    <li role="presentation"><a href="{{ route('access-analysis.certifications') }}"
                                               aria-controls="nintei" role="tab">認定証
                            <br/>発行者数
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="juukousha">
                        <div class="box">
                            <div class="box-header">
                                <form id="form-search" class="form-horizontal"
                                      action="{{ route('access-analysis.index') }}" method="get"
                                      style="margin-top: 20px;">
                                    <div class="row">
                                        <input type="hidden" name="sort_by" id="sort_by"
                                               value="{{ isset($params['sort_by']) ? $params['sort_by'] : 'id' }}"/>
                                        <input type="hidden" name="order_by" id="order_by"
                                               value="{{ isset($params['order_by']) ? $params['order_by'] : 'asc' }}"/>
                                        <input type="hidden" name="per_page" id="per_page"
                                               value="{{ isset($params['per_page']) ? $params['per_page'] : 10 }}"/>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="attendNumber"
                                                       class="col-sm-8 control-label">チャプター累計受講者数</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="attendNumber"
                                                           placeholder="{{$total}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 text-center">
                                            <a href="{{route('access-analysis.download')}}" class="btn btn-default ">CSVダウンロード</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="chapterName" class="col-sm-4 control-label">チャプター名</label>
                                                <div class="col-sm-8 ">
                                                    <input type="text" class="form-control" id="chapterName" name="name"
                                                           value="{{ isset($params['name']) ? $params['name'] : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="chapterName" class="col-sm-4 control-label">言語</label>
                                                <div class="col-sm-8 ">
                                                    <input type="text" class="form-control" id="chapterName" name="lang"
                                                           value="{{ isset($params['lang']) ? $params['lang'] : '' }}">
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
                                        <th data-field="id">ID</th>
                                        <th>チャプター名</th>
                                        {{--<th>タグ</th>--}}
                                        <th>言語</th>
                                        <th>受講人数</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($data)>0)
                                        @foreach($data as $items)
                                            <td>{{$items->id}}</td>
                                            <td>{{$items->name}}</td>
                                            {{--<td>{{$items->tag}}</td>--}}
                                            <td>{{$items->lang}}</td>
                                            <td>{{$items->total}}({{$items->pass_result}}/{{$items->fail_result}})</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="100%" class="text-center">
                                            <span class="pull-left">
                                                {{ $data->total() }} 件中 {{ $data->firstItem()}}
                                                から {{ $data->lastItem() }}
                                            </span>
                                            {{ $data->appends($params)->links() }}
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div id="detailForm" style="display: none;">
                                <div class="period">
                                    <div class="row">
                                        <div class="col-sm-4 col-sm-offset-8">
                                            <div class="form-group">
                                                <label for="period" class="col-sm-5 control-label">期間</label>

                                                <div class="col-sm-7">
                                                    <select class="form-control" name="period" id="period">
                                                        <option value="0">年</option>
                                                        <option value="1">月</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="main-content">
                                    <div class="title">
                                        受講者数（授業1）
                                    </div>
                                    <div class="box box-info">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Line Chart</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool"
                                                        data-widget="collapse"><i class="fa fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-box-tool"
                                                        data-widget="remove"><i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="box-body chart-responsive">
                                            <div class="chart" id="line-chart" style="height: 300px;"></div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="juukensha">...</div>
                    <div role="tabpanel" class="tab-pane" id="shiken">...</div>
                    <div role="tabpanel" class="tab-pane" id="nintei">...</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
    <script src="{{ asset('js/common/showPage.js') }}"></script>
    <script src="{{ asset('js/report-access/list.js') }}"></script>
@endsection
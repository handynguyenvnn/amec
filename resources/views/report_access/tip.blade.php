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
                    <li role="presentation"><a href="{{ route('access-analysis.index') }}" aria-controls="juukousha"
                                               role="tab">チャプター別<br/>受講者数</a></li>
                    <li role="presentation" ><a href="{{ route('access-analysis.big-tests') }}" aria-controls="juukensha" role="tab">小テスト<br/>
                            受験者数</a></li>
                    <li role="presentation" class="active"><a href="{{ route('access-analysis.tips') }}" aria-controls="shiken" role="tab">認定試験
                            <br/>受験者数</a>
                    </li>
                    <li role="presentation"><a href="{{ route('access-analysis.certifications') }}" aria-controls="nintei" role="tab">認定証<br/>発行者数</a>
                    </li>
                </ul>
                <div class="box-body">
                    <div id="detailForm">
                        <div class="period">
                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-8">
                                    <div class="form-group">
                                        <label for="period" class="col-sm-5 control-label">期間</label>

                                        <div class="col-sm-7">
                                            <select class="form-control" name="period" id="period">
                                                <option value>----</option>
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
                                認定試験受験者数
                            </div>
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Line Chart</h3>
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
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
    <script src="{{ asset('js/common/showPage.js') }}"></script>
    <script src="{{ asset('js/report-access/list.js') }}"></script>
    <script src="../plugins/AdminLTE/app.min.js"></script>
    <script src="../plugins/AdminLTE/demo.js"></script>
    <script src="../plugins/bootbox/bootbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../plugins/morris/morris.min.js"></script>
@endsection
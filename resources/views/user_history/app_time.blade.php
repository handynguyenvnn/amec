@extends('layouts.app')
@section('title', 'ユーザー履歴（' . $fullname . '）')

@section('stylesheet')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
        <div class="box-header with-border">
            <div>
                <!-- Nav tabs -->
            @include('user_history.tabs')

            <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="juukousha">
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
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="chapterName" class="col-sm-4 control-label">開始時間</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group date" data-provide="datepicker">
                                                        <input type="text" class="form-control datepicker" id="start" name="start" data-provide="datepicker"
                                                               value="{{isset($params['start']) ? $params['start'] : ''}}" readonly>
                                                        <div class="input-group-addon" onclick="$('#start').datepicker('show');" style="cursor: pointer">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="chapterName" class="col-sm-4 control-label">～終了時間</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group date" data-provide="datepicker">
                                                        <input type="text" class="form-control datepicker" id="end" name="end" data-provide="datepicker"
                                                               value="{{isset($params['end']) ? $params['end'] : ''}}" readonly>
                                                        <div class="input-group-addon" onclick="$('#end').datepicker('show');" style="cursor: pointer">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div>
                                                    </div>
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
                                        <th>ID</th>
                                        <th>開始時間</th>
                                        <th>終了時間</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $items)
                                        <tr>
                                            <td>{{$items->id}}</td>
                                            <td>{{date('Y/m/d H:i:s', strtotime($items->start_time))}}</td>
                                            <td>{{date('Y/m/d H:i:s', strtotime($items->end_time))}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="100%" class="text-center">
                                            <span class="pull-left">{{ $data->total() }} 件中 {{ $data->firstItem()}}から {{ $data->lastItem() }}</span>
                                            {{ $data->appends($params)->links() }}
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
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
@endsection
@section('javascript')
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}" charset="UTF-8"></script>
    <script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.ja.js') }}" charset="UTF-8"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script>
        $( function() {
            $.extend( $.fn.datepicker.defaults, {
                format: 'yyyy/mm/dd',
                dateFormat: 'yyyy/mm/dd',
                constrainInput: true,
                language: 'ja',
                todayBtn:true,
                maxDateNow: true
            });
            $('.datepicker').datepicker().on('change', function(e) {
                var startDate = $('#start').val().replace('-','/');
                var endDate = $('#end').val().replace('-','/');

                selectedVal = $(this).val();
                var isTo = $(this).attr('name') === 'end';

                var d = new Date();
                var today = d.getFullYear() + '/' + (d.getMonth() + 1) + '/' + d.getDate();
                if (isTo &&  selectedVal > today) {
                    $('#end').val(today);
                }
                if (isTo &&  selectedVal < startDate && startDate != '') {
                    $('#end').val(startDate);
                }
                if (!isTo &&  selectedVal > endDate && endDate != '') {
                    $('#start').val(endDate);
                }
            });
        });
    </script>
    <script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
    <script src="{{ asset('js/common/showPage.js') }}"></script>
    <script src="{{ asset('js/report-access/list.js') }}"></script>
    <script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>
    <script src="{{ asset('plugins/AdminLTE/demo.js') }}"></script>
    <script src="{{ asset('plugins/bootbox/bootbox.min.js') }}"></script>
@endsection
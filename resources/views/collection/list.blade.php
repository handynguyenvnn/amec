@extends('layouts.app')
@section('title', 'コレクション管理')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/content_management/collection/list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/phone-preview.css') }}">
@endsection
@section('content-header')
    <h1> コレクション管理 </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> ホーム</a></li>
        <li class="active">コレクション編集</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <a href="{{ route("makers.index") }}" class="btn btn-block btn-info btn-item">メーカー一覧</a>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-block btn-info btn-item" data-toggle="modal"
                                        data-target="#modal-cart-rate">出現率設定
                                </button>
                            </div>
                            <div class="col-sm-4">
                                <a href="{{ route("collections.action") }}" type="button" class="btn btn-block btn-info btn-item">新規登録</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="dataTables_length" id="data-table_length">
                                <label>
                                    <select name="data-table_length" aria-controls="data-table"
                                            class="form-control input-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    件表示
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <form id="form-search" class="form-horizontal" action="{{ route('collections.index') }}" method="get" style="margin-top: 20px;">
                                <input type="hidden" name="sort_by" id="sort_by"
                                       value="{{ isset($params['sort_by']) ? $params['sort_by'] : 'collection_no' }}"/>
                                <input type="hidden" name="order_by" id="order_by"
                                       value="{{ isset($params['order_by']) ? $params['order_by'] : 'desc' }}"/>
                                <input type="hidden" name="per_page" id="per_page"
                                       value="{{ isset($params['per_page']) ? $params['per_page'] : 10 }}"/>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="name-collection"
                                               class="col-sm-2  control-label text-bold">コレクション名</label>

                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="name-collection" name="name"
                                                   value="{{ isset($params['name']) ? $params['name'] : '' }}">
                                        </div>
                                        <label for="level" class="col-sm-2 control-label text-bold">レアリティ</label>
                                        <div class="col-sm-2">
                                            <select class="form-control" name="level_id">
                                                <option value> 全て</option>
                                                @if(count($levels))
                                                    @foreach( $levels as $level)
                                                        <option value="{{$level->id}}"
                                                        @if (isset($params['level_id']) && ($params['level_id'] == $level->id))
                                                            {{'selected'}}
                                                                @endif >
                                                            {{$level->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-success btn-search btn-item">検索
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <table id="example1" class="table table-bordered table-striped dataTable">
                    <thead>
                    <tr>
                        <th data-field="id">No</th>
                        <th>コレクション名</th>
                        {{--<th>言語</th>--}}
                        <th>レアリティ</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($data))
                        @foreach($data as $items)
                            <tr>
                                <td>{{$items->collection_no}}</td>
                                <td>{{$items->name}}</td>
                                {{--<td>{{$items->language->lang}}</td>--}}
                                <td>{{$items->level_name}}</td>
                                <td>
                                    <button class="btn btn-xs btn-info" data-toggle="modal"
                                            data-target="#modal-preview"  data-id="{{$items->collection_no}}" data-link="{{$path_media}}"><i class="fa fa-eye"></i></button>
                                    <a href="{{route("collections.action", $items->collection_no)}}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                    <button class="btn btn-xs btn-danger" data-action="{{route("collections.destroy",$items->collection_no)}}" data-toggle="modal"
                                            data-target="#modal-delete"><i class="fa fa-trash"></i></button>
                                    <div id="modal-preview" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-lg">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div>
                                                            <div class="col-xs-3">
                                                                <!-- required for floating -->
                                                                <!-- Nav tabs -->
                                                                <ul class="nav nav-tabs tabs-left">
                                                                    @if(count($languages))
                                                                        @foreach($languages as $items)
                                                                            <li @if($items->lang_code == 'ja') class="active" @endif><a href="#{{ $items['lang_code']}}-v" data-toggle="tab">{{ $items['lang']}}</a></li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                            <div class="col-xs-9">
                                                                <!-- Tab panes -->
                                                                @if(count($languages))
                                                                    @foreach($languages as $items)
                                                                        <div class="tab-pane active" id="{{ $items->lang_code}}-v">
                                                                            <div class="phone view_2" id="phone_1" style="background-image: url({{asset('img/content_management/card_yellow.png')}}); background-size: 237px 336px;background-repeat: no-repeat;">
                                                                                <div id ="{{ $items->lang_code}}-content-preview" class="content-preview">
                                                                                    <img src="" style="max-width:200px;max-height:200px">
                                                                                </div>
                                                                                <div class="content-description">
                                                                                    <p id="{{ $items->lang_code}}-collection-name" class="collection-name"></p>
                                                                                    <p id="{{ $items->lang_code}}-collection-maker-name" class="manufacture "></p>
                                                                                </div>
                                                                                <div class="clr"></div>
                                                                                <p id="{{ $items->lang_code}}-collection-description" class="collection-description"></p>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif

                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
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
        </div>
    </div>
    <!--model cart-rate-->
    <!-- preview modal -->

    <!-- end preview modal -->
    <!--modal-cart-rate-->
    <div class="modal fade" id="modal-cart-rate" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header block">
                    <button type="button" class="close btn-one" data-dismiss="modal">&times;</button>
                    <h4 class="text-center">ログインガチャ</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal"  method="GET" action="{{route('collections.card-appearance-rate')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="rate-normal">出現率　ノーマル</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" id="rate-normal" name="rate-normal" value="{{$rates['normalRate']}}">
                            </div>
                            <label class="control-label col-sm-1" for="rate-normal">%</label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="rare">　レア</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" id="rare" name="rare" value="{{$rates['rareRate']}}">
                            </div>
                            <label class="control-label col-sm-1" for="rare">%</label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="intense-rare">　激レア</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" id="intense-rare" name="intense-rare" value="{{$rates['intenseRate']}}">
                            </div>
                            <label class="control-label col-sm-1" for="intense-rare">%</label>
                        </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="super-rare">　超レア</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" id="super-rare" name="super-rare" value="{{$rates['superRate']}}">
                                </div>
                                <label class="control-label col-sm-1" for="super-rare">%</label>
                            </div>

                        <div class="form-group">
                            <div class="col-sm-7 col-sm-offset-3">
                                <button type="submit" class="btn btn-success btn-save">更新</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- delete modal -->

    <div class="modal fade bs-example-modal-xs" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form id="delete-form" action="" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="delete"/>
                    <div class="modal-body">
                        <h4 class="text-center">データを削除します。</h4>
                        <h4 class="text-center">本当によろしいですか。</h4>
                    </div>
                    <div class="modal-footer button-delete">
                        <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-primary">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end delete modal -->
    <!-- InstanceEndEditable -->
    <!-- /.box -->

@endsection
@section('javascript')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('plugins/jQuery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/dataTable.config.js') }}"></script>
    <script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
    <script src="{{ asset('js/common/showPage.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".tabs-left li a").bind( "click", function() {
                $('.tab-pane').hide();
                tabId = $(this).attr('href');
                $('#' + tabId.replace('#', '')).show();
            });
            $('#ja-v').show();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#modal-preview').on('show.bs.modal', function (event) {
                // Button that triggered the modal
                var id = $(event.relatedTarget).data('id');
                var url = '/collection-info/' + id;
                var path_media = $(event.relatedTarget).data('link');
                $.get(url, function (response) {
                    console.log(response);
                    @if(count($languages))
                        @foreach($languages as $indx=>$items)
                            $('#{{$items->lang_code}}-content-preview img').attr("src", path_media+response.image_path);
                            $('#{{$items->lang_code}}-collection-name').html( response.{{$items->lang_code}}_name );
                            $('#{{$items->lang_code}}-collection-maker-name').html( response.maker_name );
                            $('#{{$items->lang_code}}-collection-description').html( response.{{$items->lang_code}}_description );
                       @endforeach
                    @endif
                });
            });
        });
    </script>
@endsection
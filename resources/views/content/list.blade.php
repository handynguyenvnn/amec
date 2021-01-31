@extends('layouts.app')
@section('title', 'コンテンツ管理')
@section('stylesheet')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/content_management/content/list.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css')}}">
@endsection
@section('content-header')
    <h1> コンテンツ管理
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">コンテンツ管理 </li>
    </ol>
@endsection
@section('content')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">グレード </h3>
                </div>
                <div class="box-body">
                    <input type="hidden" id="idTable" value="tbl-grade">
                    <table class="table table-bordered table-hover" id="tbl-grade" base-url="{{ asset('sortable/grades/grade_no') }}">
                        <thead>
                        <tr>
                            <th colspan="4">
                                <label class="sort-tip">並び替えを有効にする</label>
                                <input id="toggle-active" type="checkbox" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $items)
                            @if ($items->grade_names[0]->name != '')
                                <tr id="tr-{{$items->grade_no}}" data-id="{{$items->id}}" data-no="{{$items->grade_no}}">
                                    <td width="50" class="move"><i class="fa fa-arrows"></i></td>
                                    <td><input type="text" id="grade-in-{{$items->grade_no}}" class="form-control" value="{{$items->grade_names[0]->name}}"
                                               onchange="saveGrade(this.value, '{{$items->id}}', '{{$items->grade_no}}');"></td>
                                    <td width="50">
                                        <a href = "{{route('grades.edit', $items->id)}}"
                                                id="edit-button" class="btn btn-warning btn-sm dv-grade-ed-edit"><i class="fa fa-pencil"></i></a>
                                    </td>
                                    <td width="50">
                                        <button data-action="{{ route('grades.destroy', $items->id) }}" type="button"
                                                class="btn btn-sm btn-danger"
                                                id="delete-button"
                                                data-toggle="modal" data-target="#modal-delete"
                                                data-id="{!! $items->id !!}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                            <tr data-no="0" id="dv-grade" style="display: none">
                                <td width="50" class="move"><i class="fa fa-arrows"></i></td>
                                <td><input id="grade-in-GRAD_NO" type="text" class="form-control" value="" onkeyup="btnActive('GRAD_NO', this.value);" onchange="saveGrade(this.value, '0', 'GRAD_NO');"></td>
                                <td width="50">
                                    <button type="button"  id="dv-grade-ed-GRAD_NO" href = "{{route('grades.edit', 'GRAD_ID')}}" onclick="window.location.href = $(this).attr('href');"
                                            id="edit-button" class="dv-grade-ed-edit btn btn-warning btn-sm" disabled="disabled"><i class="fa fa-pencil"></i></button>
                                </td>
                                <td width="50">
                                    <button  id="dv-grade-rv-GRAD_NO" data-action="{{ route('grades.destroy', 'GRAD_ID') }}" type="button"
                                            class="btn btn-sm btn-danger"
                                            id="delete-button"
                                            data-toggle="modal" data-target="#modal-delete"
                                            data-id="GRAD_ID" disabled="disabled">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="100%">
                                <input type="hidden" id="grade-save" value="{{ route('grades.save') }}">
                                <a href="javascript:void(0);" id="grade_create"  data-maxno="" class="btn btn-block btn-sm btn-default"><i class="fa fa-plus"></i></a>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="modal fade" id="change-active" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close btn-close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body text-center">
                            <p>公開後のグレード並び替えは履修データが破損する恐れがあります。</p>
                            <p>当システムはこの操作を推奨いたしません。</p>
                            <p>グレードの並び替えを有効にしますか？</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-close" data-dismiss="modal">いいえ</button>
                            <button type="button" class="btn btn-primary btn-save" data-dismiss="modal">はい</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade bs-example-modal-xs" id="modal-delete" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <form id="delete-form" action="" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input type="hidden" name="_method" value="delete"/>
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
@endsection
@section('javascript')
    <script src="{{ asset('js/common/dataTableTiny.js') }}"></script>
    <script src="{{ asset('plugins/iCheck/icheck.min.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{ asset('js/common/sortable.js') }}"></script>
    <script src="{{ asset('js/content_management/content/delete.js') }}"></script>
    <script>
        $(function () {
            if(localStorage.getItem('SettingToggle') == 1 ){
                $(".toggle").removeClass('btn-danger off');
                $(".toggle").addClass('btn-susscess');
                $('.ui-sortable').each(function() { $(this).sortable('enable'); });
            }else{
                $(".toggle").removeClass('btn-susscess');
                $(".toggle").addClass('btn-danger off');
                $('.ui-sortable').each(function() { $(this).sortable('disable'); });
            }
        })
        function btnActive(id, val) {
            if (val == "") {
                $("#dv-grade-ed-" + id).attr("disabled", "disabled");
                $("#dv-grade-rv-" + id).attr("disabled", "disabled");
            } else {
                console.log("#dv-grade-ed-" + id);
                $("#dv-grade-ed-" + id).removeAttr("disabled");
                $("#dv-grade-rv-" + id).removeAttr("disabled");
            }
        }
    </script>
    <script src="{{ asset('js/content_management/content/list.js')}}?t=<?php echo time()?>"></script>
@endsection

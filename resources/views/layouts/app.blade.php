<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- page title -->
    <title>@yield('title')</title>

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('plugins/ionicons-2.0.1/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('plugins/AdminLTE/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('plugins/AdminLTE/skins/_all-skins.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquerysctipttop/jquerysctipttop.css') }}">
    <!-- common css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loading.css') }}">

    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/locales/ja.js') }}"></script>
    <script src="{{ asset('js/common/sortable.js') }}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('stylesheet')
</head>

<body class="hold-transition skin-blue sidebar-mini">
{{--<div id="load">--}}
{{--</div>--}}
<!-- Site wrapper -->

{{--<div class="wrapper" id ="wrapper">--}}
    <div class="wrapper">












    <!-- page header -->
@include('partials.header')

<!-- Left side column. contains the sidebar -->
@include('partials.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('content-header')
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
    </div>

    <!-- page footer -->
@include('partials.footer')

<!-- js for page -->


    <!-- jQuery UI -->
    <script src="{{ asset('plugins/jQueryUI/jquery-ui.js') }}"></script>

    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('plugins/bootstrap/bootstrap.min.js') }}"></script>

    <!-- jquery validation plugin -->
    <script src="{{ asset('plugins/jQuery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jQuery/jquery.validate.ja.js') }}"></script>
    <script src="{{ asset('plugins/jQuery/additional-methods.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('plugins/AdminLTE/app.min.js') }}"></script>

    <!-- SlimScroll -->
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>

    <!-- FastClick -->
    <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>

    <!-- bootbox -->
    <script src="{{ asset('plugins/bootbox/bootbox.min.js') }}"></script>

    <script src="{{ asset('plugins/topup/topup.js') }}"></script>

    <script src="{{ asset('js/common.js') }}"></script>
    {{--<script language="javascript" type="text/javascript">
        document.onreadystatechange = function () {
            var state = document.readyState
            if (state == 'interactive') {
//                document.getElementById('wrapper').style.visibility="hidden";
            } else if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                    document.getElementById('load').style.visibility="hidden";
                    document.getElementById('wrapper').style.visibility="visible";
                },1000);
            }
        }
    </script>--}}

    @yield('javascript')
</div>
</body>
</html>

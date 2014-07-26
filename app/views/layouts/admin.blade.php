<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tasoha | Administration</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/select2/select2.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/js/plugins/jstree/themes/default/style.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/lte.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/lte-override.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/addon.css')}}">
        @yield('addon_css')
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue fixed">

        @include('layouts/admin/_header')
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                @include('layouts/admin/_sidebar')
            </aside>
            <aside class="right-side">
                <section class="content-header">
                    @yield('header_content')
                </section>
                <section class="content">
                    @include('shared/_flash')
                    @yield('content')
                </section>
            </aside>
        </div>
        <script type="text/javascript">
            var dataToken = '<?php echo Session::token(); ?>';
            var baseUrl = '<?php echo route('admin.root'); ?>';
        </script>
        <script type="text/javascript" src="{{asset('assets/js/jquery-1.10.2.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery-ui-1.10.3.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/plugins/select2/select2.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/plugins/jstree/jstree.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/daterangepicker.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/bootstrap3-wysihtml5.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/plugins/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{asset('assets/js/helper.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/common.js')}}"></script>
        <script src="{{asset('assets/js/lte/app.js')}}" type="text/javascript"></script>
        @yield('addon_js')
        <script src="{{asset('assets/js/admin.js')}}" type="text/javascript"></script>
        @yield('inline_js')
    </body>
</html>
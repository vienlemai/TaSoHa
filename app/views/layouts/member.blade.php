<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Trang chủ - TASOHA Group</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/bootstrap-lumen.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/font-awesome.min.css')}}">
        <link href="{{asset('assets/js/plugins/jstree/themes/default/style.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/js/plugins/jorgchar/css/prettify.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/main.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/addon.css')}}">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
          <script src="../bower_components/respond/dest/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container" id="wrapper">
            <div class="row">
                <?php echo View::make('layouts.frontend._header')->render() ?>     
            </div>
            <div class="row clearfix">
                <?php echo View::make('layouts.frontend._menu')->render() ?>   
            </div>

            <div id="content-wrapper">
                @yield('content')
            </div>
            <?php echo View::make('layouts.frontend._footer')->render() ?>  
        </div>
         <input class="" type="hidden" name="" id="current-member-id" value="{{Auth::member()->get()->id}}"/>
        <script type="text/javascript">
            var dataToken = '<?php echo Session::token(); ?>';
            var baseUrl = '<?php echo route('member.root'); ?>';
        </script>
        <script src="{{asset('assets/js/jquery-1.10.2.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/jquery.li-scroller.1.0.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/jorgchar/prettify.js')}}"></script>
        <script src="{{asset('assets/js/plugins/jstree/jstree.min.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/main.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/helper.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/member.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/common.js')}}"></script>
    </body>
</html>

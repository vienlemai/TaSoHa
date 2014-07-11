<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Trang chủ - TASOHA Group</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/bootstrap-lumen.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/font-awesome.min.css')}}">
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
               <?php echo View::make('layouts.frontend._header')?>     
            </div>
            <div class="row clearfix">
                <?php echo View::make('layouts.frontend._menu')?>   
            </div>

            <div id="content-wrapper">
                @yield('content')
            </div>
            <?php echo View::make('layouts.frontend._footer')?>  
        </div>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/main.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/helper.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/common.js')}}"></script>        
        @yield('inline_scripts')
    </body>
</html>

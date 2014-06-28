<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tasoha | Administration</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/lte.css')}}" rel="stylesheet" type="text/css" />
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
        @yield('content')

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="{{asset('assets/js/jquery-ui-1.10.3.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/daterangepicker.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/bootstrap3-wysihtml5.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/lte/app.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/lte/dashboard.js')}}" type="text/javascript"></script>     
        <script src="{{asset('assets/js/lte/demo.js')}}" type="text/javascript"></script>
    </body>
</html>
<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Tasoha Group</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/override-template.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/bootstrap-2.3.2.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/ribbons.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/sequence.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/default.css')}}">
        <!-- Styles Switcher -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/switcher.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/js/plugins/jorgchar/css/jquery.jOrgChart.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/js/plugins/jorgchar/css/custom.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/js/plugins/jorgchar/css/prettify.css')}}">

        <!-- Java Script  -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/modernizr.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/selectnav.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/flexslider.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/fancybox.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/isotope.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/jquery.fitvids.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/custom.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/switcher.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/jorgchar/prettify.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/jorgchar/jquery.jOrgChart.js')}}"></script>
    </head>
    <body>
        <!-- Wrapper Start -->
        <div id="wrapper" class="container">
            <div class="ie-dropdown-fix" >
                <?php echo View::make('layouts/frontend/_header')->render() ?>
                <!-- Header / End -->
                <?php echo View::make('layouts/frontend/_menu')->render() ?>
                <div class="clear"></div>
            </div>
            <!-- Navigation / End -->
            <!-- Content -->
            <?php echo View::make('layouts/frontend/_flash')->render() ?>
            @yield('content')
            <div class="push"></div>
            <div id="scroll-to-top" ><a href="#" title="Go to Top"></a></div>
        </div>
        <?php echo View::make('layouts/frontend/_footer')->render() ?>

        <script type="text/javascript" src="{{asset('assets/js/member.js')}}"></script>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Trang chủ - TASOHA Group</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/bootstrap-lumen.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/bootstrap-override.css')}}">
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
                <?php echo View::make('layouts.frontend._header') ?>     
            </div>
            <div class="row clearfix">
                <?php echo View::make('layouts.frontend._menu') ?>   
            </div>

            <div id="content-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('breadcrumb')
                    </div>
                </div>
                @yield('content')
            </div>
            <?php echo View::make('layouts.frontend._footer') ?>  
        </div>
        <?php if (Auth::member()->check()): ?>
            <div id="modal-change-password" class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3>Đổi mật khẩu</h3>
                        </div>
                        <div class="modal-body" id='form-add-node-wrap'>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Đóng</button>            
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <script type="text/javascript" src="{{asset('assets/js/jquery-1.10.2.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/main.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/helper.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/common.js')}}"></script>        
        @yield('inline_scripts')
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tasoha | Administration</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/lte.css')}}" rel="stylesheet" type="text/css" />
    </head>
    <body class="bg-black">
        <div class="form-box" id="login-box">
            <div class="header"><?php echo trans('messages.sign_in'); ?></div>
            
            <form action="<?php echo route('admin.login') ?>" method="post">
                <div class="body bg-gray">
                    @include('shared/_flash')
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="<?php echo trans('messages.email'); ?>"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" autocomplete='off' class="form-control" placeholder="<?php echo trans('messages.password'); ?>"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> <?php echo trans('messages.remember_me'); ?>
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block"><?php echo trans('messages.sign_in'); ?></button>  
                    <p><a href="#"><?php echo trans('messages.forgot_password'); ?></a></p>
                </div>
            </form>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
    </body>
</html>

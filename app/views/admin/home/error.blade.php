<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tasoha | Administration</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/lte.css')}}" rel="stylesheet" type="text/css" />
    </head>
    <body class="">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lỗi hệ thống</h3>
            </div>
            <div class="box-body">
                <?php if ($type == 'permission'): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <b>Lỗi!</b> Bạn không có quyền truy cập vào đây !!!<br>
                        <a href="<?php echo route('admin.root') ?>">Về trang chính</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
    </body>
</html>

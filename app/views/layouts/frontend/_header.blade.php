<div id="header" class="col-lg-12">
    <a href="<?php echo route('fe.root') ?>" class="pull-left"><img id="logo" src="{{asset('assets/img/logo.jpg')}}" alt="TASOHA GROUP"></a>
    <div class="pull-right">
        <p class="text-right">   
            <span id="today"><?php echo date('H:m \N\g\à\y d, \t\h\á\n\g m, Y') ?></span>
            <a href="#" class="text-primary"><i class="fa fa-facebook-square fa-2x"></i></a>
            <a href="#" class="text-danger"><i class="fa fa-youtube-square fa-2x"></i></a>
        </p>
        @include('shared._flash')

        <?php if (!Auth::member()->check()) : ?>
            <form id="login-form" class="form-inline" action="<?php echo route('member.login') ?>" method="post">
                <input class="form-control input-sm" type="text" placeholder="Tên đăng nhập" name="username">
                <input class="form-control input-sm" type="password" placeholder="Mật khẩu" name="password">
                <button class="btn btn-sm btn-primary" type="submit">Đăng nhập</button>
            </form>
        <?php else: ?>
        <div class="pull-right">
            <div class="dropdown">
                <a data-toggle="dropdown" href="#">Xin chào, <span class="text-bold"> <?php echo Auth::member()->get()->full_name; ?></span><span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li>
                        <a href="<?php echo route('member.root') ?> ">Thành viên</a>
                    </li>
                    <li>
                        <a href="#">Thông tin cá nhân</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?php echo route('member.logout') ?>">Đăng Xuất</a>
                    </li>
                </ul>
            </div>
            </div>
        <?php endif; ?>
    </div>

</div>
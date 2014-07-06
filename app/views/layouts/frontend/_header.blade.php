<div id="header" class="col-lg-12">
    <a href="<?php echo route('fe.root') ?>" class="pull-left"><img id="logo" src="{{asset('assets/img/logo.jpg')}}" alt="TASOHA GROUP"></a>
    <div class="pull-right">
        <p class="text-right">
            <a href="#" class="text-primary"><i class="fa fa-facebook-square fa-2x"></i></a>
            <a href="#" class="text-danger"><i class="fa fa-youtube-square fa-2x"></i></a>
        </p>
        @include('shared._flash')
        <?php if (!Auth::member()->check()) : ?>
            <form id="login-form" class="form-inline" action="<?php echo route('member.login') ?>" method="post">
                <input class="form-control input-sm" type="text" placeholder="Tên đăng nhập" name="username">
                <input class="form-control input-sm" type="password" placeholder="Mật khẩu" name="password">
                <button class="btn btn-sm btn-info" type="submit">Đăng nhập</button>
            </form>
        <?php else: ?>
            <a href="<?php echo route('member.root') ?>">Xin chào <?php echo Auth::member()->get()->full_name; ?></a>
            <a class="btn btn-sm btn-info" href="<?php echo route('member.logout') ?>">Đăng Xuất</a>
        <?php endif; ?>
    </div>

</div>
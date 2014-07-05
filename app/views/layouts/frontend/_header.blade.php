<div id="header" class="col-lg-12">
    <a href="/" class="pull-left"><img id="logo" src="{{asset('assets/img/tasoha.png')}}" alt="TASOHA GROUP"></a>
    <div class="pull-right">
        <p class="text-right">
            <a href="#" class="text-primary"><i class="fa fa-facebook-square fa-2x"></i></a>
            <a href="#" class="text-danger"><i class="fa fa-youtube-square fa-2x"></i></a>
        </p>
        <?php if (Auth::check()) : ?>
            <p>Hello, <?php echo Auth::member()->get()->email ?></p>
        <?php else : ?>
            <form id="form-login" class="form-inline" method="POST">
                <?php echo Former::token() ?>
                <input class="form-control input-sm" required type="text" placeholder="Tài khoản">
                <input class="form-control input-sm" required type="password" placeholder="Mật khẩu">
                <button class="btn btn-sm btn-info" type="submit">Đăng nhập</button>
            </form>        
        <?php endif; ?>
    </div>

</div>
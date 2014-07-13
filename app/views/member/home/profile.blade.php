@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-certificate"></i> Thông tin cá nhân</h3>
            </div>
            <div class="panel-body">


            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-stop"></i> Đổi mật khẩu</h3>
            </div>
            <div class="panel-body" id="change-pass-wrap">
                <?php echo View::make('member.home._form_change_password')->render(); ?>

            </div>
        </div>
    </div>
</div>
@stop
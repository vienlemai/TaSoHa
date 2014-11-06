@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-certificate"></i> Thông tin cá nhân</h3>
            </div>
            <div class="panel-body" id="personal-info-wrap">
                <?php echo View::make('member.home._form_personal_info')->render(); ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-key"></i> Đổi mật khẩu</h3>
            </div>
            <div class="panel-body" id="change-pass-wrap">
                <?php echo View::make('member.home._form_change_password')->render(); ?>
            </div>
        </div>
    </div>
</div>
@stop
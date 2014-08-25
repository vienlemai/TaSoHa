@section('content')
<div class="col-lg-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-key"></i> Đổi mật khẩu</h3>
        </div>
        <div class="panel-body" id="change-pass-wrap">
            <?php echo View::make('member.member._form_change_password')->render(); ?>
        </div>
    </div>
</div>
@stop
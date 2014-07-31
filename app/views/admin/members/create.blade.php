@section('header_content')
<h1>
    Quản lý thành viên
    <small>Thêm mới thành viên</small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active">Thành viên</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-user"></i>
                <h3 class="box-title">Nhập Thông tin thành viên</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo route('admin.members.index') ?>" class="btn btn-info">
                        <i class="fa fa-arrow-left"></i> Quay lại danh sách</a>
                </div>
            </div>
            <?php echo Former::open(route('admin.members.store'))->method('post') ?>
            <div class="box-body col-lg-10">
                <?php
                echo Former::select('introduced_by')
                    ->label('Người giới thiệu')
                    ->addOption('-- Là thành viên cấp 1', null)
                    ->class('custom-select2 select2')
                    ->options($members);
                echo Former::select('parent_id')
                    ->label('Người quản lý')
                    ->addOption('-- Là thành viên cấp 1', null)
                    ->class('custom-select2 select2')
                    ->fromQuery($members, 'full_name', 'id');
                echo Former::text('full_name')
                    ->label('Họ tên')
                    ->class('form-control');
                echo Former::text('email')
                    ->label('email')
                    ->class('form-control');
                echo Former::text('username')
                    ->label('Tên đăng nhập')
                    ->class('form-control');
                echo Former::password('password')
                    ->label('Mật khẩu')
                    ->class('form-control');
                echo Former::password('password_confirmation')
                    ->label('Nhập lại mật khẩu')
                    ->class('form-control');
                echo Former::text('day_of_birth')
                    ->label('Ngày tháng năm sinh')
                    ->class('form-control date_mask');
                echo Former::radios('sex')
                    ->label('Giới tính')
                    ->radios(array(
                        'Nam' => array('name' => 'sex', 'value' => 0),
                        'Nữ' => array('name' => 'sex', 'value' => 1),
                    ))->check(0)
                    ->inline();
                echo Former::text('phone')
                    ->label('Số điện thoại')
                    ->class('form-control');
                echo Former::text('identify_number')
                    ->label('Số chứng minh nhân dân')
                    ->class('form-control');
                echo Former::text('identify_location')
                    ->label('Nơi cấp CMND')
                    ->class('form-control');
                echo Former::text('identify_date')
                    ->label('Ngày cấp CMND')
                    ->class('form-control date_mask');
                echo Former::text('location')
                    ->label('Chỗ ở hiện tại')
                    ->class('form-control');

                ?>
            </div>
            <div class="box-footer">
                <?php
                echo Former::actions()
                    ->primary_submit(Lang::get('messages.save'))
                    ->inverse_reset(Lang::get('messages.reset'))

                ?>
            </div>
            <?php echo Former::close(); ?>
        </div>
    </div>
</div>
@stop
@section('addon_js')
<script src="{{asset('assets/js/plugins/jquery.mask.min.js')}}"></script>
@stop
@section('inline_js')
<script>
$('.date_mask').mask('00/00/0000');
$('.money_mask').mask('000 000 000 000 000 000');
</script>
@stop
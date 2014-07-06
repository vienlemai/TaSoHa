@section('header_content')
<h1>
    Quản lý thành viên
    <small>Thêm mới thành viên cấp 1</small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active">Thành viên</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
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
            <div class="box-body">
                <?php
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
                echo Former::radios('sex')
                    ->label('Giới tính')
                    ->radios(array(
                        'Nam' => array('name' => 'sex', 'value' => 0),
                        'Nữ' => array('name' => 'sex', 'value' => 1),
                ));

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
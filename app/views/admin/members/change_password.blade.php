@section('header_content')
<h1>
    Quản lý thành viên
    <small>Đổi mật khẩu</small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active">Đổi mật khẩu</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-user"></i>
                <h3 class="box-title">Đổi mật khẩu cho thành viên <?php echo $member->full_name ?></h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo route('admin.members.show', $member->id) ?>" class="btn btn-info">
                        <i class="fa fa-arrow-left"></i> Quay lại</a>
                </div>
            </div>
            <?php echo Former::open(route('admin.members.change_password', $member->id))->method('post') ?>
            <div class="box-body col-lg-10">
                <?php
                echo Former::open(route('member.change_password'))
                    ->class('form-ajax refresh-on-success')
                    ->method('post');
                echo Former::password('old_password')
                    ->label('Mật khẩu cũ')
                    ->class('form-control');
                echo Former::password('password')
                    ->label('Mật khẩu mới')
                    ->class('form-control');
                echo Former::password('password_confirmation')
                    ->label('Nhập lại mật khẩu')
                    ->class('form-control');

                ?>
                <div class="clear_fix"></div>
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <div class="col-lg-offset-3 col-sm-offset-4 col-lg-9 col-sm-8">
                        <input class="btn-primary btn" type="submit" value="<?php echo trans('messages.save'); ?>"> 
                        <a href="<?php echo route('admin.members.show', $member->id) ?>" class="btn btn-default">Hủy</a>
                    </div>
                </div>
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
</script>
@stop
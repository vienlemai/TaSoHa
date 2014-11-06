@section('header_content')
<h1>
    Quản lý thành viên
    <small>Chỉnh sửa thành viên</small>
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
            <?php echo Former::open(route('admin.members.update', $member->id))->method('put') ?>
            <div class="box-body col-lg-10">
                <?php
                Former::populate($member);
                echo Former::text('full_name')
                    ->class('form-control');
                echo Former::text('email')
                    ->label('email')
                    ->class('form-control');
                echo Former::text('day_of_birth')
                    ->class('form-control date_mask');
                echo Former::radios('sex')
                    ->radios(array(
                        'Nam' => array('name' => 'sex', 'value' => 0),
                        'Nữ' => array('name' => 'sex', 'value' => 1),
                    ))->check(0)
                    ->inline();
                echo Former::text('phone')
                    ->class('form-control');
                echo Former::text('identify_number')
                    ->class('form-control');
                echo Former::text('identify_location')
                    ->class('form-control');
                echo Former::text('identify_date')
                    ->class('form-control date_mask');
                echo Former::text('location')
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
</script>
@stop
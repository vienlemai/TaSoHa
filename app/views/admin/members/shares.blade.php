@section('header_content')
<h1>
    Quản lý thành viên
    <small>Thông tin thành viên</small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active">Thành viên</li>
</ol>
@stop

@section('content')
<div class="row">
    <!--Hoa hong-->
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-money"></i>
                <h3 class="box-title">Thông tin Cổ Phần</h3>
            </div>
            <?php echo Former::open(route('admin.members.shares', $member->id))->method('post') ?>
            <div class="box-body">
                <?php
                echo Former::text('shares')
                    ->label('Cổ phần hiện tại')
                    ->value($member->shares);

                ?>
            </div>
            <div class="box-footer">
                <?php
                echo Former::actions()
                    ->primary_submit(Lang::get('messages.save'))
                ?>
            </div>
            <?php echo Former::close(); ?>
        </div>
    </div>
    <?php echo View::make('admin.members.partials._info',  array(
        'member'=>$member
    ))->render(); ?>
</div>
@stop
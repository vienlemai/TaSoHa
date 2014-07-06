@section('header_content')
<h1>
    <?php echo trans('messages.user_management'); ?>
    <small><?php echo trans('messages.add_user'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('messages.user'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-6 center">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo trans('messages.input_user'); ?></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php echo Former::open(route('admin.users.store'))->method('Post') ?>
            <div class="box-body">

                <?php
                echo Former::select('is_subadmin')
                    ->label('Chức vụ')
                    ->options(array(
                        0 => 'Quản trị nôi dung trang web',
                        1 => 'Quản lý thành viên',
                    ))->class('form-control');

                echo Former::text('full_name')
                    ->label(Lang::get('messages.full_name'))
                    ->class('form-control');
                echo Former::text('email')
                    ->label(Lang::get('messages.email'))
                    ->class('form-control');
                echo Former::password('password')
                    ->label(Lang::get('messages.password'))
                    ->class('form-control');
                echo Former::password('password_confirmation')
                    ->label(Lang::get('messages.password_confirmation'))
                    ->class('form-control');

                ?>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <?php
                echo Former::actions()
                    ->primary_submit(Lang::get('save'))
                    ->inverse_reset(Lang::get('reset'))

                ?>
            </div>
            <?php echo Former::close(); ?>
        </div><!-- /.box -->
    </div>
</div>

@stop
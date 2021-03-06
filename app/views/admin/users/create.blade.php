@extends('layouts.admin')
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
    <div class="col-md-12 center">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo trans('messages.input_user'); ?></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php
            echo Former::open(route('admin.users.store'))
                ->id('form-admin-user')
                ->method('Post')

            ?>
            <div class="box-body">

                <?php
                echo Former::text('email')
                    ->label(Lang::get('messages.email'))
                    ->class('form-control');
                echo Former::password('password')
                    ->label(Lang::get('messages.password'))
                    ->class('form-control');
                echo Former::password('password_confirmation')
                    ->label(Lang::get('messages.password_confirmation'))
                    ->class('form-control');
                echo Former::text('first_name')
                    ->label(Lang::get('messages.first_name'))
                    ->class('form-control');
                echo Former::text('last_name')
                    ->label(Lang::get('messages.last_name'))
                    ->class('form-control');
                echo Former::select('group_id')
                    ->label(Lang::get('messages.group'))
                    ->options($groups)
                    ->multiple()
                    ->id('user-select-group')
                    ->class('custom-select2 select2');

                ?>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <div class="form-group">
                    <div class="col-lg-offset-3 col-sm-offset-4 col-lg-9 col-sm-8">
                        <input class="btn-primary btn" id="btn-submit-user" type="button" value="<?php echo trans('messages.save'); ?>"> 
                        <input class="btn-inverse btn" type="reset" value="<?php echo trans('messages.reset'); ?>">
                    </div>
                </div>
            </div>
            <?php echo Former::close(); ?>
        </div><!-- /.box -->
    </div>
</div>

@stop
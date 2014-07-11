@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('messages.manage_users'); ?>
    <small><?php echo trans('messages.group'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('messages.group'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12 center">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo trans('messages.group_information'); ?></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php
            echo Former::open(route('admin.groups.store'))
                ->method('Post')
                ->id('form-admin-group');

            ?>
            <div class="box-body">

                <?php
                echo Former::text('name')
                    ->label(Lang::get('messages.group_name'))
                    ->class('form-control');
                echo Former::textarea('description')
                    ->label(Lang::get('messages.group_description'))
                    ->rows(4)
                    ->class('form-control');
                echo Former::select('user_id')
                    ->options($users)
                    ->id('group-select-users')
                    ->label(Lang::get('users_of_group'))
                    ->class('custom-select2 select2')
                    ->multiple()

                ?>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <div class="form-group">
                    <div class="col-lg-offset-3 col-sm-offset-4 col-lg-9 col-sm-8">
                        <input class="btn-primary btn" id="btn-submit-group" type="button" value="<?php echo trans('messages.save'); ?>"> 
                        <input class="btn-inverse btn" type="reset" value="<?php echo trans('messages.reset'); ?>">
                    </div>
                </div>
            </div>
            <?php echo Former::close(); ?>
        </div><!-- /.box -->
    </div>
</div>

@stop
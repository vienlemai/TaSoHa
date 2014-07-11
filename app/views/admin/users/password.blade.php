@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('messages.change_password'); ?>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('messages.change_password'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-6 center">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-user"></i> <?php echo trans('messages.change_password'); ?></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php
            echo Former::open(route('admin.users.password'))
                ->method('post')

            ?>
            <div class="box-body">
                <?php
                echo Former::password('old_password')
                    ->label(Lang::get('messages.old_password'))
                    ->value('')
                    ->class('form-control');
                echo Former::password('password')
                    ->label(Lang::get('messages.new_password'))
                    ->value('')
                    ->class('form-control');
                echo Former::password('password_confirmation')
                    ->label(Lang::get('messages.password_confirmation'))
                    ->value('')
                    ->class('form-control');

                ?>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <div class="form-group">
                    <div class="col-lg-offset-3 col-sm-offset-4 col-lg-9 col-sm-8">
                        <input class="btn-primary btn"  type="submit" value="<?php echo trans('messages.save'); ?>"> 
                        <input class="btn-inverse btn" type="reset" value="<?php echo trans('messages.reset'); ?>">
                    </div>
                </div>
            </div>
            <?php echo Former::close(); ?>
        </div><!-- /.box -->
    </div>
</div>

@stop
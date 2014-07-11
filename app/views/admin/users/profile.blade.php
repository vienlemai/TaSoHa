@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('messages.profile'); ?>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('messages.profile'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-6 center">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-user"></i> <?php echo trans('messages.profile'); ?></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php
            echo Former::open(route('admin.users.profile'))
                ->id('form-admin-user')
                ->method('post')

            ?>
            <div class="box-body">
                <?php
                echo Former::text('email')
                    ->label(Lang::get('messages.email'))
                    ->value($user->email)
                    ->class('form-control');
                echo Former::text('first_name')
                    ->label(Lang::get('messages.first_name'))
                    ->value($user->first_name)
                    ->class('form-control');
                echo Former::text('last_name')
                    ->label(Lang::get('messages.last_name'))
                    ->value($user->last_name)
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
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-share"></i> <?php echo trans('messages.permission'); ?></h3>
            </div>
            <div class="box-body">
                <ul>
                    <?php foreach ($resources as $k => $resource): ?>
                        <li><?php echo trans('messages.' . $k); ?>
                            <ul>
                                <?php foreach ($resource as $i => $v): ?>
                                    <?php if (in_array($v[0], $allowed_routes)): ?>
                                        <li><?php echo trans('messages.' . $i); ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

@stop
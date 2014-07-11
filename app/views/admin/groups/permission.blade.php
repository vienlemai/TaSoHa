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
                <h3 class="box-title"><?php echo trans('messages.set_group_permission', array('name' => $group->name)); ?></h3>
                <div class="pull-right box-tools">
                    <a class="btn btn-info btn-sm" href="<?php echo route('admin.groups.index') ?>"><i class="fa fa-backward"></i> <?php echo trans('messages.back_to_list',  array('name'=>'')); ?></a>
                </div>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php
            echo Former::open(route('admin.groups.permission', $group->id))
                ->method('post');

            ?>
            <div class="box-body">

                <ul class="list-resource">
                    <?php foreach ($resources as $k => $resource): ?>
                        <li class="resource-group">
                            <label class="resource-parent"><input type="checkbox"/> <?php echo Lang::get('messages.' . $k) ?></label>
                            <ul class="resource-children">
                                <?php foreach ($resource as $k => $v): ?>
                                    <li>
                                        <label><input type="checkbox" name="permissions[]" value="<?php echo implode(',', $v) ?>" <?php echo in_array($v[0], $currentPers) ? 'checked' : '' ?>/> <?php echo Lang::get('messages.' . $k) ?></label>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <div class="form-group">
                    <div class="col-lg-offset-3 col-sm-offset-4 col-lg-9 col-sm-8">
                        <input class="btn-primary btn" type="submit" value="<?php echo trans('messages.save'); ?>"> 
                        <input class="btn-inverse btn" type="reset" value="<?php echo trans('messages.reset'); ?>">
                    </div>
                </div>
            </div>
            <?php echo Former::close(); ?>
        </div><!-- /.box -->
    </div>
</div>

@stop
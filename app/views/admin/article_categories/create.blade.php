@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('messages.article_management'); ?>
    <small><?php echo trans('messages.categories'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('messages.categories'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-6 center">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo trans('messages.input_category'); ?></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php echo Former::open(route('admin.article_categories.store'))->method('Post') ?>
            <div class="box-body">

                <?php
                echo Former::select('parent_id')
                    ->label(Lang::get('messages.category_parent'))
                    ->options($categories)
                    ->class('form-control');
                echo Former::text('name')
                    ->label(Lang::get('messages.category_name'))
                    ->class('form-control');

                ?>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <?php
                echo Former::actions()
                    ->primary_submit('Lưu')
                    ->inverse_reset('Nhập lại')

                ?>
            </div>
            <?php echo Former::close(); ?>
        </div><!-- /.box -->
    </div>
</div>

@stop
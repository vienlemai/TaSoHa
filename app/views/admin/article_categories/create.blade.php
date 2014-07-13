@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('menu.manage_articles'); ?>
    <small><?php echo trans('menu.list_article_categories'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('menu.manage_articles'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo trans('messages.input_category'); ?></h3>
            </div>
            <?php echo Former::open(route('admin.article_categories.store'))->method('Post') ?>
            <div class="box-body col-md-8">
                <?php echo View::make('admin.article_categories._form')->render() ?>
            </div>

            <div class="box-footer">
                <?php
                echo Former::actions()
                        ->primary_submit('Lưu')
                        ->inverse_reset('Nhập lại')
                ?>
            </div>
            <?php echo Former::close(); ?>
        </div>
    </div>
</div>

@stop
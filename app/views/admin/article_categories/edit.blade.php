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
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo trans('messages.input_category'); ?></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php echo Former::horizontal_open(route('admin.article_categories.update', $category->id))->method('put') ?>
            <?php Former::populate($category) ?>
            <div class="box-body col-md-8">
                <?php echo View::make('admin.article_categories._form')->render() ?>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <div class="form-group">
                    <div class="col-lg-offset-3 col-sm-offset-3 col-lg-9 col-sm-9">
                        <input class="btn-primary btn" type="submit" value="Lưu"> 
                        <a class="btn btn-default" href="<?php echo route('admin.article_categories.index') ?>">Hủy</a>
                    </div>
                </div>
            </div>
            <?php echo Former::close(); ?>
        </div><!-- /.box -->
    </div>
</div>

@stop
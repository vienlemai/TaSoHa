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
    <div class="col-md-12 center">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo trans('messages.input_article'); ?></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php echo Former::open(route('admin.articles.store'))->method('Post') ?>
            <div class="box-body">
                <?php
                echo Former::select('categor_id')
                    ->label(Lang::get('messages.categories'))
                    ->options($categories)
                    ->class('form-control');
                echo Former::text('title')
                    ->label(Lang::get('messages.article_title'))
                    ->class('form-control');
                echo Former::files('thumbnail')
                    ->label(Lang::get('messages.article_thumbnail'))
                    ->accept('image')

                ?>
                <div class="control-group">
                    <label for="name" class="control-label"><?php echo trans('messages.article_content'); ?></label>
                    <div class="controls">
                        <textarea id="ck-editor" name="content"></textarea>
                    </div>
                </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <?php
                echo Former::actions()
                    ->primary_submit(Lang::get('messages.save'))
                    ->inverse_reset(Lang::get('messages.reset'))

                ?>
            </div>
            <?php echo Former::close(); ?>
        </div><!-- /.box -->
    </div>
</div>

@stop
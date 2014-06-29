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
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo trans('messages.categories'); ?></h3>
                <?php echo View::make('admin.partials.search_tool', array('input' => $input))->render(); ?>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <a href="{{route('admin.articles.create')}}" class="pull-left btn btn-primary" style="margin: 15px">
                        <?php echo trans('messages.add_article'); ?>
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th><?php echo trans('messages.article_title'); ?></th>
                            <th><?php echo trans('messages.article_category'); ?></th>
                            <th><?php echo trans('messages.created_at'); ?></th>
                            <th style="width: 15%"><?php echo trans('messages.actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = $articles->getFrom(); ?>
                        <?php foreach ($articles as $article): ?>
                            <tr>
                                <td><?php echo $index++ ?></td>
                                <td><?php echo $article->title ?></td>
                                <td>{{$article->category->name or ''}}</td>
                                <td><?php echo $article->created_at->format('d/m/Y, H:i') ?></td>
                                <td>
                                    <a href="<?php echo route('admin.articles.edit', $article->id) ?>" class="text-blue">
                                        <i class="fa-edit"><?php echo trans('messages.edit'); ?></i>
                                    </a>
                                    <a href="#" class="text-danger">
                                        <i class="fa-ban"><?php echo trans('messages.delete'); ?></i>
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
                echo View::make('admin.partials.table_paging', array(
                    'collection' => $articles
                ))->render();

                ?>
            </div><!-- /.box-body -->
        </div>
    </div>
</div>
@stop
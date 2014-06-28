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
                <?php echo View::make('admin.partials.search_tool',array('keyword'=>$keyword))->render(); ?>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th><?php echo trans('messages.category_name'); ?></th>
                            <th><?php echo trans('messages.category_parent'); ?></th>
                            <th><?php echo trans('messages.created_at'); ?></th>
                            <th style="width: 15%"><?php echo trans('messages.actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = $categories->getFrom(); ?>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?php echo $index++ ?></td>
                                <td><?php echo $category->name ?></td>
                                <td>{{$category->parent_category->name or ''}}</td>
                                <td><?php echo $category->created_at->format('d/m/Y, H:i') ?></td>
                                <td>
                                    <a href="<?php echo route('admin.categories.edit',$category->id) ?>" class="text-blue">
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
                <div class="row">
                    <div class="col-xs-6">
                        <div class="pull-left"><?php
                            echo trans('messages.paging_info', array(
                                'from' => $categories->getFrom(),
                                'to' => $categories->getTo(),
                                'total' => $categories->getTotal(),
                            ));

                            ?></div>
                    </div>
                    <div class="col-xs-6">
                        <div class="pull-right">
                            <?php echo $categories->links(); ?>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div>
    </div>
</div>
@stop
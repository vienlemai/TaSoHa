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

        <div class="table-wrap">
            <div class="table-header">
                <a href="{{route('admin.article_categories.create')}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> <?php echo trans('messages.add_category'); ?>
                </a>
                <div class="col-md-4 pull-right no-padding">
                    <?php echo View::make('admin.partials.search_tool')->render(); ?>
                </div>
            </div>
            <table class="table table-bordered">
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
                            <td>
                                <a href="<?php echo route('admin.article_categories.edit', $category->id) ?>"><?php echo $category->name ?></a>
                            </td>
                            <td>{{$category->parent_category->name or ''}}</td>
                            <td><?php echo $category->created_at->format('d/m/Y, H:i') ?></td>
                            <td>
                                <a href="<?php echo route('admin.article_categories.edit', $category->id) ?>" class="btn btn-xs btn-primary">
                                    <i class="fa fa-pencil"> <?php echo trans('messages.edit'); ?></i>
                                </a>
                                <a href="#" class="btn btn-xs btn-danger">
                                    <i class="fa fa-times"> <?php echo trans('messages.delete'); ?></i>
                                </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="table-footer">
                <div class="info-left">
                    <?php
                    echo trans('messages.paging_info', array(
                        'from' => $categories->getFrom(),
                        'to' => $categories->getTo(),
                        'total' => $categories->getTotal(),
                    ));
                    ?>
                </div>
                <div class="info-right">
                    <?php echo $categories->links(); ?>
                    <ul class="pagination pagination-sm">
                        <li><a href="#">«</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
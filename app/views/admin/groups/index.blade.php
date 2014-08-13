@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('messages.user_management'); ?>
    <small><?php echo trans('messages.groups'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('messages.groups'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="table-wrap">
            <div class="table-header">
                <?php if (in_array('admin.groups.create', $allowed_routes)): ?>
                    <a href="{{route('admin.groups.create')}}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> <?php echo trans('messages.add_group'); ?>
                    </a>
                <?php endif; ?>
                <div class="col-md-4 pull-right no-padding">
                    <?php echo View::make('admin.partials.search_tool', array('input' => $input))->render(); ?>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th><?php echo trans('messages.group_name'); ?></th>
                        <th><?php echo trans('messages.created_at'); ?></th>
                        <th style="width: 20%"><?php echo trans('messages.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = $groups->getFrom();
                    $allowEdit = in_array('admin.groups.edit', $allowed_routes);
                    $allowDestroy = in_array('admin.groups.destroy', $allowed_routes);
                    $allowPermission = in_array('admin.groups.permission', $allowed_routes);

                    ?>
                    <?php foreach ($groups as $group): ?>
                        <tr>
                            <td><?php echo $index++ ?></td>
                            <td><?php echo $group->name ?></td>
                            <td><?php echo $group->created_at->format('d/m/Y, H:i') ?></td>
                            <td>
                                <?php if ($allowEdit): ?>
                                    <a href="<?php echo route('admin.groups.edit', $group->id) ?>" class="text-blue" title="<?php echo trans('messages.edit'); ?>">
                                        <i class="fa fa-fw fa-edit"></i><?php echo trans('messages.edit'); ?>
                                    </a>
                                <?php endif; ?>
                                <?php if ($allowDestroy): ?>
                                    <a href="<?php echo route('admin.groups.destroy', $group->id) ?>" class="text-danger" data-method="delete" title="<?php echo trans('messages.delete'); ?>">
                                        <i class="fa fa-fw fa-ban"></i><?php echo trans('messages.delete'); ?>
                                    </a>
                                <?php endif; ?>
                                <?php if ($allowPermission): ?>
                                    <a href="<?php echo route('admin.groups.permission', $group->id) ?>" class="text-warning" title="<?php echo trans('messages.permission'); ?>">
                                        <i class="fa fa-share"></i><?php echo trans('messages.permission'); ?>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="table-footer">
                <div class="info-left">
                    <?php
                    echo trans('messages.paging_info', array(
                        'from' => $groups->getFrom(),
                        'to' => $groups->getTo(),
                        'total' => $groups->getTotal(),
                    ));

                    ?>
                </div>
                <div class="info-right">
                    <?php echo $groups->links(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
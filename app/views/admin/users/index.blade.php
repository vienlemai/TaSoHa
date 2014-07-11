@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('messages.user_management'); ?>
    <small><?php echo trans('messages.users'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('messages.users'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="table-wrap">
            <div class="table-header">
                <?php if (in_array('admin.users.create', $allowed_routes)): ?>
                    <a href="{{route('admin.users.create')}}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> <?php echo trans('messages.add_user'); ?>
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
                        <th><?php echo trans('messages.first_name'); ?></th>
                        <th><?php echo trans('messages.last_name'); ?></th>
                        <th><?php echo trans('messages.group'); ?></th>
                        <th><?php echo trans('messages.created_at'); ?></th>
                        <th style="width: 15%"><?php echo trans('messages.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = $users->getFrom(); ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $index++ ?></td>
                            <td><?php echo $user->first_name ?></td>
                            <td><?php echo $user->last_name ?></td>
                            <td><?php echo $user->getGroup() ?></td>
                            <td><?php echo $user->created_at->format('d/m/Y, H:i') ?></td>
                            <td>
                                <?php if (in_array('admin.users.edit', $allowed_routes)): ?>
                                    <a href="<?php echo route('admin.users.edit', $user->id) ?>" class="text-blue" title="<?php echo trans('messages.edit'); ?>">
                                        <i class="fa fa-fw fa-edit"></i><?php echo trans('messages.edit'); ?>
                                    </a>
                                <?php endif; ?>
                                <?php if (in_array('admin.users.destroy', $allowed_routes)): ?>
                                    <a href="<?php echo route('admin.users.destroy', $user->id) ?>" class="text-danger" title="<?php echo trans('messages.delete'); ?>" data-method="delete">
                                        <i class="fa fa-fw fa-ban"></i><?php echo trans('messages.delete'); ?>
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
                        'from' => $users->getFrom(),
                        'to' => $users->getTo(),
                        'total' => $users->getTotal(),
                    ));

                    ?>
                </div>
                <div class="info-right">
                    <?php echo $users->links(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
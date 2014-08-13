@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('menu.manage_slides'); ?>
    <small><?php echo trans('menu.list_slides'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('menu.list_slides'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="table-wrap">
            <div class="table-header">
                <?php if (in_array('admin.slide.create', $allowed_routes)): ?>
                    <a href="{{route('admin.slide.create')}}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> <?php echo trans('button.new_slide'); ?>
                    </a>
                <?php endif; ?>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th><?php echo trans('common.photo'); ?></th>
                        <th><?php echo trans('common.description'); ?></th>
                        <th><?php echo trans('common.created_at'); ?></th>
                        <th style="width: 15%"><?php echo trans('common.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $allowEdit = in_array('admin.slide.edit', $allowed_routes);
                    $allowDestroy = in_array('admin.slide.destroy', $allowed_routes);

                    ?>
                    <?php foreach ($slides as $slide): ?>
                        <tr>
                            <td><?php echo $slide->id ?></td>
                            <td>
                                <a href="<?php echo asset($slide->url) ?>" target="_blank">
                                    <img class="slide-thumbnail" src="<?php echo asset($slide->url) ?>">
                                </a>
                            </td>
                            <td><?php echo $slide->description ?></td>
                            <td><?php echo $slide->created_at->format('d/m/Y, H:i') ?></td>
                            <td>
                                <?php if ($allowEdit): ?>
                                    <a href="<?php echo route('admin.slide.edit', $slide->id) ?>">
                                        <i class="fa fa-edit"> <?php echo trans('messages.edit'); ?></i>
                                    </a>
                                <?php endif; ?>
                                <?php
                                if ($allowDestroy):
                                    $deleteUrl = route('admin.slide.destroy', $slide->id);
                                    $confirmMsg = trans('confirmation.delete_slide', array('title' => $slide->title));

                                    ?>
                                    <a href="<?php echo $deleteUrl ?>" class="text-danger" data-method='delete' data-confirm='<?php echo $confirmMsg ?>'>
                                        <i class="fa fa-ban"> <?php echo trans('messages.delete'); ?></i>
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
                        'from' => $slides->getFrom(),
                        'to' => $slides->getTo(),
                        'total' => $slides->getTotal(),
                    ));

                    ?>
                </div>
                <div class="info-right">
                    <?php echo $slides->links(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
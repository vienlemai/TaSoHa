@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('menu.manage_news'); ?>
    <small><?php echo trans('menu.list_news'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('menu.list_news'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="table-wrap">
            <div class="table-header">
                <?php if (in_array('admin.news.create', $allowed_routes)): ?>
                    <a href="{{route('admin.news.create')}}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> <?php echo trans('button.new_news'); ?>
                    </a>
                <?php endif; ?>
                <div class="col-md-4 pull-right no-padding">
                    <?php echo View::make('admin.partials.search_tool')->render(); ?>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th><?php echo trans('common.title'); ?></th>
                        <th><?php echo trans('common.content'); ?></th>
                        <th><?php echo trans('common.created_at'); ?></th>
                        <th style="width: 15%"><?php echo trans('common.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $allowEdit = in_array('admin.news.edit', $allowed_routes);
                    $allowDestroy = in_array('admin.news.destroy', $allowed_routes);

                    ?>
                    <?php foreach ($news as $n): ?>
                        <tr>
                            <td><?php echo $n->id ?></td>
                            <td>
                                <a href="<?php echo route('admin.news.edit', $n->id) ?>">
                                    <?php echo $n->title ?>
                                </a>
                            </td>
                            <td><?php echo truncate($n->content, 10) ?></td>
                            <td><?php echo $n->created_at->format('d/m/Y, H:i') ?></td>
                            <td>
                                <?php if ($allowEdit): ?>
                                    <a href="<?php echo route('admin.news.edit', $n->id) ?>">
                                        <i class="fa fa-edit"> <?php echo trans('messages.edit'); ?></i>
                                    </a>
                                <?php endif; ?>
                                <?php
                                if ($allowDestroy):
                                    $deleteUrl = route('admin.news.destroy', $n->id);
                                    $confirmMsg = trans('confirmation.delete_news', array('title' => $n->title));

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
                        'from' => $news->getFrom(),
                        'to' => $news->getTo(),
                        'total' => $news->getTotal(),
                    ));

                    ?>
                </div>
                <div class="info-right">
                    <?php echo $news->links(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
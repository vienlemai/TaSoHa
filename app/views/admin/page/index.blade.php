@section('header_content')
<h1>
    <?php echo trans('menu.manage_articles'); ?>
    <small>
    <?php echo trans('menu.manage_tasoha_pages')?>    
    </small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('menu.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('menu.manage_tasoha_pages'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12 center">
        <div class="table-wrap">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 2%">#</th>
                        <th><?php echo trans('messages.category_name'); ?></th>
                        <th style="width: 15%"><?php echo trans('messages.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pages as $page): ?>
                        <tr>
                            <td><?php echo $page->id ?></td>
                            <td>
                                <a href="<?php echo route('admin.page.edit', $page->name) ?>"><?php echo $page->title ?></a>
                            </td>
                            <td>
                                <a href="<?php echo route('admin.page.edit', $page->name) ?>" class="btn btn-xs btn-primary">
                                    <i class="fa fa-pencil"> <?php echo trans('messages.edit'); ?></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
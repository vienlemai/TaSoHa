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
    <div class="col-md-12 center">

        <div class="table-wrap">
            <div class="table-header">
                <a href="{{route('admin.article_categories.create')}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> <?php echo trans('messages.add_category'); ?>
                </a>
               
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 2%">#</th>
                        <th><?php echo trans('messages.category_name'); ?></th>
                        <th><?php echo trans('messages.created_at'); ?></th>
                        <th style="width: 15%"><?php echo trans('messages.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?php echo $category->id ?></td>
                            <td>
                                <a href="<?php echo route('admin.article_categories.edit', $category->id) ?>"><?php echo $category->name ?></a>
                            </td>
                            <td><?php echo $category->created_at->format('d/m/Y, H:i') ?></td>
                            <td>
                                <a href="<?php echo route('admin.article_categories.edit', $category->id) ?>" class="btn btn-xs btn-primary">
                                    <i class="fa fa-pencil"> <?php echo trans('messages.edit'); ?></i>
                                </a>
                                    <?php 
                                    $deleteUrl = route('admin.article_categories.destroy', $category->id);
                                    $confirmMsg = trans('confirmation.delete_article_category',array('name' => $category->name ));
                                    ?>
                                <a href="<?php echo $deleteUrl ?>" class="btn btn-xs btn-danger" data-method="delete" data-confirm="<?php echo $confirmMsg ?>">
                                    <i class="fa fa-times"> <?php echo trans('messages.delete'); ?></i>
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
@section('header_content')
<h1>
    <?php echo trans('menu.manage_product'); ?>
    <small><?php echo trans('menu.all_product_categories'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('menu.manage_product'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12 center">

        <div class="table-wrap">
            <div class="table-header">
                <?php if (in_array('admin.product_category.create', $allowed_routes)): ?>
                    <a href="{{route('admin.product_category.create')}}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> <?php echo trans('messages.add_category'); ?>
                    </a>
                <?php endif; ?>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 2%">#</th>
                        <th><?php echo trans('messages.category_name'); ?></th>
                        <th><?php echo trans('common.description'); ?></th>
                        <th><?php echo trans('messages.created_at'); ?></th>
                        <th style="width: 22%"><?php echo trans('messages.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $allowEdit = in_array('admin.product_category.edit', $allowed_routes);
                    $allowDestroy = in_array('admin.product_category.destroy', $allowed_routes);
                    $allowCreate = in_array('admin.product.create', $allowed_routes);

                    ?>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?php echo $category->id ?></td>
                            <td>
                                <a href="<?php echo route('admin.product_category.edit', $category->id) ?>"><?php echo $category->name ?></a>
                            </td>
                            <td><?php echo $category->description ?></td>
                            <td><?php echo $category->created_at->format('d/m/Y, H:i') ?></td>
                            <td>
                                <?php if ($allowEdit): ?>
                                    <a href="<?php echo route('admin.product_category.edit', $category->id) ?>" class="btn btn-xs btn-primary">
                                        <i class="fa fa-pencil"> <?php echo trans('messages.edit'); ?></i>
                                    </a>
                                <?php endif; ?>
                                <?php
                                if ($allowDestroy):
                                    $deleteUrl = route('admin.product_category.destroy', $category->id);
                                    $confirmMsg = trans('confirmation.product_category', array('name' => $category->name));

                                    ?>
                                    <a href="<?php echo $deleteUrl ?>" class="btn btn-xs btn-danger" data-method="delete" data-confirm="<?php echo $confirmMsg ?>">
                                        <i class="fa fa-times"> <?php echo trans('messages.delete'); ?></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ($allowCreate): ?>
                                    <a href="{{route('admin.product.create', array('product_category_id' => $category->id))}}" class="btn btn-xs btn-success">
                                        <i class="fa fa-plus"></i> <?php echo trans('button.new_product'); ?>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
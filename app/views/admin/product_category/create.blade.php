@section('header_content')
<h1>
    <?php echo trans('menu.manage_product'); ?>
    <small><?php echo trans('menu.new_product_category'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('menu.manage_product'); ?></li>
</ol>
@stop


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo trans('messages.input_category'); ?></h3>
            </div>
            <?php echo Former::open(route('admin.product_category.store'))->method('Post') ?>
            <div class="box-body col-md-8">
                <?php echo View::make('admin.product_category._form')->render() ?>
            </div>

            <div class="box-footer">
                <div class="form-group">
                    <div class="col-lg-offset-3 col-sm-offset-3 col-lg-9 col-sm-9">
                        <input class="btn-primary btn" type="submit" value="Lưu"> 
                        <a class="btn btn-default" href="<?php echo route('admin.product_category.index') ?>">Hủy</a>
                    </div>
                </div>
            </div>
            <?php echo Former::close(); ?>
        </div>
    </div>
</div>

@stop
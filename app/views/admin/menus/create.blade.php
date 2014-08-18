@section('header_content')
<h1>
    <?php echo trans('menu.manage_menus'); ?>
    <small><?php echo trans('menu.list_menus'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('menu.manage_menus'); ?></li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo trans('messages.input_menu'); ?></h3>
            </div>
            <?php echo Former::open(route('admin.menu.store'))->method('Post') ?>
            <div class="box-body col-md-8">
                <?php
                echo View::make('admin.menus._form', array(
                    'menus' => $menus
                ))->render()

                ?>
            </div>

            <div class="box-footer">
                <?php
                echo Former::actions()
                    ->primary_submit('Lưu')
                    ->inverse_reset('Nhập lại')

                ?>
            </div>
            <?php echo Former::close(); ?>
        </div>
    </div>
</div>
<div id="modal-menu-content" class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>Chọn menu</h3>
            </div>
            <div class="modal-body" id='form-add-node-wrap'>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Đóng</button>            
            </div>
        </div>
    </div>
</div>
@stop
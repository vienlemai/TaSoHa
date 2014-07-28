@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('menu.manage_slides'); ?>
    <small><?php echo trans('menu.new_slide'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li><?php echo trans('menu.list_slides'); ?></li>
    <li class="active"><?php echo trans('menu.new_slide'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo trans('messages.input_slide'); ?></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php echo Former::horizontal_open(route('admin.slide.update', $slide->id))->method('put')->enctype('multipart/form-data') ?>
            <div class="box-body col-md-10">
                <div class="alert alert-warning">
                    <strong>Lưu ý: </strong> Kích thước chuẩn của ảnh slide là 940x300. Nên chọn ảnh đúng kích thước, tránh trường hợp vỡ giao diện
                    <button type="button" class="close" data-dismiss="alert">×</button>
                </div>
                <?php
                Former::populate($slide);
                echo View::make('admin.slide._form', array(
                    'slide' => $slide
                ))->render()

                ?>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <div class="box-footer">
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-sm-offset-3 col-lg-9 col-sm-9">
                            <input class="btn-primary btn" type="submit" value="Lưu"> 
                            <a href="<?php echo route('admin.slide.index') ?>" class="btn btn-default">Hủy</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo Former::close(); ?>
        </div><!-- /.box -->
    </div>
</div>
@stop
@section('addon_css')
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<link href="{{asset('packages/barryvdh/laravel-elfinder/css/elfinder.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('packages/barryvdh/laravel-elfinder/css/theme.css')}}" rel="stylesheet" type="text/css" />
@stop
@section('addon_js')
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="{{asset('assets/js/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('packages/barryvdh/laravel-elfinder/js/elfinder.min.js')}}"></script>
@stop
@section('inline_js')
<script type="text/javascript">
$().ready(function() {
    $('#elfinder_button').on('click', function() {
        $('<div id="editor" />').dialogelfinder({
            url: '<?= URL::action('Barryvdh\Elfinder\ElfinderController@showConnector') ?>',
            getFileCallback: function(file) {
                $('#editor').dialogelfinder('close');
                $('#editor').closest('.elfinder').val(file.path);
                var imageHtml = '<img src="' + file.url + '"/>';
                $('#elfinder_button').html(imageHtml);
                $($('#elfinder_button').attr('for')).val(file.path);
                console.log(file.url);
            }
        });
    });
});
</script>
@stop
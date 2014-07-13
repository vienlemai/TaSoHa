@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('menu.manage_news'); ?>
    <small><?php echo trans('menu.list_news'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('menu.manage_news'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12 center">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo trans('messages.input_news'); ?></h3>
            </div>
            <?php echo Former::open(route('admin.news.update', $news->id))->method('put') ?>
            <?php Former::populate($news) ?>
            <div class="box-body col-md-10">
                 <?php echo View::make('admin.news._form')->render() ?>
            </div>

            <div class="box-footer">
                <div class="form-group">
                    <div class="col-lg-offset-3 col-sm-offset-3 col-lg-9 col-sm-9">
                        <input class="btn-primary btn" type="submit" value="<?php echo trans('button.save')?>">
                        <a class="btn-default btn" href='<?php echo route('admin.news.index')?>'><?php echo trans('button.cancel')?></a>
                    </div>
                </div>
            </div>
            <?php echo Former::close(); ?>
        </div>
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
            url : '<?= URL::action('Barryvdh\Elfinder\ElfinderController@showConnector') ?>',
            getFileCallback: function(file) {
                $('#editor').dialogelfinder('close');
                $('#editor').closest('.elfinder').val(file.path);
                var imageHtml = '<img src="'+file.url+'"/>';
                $('#elfinder_button').html(imageHtml);
                $($('#elfinder_button').attr('for')).val(file.path);
                console.log(file.url);
            }
        });
    });
});
</script>
@stop
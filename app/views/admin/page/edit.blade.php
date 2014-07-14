@section('header_content')
<h1>
    <?php echo trans('menu.manage_tasoha_pages');
    ?>
    <small><?php echo $page->title ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('menu.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('menu.manage_tasoha_pages'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12 center">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo trans('messages.input_page'); ?></h3>
            </div>
            <?php echo Former::open(route('admin.page.update', $page->name))->method('put') ?>
            <?php Former::populate($page) ?>
            <div class="box-body col-md-10">
                <?php
                echo Former::text('title')
                    ->label(trans('common.title'))
                    ->class('form-control');
                ?>
                <?php
                echo Former::textarea('content')
                    ->label(trans('common.content'))
                    ->id('ck-editor')
                ?>
            </div>

            <div class="box-footer">
                <div class="form-group">
                    <div class="col-lg-offset-3 col-sm-offset-3 col-lg-9 col-sm-9">
                        <input class="btn-primary btn" type="submit" value="<?php echo trans('button.save') ?>">
                        <a class="btn-default btn" href='<?php echo route('admin.page.index') ?>'><?php echo trans('button.cancel') ?></a>
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
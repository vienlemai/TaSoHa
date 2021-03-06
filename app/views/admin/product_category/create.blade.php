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

@section('addon_css')
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<link href="{{asset('packages/barryvdh/laravel-elfinder/css/elfinder.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('packages/barryvdh/laravel-elfinder/css/theme.css')}}" rel="stylesheet" type="text/css" />
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
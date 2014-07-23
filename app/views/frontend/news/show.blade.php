@section('breadcrumb')
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li><a href="<?php echo route('fe.root') ?>">Trang chủ</a></li>
    <li><a href="<?php echo route('fe.news.index') ?>"></a>Tin tức / Thông báo</li>
    <li class='active'><?php echo $new->title ?></li>
</ul>
@stop

@section('content')
<?php echo $new->content ?>
@stop
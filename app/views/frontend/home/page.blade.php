@section('breadcrumb')
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li><a href="<?php echo route('fe.root') ?>">Trang chủ</a></li>
    <li>TASOHA GROUP</li>
    <li class='active'><?php echo $page->title ?></li>
</ul>
@stop

@section('content')
<h1><?php echo $page->title ?></h1>
<p>
    <?php echo $page->content ?>
</p>
@stop
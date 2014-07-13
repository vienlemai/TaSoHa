@section('breadcrumb')
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li><a href="<?php echo route('fe.root') ?>">Trang chủ</a></li>
    <li class='active'>Tin tức / Thông báo</li>
</ul>
@stop

@section('content')
<?php foreach ($news as $n) : ?>
    <?php
    $url = route('fe.news.show', $n->toParam());
    ?>
    <div class="article">
        <div class="article-header">
            <h3><a href="<?php echo $url ?>"><?php echo $n->title ?></a></h3>
        </div>
        <div class="article-body">
            <p><?php echo truncate($article->content, 100) ?></p>
        </div>
        <div class="article-footer">
            <div class="pull-right">
                <a href="<?php echo $url ?>" class='btn btn-xs btn-primary'>Xem thêm <i class="fa fa-angle-double-right"></i></a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
@stop
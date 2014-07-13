@section('breadcrumb')
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li><a href="<?php echo route('fe.root') ?>">Trang chủ</a></li>
    <li><a href="<?php echo route('fe.category', $category->toParam()) ?>"><?php echo $category->name ?></a></li>
    <li class='active'><?php echo $article->title ?></li>
</ul>
@stop

@section('content')
<h1><?php echo $article->title ?></h1>
<p>
    <?php echo $article->content ?>
</p>
<div class="page-header">
    <h3><i class="fa fa-file-text-o"></i> Bài viết khác cùng danh mục</h3>
</div>
<?php foreach ($otherArticles as $article) : ?>
    <?php
    $url = route('fe.article.show', $article->toParam());
    ?>
    <div class="article">
        <div class="article-header">
            <h3><a href="<?php echo $url ?>"><?php echo $article->title ?></a></h3>
        </div>
        <div class="article-body">
            <p><?php echo truncate($article->content, 50) ?></p>
        </div>
        <div class="article-footer">
            <div class="pull-right">
                <a href="<?php echo $url ?>" class='btn btn-xs btn-primary'>Xem thêm <i class="fa fa-angle-double-right"></i></a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
@stop
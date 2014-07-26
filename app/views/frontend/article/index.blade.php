@section('breadcrumb')
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li><a href="<?php echo route('fe.root') ?>">Trang chủ</a></li>
    <li class='active'><?php echo $category->name ?></li>
</ul>
@stop

@section('content')
<div class="row">
    <div class='col-lg-12'>


        <?php foreach ($articles as $article) : ?>
            <?php
            $url = route('fe.article.show', $article->toParam());

            ?>
            <div class="article">
                <div class="col-md-3">
                    <div class="article-thumbnail-wrap">
                        <img class="article-thumbnail" src="<?php echo $article->getThumbnailUrl() ?>">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="article-header">
                        <h3><a href="<?php echo $url ?>"><?php echo $article->title ?></a></h3>
                    </div>
                    <div class="article-footer">
                        <div class="pull-right">
                            <a href="<?php echo $url ?>" class='btn btn-xs btn-primary'>Xem thêm <i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
@stop
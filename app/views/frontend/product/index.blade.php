@section('breadcrumb')
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li><a href="<?php echo route('fe.root') ?>">Trang chủ</a></li>
    <li class='active'><?php echo $category->name ?></li>
</ul>
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h2><?php echo $category->name ?></h2>
        </div>  	
        <div>
            <?php foreach ($products as $product) : ?>
                <?php
                $url = route('fe.product.show', $product->toParam());

                ?>
                <div class="article">
                    <div class="col-md-2">
                        <div class="article-thumbnail-wrap">
                            <img class="article-thumbnail" src="<?php echo $product->getThumbnailUrl() ?>">
                        </div>
                    </div>
                    <div class="col-md-10 article-right">
                        <div class="article-header">
                            <h3><a href="<?php echo $url ?>"><?php echo $product->name ?></a></h3>
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
        <div class="pagination-wrap">
            <?php echo $products->links(); ?>
        </div>
    </div>
</div>
@stop
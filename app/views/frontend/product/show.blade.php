@section('breadcrumb')
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li><a href="<?php echo route('fe.root') ?>">Trang chủ</a></li>
    <li><a href="<?php echo route('fe.product_category.show', $product->category->toParam()) ?>"><?php echo $product->category->name ?></a></li>
    <li class='active'><?php echo $product->name ?></li>
</ul>
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h2><?php echo $product->name ?></h2>
        </div>  	
        <div>
            <?php echo $product->description ?>
        </div>
    </div>
</div>
@stop
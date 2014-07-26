@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h2><?php echo $category->name ?></h2>
        </div>  	
        <div>
            <?php foreach ($products as $product) : ?>
                <a href="<?php echo route('fe.product.show', $product->toParam()) ?>"><?php echo $product->name ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
@stop
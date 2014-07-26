@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h2><?php echo $product->name ?></h2>
        </div>  	
        <div>
            <?php echo $product->desciption ?>
        </div>
    </div>
</div>
@stop
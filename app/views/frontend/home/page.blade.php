@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h2><?php echo $page->title ?></h2>
            </div>  	
            <p>
                <?php echo $page->content ?>
            </p>
        </div>
    </div>

@stop
@section('content')
<div id="slide">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="http://placehold.it/995x440&text=Slide+One" alt="...">
                <div class="carousel-caption">
                    The caption slide one
                </div>
            </div>
            <div class="item">
                <img src="http://placehold.it/995x440&text=Slide+Two" alt="...">
                <div class="carousel-caption">
                    The caption slide two
                </div>
            </div>
            <div class="item">
                <img src="http://placehold.it/995x440&text=Slide+Three" alt="...">
                <div class="carousel-caption">
                    The caption slide three
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>
<!--New -->
<div class="row">
  <div class="col-lg-12">
	  	<div class="page-header">
	    	<h3><i class="fa fa-bullhorn"></i> Tin tức / Hoạt động</h3>
	  	</div>  
	  	<div class="col-lg-10">
	      	<blockquote>
	        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
	        	<small>Someone famous in <cite title="Source Title">Source Title</cite></small>
	      	</blockquote>
	      	<a href="#" class="btn btn-info btn-xs">Chi tiết <i class="fa fa-angle-double-right"></i></a>
	  	</div>
  </div>
</div>

<div class="row">
	<div class="col-lg-12">
	  	<div class="page-header">
	    	<h3><i class="fa fa-file-text-o"></i> Bài viết</h3>
	  	</div>  	
		<div class="col-lg-4">
			<div class="well">
	                <h3>Sản phẩm mới</h3>
	                <hr>
	                <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
	                <p><a class="btn btn-info btn-sm">Xem thêm</a></p>
			</div>	
		</div>	

		<div class="col-lg-4">
			<div class="well">
                <h3>Công tác tập huấn</h3>
                <hr>
                <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <p><a class="btn btn-info btn-sm">Xem thêm</a></p>
            </div>    
		</div>

		<div class="col-lg-4">
			<div class="well">		
                <h3>Sự kiện</h3>
                <hr>
                <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <p><a class="btn btn-info btn-sm">Xem thêm</a></p>
 			</div>                    
		</div>
	</div>
</div>

@stop
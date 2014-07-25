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
                <img src="<?php echo asset('/assets/img/slide-sample/slide1.jpg') ?>" alt="...">
<!--                <div class="carousel-caption">
                    The caption slide one
                </div>-->
            </div>
            <div class="item">
                <img src="<?php echo asset('/assets/img/slide-sample/slide2.jpg') ?>" alt="...">
<!--                <div class="carousel-caption">
                    The caption slide two
                </div>-->
            </div>
            <div class="item">
                <img src="<?php echo asset('/assets/img/slide-sample/slide3.jpg') ?>" alt="...">
<!--                <div class="carousel-caption">
                    The caption slide three
                </div>-->
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-circle-arrow-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-circle-arrow-right"></span>
        </a>
    </div>
</div>
<!-- News -->
<?php if (count($recentNews) > 0) : ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="marquee">
                <p><a href="<?php echo route('fe.news.show', $news->toParam()) ?>"><?php echo $news->title ?></a></p>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
        </div>  	
        <?php foreach ($articleCategories as $ac) : ?>
            <div class="col-lg-4">
                <div class="well">
                    <h4><?php echo $ac->name ?></h4>
                    <hr>
                    <p><?php echo $ac->description ?></p>
                    <p><a href="<?php echo route('fe.category', $ac->toParam()) ?>" class="btn btn-primary btn-xs">Xem thêm</a></p>
                </div>	
            </div>	
        <?php endforeach; ?>
    </div>
</div>
@stop
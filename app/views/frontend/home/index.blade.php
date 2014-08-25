@section('content')
<?php if (!$slides->isEmpty()): ?>
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
                <?php $first = $slides->shift() ?>
                <div class="item active">
                    <img src="<?php echo $first->getThumbnailUrl(); ?>" alt="...">
                    <div class="carousel-caption">
                        <?php echo $first->description ?>
                    </div>
                </div>
                <?php foreach ($slides as $slide): ?>
                    <div class="item">
                        <img src="<?php echo $slide->getThumbnailUrl() ?>" alt="...">
                        <div class="carousel-caption">
                            <?php echo $slide->description ?>
                        </div>
                    </div>
                <?php endforeach; ?>
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
<?php endif; ?>
<!-- News -->

<?php if (count($recentNews) > 0) : ?>
    <div class="row">
        <div class="col-lg-12">
            <ul class="marquee">
                <?php foreach ($recentNews as $new) : ?>
                    <li><a href="<?php echo route('fe.news.show', $new->toParam()) ?>"><?php echo $new->title ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
        </div>  	
        <?php foreach ($bottom_categories as $ac) : ?>
            <div class="col-lg-4 home-article-category">
                <div class="well">
                    <h4><a href="<?php echo route('fe.category', $ac->toParam()) ?>"><?php echo $ac->name ?></a></h4>
                    <hr>
                    <div class="clearfix">
                        <div class="pull-left">
                            <a href="<?php echo route('fe.category', $ac->toParam()) ?>"><img class="article-category-thumbnail" src="<?php echo $ac->getThumbnailUrl() ?>"/></a>
                        </div>
                        <div class="pull-right">
                            <?php echo $ac->description ?>
                            <br>
                            <a href="<?php echo route('fe.category', $ac->toParam()) ?>">Xem thêm . . .</a>
                        </div>
                    </div>
                </div>	
            </div>	
        <?php endforeach; ?>
    </div>
</div>
@stop
@section('content')
<!-- Flex Slider -->
<section class="slider">
    <div class="flexslider home">
        <ul class="slides">
            <li>
                <img width="900" height="400" src="http://lorempixel.com/900/400/fashion/">
                <div class="slide-caption">
                    <h3>This is a caption</h3>
                    <p>Donec scelerisque aliquet mi, non venenatis urnas iaculis. Utea id nila ante. Cras est massa, interdum  ateal imperdiet etean, gravida eu quame. Aeneana volutpat hendrerit posuere.</p>
                </div>
            </li>
            <li>
                <img width="900" height="400"  src="http://lorempixel.com/900/400/people/">
                <div class="slide-caption">
                    <h3>This is a caption</h3>
                    <p>Donec scelerisque aliquet mi, non venenatis urnas iaculis. Utea id nila ante. Cras est massa, interdum  ateal imperdiet etean, gravida eu quame. Aeneana volutpat hendrerit posuere.</p>
                </div>
            </li>
            <li>
                <img width="900" height="400"  src="http://lorempixel.com/900/400/business/"/>
                <div class="slide-caption">
                    <h3>This is a caption</h3>
                    <p>Donec scelerisque aliquet mi, non venenatis urnas iaculis. Utea id nila ante. Cras est massa, interdum  ateal imperdiet etean, gravida eu quame. Aeneana volutpat hendrerit posuere.</p>
                </div>
            </li>
        </ul>
    </div>
</section>
<?php echo View::make('layouts/frontend/_flash')->render() ?>
<section class="margintop60"  id="features">
    <div class="row center">
        <div class="headline margintop marginbottom60"><h4><i class="icon-star"></i> Our Exciting Features</h4></div>
    </div>
    <div class="row center">  
        <div class="span4">
            <article class="feature-boxes">
                <div class="feature-circle">
                    <i class="icon-magic"></i>
                </div>
                <h3>Clean Design</h3>
                <p>Incredibly clean design provides you powerful way to grow your business.</p>
            </article>
        </div>

        <div class="span4">
            <article class="feature-boxes">
                <div class="feature-circle">
                    <i class="icon-tablet"></i>
                </div>
                <h3>Responsive</h3>
                <p>This theme is responsive, so it will look awesome on all mobile devices. </p>
            </article>
        </div>

        <div class="span4">
            <article class="feature-boxes">
                <div class="feature-circle">
                    <i class="icon-desktop"></i>
                </div>
                <h3>Retina Ready</h3>
                <p>aabu is ready for retina and looks fantastic on high-resolution displays.</p>
            </article>
        </div>
    </div>
</section>

<section class="margintop60" id="comments">
    <div class="row center">
        <div class="headline  marginbottom40"><h4><i class="icon-group"></i> How good we are?</h4></div>
    </div>
    <div class="span9 offset1">

        <div id="myCarousel" class="carousel slide">
            <div class="pull-right marginbottom testimonial-nav">
                <a href="#myCarousel" data-slide="prev"><i class="icon-circle-arrow-left icon-2x icon-muted"></i></a>
                <a href="#myCarousel" data-slide="next"><i class="icon-circle-arrow-right icon-2x icon-muted"></i></a>

            </div>
            <div class="carousel-inner">
                <div class="item active">
                    <div class="well well-small well-transparent">
                        <div class="row">
                            <div class="span1"><img src="assets/img/t1.png" class=" img-circle testimonial-image">
                            </div><div class="span6">
                                <blockquote>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                    <small>Someone famous <cite title="Source Title">Source Title</cite></small>
                                </blockquote></div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="well well-small well-transparent">
                        <div class="row">
                            <div class="span1"><img src="assets/img/t2.png" class=" img-circle testimonial-image">
                            </div><div class="span6">
                                <blockquote>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                    <small>Someone famous <cite title="Source Title">Source Title</cite></small>
                                </blockquote></div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="well well-small well-transparent">
                        <div class="row">
                            <div class="span1"><img src="assets/img/t1.png" class=" img-circle testimonial-image">
                            </div><div class="span6">
                                <blockquote>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                    <small>Someone famous <cite title="Source Title">Source Title</cite></small>
                                </blockquote></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</section>
<section class="margintop60" id="blog">
    <div class="row center">
        <div class="headline  marginbottom40"><h4><i class="icon-bullhorn"></i> Fresh from our Blog!</h4></div>
    </div>
    <div class="row">
        <div class="span4 blog-item">

            <div class="picture"><a href="blog-post.html"><img src="assets/img/4.jpg" alt=""><div class="image-overlay-link"></div></a></div>
            <div class="item-description">
                <h5><a href="#">Aliquam elementum nec, auctor penatibus nisi.</a></h5>
                <p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit.</p>
            </div>
            <div class="post-meta">
                <span class="post-date"><i class="icon-calendar"></i>Jan 04, 2013</span>
                <span class="pull-right readmore"><a href="#"><i class="icon-link icon-2x"></i></a></span>
            </div>
        </div>
        <div class="span4 blog-item">
            <div class="picture"><a href="blog-post.html"><img src="assets/img/3.jpg" alt=""><div class="image-overlay-link"></div></a></div>
            <div class="item-description">
                <h5><a href="#">Aliquam elementum nec, auctor penatibus nisi.</a></h5>
                <p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit.</p>
            </div>
            <div class="post-meta">
                <span class="post-date"><i class="icon-calendar"></i>Jan 04, 2013</span>
                <span class="pull-right readmore"><a href="#"><i class="icon-link icon-2x"></i></a></span>
            </div>
        </div>
        <div class="span4 blog-item">
            <div class="picture"><a href="blog-post.html"><img src="assets/img/5.jpg" alt=""><div class="image-overlay-link"></div></a></div>
            <div class="item-description">
                <h5><a href="#">Aliquam elementum nec, auctor penatibus nisi.</a></h5>
                <p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit.</p>
            </div>
            <div class="post-meta">
                <span class="post-date"><i class="icon-calendar"></i>Jan 04, 2013</span>
                <span class="pull-right readmore"><a href="#"><i class="icon-link icon-2x"></i></a></span>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</section>
@stop
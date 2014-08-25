<div class="col-lg-12">
    <div class="navbar navbar-default">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<a class="navbar-brand" href="#"><i class="fa fa-home"></i></a>-->
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                <li class="">
                    <a href="<?php echo route('fe.root') ?>" class="text-info">Trang chủ</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $cat_intro->name ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php foreach ($article_intro as $article) : ?>
                            <li>
                                <a href="<?php echo route('fe.article.show', $article->toParam()) ?>" class="text-info"><?php echo $article->title ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Tin tức <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php foreach ($cat_news as $cat) : ?>
                            <li>
                                <a href="<?php echo route('fe.category', $cat->toParam()) ?>" class="text-info"><?php echo $cat->name ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Tuyển dụng <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php foreach ($cat_recruitments as $cat) : ?>
                            <li>
                                <a href="<?php echo route('fe.category', $cat->toParam()) ?>" class="text-info"><?php echo $cat->name ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="">
                    <a href="#" class="text-info">Cảm nhận khách hàng</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <form action="<?php echo route('fe.search') ?>" method="GET" class="navbar-form navbar-left">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" placeholder="Tìm kiếm ..." name="keyword">
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form> 
            </ul>
        </div>
    </div>

</div>
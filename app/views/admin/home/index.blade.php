@section('addon_css')
<link href="{{asset('assets/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
@stop
@section('header_content')
<h1>
    Dashboard
    <small>Control panel</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol>
@stop
@section('content')
<div class="row">
    <?php //dd($allowed_routes); ?>
    <?php if (in_array('admin.members.index', $allowed_routes)): ?>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        <?php echo $count['members'] ?>
                    </h3>
                    <p>
                        Thành viên
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-contact"></i>
                </div>
                <a href="<?php echo route('admin.members.index') ?>" class="small-box-footer">
                    Xem danh sách <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    <?php endif; ?>
    <?php if (in_array('admin.articles.index', $allowed_routes)): ?>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?php echo $count['articles'] ?>
                    </h3>
                    <p> Bài viết</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-folder"></i>
                </div>
                <a href="<?php echo route('admin.articles.index') ?>" class="small-box-footer">
                    Xem danh sách <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    <?php endif; ?>
    <?php if (in_array('admin.news.index', $allowed_routes)): ?>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-light-blue">
                <div class="inner">
                    <h3>
                        <?php echo $count['news'] ?>
                    </h3>
                    <p>Tin tức/ Thông báo</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-folder"></i>
                </div>
                <a href="<?php echo route('admin.news.index') ?>" class="small-box-footer">
                    Xem danh sách <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    <?php endif; ?>
    <?php if (in_array('admin.product.index', $allowed_routes)): ?>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        <?php echo $count['products'] ?>
                    </h3>
                    <p>Sản phẩm</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pricetag"></i>
                </div>
                <a href="<?php echo route('admin.product.index') ?>" class="small-box-footer">
                    Xem danh sách <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    <?php endif; ?>
    <?php if (in_array('admin.users.index', $allowed_routes)): ?>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        <?php echo $count['users'] ?>
                    </h3>
                    <p>
                        Người dùng hệ thống
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-friends"></i>
                </div>
                <a href="<?php echo route('admin.users.index') ?>" class="small-box-footer">
                    Xem danh sách <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    <?php endif; ?>
</div>

@stop
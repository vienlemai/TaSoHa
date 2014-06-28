<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{asset('assets/img/avatar5.png')}}" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>Hello, Admin</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <ul class="sidebar-menu">
        <li class="active">
            <a href="<?php echo route('admin.root') ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span><?php echo trans('messages.manage_articles'); ?></span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="pages/charts/morris.html"><i class="fa fa-angle-double-right"></i> <?php echo trans('messages.list_article'); ?></a></li>
                <li><a href="{{route('admin.categories.index')}}"><i class="fa fa-angle-double-right"></i> <?php echo trans('messages.article_categories'); ?></a></li>
            </ul>
        </li>
    </ul>
</section>
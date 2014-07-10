<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{asset('assets/img/avatar5.png')}}" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>Welcome, Admin</p>
        </div>
    </div>
    <ul class="sidebar-menu">
        <li class="active">
            <a href="<?php echo route('admin.root') ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="treeview active">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span><?php echo trans('messages.manage_articles'); ?></span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('admin.articles.index')}}"><?php echo trans('messages.list_article'); ?></a></li>
                <li><a href="{{route('admin.article_categories.index')}}"><?php echo trans('messages.article_categories'); ?></a></li>
            </ul>
        </li>
        <li class="treeview active">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span><?php echo trans('messages.manage_users'); ?></span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('admin.users.index')}}"><?php echo trans('messages.list_user'); ?></a></li>
            </ul>
        </li>
        <li class="treeview active">
            <a href="#">
                <i class="fa fa-list"></i>
                <span><?php echo trans('menu.product'); ?></span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('admin.product_category.index')}}"><?php echo trans('menu.all_product_categories'); ?></a></li>
                <li><a href="{{route('admin.product_category.create')}}"><?php echo trans('menu.add_product_category'); ?></a></li>
                <li><a href="{{route('admin.product.index')}}"><?php echo trans('menu.all_products'); ?></a></li>
                <li><a href="{{route('admin.product.create')}}"><?php echo trans('menu.add_product'); ?></a></li>
            </ul>
        </li>
    </ul>
</section>
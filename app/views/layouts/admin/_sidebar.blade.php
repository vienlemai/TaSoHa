<?php $current = Route::currentRouteName() ?>
<section class="sidebar">
    <ul class="sidebar-menu">
        <li class="active">
            <a href="<?php echo route('admin.root') ?>">
                <i class="fa fa-dashboard"></i> <span><?php echo trans('menu.dashboard') ?></span>
            </a>
        </li>
        <li>
            <a href="<?php echo route('fe.root') ?>" target="_blank"><i class="fa fa-home"></i><span>Trang chủ</span></a>
        </li>
        <?php if (in_array('admin.users.index', $allowed_routes) || in_array('admin.groups.index', $allowed_routes)): ?>
            <li class="treeview <?php echo (strpos($current, 'users') !== false || strpos($current, 'groups') !== false) ? 'active' : '' ?>">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span><?php echo trans('messages.manage_users'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if (in_array('admin.users.index', $allowed_routes)): ?>
                        <li class="<?php echo in_array($current, array('admin.users.index', 'admin.users.create', 'admin.users.edit')) ? 'active' : '' ?>">
                            <a href="{{route('admin.users.index')}}"><?php echo trans('messages.list_user'); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_array('admin.groups.index', $allowed_routes)): ?>
                        <li class="<?php echo in_array($current, array('admin.groups.index', 'admin.groups.create', 'admin.groups.edit', 'admin.groups.permission')) ? 'active' : '' ?>">
                            <a href="{{route('admin.groups.index')}}"><?php echo trans('messages.list_group'); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php if (in_array('admin.members.index', $allowed_routes) || in_array('admin.bills.index', $allowed_routes) || in_array('admin.bills.create', $allowed_routes) || in_array('admin.bills.index', $allowed_routes)): ?>
            <li class="treeview <?php echo (strpos($current, 'members') !== false || strpos($current, 'bills') !== false || strpos($current, 'share')) ? 'active' : '' ?>">
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span>Quản lý thành viên</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if (in_array('admin.members.index', $allowed_routes)): ?>
                        <li><a href="{{route('admin.members.index')}}">Danh sách thành viên</a></li>
                    <?php endif; ?>
                    <?php if (in_array('admin.members.create', $allowed_routes)): ?>
                        <li><a href="{{route('admin.members.create')}}">Thêm mới thành viên</a></li>
                    <?php endif; ?>
                    <?php if (in_array('admin.bills.index', $allowed_routes)) : ?>
                        <li><a href="{{route('admin.bills.index')}}">Danh sách hóa đơn</a></li>
                    <?php endif; ?>
                    <?php if (in_array('admin.bills.create', $allowed_routes)) : ?>
                        <li><a href="{{route('admin.bills.create')}}">Nhập hóa đơn</a></li>
                    <?php endif; ?>
                    <?php if (in_array('admin.share.index', $allowed_routes)): ?>
                        <li><a href="{{route('admin.share.index')}}">Cổ phần đầu tư</a></li>
                    <?php endif; ?>
                    <?php if (in_array('admin.share.level', $allowed_routes)): ?>
                        <li><a href="{{route('admin.share.level')}}">Cổ phần theo cấp bậc</a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php if (in_array('admin.articles.index', $allowed_routes) || in_array('admin.articles.create', $allowed_routes) || in_array('admin.article_categories.index', $allowed_routes) || in_array('admin.page.index', $allowed_routes)): ?>
            <li class="treeview <?php echo (strpos($current, 'articles') !== false || strpos($current, 'article_categories') !== FALSE) ? 'active' : '' ?>">
                <a href="#">
                    <i class="fa fa-file"></i>
                    <span><?php echo trans('menu.manage_articles'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if (in_array('admin.articles.index', $allowed_routes)): ?>
                        <li><a href="{{route('admin.articles.index')}}"><?php echo trans('menu.list_articles'); ?></a></li>
                    <?php endif; ?>
                    <?php if (in_array('admin.articles.create', $allowed_routes)): ?>
                        <li><a href="{{route('admin.articles.create')}}"><?php echo trans('menu.new_article'); ?></a></li>
                    <?php endif; ?>
                    <?php if (in_array('admin.article_categories.index', $allowed_routes)): ?>
                        <li><a href="{{route('admin.article_categories.index')}}"><?php echo trans('menu.list_article_categories'); ?></a></li>
                    <?php endif; ?>
                    <?php if (in_array('admin.page.index', $allowed_routes)): ?>
                        <li><a href="{{route('admin.page.index')}}"><?php echo trans('menu.manage_tasoha_pages'); ?></a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>

        <?php if (in_array('admin.statistic.index', $allowed_routes)): ?>
            <li>
                <a href="<?php echo route('admin.statistic.index') ?>"><i class="fa fa-list"></i><span>Thống kê</span></a>
            </li>
        <?php endif; ?>
        <?php if (in_array('admin.slide.index', $allowed_routes)): ?>
            <li class="treeview <?php echo strpos($current, 'slide') !== false ? 'active' : '' ?>">
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span><?php echo trans('menu.site_setting'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if (in_array('admin.slide.index', $allowed_routes)): ?>
                        <li><a href="{{route('admin.slide.index')}}"><?php echo trans('menu.manage_slides'); ?></a></li>
                    <?php endif; ?>
                    <li><a href="">&nbsp</a></li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</section>
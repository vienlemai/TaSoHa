<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{asset('assets/img/avatar5.png')}}" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>Welcome, <?php echo Auth::admin()->get()->full_name ?> </p>
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
                <span>Quản lý thành viên</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('admin.members.index')}}">Danh sách thành viên</a></li>
            </ul>
        </li>
    </ul>
</section>
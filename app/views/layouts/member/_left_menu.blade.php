<?php $current = Route::currentRouteName() ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list-ul"></i> Menu</h3>
    </div>
    <div class="panel-body">
        <ul class="member-menu">
            <li class="<?php echo $current == 'member.profile' ? 'active' : '' ?>"><a href="<?php echo route('member.profile') ?>">Trang cá nhân</a></li>
            <li class="<?php echo $current == 'member.bonus' ? 'active' : '' ?>"><a href="<?php echo route('member.bonus') ?>">Hoa hồng</a></li>
            <li class="<?php echo $current == 'member.tree' ? 'active' : '' ?>"><a href="<?php echo route('member.tree') ?>">Danh sách thành viên</a></li>
            <li class="<?php echo $current == 'member.bills' ? 'active' : '' ?>"><a href="<?php echo route('member.bills') ?>">Hóa đơn mua hàng</a></li>
            <li class="<?php echo $current == 'member.update_profile' ? 'active' : '' ?>"><a href="<?php echo route('member.update_profile') ?>">Cập nhật thông tin</a></li>
            <li class="<?php echo $current == 'member.change_password' ? 'active' : '' ?>"><a href="<?php echo route('member.change_password') ?>">Đổi mật khẩu</a></li>
            <li><a href="<?php echo route('member.logout') ?>">Đăng xuất</a></li>
        </ul>
    </div>
</div>
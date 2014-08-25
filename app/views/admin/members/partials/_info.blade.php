<div class="col-md-6">
    <div class="box box-info">
        <div class="box-header">
            <i class="fa fa-user"></i>
            <h3 class="box-title">Thông tin thành viên</h3>
            <div class="box-tools pull-right">
                <a href="<?php echo route('admin.members.index') ?>" class="btn btn-info">
                    <i class="fa fa-arrow-left"></i> Quay lại danh sách</a>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Mã số</td>
                        <td><?php echo $member->uid ?></td>
                    </tr>
                    <tr>
                        <td>Họ tên</td>
                        <td><?php echo $member->full_name ?></td>
                    </tr>
                    <tr>
                        <td>Cấp bậc</td>
                        <td><strong><?php echo Member::$regencyLabel[$member->regency] ?></strong></td>
                    </tr>
                    <tr>
                        <td>Cổ phần</td>
                        <td><strong><?php echo $member->shares ?></strong></td>
                    </tr>
                    <tr>
                        <td>Điểm tích lũy</td>
                        <td><?php echo Common::IntToString($member->score) ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $member->email ?></td>
                    </tr>

                    <tr>
                        <td>Ngày sinh</td>
                        <td><?php echo $member->day_of_birth ?></td>
                    </tr>
                    <tr>
                        <td>Chỗ ở hiện tại</td>
                        <td><?php echo $member->location ?></td>
                    </tr>
                    <tr>
                        <td>Điện thoại</td>
                        <td><?php echo $member->phone; ?></td>
                    </tr>
                    <tr>
                        <td>Chứng minh nhân dân</td>
                        <td><?php echo $member->identify_number; ?></td>
                    </tr>
                    <tr>
                        <td>Nơi cấp</td>
                        <td><?php echo $member->identify_location; ?></td>
                    </tr>
                    <tr>
                        <td>Ngày cấp</td>
                        <td><?php echo $member->identify_date; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <a class="btn btn-danger" href="<?php echo route('admin.members.change_password', $member->id) ?>">Đổi mật khẩu</a>
            <a href="<?php echo route('admin.members.shares', $member->id) ?>" class="btn btn-warning">
                <i class="fa fa-share"> Nhập cổ phần</i>
            </a>
        </div>
    </div>
</div>
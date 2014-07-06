<div id="bModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="false" style="display: block;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Thông tin thành viên</h3>
    </div>
    <div class="modal-body">
        <?php if ($member->children->count() < 2): ?>
            <a href="<?php echo route('member.create', $member->id) ?>">Thêm thành viên tại đây</a>
        <?php endif; ?>
        <table class="table">
            <tbody>
                <tr>
                    <td style="width: 30%">Họ tên</td>
                    <td><?php echo $member->full_name ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $member->email ?></td>
                </tr>
                <tr>
                    <td>Tên đăng nhập</td>
                    <td><?php echo $member->username ?></td>
                </tr>
                <tr>
                    <td>Ngày sinh</td>
                    <td><?php echo $member->day_of_birth ?></td>
                </tr>
                <tr>
                    <td>Giới tính</td>
                    <td><?php echo $member->getSexName(); ?></td>
                </tr>
            </tbody>
        </table>
        <h4>Hoa hồng</h4>
        <table class="table">
            <thead>
                <tr>
                    <td>Tên hoa hồng</td>
                    <td>Tổng tiền</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bonus as $b): ?>
                    <tr>
                        <td><?php echo $b['name']; ?></td>
                        <td><?php echo $b['amount'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Đóng</button>            
    </div>
</div>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?php echo '#tab_info-' . $member->id ?>" data-toggle="tab">Thông tin mô tả</a></li>
        <li class=""><a href="<?php echo '#tab_bonus-' . $member->id ?>" data-toggle="tab">Thông tin hoa hồng</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="<?php echo 'tab_info-' . $member->id ?>">
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
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="<?php echo 'tab_bonus-' . $member->id ?>">
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
        </div><!-- /.tab-pane -->
    </div><!-- /.tab-content -->
</div>


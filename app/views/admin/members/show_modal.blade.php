
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
                        <td>Mã số</td>
                        <td><?php echo $member->uid ?></td>
                    </tr>
                    <tr>
                        <td>Họ tên</td>
                        <td><?php echo $member->full_name ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $member->email ?></td>
                    </tr>
                    <tr>
                        <td>Ngày tham gia</td>
                        <td><?php echo $member->created_at->format('d \t\h\á\n\g m, Y') ?></td>
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
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="<?php echo 'tab_bonus-' . $member->id ?>">
            <div class="row">
                <div class="box-tools pull-right">
                    <select name="month" class="form-control" id="bonus-month-select" data-member-id="<?php echo $member->id ?>">
                        <?php foreach ($months as $m): ?>
                            <option value="<?php echo $m ?>" <?php echo $month == $m ? 'selected' : '' ?>><?php echo $m ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div id="member-bonus-content">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Tên hoa hồng</td>
                            <td>Tổng điểm</td>
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
        </div><!-- /.tab-pane -->
    </div><!-- /.tab-content -->
</div>


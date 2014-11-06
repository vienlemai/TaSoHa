<div class="row">
    <div class="col-lg-12 pull-right">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-certificate"></i> Thông tin hoa hồng</h3>
            </div>
            <div class="panel-body" id="personal-info-wrap">
                <div class="row">
                    <div class="pull-left">
                        <h4 class="right-sub-title">Hoa hồng của bạn trong tháng <?php echo $month ?></h4>
                    </div>
                    <div class="box-tools pull-right">
                        <select name="month" class="form-control" id="bonus-month-select" data-member-id="<?php echo $member->id ?>">
                            <?php foreach ($months as $m): ?>
                                <option value="<?php echo $m ?>" <?php echo $month == $m ? 'selected' : '' ?>><?php echo $m ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-bordered table-striped ml20">
                        <thead>
                            <tr>
                                <td><strong>Tên hoa hồng</strong></td>
                                <td><strong>Tổng điểm</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bonus as $b): ?>
                                <tr>
                                    <td><?php echo $b['name']; ?></td>
                                    <td><?php echo Common::IntToString($b['amount']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td><strong>Tổng cộng</strong></td>
                                <td style="color: #F57D30"><strong><?php echo Common::IntToString($total) ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-description">
                        <?php if ($isCalculated): ?>
                            <?php if ($isPaid): ?>
                                <div class="text-success">Đã thanh toán hoa hồng cho tháng <?php echo $month ?></div>
                            <?php else: ?>
                                <div class="text-danger">Chưa thanh toán hoa hồng cho tháng <?php echo $month ?></div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="text-warning">Hoa hồng tháng này sẽ được tính vào cuối tháng</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
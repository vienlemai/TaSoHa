<div class="row">
    <div class="col-lg-12 pull-right">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-certificate"></i> Hóa đơn mua hàng</h3>
            </div>
            <div class="panel-body" id="personal-info-wrap">
                <div class="row">
                    <div class="pull-left">
                        <h4 class="right-sub-title">Hóa đơn mua hàng trong tháng <?php echo $month ?></h4>
                    </div>
                    <div class="box-tools pull-right">
                        <select name="month" class="form-control" id="bills-month-select" data-member-id="<?php echo $member->id ?>">
                            <?php foreach ($months as $m): ?>
                                <option value="<?php echo $m ?>" <?php echo $month == $m ? 'selected' : '' ?>><?php echo $m ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-bordered table-striped ml20">
                        <thead style="font-weight: bold">
                            <tr>
                                <td>Tên sản phẩm</td>
                                <td>Số tiền</td>
                                <td>Điểm</td>
                                <td>Thời gian</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $scoreTotal = 0;
                            $priceTotal = 0;
                            foreach ($bills as $bill) {
                                $scoreTotal+= $bill->score;
                                $priceTotal += $bill->price;

                                ?>
                                <tr>
                                    <td><?php echo $bill->product_name ?></td>
                                    <td><?php echo Common::IntToString($bill->price) ?></td>
                                    <td><?php echo Common::IntToString($bill->score) ?></td>
                                    <td><?php echo $bill->created_at->format('d \t\h\á\n\g m, Y') ?></td>
                                </tr>
                            <?php } ?>
                            <tr style="font-weight: bold">
                                <td>Tổng cổng</td>
                                <td><?php echo Common::IntToString($priceTotal) ?></td>
                                <td><?php echo Common::IntToString($scoreTotal) ?></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
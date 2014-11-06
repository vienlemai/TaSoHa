<?php if ($isCalculated): ?>
    <?php if ($isPaid): ?>
        <div class="alert alert-success"><strong>Trạng thái: </strong>Đã thanh toán hoa hồng cho tháng <?php echo $month ?></div>
        <?php if (Auth::admin()->check() && !Auth::member()->check()): ?>
            <a target="_blank" href="<?php echo route('admin.member.print.receipt', $receipt->id) ?>" class="btn btn-primary pull-right"><i class="fa fa-print"></i> In biên lai</a>
        <?php endif; ?>
    <?php else: ?>
        <div class="alert alert-danger"><strong>Trạng thái: </strong>Chưa thanh toán hoa hồng cho tháng <?php echo $month ?></div>
        <?php if (Auth::admin()->check() && !Auth::member()->check()) : ?>
            <a href="<?php echo route('admin.member.receipt', array($member->id)) ?>" data-month="<?php echo $month ?>" class="btn btn-primary pull-right" id="btn-pay-bonus"><i class="fa fa-bitcoin"></i> Thanh toán</a>
        <?php endif; ?>
    <?php endif; ?>
<?php else: ?>
    <div class="alert alert-warning">Hoa hồng tháng này sẽ được tính vào cuối tháng</div>
<?php endif; ?>
<table class="table">
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
            <td style="color: #F57D30;"><strong><?php echo Common::IntToString($total) ?></strong></td>
        </tr>
    </tbody>
</table>
</div>

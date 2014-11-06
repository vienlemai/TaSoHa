@section('header_content')
<h1>
    Thống kê hệ thống
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active">Thống kê</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="table-wrap">
            <div class="table-header">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="">Chọn tháng</label>
                        <select id="statistic-select-month" class="form-control" style="width: 200px;" name="month">
                            <?php foreach ($months as $m): ?>
                                <option value="<?php echo $m ?>" <?php echo $month == $m ? 'selected' : '' ?>><?php echo $m ?></option>
                            <?php endforeach; ?>
                        </select>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Thông tin thống kê tháng <?php echo $month ?></h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>Số thành viên đăng ký mới</td>
                            <td><?php echo $count['members'] ?></td>
                        </tr>
                        <tr>
                            <td>Số hóa đơn nhập mới</td>
                            <td><?php echo $count['bills'] ?></td>
                        </tr>
                        <?php if ($statistic !== null): ?>
                            <tr>
                                <td>Tổng tiền</td>
                                <td><?php echo Common::IntToString($count['bills_money']) ?></td>
                            </tr>
                            <tr>
                                <td>Tổng điểm </td>
                                <td><?php echo $statistic->score ?></td>
                            </tr>
                            <tr>
                                <td>Tổng hoa hồng</td>
                                <td><?php echo round($statistic->bonus, 1) ?></td>
                            </tr>
                            <tr>
                                <td>Lợi nhuận</td>
                                <td><?php echo round($statistic->score - $statistic->bonus, 1) ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if ($statistic !== null): ?>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Chi tiết hoa hồng</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Tên hoa hồng</td>
                                <td>Tổng điểm</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            <?php foreach ($bonusDetails as $b): ?>
                                <tr>
                                    <td><?php echo $b['name']; ?></td>
                                    <td><?php echo $b['amount'] ?></td>
                                </tr>
                                <?php $total+=$b['amount'] ?>
                            <?php endforeach; ?>
                            <tr>
                                <td><b>Tổng cộng</b></td>
                                <td><b><?php echo $total ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
@stop
@section('addon_js')
<script type="text/javascript">
    $('#statistic-select-month').on('change', function() {
        var month = $(this).val();
        var url = baseUrl + '/statistic?month=' + month;
        location.href = url;
    });
</script>
@stop
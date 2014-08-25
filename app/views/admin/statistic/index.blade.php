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
    <div class="col-md-12">
        <h3>Thông tin thống kê tháng <?php echo $month ?></h3>
        <ul>
            <li>Tổng số thành viên đăng ký mới : <?php echo $count['members'] ?></li>
            <li>Tổng số hóa đơn nhập mới: <?php echo $count['bills'] ?></li>

            <?php if ($statistic !== null): ?>
                <li>Tổng tiền : <?php echo $statistic->score ?></li>
                <li>Tổng điểm : <?php echo $statistic->score ?></li>
                <li>Tổng hoa hồng: <?php echo round($statistic->bonus, 1) ?></li>
                <li>Lợi nhuận : <?php echo round($statistic->score - $statistic->bonus, 1) ?></li>
            <?php endif; ?>

        </ul>
    </div>
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
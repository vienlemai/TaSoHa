@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <?php $now = Carbon\Carbon::now(); ?>
        <div class="calculate-bonus-wrap">
            <h3>Bấm vào <a href="#" id="get-monthly-bonus">đây</a> để bắt đầu tính hoa hồng cho tháng <?php echo $now->month ?> năm <?php echo $now->year ?></h3>
        </div>
        <div class="bounus-result-wrap" style="display: none">
            <div class="alert alert-danger">
                Hoa hồng của tháng <?php echo $now->format('m/Y') ?> đã được tính.<br>
            </div>
        </div>
    </div>
</div>
@stop
@stop
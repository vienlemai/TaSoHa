@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <?php $now = Carbon\Carbon::now(); ?>
        <div class="calculate-bonus-wrap">
            <h3>Bấm vào <a href="#" id="btn-reset-bill">đây</a> xóa hết dữ liệu <?php echo $now->month ?> năm <?php echo $now->year ?></h3>
        </div>
        <div class="clear-result-wrap" style="display: none">
            <div class="alert alert-danger">

            </div>
        </div>
    </div>
</div>
@stop
@stop
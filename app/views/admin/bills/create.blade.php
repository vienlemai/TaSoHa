@section('header_content')
<h1>
    Quản lý hóa đơn
    <small>Nhập hóa đơn</small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active">Hóa đơn</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-user"></i>
                <h3 class="box-title">Nhập Thông tin hóa đơn</h3>
                <!--                <div class="box-tools pull-right">
                                    <a href="<?php echo route('admin.members.index') ?>" class="btn btn-info">
                                        <i class="fa fa-arrow-left"></i> Quay lại danh sách</a>
                                </div>-->
            </div>
            <?php echo Former::open(route('admin.bills.store'))->method('post') ?>
            <div class="box-body col-lg-10">
                <?php
                echo Former::select('member_id')
                    ->label('Người mua')
                    ->class('custom-select2 select2')
                    ->options($members);

                echo Former::text('product_name')
                    ->label('Tên sản phẩm')
                    ->class('form-control');
                echo Former::text('price')
                    ->label('Giá tiền')
                    ->class('form-control money_mask');
                echo Former::text('score')
                    ->label('Điểm tương ứng')
                    ->class('form-control money_mask');

                ?>
            </div>
            <div class="box-footer">
                <?php
                echo Former::actions()
                    ->primary_submit(Lang::get('messages.save'))
                    ->inverse_reset(Lang::get('messages.reset'))

                ?>
            </div>
            <?php echo Former::close(); ?>
        </div>
    </div>
</div>
@stop
@section('addon_js')
<script src="{{asset('assets/js/plugins/jquery.mask.min.js')}}"></script>
@stop
@section('inline_js')
<script>
$('.money_mask').mask('000 000 000 000 000 000', {reverse: true});
</script>
@stop
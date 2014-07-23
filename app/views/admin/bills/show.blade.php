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
            </div>
            <div class="box-body col-lg-10">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Khách hàng</td>
                            <td><?php echo $bill->buyer->full_name . '(' . $bill->buyer->uid . ')' ?></td>
                        </tr>
                        <tr>
                            <td>Tên sản phẩm</td>
                            <td><?php echo $bill->product_name ?></td>
                        </tr>
                        <tr>
                            <td>Giá tiền</td>
                            <td><?php echo $bill->price ?></td>
                        </tr>
                        <tr>
                            <td>Điểm</td>
                            <td><?php echo $bill->score ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <div class="col-lg-offset-3 col-sm-offset-4 col-lg-9 col-sm-8">
                        <a href="<?php echo route('admin.bills.index') ?>" class="btn-info btn">Quay lại danh sách</a>  
                        <a href="<?php echo route('admin.bills.print', $bill->id) ?>" target="_blank" class="btn-primary btn">
                            <i class="fa fa-print"></i> In hóa đơn
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
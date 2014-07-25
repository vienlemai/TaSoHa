@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-user"></i>
                <h3 class="box-title">Thông tin hóa đơn</h3>
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
        </div>
    </div>
</div>
@stop
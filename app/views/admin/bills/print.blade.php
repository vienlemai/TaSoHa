@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-user"></i>
                <h3 class="box-title">Thông tin thanh toán</h3>
                <div class="clear_fix"></div>
            </div>
            <div class="center" style="text-align: center">
                <p>CÔNG TY CỔ PHẦN TASOHA</p>
                <P>Mã số thuế: 0401612200</P>
                <p>Phone: 05113 887 789 - Fax:  05113 888 879</p>
                <p>Website: tasoha.com - Email: tasohagroup@gmail.com</p>
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
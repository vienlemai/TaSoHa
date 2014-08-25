@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-user"></i>
                <h3 class="box-title">Thông tin thanh toán hoa hồng tháng <?php echo $receipt->month ?></h3>
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
                            <td><strong>Khách hàng</strong></td>
                            <td><strong><?php echo $member->full_name . '(' . $member->uid . ')' ?></strong></td>
                        </tr>
                        <?php $bonus = json_decode($receipt->content,true) ?>
                        <?php foreach ($bonus as $b): ?>
                            <tr>
                                <td><?php echo $b['name']; ?></td>
                                <td><?php echo $b['amount'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><strong>Tổng cộng</strong></td>
                            <td><strong><?php echo $receipt->total ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
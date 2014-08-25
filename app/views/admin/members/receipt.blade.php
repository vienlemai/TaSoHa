@section('header_content')
<h1>
    Quản lý thành viên
    <small>Thanh toán hoa hồng</small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active">Thành viên</li>
</ol>
@stop

@section('content')
<div class="row">
    <!--Hoa hong-->
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-money"></i>
                <h3 class="box-title">Thanh toán hoa hồng tháng <?php echo $month ?></h3>
            </div>
            <div class="box-body">
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
                                <td><?php echo $b['amount'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><strong>Tổng cộng</strong></td>
                            <td><strong><?php echo $total ?></strong></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="box-footer">
                <a href="<?php echo route('admin.member.receipt', array($member->id)) ?>" data-month="<?php echo $month ?>" class="btn btn-primary pull-right" id="btn-pay-bonus"><i class="fa fa-bitcoin"></i> Thanh toán</a>
                <div class="clearfix"></div>
            </div>

        </div>
    </div>
    <?php
    echo View::make('admin.members.partials._info', array(
        'member' => $member
    ))->render();

    ?>
</div>
@stop
@section('addon_js')
<script type="text/javascript">
    $('body').on('click', '#btn-pay-bonus', function() {
        var dataUrl = $(this).attr('href');
        var month = $(this).attr('data-month');
        $.ajax({
            url: dataUrl,
            type: 'post',
            dataType: 'json',
            data: {month: month},
            success: function(data) {
                if (confirm('Đã thanh toán thành công hoa hồng, bạn có muốn in hóa đơn ?')) {
                    location.href = data.url_print_receipt;
                } else {
                    location.href = baseUrl + '/member/bonus/' + data.member_id;
                }
            },
            error: function(error) {
                alert('Đã có lỗi xảy ra, vui lòng thử lại');
                return false;
            }
        });
        return false;
    });
</script>
@stop